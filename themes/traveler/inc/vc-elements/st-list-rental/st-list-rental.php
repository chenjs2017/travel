<?php
if(!st_check_service_available( 'st_rental' )) {
    return;
}
if(function_exists( 'vc_map' )) {
    $list_taxonomy = st_list_taxonomy( 'st_rental' );
    $list_taxonomy = array_merge( array( "--Select--" => "" ) , $list_taxonomy );
    $list_location                                              = TravelerObject::get_list_location();
    $list_location_data[ __( '-- Select --' , ST_TEXTDOMAIN ) ] = '';
    if(!empty( $list_location )) {
        foreach( $list_location as $k => $v ) {
            $list_location_data[ $v[ 'title' ] ] = $v[ 'id' ];
        }
    }
    $param = array(
        array(
            "type"        => "textfield" ,
            'admin_label' => true,
            "heading"     => __( "List ID in Rental" , ST_TEXTDOMAIN ) ,
            "param_name"  => "st_ids" ,
            "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
            'value'       => "" ,
        ) ,
        array(
            "type"        => "textfield" ,
            'admin_label' => true,
            "heading"     => __( "Number" , ST_TEXTDOMAIN ) ,
            "param_name"  => "number" ,
            "description" => "" ,
            'value'       => 4 ,
        ) ,
        array(
            "type"             => "dropdown" ,
            'admin_label' => true,
            "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
            "param_name"       => "st_orderby" ,
            "description"      => "" ,
            'edit_field_class' => 'vc_col-sm-6' ,
            'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by(
                array(
                    __( 'Sale' , ST_TEXTDOMAIN )     => 'sale' ,
                    __( 'Featured' , ST_TEXTDOMAIN ) => 'featured' ,
                )
            ) : array() ,
        ) ,
        array(
            "type"             => "dropdown" ,
            'admin_label' => true,
            "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
            "param_name"       => "st_order" ,
            'value'            => array(
                __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                __( 'Asc' , ST_TEXTDOMAIN )        => 'asc' ,
                __( 'Desc' , ST_TEXTDOMAIN )       => 'desc'
            ) ,
            'edit_field_class' => 'vc_col-sm-6' ,
        ) ,
        array(
            "type"             => "dropdown" ,
            'admin_label' => true,
            "heading"          => __( "Number of rows" , ST_TEXTDOMAIN ) ,
            "param_name"       => "number_of_row" ,
            'edit_field_class' => 'vc_col-sm-12' ,
            "value"            => array(
                __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                __( 'Four' , ST_TEXTDOMAIN )       => '4' ,
                __( 'Three' , ST_TEXTDOMAIN )      => '3' ,
                __( 'Two' , ST_TEXTDOMAIN )        => '2' ,
            ) ,
        ) ,
        array(
            "type"        => "st_list_location" ,
            'admin_label' => true,
            "heading"     => __( "Location" , ST_TEXTDOMAIN ) ,
            "param_name"  => "st_location" ,
            "description" => __( "Location" , ST_TEXTDOMAIN ) ,
        ) ,
    );
    $list_tax = TravelHelper::get_object_taxonomies_service('st_rental');
    if( !empty( $list_tax ) ){
        foreach( $list_tax as $name => $label ){
            $terms_list = array();
            $terms = get_terms( $name, array(
                'hide_empty' => true,
            ) );
            foreach( $terms as $key => $val){
                $terms_list[$val->name] = $val->term_id;
            }
            if( !empty( $terms_list ) ){
                $param[] = array(
                    'type' => 'checkbox',
                    'heading' => $label,
                    'param_name' => 'taxonomies'.'--'.$name,
                    'value' => $terms_list
                );
            }
            
        }
    }

    vc_map( array(
        "name"            => __( "ST List of Rentals" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_rental" ,
        "content_element" => true ,
        "icon"            => "icon-st" ,
        "category"        => "Shinetheme" ,
        "params"          => $param
    ) );
}

if(!function_exists( 'st_vc_list_rental' )) {
    function st_vc_list_rental( $attr , $content = false )
    {
        global $st_search_args;
        $default = array(
            'st_ids'        => '' ,
            'taxonomy'      => '' ,
            'number'        => 0 ,
            'st_order'      => '' ,
            'st_orderby'    => '' ,
            'number_of_row' => 4 ,
            'st_location'   => '' ,
        );
        $list_tax = TravelHelper::get_object_taxonomies_service('st_rental');
        if( !empty( $list_tax ) ){
            foreach( $list_tax as $name => $label ){
                $default['taxonomies--'. $name] = '';
            }
        }
        $data = wp_parse_args( $attr , $default);
        extract( $data );
        $st_search_args = $data;
        $query = array(
            'post_type'      => 'st_rental' ,
            'posts_per_page' => $number ,
            'order'          => $st_order ,
            'orderby'        => $st_orderby
        );
        $current_page = get_post_type( get_the_ID() );
        $rental = STRental::inst();
        $rental->alter_search_query();
        query_posts( $query );
        $txt = '';
        while( have_posts() ) {
            the_post();
            $txt .= st()->load_template( 'vc-elements/st-list-rental/loop' , 'list' , array(
                'attr'         => $attr ,
                'data'         => $data ,
                'current_page' => $current_page
            ) );;
        }
        $rental->remove_alter_search_query();
        wp_reset_query();
        return '<div class="row row-wrap">' . $txt . '</div>';
    }
}

if(st_check_service_available( 'st_rental' )) {
    st_reg_shortcode( 'st_list_rental' , 'st_vc_list_rental' );
}