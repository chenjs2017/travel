<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/26/2017
 * Version: 1.0
 */

if(!function_exists('st_vc_sum_of_flight_search_result') && function_exists('vc_map') && function_exists('st_reg_shortcode')){
    function st_vc_sum_of_flight_search_result($atts, $content = false){
        $atts = shortcode_atts(array(
            'extra_class' => '',
        ), $atts);

        $html = st_flight_load_view('vc-elements/st-sum-of-flight-search-results/st-sum-of-flight-search-results', false, array('atts' => $atts));

        return $html;
    }

    st_reg_shortcode('st_sum_of_flight_search_result', 'st_vc_sum_of_flight_search_result');

    vc_map(array(
        'name' => esc_html__('ST Sum Of Flight Search Results', ST_TEXTDOMAIN),
        'base' => 'st_sum_of_flight_search_result',
        'icon' => 'icon-st',
        'category' => esc_html__('Flights', ST_TEXTDOMAIN),
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => __("Extra Class", ST_TEXTDOMAIN),
                "param_name" => "extra_class",
                'value'=>"",
            )
        )
    ));
}
