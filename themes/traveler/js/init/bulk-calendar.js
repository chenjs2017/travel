jQuery(document).ready(function($){"use strict";$('.check-all').change(function(event){var name=$(this).data('name');$("input[name='"+name+"[]']").prop('checked',$(this).prop("checked"))});if($('#form-bulk-edit').length){$('#calendar-bulk-close').click(function(event){$(this).closest('#form-bulk-edit').fadeOut();$(this).closest('.calendar-wrapper').find('.calendar-content').fullCalendar('refetchEvents')})}
$('#calendar-bulk-edit').click(function(event){if($('#form-bulk-edit').length){$('#form-bulk-edit').fadeIn()}});var flag_save_bulk=!1;function step_add_bulk(data1,posts_per_page,total,current_page,all_days,post_id,container,data_first){var data;if(typeof(data_first)=='object'){data=data_first}else{data={'data':data1,'posts_per_page':posts_per_page,'total':total,'current_page':current_page,'all_days':all_days,'post_id':post_id,'action':'traveler_calendar_bulk_edit_form'}}
$.post(ajaxurl,data,function(respon,textStatus,xhr){if(typeof(respon)=='object'){if(respon.status==2){step_add_bulk(respon.data,respon.posts_per_page,respon.total,respon.current_page,respon.all_days,respon.post_id,container,'')}else{$('#form-bulk-edit .form-message',container).html(respon.message);$('#form-bulk-edit .overlay, #form-bulk-edit .overlay-form',container).removeClass('open').fadeOut()}}
flag_save_bulk=!1},'json')}
if($('#form-bulk-edit').length){$('#calendar-bulk-save').click(function(event){var parent=$(this).closest('#form-bulk-edit');var container=$(this).closest('.calendar-wrapper');if(flag_save_bulk)return!1;flag_save_bulk=!0;var day_of_week=[];$('input[name="day-of-week[]"]:checked',parent).each(function(i){day_of_week[i]=$(this).val()});var day_of_month=[];$('input[name="day-of-month[]"]:checked',parent).each(function(i){day_of_month[i]=$(this).val()});var months=[];$('input[name="months[]"]:checked',parent).each(function(i){months[i]=$(this).val()});var years=[];$('input[name="years[]"]:checked',parent).each(function(i){years[i]=$(this).val()});var calendar_groupday=0;if($('input[name="calendar_groupday"]',parent).prop('checked')){calendar_groupday=1}
var data={'day-of-week':day_of_week,'day-of-month':day_of_month,'months':months,'years':years,'price_bulk':$('input[name="price-bulk"]').val(),'adult-price_bulk':$('input[name="adult-price-bulk"]').val(),'children-price_bulk':$('input[name="children-price-bulk"]').val(),'infant-price_bulk':$('input[name="infant-price-bulk"]').val(),'post_id':$('input[name="post-id"]',parent).val(),'status':$('select[name="status"]',parent).val(),'calendar_groupday':calendar_groupday,'action':'traveler_calendar_bulk_edit_form'};$('.form-message',parent).html('');$('.overlay, .overlay-form',parent).addClass('open').fadeIn();step_add_bulk('','','','','','',container,data);return!1})}})