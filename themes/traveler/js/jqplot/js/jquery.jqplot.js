(function($){var undefined;$.fn.emptyForce=function(){for(var i=0,elem;(elem=$(this)[i])!=null;i++){if(elem.nodeType===1){$.cleanData(elem.getElementsByTagName("*"))}
if($.jqplot.use_excanvas){elem.outerHTML=""}
else{while(elem.firstChild){elem.removeChild(elem.firstChild)}}
elem=null}
return $(this)};$.fn.removeChildForce=function(parent){while(parent.firstChild){this.removeChildForce(parent.firstChild);parent.removeChild(parent.firstChild)}};$.fn.jqplot=function(){var datas=[];var options=[];for(var i=0,l=arguments.length;i<l;i++){if($.isArray(arguments[i])){datas.push(arguments[i])}
else if($.isPlainObject(arguments[i])){options.push(arguments[i])}}
return this.each(function(index){var tid,plot,$this=$(this),dl=datas.length,ol=options.length,data,opts;if(index<dl){data=datas[index]}
else{data=dl?datas[dl-1]:null}
if(index<ol){opts=options[index]}
else{opts=ol?options[ol-1]:null}
tid=$this.attr('id');if(tid===undefined){tid='jqplot_target_'+$.jqplot.targetCounter++;$this.attr('id',tid)}
plot=$.jqplot(tid,data,opts);$this.data('jqplot',plot)})};$.jqplot=function(target,data,options){var _data=null,_options=null;if(arguments.length===3){_data=data;_options=options}
else if(arguments.length===2){if($.isArray(data)){_data=data}
else if($.isPlainObject(data)){_options=data}}
if(_data===null&&_options!==null&&_options.data){_data=_options.data}
var plot=new jqPlot();$('#'+target).removeClass('jqplot-error');if($.jqplot.config.catchErrors){try{plot.init(target,_data,_options);plot.draw();plot.themeEngine.init.call(plot);return plot}
catch(e){var msg=$.jqplot.config.errorMessage||e.message;$('#'+target).append('<div class="jqplot-error-message">'+msg+'</div>');$('#'+target).addClass('jqplot-error');document.getElementById(target).style.background=$.jqplot.config.errorBackground;document.getElementById(target).style.border=$.jqplot.config.errorBorder;document.getElementById(target).style.fontFamily=$.jqplot.config.errorFontFamily;document.getElementById(target).style.fontSize=$.jqplot.config.errorFontSize;document.getElementById(target).style.fontStyle=$.jqplot.config.errorFontStyle;document.getElementById(target).style.fontWeight=$.jqplot.config.errorFontWeight}}
else{plot.init(target,_data,_options);plot.draw();plot.themeEngine.init.call(plot);return plot}};$.jqplot.version="1.0.8";$.jqplot.revision="1250";$.jqplot.targetCounter=1;$.jqplot.CanvasManager=function(){if(typeof $.jqplot.CanvasManager.canvases=='undefined'){$.jqplot.CanvasManager.canvases=[];$.jqplot.CanvasManager.free=[]}
var myCanvases=[];this.getCanvas=function(){var canvas;var makeNew=!0;if(!$.jqplot.use_excanvas){for(var i=0,l=$.jqplot.CanvasManager.canvases.length;i<l;i++){if($.jqplot.CanvasManager.free[i]===!0){makeNew=!1;canvas=$.jqplot.CanvasManager.canvases[i];$.jqplot.CanvasManager.free[i]=!1;myCanvases.push(i);break}}}
if(makeNew){canvas=document.createElement('canvas');myCanvases.push($.jqplot.CanvasManager.canvases.length);$.jqplot.CanvasManager.canvases.push(canvas);$.jqplot.CanvasManager.free.push(!1)}
return canvas};this.initCanvas=function(canvas){if($.jqplot.use_excanvas){return window.G_vmlCanvasManager.initElement(canvas)}
return canvas};this.freeAllCanvases=function(){for(var i=0,l=myCanvases.length;i<l;i++){this.freeCanvas(myCanvases[i])}
myCanvases=[]};this.freeCanvas=function(idx){if($.jqplot.use_excanvas&&window.G_vmlCanvasManager.uninitElement!==undefined){window.G_vmlCanvasManager.uninitElement($.jqplot.CanvasManager.canvases[idx]);$.jqplot.CanvasManager.canvases[idx]=null}
else{var canvas=$.jqplot.CanvasManager.canvases[idx];canvas.getContext('2d').clearRect(0,0,canvas.width,canvas.height);$(canvas).unbind().removeAttr('class').removeAttr('style');$(canvas).css({left:'',top:'',position:''});canvas.width=0;canvas.height=0;$.jqplot.CanvasManager.free[idx]=!0}}};$.jqplot.log=function(){if(window.console){window.console.log.apply(window.console,arguments)}};$.jqplot.config={addDomReference:!1,enablePlugins:!1,defaultHeight:300,defaultWidth:400,UTCAdjust:!1,timezoneOffset:new Date(new Date().getTimezoneOffset()*60000),errorMessage:'',errorBackground:'',errorBorder:'',errorFontFamily:'',errorFontSize:'',errorFontStyle:'',errorFontWeight:'',catchErrors:!1,defaultTickFormatString:"%.1f",defaultColors:["#4bb2c5","#EAA228","#c5b47f","#579575","#839557","#958c12","#953579","#4b5de4","#d8b83f","#ff5800","#0085cc","#c747a3","#cddf54","#FBD178","#26B4E3","#bd70c7"],defaultNegativeColors:["#498991","#C08840","#9F9274","#546D61","#646C4A","#6F6621","#6E3F5F","#4F64B0","#A89050","#C45923","#187399","#945381","#959E5C","#C7AF7B","#478396","#907294"],dashLength:4,gapLength:4,dotGapLength:2.5,srcLocation:'jqplot/src/',pluginLocation:'jqplot/src/plugins/'};$.jqplot.arrayMax=function(array){return Math.max.apply(Math,array)};$.jqplot.arrayMin=function(array){return Math.min.apply(Math,array)};$.jqplot.enablePlugins=$.jqplot.config.enablePlugins;$.jqplot.support_canvas=function(){if(typeof $.jqplot.support_canvas.result=='undefined'){$.jqplot.support_canvas.result=!!document.createElement('canvas').getContext}
return $.jqplot.support_canvas.result};$.jqplot.support_canvas_text=function(){if(typeof $.jqplot.support_canvas_text.result=='undefined'){if(window.G_vmlCanvasManager!==undefined&&window.G_vmlCanvasManager._version>887){$.jqplot.support_canvas_text.result=!0}
else{$.jqplot.support_canvas_text.result=!!(document.createElement('canvas').getContext&&typeof document.createElement('canvas').getContext('2d').fillText=='function')}}
return $.jqplot.support_canvas_text.result};$.jqplot.use_excanvas=((!$.support.boxModel||!$.support.objectAll||!$support.leadingWhitespace)&&!$.jqplot.support_canvas())?!0:!1;$.jqplot.preInitHooks=[];$.jqplot.postInitHooks=[];$.jqplot.preParseOptionsHooks=[];$.jqplot.postParseOptionsHooks=[];$.jqplot.preDrawHooks=[];$.jqplot.postDrawHooks=[];$.jqplot.preDrawSeriesHooks=[];$.jqplot.postDrawSeriesHooks=[];$.jqplot.preDrawLegendHooks=[];$.jqplot.addLegendRowHooks=[];$.jqplot.preSeriesInitHooks=[];$.jqplot.postSeriesInitHooks=[];$.jqplot.preParseSeriesOptionsHooks=[];$.jqplot.postParseSeriesOptionsHooks=[];$.jqplot.eventListenerHooks=[];$.jqplot.preDrawSeriesShadowHooks=[];$.jqplot.postDrawSeriesShadowHooks=[];$.jqplot.ElemContainer=function(){this._elem;this._plotWidth;this._plotHeight;this._plotDimensions={height:null,width:null}};$.jqplot.ElemContainer.prototype.createElement=function(el,offsets,clss,cssopts,attrib){this._offsets=offsets;var klass=clss||'jqplot';var elem=document.createElement(el);this._elem=$(elem);this._elem.addClass(klass);this._elem.css(cssopts);this._elem.attr(attrib);elem=null;return this._elem};$.jqplot.ElemContainer.prototype.getWidth=function(){if(this._elem){return this._elem.outerWidth(!0)}
else{return null}};$.jqplot.ElemContainer.prototype.getHeight=function(){if(this._elem){return this._elem.outerHeight(!0)}
else{return null}};$.jqplot.ElemContainer.prototype.getPosition=function(){if(this._elem){return this._elem.position()}
else{return{top:null,left:null,bottom:null,right:null}}};$.jqplot.ElemContainer.prototype.getTop=function(){return this.getPosition().top};$.jqplot.ElemContainer.prototype.getLeft=function(){return this.getPosition().left};$.jqplot.ElemContainer.prototype.getBottom=function(){return this._elem.css('bottom')};$.jqplot.ElemContainer.prototype.getRight=function(){return this._elem.css('right')};function Axis(name){$.jqplot.ElemContainer.call(this);this.name=name;this._series=[];this.show=!1;this.tickRenderer=$.jqplot.AxisTickRenderer;this.tickOptions={};this.labelRenderer=$.jqplot.AxisLabelRenderer;this.labelOptions={};this.label=null;this.showLabel=!0;this.min=null;this.max=null;this.autoscale=!1;this.pad=1.2;this.padMax=null;this.padMin=null;this.ticks=[];this.numberTicks;this.tickInterval;this.renderer=$.jqplot.LinearAxisRenderer;this.rendererOptions={};this.showTicks=!0;this.showTickMarks=!0;this.showMinorTicks=!0;this.drawMajorGridlines=!0;this.drawMinorGridlines=!1;this.drawMajorTickMarks=!0;this.drawMinorTickMarks=!0;this.useSeriesColor=!1;this.borderWidth=null;this.borderColor=null;this.scaleToHiddenSeries=!1;this._dataBounds={min:null,max:null};this._intervalStats=[];this._offsets={min:null,max:null};this._ticks=[];this._label=null;this.syncTicks=null;this.tickSpacing=75;this._min=null;this._max=null;this._tickInterval=null;this._numberTicks=null;this.__ticks=null;this._options={}}
Axis.prototype=new $.jqplot.ElemContainer();Axis.prototype.constructor=Axis;Axis.prototype.init=function(){if($.isFunction(this.renderer)){this.renderer=new this.renderer()}
this.tickOptions.axis=this.name;if(this.tickOptions.showMark==null){this.tickOptions.showMark=this.showTicks}
if(this.tickOptions.showMark==null){this.tickOptions.showMark=this.showTickMarks}
if(this.tickOptions.showLabel==null){this.tickOptions.showLabel=this.showTicks}
if(this.label==null||this.label==''){this.showLabel=!1}
else{this.labelOptions.label=this.label}
if(this.showLabel==!1){this.labelOptions.show=!1}
if(this.pad==0){this.pad=1.0}
if(this.padMax==0){this.padMax=1.0}
if(this.padMin==0){this.padMin=1.0}
if(this.padMax==null){this.padMax=(this.pad-1)/2+1}
if(this.padMin==null){this.padMin=(this.pad-1)/2+1}
this.pad=this.padMax+this.padMin-1;if(this.min!=null||this.max!=null){this.autoscale=!1}
if(this.syncTicks==null&&this.name.indexOf('y')>-1){this.syncTicks=!0}
else if(this.syncTicks==null){this.syncTicks=!1}
this.renderer.init.call(this,this.rendererOptions)};Axis.prototype.draw=function(ctx,plot){if(this.__ticks){this.__ticks=null}
return this.renderer.draw.call(this,ctx,plot)};Axis.prototype.set=function(){this.renderer.set.call(this)};Axis.prototype.pack=function(pos,offsets){if(this.show){this.renderer.pack.call(this,pos,offsets)}
if(this._min==null){this._min=this.min;this._max=this.max;this._tickInterval=this.tickInterval;this._numberTicks=this.numberTicks;this.__ticks=this._ticks}};Axis.prototype.reset=function(){this.renderer.reset.call(this)};Axis.prototype.resetScale=function(opts){$.extend(!0,this,{min:null,max:null,numberTicks:null,tickInterval:null,_ticks:[],ticks:[]},opts);this.resetDataBounds()};Axis.prototype.resetDataBounds=function(){var db=this._dataBounds;db.min=null;db.max=null;var l,s,d;var doforce=(this.show)?!0:!1;for(var i=0;i<this._series.length;i++){s=this._series[i];if(s.show||this.scaleToHiddenSeries){d=s._plotData;if(s._type==='line'&&s.renderer.bands.show&&this.name.charAt(0)!=='x'){d=[[0,s.renderer.bands._min],[1,s.renderer.bands._max]]}
var minyidx=1,maxyidx=1;if(s._type!=null&&s._type=='ohlc'){minyidx=3;maxyidx=2}
for(var j=0,l=d.length;j<l;j++){if(this.name=='xaxis'||this.name=='x2axis'){if((d[j][0]!=null&&d[j][0]<db.min)||db.min==null){db.min=d[j][0]}
if((d[j][0]!=null&&d[j][0]>db.max)||db.max==null){db.max=d[j][0]}}
else{if((d[j][minyidx]!=null&&d[j][minyidx]<db.min)||db.min==null){db.min=d[j][minyidx]}
if((d[j][maxyidx]!=null&&d[j][maxyidx]>db.max)||db.max==null){db.max=d[j][maxyidx]}}}
if(doforce&&s.renderer.constructor!==$.jqplot.BarRenderer){doforce=!1}
else if(doforce&&this._options.hasOwnProperty('forceTickAt0')&&this._options.forceTickAt0==!1){doforce=!1}
else if(doforce&&s.renderer.constructor===$.jqplot.BarRenderer){if(s.barDirection=='vertical'&&this.name!='xaxis'&&this.name!='x2axis'){if(this._options.pad!=null||this._options.padMin!=null){doforce=!1}}
else if(s.barDirection=='horizontal'&&(this.name=='xaxis'||this.name=='x2axis')){if(this._options.pad!=null||this._options.padMin!=null){doforce=!1}}}}}
if(doforce&&this.renderer.constructor===$.jqplot.LinearAxisRenderer&&db.min>=0){this.padMin=1.0;this.forceTickAt0=!0}};function Legend(options){$.jqplot.ElemContainer.call(this);this.show=!1;this.location='ne';this.labels=[];this.showLabels=!0;this.showSwatches=!0;this.placement="insideGrid";this.xoffset=0;this.yoffset=0;this.border;this.background;this.textColor;this.fontFamily;this.fontSize;this.rowSpacing='0.5em';this.renderer=$.jqplot.TableLegendRenderer;this.rendererOptions={};this.preDraw=!1;this.marginTop=null;this.marginRight=null;this.marginBottom=null;this.marginLeft=null;this.escapeHtml=!1;this._series=[];$.extend(!0,this,options)}
Legend.prototype=new $.jqplot.ElemContainer();Legend.prototype.constructor=Legend;Legend.prototype.setOptions=function(options){$.extend(!0,this,options);if(this.placement=='inside'){this.placement='insideGrid'}
if(this.xoffset>0){if(this.placement=='insideGrid'){switch(this.location){case 'nw':case 'w':case 'sw':if(this.marginLeft==null){this.marginLeft=this.xoffset+'px'}
this.marginRight='0px';break;case 'ne':case 'e':case 'se':default:if(this.marginRight==null){this.marginRight=this.xoffset+'px'}
this.marginLeft='0px';break}}
else if(this.placement=='outside'){switch(this.location){case 'nw':case 'w':case 'sw':if(this.marginRight==null){this.marginRight=this.xoffset+'px'}
this.marginLeft='0px';break;case 'ne':case 'e':case 'se':default:if(this.marginLeft==null){this.marginLeft=this.xoffset+'px'}
this.marginRight='0px';break}}
this.xoffset=0}
if(this.yoffset>0){if(this.placement=='outside'){switch(this.location){case 'sw':case 's':case 'se':if(this.marginTop==null){this.marginTop=this.yoffset+'px'}
this.marginBottom='0px';break;case 'ne':case 'n':case 'nw':default:if(this.marginBottom==null){this.marginBottom=this.yoffset+'px'}
this.marginTop='0px';break}}
else if(this.placement=='insideGrid'){switch(this.location){case 'sw':case 's':case 'se':if(this.marginBottom==null){this.marginBottom=this.yoffset+'px'}
this.marginTop='0px';break;case 'ne':case 'n':case 'nw':default:if(this.marginTop==null){this.marginTop=this.yoffset+'px'}
this.marginBottom='0px';break}}
this.yoffset=0}};Legend.prototype.init=function(){if($.isFunction(this.renderer)){this.renderer=new this.renderer()}
this.renderer.init.call(this,this.rendererOptions)};Legend.prototype.draw=function(offsets,plot){for(var i=0;i<$.jqplot.preDrawLegendHooks.length;i++){$.jqplot.preDrawLegendHooks[i].call(this,offsets)}
return this.renderer.draw.call(this,offsets,plot)};Legend.prototype.pack=function(offsets){this.renderer.pack.call(this,offsets)};function Title(text){$.jqplot.ElemContainer.call(this);this.text=text;this.show=!0;this.fontFamily;this.fontSize;this.textAlign;this.textColor;this.renderer=$.jqplot.DivTitleRenderer;this.rendererOptions={};this.escapeHtml=!1}
Title.prototype=new $.jqplot.ElemContainer();Title.prototype.constructor=Title;Title.prototype.init=function(){if($.isFunction(this.renderer)){this.renderer=new this.renderer()}
this.renderer.init.call(this,this.rendererOptions)};Title.prototype.draw=function(width){return this.renderer.draw.call(this,width)};Title.prototype.pack=function(){this.renderer.pack.call(this)};function Series(options){options=options||{};$.jqplot.ElemContainer.call(this);this.show=!0;this.xaxis='xaxis';this._xaxis;this.yaxis='yaxis';this._yaxis;this.gridBorderWidth=2.0;this.renderer=$.jqplot.LineRenderer;this.rendererOptions={};this.data=[];this.gridData=[];this.label='';this.showLabel=!0;this.color;this.negativeColor;this.lineWidth=2.5;this.lineJoin='round';this.lineCap='round';this.linePattern='solid';this.shadow=!0;this.shadowAngle=45;this.shadowOffset=1.25;this.shadowDepth=3;this.shadowAlpha='0.1';this.breakOnNull=!1;this.markerRenderer=$.jqplot.MarkerRenderer;this.markerOptions={};this.showLine=!0;this.showMarker=!0;this.index;this.fill=!1;this.fillColor;this.fillAlpha;this.fillAndStroke=!1;this.disableStack=!1;this._stack=!1;this.neighborThreshold=4;this.fillToZero=!1;this.fillToValue=0;this.fillAxis='y';this.useNegativeColors=!0;this._stackData=[];this._plotData=[];this._plotValues={x:[],y:[]};this._intervals={x:{},y:{}};this._prevPlotData=[];this._prevGridData=[];this._stackAxis='y';this._primaryAxis='_xaxis';this.canvas=new $.jqplot.GenericCanvas();this.shadowCanvas=new $.jqplot.GenericCanvas();this.plugins={};this._sumy=0;this._sumx=0;this._type=''}
Series.prototype=new $.jqplot.ElemContainer();Series.prototype.constructor=Series;Series.prototype.init=function(index,gridbw,plot){this.index=index;this.gridBorderWidth=gridbw;var d=this.data;var temp=[],i,l;for(i=0,l=d.length;i<l;i++){if(!this.breakOnNull){if(d[i]==null||d[i][0]==null||d[i][1]==null){continue}
else{temp.push(d[i])}}
else{temp.push(d[i])}}
this.data=temp;if(!this.color){this.color=plot.colorGenerator.get(this.index)}
if(!this.negativeColor){this.negativeColor=plot.negativeColorGenerator.get(this.index)}
if(!this.fillColor){this.fillColor=this.color}
if(this.fillAlpha){var comp=$.jqplot.normalize2rgb(this.fillColor);var comp=$.jqplot.getColorComponents(comp);this.fillColor='rgba('+comp[0]+','+comp[1]+','+comp[2]+','+this.fillAlpha+')'}
if($.isFunction(this.renderer)){this.renderer=new this.renderer()}
this.renderer.init.call(this,this.rendererOptions,plot);this.markerRenderer=new this.markerRenderer();if(!this.markerOptions.color){this.markerOptions.color=this.color}
if(this.markerOptions.show==null){this.markerOptions.show=this.showMarker}
this.showMarker=this.markerOptions.show;this.markerRenderer.init(this.markerOptions)};Series.prototype.draw=function(sctx,opts,plot){var options=(opts==undefined)?{}:opts;sctx=(sctx==undefined)?this.canvas._ctx:sctx;var j,data,gridData;for(j=0;j<$.jqplot.preDrawSeriesHooks.length;j++){$.jqplot.preDrawSeriesHooks[j].call(this,sctx,options)}
if(this.show){this.renderer.setGridData.call(this,plot);if(!options.preventJqPlotSeriesDrawTrigger){$(sctx.canvas).trigger('jqplotSeriesDraw',[this.data,this.gridData])}
data=[];if(options.data){data=options.data}
else if(!this._stack){data=this.data}
else{data=this._plotData}
gridData=options.gridData||this.renderer.makeGridData.call(this,data,plot);if(this._type==='line'&&this.renderer.smooth&&this.renderer._smoothedData.length){gridData=this.renderer._smoothedData}
this.renderer.draw.call(this,sctx,gridData,options,plot)}
for(j=0;j<$.jqplot.postDrawSeriesHooks.length;j++){$.jqplot.postDrawSeriesHooks[j].call(this,sctx,options,plot)}
sctx=opts=plot=j=data=gridData=null};Series.prototype.drawShadow=function(sctx,opts,plot){var options=(opts==undefined)?{}:opts;sctx=(sctx==undefined)?this.shadowCanvas._ctx:sctx;var j,data,gridData;for(j=0;j<$.jqplot.preDrawSeriesShadowHooks.length;j++){$.jqplot.preDrawSeriesShadowHooks[j].call(this,sctx,options)}
if(this.shadow){this.renderer.setGridData.call(this,plot);data=[];if(options.data){data=options.data}
else if(!this._stack){data=this.data}
else{data=this._plotData}
gridData=options.gridData||this.renderer.makeGridData.call(this,data,plot);this.renderer.drawShadow.call(this,sctx,gridData,options,plot)}
for(j=0;j<$.jqplot.postDrawSeriesShadowHooks.length;j++){$.jqplot.postDrawSeriesShadowHooks[j].call(this,sctx,options)}
sctx=opts=plot=j=data=gridData=null};Series.prototype.toggleDisplay=function(ev,callback){var s,speed;if(ev.data.series){s=ev.data.series}
else{s=this}
if(ev.data.speed){speed=ev.data.speed}
if(speed){if(s.canvas._elem.is(':hidden')||!s.show){s.show=!0;s.canvas._elem.removeClass('jqplot-series-hidden');if(s.shadowCanvas._elem){s.shadowCanvas._elem.fadeIn(speed)}
s.canvas._elem.fadeIn(speed,callback);s.canvas._elem.nextAll('.jqplot-point-label.jqplot-series-'+s.index).fadeIn(speed)}
else{s.show=!1;s.canvas._elem.addClass('jqplot-series-hidden');if(s.shadowCanvas._elem){s.shadowCanvas._elem.fadeOut(speed)}
s.canvas._elem.fadeOut(speed,callback);s.canvas._elem.nextAll('.jqplot-point-label.jqplot-series-'+s.index).fadeOut(speed)}}
else{if(s.canvas._elem.is(':hidden')||!s.show){s.show=!0;s.canvas._elem.removeClass('jqplot-series-hidden');if(s.shadowCanvas._elem){s.shadowCanvas._elem.show()}
s.canvas._elem.show(0,callback);s.canvas._elem.nextAll('.jqplot-point-label.jqplot-series-'+s.index).show()}
else{s.show=!1;s.canvas._elem.addClass('jqplot-series-hidden');if(s.shadowCanvas._elem){s.shadowCanvas._elem.hide()}
s.canvas._elem.hide(0,callback);s.canvas._elem.nextAll('.jqplot-point-label.jqplot-series-'+s.index).hide()}}};function Grid(){$.jqplot.ElemContainer.call(this);this.drawGridlines=!0;this.gridLineColor='#cccccc';this.gridLineWidth=1.0;this.background='#fffdf6';this.borderColor='#999999';this.borderWidth=2.0;this.drawBorder=!0;this.shadow=!0;this.shadowAngle=45;this.shadowOffset=1.5;this.shadowWidth=3;this.shadowDepth=3;this.shadowColor=null;this.shadowAlpha='0.07';this._left;this._top;this._right;this._bottom;this._width;this._height;this._axes=[];this.renderer=$.jqplot.CanvasGridRenderer;this.rendererOptions={};this._offsets={top:null,bottom:null,left:null,right:null}}
Grid.prototype=new $.jqplot.ElemContainer();Grid.prototype.constructor=Grid;Grid.prototype.init=function(){if($.isFunction(this.renderer)){this.renderer=new this.renderer()}
this.renderer.init.call(this,this.rendererOptions)};Grid.prototype.createElement=function(offsets,plot){this._offsets=offsets;return this.renderer.createElement.call(this,plot)};Grid.prototype.draw=function(){this.renderer.draw.call(this)};$.jqplot.GenericCanvas=function(){$.jqplot.ElemContainer.call(this);this._ctx};$.jqplot.GenericCanvas.prototype=new $.jqplot.ElemContainer();$.jqplot.GenericCanvas.prototype.constructor=$.jqplot.GenericCanvas;$.jqplot.GenericCanvas.prototype.createElement=function(offsets,clss,plotDimensions,plot){this._offsets=offsets;var klass='jqplot';if(clss!=undefined){klass=clss}
var elem;elem=plot.canvasManager.getCanvas();if(plotDimensions!=null){this._plotDimensions=plotDimensions}
elem.width=this._plotDimensions.width-this._offsets.left-this._offsets.right;elem.height=this._plotDimensions.height-this._offsets.top-this._offsets.bottom;this._elem=$(elem);this._elem.css({position:'absolute',left:this._offsets.left,top:this._offsets.top});this._elem.addClass(klass);elem=plot.canvasManager.initCanvas(elem);elem=null;return this._elem};$.jqplot.GenericCanvas.prototype.setContext=function(){this._ctx=this._elem.get(0).getContext("2d");return this._ctx};$.jqplot.GenericCanvas.prototype.resetCanvas=function(){if(this._elem){if($.jqplot.use_excanvas&&window.G_vmlCanvasManager.uninitElement!==undefined){window.G_vmlCanvasManager.uninitElement(this._elem.get(0))}
this._elem.emptyForce()}
this._ctx=null};$.jqplot.HooksManager=function(){this.hooks=[];this.args=[]};$.jqplot.HooksManager.prototype.addOnce=function(fn,args){args=args||[];var havehook=!1;for(var i=0,l=this.hooks.length;i<l;i++){if(this.hooks[i]==fn){havehook=!0}}
if(!havehook){this.hooks.push(fn);this.args.push(args)}};$.jqplot.HooksManager.prototype.add=function(fn,args){args=args||[];this.hooks.push(fn);this.args.push(args)};$.jqplot.EventListenerManager=function(){this.hooks=[]};$.jqplot.EventListenerManager.prototype.addOnce=function(ev,fn){var havehook=!1,h,i;for(var i=0,l=this.hooks.length;i<l;i++){h=this.hooks[i];if(h[0]==ev&&h[1]==fn){havehook=!0}}
if(!havehook){this.hooks.push([ev,fn])}};$.jqplot.EventListenerManager.prototype.add=function(ev,fn){this.hooks.push([ev,fn])};var _axisNames=['yMidAxis','xaxis','yaxis','x2axis','y2axis','y3axis','y4axis','y5axis','y6axis','y7axis','y8axis','y9axis'];function jqPlot(){this.animate=!1;this.animateReplot=!1;this.axes={xaxis:new Axis('xaxis'),yaxis:new Axis('yaxis'),x2axis:new Axis('x2axis'),y2axis:new Axis('y2axis'),y3axis:new Axis('y3axis'),y4axis:new Axis('y4axis'),y5axis:new Axis('y5axis'),y6axis:new Axis('y6axis'),y7axis:new Axis('y7axis'),y8axis:new Axis('y8axis'),y9axis:new Axis('y9axis'),yMidAxis:new Axis('yMidAxis')};this.baseCanvas=new $.jqplot.GenericCanvas();this.captureRightClick=!1;this.data=[];this.dataRenderer;this.dataRendererOptions;this.defaults={axesDefaults:{},axes:{xaxis:{},yaxis:{},x2axis:{},y2axis:{},y3axis:{},y4axis:{},y5axis:{},y6axis:{},y7axis:{},y8axis:{},y9axis:{},yMidAxis:{}},seriesDefaults:{},series:[]};this.defaultAxisStart=1;this.drawIfHidden=!1;this.eventCanvas=new $.jqplot.GenericCanvas();this.fillBetween={series1:null,series2:null,color:null,baseSeries:0,fill:!0};this.fontFamily;this.fontSize;this.grid=new Grid();this.legend=new Legend();this.noDataIndicator={show:!1,indicator:'Loading Data...',axes:{xaxis:{min:0,max:10,tickInterval:2,show:!0},yaxis:{min:0,max:12,tickInterval:3,show:!0}}};this.negativeSeriesColors=$.jqplot.config.defaultNegativeColors;this.options={};this.previousSeriesStack=[];this.plugins={};this.series=[];this.seriesStack=[];this.seriesColors=$.jqplot.config.defaultColors;this.sortData=!0;this.stackSeries=!1;this.syncXTicks=!0;this.syncYTicks=!0;this.target=null;this.targetId=null;this.textColor;this.title=new Title();this._drawCount=0;this._sumy=0;this._sumx=0;this._stackData=[];this._plotData=[];this._width=null;this._height=null;this._plotDimensions={height:null,width:null};this._gridPadding={top:null,right:null,bottom:null,left:null};this._defaultGridPadding={top:10,right:10,bottom:23,left:10};this._addDomReference=$.jqplot.config.addDomReference;this.preInitHooks=new $.jqplot.HooksManager();this.postInitHooks=new $.jqplot.HooksManager();this.preParseOptionsHooks=new $.jqplot.HooksManager();this.postParseOptionsHooks=new $.jqplot.HooksManager();this.preDrawHooks=new $.jqplot.HooksManager();this.postDrawHooks=new $.jqplot.HooksManager();this.preDrawSeriesHooks=new $.jqplot.HooksManager();this.postDrawSeriesHooks=new $.jqplot.HooksManager();this.preDrawLegendHooks=new $.jqplot.HooksManager();this.addLegendRowHooks=new $.jqplot.HooksManager();this.preSeriesInitHooks=new $.jqplot.HooksManager();this.postSeriesInitHooks=new $.jqplot.HooksManager();this.preParseSeriesOptionsHooks=new $.jqplot.HooksManager();this.postParseSeriesOptionsHooks=new $.jqplot.HooksManager();this.eventListenerHooks=new $.jqplot.EventListenerManager();this.preDrawSeriesShadowHooks=new $.jqplot.HooksManager();this.postDrawSeriesShadowHooks=new $.jqplot.HooksManager();this.colorGenerator=new $.jqplot.ColorGenerator();this.negativeColorGenerator=new $.jqplot.ColorGenerator();this.canvasManager=new $.jqplot.CanvasManager();this.themeEngine=new $.jqplot.ThemeEngine();var seriesColorsIndex=0;this.init=function(target,data,options){options=options||{};for(var i=0;i<$.jqplot.preInitHooks.length;i++){$.jqplot.preInitHooks[i].call(this,target,data,options)}
for(var i=0;i<this.preInitHooks.hooks.length;i++){this.preInitHooks.hooks[i].call(this,target,data,options)}
this.targetId='#'+target;this.target=$('#'+target);if(this._addDomReference){this.target.data('jqplot',this)}
this.target.removeClass('jqplot-error');if(!this.target.get(0)){throw new Error("No plot target specified")}
if(this.target.css('position')=='static'){this.target.css('position','relative')}
if(!this.target.hasClass('jqplot-target')){this.target.addClass('jqplot-target')}
if(!this.target.height()){var h;if(options&&options.height){h=parseInt(options.height,10)}
else if(this.target.attr('data-height')){h=parseInt(this.target.attr('data-height'),10)}
else{h=parseInt($.jqplot.config.defaultHeight,10)}
this._height=h;this.target.css('height',h+'px')}
else{this._height=h=this.target.height()}
if(!this.target.width()){var w;if(options&&options.width){w=parseInt(options.width,10)}
else if(this.target.attr('data-width')){w=parseInt(this.target.attr('data-width'),10)}
else{w=parseInt($.jqplot.config.defaultWidth,10)}
this._width=w;this.target.css('width',w+'px')}
else{this._width=w=this.target.width()}
for(var i=0,l=_axisNames.length;i<l;i++){this.axes[_axisNames[i]]=new Axis(_axisNames[i])}
this._plotDimensions.height=this._height;this._plotDimensions.width=this._width;this.grid._plotDimensions=this._plotDimensions;this.title._plotDimensions=this._plotDimensions;this.baseCanvas._plotDimensions=this._plotDimensions;this.eventCanvas._plotDimensions=this._plotDimensions;this.legend._plotDimensions=this._plotDimensions;if(this._height<=0||this._width<=0||!this._height||!this._width){throw new Error("Canvas dimension not set")}
if(options.dataRenderer&&$.isFunction(options.dataRenderer)){if(options.dataRendererOptions){this.dataRendererOptions=options.dataRendererOptions}
this.dataRenderer=options.dataRenderer;data=this.dataRenderer(data,this,this.dataRendererOptions)}
if(options.noDataIndicator&&$.isPlainObject(options.noDataIndicator)){$.extend(!0,this.noDataIndicator,options.noDataIndicator)}
if(data==null||$.isArray(data)==!1||data.length==0||$.isArray(data[0])==!1||data[0].length==0){if(this.noDataIndicator.show==!1){throw new Error("No data specified")}
else{for(var ax in this.noDataIndicator.axes){for(var prop in this.noDataIndicator.axes[ax]){this.axes[ax][prop]=this.noDataIndicator.axes[ax][prop]}}
this.postDrawHooks.add(function(){var eh=this.eventCanvas.getHeight();var ew=this.eventCanvas.getWidth();var temp=$('<div class="jqplot-noData-container" style="position:absolute;"></div>');this.target.append(temp);temp.height(eh);temp.width(ew);temp.css('top',this.eventCanvas._offsets.top);temp.css('left',this.eventCanvas._offsets.left);var temp2=$('<div class="jqplot-noData-contents" style="text-align:center; position:relative; margin-left:auto; margin-right:auto;"></div>');temp.append(temp2);temp2.html(this.noDataIndicator.indicator);var th=temp2.height();var tw=temp2.width();temp2.height(th);temp2.width(tw);temp2.css('top',(eh-th)/2+'px')})}}
this.data=$.extend(!0,[],data);this.parseOptions(options);if(this.textColor){this.target.css('color',this.textColor)}
if(this.fontFamily){this.target.css('font-family',this.fontFamily)}
if(this.fontSize){this.target.css('font-size',this.fontSize)}
this.title.init();this.legend.init();this._sumy=0;this._sumx=0;this.computePlotData();for(var i=0;i<this.series.length;i++){this.seriesStack.push(i);this.previousSeriesStack.push(i);this.series[i].shadowCanvas._plotDimensions=this._plotDimensions;this.series[i].canvas._plotDimensions=this._plotDimensions;for(var j=0;j<$.jqplot.preSeriesInitHooks.length;j++){$.jqplot.preSeriesInitHooks[j].call(this.series[i],target,this.data,this.options.seriesDefaults,this.options.series[i],this)}
for(var j=0;j<this.preSeriesInitHooks.hooks.length;j++){this.preSeriesInitHooks.hooks[j].call(this.series[i],target,this.data,this.options.seriesDefaults,this.options.series[i],this)}
this.series[i]._plotDimensions=this._plotDimensions;this.series[i].init(i,this.grid.borderWidth,this);for(var j=0;j<$.jqplot.postSeriesInitHooks.length;j++){$.jqplot.postSeriesInitHooks[j].call(this.series[i],target,this.data,this.options.seriesDefaults,this.options.series[i],this)}
for(var j=0;j<this.postSeriesInitHooks.hooks.length;j++){this.postSeriesInitHooks.hooks[j].call(this.series[i],target,this.data,this.options.seriesDefaults,this.options.series[i],this)}
this._sumy+=this.series[i]._sumy;this._sumx+=this.series[i]._sumx}
var name,axis;for(var i=0,l=_axisNames.length;i<l;i++){name=_axisNames[i];axis=this.axes[name];axis._plotDimensions=this._plotDimensions;axis.init();if(this.axes[name].borderColor==null){if(name.charAt(0)!=='x'&&axis.useSeriesColor===!0&&axis.show){axis.borderColor=axis._series[0].color}
else{axis.borderColor=this.grid.borderColor}}}
if(this.sortData){sortData(this.series)}
this.grid.init();this.grid._axes=this.axes;this.legend._series=this.series;for(var i=0;i<$.jqplot.postInitHooks.length;i++){$.jqplot.postInitHooks[i].call(this,target,this.data,options)}
for(var i=0;i<this.postInitHooks.hooks.length;i++){this.postInitHooks.hooks[i].call(this,target,this.data,options)}};this.resetAxesScale=function(axes,options){var opts=options||{};var ax=axes||this.axes;if(ax===!0){ax=this.axes}
if($.isArray(ax)){for(var i=0;i<ax.length;i++){this.axes[ax[i]].resetScale(opts[ax[i]])}}
else if(typeof(ax)==='object'){for(var name in ax){this.axes[name].resetScale(opts[name])}}};this.reInitialize=function(data,opts){var options=$.extend(!0,{},this.options,opts);var target=this.targetId.substr(1);var tdata=(data==null)?this.data:data;for(var i=0;i<$.jqplot.preInitHooks.length;i++){$.jqplot.preInitHooks[i].call(this,target,tdata,options)}
for(var i=0;i<this.preInitHooks.hooks.length;i++){this.preInitHooks.hooks[i].call(this,target,tdata,options)}
this._height=this.target.height();this._width=this.target.width();if(this._height<=0||this._width<=0||!this._height||!this._width){throw new Error("Target dimension not set")}
this._plotDimensions.height=this._height;this._plotDimensions.width=this._width;this.grid._plotDimensions=this._plotDimensions;this.title._plotDimensions=this._plotDimensions;this.baseCanvas._plotDimensions=this._plotDimensions;this.eventCanvas._plotDimensions=this._plotDimensions;this.legend._plotDimensions=this._plotDimensions;var name,t,j,axis;for(var i=0,l=_axisNames.length;i<l;i++){name=_axisNames[i];axis=this.axes[name];t=axis._ticks;for(var j=0,tlen=t.length;j<tlen;j++){var el=t[j]._elem;if(el){if($.jqplot.use_excanvas&&window.G_vmlCanvasManager.uninitElement!==undefined){window.G_vmlCanvasManager.uninitElement(el.get(0))}
el.emptyForce();el=null;t._elem=null}}
t=null;delete axis.ticks;delete axis._ticks;this.axes[name]=new Axis(name);this.axes[name]._plotWidth=this._width;this.axes[name]._plotHeight=this._height}
if(data){if(options.dataRenderer&&$.isFunction(options.dataRenderer)){if(options.dataRendererOptions){this.dataRendererOptions=options.dataRendererOptions}
this.dataRenderer=options.dataRenderer;data=this.dataRenderer(data,this,this.dataRendererOptions)}
this.data=$.extend(!0,[],data)}
if(opts){this.parseOptions(options)}
this.title._plotWidth=this._width;if(this.textColor){this.target.css('color',this.textColor)}
if(this.fontFamily){this.target.css('font-family',this.fontFamily)}
if(this.fontSize){this.target.css('font-size',this.fontSize)}
this.title.init();this.legend.init();this._sumy=0;this._sumx=0;this.seriesStack=[];this.previousSeriesStack=[];this.computePlotData();for(var i=0,l=this.series.length;i<l;i++){this.seriesStack.push(i);this.previousSeriesStack.push(i);this.series[i].shadowCanvas._plotDimensions=this._plotDimensions;this.series[i].canvas._plotDimensions=this._plotDimensions;for(var j=0;j<$.jqplot.preSeriesInitHooks.length;j++){$.jqplot.preSeriesInitHooks[j].call(this.series[i],target,this.data,this.options.seriesDefaults,this.options.series[i],this)}
for(var j=0;j<this.preSeriesInitHooks.hooks.length;j++){this.preSeriesInitHooks.hooks[j].call(this.series[i],target,this.data,this.options.seriesDefaults,this.options.series[i],this)}
this.series[i]._plotDimensions=this._plotDimensions;this.series[i].init(i,this.grid.borderWidth,this);for(var j=0;j<$.jqplot.postSeriesInitHooks.length;j++){$.jqplot.postSeriesInitHooks[j].call(this.series[i],target,this.data,this.options.seriesDefaults,this.options.series[i],this)}
for(var j=0;j<this.postSeriesInitHooks.hooks.length;j++){this.postSeriesInitHooks.hooks[j].call(this.series[i],target,this.data,this.options.seriesDefaults,this.options.series[i],this)}
this._sumy+=this.series[i]._sumy;this._sumx+=this.series[i]._sumx}
for(var i=0,l=_axisNames.length;i<l;i++){name=_axisNames[i];axis=this.axes[name];axis._plotDimensions=this._plotDimensions;axis.init();if(axis.borderColor==null){if(name.charAt(0)!=='x'&&axis.useSeriesColor===!0&&axis.show){axis.borderColor=axis._series[0].color}
else{axis.borderColor=this.grid.borderColor}}}
if(this.sortData){sortData(this.series)}
this.grid.init();this.grid._axes=this.axes;this.legend._series=this.series;for(var i=0,l=$.jqplot.postInitHooks.length;i<l;i++){$.jqplot.postInitHooks[i].call(this,target,this.data,options)}
for(var i=0,l=this.postInitHooks.hooks.length;i<l;i++){this.postInitHooks.hooks[i].call(this,target,this.data,options)}};this.quickInit=function(){this._height=this.target.height();this._width=this.target.width();if(this._height<=0||this._width<=0||!this._height||!this._width){throw new Error("Target dimension not set")}
this._plotDimensions.height=this._height;this._plotDimensions.width=this._width;this.grid._plotDimensions=this._plotDimensions;this.title._plotDimensions=this._plotDimensions;this.baseCanvas._plotDimensions=this._plotDimensions;this.eventCanvas._plotDimensions=this._plotDimensions;this.legend._plotDimensions=this._plotDimensions;for(var n in this.axes){this.axes[n]._plotWidth=this._width;this.axes[n]._plotHeight=this._height}
this.title._plotWidth=this._width;if(this.textColor){this.target.css('color',this.textColor)}
if(this.fontFamily){this.target.css('font-family',this.fontFamily)}
if(this.fontSize){this.target.css('font-size',this.fontSize)}
this._sumy=0;this._sumx=0;this.computePlotData();for(var i=0;i<this.series.length;i++){if(this.series[i]._type==='line'&&this.series[i].renderer.bands.show){this.series[i].renderer.initBands.call(this.series[i],this.series[i].renderer.options,this)}
this.series[i]._plotDimensions=this._plotDimensions;this.series[i].canvas._plotDimensions=this._plotDimensions;this._sumy+=this.series[i]._sumy;this._sumx+=this.series[i]._sumx}
var name;for(var j=0;j<12;j++){name=_axisNames[j];var t=this.axes[name]._ticks;for(var i=0;i<t.length;i++){var el=t[i]._elem;if(el){if($.jqplot.use_excanvas&&window.G_vmlCanvasManager.uninitElement!==undefined){window.G_vmlCanvasManager.uninitElement(el.get(0))}
el.emptyForce();el=null;t._elem=null}}
t=null;this.axes[name]._plotDimensions=this._plotDimensions;this.axes[name]._ticks=[]}
if(this.sortData){sortData(this.series)}
this.grid._axes=this.axes;this.legend._series=this.series};function sortData(series){var d,sd,pd,ppd,ret;for(var i=0;i<series.length;i++){var check;var bat=[series[i].data,series[i]._stackData,series[i]._plotData,series[i]._prevPlotData];for(var n=0;n<4;n++){check=!0;d=bat[n];if(series[i]._stackAxis=='x'){for(var j=0;j<d.length;j++){if(typeof(d[j][1])!="number"){check=!1;break}}
if(check){d.sort(function(a,b){return a[1]-b[1]})}}
else{for(var j=0;j<d.length;j++){if(typeof(d[j][0])!="number"){check=!1;break}}
if(check){d.sort(function(a,b){return a[0]-b[0]})}}}}}
this.computePlotData=function(){this._plotData=[];this._stackData=[];var series,index,l;for(index=0,l=this.series.length;index<l;index++){series=this.series[index];this._plotData.push([]);this._stackData.push([]);var cd=series.data;this._plotData[index]=$.extend(!0,[],cd);this._stackData[index]=$.extend(!0,[],cd);series._plotData=this._plotData[index];series._stackData=this._stackData[index];var plotValues={x:[],y:[]};if(this.stackSeries&&!series.disableStack){series._stack=!0;var sidx=(series._stackAxis==='x')?0:1;for(var k=0,cdl=cd.length;k<cdl;k++){var temp=cd[k][sidx];if(temp==null){temp=0}
this._plotData[index][k][sidx]=temp;this._stackData[index][k][sidx]=temp;if(index>0){for(var j=index;j--;){var prevval=this._plotData[j][k][sidx];if(temp*prevval>=0){this._plotData[index][k][sidx]+=prevval;this._stackData[index][k][sidx]+=prevval;break}}}}}
else{for(var i=0;i<series.data.length;i++){plotValues.x.push(series.data[i][0]);plotValues.y.push(series.data[i][1])}
this._stackData.push(series.data);this.series[index]._stackData=series.data;this._plotData.push(series.data);series._plotData=series.data;series._plotValues=plotValues}
if(index>0){series._prevPlotData=this.series[index-1]._plotData}
series._sumy=0;series._sumx=0;for(i=series.data.length-1;i>-1;i--){series._sumy+=series.data[i][1];series._sumx+=series.data[i][0]}}};this.populatePlotData=function(series,index){this._plotData=[];this._stackData=[];series._stackData=[];series._plotData=[];var plotValues={x:[],y:[]};if(this.stackSeries&&!series.disableStack){series._stack=!0;var sidx=(series._stackAxis==='x')?0:1;var temp=$.extend(!0,[],series.data);var plotdata=$.extend(!0,[],series.data);var tempx,tempy,dval,stackval,comparator;for(var j=0;j<index;j++){var cd=this.series[j].data;for(var k=0;k<cd.length;k++){dval=cd[k];tempx=(dval[0]!=null)?dval[0]:0;tempy=(dval[1]!=null)?dval[1]:0;temp[k][0]+=tempx;temp[k][1]+=tempy;stackval=(sidx)?tempy:tempx;if(series.data[k][sidx]*stackval>=0){plotdata[k][sidx]+=stackval}}}
for(var i=0;i<plotdata.length;i++){plotValues.x.push(plotdata[i][0]);plotValues.y.push(plotdata[i][1])}
this._plotData.push(plotdata);this._stackData.push(temp);series._stackData=temp;series._plotData=plotdata;series._plotValues=plotValues}
else{for(var i=0;i<series.data.length;i++){plotValues.x.push(series.data[i][0]);plotValues.y.push(series.data[i][1])}
this._stackData.push(series.data);this.series[index]._stackData=series.data;this._plotData.push(series.data);series._plotData=series.data;series._plotValues=plotValues}
if(index>0){series._prevPlotData=this.series[index-1]._plotData}
series._sumy=0;series._sumx=0;for(i=series.data.length-1;i>-1;i--){series._sumy+=series.data[i][1];series._sumx+=series.data[i][0]}};this.getNextSeriesColor=(function(t){var idx=0;var sc=t.seriesColors;return function(){if(idx<sc.length){return sc[idx++]}
else{idx=0;return sc[idx++]}}})(this);this.parseOptions=function(options){for(var i=0;i<this.preParseOptionsHooks.hooks.length;i++){this.preParseOptionsHooks.hooks[i].call(this,options)}
for(var i=0;i<$.jqplot.preParseOptionsHooks.length;i++){$.jqplot.preParseOptionsHooks[i].call(this,options)}
this.options=$.extend(!0,{},this.defaults,options);var opts=this.options;this.animate=opts.animate;this.animateReplot=opts.animateReplot;this.stackSeries=opts.stackSeries;if($.isPlainObject(opts.fillBetween)){var temp=['series1','series2','color','baseSeries','fill'],tempi;for(var i=0,l=temp.length;i<l;i++){tempi=temp[i];if(opts.fillBetween[tempi]!=null){this.fillBetween[tempi]=opts.fillBetween[tempi]}}}
if(opts.seriesColors){this.seriesColors=opts.seriesColors}
if(opts.negativeSeriesColors){this.negativeSeriesColors=opts.negativeSeriesColors}
if(opts.captureRightClick){this.captureRightClick=opts.captureRightClick}
this.defaultAxisStart=(options&&options.defaultAxisStart!=null)?options.defaultAxisStart:this.defaultAxisStart;this.colorGenerator.setColors(this.seriesColors);this.negativeColorGenerator.setColors(this.negativeSeriesColors);$.extend(!0,this._gridPadding,opts.gridPadding);this.sortData=(opts.sortData!=null)?opts.sortData:this.sortData;for(var i=0;i<12;i++){var n=_axisNames[i];var axis=this.axes[n];axis._options=$.extend(!0,{},opts.axesDefaults,opts.axes[n]);$.extend(!0,axis,opts.axesDefaults,opts.axes[n]);axis._plotWidth=this._width;axis._plotHeight=this._height}
var normalizeData=function(data,dir,start){var temp=[];var i,l;dir=dir||'vertical';if(!$.isArray(data[0])){for(i=0,l=data.length;i<l;i++){if(dir=='vertical'){temp.push([start+i,data[i]])}
else{temp.push([data[i],start+i])}}}
else{$.extend(!0,temp,data)}
return temp};var colorIndex=0;this.series=[];for(var i=0;i<this.data.length;i++){var sopts=$.extend(!0,{index:i},{seriesColors:this.seriesColors,negativeSeriesColors:this.negativeSeriesColors},this.options.seriesDefaults,this.options.series[i],{rendererOptions:{animation:{show:this.animate}}});var temp=new Series(sopts);for(var j=0;j<$.jqplot.preParseSeriesOptionsHooks.length;j++){$.jqplot.preParseSeriesOptionsHooks[j].call(temp,this.options.seriesDefaults,this.options.series[i])}
for(var j=0;j<this.preParseSeriesOptionsHooks.hooks.length;j++){this.preParseSeriesOptionsHooks.hooks[j].call(temp,this.options.seriesDefaults,this.options.series[i])}
$.extend(!0,temp,sopts);var dir='vertical';if(temp.renderer===$.jqplot.BarRenderer&&temp.rendererOptions&&temp.rendererOptions.barDirection=='horizontal'){dir='horizontal';temp._stackAxis='x';temp._primaryAxis='_yaxis'}
temp.data=normalizeData(this.data[i],dir,this.defaultAxisStart);switch(temp.xaxis){case 'xaxis':temp._xaxis=this.axes.xaxis;break;case 'x2axis':temp._xaxis=this.axes.x2axis;break;default:break}
temp._yaxis=this.axes[temp.yaxis];temp._xaxis._series.push(temp);temp._yaxis._series.push(temp);if(temp.show){temp._xaxis.show=!0;temp._yaxis.show=!0}
else{if(temp._xaxis.scaleToHiddenSeries){temp._xaxis.show=!0}
if(temp._yaxis.scaleToHiddenSeries){temp._yaxis.show=!0}}
if(!temp.label){temp.label='Series '+(i+1).toString()}
this.series.push(temp);for(var j=0;j<$.jqplot.postParseSeriesOptionsHooks.length;j++){$.jqplot.postParseSeriesOptionsHooks[j].call(this.series[i],this.options.seriesDefaults,this.options.series[i])}
for(var j=0;j<this.postParseSeriesOptionsHooks.hooks.length;j++){this.postParseSeriesOptionsHooks.hooks[j].call(this.series[i],this.options.seriesDefaults,this.options.series[i])}}
$.extend(!0,this.grid,this.options.grid);for(var i=0,l=_axisNames.length;i<l;i++){var n=_axisNames[i];var axis=this.axes[n];if(axis.borderWidth==null){axis.borderWidth=this.grid.borderWidth}}
if(typeof this.options.title=='string'){this.title.text=this.options.title}
else if(typeof this.options.title=='object'){$.extend(!0,this.title,this.options.title)}
this.title._plotWidth=this._width;this.legend.setOptions(this.options.legend);for(var i=0;i<$.jqplot.postParseOptionsHooks.length;i++){$.jqplot.postParseOptionsHooks[i].call(this,options)}
for(var i=0;i<this.postParseOptionsHooks.hooks.length;i++){this.postParseOptionsHooks.hooks[i].call(this,options)}};this.destroy=function(){this.canvasManager.freeAllCanvases();if(this.eventCanvas&&this.eventCanvas._elem){this.eventCanvas._elem.unbind()}
this.target.empty();this.target[0].innerHTML=''};this.replot=function(options){var opts=options||{};var data=opts.data||null;var clear=(opts.clear===!1)?!1:!0;var resetAxes=opts.resetAxes||!1;delete opts.data;delete opts.clear;delete opts.resetAxes;this.target.trigger('jqplotPreReplot');if(clear){this.destroy()}
if(data||!$.isEmptyObject(opts)){this.reInitialize(data,opts)}
else{this.quickInit()}
if(resetAxes){this.resetAxesScale(resetAxes,opts.axes)}
this.draw();this.target.trigger('jqplotPostReplot')};this.redraw=function(clear){clear=(clear!=null)?clear:!0;this.target.trigger('jqplotPreRedraw');if(clear){this.canvasManager.freeAllCanvases();this.eventCanvas._elem.unbind();this.target.empty()}
for(var ax in this.axes){this.axes[ax]._ticks=[]}
this.computePlotData();this._sumy=0;this._sumx=0;for(var i=0,tsl=this.series.length;i<tsl;i++){this._sumy+=this.series[i]._sumy;this._sumx+=this.series[i]._sumx}
this.draw();this.target.trigger('jqplotPostRedraw')};this.draw=function(){if(this.drawIfHidden||this.target.is(':visible')){this.target.trigger('jqplotPreDraw');var i,j,l,tempseries;for(i=0,l=$.jqplot.preDrawHooks.length;i<l;i++){$.jqplot.preDrawHooks[i].call(this)}
for(i=0,l=this.preDrawHooks.hooks.length;i<l;i++){this.preDrawHooks.hooks[i].apply(this,this.preDrawSeriesHooks.args[i])}
this.target.append(this.baseCanvas.createElement({left:0,right:0,top:0,bottom:0},'jqplot-base-canvas',null,this));this.baseCanvas.setContext();this.target.append(this.title.draw());this.title.pack({top:0,left:0});var legendElem=this.legend.draw({},this);var gridPadding={top:0,left:0,bottom:0,right:0};if(this.legend.placement=="outsideGrid"){this.target.append(legendElem);switch(this.legend.location){case 'n':gridPadding.top+=this.legend.getHeight();break;case 's':gridPadding.bottom+=this.legend.getHeight();break;case 'ne':case 'e':case 'se':gridPadding.right+=this.legend.getWidth();break;case 'nw':case 'w':case 'sw':gridPadding.left+=this.legend.getWidth();break;default:gridPadding.right+=this.legend.getWidth();break}
legendElem=legendElem.detach()}
var ax=this.axes;var name;for(i=0;i<12;i++){name=_axisNames[i];this.target.append(ax[name].draw(this.baseCanvas._ctx,this));ax[name].set()}
if(ax.yaxis.show){gridPadding.left+=ax.yaxis.getWidth()}
var ra=['y2axis','y3axis','y4axis','y5axis','y6axis','y7axis','y8axis','y9axis'];var rapad=[0,0,0,0,0,0,0,0];var gpr=0;var n;for(n=0;n<8;n++){if(ax[ra[n]].show){gpr+=ax[ra[n]].getWidth();rapad[n]=gpr}}
gridPadding.right+=gpr;if(ax.x2axis.show){gridPadding.top+=ax.x2axis.getHeight()}
if(this.title.show){gridPadding.top+=this.title.getHeight()}
if(ax.xaxis.show){gridPadding.bottom+=ax.xaxis.getHeight()}
if(this.options.gridDimensions&&$.isPlainObject(this.options.gridDimensions)){var gdw=parseInt(this.options.gridDimensions.width,10)||0;var gdh=parseInt(this.options.gridDimensions.height,10)||0;var widthAdj=(this._width-gridPadding.left-gridPadding.right-gdw)/2;var heightAdj=(this._height-gridPadding.top-gridPadding.bottom-gdh)/2;if(heightAdj>=0&&widthAdj>=0){gridPadding.top+=heightAdj;gridPadding.bottom+=heightAdj;gridPadding.left+=widthAdj;gridPadding.right+=widthAdj}}
var arr=['top','bottom','left','right'];for(var n in arr){if(this._gridPadding[arr[n]]==null&&gridPadding[arr[n]]>0){this._gridPadding[arr[n]]=gridPadding[arr[n]]}
else if(this._gridPadding[arr[n]]==null){this._gridPadding[arr[n]]=this._defaultGridPadding[arr[n]]}}
var legendPadding=this._gridPadding;if(this.legend.placement==='outsideGrid'){legendPadding={top:this.title.getHeight(),left:0,right:0,bottom:0};if(this.legend.location==='s'){legendPadding.left=this._gridPadding.left;legendPadding.right=this._gridPadding.right}}
ax.xaxis.pack({position:'absolute',bottom:this._gridPadding.bottom-ax.xaxis.getHeight(),left:0,width:this._width},{min:this._gridPadding.left,max:this._width-this._gridPadding.right});ax.yaxis.pack({position:'absolute',top:0,left:this._gridPadding.left-ax.yaxis.getWidth(),height:this._height},{min:this._height-this._gridPadding.bottom,max:this._gridPadding.top});ax.x2axis.pack({position:'absolute',top:this._gridPadding.top-ax.x2axis.getHeight(),left:0,width:this._width},{min:this._gridPadding.left,max:this._width-this._gridPadding.right});for(i=8;i>0;i--){ax[ra[i-1]].pack({position:'absolute',top:0,right:this._gridPadding.right-rapad[i-1]},{min:this._height-this._gridPadding.bottom,max:this._gridPadding.top})}
var ltemp=(this._width-this._gridPadding.left-this._gridPadding.right)/2.0+this._gridPadding.left-ax.yMidAxis.getWidth()/2.0;ax.yMidAxis.pack({position:'absolute',top:0,left:ltemp,zIndex:9,textAlign:'center'},{min:this._height-this._gridPadding.bottom,max:this._gridPadding.top});this.target.append(this.grid.createElement(this._gridPadding,this));this.grid.draw();var series=this.series;var seriesLength=series.length;for(i=0,l=seriesLength;i<l;i++){j=this.seriesStack[i];this.target.append(series[j].shadowCanvas.createElement(this._gridPadding,'jqplot-series-shadowCanvas',null,this));series[j].shadowCanvas.setContext();series[j].shadowCanvas._elem.data('seriesIndex',j)}
for(i=0,l=seriesLength;i<l;i++){j=this.seriesStack[i];this.target.append(series[j].canvas.createElement(this._gridPadding,'jqplot-series-canvas',null,this));series[j].canvas.setContext();series[j].canvas._elem.data('seriesIndex',j)}
this.target.append(this.eventCanvas.createElement(this._gridPadding,'jqplot-event-canvas',null,this));this.eventCanvas.setContext();this.eventCanvas._ctx.fillStyle='rgba(0,0,0,0)';this.eventCanvas._ctx.fillRect(0,0,this.eventCanvas._ctx.canvas.width,this.eventCanvas._ctx.canvas.height);this.bindCustomEvents();if(this.legend.preDraw){this.eventCanvas._elem.before(legendElem);this.legend.pack(legendPadding);if(this.legend._elem){this.drawSeries({legendInfo:{location:this.legend.location,placement:this.legend.placement,width:this.legend.getWidth(),height:this.legend.getHeight(),xoffset:this.legend.xoffset,yoffset:this.legend.yoffset}})}
else{this.drawSeries()}}
else{this.drawSeries();if(seriesLength){$(series[seriesLength-1].canvas._elem).after(legendElem)}
this.legend.pack(legendPadding)}
for(var i=0,l=$.jqplot.eventListenerHooks.length;i<l;i++){this.eventCanvas._elem.bind($.jqplot.eventListenerHooks[i][0],{plot:this},$.jqplot.eventListenerHooks[i][1])}
for(var i=0,l=this.eventListenerHooks.hooks.length;i<l;i++){this.eventCanvas._elem.bind(this.eventListenerHooks.hooks[i][0],{plot:this},this.eventListenerHooks.hooks[i][1])}
var fb=this.fillBetween;if(fb.fill&&fb.series1!==fb.series2&&fb.series1<seriesLength&&fb.series2<seriesLength&&series[fb.series1]._type==='line'&&series[fb.series2]._type==='line'){this.doFillBetweenLines()}
for(var i=0,l=$.jqplot.postDrawHooks.length;i<l;i++){$.jqplot.postDrawHooks[i].call(this)}
for(var i=0,l=this.postDrawHooks.hooks.length;i<l;i++){this.postDrawHooks.hooks[i].apply(this,this.postDrawHooks.args[i])}
if(this.target.is(':visible')){this._drawCount+=1}
var temps,tempr,sel,_els;for(i=0,l=seriesLength;i<l;i++){temps=series[i];tempr=temps.renderer;sel='.jqplot-point-label.jqplot-series-'+i;if(tempr.animation&&tempr.animation._supported&&tempr.animation.show&&(this._drawCount<2||this.animateReplot)){_els=this.target.find(sel);_els.stop(!0,!0).hide();temps.canvas._elem.stop(!0,!0).hide();temps.shadowCanvas._elem.stop(!0,!0).hide();temps.canvas._elem.jqplotEffect('blind',{mode:'show',direction:tempr.animation.direction},tempr.animation.speed);temps.shadowCanvas._elem.jqplotEffect('blind',{mode:'show',direction:tempr.animation.direction},tempr.animation.speed);_els.fadeIn(tempr.animation.speed*0.8)}}
_els=null;this.target.trigger('jqplotPostDraw',[this])}};jqPlot.prototype.doFillBetweenLines=function(){var fb=this.fillBetween;var sid1=fb.series1;var sid2=fb.series2;var id1=(sid1<sid2)?sid1:sid2;var id2=(sid2>sid1)?sid2:sid1;var series1=this.series[id1];var series2=this.series[id2];if(series2.renderer.smooth){var tempgd=series2.renderer._smoothedData.slice(0).reverse()}
else{var tempgd=series2.gridData.slice(0).reverse()}
if(series1.renderer.smooth){var gd=series1.renderer._smoothedData.concat(tempgd)}
else{var gd=series1.gridData.concat(tempgd)}
var color=(fb.color!==null)?fb.color:this.series[sid1].fillColor;var baseSeries=(fb.baseSeries!==null)?fb.baseSeries:id1;var sr=this.series[baseSeries].renderer.shapeRenderer;var opts={fillStyle:color,fill:!0,closePath:!0};sr.draw(series1.shadowCanvas._ctx,gd,opts)};this.bindCustomEvents=function(){this.eventCanvas._elem.bind('click',{plot:this},this.onClick);this.eventCanvas._elem.bind('dblclick',{plot:this},this.onDblClick);this.eventCanvas._elem.bind('mousedown',{plot:this},this.onMouseDown);this.eventCanvas._elem.bind('mousemove',{plot:this},this.onMouseMove);this.eventCanvas._elem.bind('mouseenter',{plot:this},this.onMouseEnter);this.eventCanvas._elem.bind('mouseleave',{plot:this},this.onMouseLeave);if(this.captureRightClick){this.eventCanvas._elem.bind('mouseup',{plot:this},this.onRightClick);this.eventCanvas._elem.get(0).oncontextmenu=function(){return!1}}
else{this.eventCanvas._elem.bind('mouseup',{plot:this},this.onMouseUp)}};function getEventPosition(ev){var plot=ev.data.plot;var go=plot.eventCanvas._elem.offset();var gridPos={x:ev.pageX-go.left,y:ev.pageY-go.top};var dataPos={xaxis:null,yaxis:null,x2axis:null,y2axis:null,y3axis:null,y4axis:null,y5axis:null,y6axis:null,y7axis:null,y8axis:null,y9axis:null,yMidAxis:null};var an=['xaxis','yaxis','x2axis','y2axis','y3axis','y4axis','y5axis','y6axis','y7axis','y8axis','y9axis','yMidAxis'];var ax=plot.axes;var n,axis;for(n=11;n>0;n--){axis=an[n-1];if(ax[axis].show){dataPos[axis]=ax[axis].series_p2u(gridPos[axis.charAt(0)])}}
return{offsets:go,gridPos:gridPos,dataPos:dataPos}}
function checkIntersection(gridpos,plot){var series=plot.series;var i,j,k,s,r,x,y,theta,sm,sa,minang,maxang;var d0,d,p,pp,points,bw,hp;var threshold,t;for(k=plot.seriesStack.length-1;k>=0;k--){i=plot.seriesStack[k];s=series[i];hp=s._highlightThreshold;switch(s.renderer.constructor){case $.jqplot.BarRenderer:x=gridpos.x;y=gridpos.y;for(j=0;j<s._barPoints.length;j++){points=s._barPoints[j];p=s.gridData[j];if(x>points[0][0]&&x<points[2][0]&&y>points[2][1]&&y<points[0][1]){return{seriesIndex:s.index,pointIndex:j,gridData:p,data:s.data[j],points:s._barPoints[j]}}}
break;case $.jqplot.PyramidRenderer:x=gridpos.x;y=gridpos.y;for(j=0;j<s._barPoints.length;j++){points=s._barPoints[j];p=s.gridData[j];if(x>points[0][0]+hp[0][0]&&x<points[2][0]+hp[2][0]&&y>points[2][1]&&y<points[0][1]){return{seriesIndex:s.index,pointIndex:j,gridData:p,data:s.data[j],points:s._barPoints[j]}}}
break;case $.jqplot.DonutRenderer:sa=s.startAngle/180*Math.PI;x=gridpos.x-s._center[0];y=gridpos.y-s._center[1];r=Math.sqrt(Math.pow(x,2)+Math.pow(y,2));if(x>0&&-y>=0){theta=2*Math.PI-Math.atan(-y/x)}
else if(x>0&&-y<0){theta=-Math.atan(-y/x)}
else if(x<0){theta=Math.PI-Math.atan(-y/x)}
else if(x==0&&-y>0){theta=3*Math.PI/2}
else if(x==0&&-y<0){theta=Math.PI/2}
else if(x==0&&y==0){theta=0}
if(sa){theta-=sa;if(theta<0){theta+=2*Math.PI}
else if(theta>2*Math.PI){theta-=2*Math.PI}}
sm=s.sliceMargin/180*Math.PI;if(r<s._radius&&r>s._innerRadius){for(j=0;j<s.gridData.length;j++){minang=(j>0)?s.gridData[j-1][1]+sm:sm;maxang=s.gridData[j][1];if(theta>minang&&theta<maxang){return{seriesIndex:s.index,pointIndex:j,gridData:[gridpos.x,gridpos.y],data:s.data[j]}}}}
break;case $.jqplot.PieRenderer:sa=s.startAngle/180*Math.PI;x=gridpos.x-s._center[0];y=gridpos.y-s._center[1];r=Math.sqrt(Math.pow(x,2)+Math.pow(y,2));if(x>0&&-y>=0){theta=2*Math.PI-Math.atan(-y/x)}
else if(x>0&&-y<0){theta=-Math.atan(-y/x)}
else if(x<0){theta=Math.PI-Math.atan(-y/x)}
else if(x==0&&-y>0){theta=3*Math.PI/2}
else if(x==0&&-y<0){theta=Math.PI/2}
else if(x==0&&y==0){theta=0}
if(sa){theta-=sa;if(theta<0){theta+=2*Math.PI}
else if(theta>2*Math.PI){theta-=2*Math.PI}}
sm=s.sliceMargin/180*Math.PI;if(r<s._radius){for(j=0;j<s.gridData.length;j++){minang=(j>0)?s.gridData[j-1][1]+sm:sm;maxang=s.gridData[j][1];if(theta>minang&&theta<maxang){return{seriesIndex:s.index,pointIndex:j,gridData:[gridpos.x,gridpos.y],data:s.data[j]}}}}
break;case $.jqplot.BubbleRenderer:x=gridpos.x;y=gridpos.y;var ret=null;if(s.show){for(var j=0;j<s.gridData.length;j++){p=s.gridData[j];d=Math.sqrt((x-p[0])*(x-p[0])+(y-p[1])*(y-p[1]));if(d<=p[2]&&(d<=d0||d0==null)){d0=d;ret={seriesIndex:i,pointIndex:j,gridData:p,data:s.data[j]}}}
if(ret!=null){return ret}}
break;case $.jqplot.FunnelRenderer:x=gridpos.x;y=gridpos.y;var v=s._vertices,vfirst=v[0],vlast=v[v.length-1],lex,rex,cv;function findedge(l,p1,p2){var m=(p1[1]-p2[1])/(p1[0]-p2[0]);var b=p1[1]-m*p1[0];var y=l+p1[1];return[(y-b)/m,y]}
lex=findedge(y,vfirst[0],vlast[3]);rex=findedge(y,vfirst[1],vlast[2]);for(j=0;j<v.length;j++){cv=v[j];if(y>=cv[0][1]&&y<=cv[3][1]&&x>=lex[0]&&x<=rex[0]){return{seriesIndex:s.index,pointIndex:j,gridData:null,data:s.data[j]}}}
break;case $.jqplot.LineRenderer:x=gridpos.x;y=gridpos.y;r=s.renderer;if(s.show){if((s.fill||(s.renderer.bands.show&&s.renderer.bands.fill))&&(!plot.plugins.highlighter||!plot.plugins.highlighter.show)){var inside=!1;if(x>s._boundingBox[0][0]&&x<s._boundingBox[1][0]&&y>s._boundingBox[1][1]&&y<s._boundingBox[0][1]){var numPoints=s._areaPoints.length;var ii;var j=numPoints-1;for(var ii=0;ii<numPoints;ii++){var vertex1=[s._areaPoints[ii][0],s._areaPoints[ii][1]];var vertex2=[s._areaPoints[j][0],s._areaPoints[j][1]];if(vertex1[1]<y&&vertex2[1]>=y||vertex2[1]<y&&vertex1[1]>=y){if(vertex1[0]+(y-vertex1[1])/(vertex2[1]-vertex1[1])*(vertex2[0]-vertex1[0])<x){inside=!inside}}
j=ii}}
if(inside){return{seriesIndex:i,pointIndex:null,gridData:s.gridData,data:s.data,points:s._areaPoints}}
break}
else{t=s.markerRenderer.size/2+s.neighborThreshold;threshold=(t>0)?t:0;for(var j=0;j<s.gridData.length;j++){p=s.gridData[j];if(r.constructor==$.jqplot.OHLCRenderer){if(r.candleStick){var yp=s._yaxis.series_u2p;if(x>=p[0]-r._bodyWidth/2&&x<=p[0]+r._bodyWidth/2&&y>=yp(s.data[j][2])&&y<=yp(s.data[j][3])){return{seriesIndex:i,pointIndex:j,gridData:p,data:s.data[j]}}}
else if(!r.hlc){var yp=s._yaxis.series_u2p;if(x>=p[0]-r._tickLength&&x<=p[0]+r._tickLength&&y>=yp(s.data[j][2])&&y<=yp(s.data[j][3])){return{seriesIndex:i,pointIndex:j,gridData:p,data:s.data[j]}}}
else{var yp=s._yaxis.series_u2p;if(x>=p[0]-r._tickLength&&x<=p[0]+r._tickLength&&y>=yp(s.data[j][1])&&y<=yp(s.data[j][2])){return{seriesIndex:i,pointIndex:j,gridData:p,data:s.data[j]}}}}
else if(p[0]!=null&&p[1]!=null){d=Math.sqrt((x-p[0])*(x-p[0])+(y-p[1])*(y-p[1]));if(d<=threshold&&(d<=d0||d0==null)){d0=d;return{seriesIndex:i,pointIndex:j,gridData:p,data:s.data[j]}}}}}}
break;default:x=gridpos.x;y=gridpos.y;r=s.renderer;if(s.show){t=s.markerRenderer.size/2+s.neighborThreshold;threshold=(t>0)?t:0;for(var j=0;j<s.gridData.length;j++){p=s.gridData[j];if(r.constructor==$.jqplot.OHLCRenderer){if(r.candleStick){var yp=s._yaxis.series_u2p;if(x>=p[0]-r._bodyWidth/2&&x<=p[0]+r._bodyWidth/2&&y>=yp(s.data[j][2])&&y<=yp(s.data[j][3])){return{seriesIndex:i,pointIndex:j,gridData:p,data:s.data[j]}}}
else if(!r.hlc){var yp=s._yaxis.series_u2p;if(x>=p[0]-r._tickLength&&x<=p[0]+r._tickLength&&y>=yp(s.data[j][2])&&y<=yp(s.data[j][3])){return{seriesIndex:i,pointIndex:j,gridData:p,data:s.data[j]}}}
else{var yp=s._yaxis.series_u2p;if(x>=p[0]-r._tickLength&&x<=p[0]+r._tickLength&&y>=yp(s.data[j][1])&&y<=yp(s.data[j][2])){return{seriesIndex:i,pointIndex:j,gridData:p,data:s.data[j]}}}}
else{d=Math.sqrt((x-p[0])*(x-p[0])+(y-p[1])*(y-p[1]));if(d<=threshold&&(d<=d0||d0==null)){d0=d;return{seriesIndex:i,pointIndex:j,gridData:p,data:s.data[j]}}}}}
break}}
return null}
this.onClick=function(ev){var positions=getEventPosition(ev);var p=ev.data.plot;var neighbor=checkIntersection(positions.gridPos,p);var evt=$.Event('jqplotClick');evt.pageX=ev.pageX;evt.pageY=ev.pageY;$(this).trigger(evt,[positions.gridPos,positions.dataPos,neighbor,p])};this.onDblClick=function(ev){var positions=getEventPosition(ev);var p=ev.data.plot;var neighbor=checkIntersection(positions.gridPos,p);var evt=$.Event('jqplotDblClick');evt.pageX=ev.pageX;evt.pageY=ev.pageY;$(this).trigger(evt,[positions.gridPos,positions.dataPos,neighbor,p])};this.onMouseDown=function(ev){var positions=getEventPosition(ev);var p=ev.data.plot;var neighbor=checkIntersection(positions.gridPos,p);var evt=$.Event('jqplotMouseDown');evt.pageX=ev.pageX;evt.pageY=ev.pageY;$(this).trigger(evt,[positions.gridPos,positions.dataPos,neighbor,p])};this.onMouseUp=function(ev){var positions=getEventPosition(ev);var evt=$.Event('jqplotMouseUp');evt.pageX=ev.pageX;evt.pageY=ev.pageY;$(this).trigger(evt,[positions.gridPos,positions.dataPos,null,ev.data.plot])};this.onRightClick=function(ev){var positions=getEventPosition(ev);var p=ev.data.plot;var neighbor=checkIntersection(positions.gridPos,p);if(p.captureRightClick){if(ev.which==3){var evt=$.Event('jqplotRightClick');evt.pageX=ev.pageX;evt.pageY=ev.pageY;$(this).trigger(evt,[positions.gridPos,positions.dataPos,neighbor,p])}
else{var evt=$.Event('jqplotMouseUp');evt.pageX=ev.pageX;evt.pageY=ev.pageY;$(this).trigger(evt,[positions.gridPos,positions.dataPos,neighbor,p])}}};this.onMouseMove=function(ev){var positions=getEventPosition(ev);var p=ev.data.plot;var neighbor=checkIntersection(positions.gridPos,p);var evt=$.Event('jqplotMouseMove');evt.pageX=ev.pageX;evt.pageY=ev.pageY;$(this).trigger(evt,[positions.gridPos,positions.dataPos,neighbor,p])};this.onMouseEnter=function(ev){var positions=getEventPosition(ev);var p=ev.data.plot;var evt=$.Event('jqplotMouseEnter');evt.pageX=ev.pageX;evt.pageY=ev.pageY;evt.relatedTarget=ev.relatedTarget;$(this).trigger(evt,[positions.gridPos,positions.dataPos,null,p])};this.onMouseLeave=function(ev){var positions=getEventPosition(ev);var p=ev.data.plot;var evt=$.Event('jqplotMouseLeave');evt.pageX=ev.pageX;evt.pageY=ev.pageY;evt.relatedTarget=ev.relatedTarget;$(this).trigger(evt,[positions.gridPos,positions.dataPos,null,p])};this.drawSeries=function(options,idx){var i,series,ctx;idx=(typeof(options)==="number"&&idx==null)?options:idx;options=(typeof(options)==="object")?options:{};if(idx!=undefined){series=this.series[idx];ctx=series.shadowCanvas._ctx;ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);series.drawShadow(ctx,options,this);ctx=series.canvas._ctx;ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);series.draw(ctx,options,this);if(series.renderer.constructor==$.jqplot.BezierCurveRenderer){if(idx<this.series.length-1){this.drawSeries(idx+1)}}}
else{for(i=0;i<this.series.length;i++){series=this.series[i];ctx=series.shadowCanvas._ctx;ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);series.drawShadow(ctx,options,this);ctx=series.canvas._ctx;ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);series.draw(ctx,options,this)}}
options=idx=i=series=ctx=null};this.moveSeriesToFront=function(idx){idx=parseInt(idx,10);var stackIndex=$.inArray(idx,this.seriesStack);if(stackIndex==-1){return}
if(stackIndex==this.seriesStack.length-1){this.previousSeriesStack=this.seriesStack.slice(0);return}
var opidx=this.seriesStack[this.seriesStack.length-1];var serelem=this.series[idx].canvas._elem.detach();var shadelem=this.series[idx].shadowCanvas._elem.detach();this.series[opidx].shadowCanvas._elem.after(shadelem);this.series[opidx].canvas._elem.after(serelem);this.previousSeriesStack=this.seriesStack.slice(0);this.seriesStack.splice(stackIndex,1);this.seriesStack.push(idx)};this.moveSeriesToBack=function(idx){idx=parseInt(idx,10);var stackIndex=$.inArray(idx,this.seriesStack);if(stackIndex==0||stackIndex==-1){return}
var opidx=this.seriesStack[0];var serelem=this.series[idx].canvas._elem.detach();var shadelem=this.series[idx].shadowCanvas._elem.detach();this.series[opidx].shadowCanvas._elem.before(shadelem);this.series[opidx].canvas._elem.before(serelem);this.previousSeriesStack=this.seriesStack.slice(0);this.seriesStack.splice(stackIndex,1);this.seriesStack.unshift(idx)};this.restorePreviousSeriesOrder=function(){var i,j,serelem,shadelem,temp,move,keep;if(this.seriesStack==this.previousSeriesStack){return}
for(i=1;i<this.previousSeriesStack.length;i++){move=this.previousSeriesStack[i];keep=this.previousSeriesStack[i-1];serelem=this.series[move].canvas._elem.detach();shadelem=this.series[move].shadowCanvas._elem.detach();this.series[keep].shadowCanvas._elem.after(shadelem);this.series[keep].canvas._elem.after(serelem)}
temp=this.seriesStack.slice(0);this.seriesStack=this.previousSeriesStack.slice(0);this.previousSeriesStack=temp};this.restoreOriginalSeriesOrder=function(){var i,j,arr=[],serelem,shadelem;for(i=0;i<this.series.length;i++){arr.push(i)}
if(this.seriesStack==arr){return}
this.previousSeriesStack=this.seriesStack.slice(0);this.seriesStack=arr;for(i=1;i<this.seriesStack.length;i++){serelem=this.series[i].canvas._elem.detach();shadelem=this.series[i].shadowCanvas._elem.detach();this.series[i-1].shadowCanvas._elem.after(shadelem);this.series[i-1].canvas._elem.after(serelem)}};this.activateTheme=function(name){this.themeEngine.activate(this,name)}}
$.jqplot.computeHighlightColors=function(colors){var ret;if($.isArray(colors)){ret=[];for(var i=0;i<colors.length;i++){var rgba=$.jqplot.getColorComponents(colors[i]);var newrgb=[rgba[0],rgba[1],rgba[2]];var sum=newrgb[0]+newrgb[1]+newrgb[2];for(var j=0;j<3;j++){newrgb[j]=(sum>660)?newrgb[j]*0.85:0.73*newrgb[j]+90;newrgb[j]=parseInt(newrgb[j],10);(newrgb[j]>255)?255:newrgb[j]}
newrgb[3]=0.3+0.35*rgba[3];ret.push('rgba('+newrgb[0]+','+newrgb[1]+','+newrgb[2]+','+newrgb[3]+')')}}
else{var rgba=$.jqplot.getColorComponents(colors);var newrgb=[rgba[0],rgba[1],rgba[2]];var sum=newrgb[0]+newrgb[1]+newrgb[2];for(var j=0;j<3;j++){newrgb[j]=(sum>660)?newrgb[j]*0.85:0.73*newrgb[j]+90;newrgb[j]=parseInt(newrgb[j],10);(newrgb[j]>255)?255:newrgb[j]}
newrgb[3]=0.3+0.35*rgba[3];ret='rgba('+newrgb[0]+','+newrgb[1]+','+newrgb[2]+','+newrgb[3]+')'}
return ret};$.jqplot.ColorGenerator=function(colors){colors=colors||$.jqplot.config.defaultColors;var idx=0;this.next=function(){if(idx<colors.length){return colors[idx++]}
else{idx=0;return colors[idx++]}};this.previous=function(){if(idx>0){return colors[idx--]}
else{idx=colors.length-1;return colors[idx]}};this.get=function(i){var idx=i-colors.length*Math.floor(i/colors.length);return colors[idx]};this.setColors=function(c){colors=c};this.reset=function(){idx=0};this.getIndex=function(){return idx};this.setIndex=function(index){idx=index}};$.jqplot.hex2rgb=function(h,a){h=h.replace('#','');if(h.length==3){h=h.charAt(0)+h.charAt(0)+h.charAt(1)+h.charAt(1)+h.charAt(2)+h.charAt(2)}
var rgb;rgb='rgba('+parseInt(h.slice(0,2),16)+', '+parseInt(h.slice(2,4),16)+', '+parseInt(h.slice(4,6),16);if(a){rgb+=', '+a}
rgb+=')';return rgb};$.jqplot.rgb2hex=function(s){var pat=/rgba?\( *([0-9]{1,3}\.?[0-9]*%?) *, *([0-9]{1,3}\.?[0-9]*%?) *, *([0-9]{1,3}\.?[0-9]*%?) *(?:, *[0-9.]*)?\)/;var m=s.match(pat);var h='#';for(var i=1;i<4;i++){var temp;if(m[i].search(/%/)!=-1){temp=parseInt(255*m[i]/100,10).toString(16);if(temp.length==1){temp='0'+temp}}
else{temp=parseInt(m[i],10).toString(16);if(temp.length==1){temp='0'+temp}}
h+=temp}
return h};$.jqplot.normalize2rgb=function(s,a){if(s.search(/^ *rgba?\(/)!=-1){return s}
else if(s.search(/^ *#?[0-9a-fA-F]?[0-9a-fA-F]/)!=-1){return $.jqplot.hex2rgb(s,a)}
else{throw new Error('Invalid color spec')}};$.jqplot.getColorComponents=function(s){s=$.jqplot.colorKeywordMap[s]||s;var rgb=$.jqplot.normalize2rgb(s);var pat=/rgba?\( *([0-9]{1,3}\.?[0-9]*%?) *, *([0-9]{1,3}\.?[0-9]*%?) *, *([0-9]{1,3}\.?[0-9]*%?) *,? *([0-9.]* *)?\)/;var m=rgb.match(pat);var ret=[];for(var i=1;i<4;i++){if(m[i].search(/%/)!=-1){ret[i-1]=parseInt(255*m[i]/100,10)}
else{ret[i-1]=parseInt(m[i],10)}}
ret[3]=parseFloat(m[4])?parseFloat(m[4]):1.0;return ret};$.jqplot.colorKeywordMap={aliceblue:'rgb(240, 248, 255)',antiquewhite:'rgb(250, 235, 215)',aqua:'rgb( 0, 255, 255)',aquamarine:'rgb(127, 255, 212)',azure:'rgb(240, 255, 255)',beige:'rgb(245, 245, 220)',bisque:'rgb(255, 228, 196)',black:'rgb( 0, 0, 0)',blanchedalmond:'rgb(255, 235, 205)',blue:'rgb( 0, 0, 255)',blueviolet:'rgb(138, 43, 226)',brown:'rgb(165, 42, 42)',burlywood:'rgb(222, 184, 135)',cadetblue:'rgb( 95, 158, 160)',chartreuse:'rgb(127, 255, 0)',chocolate:'rgb(210, 105, 30)',coral:'rgb(255, 127, 80)',cornflowerblue:'rgb(100, 149, 237)',cornsilk:'rgb(255, 248, 220)',crimson:'rgb(220, 20, 60)',cyan:'rgb( 0, 255, 255)',darkblue:'rgb( 0, 0, 139)',darkcyan:'rgb( 0, 139, 139)',darkgoldenrod:'rgb(184, 134, 11)',darkgray:'rgb(169, 169, 169)',darkgreen:'rgb( 0, 100, 0)',darkgrey:'rgb(169, 169, 169)',darkkhaki:'rgb(189, 183, 107)',darkmagenta:'rgb(139, 0, 139)',darkolivegreen:'rgb( 85, 107, 47)',darkorange:'rgb(255, 140, 0)',darkorchid:'rgb(153, 50, 204)',darkred:'rgb(139, 0, 0)',darksalmon:'rgb(233, 150, 122)',darkseagreen:'rgb(143, 188, 143)',darkslateblue:'rgb( 72, 61, 139)',darkslategray:'rgb( 47, 79, 79)',darkslategrey:'rgb( 47, 79, 79)',darkturquoise:'rgb( 0, 206, 209)',darkviolet:'rgb(148, 0, 211)',deeppink:'rgb(255, 20, 147)',deepskyblue:'rgb( 0, 191, 255)',dimgray:'rgb(105, 105, 105)',dimgrey:'rgb(105, 105, 105)',dodgerblue:'rgb( 30, 144, 255)',firebrick:'rgb(178, 34, 34)',floralwhite:'rgb(255, 250, 240)',forestgreen:'rgb( 34, 139, 34)',fuchsia:'rgb(255, 0, 255)',gainsboro:'rgb(220, 220, 220)',ghostwhite:'rgb(248, 248, 255)',gold:'rgb(255, 215, 0)',goldenrod:'rgb(218, 165, 32)',gray:'rgb(128, 128, 128)',grey:'rgb(128, 128, 128)',green:'rgb( 0, 128, 0)',greenyellow:'rgb(173, 255, 47)',honeydew:'rgb(240, 255, 240)',hotpink:'rgb(255, 105, 180)',indianred:'rgb(205, 92, 92)',indigo:'rgb( 75, 0, 130)',ivory:'rgb(255, 255, 240)',khaki:'rgb(240, 230, 140)',lavender:'rgb(230, 230, 250)',lavenderblush:'rgb(255, 240, 245)',lawngreen:'rgb(124, 252, 0)',lemonchiffon:'rgb(255, 250, 205)',lightblue:'rgb(173, 216, 230)',lightcoral:'rgb(240, 128, 128)',lightcyan:'rgb(224, 255, 255)',lightgoldenrodyellow:'rgb(250, 250, 210)',lightgray:'rgb(211, 211, 211)',lightgreen:'rgb(144, 238, 144)',lightgrey:'rgb(211, 211, 211)',lightpink:'rgb(255, 182, 193)',lightsalmon:'rgb(255, 160, 122)',lightseagreen:'rgb( 32, 178, 170)',lightskyblue:'rgb(135, 206, 250)',lightslategray:'rgb(119, 136, 153)',lightslategrey:'rgb(119, 136, 153)',lightsteelblue:'rgb(176, 196, 222)',lightyellow:'rgb(255, 255, 224)',lime:'rgb( 0, 255, 0)',limegreen:'rgb( 50, 205, 50)',linen:'rgb(250, 240, 230)',magenta:'rgb(255, 0, 255)',maroon:'rgb(128, 0, 0)',mediumaquamarine:'rgb(102, 205, 170)',mediumblue:'rgb( 0, 0, 205)',mediumorchid:'rgb(186, 85, 211)',mediumpurple:'rgb(147, 112, 219)',mediumseagreen:'rgb( 60, 179, 113)',mediumslateblue:'rgb(123, 104, 238)',mediumspringgreen:'rgb( 0, 250, 154)',mediumturquoise:'rgb( 72, 209, 204)',mediumvioletred:'rgb(199, 21, 133)',midnightblue:'rgb( 25, 25, 112)',mintcream:'rgb(245, 255, 250)',mistyrose:'rgb(255, 228, 225)',moccasin:'rgb(255, 228, 181)',navajowhite:'rgb(255, 222, 173)',navy:'rgb( 0, 0, 128)',oldlace:'rgb(253, 245, 230)',olive:'rgb(128, 128, 0)',olivedrab:'rgb(107, 142, 35)',orange:'rgb(255, 165, 0)',orangered:'rgb(255, 69, 0)',orchid:'rgb(218, 112, 214)',palegoldenrod:'rgb(238, 232, 170)',palegreen:'rgb(152, 251, 152)',paleturquoise:'rgb(175, 238, 238)',palevioletred:'rgb(219, 112, 147)',papayawhip:'rgb(255, 239, 213)',peachpuff:'rgb(255, 218, 185)',peru:'rgb(205, 133, 63)',pink:'rgb(255, 192, 203)',plum:'rgb(221, 160, 221)',powderblue:'rgb(176, 224, 230)',purple:'rgb(128, 0, 128)',red:'rgb(255, 0, 0)',rosybrown:'rgb(188, 143, 143)',royalblue:'rgb( 65, 105, 225)',saddlebrown:'rgb(139, 69, 19)',salmon:'rgb(250, 128, 114)',sandybrown:'rgb(244, 164, 96)',seagreen:'rgb( 46, 139, 87)',seashell:'rgb(255, 245, 238)',sienna:'rgb(160, 82, 45)',silver:'rgb(192, 192, 192)',skyblue:'rgb(135, 206, 235)',slateblue:'rgb(106, 90, 205)',slategray:'rgb(112, 128, 144)',slategrey:'rgb(112, 128, 144)',snow:'rgb(255, 250, 250)',springgreen:'rgb( 0, 255, 127)',steelblue:'rgb( 70, 130, 180)',tan:'rgb(210, 180, 140)',teal:'rgb( 0, 128, 128)',thistle:'rgb(216, 191, 216)',tomato:'rgb(255, 99, 71)',turquoise:'rgb( 64, 224, 208)',violet:'rgb(238, 130, 238)',wheat:'rgb(245, 222, 179)',white:'rgb(255, 255, 255)',whitesmoke:'rgb(245, 245, 245)',yellow:'rgb(255, 255, 0)',yellowgreen:'rgb(154, 205, 50)'};$.jqplot.AxisLabelRenderer=function(options){$.jqplot.ElemContainer.call(this);this.axis;this.show=!0;this.label='';this.fontFamily=null;this.fontSize=null;this.textColor=null;this._elem;this.escapeHTML=!1;$.extend(!0,this,options)};$.jqplot.AxisLabelRenderer.prototype=new $.jqplot.ElemContainer();$.jqplot.AxisLabelRenderer.prototype.constructor=$.jqplot.AxisLabelRenderer;$.jqplot.AxisLabelRenderer.prototype.init=function(options){$.extend(!0,this,options)};$.jqplot.AxisLabelRenderer.prototype.draw=function(ctx,plot){if(this._elem){this._elem.emptyForce();this._elem=null}
this._elem=$('<div style="position:absolute;" class="jqplot-'+this.axis+'-label"></div>');if(Number(this.label)){this._elem.css('white-space','nowrap')}
if(!this.escapeHTML){this._elem.html(this.label)}
else{this._elem.text(this.label)}
if(this.fontFamily){this._elem.css('font-family',this.fontFamily)}
if(this.fontSize){this._elem.css('font-size',this.fontSize)}
if(this.textColor){this._elem.css('color',this.textColor)}
return this._elem};$.jqplot.AxisLabelRenderer.prototype.pack=function(){};$.jqplot.AxisTickRenderer=function(options){$.jqplot.ElemContainer.call(this);this.mark='outside';this.axis;this.showMark=!0;this.showGridline=!0;this.isMinorTick=!1;this.size=4;this.markSize=6;this.show=!0;this.showLabel=!0;this.label=null;this.value=null;this._styles={};this.formatter=$.jqplot.DefaultTickFormatter;this.prefix='';this.suffix='';this.formatString='';this.fontFamily;this.fontSize;this.textColor;this.escapeHTML=!1;this._elem;this._breakTick=!1;$.extend(!0,this,options)};$.jqplot.AxisTickRenderer.prototype.init=function(options){$.extend(!0,this,options)};$.jqplot.AxisTickRenderer.prototype=new $.jqplot.ElemContainer();$.jqplot.AxisTickRenderer.prototype.constructor=$.jqplot.AxisTickRenderer;$.jqplot.AxisTickRenderer.prototype.setTick=function(value,axisName,isMinor){this.value=value;this.axis=axisName;if(isMinor){this.isMinorTick=!0}
return this};$.jqplot.AxisTickRenderer.prototype.draw=function(){if(this.label===null){this.label=this.prefix+this.formatter(this.formatString,this.value)+this.suffix}
var style={position:'absolute'};if(Number(this.label)){style.whitSpace='nowrap'}
if(this._elem){this._elem.emptyForce();this._elem=null}
this._elem=$(document.createElement('div'));this._elem.addClass("jqplot-"+this.axis+"-tick");if(!this.escapeHTML){this._elem.html(this.label)}
else{this._elem.text(this.label)}
this._elem.css(style);for(var s in this._styles){this._elem.css(s,this._styles[s])}
if(this.fontFamily){this._elem.css('font-family',this.fontFamily)}
if(this.fontSize){this._elem.css('font-size',this.fontSize)}
if(this.textColor){this._elem.css('color',this.textColor)}
if(this._breakTick){this._elem.addClass('jqplot-breakTick')}
return this._elem};$.jqplot.DefaultTickFormatter=function(format,val){if(typeof val=='number'){if(!format){format=$.jqplot.config.defaultTickFormatString}
return $.jqplot.sprintf(format,val)}
else{return String(val)}};$.jqplot.PercentTickFormatter=function(format,val){if(typeof val=='number'){val=100*val;if(!format){format=$.jqplot.config.defaultTickFormatString}
return $.jqplot.sprintf(format,val)}
else{return String(val)}};$.jqplot.AxisTickRenderer.prototype.pack=function(){};$.jqplot.CanvasGridRenderer=function(){this.shadowRenderer=new $.jqplot.ShadowRenderer()};$.jqplot.CanvasGridRenderer.prototype.init=function(options){this._ctx;$.extend(!0,this,options);var sopts={lineJoin:'miter',lineCap:'round',fill:!1,isarc:!1,angle:this.shadowAngle,offset:this.shadowOffset,alpha:this.shadowAlpha,depth:this.shadowDepth,lineWidth:this.shadowWidth,closePath:!1,strokeStyle:this.shadowColor};this.renderer.shadowRenderer.init(sopts)};$.jqplot.CanvasGridRenderer.prototype.createElement=function(plot){var elem;if(this._elem){if($.jqplot.use_excanvas&&window.G_vmlCanvasManager.uninitElement!==undefined){elem=this._elem.get(0);window.G_vmlCanvasManager.uninitElement(elem);elem=null}
this._elem.emptyForce();this._elem=null}
elem=plot.canvasManager.getCanvas();var w=this._plotDimensions.width;var h=this._plotDimensions.height;elem.width=w;elem.height=h;this._elem=$(elem);this._elem.addClass('jqplot-grid-canvas');this._elem.css({position:'absolute',left:0,top:0});elem=plot.canvasManager.initCanvas(elem);this._top=this._offsets.top;this._bottom=h-this._offsets.bottom;this._left=this._offsets.left;this._right=w-this._offsets.right;this._width=this._right-this._left;this._height=this._bottom-this._top;elem=null;return this._elem};$.jqplot.CanvasGridRenderer.prototype.draw=function(){this._ctx=this._elem.get(0).getContext("2d");var ctx=this._ctx;var axes=this._axes;ctx.save();ctx.clearRect(0,0,this._plotDimensions.width,this._plotDimensions.height);ctx.fillStyle=this.backgroundColor||this.background;ctx.fillRect(this._left,this._top,this._width,this._height);ctx.save();ctx.lineJoin='miter';ctx.lineCap='butt';ctx.lineWidth=this.gridLineWidth;ctx.strokeStyle=this.gridLineColor;var b,e,s,m;var ax=['xaxis','yaxis','x2axis','y2axis'];for(var i=4;i>0;i--){var name=ax[i-1];var axis=axes[name];var ticks=axis._ticks;var numticks=ticks.length;if(axis.show){if(axis.drawBaseline){var bopts={};if(axis.baselineWidth!==null){bopts.lineWidth=axis.baselineWidth}
if(axis.baselineColor!==null){bopts.strokeStyle=axis.baselineColor}
switch(name){case 'xaxis':drawLine(this._left,this._bottom,this._right,this._bottom,bopts);break;case 'yaxis':drawLine(this._left,this._bottom,this._left,this._top,bopts);break;case 'x2axis':drawLine(this._left,this._bottom,this._right,this._bottom,bopts);break;case 'y2axis':drawLine(this._right,this._bottom,this._right,this._top,bopts);break}}
for(var j=numticks;j>0;j--){var t=ticks[j-1];if(t.show){var pos=Math.round(axis.u2p(t.value))+0.5;switch(name){case 'xaxis':if(t.showGridline&&this.drawGridlines&&((!t.isMinorTick&&axis.drawMajorGridlines)||(t.isMinorTick&&axis.drawMinorGridlines))){drawLine(pos,this._top,pos,this._bottom)}
if(t.showMark&&t.mark&&((!t.isMinorTick&&axis.drawMajorTickMarks)||(t.isMinorTick&&axis.drawMinorTickMarks))){s=t.markSize;m=t.mark;var pos=Math.round(axis.u2p(t.value))+0.5;switch(m){case 'outside':b=this._bottom;e=this._bottom+s;break;case 'inside':b=this._bottom-s;e=this._bottom;break;case 'cross':b=this._bottom-s;e=this._bottom+s;break;default:b=this._bottom;e=this._bottom+s;break}
if(this.shadow){this.renderer.shadowRenderer.draw(ctx,[[pos,b],[pos,e]],{lineCap:'butt',lineWidth:this.gridLineWidth,offset:this.gridLineWidth*0.75,depth:2,fill:!1,closePath:!1})}
drawLine(pos,b,pos,e)}
break;case 'yaxis':if(t.showGridline&&this.drawGridlines&&((!t.isMinorTick&&axis.drawMajorGridlines)||(t.isMinorTick&&axis.drawMinorGridlines))){drawLine(this._right,pos,this._left,pos)}
if(t.showMark&&t.mark&&((!t.isMinorTick&&axis.drawMajorTickMarks)||(t.isMinorTick&&axis.drawMinorTickMarks))){s=t.markSize;m=t.mark;var pos=Math.round(axis.u2p(t.value))+0.5;switch(m){case 'outside':b=this._left-s;e=this._left;break;case 'inside':b=this._left;e=this._left+s;break;case 'cross':b=this._left-s;e=this._left+s;break;default:b=this._left-s;e=this._left;break}
if(this.shadow){this.renderer.shadowRenderer.draw(ctx,[[b,pos],[e,pos]],{lineCap:'butt',lineWidth:this.gridLineWidth*1.5,offset:this.gridLineWidth*0.75,fill:!1,closePath:!1})}
drawLine(b,pos,e,pos,{strokeStyle:axis.borderColor})}
break;case 'x2axis':if(t.showGridline&&this.drawGridlines&&((!t.isMinorTick&&axis.drawMajorGridlines)||(t.isMinorTick&&axis.drawMinorGridlines))){drawLine(pos,this._bottom,pos,this._top)}
if(t.showMark&&t.mark&&((!t.isMinorTick&&axis.drawMajorTickMarks)||(t.isMinorTick&&axis.drawMinorTickMarks))){s=t.markSize;m=t.mark;var pos=Math.round(axis.u2p(t.value))+0.5;switch(m){case 'outside':b=this._top-s;e=this._top;break;case 'inside':b=this._top;e=this._top+s;break;case 'cross':b=this._top-s;e=this._top+s;break;default:b=this._top-s;e=this._top;break}
if(this.shadow){this.renderer.shadowRenderer.draw(ctx,[[pos,b],[pos,e]],{lineCap:'butt',lineWidth:this.gridLineWidth,offset:this.gridLineWidth*0.75,depth:2,fill:!1,closePath:!1})}
drawLine(pos,b,pos,e)}
break;case 'y2axis':if(t.showGridline&&this.drawGridlines&&((!t.isMinorTick&&axis.drawMajorGridlines)||(t.isMinorTick&&axis.drawMinorGridlines))){drawLine(this._left,pos,this._right,pos)}
if(t.showMark&&t.mark&&((!t.isMinorTick&&axis.drawMajorTickMarks)||(t.isMinorTick&&axis.drawMinorTickMarks))){s=t.markSize;m=t.mark;var pos=Math.round(axis.u2p(t.value))+0.5;switch(m){case 'outside':b=this._right;e=this._right+s;break;case 'inside':b=this._right-s;e=this._right;break;case 'cross':b=this._right-s;e=this._right+s;break;default:b=this._right;e=this._right+s;break}
if(this.shadow){this.renderer.shadowRenderer.draw(ctx,[[b,pos],[e,pos]],{lineCap:'butt',lineWidth:this.gridLineWidth*1.5,offset:this.gridLineWidth*0.75,fill:!1,closePath:!1})}
drawLine(b,pos,e,pos,{strokeStyle:axis.borderColor})}
break;default:break}}}
t=null}
axis=null;ticks=null}
ax=['y3axis','y4axis','y5axis','y6axis','y7axis','y8axis','y9axis','yMidAxis'];for(var i=7;i>0;i--){var axis=axes[ax[i-1]];var ticks=axis._ticks;if(axis.show){var tn=ticks[axis.numberTicks-1];var t0=ticks[0];var left=axis.getLeft();var points=[[left,tn.getTop()+tn.getHeight()/2],[left,t0.getTop()+t0.getHeight()/2+1.0]];if(this.shadow){this.renderer.shadowRenderer.draw(ctx,points,{lineCap:'butt',fill:!1,closePath:!1})}
drawLine(points[0][0],points[0][1],points[1][0],points[1][1],{lineCap:'butt',strokeStyle:axis.borderColor,lineWidth:axis.borderWidth});for(var j=ticks.length;j>0;j--){var t=ticks[j-1];s=t.markSize;m=t.mark;var pos=Math.round(axis.u2p(t.value))+0.5;if(t.showMark&&t.mark){switch(m){case 'outside':b=left;e=left+s;break;case 'inside':b=left-s;e=left;break;case 'cross':b=left-s;e=left+s;break;default:b=left;e=left+s;break}
points=[[b,pos],[e,pos]];if(this.shadow){this.renderer.shadowRenderer.draw(ctx,points,{lineCap:'butt',lineWidth:this.gridLineWidth*1.5,offset:this.gridLineWidth*0.75,fill:!1,closePath:!1})}
drawLine(b,pos,e,pos,{strokeStyle:axis.borderColor})}
t=null}
t0=null}
axis=null;ticks=null}
ctx.restore();function drawLine(bx,by,ex,ey,opts){ctx.save();opts=opts||{};if(opts.lineWidth==null||opts.lineWidth!=0){$.extend(!0,ctx,opts);ctx.beginPath();ctx.moveTo(bx,by);ctx.lineTo(ex,ey);ctx.stroke();ctx.restore()}}
if(this.shadow){var points=[[this._left,this._bottom],[this._right,this._bottom],[this._right,this._top]];this.renderer.shadowRenderer.draw(ctx,points)}
if(this.borderWidth!=0&&this.drawBorder){drawLine(this._left,this._top,this._right,this._top,{lineCap:'round',strokeStyle:axes.x2axis.borderColor,lineWidth:axes.x2axis.borderWidth});drawLine(this._right,this._top,this._right,this._bottom,{lineCap:'round',strokeStyle:axes.y2axis.borderColor,lineWidth:axes.y2axis.borderWidth});drawLine(this._right,this._bottom,this._left,this._bottom,{lineCap:'round',strokeStyle:axes.xaxis.borderColor,lineWidth:axes.xaxis.borderWidth});drawLine(this._left,this._bottom,this._left,this._top,{lineCap:'round',strokeStyle:axes.yaxis.borderColor,lineWidth:axes.yaxis.borderWidth})}
ctx.restore();ctx=null;axes=null};$.jqplot.DivTitleRenderer=function(){};$.jqplot.DivTitleRenderer.prototype.init=function(options){$.extend(!0,this,options)};$.jqplot.DivTitleRenderer.prototype.draw=function(){if(this._elem){this._elem.emptyForce();this._elem=null}
var r=this.renderer;var elem=document.createElement('div');this._elem=$(elem);this._elem.addClass('jqplot-title');if(!this.text){this.show=!1;this._elem.height(0);this._elem.width(0)}
else if(this.text){var color;if(this.color){color=this.color}
else if(this.textColor){color=this.textColor}
var styles={position:'absolute',top:'0px',left:'0px'};if(this._plotWidth){styles.width=this._plotWidth+'px'}
if(this.fontSize){styles.fontSize=this.fontSize}
if(typeof this.textAlign==='string'){styles.textAlign=this.textAlign}
else{styles.textAlign='center'}
if(color){styles.color=color}
if(this.paddingBottom){styles.paddingBottom=this.paddingBottom}
if(this.fontFamily){styles.fontFamily=this.fontFamily}
this._elem.css(styles);if(this.escapeHtml){this._elem.text(this.text)}
else{this._elem.html(this.text)}}
elem=null;return this._elem};$.jqplot.DivTitleRenderer.prototype.pack=function(){};var dotlen=0.1;$.jqplot.LinePattern=function(ctx,pattern){var defaultLinePatterns={dotted:[dotlen,$.jqplot.config.dotGapLength],dashed:[$.jqplot.config.dashLength,$.jqplot.config.gapLength],solid:null};if(typeof pattern==='string'){if(pattern[0]==='.'||pattern[0]==='-'){var s=pattern;pattern=[];for(var i=0,imax=s.length;i<imax;i++){if(s[i]==='.'){pattern.push(dotlen)}
else if(s[i]==='-'){pattern.push($.jqplot.config.dashLength)}
else{continue}
pattern.push($.jqplot.config.gapLength)}}
else{pattern=defaultLinePatterns[pattern]}}
if(!(pattern&&pattern.length)){return ctx}
var patternIndex=0;var patternDistance=pattern[0];var px=0;var py=0;var pathx0=0;var pathy0=0;var moveTo=function(x,y){ctx.moveTo(x,y);px=x;py=y;pathx0=x;pathy0=y};var lineTo=function(x,y){var scale=ctx.lineWidth;var dx=x-px;var dy=y-py;var dist=Math.sqrt(dx*dx+dy*dy);if((dist>0)&&(scale>0)){dx/=dist;dy/=dist;while(!0){var dp=scale*patternDistance;if(dp<dist){px+=dp*dx;py+=dp*dy;if((patternIndex&1)==0){ctx.lineTo(px,py)}
else{ctx.moveTo(px,py)}
dist-=dp;patternIndex++;if(patternIndex>=pattern.length){patternIndex=0}
patternDistance=pattern[patternIndex]}
else{px=x;py=y;if((patternIndex&1)==0){ctx.lineTo(px,py)}
else{ctx.moveTo(px,py)}
patternDistance-=dist/scale;break}}}};var beginPath=function(){ctx.beginPath()};var closePath=function(){lineTo(pathx0,pathy0)};return{moveTo:moveTo,lineTo:lineTo,beginPath:beginPath,closePath:closePath}};$.jqplot.LineRenderer=function(){this.shapeRenderer=new $.jqplot.ShapeRenderer();this.shadowRenderer=new $.jqplot.ShadowRenderer()};$.jqplot.LineRenderer.prototype.init=function(options,plot){options=options||{};this._type='line';this.renderer.animation={show:!1,direction:'left',speed:2500,_supported:!0};this.renderer.smooth=!1;this.renderer.tension=null;this.renderer.constrainSmoothing=!0;this.renderer._smoothedData=[];this.renderer._smoothedPlotData=[];this.renderer._hiBandGridData=[];this.renderer._lowBandGridData=[];this.renderer._hiBandSmoothedData=[];this.renderer._lowBandSmoothedData=[];this.renderer.bandData=[];this.renderer.bands={show:!1,hiData:[],lowData:[],color:this.color,showLines:!1,fill:!0,fillColor:null,_min:null,_max:null,interval:'3%'};var lopts={highlightMouseOver:options.highlightMouseOver,highlightMouseDown:options.highlightMouseDown,highlightColor:options.highlightColor};delete(options.highlightMouseOver);delete(options.highlightMouseDown);delete(options.highlightColor);$.extend(!0,this.renderer,options);this.renderer.options=options;if(this.renderer.bandData.length>1&&(!options.bands||options.bands.show==null)){this.renderer.bands.show=!0}
else if(options.bands&&options.bands.show==null&&options.bands.interval!=null){this.renderer.bands.show=!0}
if(this.fill){this.renderer.bands.show=!1}
if(this.renderer.bands.show){this.renderer.initBands.call(this,this.renderer.options,plot)}
if(this._stack){this.renderer.smooth=!1}
var opts={lineJoin:this.lineJoin,lineCap:this.lineCap,fill:this.fill,isarc:!1,strokeStyle:this.color,fillStyle:this.fillColor,lineWidth:this.lineWidth,linePattern:this.linePattern,closePath:this.fill};this.renderer.shapeRenderer.init(opts);var shadow_offset=options.shadowOffset;if(shadow_offset==null){if(this.lineWidth>2.5){shadow_offset=1.25*(1+(Math.atan((this.lineWidth/2.5))/0.785398163-1)*0.6)}
else{shadow_offset=1.25*Math.atan((this.lineWidth/2.5))/0.785398163}}
var sopts={lineJoin:this.lineJoin,lineCap:this.lineCap,fill:this.fill,isarc:!1,angle:this.shadowAngle,offset:shadow_offset,alpha:this.shadowAlpha,depth:this.shadowDepth,lineWidth:this.lineWidth,linePattern:this.linePattern,closePath:this.fill};this.renderer.shadowRenderer.init(sopts);this._areaPoints=[];this._boundingBox=[[],[]];if(!this.isTrendline&&this.fill||this.renderer.bands.show){this.highlightMouseOver=!0;this.highlightMouseDown=!1;this.highlightColor=null;if(lopts.highlightMouseDown&&lopts.highlightMouseOver==null){lopts.highlightMouseOver=!1}
$.extend(!0,this,{highlightMouseOver:lopts.highlightMouseOver,highlightMouseDown:lopts.highlightMouseDown,highlightColor:lopts.highlightColor});if(!this.highlightColor){var fc=(this.renderer.bands.show)?this.renderer.bands.fillColor:this.fillColor;this.highlightColor=$.jqplot.computeHighlightColors(fc)}
if(this.highlighter){this.highlighter.show=!1}}
if(!this.isTrendline&&plot){plot.plugins.lineRenderer={};plot.postInitHooks.addOnce(postInit);plot.postDrawHooks.addOnce(postPlotDraw);plot.eventListenerHooks.addOnce('jqplotMouseMove',handleMove);plot.eventListenerHooks.addOnce('jqplotMouseDown',handleMouseDown);plot.eventListenerHooks.addOnce('jqplotMouseUp',handleMouseUp);plot.eventListenerHooks.addOnce('jqplotClick',handleClick);plot.eventListenerHooks.addOnce('jqplotRightClick',handleRightClick)}};$.jqplot.LineRenderer.prototype.initBands=function(options,plot){var bd=options.bandData||[];var bands=this.renderer.bands;bands.hiData=[];bands.lowData=[];var data=this.data;bands._max=null;bands._min=null;if(bd.length==2){if($.isArray(bd[0][0])){var p;var bdminidx=0,bdmaxidx=0;for(var i=0,l=bd[0].length;i<l;i++){p=bd[0][i];if((p[1]!=null&&p[1]>bands._max)||bands._max==null){bands._max=p[1]}
if((p[1]!=null&&p[1]<bands._min)||bands._min==null){bands._min=p[1]}}
for(var i=0,l=bd[1].length;i<l;i++){p=bd[1][i];if((p[1]!=null&&p[1]>bands._max)||bands._max==null){bands._max=p[1];bdmaxidx=1}
if((p[1]!=null&&p[1]<bands._min)||bands._min==null){bands._min=p[1];bdminidx=1}}
if(bdmaxidx===bdminidx){bands.show=!1}
bands.hiData=bd[bdmaxidx];bands.lowData=bd[bdminidx]}
else if(bd[0].length===data.length&&bd[1].length===data.length){var hi=(bd[0][0]>bd[1][0])?0:1;var low=(hi)?0:1;for(var i=0,l=data.length;i<l;i++){bands.hiData.push([data[i][0],bd[hi][i]]);bands.lowData.push([data[i][0],bd[low][i]])}}
else{bands.show=!1}}
else if(bd.length>2&&!$.isArray(bd[0][0])){var hi=(bd[0][0]>bd[0][1])?0:1;var low=(hi)?0:1;for(var i=0,l=bd.length;i<l;i++){bands.hiData.push([data[i][0],bd[i][hi]]);bands.lowData.push([data[i][0],bd[i][low]])}}
else{var intrv=bands.interval;var a=null;var b=null;var afunc=null;var bfunc=null;if($.isArray(intrv)){a=intrv[0];b=intrv[1]}
else{a=intrv}
if(isNaN(a)){if(a.charAt(a.length-1)==='%'){afunc='multiply';a=parseFloat(a)/100+1}}
else{a=parseFloat(a);afunc='add'}
if(b!==null&&isNaN(b)){if(b.charAt(b.length-1)==='%'){bfunc='multiply';b=parseFloat(b)/100+1}}
else if(b!==null){b=parseFloat(b);bfunc='add'}
if(a!==null){if(b===null){b=-a;bfunc=afunc;if(bfunc==='multiply'){b+=2}}
if(a<b){var temp=a;a=b;b=temp;temp=afunc;afunc=bfunc;bfunc=temp}
for(var i=0,l=data.length;i<l;i++){switch(afunc){case 'add':bands.hiData.push([data[i][0],data[i][1]+a]);break;case 'multiply':bands.hiData.push([data[i][0],data[i][1]*a]);break}
switch(bfunc){case 'add':bands.lowData.push([data[i][0],data[i][1]+b]);break;case 'multiply':bands.lowData.push([data[i][0],data[i][1]*b]);break}}}
else{bands.show=!1}}
var hd=bands.hiData;var ld=bands.lowData;for(var i=0,l=hd.length;i<l;i++){if((hd[i][1]!=null&&hd[i][1]>bands._max)||bands._max==null){bands._max=hd[i][1]}}
for(var i=0,l=ld.length;i<l;i++){if((ld[i][1]!=null&&ld[i][1]<bands._min)||bands._min==null){bands._min=ld[i][1]}}
if(bands.fillColor===null){var c=$.jqplot.getColorComponents(bands.color);c[3]=c[3]*0.5;bands.fillColor='rgba('+c[0]+', '+c[1]+', '+c[2]+', '+c[3]+')'}};function getSteps(d,f){return(3.4182054+f)*Math.pow(d,-0.3534992)}
function computeSteps(d1,d2){var s=Math.sqrt(Math.pow((d2[0]-d1[0]),2)+Math.pow((d2[1]-d1[1]),2));return 5.7648*Math.log(s)+7.4456}
function tanh(x){var a=(Math.exp(2*x)-1)/(Math.exp(2*x)+1);return a}
function computeConstrainedSmoothedData(gd){var smooth=this.renderer.smooth;var dim=this.canvas.getWidth();var xp=this._xaxis.series_p2u;var yp=this._yaxis.series_p2u;var steps=null;var _steps=null;var dist=gd.length/dim;var _smoothedData=[];var _smoothedPlotData=[];if(!isNaN(parseFloat(smooth))){steps=parseFloat(smooth)}
else{steps=getSteps(dist,0.5)}
var yy=[];var xx=[];for(var i=0,l=gd.length;i<l;i++){yy.push(gd[i][1]);xx.push(gd[i][0])}
function dxx(x1,x0){if(x1-x0==0){return Math.pow(10,10)}
else{return x1-x0}}
var A,B,C,D;var nmax=gd.length-1;for(var num=1,gdl=gd.length;num<gdl;num++){var gxx=[];var ggxx=[];for(var j=0;j<2;j++){var i=num-1+j;if(i==0||i==nmax){gxx[j]=Math.pow(10,10)}
else if(yy[i+1]-yy[i]==0||yy[i]-yy[i-1]==0){gxx[j]=0}
else if(((xx[i+1]-xx[i])/(yy[i+1]-yy[i])+(xx[i]-xx[i-1])/(yy[i]-yy[i-1]))==0){gxx[j]=0}
else if((yy[i+1]-yy[i])*(yy[i]-yy[i-1])<0){gxx[j]=0}
else{gxx[j]=2/(dxx(xx[i+1],xx[i])/(yy[i+1]-yy[i])+dxx(xx[i],xx[i-1])/(yy[i]-yy[i-1]))}}
if(num==1){gxx[0]=3/2*(yy[1]-yy[0])/dxx(xx[1],xx[0])-gxx[1]/2}
else if(num==nmax){gxx[1]=3/2*(yy[nmax]-yy[nmax-1])/dxx(xx[nmax],xx[nmax-1])-gxx[0]/2}
ggxx[0]=-2*(gxx[1]+2*gxx[0])/dxx(xx[num],xx[num-1])+6*(yy[num]-yy[num-1])/Math.pow(dxx(xx[num],xx[num-1]),2);ggxx[1]=2*(2*gxx[1]+gxx[0])/dxx(xx[num],xx[num-1])-6*(yy[num]-yy[num-1])/Math.pow(dxx(xx[num],xx[num-1]),2);D=1/6*(ggxx[1]-ggxx[0])/dxx(xx[num],xx[num-1]);C=1/2*(xx[num]*ggxx[0]-xx[num-1]*ggxx[1])/dxx(xx[num],xx[num-1]);B=(yy[num]-yy[num-1]-C*(Math.pow(xx[num],2)-Math.pow(xx[num-1],2))-D*(Math.pow(xx[num],3)-Math.pow(xx[num-1],3)))/dxx(xx[num],xx[num-1]);A=yy[num-1]-B*xx[num-1]-C*Math.pow(xx[num-1],2)-D*Math.pow(xx[num-1],3);var increment=(xx[num]-xx[num-1])/steps;var temp,tempx;for(var j=0,l=steps;j<l;j++){temp=[];tempx=xx[num-1]+j*increment;temp.push(tempx);temp.push(A+B*tempx+C*Math.pow(tempx,2)+D*Math.pow(tempx,3));_smoothedData.push(temp);_smoothedPlotData.push([xp(temp[0]),yp(temp[1])])}}
_smoothedData.push(gd[i]);_smoothedPlotData.push([xp(gd[i][0]),yp(gd[i][1])]);return[_smoothedData,_smoothedPlotData]}
function computeHermiteSmoothedData(gd){var smooth=this.renderer.smooth;var tension=this.renderer.tension;var dim=this.canvas.getWidth();var xp=this._xaxis.series_p2u;var yp=this._yaxis.series_p2u;var steps=null;var _steps=null;var a=null;var a1=null;var a2=null;var slope=null;var slope2=null;var temp=null;var t,s,h1,h2,h3,h4;var TiX,TiY,Ti1X,Ti1Y;var pX,pY,p;var sd=[];var spd=[];var dist=gd.length/dim;var min,max,stretch,scale,shift;var _smoothedData=[];var _smoothedPlotData=[];if(!isNaN(parseFloat(smooth))){steps=parseFloat(smooth)}
else{steps=getSteps(dist,0.5)}
if(!isNaN(parseFloat(tension))){tension=parseFloat(tension)}
for(var i=0,l=gd.length-1;i<l;i++){if(tension===null){slope=Math.abs((gd[i+1][1]-gd[i][1])/(gd[i+1][0]-gd[i][0]));min=0.3;max=0.6;stretch=(max-min)/2.0;scale=2.5;shift=-1.4;temp=slope/scale+shift;a1=stretch*tanh(temp)-stretch*tanh(shift)+min;if(i>0){slope2=Math.abs((gd[i][1]-gd[i-1][1])/(gd[i][0]-gd[i-1][0]))}
temp=slope2/scale+shift;a2=stretch*tanh(temp)-stretch*tanh(shift)+min;a=(a1+a2)/2.0}
else{a=tension}
for(t=0;t<steps;t++){s=t/steps;h1=(1+2*s)*Math.pow((1-s),2);h2=s*Math.pow((1-s),2);h3=Math.pow(s,2)*(3-2*s);h4=Math.pow(s,2)*(s-1);if(gd[i-1]){TiX=a*(gd[i+1][0]-gd[i-1][0]);TiY=a*(gd[i+1][1]-gd[i-1][1])}else{TiX=a*(gd[i+1][0]-gd[i][0]);TiY=a*(gd[i+1][1]-gd[i][1])}
if(gd[i+2]){Ti1X=a*(gd[i+2][0]-gd[i][0]);Ti1Y=a*(gd[i+2][1]-gd[i][1])}else{Ti1X=a*(gd[i+1][0]-gd[i][0]);Ti1Y=a*(gd[i+1][1]-gd[i][1])}
pX=h1*gd[i][0]+h3*gd[i+1][0]+h2*TiX+h4*Ti1X;pY=h1*gd[i][1]+h3*gd[i+1][1]+h2*TiY+h4*Ti1Y;p=[pX,pY];_smoothedData.push(p);_smoothedPlotData.push([xp(pX),yp(pY)])}}
_smoothedData.push(gd[l]);_smoothedPlotData.push([xp(gd[l][0]),yp(gd[l][1])]);return[_smoothedData,_smoothedPlotData]}
$.jqplot.LineRenderer.prototype.setGridData=function(plot){var xp=this._xaxis.series_u2p;var yp=this._yaxis.series_u2p;var data=this._plotData;var pdata=this._prevPlotData;this.gridData=[];this._prevGridData=[];this.renderer._smoothedData=[];this.renderer._smoothedPlotData=[];this.renderer._hiBandGridData=[];this.renderer._lowBandGridData=[];this.renderer._hiBandSmoothedData=[];this.renderer._lowBandSmoothedData=[];var bands=this.renderer.bands;var hasNull=!1;for(var i=0,l=data.length;i<l;i++){if(data[i][0]!=null&&data[i][1]!=null){this.gridData.push([xp.call(this._xaxis,data[i][0]),yp.call(this._yaxis,data[i][1])])}
else if(data[i][0]==null){hasNull=!0;this.gridData.push([null,yp.call(this._yaxis,data[i][1])])}
else if(data[i][1]==null){hasNull=!0;this.gridData.push([xp.call(this._xaxis,data[i][0]),null])}
if(pdata[i]!=null&&pdata[i][0]!=null&&pdata[i][1]!=null){this._prevGridData.push([xp.call(this._xaxis,pdata[i][0]),yp.call(this._yaxis,pdata[i][1])])}
else if(pdata[i]!=null&&pdata[i][0]==null){this._prevGridData.push([null,yp.call(this._yaxis,pdata[i][1])])}
else if(pdata[i]!=null&&pdata[i][0]!=null&&pdata[i][1]==null){this._prevGridData.push([xp.call(this._xaxis,pdata[i][0]),null])}}
if(hasNull){this.renderer.smooth=!1;if(this._type==='line'){bands.show=!1}}
if(this._type==='line'&&bands.show){for(var i=0,l=bands.hiData.length;i<l;i++){this.renderer._hiBandGridData.push([xp.call(this._xaxis,bands.hiData[i][0]),yp.call(this._yaxis,bands.hiData[i][1])])}
for(var i=0,l=bands.lowData.length;i<l;i++){this.renderer._lowBandGridData.push([xp.call(this._xaxis,bands.lowData[i][0]),yp.call(this._yaxis,bands.lowData[i][1])])}}
if(this._type==='line'&&this.renderer.smooth&&this.gridData.length>2){var ret;if(this.renderer.constrainSmoothing){ret=computeConstrainedSmoothedData.call(this,this.gridData);this.renderer._smoothedData=ret[0];this.renderer._smoothedPlotData=ret[1];if(bands.show){ret=computeConstrainedSmoothedData.call(this,this.renderer._hiBandGridData);this.renderer._hiBandSmoothedData=ret[0];ret=computeConstrainedSmoothedData.call(this,this.renderer._lowBandGridData);this.renderer._lowBandSmoothedData=ret[0]}
ret=null}
else{ret=computeHermiteSmoothedData.call(this,this.gridData);this.renderer._smoothedData=ret[0];this.renderer._smoothedPlotData=ret[1];if(bands.show){ret=computeHermiteSmoothedData.call(this,this.renderer._hiBandGridData);this.renderer._hiBandSmoothedData=ret[0];ret=computeHermiteSmoothedData.call(this,this.renderer._lowBandGridData);this.renderer._lowBandSmoothedData=ret[0]}
ret=null}}};$.jqplot.LineRenderer.prototype.makeGridData=function(data,plot){var xp=this._xaxis.series_u2p;var yp=this._yaxis.series_u2p;var gd=[];var pgd=[];this.renderer._smoothedData=[];this.renderer._smoothedPlotData=[];this.renderer._hiBandGridData=[];this.renderer._lowBandGridData=[];this.renderer._hiBandSmoothedData=[];this.renderer._lowBandSmoothedData=[];var bands=this.renderer.bands;var hasNull=!1;for(var i=0;i<data.length;i++){if(data[i][0]!=null&&data[i][1]!=null){gd.push([xp.call(this._xaxis,data[i][0]),yp.call(this._yaxis,data[i][1])])}
else if(data[i][0]==null){hasNull=!0;gd.push([null,yp.call(this._yaxis,data[i][1])])}
else if(data[i][1]==null){hasNull=!0;gd.push([xp.call(this._xaxis,data[i][0]),null])}}
if(hasNull){this.renderer.smooth=!1;if(this._type==='line'){bands.show=!1}}
if(this._type==='line'&&bands.show){for(var i=0,l=bands.hiData.length;i<l;i++){this.renderer._hiBandGridData.push([xp.call(this._xaxis,bands.hiData[i][0]),yp.call(this._yaxis,bands.hiData[i][1])])}
for(var i=0,l=bands.lowData.length;i<l;i++){this.renderer._lowBandGridData.push([xp.call(this._xaxis,bands.lowData[i][0]),yp.call(this._yaxis,bands.lowData[i][1])])}}
if(this._type==='line'&&this.renderer.smooth&&gd.length>2){var ret;if(this.renderer.constrainSmoothing){ret=computeConstrainedSmoothedData.call(this,gd);this.renderer._smoothedData=ret[0];this.renderer._smoothedPlotData=ret[1];if(bands.show){ret=computeConstrainedSmoothedData.call(this,this.renderer._hiBandGridData);this.renderer._hiBandSmoothedData=ret[0];ret=computeConstrainedSmoothedData.call(this,this.renderer._lowBandGridData);this.renderer._lowBandSmoothedData=ret[0]}
ret=null}
else{ret=computeHermiteSmoothedData.call(this,gd);this.renderer._smoothedData=ret[0];this.renderer._smoothedPlotData=ret[1];if(bands.show){ret=computeHermiteSmoothedData.call(this,this.renderer._hiBandGridData);this.renderer._hiBandSmoothedData=ret[0];ret=computeHermiteSmoothedData.call(this,this.renderer._lowBandGridData);this.renderer._lowBandSmoothedData=ret[0]}
ret=null}}
return gd};$.jqplot.LineRenderer.prototype.draw=function(ctx,gd,options,plot){var i;var opts=$.extend(!0,{},options);var shadow=(opts.shadow!=undefined)?opts.shadow:this.shadow;var showLine=(opts.showLine!=undefined)?opts.showLine:this.showLine;var fill=(opts.fill!=undefined)?opts.fill:this.fill;var fillAndStroke=(opts.fillAndStroke!=undefined)?opts.fillAndStroke:this.fillAndStroke;var xmin,ymin,xmax,ymax;ctx.save();if(gd.length){if(showLine){if(fill){if(this.fillToZero){var negativeColor=this.negativeColor;if(!this.useNegativeColors){negativeColor=opts.fillStyle}
var isnegative=!1;var posfs=opts.fillStyle;if(fillAndStroke){var fasgd=gd.slice(0)}
if(this.index==0||!this._stack){var tempgd=[];var pd=(this.renderer.smooth)?this.renderer._smoothedPlotData:this._plotData;this._areaPoints=[];var pyzero=this._yaxis.series_u2p(this.fillToValue);var pxzero=this._xaxis.series_u2p(this.fillToValue);opts.closePath=!0;if(this.fillAxis=='y'){tempgd.push([gd[0][0],pyzero]);this._areaPoints.push([gd[0][0],pyzero]);for(var i=0;i<gd.length-1;i++){tempgd.push(gd[i]);this._areaPoints.push(gd[i]);if(pd[i][1]*pd[i+1][1]<=0){if(pd[i][1]<0){isnegative=!0;opts.fillStyle=negativeColor}
else{isnegative=!1;opts.fillStyle=posfs}
var xintercept=gd[i][0]+(gd[i+1][0]-gd[i][0])*(pyzero-gd[i][1])/(gd[i+1][1]-gd[i][1]);tempgd.push([xintercept,pyzero]);this._areaPoints.push([xintercept,pyzero]);if(shadow){this.renderer.shadowRenderer.draw(ctx,tempgd,opts)}
this.renderer.shapeRenderer.draw(ctx,tempgd,opts);tempgd=[[xintercept,pyzero]]}}
if(pd[gd.length-1][1]<0){isnegative=!0;opts.fillStyle=negativeColor}
else{isnegative=!1;opts.fillStyle=posfs}
tempgd.push(gd[gd.length-1]);this._areaPoints.push(gd[gd.length-1]);tempgd.push([gd[gd.length-1][0],pyzero]);this._areaPoints.push([gd[gd.length-1][0],pyzero])}
if(shadow){this.renderer.shadowRenderer.draw(ctx,tempgd,opts)}
this.renderer.shapeRenderer.draw(ctx,tempgd,opts)}
else{var prev=this._prevGridData;for(var i=prev.length;i>0;i--){gd.push(prev[i-1])}
if(shadow){this.renderer.shadowRenderer.draw(ctx,gd,opts)}
this._areaPoints=gd;this.renderer.shapeRenderer.draw(ctx,gd,opts)}}
else{if(fillAndStroke){var fasgd=gd.slice(0)}
if(this.index==0||!this._stack){var gridymin=ctx.canvas.height;gd.unshift([gd[0][0],gridymin]);var len=gd.length;gd.push([gd[len-1][0],gridymin])}
else{var prev=this._prevGridData;for(var i=prev.length;i>0;i--){gd.push(prev[i-1])}}
this._areaPoints=gd;if(shadow){this.renderer.shadowRenderer.draw(ctx,gd,opts)}
this.renderer.shapeRenderer.draw(ctx,gd,opts)}
if(fillAndStroke){var fasopts=$.extend(!0,{},opts,{fill:!1,closePath:!1});this.renderer.shapeRenderer.draw(ctx,fasgd,fasopts);if(this.markerRenderer.show){if(this.renderer.smooth){fasgd=this.gridData}
for(i=0;i<fasgd.length;i++){this.markerRenderer.draw(fasgd[i][0],fasgd[i][1],ctx,opts.markerOptions)}}}}
else{if(this.renderer.bands.show){var bdat;var bopts=$.extend(!0,{},opts);if(this.renderer.bands.showLines){bdat=(this.renderer.smooth)?this.renderer._hiBandSmoothedData:this.renderer._hiBandGridData;this.renderer.shapeRenderer.draw(ctx,bdat,opts);bdat=(this.renderer.smooth)?this.renderer._lowBandSmoothedData:this.renderer._lowBandGridData;this.renderer.shapeRenderer.draw(ctx,bdat,bopts)}
if(this.renderer.bands.fill){if(this.renderer.smooth){bdat=this.renderer._hiBandSmoothedData.concat(this.renderer._lowBandSmoothedData.reverse())}
else{bdat=this.renderer._hiBandGridData.concat(this.renderer._lowBandGridData.reverse())}
this._areaPoints=bdat;bopts.closePath=!0;bopts.fill=!0;bopts.fillStyle=this.renderer.bands.fillColor;this.renderer.shapeRenderer.draw(ctx,bdat,bopts)}}
if(shadow){this.renderer.shadowRenderer.draw(ctx,gd,opts)}
this.renderer.shapeRenderer.draw(ctx,gd,opts)}}
var xmin=xmax=ymin=ymax=null;for(i=0;i<this._areaPoints.length;i++){var p=this._areaPoints[i];if(xmin>p[0]||xmin==null){xmin=p[0]}
if(ymax<p[1]||ymax==null){ymax=p[1]}
if(xmax<p[0]||xmax==null){xmax=p[0]}
if(ymin>p[1]||ymin==null){ymin=p[1]}}
if(this.type==='line'&&this.renderer.bands.show){ymax=this._yaxis.series_u2p(this.renderer.bands._min);ymin=this._yaxis.series_u2p(this.renderer.bands._max)}
this._boundingBox=[[xmin,ymax],[xmax,ymin]];if(this.markerRenderer.show&&!fill){if(this.renderer.smooth){gd=this.gridData}
for(i=0;i<gd.length;i++){if(gd[i][0]!=null&&gd[i][1]!=null){this.markerRenderer.draw(gd[i][0],gd[i][1],ctx,opts.markerOptions)}}}}
ctx.restore()};$.jqplot.LineRenderer.prototype.drawShadow=function(ctx,gd,options){};function postInit(target,data,options){for(var i=0;i<this.series.length;i++){if(this.series[i].renderer.constructor==$.jqplot.LineRenderer){if(this.series[i].highlightMouseOver){this.series[i].highlightMouseDown=!1}}}}
function postPlotDraw(){if(this.plugins.lineRenderer&&this.plugins.lineRenderer.highlightCanvas){this.plugins.lineRenderer.highlightCanvas.resetCanvas();this.plugins.lineRenderer.highlightCanvas=null}
this.plugins.lineRenderer.highlightedSeriesIndex=null;this.plugins.lineRenderer.highlightCanvas=new $.jqplot.GenericCanvas();this.eventCanvas._elem.before(this.plugins.lineRenderer.highlightCanvas.createElement(this._gridPadding,'jqplot-lineRenderer-highlight-canvas',this._plotDimensions,this));this.plugins.lineRenderer.highlightCanvas.setContext();this.eventCanvas._elem.bind('mouseleave',{plot:this},function(ev){unhighlight(ev.data.plot)})}
function highlight(plot,sidx,pidx,points){var s=plot.series[sidx];var canvas=plot.plugins.lineRenderer.highlightCanvas;canvas._ctx.clearRect(0,0,canvas._ctx.canvas.width,canvas._ctx.canvas.height);s._highlightedPoint=pidx;plot.plugins.lineRenderer.highlightedSeriesIndex=sidx;var opts={fillStyle:s.highlightColor};if(s.type==='line'&&s.renderer.bands.show){opts.fill=!0;opts.closePath=!0}
s.renderer.shapeRenderer.draw(canvas._ctx,points,opts);canvas=null}
function unhighlight(plot){var canvas=plot.plugins.lineRenderer.highlightCanvas;canvas._ctx.clearRect(0,0,canvas._ctx.canvas.width,canvas._ctx.canvas.height);for(var i=0;i<plot.series.length;i++){plot.series[i]._highlightedPoint=null}
plot.plugins.lineRenderer.highlightedSeriesIndex=null;plot.target.trigger('jqplotDataUnhighlight');canvas=null}
function handleMove(ev,gridpos,datapos,neighbor,plot){if(neighbor){var ins=[neighbor.seriesIndex,neighbor.pointIndex,neighbor.data];var evt1=jQuery.Event('jqplotDataMouseOver');evt1.pageX=ev.pageX;evt1.pageY=ev.pageY;plot.target.trigger(evt1,ins);if(plot.series[ins[0]].highlightMouseOver&&!(ins[0]==plot.plugins.lineRenderer.highlightedSeriesIndex)){var evt=jQuery.Event('jqplotDataHighlight');evt.which=ev.which;evt.pageX=ev.pageX;evt.pageY=ev.pageY;plot.target.trigger(evt,ins);highlight(plot,neighbor.seriesIndex,neighbor.pointIndex,neighbor.points)}}
else if(neighbor==null){unhighlight(plot)}}
function handleMouseDown(ev,gridpos,datapos,neighbor,plot){if(neighbor){var ins=[neighbor.seriesIndex,neighbor.pointIndex,neighbor.data];if(plot.series[ins[0]].highlightMouseDown&&!(ins[0]==plot.plugins.lineRenderer.highlightedSeriesIndex)){var evt=jQuery.Event('jqplotDataHighlight');evt.which=ev.which;evt.pageX=ev.pageX;evt.pageY=ev.pageY;plot.target.trigger(evt,ins);highlight(plot,neighbor.seriesIndex,neighbor.pointIndex,neighbor.points)}}
else if(neighbor==null){unhighlight(plot)}}
function handleMouseUp(ev,gridpos,datapos,neighbor,plot){var idx=plot.plugins.lineRenderer.highlightedSeriesIndex;if(idx!=null&&plot.series[idx].highlightMouseDown){unhighlight(plot)}}
function handleClick(ev,gridpos,datapos,neighbor,plot){if(neighbor){var ins=[neighbor.seriesIndex,neighbor.pointIndex,neighbor.data];var evt=jQuery.Event('jqplotDataClick');evt.which=ev.which;evt.pageX=ev.pageX;evt.pageY=ev.pageY;plot.target.trigger(evt,ins)}}
function handleRightClick(ev,gridpos,datapos,neighbor,plot){if(neighbor){var ins=[neighbor.seriesIndex,neighbor.pointIndex,neighbor.data];var idx=plot.plugins.lineRenderer.highlightedSeriesIndex;if(idx!=null&&plot.series[idx].highlightMouseDown){unhighlight(plot)}
var evt=jQuery.Event('jqplotDataRightClick');evt.which=ev.which;evt.pageX=ev.pageX;evt.pageY=ev.pageY;plot.target.trigger(evt,ins)}}
$.jqplot.LinearAxisRenderer=function(){};$.jqplot.LinearAxisRenderer.prototype.init=function(options){this.breakPoints=null;this.breakTickLabel="&asymp;";this.drawBaseline=!0;this.baselineWidth=null;this.baselineColor=null;this.forceTickAt0=!1;this.forceTickAt100=!1;this.tickInset=0;this.minorTicks=0;this.alignTicks=!1;this._autoFormatString='';this._overrideFormatString=!1;this._scalefact=1.0;$.extend(!0,this,options);if(this.breakPoints){if(!$.isArray(this.breakPoints)){this.breakPoints=null}
else if(this.breakPoints.length<2||this.breakPoints[1]<=this.breakPoints[0]){this.breakPoints=null}}
if(this.numberTicks!=null&&this.numberTicks<2){this.numberTicks=2}
this.resetDataBounds()};$.jqplot.LinearAxisRenderer.prototype.draw=function(ctx,plot){if(this.show){this.renderer.createTicks.call(this,plot);var dim=0;var temp;if(this._elem){this._elem.emptyForce();this._elem=null}
this._elem=$(document.createElement('div'));this._elem.addClass('jqplot-axis jqplot-'+this.name);this._elem.css('position','absolute');if(this.name=='xaxis'||this.name=='x2axis'){this._elem.width(this._plotDimensions.width)}
else{this._elem.height(this._plotDimensions.height)}
this.labelOptions.axis=this.name;this._label=new this.labelRenderer(this.labelOptions);if(this._label.show){var elem=this._label.draw(ctx,plot);elem.appendTo(this._elem);elem=null}
var t=this._ticks;var tick;for(var i=0;i<t.length;i++){tick=t[i];if(tick.show&&tick.showLabel&&(!tick.isMinorTick||this.showMinorTicks)){this._elem.append(tick.draw(ctx,plot))}}
tick=null;t=null}
return this._elem};$.jqplot.LinearAxisRenderer.prototype.reset=function(){this.min=this._options.min;this.max=this._options.max;this.tickInterval=this._options.tickInterval;this.numberTicks=this._options.numberTicks;this._autoFormatString='';if(this._overrideFormatString&&this.tickOptions&&this.tickOptions.formatString){this.tickOptions.formatString=''}};$.jqplot.LinearAxisRenderer.prototype.set=function(){var dim=0;var temp;var w=0;var h=0;var lshow=(this._label==null)?!1:this._label.show;if(this.show){var t=this._ticks;var tick;for(var i=0;i<t.length;i++){tick=t[i];if(!tick._breakTick&&tick.show&&tick.showLabel&&(!tick.isMinorTick||this.showMinorTicks)){if(this.name=='xaxis'||this.name=='x2axis'){temp=tick._elem.outerHeight(!0)}
else{temp=tick._elem.outerWidth(!0)}
if(temp>dim){dim=temp}}}
tick=null;t=null;if(lshow){w=this._label._elem.outerWidth(!0);h=this._label._elem.outerHeight(!0)}
if(this.name=='xaxis'){dim=dim+h;this._elem.css({'height':dim+'px',left:'0px',bottom:'0px'})}
else if(this.name=='x2axis'){dim=dim+h;this._elem.css({'height':dim+'px',left:'0px',top:'0px'})}
else if(this.name=='yaxis'){dim=dim+w;this._elem.css({'width':dim+'px',left:'0px',top:'0px'});if(lshow&&this._label.constructor==$.jqplot.AxisLabelRenderer){this._label._elem.css('width',w+'px')}}
else{dim=dim+w;this._elem.css({'width':dim+'px',right:'0px',top:'0px'});if(lshow&&this._label.constructor==$.jqplot.AxisLabelRenderer){this._label._elem.css('width',w+'px')}}}};$.jqplot.LinearAxisRenderer.prototype.createTicks=function(plot){var ticks=this._ticks;var userTicks=this.ticks;var name=this.name;var db=this._dataBounds;var dim=(this.name.charAt(0)==='x')?this._plotDimensions.width:this._plotDimensions.height;var interval;var min,max;var pos1,pos2;var tt,i;var userMin=this.min;var userMax=this.max;var userNT=this.numberTicks;var userTI=this.tickInterval;var threshold=30;this._scalefact=(Math.max(dim,threshold+1)-threshold)/300.0;if(userTicks.length){for(i=0;i<userTicks.length;i++){var ut=userTicks[i];var t=new this.tickRenderer(this.tickOptions);if($.isArray(ut)){t.value=ut[0];if(this.breakPoints){if(ut[0]==this.breakPoints[0]){t.label=this.breakTickLabel;t._breakTick=!0;t.showGridline=!1;t.showMark=!1}
else if(ut[0]>this.breakPoints[0]&&ut[0]<=this.breakPoints[1]){t.show=!1;t.showGridline=!1;t.label=ut[1]}
else{t.label=ut[1]}}
else{t.label=ut[1]}
t.setTick(ut[0],this.name);this._ticks.push(t)}
else if($.isPlainObject(ut)){$.extend(!0,t,ut);t.axis=this.name;this._ticks.push(t)}
else{t.value=ut;if(this.breakPoints){if(ut==this.breakPoints[0]){t.label=this.breakTickLabel;t._breakTick=!0;t.showGridline=!1;t.showMark=!1}
else if(ut>this.breakPoints[0]&&ut<=this.breakPoints[1]){t.show=!1;t.showGridline=!1}}
t.setTick(ut,this.name);this._ticks.push(t)}}
this.numberTicks=userTicks.length;this.min=this._ticks[0].value;this.max=this._ticks[this.numberTicks-1].value;this.tickInterval=(this.max-this.min)/(this.numberTicks-1)}
else{if(name=='xaxis'||name=='x2axis'){dim=this._plotDimensions.width}
else{dim=this._plotDimensions.height}
var _numberTicks=this.numberTicks;if(this.alignTicks){if(this.name==='x2axis'&&plot.axes.xaxis.show){_numberTicks=plot.axes.xaxis.numberTicks}
else if(this.name.charAt(0)==='y'&&this.name!=='yaxis'&&this.name!=='yMidAxis'&&plot.axes.yaxis.show){_numberTicks=plot.axes.yaxis.numberTicks}}
min=((this.min!=null)?this.min:db.min);max=((this.max!=null)?this.max:db.max);var range=max-min;var rmin,rmax;var temp;if(this.tickOptions==null||!this.tickOptions.formatString){this._overrideFormatString=!0}
if(this.min==null||this.max==null&&this.tickInterval==null&&!this.autoscale){if(this.forceTickAt0){if(min>0){min=0}
if(max<0){max=0}}
if(this.forceTickAt100){if(min>100){min=100}
if(max<100){max=100}}
var keepMin=!1,keepMax=!1;if(this.min!=null){keepMin=!0}
else if(this.max!=null){keepMax=!0}
var ret=$.jqplot.LinearTickGenerator(min,max,this._scalefact,_numberTicks,keepMin,keepMax);var tumin=(this.min!=null)?min:min+range*(this.padMin-1);var tumax=(this.max!=null)?max:max-range*(this.padMax-1);if(min<tumin||max>tumax){tumin=(this.min!=null)?min:min-range*(this.padMin-1);tumax=(this.max!=null)?max:max+range*(this.padMax-1);ret=$.jqplot.LinearTickGenerator(tumin,tumax,this._scalefact,_numberTicks,keepMin,keepMax)}
this.min=ret[0];this.max=ret[1];this.numberTicks=ret[2];this._autoFormatString=ret[3];this.tickInterval=ret[4]}
else{if(min==max){var adj=0.05;if(min>0){adj=Math.max(Math.log(min)/Math.LN10,0.05)}
min-=adj;max+=adj}
if(this.autoscale&&this.min==null&&this.max==null){var rrange,ti,margin;var forceMinZero=!1;var forceZeroLine=!1;var intervals={min:null,max:null,average:null,stddev:null};for(var i=0;i<this._series.length;i++){var s=this._series[i];var faname=(s.fillAxis=='x')?s._xaxis.name:s._yaxis.name;if(this.name==faname){var vals=s._plotValues[s.fillAxis];var vmin=vals[0];var vmax=vals[0];for(var j=1;j<vals.length;j++){if(vals[j]<vmin){vmin=vals[j]}
else if(vals[j]>vmax){vmax=vals[j]}}
var dp=(vmax-vmin)/vmax;if(s.renderer.constructor==$.jqplot.BarRenderer){if(vmin>=0&&(s.fillToZero||dp>0.1)){forceMinZero=!0}
else{forceMinZero=!1;if(s.fill&&s.fillToZero&&vmin<0&&vmax>0){forceZeroLine=!0}
else{forceZeroLine=!1}}}
else if(s.fill){if(vmin>=0&&(s.fillToZero||dp>0.1)){forceMinZero=!0}
else if(vmin<0&&vmax>0&&s.fillToZero){forceMinZero=!1;forceZeroLine=!0}
else{forceMinZero=!1;forceZeroLine=!1}}
else if(vmin<0){forceMinZero=!1}}}
if(forceMinZero){this.numberTicks=2+Math.ceil((dim-(this.tickSpacing-1))/this.tickSpacing);this.min=0;userMin=0;ti=max/(this.numberTicks-1);temp=Math.pow(10,Math.abs(Math.floor(Math.log(ti)/Math.LN10)));if(ti/temp==parseInt(ti/temp,10)){ti+=temp}
this.tickInterval=Math.ceil(ti/temp)*temp;this.max=this.tickInterval*(this.numberTicks-1)}
else if(forceZeroLine){this.numberTicks=2+Math.ceil((dim-(this.tickSpacing-1))/this.tickSpacing);var ntmin=Math.ceil(Math.abs(min)/range*(this.numberTicks-1));var ntmax=this.numberTicks-1-ntmin;ti=Math.max(Math.abs(min/ntmin),Math.abs(max/ntmax));temp=Math.pow(10,Math.abs(Math.floor(Math.log(ti)/Math.LN10)));this.tickInterval=Math.ceil(ti/temp)*temp;this.max=this.tickInterval*ntmax;this.min=-this.tickInterval*ntmin}
else{if(this.numberTicks==null){if(this.tickInterval){this.numberTicks=3+Math.ceil(range/this.tickInterval)}
else{this.numberTicks=2+Math.ceil((dim-(this.tickSpacing-1))/this.tickSpacing)}}
if(this.tickInterval==null){ti=range/(this.numberTicks-1);if(ti<1){temp=Math.pow(10,Math.abs(Math.floor(Math.log(ti)/Math.LN10)))}
else{temp=1}
this.tickInterval=Math.ceil(ti*temp*this.pad)/temp}
else{temp=1/this.tickInterval}
rrange=this.tickInterval*(this.numberTicks-1);margin=(rrange-range)/2;if(this.min==null){this.min=Math.floor(temp*(min-margin))/temp}
if(this.max==null){this.max=this.min+rrange}}
var sf=$.jqplot.getSignificantFigures(this.tickInterval);var fstr;if(sf.digitsLeft>=sf.significantDigits){fstr='%d'}
else{var temp=Math.max(0,5-sf.digitsLeft);temp=Math.min(temp,sf.digitsRight);fstr='%.'+temp+'f'}
this._autoFormatString=fstr}
else{rmin=(this.min!=null)?this.min:min-range*(this.padMin-1);rmax=(this.max!=null)?this.max:max+range*(this.padMax-1);range=rmax-rmin;if(this.numberTicks==null){if(this.tickInterval!=null){this.numberTicks=Math.ceil((rmax-rmin)/this.tickInterval)+1}
else if(dim>100){this.numberTicks=parseInt(3+(dim-100)/75,10)}
else{this.numberTicks=2}}
if(this.tickInterval==null){this.tickInterval=range/(this.numberTicks-1)}
if(this.max==null){rmax=rmin+this.tickInterval*(this.numberTicks-1)}
if(this.min==null){rmin=rmax-this.tickInterval*(this.numberTicks-1)}
var sf=$.jqplot.getSignificantFigures(this.tickInterval);var fstr;if(sf.digitsLeft>=sf.significantDigits){fstr='%d'}
else{var temp=Math.max(0,5-sf.digitsLeft);temp=Math.min(temp,sf.digitsRight);fstr='%.'+temp+'f'}
this._autoFormatString=fstr;this.min=rmin;this.max=rmax}
if(this.renderer.constructor==$.jqplot.LinearAxisRenderer&&this._autoFormatString==''){range=this.max-this.min;var temptick=new this.tickRenderer(this.tickOptions);var fs=temptick.formatString||$.jqplot.config.defaultTickFormatString;var fs=fs.match($.jqplot.sprintf.regex)[0];var precision=0;if(fs){if(fs.search(/[fFeEgGpP]/)>-1){var m=fs.match(/\%\.(\d{0,})?[eEfFgGpP]/);if(m){precision=parseInt(m[1],10)}
else{precision=6}}
else if(fs.search(/[di]/)>-1){precision=0}
var fact=Math.pow(10,-precision);if(this.tickInterval<fact){if(userNT==null&&userTI==null){this.tickInterval=fact;if(userMax==null&&userMin==null){this.min=Math.floor(this._dataBounds.min/fact)*fact;if(this.min==this._dataBounds.min){this.min=this._dataBounds.min-this.tickInterval}
this.max=Math.ceil(this._dataBounds.max/fact)*fact;if(this.max==this._dataBounds.max){this.max=this._dataBounds.max+this.tickInterval}
var n=(this.max-this.min)/this.tickInterval;n=n.toFixed(11);n=Math.ceil(n);this.numberTicks=n+1}
else if(userMax==null){var n=(this._dataBounds.max-this.min)/this.tickInterval;n=n.toFixed(11);this.numberTicks=Math.ceil(n)+2;this.max=this.min+this.tickInterval*(this.numberTicks-1)}
else if(userMin==null){var n=(this.max-this._dataBounds.min)/this.tickInterval;n=n.toFixed(11);this.numberTicks=Math.ceil(n)+2;this.min=this.max-this.tickInterval*(this.numberTicks-1)}
else{this.numberTicks=Math.ceil((userMax-userMin)/this.tickInterval)+1;this.min=Math.floor(userMin*Math.pow(10,precision))/Math.pow(10,precision);this.max=Math.ceil(userMax*Math.pow(10,precision))/Math.pow(10,precision);this.numberTicks=Math.ceil((this.max-this.min)/this.tickInterval)+1}}}}}}
if(this._overrideFormatString&&this._autoFormatString!=''){this.tickOptions=this.tickOptions||{};this.tickOptions.formatString=this._autoFormatString}
var t,to;for(var i=0;i<this.numberTicks;i++){tt=this.min+i*this.tickInterval;t=new this.tickRenderer(this.tickOptions);t.setTick(tt,this.name);this._ticks.push(t);if(i<this.numberTicks-1){for(var j=0;j<this.minorTicks;j++){tt+=this.tickInterval/(this.minorTicks+1);to=$.extend(!0,{},this.tickOptions,{name:this.name,value:tt,label:'',isMinorTick:!0});t=new this.tickRenderer(to);this._ticks.push(t)}}
t=null}}
if(this.tickInset){this.min=this.min-this.tickInset*this.tickInterval;this.max=this.max+this.tickInset*this.tickInterval}
ticks=null};$.jqplot.LinearAxisRenderer.prototype.resetTickValues=function(opts){if($.isArray(opts)&&opts.length==this._ticks.length){var t;for(var i=0;i<opts.length;i++){t=this._ticks[i];t.value=opts[i];t.label=t.formatter(t.formatString,opts[i]);t.label=t.prefix+t.label;t._elem.html(t.label)}
t=null;this.min=$.jqplot.arrayMin(opts);this.max=$.jqplot.arrayMax(opts);this.pack()}};$.jqplot.LinearAxisRenderer.prototype.pack=function(pos,offsets){pos=pos||{};offsets=offsets||this._offsets;var ticks=this._ticks;var max=this.max;var min=this.min;var offmax=offsets.max;var offmin=offsets.min;var lshow=(this._label==null)?!1:this._label.show;for(var p in pos){this._elem.css(p,pos[p])}
this._offsets=offsets;var pixellength=offmax-offmin;var unitlength=max-min;if(this.breakPoints){unitlength=unitlength-this.breakPoints[1]+this.breakPoints[0];this.p2u=function(p){return(p-offmin)*unitlength/pixellength+min};this.u2p=function(u){if(u>this.breakPoints[0]&&u<this.breakPoints[1]){u=this.breakPoints[0]}
if(u<=this.breakPoints[0]){return(u-min)*pixellength/unitlength+offmin}
else{return(u-this.breakPoints[1]+this.breakPoints[0]-min)*pixellength/unitlength+offmin}};if(this.name.charAt(0)=='x'){this.series_u2p=function(u){if(u>this.breakPoints[0]&&u<this.breakPoints[1]){u=this.breakPoints[0]}
if(u<=this.breakPoints[0]){return(u-min)*pixellength/unitlength}
else{return(u-this.breakPoints[1]+this.breakPoints[0]-min)*pixellength/unitlength}};this.series_p2u=function(p){return p*unitlength/pixellength+min}}
else{this.series_u2p=function(u){if(u>this.breakPoints[0]&&u<this.breakPoints[1]){u=this.breakPoints[0]}
if(u>=this.breakPoints[1]){return(u-max)*pixellength/unitlength}
else{return(u+this.breakPoints[1]-this.breakPoints[0]-max)*pixellength/unitlength}};this.series_p2u=function(p){return p*unitlength/pixellength+max}}}
else{this.p2u=function(p){return(p-offmin)*unitlength/pixellength+min};this.u2p=function(u){return(u-min)*pixellength/unitlength+offmin};if(this.name=='xaxis'||this.name=='x2axis'){this.series_u2p=function(u){return(u-min)*pixellength/unitlength};this.series_p2u=function(p){return p*unitlength/pixellength+min}}
else{this.series_u2p=function(u){return(u-max)*pixellength/unitlength};this.series_p2u=function(p){return p*unitlength/pixellength+max}}}
if(this.show){if(this.name=='xaxis'||this.name=='x2axis'){for(var i=0;i<ticks.length;i++){var t=ticks[i];if(t.show&&t.showLabel){var shim;if(t.constructor==$.jqplot.CanvasAxisTickRenderer&&t.angle){var temp=(this.name=='xaxis')?1:-1;switch(t.labelPosition){case 'auto':if(temp*t.angle<0){shim=-t.getWidth()+t._textRenderer.height*Math.sin(-t._textRenderer.angle)/2}
else{shim=-t._textRenderer.height*Math.sin(t._textRenderer.angle)/2}
break;case 'end':shim=-t.getWidth()+t._textRenderer.height*Math.sin(-t._textRenderer.angle)/2;break;case 'start':shim=-t._textRenderer.height*Math.sin(t._textRenderer.angle)/2;break;case 'middle':shim=-t.getWidth()/2+t._textRenderer.height*Math.sin(-t._textRenderer.angle)/2;break;default:shim=-t.getWidth()/2+t._textRenderer.height*Math.sin(-t._textRenderer.angle)/2;break}}
else{shim=-t.getWidth()/2}
var val=this.u2p(t.value)+shim+'px';t._elem.css('left',val);t.pack()}}
if(lshow){var w=this._label._elem.outerWidth(!0);this._label._elem.css('left',offmin+pixellength/2-w/2+'px');if(this.name=='xaxis'){this._label._elem.css('bottom','0px')}
else{this._label._elem.css('top','0px')}
this._label.pack()}}
else{for(var i=0;i<ticks.length;i++){var t=ticks[i];if(t.show&&t.showLabel){var shim;if(t.constructor==$.jqplot.CanvasAxisTickRenderer&&t.angle){var temp=(this.name=='yaxis')?1:-1;switch(t.labelPosition){case 'auto':case 'end':if(temp*t.angle<0){shim=-t._textRenderer.height*Math.cos(-t._textRenderer.angle)/2}
else{shim=-t.getHeight()+t._textRenderer.height*Math.cos(t._textRenderer.angle)/2}
break;case 'start':if(t.angle>0){shim=-t._textRenderer.height*Math.cos(-t._textRenderer.angle)/2}
else{shim=-t.getHeight()+t._textRenderer.height*Math.cos(t._textRenderer.angle)/2}
break;case 'middle':shim=-t.getHeight()/2;break;default:shim=-t.getHeight()/2;break}}
else{shim=-t.getHeight()/2}
var val=this.u2p(t.value)+shim+'px';t._elem.css('top',val);t.pack()}}
if(lshow){var h=this._label._elem.outerHeight(!0);this._label._elem.css('top',offmax-pixellength/2-h/2+'px');if(this.name=='yaxis'){this._label._elem.css('left','0px')}
else{this._label._elem.css('right','0px')}
this._label.pack()}}}
ticks=null};function bestFormatString(interval)
{var fstr;interval=Math.abs(interval);if(interval>=10){fstr='%d'}
else if(interval>1){if(interval===parseInt(interval,10)){fstr='%d'}
else{fstr='%.1f'}}
else{var expv=-Math.floor(Math.log(interval)/Math.LN10);fstr='%.'+expv+'f'}
return fstr}
var _factors=[0.1,0.2,0.3,0.4,0.5,0.8,1,2,3,4,5];var _getLowerFactor=function(f){var i=_factors.indexOf(f);if(i>0){return _factors[i-1]}
else{return _factors[_factors.length-1]/100}};var _getHigherFactor=function(f){var i=_factors.indexOf(f);if(i<_factors.length-1){return _factors[i+1]}
else{return _factors[0]*100}};function bestConstrainedInterval(min,max,nttarget){var low=Math.floor(nttarget/2);var hi=Math.ceil(nttarget*1.5);var badness=Number.MAX_VALUE;var r=(max-min);var temp;var sd;var bestNT;var gsf=$.jqplot.getSignificantFigures;var fsd;var fs;var currentNT;var bestPrec;for(var i=0,l=hi-low+1;i<l;i++){currentNT=low+i;temp=r/(currentNT-1);sd=gsf(temp);temp=Math.abs(nttarget-currentNT)+sd.digitsRight;if(temp<badness){badness=temp;bestNT=currentNT;bestPrec=sd.digitsRight}
else if(temp===badness){if(sd.digitsRight<bestPrec){bestNT=currentNT;bestPrec=sd.digitsRight}}}
fsd=Math.max(bestPrec,Math.max(gsf(min).digitsRight,gsf(max).digitsRight));if(fsd===0){fs='%d'}
else{fs='%.'+fsd+'f'}
temp=r/(bestNT-1);return[min,max,bestNT,fs,temp]}
function bestInterval(range,numberTicks){numberTicks=numberTicks||7;var minimum=range/(numberTicks-1);var magnitude=Math.pow(10,Math.floor(Math.log(minimum)/Math.LN10));var residual=minimum/magnitude;var interval;if(magnitude<1){if(residual>5){interval=10*magnitude}
else if(residual>2){interval=5*magnitude}
else if(residual>1){interval=2*magnitude}
else{interval=magnitude}}
else{if(residual>5){interval=10*magnitude}
else if(residual>4){interval=5*magnitude}
else if(residual>3){interval=4*magnitude}
else if(residual>2){interval=3*magnitude}
else if(residual>1){interval=2*magnitude}
else{interval=magnitude}}
return interval}
function bestLinearInterval(range,scalefact){scalefact=scalefact||1;var expv=Math.floor(Math.log(range)/Math.LN10);var magnitude=Math.pow(10,expv);var f=range/magnitude;var fact;f=f/scalefact;if(f<=0.38){fact=0.1}
else if(f<=1.6){fact=0.2}
else if(f<=4.0){fact=0.5}
else if(f<=8.0){fact=1.0}
else if(f<=16.0){fact=2}
else{fact=5}
return fact*magnitude}
function bestLinearComponents(range,scalefact){var expv=Math.floor(Math.log(range)/Math.LN10);var magnitude=Math.pow(10,expv);var f=range/magnitude;var interval;var fact;f=f/scalefact;if(f<=0.38){fact=0.1}
else if(f<=1.6){fact=0.2}
else if(f<=4.0){fact=0.5}
else if(f<=8.0){fact=1.0}
else if(f<=16.0){fact=2}
else{fact=5}
interval=fact*magnitude;return[interval,fact,magnitude]}
$.jqplot.LinearTickGenerator=function(axis_min,axis_max,scalefact,numberTicks,keepMin,keepMax){keepMin=(keepMin===null)?!1:keepMin;keepMax=(keepMax===null||keepMin)?!1:keepMax;if(axis_min===axis_max){axis_max=(axis_max)?0:1}
scalefact=scalefact||1.0;if(axis_max<axis_min){var a=axis_max;axis_max=axis_min;axis_min=a}
var r=[];var ss=bestLinearInterval(axis_max-axis_min,scalefact);var gsf=$.jqplot.getSignificantFigures;if(numberTicks==null){if(!keepMin&&!keepMax){r[0]=Math.floor(axis_min/ss)*ss;r[1]=Math.ceil(axis_max/ss)*ss;r[2]=Math.round((r[1]-r[0])/ss+1.0);r[3]=bestFormatString(ss);r[4]=ss}
else if(keepMin){r[0]=axis_min;r[2]=Math.ceil((axis_max-axis_min)/ss+1.0);r[1]=axis_min+(r[2]-1)*ss;var digitsMin=gsf(axis_min).digitsRight;var digitsSS=gsf(ss).digitsRight;if(digitsMin<digitsSS){r[3]=bestFormatString(ss)}
else{r[3]='%.'+digitsMin+'f'}
r[4]=ss}
else if(keepMax){r[1]=axis_max;r[2]=Math.ceil((axis_max-axis_min)/ss+1.0);r[0]=axis_max-(r[2]-1)*ss;var digitsMax=gsf(axis_max).digitsRight;var digitsSS=gsf(ss).digitsRight;if(digitsMax<digitsSS){r[3]=bestFormatString(ss)}
else{r[3]='%.'+digitsMax+'f'}
r[4]=ss}}
else{var tempr=[];tempr[0]=Math.floor(axis_min/ss)*ss;tempr[1]=Math.ceil(axis_max/ss)*ss;tempr[2]=Math.round((tempr[1]-tempr[0])/ss+1.0);tempr[3]=bestFormatString(ss);tempr[4]=ss;if(tempr[2]===numberTicks){r=tempr}
else{var newti=bestInterval(tempr[1]-tempr[0],numberTicks);r[0]=tempr[0];r[2]=numberTicks;r[4]=newti;r[3]=bestFormatString(newti);r[1]=r[0]+(r[2]-1)*r[4]}}
return r};$.jqplot.LinearTickGenerator.bestLinearInterval=bestLinearInterval;$.jqplot.LinearTickGenerator.bestInterval=bestInterval;$.jqplot.LinearTickGenerator.bestLinearComponents=bestLinearComponents;$.jqplot.LinearTickGenerator.bestConstrainedInterval=bestConstrainedInterval;$.jqplot.MarkerRenderer=function(options){this.show=!0;this.style='filledCircle';this.lineWidth=2;this.size=9.0;this.color='#666666';this.shadow=!0;this.shadowAngle=45;this.shadowOffset=1;this.shadowDepth=3;this.shadowAlpha='0.07';this.shadowRenderer=new $.jqplot.ShadowRenderer();this.shapeRenderer=new $.jqplot.ShapeRenderer();$.extend(!0,this,options)};$.jqplot.MarkerRenderer.prototype.init=function(options){$.extend(!0,this,options);var sdopt={angle:this.shadowAngle,offset:this.shadowOffset,alpha:this.shadowAlpha,lineWidth:this.lineWidth,depth:this.shadowDepth,closePath:!0};if(this.style.indexOf('filled')!=-1){sdopt.fill=!0}
if(this.style.indexOf('ircle')!=-1){sdopt.isarc=!0;sdopt.closePath=!1}
this.shadowRenderer.init(sdopt);var shopt={fill:!1,isarc:!1,strokeStyle:this.color,fillStyle:this.color,lineWidth:this.lineWidth,closePath:!0};if(this.style.indexOf('filled')!=-1){shopt.fill=!0}
if(this.style.indexOf('ircle')!=-1){shopt.isarc=!0;shopt.closePath=!1}
this.shapeRenderer.init(shopt)};$.jqplot.MarkerRenderer.prototype.drawDiamond=function(x,y,ctx,fill,options){var stretch=1.2;var dx=this.size/2/stretch;var dy=this.size/2*stretch;var points=[[x-dx,y],[x,y+dy],[x+dx,y],[x,y-dy]];if(this.shadow){this.shadowRenderer.draw(ctx,points)}
this.shapeRenderer.draw(ctx,points,options)};$.jqplot.MarkerRenderer.prototype.drawPlus=function(x,y,ctx,fill,options){var stretch=1.0;var dx=this.size/2*stretch;var dy=this.size/2*stretch;var points1=[[x,y-dy],[x,y+dy]];var points2=[[x+dx,y],[x-dx,y]];var opts=$.extend(!0,{},this.options,{closePath:!1});if(this.shadow){this.shadowRenderer.draw(ctx,points1,{closePath:!1});this.shadowRenderer.draw(ctx,points2,{closePath:!1})}
this.shapeRenderer.draw(ctx,points1,opts);this.shapeRenderer.draw(ctx,points2,opts)};$.jqplot.MarkerRenderer.prototype.drawX=function(x,y,ctx,fill,options){var stretch=1.0;var dx=this.size/2*stretch;var dy=this.size/2*stretch;var opts=$.extend(!0,{},this.options,{closePath:!1});var points1=[[x-dx,y-dy],[x+dx,y+dy]];var points2=[[x-dx,y+dy],[x+dx,y-dy]];if(this.shadow){this.shadowRenderer.draw(ctx,points1,{closePath:!1});this.shadowRenderer.draw(ctx,points2,{closePath:!1})}
this.shapeRenderer.draw(ctx,points1,opts);this.shapeRenderer.draw(ctx,points2,opts)};$.jqplot.MarkerRenderer.prototype.drawDash=function(x,y,ctx,fill,options){var stretch=1.0;var dx=this.size/2*stretch;var dy=this.size/2*stretch;var points=[[x-dx,y],[x+dx,y]];if(this.shadow){this.shadowRenderer.draw(ctx,points)}
this.shapeRenderer.draw(ctx,points,options)};$.jqplot.MarkerRenderer.prototype.drawLine=function(p1,p2,ctx,fill,options){var points=[p1,p2];if(this.shadow){this.shadowRenderer.draw(ctx,points)}
this.shapeRenderer.draw(ctx,points,options)};$.jqplot.MarkerRenderer.prototype.drawSquare=function(x,y,ctx,fill,options){var stretch=1.0;var dx=this.size/2/stretch;var dy=this.size/2*stretch;var points=[[x-dx,y-dy],[x-dx,y+dy],[x+dx,y+dy],[x+dx,y-dy]];if(this.shadow){this.shadowRenderer.draw(ctx,points)}
this.shapeRenderer.draw(ctx,points,options)};$.jqplot.MarkerRenderer.prototype.drawCircle=function(x,y,ctx,fill,options){var radius=this.size/2;var end=2*Math.PI;var points=[x,y,radius,0,end,!0];if(this.shadow){this.shadowRenderer.draw(ctx,points)}
this.shapeRenderer.draw(ctx,points,options)};$.jqplot.MarkerRenderer.prototype.draw=function(x,y,ctx,options){options=options||{};if(options.show==null||options.show!=!1){if(options.color&&!options.fillStyle){options.fillStyle=options.color}
if(options.color&&!options.strokeStyle){options.strokeStyle=options.color}
switch(this.style){case 'diamond':this.drawDiamond(x,y,ctx,!1,options);break;case 'filledDiamond':this.drawDiamond(x,y,ctx,!0,options);break;case 'circle':this.drawCircle(x,y,ctx,!1,options);break;case 'filledCircle':this.drawCircle(x,y,ctx,!0,options);break;case 'square':this.drawSquare(x,y,ctx,!1,options);break;case 'filledSquare':this.drawSquare(x,y,ctx,!0,options);break;case 'x':this.drawX(x,y,ctx,!0,options);break;case 'plus':this.drawPlus(x,y,ctx,!0,options);break;case 'dash':this.drawDash(x,y,ctx,!0,options);break;case 'line':this.drawLine(x,y,ctx,!1,options);break;default:this.drawDiamond(x,y,ctx,!1,options);break}}};$.jqplot.ShadowRenderer=function(options){this.angle=45;this.offset=1;this.alpha=0.07;this.lineWidth=1.5;this.lineJoin='miter';this.lineCap='round';this.closePath=!1;this.fill=!1;this.depth=3;this.strokeStyle='rgba(0,0,0,0.1)';this.isarc=!1;$.extend(!0,this,options)};$.jqplot.ShadowRenderer.prototype.init=function(options){$.extend(!0,this,options)};$.jqplot.ShadowRenderer.prototype.draw=function(ctx,points,options){ctx.save();var opts=(options!=null)?options:{};var fill=(opts.fill!=null)?opts.fill:this.fill;var fillRect=(opts.fillRect!=null)?opts.fillRect:this.fillRect;var closePath=(opts.closePath!=null)?opts.closePath:this.closePath;var offset=(opts.offset!=null)?opts.offset:this.offset;var alpha=(opts.alpha!=null)?opts.alpha:this.alpha;var depth=(opts.depth!=null)?opts.depth:this.depth;var isarc=(opts.isarc!=null)?opts.isarc:this.isarc;var linePattern=(opts.linePattern!=null)?opts.linePattern:this.linePattern;ctx.lineWidth=(opts.lineWidth!=null)?opts.lineWidth:this.lineWidth;ctx.lineJoin=(opts.lineJoin!=null)?opts.lineJoin:this.lineJoin;ctx.lineCap=(opts.lineCap!=null)?opts.lineCap:this.lineCap;ctx.strokeStyle=opts.strokeStyle||this.strokeStyle||'rgba(0,0,0,'+alpha+')';ctx.fillStyle=opts.fillStyle||this.fillStyle||'rgba(0,0,0,'+alpha+')';for(var j=0;j<depth;j++){var ctxPattern=$.jqplot.LinePattern(ctx,linePattern);ctx.translate(Math.cos(this.angle*Math.PI/180)*offset,Math.sin(this.angle*Math.PI/180)*offset);ctxPattern.beginPath();if(isarc){ctx.arc(points[0],points[1],points[2],points[3],points[4],!0)}
else if(fillRect){if(fillRect){ctx.fillRect(points[0],points[1],points[2],points[3])}}
else if(points&&points.length){var move=!0;for(var i=0;i<points.length;i++){if(points[i][0]!=null&&points[i][1]!=null){if(move){ctxPattern.moveTo(points[i][0],points[i][1]);move=!1}
else{ctxPattern.lineTo(points[i][0],points[i][1])}}
else{move=!0}}}
if(closePath){ctxPattern.closePath()}
if(fill){ctx.fill()}
else{ctx.stroke()}}
ctx.restore()};$.jqplot.ShapeRenderer=function(options){this.lineWidth=1.5;this.linePattern='solid';this.lineJoin='miter';this.lineCap='round';this.closePath=!1;this.fill=!1;this.isarc=!1;this.fillRect=!1;this.strokeRect=!1;this.clearRect=!1;this.strokeStyle='#999999';this.fillStyle='#999999';$.extend(!0,this,options)};$.jqplot.ShapeRenderer.prototype.init=function(options){$.extend(!0,this,options)};$.jqplot.ShapeRenderer.prototype.draw=function(ctx,points,options){ctx.save();var opts=(options!=null)?options:{};var fill=(opts.fill!=null)?opts.fill:this.fill;var closePath=(opts.closePath!=null)?opts.closePath:this.closePath;var fillRect=(opts.fillRect!=null)?opts.fillRect:this.fillRect;var strokeRect=(opts.strokeRect!=null)?opts.strokeRect:this.strokeRect;var clearRect=(opts.clearRect!=null)?opts.clearRect:this.clearRect;var isarc=(opts.isarc!=null)?opts.isarc:this.isarc;var linePattern=(opts.linePattern!=null)?opts.linePattern:this.linePattern;var ctxPattern=$.jqplot.LinePattern(ctx,linePattern);ctx.lineWidth=opts.lineWidth||this.lineWidth;ctx.lineJoin=opts.lineJoin||this.lineJoin;ctx.lineCap=opts.lineCap||this.lineCap;ctx.strokeStyle=(opts.strokeStyle||opts.color)||this.strokeStyle;ctx.fillStyle=opts.fillStyle||this.fillStyle;ctx.beginPath();if(isarc){ctx.arc(points[0],points[1],points[2],points[3],points[4],!0);if(closePath){ctx.closePath()}
if(fill){ctx.fill()}
else{ctx.stroke()}
ctx.restore();return}
else if(clearRect){ctx.clearRect(points[0],points[1],points[2],points[3]);ctx.restore();return}
else if(fillRect||strokeRect){if(fillRect){ctx.fillRect(points[0],points[1],points[2],points[3])}
if(strokeRect){ctx.strokeRect(points[0],points[1],points[2],points[3]);ctx.restore();return}}
else if(points&&points.length){var move=!0;for(var i=0;i<points.length;i++){if(points[i][0]!=null&&points[i][1]!=null){if(move){ctxPattern.moveTo(points[i][0],points[i][1]);move=!1}
else{ctxPattern.lineTo(points[i][0],points[i][1])}}
else{move=!0}}
if(closePath){ctxPattern.closePath()}
if(fill){ctx.fill()}
else{ctx.stroke()}}
ctx.restore()};$.jqplot.TableLegendRenderer=function(){};$.jqplot.TableLegendRenderer.prototype.init=function(options){$.extend(!0,this,options)};$.jqplot.TableLegendRenderer.prototype.addrow=function(label,color,pad,reverse){var rs=(pad)?this.rowSpacing+'px':'0px';var tr;var td;var elem;var div0;var div1;elem=document.createElement('tr');tr=$(elem);tr.addClass('jqplot-table-legend');elem=null;if(reverse){tr.prependTo(this._elem)}
else{tr.appendTo(this._elem)}
if(this.showSwatches){td=$(document.createElement('td'));td.addClass('jqplot-table-legend jqplot-table-legend-swatch');td.css({textAlign:'center',paddingTop:rs});div0=$(document.createElement('div'));div0.addClass('jqplot-table-legend-swatch-outline');div1=$(document.createElement('div'));div1.addClass('jqplot-table-legend-swatch');div1.css({backgroundColor:color,borderColor:color});tr.append(td.append(div0.append(div1)))}
if(this.showLabels){td=$(document.createElement('td'));td.addClass('jqplot-table-legend jqplot-table-legend-label');td.css('paddingTop',rs);tr.append(td);if(this.escapeHtml){td.text(label)}
else{td.html(label)}}
td=null;div0=null;div1=null;tr=null;elem=null};$.jqplot.TableLegendRenderer.prototype.draw=function(){if(this._elem){this._elem.emptyForce();this._elem=null}
if(this.show){var series=this._series;var elem=document.createElement('table');this._elem=$(elem);this._elem.addClass('jqplot-table-legend');var ss={position:'absolute'};if(this.background){ss.background=this.background}
if(this.border){ss.border=this.border}
if(this.fontSize){ss.fontSize=this.fontSize}
if(this.fontFamily){ss.fontFamily=this.fontFamily}
if(this.textColor){ss.textColor=this.textColor}
if(this.marginTop!=null){ss.marginTop=this.marginTop}
if(this.marginBottom!=null){ss.marginBottom=this.marginBottom}
if(this.marginLeft!=null){ss.marginLeft=this.marginLeft}
if(this.marginRight!=null){ss.marginRight=this.marginRight}
var pad=!1,reverse=!1,s;for(var i=0;i<series.length;i++){s=series[i];if(s._stack||s.renderer.constructor==$.jqplot.BezierCurveRenderer){reverse=!0}
if(s.show&&s.showLabel){var lt=this.labels[i]||s.label.toString();if(lt){var color=s.color;if(reverse&&i<series.length-1){pad=!0}
else if(reverse&&i==series.length-1){pad=!1}
this.renderer.addrow.call(this,lt,color,pad,reverse);pad=!0}
for(var j=0;j<$.jqplot.addLegendRowHooks.length;j++){var item=$.jqplot.addLegendRowHooks[j].call(this,s);if(item){this.renderer.addrow.call(this,item.label,item.color,pad);pad=!0}}
lt=null}}}
return this._elem};$.jqplot.TableLegendRenderer.prototype.pack=function(offsets){if(this.show){if(this.placement=='insideGrid'){switch(this.location){case 'nw':var a=offsets.left;var b=offsets.top;this._elem.css('left',a);this._elem.css('top',b);break;case 'n':var a=(offsets.left+(this._plotDimensions.width-offsets.right))/2-this.getWidth()/2;var b=offsets.top;this._elem.css('left',a);this._elem.css('top',b);break;case 'ne':var a=offsets.right;var b=offsets.top;this._elem.css({right:a,top:b});break;case 'e':var a=offsets.right;var b=(offsets.top+(this._plotDimensions.height-offsets.bottom))/2-this.getHeight()/2;this._elem.css({right:a,top:b});break;case 'se':var a=offsets.right;var b=offsets.bottom;this._elem.css({right:a,bottom:b});break;case 's':var a=(offsets.left+(this._plotDimensions.width-offsets.right))/2-this.getWidth()/2;var b=offsets.bottom;this._elem.css({left:a,bottom:b});break;case 'sw':var a=offsets.left;var b=offsets.bottom;this._elem.css({left:a,bottom:b});break;case 'w':var a=offsets.left;var b=(offsets.top+(this._plotDimensions.height-offsets.bottom))/2-this.getHeight()/2;this._elem.css({left:a,top:b});break;default:var a=offsets.right;var b=offsets.bottom;this._elem.css({right:a,bottom:b});break}}
else if(this.placement=='outside'){switch(this.location){case 'nw':var a=this._plotDimensions.width-offsets.left;var b=offsets.top;this._elem.css('right',a);this._elem.css('top',b);break;case 'n':var a=(offsets.left+(this._plotDimensions.width-offsets.right))/2-this.getWidth()/2;var b=this._plotDimensions.height-offsets.top;this._elem.css('left',a);this._elem.css('bottom',b);break;case 'ne':var a=this._plotDimensions.width-offsets.right;var b=offsets.top;this._elem.css({left:a,top:b});break;case 'e':var a=this._plotDimensions.width-offsets.right;var b=(offsets.top+(this._plotDimensions.height-offsets.bottom))/2-this.getHeight()/2;this._elem.css({left:a,top:b});break;case 'se':var a=this._plotDimensions.width-offsets.right;var b=offsets.bottom;this._elem.css({left:a,bottom:b});break;case 's':var a=(offsets.left+(this._plotDimensions.width-offsets.right))/2-this.getWidth()/2;var b=this._plotDimensions.height-offsets.bottom;this._elem.css({left:a,top:b});break;case 'sw':var a=this._plotDimensions.width-offsets.left;var b=offsets.bottom;this._elem.css({right:a,bottom:b});break;case 'w':var a=this._plotDimensions.width-offsets.left;var b=(offsets.top+(this._plotDimensions.height-offsets.bottom))/2-this.getHeight()/2;this._elem.css({right:a,top:b});break;default:var a=offsets.right;var b=offsets.bottom;this._elem.css({right:a,bottom:b});break}}
else{switch(this.location){case 'nw':this._elem.css({left:0,top:offsets.top});break;case 'n':var a=(offsets.left+(this._plotDimensions.width-offsets.right))/2-this.getWidth()/2;this._elem.css({left:a,top:offsets.top});break;case 'ne':this._elem.css({right:0,top:offsets.top});break;case 'e':var b=(offsets.top+(this._plotDimensions.height-offsets.bottom))/2-this.getHeight()/2;this._elem.css({right:offsets.right,top:b});break;case 'se':this._elem.css({right:offsets.right,bottom:offsets.bottom});break;case 's':var a=(offsets.left+(this._plotDimensions.width-offsets.right))/2-this.getWidth()/2;this._elem.css({left:a,bottom:offsets.bottom});break;case 'sw':this._elem.css({left:offsets.left,bottom:offsets.bottom});break;case 'w':var b=(offsets.top+(this._plotDimensions.height-offsets.bottom))/2-this.getHeight()/2;this._elem.css({left:offsets.left,top:b});break;default:this._elem.css({right:offsets.right,bottom:offsets.bottom});break}}}};$.jqplot.ThemeEngine=function(){this.themes={};this.activeTheme=null};$.jqplot.ThemeEngine.prototype.init=function(){var th=new $.jqplot.Theme({_name:'Default'});var n,i,nn;for(n in th.target){if(n=="textColor"){th.target[n]=this.target.css('color')}
else{th.target[n]=this.target.css(n)}}
if(this.title.show&&this.title._elem){for(n in th.title){if(n=="textColor"){th.title[n]=this.title._elem.css('color')}
else{th.title[n]=this.title._elem.css(n)}}}
for(n in th.grid){th.grid[n]=this.grid[n]}
if(th.grid.backgroundColor==null&&this.grid.background!=null){th.grid.backgroundColor=this.grid.background}
if(this.legend.show&&this.legend._elem){for(n in th.legend){if(n=='textColor'){th.legend[n]=this.legend._elem.css('color')}
else{th.legend[n]=this.legend._elem.css(n)}}}
var s;for(i=0;i<this.series.length;i++){s=this.series[i];if(s.renderer.constructor==$.jqplot.LineRenderer){th.series.push(new LineSeriesProperties())}
else if(s.renderer.constructor==$.jqplot.BarRenderer){th.series.push(new BarSeriesProperties())}
else if(s.renderer.constructor==$.jqplot.PieRenderer){th.series.push(new PieSeriesProperties())}
else if(s.renderer.constructor==$.jqplot.DonutRenderer){th.series.push(new DonutSeriesProperties())}
else if(s.renderer.constructor==$.jqplot.FunnelRenderer){th.series.push(new FunnelSeriesProperties())}
else if(s.renderer.constructor==$.jqplot.MeterGaugeRenderer){th.series.push(new MeterSeriesProperties())}
else{th.series.push({})}
for(n in th.series[i]){th.series[i][n]=s[n]}}
var a,ax;for(n in this.axes){ax=this.axes[n];a=th.axes[n]=new AxisProperties();a.borderColor=ax.borderColor;a.borderWidth=ax.borderWidth;if(ax._ticks&&ax._ticks[0]){for(nn in a.ticks){if(ax._ticks[0].hasOwnProperty(nn)){a.ticks[nn]=ax._ticks[0][nn]}
else if(ax._ticks[0]._elem){a.ticks[nn]=ax._ticks[0]._elem.css(nn)}}}
if(ax._label&&ax._label.show){for(nn in a.label){if(ax._label[nn]){a.label[nn]=ax._label[nn]}
else if(ax._label._elem){if(nn=='textColor'){a.label[nn]=ax._label._elem.css('color')}
else{a.label[nn]=ax._label._elem.css(nn)}}}}}
this.themeEngine._add(th);this.themeEngine.activeTheme=this.themeEngine.themes[th._name]};$.jqplot.ThemeEngine.prototype.get=function(name){if(!name){return this.activeTheme}
else{return this.themes[name]}};function numericalOrder(a,b){return a-b}
$.jqplot.ThemeEngine.prototype.getThemeNames=function(){var tn=[];for(var n in this.themes){tn.push(n)}
return tn.sort(numericalOrder)};$.jqplot.ThemeEngine.prototype.getThemes=function(){var tn=[];var themes=[];for(var n in this.themes){tn.push(n)}
tn.sort(numericalOrder);for(var i=0;i<tn.length;i++){themes.push(this.themes[tn[i]])}
return themes};$.jqplot.ThemeEngine.prototype.activate=function(plot,name){var redrawPlot=!1;if(!name&&this.activeTheme&&this.activeTheme._name){name=this.activeTheme._name}
if(!this.themes.hasOwnProperty(name)){throw new Error("No theme of that name")}
else{var th=this.themes[name];this.activeTheme=th;var val,checkBorderColor=!1,checkBorderWidth=!1;var arr=['xaxis','x2axis','yaxis','y2axis'];for(i=0;i<arr.length;i++){var ax=arr[i];if(th.axesStyles.borderColor!=null){plot.axes[ax].borderColor=th.axesStyles.borderColor}
if(th.axesStyles.borderWidth!=null){plot.axes[ax].borderWidth=th.axesStyles.borderWidth}}
for(var axname in plot.axes){var axis=plot.axes[axname];if(axis.show){var thaxis=th.axes[axname]||{};var thaxstyle=th.axesStyles;var thax=$.jqplot.extend(!0,{},thaxis,thaxstyle);val=(th.axesStyles.borderColor!=null)?th.axesStyles.borderColor:thax.borderColor;if(thax.borderColor!=null){axis.borderColor=thax.borderColor;redrawPlot=!0}
val=(th.axesStyles.borderWidth!=null)?th.axesStyles.borderWidth:thax.borderWidth;if(thax.borderWidth!=null){axis.borderWidth=thax.borderWidth;redrawPlot=!0}
if(axis._ticks&&axis._ticks[0]){for(var nn in thax.ticks){val=thax.ticks[nn];if(val!=null){axis.tickOptions[nn]=val;axis._ticks=[];redrawPlot=!0}}}
if(axis._label&&axis._label.show){for(var nn in thax.label){val=thax.label[nn];if(val!=null){axis.labelOptions[nn]=val;redrawPlot=!0}}}}}
for(var n in th.grid){if(th.grid[n]!=null){plot.grid[n]=th.grid[n]}}
if(!redrawPlot){plot.grid.draw()}
if(plot.legend.show){for(n in th.legend){if(th.legend[n]!=null){plot.legend[n]=th.legend[n]}}}
if(plot.title.show){for(n in th.title){if(th.title[n]!=null){plot.title[n]=th.title[n]}}}
var i;for(i=0;i<th.series.length;i++){var opts={};var redrawSeries=!1;for(n in th.series[i]){val=(th.seriesStyles[n]!=null)?th.seriesStyles[n]:th.series[i][n];if(val!=null){opts[n]=val;if(n=='color'){plot.series[i].renderer.shapeRenderer.fillStyle=val;plot.series[i].renderer.shapeRenderer.strokeStyle=val;plot.series[i][n]=val}
else if((n=='lineWidth')||(n=='linePattern')){plot.series[i].renderer.shapeRenderer[n]=val;plot.series[i][n]=val}
else if(n=='markerOptions'){merge(plot.series[i].markerOptions,val);merge(plot.series[i].markerRenderer,val)}
else{plot.series[i][n]=val}
redrawPlot=!0}}}
if(redrawPlot){plot.target.empty();plot.draw()}
for(n in th.target){if(th.target[n]!=null){plot.target.css(n,th.target[n])}}}};$.jqplot.ThemeEngine.prototype._add=function(theme,name){if(name){theme._name=name}
if(!theme._name){theme._name=Date.parse(new Date())}
if(!this.themes.hasOwnProperty(theme._name)){this.themes[theme._name]=theme}
else{throw new Error("jqplot.ThemeEngine Error: Theme already in use")}};$.jqplot.ThemeEngine.prototype.remove=function(name){if(name=='Default'){return!1}
return delete this.themes[name]};$.jqplot.ThemeEngine.prototype.newTheme=function(name,obj){if(typeof(name)=='object'){obj=obj||name;name=null}
if(obj&&obj._name){name=obj._name}
else{name=name||Date.parse(new Date())}
var th=this.copy(this.themes.Default._name,name);$.jqplot.extend(th,obj);return th};function clone(obj){if(obj==null||typeof(obj)!='object'){return obj}
var temp=new obj.constructor();for(var key in obj){temp[key]=clone(obj[key])}
return temp}
$.jqplot.clone=clone;function merge(obj1,obj2){if(obj2==null||typeof(obj2)!='object'){return}
for(var key in obj2){if(key=='highlightColors'){obj1[key]=clone(obj2[key])}
if(obj2[key]!=null&&typeof(obj2[key])=='object'){if(!obj1.hasOwnProperty(key)){obj1[key]={}}
merge(obj1[key],obj2[key])}
else{obj1[key]=obj2[key]}}}
$.jqplot.merge=merge;$.jqplot.extend=function(){var target=arguments[0]||{},i=1,length=arguments.length,deep=!1,options;if(typeof target==="boolean"){deep=target;target=arguments[1]||{};i=2}
if(typeof target!=="object"&&!toString.call(target)==="[object Function]"){target={}}
for(;i<length;i++){if((options=arguments[i])!=null){for(var name in options){var src=target[name],copy=options[name];if(target===copy){continue}
if(deep&&copy&&typeof copy==="object"&&!copy.nodeType){target[name]=$.jqplot.extend(deep,src||(copy.length!=null?[]:{}),copy)}
else if(copy!==undefined){target[name]=copy}}}}
return target};$.jqplot.ThemeEngine.prototype.rename=function(oldName,newName){if(oldName=='Default'||newName=='Default'){throw new Error("jqplot.ThemeEngine Error: Cannot rename from/to Default")}
if(this.themes.hasOwnProperty(newName)){throw new Error("jqplot.ThemeEngine Error: New name already in use.")}
else if(this.themes.hasOwnProperty(oldName)){var th=this.copy(oldName,newName);this.remove(oldName);return th}
throw new Error("jqplot.ThemeEngine Error: Old name or new name invalid")};$.jqplot.ThemeEngine.prototype.copy=function(sourceName,targetName,obj){if(targetName=='Default'){throw new Error("jqplot.ThemeEngine Error: Cannot copy over Default theme")}
if(!this.themes.hasOwnProperty(sourceName)){var s="jqplot.ThemeEngine Error: Source name invalid";throw new Error(s)}
if(this.themes.hasOwnProperty(targetName)){var s="jqplot.ThemeEngine Error: Target name invalid";throw new Error(s)}
else{var th=clone(this.themes[sourceName]);th._name=targetName;$.jqplot.extend(!0,th,obj);this._add(th);return th}};$.jqplot.Theme=function(name,obj){if(typeof(name)=='object'){obj=obj||name;name=null}
name=name||Date.parse(new Date());this._name=name;this.target={backgroundColor:null};this.legend={textColor:null,fontFamily:null,fontSize:null,border:null,background:null};this.title={textColor:null,fontFamily:null,fontSize:null,textAlign:null};this.seriesStyles={};this.series=[];this.grid={drawGridlines:null,gridLineColor:null,gridLineWidth:null,backgroundColor:null,borderColor:null,borderWidth:null,shadow:null};this.axesStyles={label:{},ticks:{}};this.axes={};if(typeof(obj)=='string'){this._name=obj}
else if(typeof(obj)=='object'){$.jqplot.extend(!0,this,obj)}};var AxisProperties=function(){this.borderColor=null;this.borderWidth=null;this.ticks=new AxisTicks();this.label=new AxisLabel()};var AxisTicks=function(){this.show=null;this.showGridline=null;this.showLabel=null;this.showMark=null;this.size=null;this.textColor=null;this.whiteSpace=null;this.fontSize=null;this.fontFamily=null};var AxisLabel=function(){this.textColor=null;this.whiteSpace=null;this.fontSize=null;this.fontFamily=null;this.fontWeight=null};var LineSeriesProperties=function(){this.color=null;this.lineWidth=null;this.linePattern=null;this.shadow=null;this.fillColor=null;this.showMarker=null;this.markerOptions=new MarkerOptions()};var MarkerOptions=function(){this.show=null;this.style=null;this.lineWidth=null;this.size=null;this.color=null;this.shadow=null};var BarSeriesProperties=function(){this.color=null;this.seriesColors=null;this.lineWidth=null;this.shadow=null;this.barPadding=null;this.barMargin=null;this.barWidth=null;this.highlightColors=null};var PieSeriesProperties=function(){this.seriesColors=null;this.padding=null;this.sliceMargin=null;this.fill=null;this.shadow=null;this.startAngle=null;this.lineWidth=null;this.highlightColors=null};var DonutSeriesProperties=function(){this.seriesColors=null;this.padding=null;this.sliceMargin=null;this.fill=null;this.shadow=null;this.startAngle=null;this.lineWidth=null;this.innerDiameter=null;this.thickness=null;this.ringMargin=null;this.highlightColors=null};var FunnelSeriesProperties=function(){this.color=null;this.lineWidth=null;this.shadow=null;this.padding=null;this.sectionMargin=null;this.seriesColors=null;this.highlightColors=null};var MeterSeriesProperties=function(){this.padding=null;this.backgroundColor=null;this.ringColor=null;this.tickColor=null;this.ringWidth=null;this.intervalColors=null;this.intervalInnerRadius=null;this.intervalOuterRadius=null;this.hubRadius=null;this.needleThickness=null;this.needlePad=null};$.fn.jqplotChildText=function(){return $(this).contents().filter(function(){return this.nodeType==3}).text()};$.fn.jqplotGetComputedFontStyle=function(){var css=window.getComputedStyle?window.getComputedStyle(this[0],""):this[0].currentStyle;var attrs=css['font-style']?['font-style','font-weight','font-size','font-family']:['fontStyle','fontWeight','fontSize','fontFamily'];var style=[];for(var i=0;i<attrs.length;++i){var attr=String(css[attrs[i]]);if(attr&&attr!='normal'){style.push(attr)}}
return style.join(' ')};$.fn.jqplotToImageCanvas=function(options){options=options||{};var x_offset=(options.x_offset==null)?0:options.x_offset;var y_offset=(options.y_offset==null)?0:options.y_offset;var backgroundColor=(options.backgroundColor==null)?'rgb(255,255,255)':options.backgroundColor;if($(this).width()==0||$(this).height()==0){return null}
if($.jqplot.use_excanvas){return null}
var newCanvas=document.createElement("canvas");var h=$(this).outerHeight(!0);var w=$(this).outerWidth(!0);var offs=$(this).offset();var plotleft=offs.left;var plottop=offs.top;var transx=0,transy=0;var clses=['jqplot-table-legend','jqplot-xaxis-tick','jqplot-x2axis-tick','jqplot-yaxis-tick','jqplot-y2axis-tick','jqplot-y3axis-tick','jqplot-y4axis-tick','jqplot-y5axis-tick','jqplot-y6axis-tick','jqplot-y7axis-tick','jqplot-y8axis-tick','jqplot-y9axis-tick','jqplot-xaxis-label','jqplot-x2axis-label','jqplot-yaxis-label','jqplot-y2axis-label','jqplot-y3axis-label','jqplot-y4axis-label','jqplot-y5axis-label','jqplot-y6axis-label','jqplot-y7axis-label','jqplot-y8axis-label','jqplot-y9axis-label'];var temptop,templeft,tempbottom,tempright;for(var i=0;i<clses.length;i++){$(this).find('.'+clses[i]).each(function(){temptop=$(this).offset().top-plottop;templeft=$(this).offset().left-plotleft;tempright=templeft+$(this).outerWidth(!0)+transx;tempbottom=temptop+$(this).outerHeight(!0)+transy;if(templeft<-transx){w=w-transx-templeft;transx=-templeft}
if(temptop<-transy){h=h-transy-temptop;transy=-temptop}
if(tempright>w){w=tempright}
if(tempbottom>h){h=tempbottom}})}
newCanvas.width=w+Number(x_offset);newCanvas.height=h+Number(y_offset);var newContext=newCanvas.getContext("2d");newContext.save();newContext.fillStyle=backgroundColor;newContext.fillRect(0,0,newCanvas.width,newCanvas.height);newContext.restore();newContext.translate(transx,transy);newContext.textAlign='left';newContext.textBaseline='top';function getLineheight(el){var lineheight=parseInt($(el).css('line-height'),10);if(isNaN(lineheight)){lineheight=parseInt($(el).css('font-size'),10)*1.2}
return lineheight}
function writeWrappedText(el,context,text,left,top,canvasWidth){var lineheight=getLineheight(el);var tagwidth=$(el).innerWidth();var tagheight=$(el).innerHeight();var words=text.split(/\s+/);var wl=words.length;var w='';var breaks=[];var temptop=top;var templeft=left;for(var i=0;i<wl;i++){w+=words[i];if(context.measureText(w).width>tagwidth){breaks.push(i);w='';i--}}
if(breaks.length===0){if($(el).css('textAlign')==='center'){templeft=left+(canvasWidth-context.measureText(w).width)/2-transx}
context.fillText(text,templeft,top)}
else{w=words.slice(0,breaks[0]).join(' ');if($(el).css('textAlign')==='center'){templeft=left+(canvasWidth-context.measureText(w).width)/2-transx}
context.fillText(w,templeft,temptop);temptop+=lineheight;for(var i=1,l=breaks.length;i<l;i++){w=words.slice(breaks[i-1],breaks[i]).join(' ');if($(el).css('textAlign')==='center'){templeft=left+(canvasWidth-context.measureText(w).width)/2-transx}
context.fillText(w,templeft,temptop);temptop+=lineheight}
w=words.slice(breaks[i-1],words.length).join(' ');if($(el).css('textAlign')==='center'){templeft=left+(canvasWidth-context.measureText(w).width)/2-transx}
context.fillText(w,templeft,temptop)}}
function _jqpToImage(el,x_offset,y_offset){var tagname=el.tagName.toLowerCase();var p=$(el).position();var css=window.getComputedStyle?window.getComputedStyle(el,""):el.currentStyle;var left=x_offset+p.left+parseInt(css.marginLeft,10)+parseInt(css.borderLeftWidth,10)+parseInt(css.paddingLeft,10);var top=y_offset+p.top+parseInt(css.marginTop,10)+parseInt(css.borderTopWidth,10)+parseInt(css.paddingTop,10);var w=newCanvas.width;if((tagname=='div'||tagname=='span')&&!$(el).hasClass('jqplot-highlighter-tooltip')){$(el).children().each(function(){_jqpToImage(this,left,top)});var text=$(el).jqplotChildText();if(text){newContext.font=$(el).jqplotGetComputedFontStyle();newContext.fillStyle=$(el).css('color');writeWrappedText(el,newContext,text,left,top,w)}}
else if(tagname==='table'&&$(el).hasClass('jqplot-table-legend')){newContext.strokeStyle=$(el).css('border-top-color');newContext.fillStyle=$(el).css('background-color');newContext.fillRect(left,top,$(el).innerWidth(),$(el).innerHeight());if(parseInt($(el).css('border-top-width'),10)>0){newContext.strokeRect(left,top,$(el).innerWidth(),$(el).innerHeight())}
$(el).find('div.jqplot-table-legend-swatch-outline').each(function(){var elem=$(this);newContext.strokeStyle=elem.css('border-top-color');var l=left+elem.position().left;var t=top+elem.position().top;newContext.strokeRect(l,t,elem.innerWidth(),elem.innerHeight());l+=parseInt(elem.css('padding-left'),10);t+=parseInt(elem.css('padding-top'),10);var h=elem.innerHeight()-2*parseInt(elem.css('padding-top'),10);var w=elem.innerWidth()-2*parseInt(elem.css('padding-left'),10);var swatch=elem.children('div.jqplot-table-legend-swatch');newContext.fillStyle=swatch.css('background-color');newContext.fillRect(l,t,w,h)});$(el).find('td.jqplot-table-legend-label').each(function(){var elem=$(this);var l=left+elem.position().left;var t=top+elem.position().top+parseInt(elem.css('padding-top'),10);newContext.font=elem.jqplotGetComputedFontStyle();newContext.fillStyle=elem.css('color');writeWrappedText(elem,newContext,elem.text(),l,t,w)});var elem=null}
else if(tagname=='canvas'){newContext.drawImage(el,left,top)}}
$(this).children().each(function(){_jqpToImage(this,x_offset,y_offset)});return newCanvas};$.fn.jqplotToImageStr=function(options){var imgCanvas=$(this).jqplotToImageCanvas(options);if(imgCanvas){return imgCanvas.toDataURL("image/png")}
else{return null}};$.fn.jqplotToImageElem=function(options){var elem=document.createElement("img");var str=$(this).jqplotToImageStr(options);elem.src=str;return elem};$.fn.jqplotToImageElemStr=function(options){var str='<img src='+$(this).jqplotToImageStr(options)+' />';return str};$.fn.jqplotSaveImage=function(){var imgData=$(this).jqplotToImageStr({});if(imgData){window.location.href=imgData.replace("image/png","image/octet-stream")}};$.fn.jqplotViewImage=function(){var imgStr=$(this).jqplotToImageElemStr({});var imgData=$(this).jqplotToImageStr({});if(imgStr){var w=window.open('');w.document.open("image/png");w.document.write(imgStr);w.document.close();w=null}};var jsDate=function(){this.syntax=jsDate.config.syntax;this._type="jsDate";this.proxy=new Date();this.options={};this.locale=jsDate.regional.getLocale();this.formatString='';this.defaultCentury=jsDate.config.defaultCentury;switch(arguments.length){case 0:break;case 1:if(get_type(arguments[0])=="[object Object]"&&arguments[0]._type!="jsDate"){var opts=this.options=arguments[0];this.syntax=opts.syntax||this.syntax;this.defaultCentury=opts.defaultCentury||this.defaultCentury;this.proxy=jsDate.createDate(opts.date)}
else{this.proxy=jsDate.createDate(arguments[0])}
break;default:var a=[];for(var i=0;i<arguments.length;i++){a.push(arguments[i])}
this.proxy=new Date();this.proxy.setFullYear.apply(this.proxy,a.slice(0,3));if(a.slice(3).length){this.proxy.setHours.apply(this.proxy,a.slice(3))}
break}};jsDate.config={defaultLocale:'en',syntax:'perl',defaultCentury:1900};jsDate.prototype.add=function(number,unit){var factor=multipliers[unit]||multipliers.day;if(typeof factor=='number'){this.proxy.setTime(this.proxy.getTime()+(factor*number))}else{factor.add(this,number)}
return this};jsDate.prototype.clone=function(){return new jsDate(this.proxy.getTime())};jsDate.prototype.getUtcOffset=function(){return this.proxy.getTimezoneOffset()*60000};jsDate.prototype.diff=function(dateObj,unit,allowDecimal){dateObj=new jsDate(dateObj);if(dateObj===null){return null}
var factor=multipliers[unit]||multipliers.day;if(typeof factor=='number'){var unitDiff=(this.proxy.getTime()-dateObj.proxy.getTime())/factor}else{var unitDiff=factor.diff(this.proxy,dateObj.proxy)}
return(allowDecimal?unitDiff:Math[unitDiff>0?'floor':'ceil'](unitDiff))};jsDate.prototype.getAbbrDayName=function(){return jsDate.regional[this.locale].dayNamesShort[this.proxy.getDay()]};jsDate.prototype.getAbbrMonthName=function(){return jsDate.regional[this.locale].monthNamesShort[this.proxy.getMonth()]};jsDate.prototype.getAMPM=function(){return this.proxy.getHours()>=12?'PM':'AM'};jsDate.prototype.getAmPm=function(){return this.proxy.getHours()>=12?'pm':'am'};jsDate.prototype.getCentury=function(){return parseInt(this.proxy.getFullYear()/100,10)};jsDate.prototype.getDate=function(){return this.proxy.getDate()};jsDate.prototype.getDay=function(){return this.proxy.getDay()};jsDate.prototype.getDayOfWeek=function(){var dow=this.proxy.getDay();return dow===0?7:dow};jsDate.prototype.getDayOfYear=function(){var d=this.proxy;var ms=d-new Date(''+d.getFullYear()+'/1/1 GMT');ms+=d.getTimezoneOffset()*60000;d=null;return parseInt(ms/60000/60/24,10)+1};jsDate.prototype.getDayName=function(){return jsDate.regional[this.locale].dayNames[this.proxy.getDay()]};jsDate.prototype.getFullWeekOfYear=function(){var d=this.proxy;var doy=this.getDayOfYear();var rdow=6-d.getDay();var woy=parseInt((doy+rdow)/7,10);return woy};jsDate.prototype.getFullYear=function(){return this.proxy.getFullYear()};jsDate.prototype.getGmtOffset=function(){var hours=this.proxy.getTimezoneOffset()/60;var prefix=hours<0?'+':'-';hours=Math.abs(hours);return prefix+addZeros(Math.floor(hours),2)+':'+addZeros((hours%1)*60,2)};jsDate.prototype.getHours=function(){return this.proxy.getHours()};jsDate.prototype.getHours12=function(){var hours=this.proxy.getHours();return hours>12?hours-12:(hours==0?12:hours)};jsDate.prototype.getIsoWeek=function(){var d=this.proxy;var woy=this.getWeekOfYear();var dow1_1=(new Date(''+d.getFullYear()+'/1/1')).getDay();var idow=woy+(dow1_1>4||dow1_1<=1?0:1);if(idow==53&&(new Date(''+d.getFullYear()+'/12/31')).getDay()<4)
{idow=1}
else if(idow===0)
{d=new jsDate(new Date(''+(d.getFullYear()-1)+'/12/31'));idow=d.getIsoWeek()}
d=null;return idow};jsDate.prototype.getMilliseconds=function(){return this.proxy.getMilliseconds()};jsDate.prototype.getMinutes=function(){return this.proxy.getMinutes()};jsDate.prototype.getMonth=function(){return this.proxy.getMonth()};jsDate.prototype.getMonthName=function(){return jsDate.regional[this.locale].monthNames[this.proxy.getMonth()]};jsDate.prototype.getMonthNumber=function(){return this.proxy.getMonth()+1};jsDate.prototype.getSeconds=function(){return this.proxy.getSeconds()};jsDate.prototype.getShortYear=function(){return this.proxy.getYear()%100};jsDate.prototype.getTime=function(){return this.proxy.getTime()};jsDate.prototype.getTimezoneAbbr=function(){return this.proxy.toString().replace(/^.*\(([^)]+)\)$/,'$1')};jsDate.prototype.getTimezoneName=function(){var match=/(?:\((.+)\)$| ([A-Z]{3}) )/.exec(this.toString());return match[1]||match[2]||'GMT'+this.getGmtOffset()};jsDate.prototype.getTimezoneOffset=function(){return this.proxy.getTimezoneOffset()};jsDate.prototype.getWeekOfYear=function(){var doy=this.getDayOfYear();var rdow=7-this.getDayOfWeek();var woy=parseInt((doy+rdow)/7,10);return woy};jsDate.prototype.getUnix=function(){return Math.round(this.proxy.getTime()/1000,0)};jsDate.prototype.getYear=function(){return this.proxy.getYear()};jsDate.prototype.next=function(unit){unit=unit||'day';return this.clone().add(1,unit)};jsDate.prototype.set=function(){switch(arguments.length){case 0:this.proxy=new Date();break;case 1:if(get_type(arguments[0])=="[object Object]"&&arguments[0]._type!="jsDate"){var opts=this.options=arguments[0];this.syntax=opts.syntax||this.syntax;this.defaultCentury=opts.defaultCentury||this.defaultCentury;this.proxy=jsDate.createDate(opts.date)}
else{this.proxy=jsDate.createDate(arguments[0])}
break;default:var a=[];for(var i=0;i<arguments.length;i++){a.push(arguments[i])}
this.proxy=new Date();this.proxy.setFullYear.apply(this.proxy,a.slice(0,3));if(a.slice(3).length){this.proxy.setHours.apply(this.proxy,a.slice(3))}
break}
return this};jsDate.prototype.setDate=function(n){this.proxy.setDate(n);return this};jsDate.prototype.setFullYear=function(){this.proxy.setFullYear.apply(this.proxy,arguments);return this};jsDate.prototype.setHours=function(){this.proxy.setHours.apply(this.proxy,arguments);return this};jsDate.prototype.setMilliseconds=function(n){this.proxy.setMilliseconds(n);return this};jsDate.prototype.setMinutes=function(){this.proxy.setMinutes.apply(this.proxy,arguments);return this};jsDate.prototype.setMonth=function(){this.proxy.setMonth.apply(this.proxy,arguments);return this};jsDate.prototype.setSeconds=function(){this.proxy.setSeconds.apply(this.proxy,arguments);return this};jsDate.prototype.setTime=function(n){this.proxy.setTime(n);return this};jsDate.prototype.setYear=function(){this.proxy.setYear.apply(this.proxy,arguments);return this};jsDate.prototype.strftime=function(formatString){formatString=formatString||this.formatString||jsDate.regional[this.locale].formatString;return jsDate.strftime(this,formatString,this.syntax)};jsDate.prototype.toString=function(){return this.proxy.toString()};jsDate.prototype.toYmdInt=function(){return(this.proxy.getFullYear()*10000)+(this.getMonthNumber()*100)+this.proxy.getDate()};jsDate.regional={'en':{monthNames:['January','February','March','April','May','June','July','August','September','October','November','December'],monthNamesShort:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],dayNames:['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],dayNamesShort:['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],formatString:'%Y-%m-%d %H:%M:%S'},'fr':{monthNames:['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],monthNamesShort:['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'],dayNames:['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],dayNamesShort:['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],formatString:'%Y-%m-%d %H:%M:%S'},'de':{monthNames:['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'],monthNamesShort:['Jan','Feb','Mär','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez'],dayNames:['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],dayNamesShort:['So','Mo','Di','Mi','Do','Fr','Sa'],formatString:'%Y-%m-%d %H:%M:%S'},'es':{monthNames:['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],monthNamesShort:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],dayNames:['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],dayNamesShort:['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],formatString:'%Y-%m-%d %H:%M:%S'},'ru':{monthNames:['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],monthNamesShort:['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],dayNames:['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],dayNamesShort:['вск','пнд','втр','срд','чтв','птн','сбт'],formatString:'%Y-%m-%d %H:%M:%S'},'ar':{monthNames:['كانون الثاني','شباط','آذار','نيسان','آذار','حزيران','تموز','آب','أيلول','تشرين الأول','تشرين الثاني','كانون الأول'],monthNamesShort:['1','2','3','4','5','6','7','8','9','10','11','12'],dayNames:['السبت','الأحد','الاثنين','الثلاثاء','الأربعاء','الخميس','الجمعة'],dayNamesShort:['سبت','أحد','اثنين','ثلاثاء','أربعاء','خميس','جمعة'],formatString:'%Y-%m-%d %H:%M:%S'},'pt':{monthNames:['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],monthNamesShort:['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],dayNames:['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','S&aacute;bado'],dayNamesShort:['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],formatString:'%Y-%m-%d %H:%M:%S'},'pt-BR':{monthNames:['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],monthNamesShort:['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],dayNames:['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','S&aacute;bado'],dayNamesShort:['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],formatString:'%Y-%m-%d %H:%M:%S'},'pl':{monthNames:['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'],monthNamesShort:['Sty','Lut','Mar','Kwi','Maj','Cze','Lip','Sie','Wrz','Paź','Lis','Gru'],dayNames:['Niedziela','Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota'],dayNamesShort:['Ni','Pn','Wt','Śr','Cz','Pt','Sb'],formatString:'%Y-%m-%d %H:%M:%S'},'nl':{monthNames:['Januari','Februari','Maart','April','Mei','Juni','July','Augustus','September','Oktober','November','December'],monthNamesShort:['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nov','Dec'],dayNames:','['Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'],dayNamesShort:['Zo','Ma','Di','Wo','Do','Vr','Za'],formatString:'%Y-%m-%d %H:%M:%S'},'sv':{monthNames:['januari','februari','mars','april','maj','juni','juli','augusti','september','oktober','november','december'],monthNamesShort:['jan','feb','mar','apr','maj','jun','jul','aug','sep','okt','nov','dec'],dayNames:['söndag','måndag','tisdag','onsdag','torsdag','fredag','lördag'],dayNamesShort:['sön','mån','tis','ons','tor','fre','lör'],formatString:'%Y-%m-%d %H:%M:%S'}};jsDate.regional['en-US']=jsDate.regional['en-GB']=jsDate.regional.en;jsDate.regional.getLocale=function(){var l=jsDate.config.defaultLocale;if(document&&document.getElementsByTagName('html')&&document.getElementsByTagName('html')[0].lang){l=document.getElementsByTagName('html')[0].lang;if(!jsDate.regional.hasOwnProperty(l)){l=jsDate.config.defaultLocale}}
return l};var day=24*60*60*1000;var addZeros=function(num,digits){num=String(num);var i=digits-num.length;var s=String(Math.pow(10,i)).slice(1);return s.concat(num)};var multipliers={millisecond:1,second:1000,minute:60*1000,hour:60*60*1000,day:day,week:7*day,month:{add:function(d,number){multipliers.year.add(d,Math[number>0?'floor':'ceil'](number/12));var prevMonth=d.getMonth()+(number%12);if(prevMonth==12){prevMonth=0;d.setYear(d.getFullYear()+1)}else if(prevMonth==-1){prevMonth=11;d.setYear(d.getFullYear()-1)}
d.setMonth(prevMonth)},diff:function(d1,d2){var diffYears=d1.getFullYear()-d2.getFullYear();var diffMonths=d1.getMonth()-d2.getMonth()+(diffYears*12);var diffDays=d1.getDate()-d2.getDate();return diffMonths+(diffDays/30)}},year:{add:function(d,number){d.setYear(d.getFullYear()+Math[number>0?'floor':'ceil'](number))},diff:function(d1,d2){return multipliers.month.diff(d1,d2)/12}}};for(var unit in multipliers){if(unit.substring(unit.length-1)!='s'){multipliers[unit+'s']=multipliers[unit]}}
var format=function(d,code,syntax){if(jsDate.formats[syntax].shortcuts[code]){return jsDate.strftime(d,jsDate.formats[syntax].shortcuts[code],syntax)}else{var getter=(jsDate.formats[syntax].codes[code]||'').split('.');var nbr=d['get'+getter[0]]?d['get'+getter[0]]():'';if(getter[1]){nbr=addZeros(nbr,getter[1])}
return nbr}};jsDate.strftime=function(d,formatString,syntax,locale){var syn='perl';var loc=jsDate.regional.getLocale();if(syntax&&jsDate.formats.hasOwnProperty(syntax)){syn=syntax}
else if(syntax&&jsDate.regional.hasOwnProperty(syntax)){loc=syntax}
if(locale&&jsDate.formats.hasOwnProperty(locale)){syn=locale}
else if(locale&&jsDate.regional.hasOwnProperty(locale)){loc=locale}
if(get_type(d)!="[object Object]"||d._type!="jsDate"){d=new jsDate(d);d.locale=loc}
if(!formatString){formatString=d.formatString||jsDate.regional[loc].formatString}
var source=formatString||'%Y-%m-%d',result='',match;while(source.length>0){if(match=source.match(jsDate.formats[syn].codes.matcher)){result+=source.slice(0,match.index);result+=(match[1]||'')+format(d,match[2],syn);source=source.slice(match.index+match[0].length)}else{result+=source;source=''}}
return result};jsDate.formats={ISO:'%Y-%m-%dT%H:%M:%S.%N%G',SQL:'%Y-%m-%d %H:%M:%S'};jsDate.formats.perl={codes:{matcher:/()%(#?(%|[a-z]))/i,Y:'FullYear',y:'ShortYear.2',m:'MonthNumber.2','#m':'MonthNumber',B:'MonthName',b:'AbbrMonthName',d:'Date.2','#d':'Date',e:'Date',A:'DayName',a:'AbbrDayName',w:'Day',H:'Hours.2','#H':'Hours',I:'Hours12.2','#I':'Hours12',p:'AMPM',M:'Minutes.2','#M':'Minutes',S:'Seconds.2','#S':'Seconds',s:'Unix',N:'Milliseconds.3','#N':'Milliseconds',O:'TimezoneOffset',Z:'TimezoneName',G:'GmtOffset'},shortcuts:{F:'%Y-%m-%d',T:'%H:%M:%S',X:'%H:%M:%S',x:'%m/%d/%y',D:'%m/%d/%y','#c':'%a %b %e %H:%M:%S %Y',v:'%e-%b-%Y',R:'%H:%M',r:'%I:%M:%S %p',t:'\t',n:'\n','%':'%'}};jsDate.formats.php={codes:{matcher:/()%((%|[a-z]))/i,a:'AbbrDayName',A:'DayName',d:'Date.2',e:'Date',j:'DayOfYear.3',u:'DayOfWeek',w:'Day',U:'FullWeekOfYear.2',V:'IsoWeek.2',W:'WeekOfYear.2',b:'AbbrMonthName',B:'MonthName',m:'MonthNumber.2',h:'AbbrMonthName',C:'Century.2',y:'ShortYear.2',Y:'FullYear',H:'Hours.2',I:'Hours12.2',l:'Hours12',p:'AMPM',P:'AmPm',M:'Minutes.2',S:'Seconds.2',s:'Unix',O:'TimezoneOffset',z:'GmtOffset',Z:'TimezoneAbbr'},shortcuts:{D:'%m/%d/%y',F:'%Y-%m-%d',T:'%H:%M:%S',X:'%H:%M:%S',x:'%m/%d/%y',R:'%H:%M',r:'%I:%M:%S %p',t:'\t',n:'\n','%':'%'}};jsDate.createDate=function(date){if(date==null){return new Date()}
if(date instanceof Date){return date}
if(typeof date=='number'){return new Date(date)}
var parsable=String(date).replace(/^\s*(.+)\s*$/g,'$1');parsable=parsable.replace(/^([0-9]{1,4})-([0-9]{1,2})-([0-9]{1,4})/,"$1/$2/$3");parsable=parsable.replace(/^(3[01]|[0-2]?\d)[-\/]([a-z]{3,})[-\/](\d{4})/i,"$1 $2 $3");var match=parsable.match(/^(3[01]|[0-2]?\d)[-\/]([a-z]{3,})[-\/](\d{2})\D*/i);if(match&&match.length>3){var m3=parseFloat(match[3]);var ny=jsDate.config.defaultCentury+m3;ny=String(ny);parsable=parsable.replace(/^(3[01]|[0-2]?\d)[-\/]([a-z]{3,})[-\/](\d{2})\D*/i,match[1]+' '+match[2]+' '+ny)}
match=parsable.match(/^([0-9]{1,2})[-\/]([0-9]{1,2})[-\/]([0-9]{1,2})[^0-9]/);function h1(parsable,match){var m1=parseFloat(match[1]);var m2=parseFloat(match[2]);var m3=parseFloat(match[3]);var cent=jsDate.config.defaultCentury;var ny,nd,nm,str;if(m1>31){nd=m3;nm=m2;ny=cent+m1}
else{nd=m2;nm=m1;ny=cent+m3}
str=nm+'/'+nd+'/'+ny;return parsable.replace(/^([0-9]{1,2})[-\/]([0-9]{1,2})[-\/]([0-9]{1,2})/,str)}
if(match&&match.length>3){parsable=h1(parsable,match)}
var match=parsable.match(/^([0-9]{1,2})[-\/]([0-9]{1,2})[-\/]([0-9]{1,2})$/);if(match&&match.length>3){parsable=h1(parsable,match)}
var i=0;var length=jsDate.matchers.length;var pattern,ms,current=parsable,obj;while(i<length){ms=Date.parse(current);if(!isNaN(ms)){return new Date(ms)}
pattern=jsDate.matchers[i];if(typeof pattern=='function'){obj=pattern.call(jsDate,current);if(obj instanceof Date){return obj}}else{current=parsable.replace(pattern[0],pattern[1])}
i++}
return NaN};jsDate.daysInMonth=function(year,month){if(month==2){return new Date(year,1,29).getDate()==29?29:28}
return[undefined,31,undefined,31,30,31,30,31,31,30,31,30,31][month]};jsDate.matchers=[[/(3[01]|[0-2]\d)\s*\.\s*(1[0-2]|0\d)\s*\.\s*([1-9]\d{3})/,'$2/$1/$3'],[/([1-9]\d{3})\s*-\s*(1[0-2]|0\d)\s*-\s*(3[01]|[0-2]\d)/,'$2/$3/$1'],function(str){var match=str.match(/^(?:(.+)\s+)?([012]?\d)(?:\s*\:\s*(\d\d))?(?:\s*\:\s*(\d\d(\.\d*)?))?\s*(am|pm)?\s*$/i);if(match){if(match[1]){var d=this.createDate(match[1]);if(isNaN(d)){return}}else{var d=new Date();d.setMilliseconds(0)}
var hour=parseFloat(match[2]);if(match[6]){hour=match[6].toLowerCase()=='am'?(hour==12?0:hour):(hour==12?12:hour+12)}
d.setHours(hour,parseInt(match[3]||0,10),parseInt(match[4]||0,10),((parseFloat(match[5]||0))||0)*1000);return d}
else{return str}},function(str){var match=str.match(/^(?:(.+))[T|\s+]([012]\d)(?:\:(\d\d))(?:\:(\d\d))(?:\.\d+)([\+\-]\d\d\:\d\d)$/i);if(match){if(match[1]){var d=this.createDate(match[1]);if(isNaN(d)){return}}else{var d=new Date();d.setMilliseconds(0)}
var hour=parseFloat(match[2]);d.setHours(hour,parseInt(match[3],10),parseInt(match[4],10),parseFloat(match[5])*1000);return d}
else{return str}},function(str){var match=str.match(/^([0-3]?\d)\s*[-\/.\s]{1}\s*([a-zA-Z]{3,9})\s*[-\/.\s]{1}\s*([0-3]?\d)$/);if(match){var d=new Date();var cent=jsDate.config.defaultCentury;var m1=parseFloat(match[1]);var m3=parseFloat(match[3]);var ny,nd,nm;if(m1>31){nd=m3;ny=cent+m1}
else{nd=m1;ny=cent+m3}
var nm=inArray(match[2],jsDate.regional[jsDate.regional.getLocale()].monthNamesShort);if(nm==-1){nm=inArray(match[2],jsDate.regional[jsDate.regional.getLocale()].monthNames)}
d.setFullYear(ny,nm,nd);d.setHours(0,0,0,0);return d}
else{return str}}];function inArray(elem,array){if(array.indexOf){return array.indexOf(elem)}
for(var i=0,length=array.length;i<length;i++){if(array[i]===elem){return i}}
return-1}
function get_type(thing){if(thing===null)return "[object Null]";return Object.prototype.toString.call(thing)}
$.jsDate=jsDate;$.jqplot.sprintf=function(){function pad(str,len,chr,leftJustify){var padding=(str.length>=len)?'':Array(1+len-str.length>>>0).join(chr);return leftJustify?str+padding:padding+str}
function thousand_separate(value){var value_str=new String(value);for(var i=10;i>0;i--){if(value_str==(value_str=value_str.replace(/^(\d+)(\d{3})/,"$1"+$.jqplot.sprintf.thousandsSeparator+"$2")))break}
return value_str}
function justify(value,prefix,leftJustify,minWidth,zeroPad,htmlSpace){var diff=minWidth-value.length;if(diff>0){var spchar=' ';if(htmlSpace){spchar='&nbsp;'}
if(leftJustify||!zeroPad){value=pad(value,minWidth,spchar,leftJustify)}else{value=value.slice(0,prefix.length)+pad('',diff,'0',!0)+value.slice(prefix.length)}}
return value}
function formatBaseX(value,base,prefix,leftJustify,minWidth,precision,zeroPad,htmlSpace){var number=value>>>0;prefix=prefix&&number&&{'2':'0b','8':'0','16':'0x'}[base]||'';value=prefix+pad(number.toString(base),precision||0,'0',!1);return justify(value,prefix,leftJustify,minWidth,zeroPad,htmlSpace)}
function formatString(value,leftJustify,minWidth,precision,zeroPad,htmlSpace){if(precision!=null){value=value.slice(0,precision)}
return justify(value,'',leftJustify,minWidth,zeroPad,htmlSpace)}
var a=arguments,i=0,format=a[i++];return format.replace($.jqplot.sprintf.regex,function(substring,valueIndex,flags,minWidth,_,precision,type){if(substring=='%%'){return '%'}
var leftJustify=!1,positivePrefix='',zeroPad=!1,prefixBaseX=!1,htmlSpace=!1,thousandSeparation=!1;for(var j=0;flags&&j<flags.length;j++)switch(flags.charAt(j)){case ' ':positivePrefix=' ';break;case '+':positivePrefix='+';break;case '-':leftJustify=!0;break;case '0':zeroPad=!0;break;case '#':prefixBaseX=!0;break;case '&':htmlSpace=!0;break;case '\'':thousandSeparation=!0;break}
if(!minWidth){minWidth=0}
else if(minWidth=='*'){minWidth=+a[i++]}
else if(minWidth.charAt(0)=='*'){minWidth=+a[minWidth.slice(1,-1)]}
else{minWidth=+minWidth}
if(minWidth<0){minWidth=-minWidth;leftJustify=!0}
if(!isFinite(minWidth)){throw new Error('$.jqplot.sprintf: (minimum-)width must be finite')}
if(!precision){precision='fFeE'.indexOf(type)>-1?6:(type=='d')?0:void(0)}
else if(precision=='*'){precision=+a[i++]}
else if(precision.charAt(0)=='*'){precision=+a[precision.slice(1,-1)]}
else{precision=+precision}
var value=valueIndex?a[valueIndex.slice(0,-1)]:a[i++];switch(type){case 's':{if(value==null){return ''}
return formatString(String(value),leftJustify,minWidth,precision,zeroPad,htmlSpace)}
case 'c':return formatString(String.fromCharCode(+value),leftJustify,minWidth,precision,zeroPad,htmlSpace);case 'b':return formatBaseX(value,2,prefixBaseX,leftJustify,minWidth,precision,zeroPad,htmlSpace);case 'o':return formatBaseX(value,8,prefixBaseX,leftJustify,minWidth,precision,zeroPad,htmlSpace);case 'x':return formatBaseX(value,16,prefixBaseX,leftJustify,minWidth,precision,zeroPad,htmlSpace);case 'X':return formatBaseX(value,16,prefixBaseX,leftJustify,minWidth,precision,zeroPad,htmlSpace).toUpperCase();case 'u':return formatBaseX(value,10,prefixBaseX,leftJustify,minWidth,precision,zeroPad,htmlSpace);case 'i':{var number=parseInt(+value,10);if(isNaN(number)){return ''}
var prefix=number<0?'-':positivePrefix;var number_str=thousandSeparation?thousand_separate(String(Math.abs(number))):String(Math.abs(number));value=prefix+pad(number_str,precision,'0',!1);return justify(value,prefix,leftJustify,minWidth,zeroPad,htmlSpace)}
case 'd':{var number=Math.round(+value);if(isNaN(number)){return ''}
var prefix=number<0?'-':positivePrefix;var number_str=thousandSeparation?thousand_separate(String(Math.abs(number))):String(Math.abs(number));value=prefix+pad(number_str,precision,'0',!1);return justify(value,prefix,leftJustify,minWidth,zeroPad,htmlSpace)}
case 'e':case 'E':case 'f':case 'F':case 'g':case 'G':{var number=+value;if(isNaN(number)){return ''}
var prefix=number<0?'-':positivePrefix;var method=['toExponential','toFixed','toPrecision']['efg'.indexOf(type.toLowerCase())];var textTransform=['toString','toUpperCase']['eEfFgG'.indexOf(type)%2];var number_str=Math.abs(number)[method](precision);var parts=number_str.toString().split('.');parts[0]=thousandSeparation?thousand_separate(parts[0]):parts[0];number_str=parts.join($.jqplot.sprintf.decimalMark);value=prefix+number_str;var justified=justify(value,prefix,leftJustify,minWidth,zeroPad,htmlSpace)[textTransform]();return justified}
case 'p':case 'P':{var number=+value;if(isNaN(number)){return ''}
var prefix=number<0?'-':positivePrefix;var parts=String(Number(Math.abs(number)).toExponential()).split(/e|E/);var sd=(parts[0].indexOf('.')!=-1)?parts[0].length-1:String(number).length;var zeros=(parts[1]<0)?-parts[1]-1:0;if(Math.abs(number)<1){if(sd+zeros<=precision){value=prefix+Math.abs(number).toPrecision(sd)}
else{if(sd<=precision-1){value=prefix+Math.abs(number).toExponential(sd-1)}
else{value=prefix+Math.abs(number).toExponential(precision-1)}}}
else{var prec=(sd<=precision)?sd:precision;value=prefix+Math.abs(number).toPrecision(prec)}
var textTransform=['toString','toUpperCase']['pP'.indexOf(type)%2];return justify(value,prefix,leftJustify,minWidth,zeroPad,htmlSpace)[textTransform]()}
case 'n':return '';default:return substring}})};$.jqplot.sprintf.thousandsSeparator=',';$.jqplot.sprintf.decimalMark='.';$.jqplot.sprintf.regex=/%%|%(\d+\$)?([-+#0&\' ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([nAscboxXuidfegpEGP])/g;$.jqplot.getSignificantFigures=function(number){var parts=String(Number(Math.abs(number)).toExponential()).split(/e|E/);var sd=(parts[0].indexOf('.')!=-1)?parts[0].length-1:parts[0].length;var zeros=(parts[1]<0)?-parts[1]-1:0;var expn=parseInt(parts[1],10);var dleft=(expn+1>0)?expn+1:0;var dright=(sd<=dleft)?0:sd-expn-1;return{significantDigits:sd,digitsLeft:dleft,digitsRight:dright,zeros:zeros,exponent:expn}};$.jqplot.getPrecision=function(number){return $.jqplot.getSignificantFigures(number).digitsRight};var backCompat=$.uiBackCompat!==!1;$.jqplot.effects={effect:{}};var dataSpace="jqplot.storage.";$.extend($.jqplot.effects,{version:"1.9pre",save:function(element,set){for(var i=0;i<set.length;i++){if(set[i]!==null){element.data(dataSpace+set[i],element[0].style[set[i]])}}},restore:function(element,set){for(var i=0;i<set.length;i++){if(set[i]!==null){element.css(set[i],element.data(dataSpace+set[i]))}}},setMode:function(el,mode){if(mode==="toggle"){mode=el.is(":hidden")?"show":"hide"}
return mode},createWrapper:function(element){if(element.parent().is(".ui-effects-wrapper")){return element.parent()}
var props={width:element.outerWidth(!0),height:element.outerHeight(!0),"float":element.css("float")},wrapper=$("<div></div>").addClass("ui-effects-wrapper").css({fontSize:"100%",background:"transparent",border:"none",margin:0,padding:0}),size={width:element.width(),height:element.height()},active=document.activeElement;element.wrap(wrapper);if(element[0]===active||$.contains(element[0],active)){$(active).focus()}
wrapper=element.parent();if(element.css("position")==="static"){wrapper.css({position:"relative"});element.css({position:"relative"})}else{$.extend(props,{position:element.css("position"),zIndex:element.css("z-index")});$.each(["top","left","bottom","right"],function(i,pos){props[pos]=element.css(pos);if(isNaN(parseInt(props[pos],10))){props[pos]="auto"}});element.css({position:"relative",top:0,left:0,right:"auto",bottom:"auto"})}
element.css(size);return wrapper.css(props).show()},removeWrapper:function(element){var active=document.activeElement;if(element.parent().is(".ui-effects-wrapper")){element.parent().replaceWith(element);if(element[0]===active||$.contains(element[0],active)){$(active).focus()}}
return element}});function _normalizeArguments(effect,options,speed,callback){if($.isPlainObject(effect)){return effect}
effect={effect:effect};if(options===undefined){options={}}
if($.isFunction(options)){callback=options;speed=null;options={}}
if($.type(options)==="number"||$.fx.speeds[options]){callback=speed;speed=options;options={}}
if($.isFunction(speed)){callback=speed;speed=null}
if(options){$.extend(effect,options)}
speed=speed||options.duration;effect.duration=$.fx.off?0:typeof speed==="number"?speed:speed in $.fx.speeds?$.fx.speeds[speed]:$.fx.speeds._default;effect.complete=callback||options.complete;return effect}
function standardSpeed(speed){if(!speed||typeof speed==="number"||$.fx.speeds[speed]){return!0}
if(typeof speed==="string"&&!$.jqplot.effects.effect[speed]){if(backCompat&&$.jqplot.effects[speed]){return!1}
return!0}
return!1}
$.fn.extend({jqplotEffect:function(effect,options,speed,callback){var args=_normalizeArguments.apply(this,arguments),mode=args.mode,queue=args.queue,effectMethod=$.jqplot.effects.effect[args.effect],oldEffectMethod=!effectMethod&&backCompat&&$.jqplot.effects[args.effect];if($.fx.off||!(effectMethod||oldEffectMethod)){if(mode){return this[mode](args.duration,args.complete)}else{return this.each(function(){if(args.complete){args.complete.call(this)}})}}
function run(next){var elem=$(this),complete=args.complete,mode=args.mode;function done(){if($.isFunction(complete)){complete.call(elem[0])}
if($.isFunction(next)){next()}}
if(elem.is(":hidden")?mode==="hide":mode==="show"){done()}else{effectMethod.call(elem[0],args,done)}}
if(effectMethod){return queue===!1?this.each(run):this.queue(queue||"fx",run)}else{return oldEffectMethod.call(this,{options:args,duration:args.duration,callback:args.complete,mode:args.mode})}}});var rvertical=/up|down|vertical/,rpositivemotion=/up|left|vertical|horizontal/;$.jqplot.effects.effect.blind=function(o,done){var el=$(this),props=["position","top","bottom","left","right","height","width"],mode=$.jqplot.effects.setMode(el,o.mode||"hide"),direction=o.direction||"up",vertical=rvertical.test(direction),ref=vertical?"height":"width",ref2=vertical?"top":"left",motion=rpositivemotion.test(direction),animation={},show=mode==="show",wrapper,distance,top;if(el.parent().is(".ui-effects-wrapper")){$.jqplot.effects.save(el.parent(),props)}else{$.jqplot.effects.save(el,props)}
el.show();top=parseInt(el.css('top'),10);wrapper=$.jqplot.effects.createWrapper(el).css({overflow:"hidden"});distance=vertical?wrapper[ref]()+top:wrapper[ref]();animation[ref]=show?String(distance):'0';if(!motion){el.css(vertical?"bottom":"right",0).css(vertical?"top":"left","").css({position:"absolute"});animation[ref2]=show?'0':String(distance)}
if(show){wrapper.css(ref,0);if(!motion){wrapper.css(ref2,distance)}}
wrapper.animate(animation,{duration:o.duration,easing:o.easing,queue:!1,complete:function(){if(mode==="hide"){el.hide()}
$.jqplot.effects.restore(el,props);$.jqplot.effects.removeWrapper(el);done()}})}})(jQuery)