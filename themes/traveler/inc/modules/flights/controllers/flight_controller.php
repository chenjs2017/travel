<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/7/2017
 * Version: 1.0
 */

if(!class_exists('ST_Flights_Controller')){
    class ST_Flights_Controller{

        static $_inst;

        protected $post_type = 'st_flight';
        static $booking_page;

        function __construct()
        {
            add_action('init', array($this, 'init_post_type'));

            add_action('st_add_custom_permalink', array($this, '_flight_add_permalink'));
            add_action('admin_init', array($this, '_flight_save_permalink'));

            add_action( 'save_post', array($this, '_save_data_flight'), 99, 3);

            add_action('wp_ajax_st_flight_add_to_cart', array($this, '_add_to_cart'));
            add_action('wp_ajax_nopriv_st_flight_add_to_cart', array($this, '_add_to_cart'));

            add_action( 'admin_menu', [ $this, 'add_menu_page' ] );

            self::$booking_page = admin_url( 'edit.php?post_type=st_flight&page=st_flight_booking' );

            if ( $this->is_booking_page() ) {
                add_action( 'admin_init', [ $this, '_do_save_booking' ] );
            }

            add_filter('st_flight_search_form', array($this, '_flight_search_form'), 10, 5);

            add_filter( 'manage_st_flight_posts_columns', [ $this, 'add_col_header' ], 10 );
            add_action( 'manage_st_flight_posts_custom_column', [ $this, 'add_col_content' ], 10, 2 );
        }

        function init_post_type()
        {
            if ( !st_check_service_available( $this->post_type ) ) {
                return;
            }

            if ( !function_exists( 'st_reg_post_type' ) ) return;

            $labels = [
                'name'                  => __( 'Flights', ST_TEXTDOMAIN ),
                'singular_name'         => __( 'Flight', ST_TEXTDOMAIN ),
                'menu_name'             => __( 'Flights', ST_TEXTDOMAIN ),
                'name_admin_bar'        => __( 'Flight', ST_TEXTDOMAIN ),
                'add_new'               => __( 'Add New', ST_TEXTDOMAIN ),
                'add_new_item'          => __( 'Add New Flight', ST_TEXTDOMAIN ),
                'new_item'              => __( 'New Flight', ST_TEXTDOMAIN ),
                'edit_item'             => __( 'Edit Flight', ST_TEXTDOMAIN ),
                'view_item'             => __( 'View Flight', ST_TEXTDOMAIN ),
                'all_items'             => __( 'All Flights', ST_TEXTDOMAIN ),
                'search_items'          => __( 'Search Flights', ST_TEXTDOMAIN ),
                'parent_item_colon'     => __( 'Parent Flight:', ST_TEXTDOMAIN ),
                'not_found'             => __( 'No Flight found.', ST_TEXTDOMAIN ),
                'not_found_in_trash'    => __( 'No Flight found in Trash.', ST_TEXTDOMAIN ),
                'insert_into_item'      => __( 'Insert into Flight', ST_TEXTDOMAIN ),
                'uploaded_to_this_item' => __( "Uploaded to this Flight", ST_TEXTDOMAIN ),
                'featured_image'        => __( "Feature Image", ST_TEXTDOMAIN ),
                'set_featured_image'    => __( "Set featured image", ST_TEXTDOMAIN )
            ];

            $args = [
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'query_var'          => true,
                'rewrite'            => [ 'slug' => get_option( 'flight_permalink', 'st_flight' ) ],
                'capability_type'    => 'post',
                'hierarchical'       => false,
                'supports'           => [ 'author', 'title', 'excerpt' ],
                'menu_icon'          => 'dashicons-flight-alt-st'
            ];
            st_reg_post_type( 'st_flight', $args );
            $this->init_res_taxonomy();
            $this->init_post_meta();

        }

        function init_res_taxonomy(){

            $labels = array(
                'name'                       => __( "Airports", ST_TEXTDOMAIN ),
                'singular_name'              => __( "Airport", ST_TEXTDOMAIN ),
                'all_items'                  => __( 'All Airports', ST_TEXTDOMAIN ),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'edit_item'                  => __( 'Edit Airport', ST_TEXTDOMAIN ),
                'update_item'                => __( 'Update Airport', ST_TEXTDOMAIN ),
                'add_new_item'               => __( 'Add New Airport', ST_TEXTDOMAIN ),
                'new_item_name'              => __( 'New Airport Name', ST_TEXTDOMAIN ),
                'separate_items_with_commas' => __( 'Separate Airport with commas', ST_TEXTDOMAIN ),
                'add_or_remove_items'        => __( 'Add or remove Airport', ST_TEXTDOMAIN ),
                'choose_from_most_used'      => __( 'Choose from the most used Airport', ST_TEXTDOMAIN ),
                'not_found'                  => __( 'No Airport found.', ST_TEXTDOMAIN ),
                'menu_name'                  => __( 'Airports', ST_TEXTDOMAIN ),
            );

            $args = array(
                'hierarchical'          => true,
                'labels'                => $labels,
                'show_ui'               => true,
                'show_admin_column'     => false,
                'update_count_callback' => '_update_post_term_count',
                'query_var'             => true,
                'rewrite'               => [ 'slug' => 'st_airport' ],
                'meta_box_cb' => false,
                'show_in_menu' => true,
                'show_in_quick_edit' => false
            );


            st_reg_taxonomy('st_airport','st_flight', $args);

            $labels = array(
                'name'                       => __( "Airline company", ST_TEXTDOMAIN ),
                'singular_name'              => __( "Airline", ST_TEXTDOMAIN ),
                'all_items'                  => __( 'All Airline company', ST_TEXTDOMAIN ),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'edit_item'                  => __( 'Edit Airline', ST_TEXTDOMAIN ),
                'update_item'                => __( 'Update Airline', ST_TEXTDOMAIN ),
                'add_new_item'               => __( 'Add New Airline', ST_TEXTDOMAIN ),
                'new_item_name'              => __( 'New Airline Name', ST_TEXTDOMAIN ),
                'separate_items_with_commas' => __( 'Separate Airline with commas', ST_TEXTDOMAIN ),
                'add_or_remove_items'        => __( 'Add or remove Airline', ST_TEXTDOMAIN ),
                'choose_from_most_used'      => __( 'Choose from the most used Airline', ST_TEXTDOMAIN ),
                'not_found'                  => __( 'No Airline found.', ST_TEXTDOMAIN ),
                'menu_name'                  => __( 'Airline company', ST_TEXTDOMAIN ),
            );

            $args = array(
                'hierarchical'          => true,
                'labels'                => $labels,
                'show_ui'               => true,
                'show_admin_column'     => false,
                'update_count_callback' => '_update_post_term_count',
                'query_var'             => true,
                'rewrite'               => [ 'slug' => 'st_airline' ],
                'meta_box_cb' => false,
                'show_in_menu' => true,
                'show_in_quick_edit' => false
            );


            st_reg_taxonomy('st_airline','st_flight', $args);
        }

        function init_post_meta(){
            $metabox = array(
                'id'       => 'flight_metabox',
                'title'    => esc_html__( 'Flight Settings', ST_TEXTDOMAIN ),
                'pages'    => array('st_flight'),
                'context'  => 'normal',
                'priority' => 'high',
                'fields'   => array(
                    array(
                        'type' => 'tab',
                        'id' => 'tab_general',
                        'label' => esc_html__('General', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'taxonomy_select',
                        'id' => 'airline',
                        'label' => esc_html__('Airline Company', ST_TEXTDOMAIN),
                        'taxonomy' => 'st_airline',
                        'desc' => esc_html__('Choose a airline company for your flight', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'taxonomy_select',
                        'id' => 'origin',
                        'label' => esc_html__('Origin', ST_TEXTDOMAIN),
                        'taxonomy' => 'st_airport',
                        'desc' => esc_html__('Choose a airport origin for your flight', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'taxonomy_select',
                        'id' => 'destination',
                        'label' => esc_html__('Destination', ST_TEXTDOMAIN),
                        'taxonomy' => 'st_airport',
                        'desc' => esc_html__('Choose a airport destination for your flight', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'tab',
                        'id' => 'tab_flight_time',
                        'label' => esc_html__('Flight Time', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'st_timepicker',
                        'id' => 'departure_time',
                        'label' => esc_html__('Departure time', ST_TEXTDOMAIN),
                        'desc' => esc_html__('Departure time of your flight', ST_TEXTDOMAIN),
                    ),
                    array(
                        'type' => 'st_total_time',
                        'id' => 'total_time',
                        'label' => esc_html__('Total time of the flight', ST_TEXTDOMAIN),
                        'desc' => esc_html__('Total time of the flight.', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'radio',
                        'id' => 'flight_type',
                        'label' => esc_html__('Flight Type', ST_TEXTDOMAIN),
                        'choices' => array(
                            array(
                                'value' => 'direct',
                                'label' => esc_html__('Direct flight', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => 'one_stop',
                                'label' => esc_html__('One Stop', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => 'two_stops',
                                'label' => esc_html__('Two Stops', ST_TEXTDOMAIN)
                            )
                        ),
                        'std' => 'direct'
                    ),
                    array(
                        'type' => 'taxonomy_select',
                        'id' => 'airport_stop',
                        'label' => esc_html__('Stop Name', ST_TEXTDOMAIN),
                        'taxonomy' => 'st_airport',
                        'desc' => esc_html__('Choose an airport for this stop', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(one_stop)'
                    ),
                    array(
                        'type' => 'taxonomy_select',
                        'id' => 'airline_stop',
                        'label' => esc_html__('Airline Company Stop', ST_TEXTDOMAIN),
                        'taxonomy' => 'st_airline',
                        'desc' => esc_html__('Choose a airline company in stop', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(one_stop)'
                    ),
                    array(
                        'type' => 'st_total_time',
                        'id' => 'arrival_stop',
                        'label' => esc_html__('Total time to stop', ST_TEXTDOMAIN),
                        'desc' => esc_html__('Total time to stop.', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(one_stop)'
                    ),
                    array(
                        'type' => 'st_total_time',
                        'id' => 'st_stopover_time',
                        'label' => esc_html__('Stopover time in stop', ST_TEXTDOMAIN),
                        'desc' => esc_html__('Stopover time in stop.', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(one_stop)'
                    ),
                    array(
                        'type' => 'st_total_time',
                        'id' => 'departure_stop',
                        'label' => esc_html__('Total time from stop to final destination', ST_TEXTDOMAIN),
                        'desc' => esc_html__('Total time from stop to final destination', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(one_stop)'
                    ),
                    array(
                        'type' => 'taxonomy_select',
                        'id' => 'airport_stop_1',
                        'label' => esc_html__('Name of stop 1', ST_TEXTDOMAIN),
                        'taxonomy' => 'st_airport',
                        'desc' => esc_html__('Choose an airport for stop 1', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(two_stops)'
                    ),
                    array(
                        'type' => 'taxonomy_select',
                        'id' => 'airline_stop_1',
                        'label' => esc_html__('Airline Company Stop 1', ST_TEXTDOMAIN),
                        'taxonomy' => 'st_airline',
                        'desc' => esc_html__('Choose a airline company in stop 1', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(two_stops)'
                    ),
                    array(
                        'type' => 'st_total_time',
                        'id' => 'arrival_stop_1',
                        'label' => esc_html__('Total time to stop 1', ST_TEXTDOMAIN),
                        'desc' => esc_html__('Total time to stop 1.', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(two_stops)'
                    ),
                    array(
                        'type' => 'st_total_time',
                        'id' => 'st_stopover_time_1',
                        'label' => esc_html__('Stopover time in stop 1', ST_TEXTDOMAIN),
                        'desc' => esc_html__('Stopover time in stop 1.', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(two_stops)'
                    ),
                    array(
                        'type' => 'taxonomy_select',
                        'id' => 'airport_stop_2',
                        'label' => esc_html__('Name of stop 2', ST_TEXTDOMAIN),
                        'taxonomy' => 'st_airport',
                        'desc' => esc_html__('Choose an airport for stop 2', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(two_stops)'
                    ),
                    array(
                        'type' => 'taxonomy_select',
                        'id' => 'airline_stop2',
                        'label' => esc_html__('Airline Company Stop 2', ST_TEXTDOMAIN),
                        'taxonomy' => 'st_airline',
                        'desc' => esc_html__('Choose a airline company in stop 2', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(two_stops)'
                    ),
                    array(
                        'type' => 'st_total_time',
                        'id' => 'arrival_stop_2',
                        'label' => esc_html__('Total time from stop 1 to stop 2', ST_TEXTDOMAIN),
                        'desc' => esc_html__('Total time from stop 1 to stop 2.', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(two_stops)'
                    ),
                    array(
                        'type' => 'st_total_time',
                        'id' => 'st_stopover_time_2',
                        'label' => esc_html__('Stopover time in stop 2', ST_TEXTDOMAIN),
                        'desc' => esc_html__('Stopover time in stop 2.', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(two_stops)'
                    ),
                    array(
                        'type' => 'st_total_time',
                        'id' => 'departure_stop_2',
                        'label' => esc_html__('Total time from stop 2 to final destination', ST_TEXTDOMAIN),
                        'desc' => esc_html__('Total time from stop 2 to final destination', ST_TEXTDOMAIN),
                        'condition' => 'flight_type:is(two_stops)'
                    ),
                    array(
                        'type' => 'tab',
                        'id' => 'tab_availability',
                        'label' => esc_html__('Booking Details', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'text',
                        'id' => 'max_ticket',
                        'label' => esc_html__('Max Ticket', ST_TEXTDOMAIN),
                        'desc' => esc_html__('Ticket maximum for booking', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'st_flight_calendar',
                        'id' => 'st_flight_calendar',
                        'label' => esc_html__('Availability', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'tab',
                        'id' => 'st_tax_tab',
                        'label' => esc_html__('Tax Options', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'select',
                        'id' => 'enable_tax',
                        'label' => esc_html__('Enable V.A.T', ST_TEXTDOMAIN),
                        'choices' => array(
                            array(
                                'value' => 'no',
                                'label' => esc_html__('No', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => 'yes_not_included',
                                'label' => esc_html__('Yes, Not Included', ST_TEXTDOMAIN)
                            )
                        ),
                        'std' => 'no'
                    ),
                    array(
                        'type' => 'text',
                        'id' => 'vat_amount',
                        'label' => esc_html__('V.A.T Percent', ST_TEXTDOMAIN),
                        'condition' => 'enable_tax:not(no)'
                    )
                )
            );

            $data_paypment   = STPaymentGateways::get_payment_gateways();
            if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                $metabox[ 'fields' ][] = [
                    'label' => __( 'Payment', ST_TEXTDOMAIN ),
                    'id'    => 'payment_detail_tab',
                    'type'  => 'tab'
                ];
                foreach ( $data_paypment as $k => $v ) {
                    $metabox[ 'fields' ][] = [
                        'label' => $v->get_name(),
                        'id'    => 'is_meta_payment_gateway_' . $k,
                        'type'  => 'on-off',
                        'desc'  => $v->get_name(),
                        'std'   => 'on'
                    ];
                }
            }

            if ( function_exists( 'ot_register_meta_box' ) ) {
                if ( !empty( $metabox ) ) {
                    ot_register_meta_box( $metabox );
                }
            }
        }

        function _flight_add_permalink(){
            $flight_permalink = get_option( 'flight_permalink', 'st_flight' );
            ?>
            <tr>
                <th><label><?php _e( 'Flight Custom Base', ST_TEXTDOMAIN ); ?></label></th>
                <td>
                    <input name="flight_permalink" type="text"
                           value="<?php echo esc_attr( $flight_permalink ); ?>" class="regular-text code">
                </td>
            </tr>
            <?php
        }

        function _flight_save_permalink(){
            if ( !is_admin() ) {
                return;
            }
            if ( isset( $_POST[ 'flight_permalink' ] ) ){
                update_option( 'flight_permalink', $_POST[ 'flight_permalink' ] );
            }
        }

        function _save_data_flight($post_id, $post, $update ){

            if(get_post_type($post_id) == 'st_flight') {
                $origin = get_post_meta($post_id, 'origin', true);
                $destination = get_post_meta($post_id, 'destination', true);
                $flight_type = get_post_meta($post_id, 'flight_type', true);
                $max_ticket = get_post_meta($post_id, 'max_ticket', true);
                $departure_time = st_flight_convert_time_to_str(get_post_meta($post_id, 'departure_time', true));

                $airline = get_post_meta($post_id, 'airline', true);
                if(!empty($airline)) {
                    wp_set_post_terms($post_id, $airline, 'st_airline');
                }
                if(!empty($origin) && !empty($destination)){
                    wp_set_post_terms($post_id, array($origin, $destination), 'st_airport');
                }

                $location_from = get_tax_meta($origin, 'location_id');
                $location_to = get_tax_meta($destination, 'location_id');

                $flight = ST_Flights_Models::inst();
                if ($flight->get_data($post_id)) {
                    $data = array(
                        'iata_from' => $origin,
                        'location_from' => $location_from,
                        'iata_to' => $destination,
                        'location_to' => $location_to,
                        'flight_type' => $flight_type,
                        'max_ticket' => $max_ticket,
                        'departure_time' => $departure_time,
                        'airline' => $airline
                    );

                    $flight->update_data($data, array('post_id' => $post_id));
                } else {
                    $data = array(
                        'post_id' => $post_id,
                        'iata_from' => $origin,
                        'location_from' => $location_from,
                        'iata_to' => $destination,
                        'location_to' => $location_to,
                        'flight_type' => $flight_type,
                        'max_ticket' => $max_ticket,
                        'departure_time' => $departure_time,
                        'airline' => $airline
                    );

                    $flight->insert_data($data);
                }
            }
        }

        function get_search_fields_name()
        {
            return [
                'origin'       => [
                    'value' => 'origin',
                    'label' => __( 'Origin', ST_TEXTDOMAIN )
                ],
                'destination'      => [
                    'value' => 'destination',
                    'label' => __( 'Destination', ST_TEXTDOMAIN )
                ],
                'depart'     => [
                    'value' => 'depart',
                    'label' => __( 'Departing', ST_TEXTDOMAIN )
                ],
                'return'      => [
                    'value' => 'return',
                    'label' => __( 'Returning', ST_TEXTDOMAIN )
                ],
                'passengers'  => [
                    'value' => 'passengers',
                    'label' => __( 'Passengers', ST_TEXTDOMAIN )
                ]
            ];
        }

        function get_price_flight($post_id, $start, $business = false){

            $price_data = ST_Flight_Availability_Models::inst()->get_price_data($post_id, $start);

            if(!empty($price_data) && count($price_data) > 0){
                if(!$business && !empty($price_data['eco_price'])){
                    return $price_data['eco_price'];
                }
                if($business && !empty($price_data['business_price'])){
                    return $price_data['business_price'];
                }
                return false;
            }
            return false;
        }

        function alter_search_query()
        {
//            add_action( 'pre_get_posts', [ $this, 'change_search_activity_arg' ] );
            add_filter( 'posts_where', [ $this, '_get_where_query' ] );
            add_filter( 'posts_join', [ $this, '_get_join_query' ] );
//            add_filter( 'posts_orderby', [ $this, '_get_order_by_query' ] );
//            add_filter( 'posts_fields', [ $this, '_get_select_query' ] );
            add_filter( 'posts_clauses', [ $this, '_get_query_clauses' ] );
        }



        function remove_alter_search_query()
        {
//            remove_action( 'pre_get_posts', [ $this, 'change_search_activity_arg' ] );
            remove_filter( 'posts_where', [ $this, '_get_where_query' ] );
            remove_filter( 'posts_join', [ $this, '_get_join_query' ] );
//            remove_filter( 'posts_orderby', [ $this, '_get_order_by_query' ] );
//            remove_filter( 'posts_fields', [ $this, '_get_select_query' ] );
            remove_filter( 'posts_clauses', [ $this, '_get_query_clauses' ] );
        }

        function alter_search_return_query(){
            add_filter( 'posts_where', [ $this, '_get_return_where_query' ] );
            add_filter( 'posts_join', [ $this, '_get_join_query' ] );
            add_filter( 'posts_clauses', [ $this, '_get_query_clauses' ] );
        }

        function remove_alter_search_return_query()
        {
            remove_filter( 'posts_where', [ $this, '_get_return_where_query' ] );
            remove_filter( 'posts_join', [ $this, '_get_join_query' ] );
            remove_filter( 'posts_clauses', [ $this, '_get_query_clauses' ] );
        }


        function _get_query_clauses( $clauses )
        {
            global $wpdb;
            if ( empty( $clauses[ 'groupby' ] ) ) {
                $clauses[ 'groupby' ] = $wpdb->posts. ".ID";
            }

            return $clauses;
        }

        function _get_join_query($join){
            global $wpdb;

            if((STInput::get('origin',false) && STInput::get('destination',false)) || STInput::get('airline' ,false) || STInput::get('stops', false) || STInput::get('dp_time', false)){
                $join .= " JOIN {$wpdb->prefix}st_flights ON $wpdb->posts.ID = {$wpdb->prefix}st_flights.post_id ";
            }

            if(STInput::get('start', false) OR STInput::get('end', false) OR STInput::get('price_range', false)){
                $join .= " JOIN {$wpdb->prefix}st_flight_availability ON $wpdb->posts.ID = {$wpdb->prefix}st_flight_availability.post_id ";
            }

            return $join;
        }

        function _get_return_where_query($where){
            global $wpdb;

            if(($origin = STInput::get('origin',false)) && ($destination = STInput::get('destination',false))){
                $origin_id = '0'; $destination_id = '0';
                if(!empty(explode('--', $origin)[1])){
                    $origin_id = explode('--', $origin)[1];
                }
                if(!empty(explode('--', $destination)[1])){
                    $destination_id = explode('--', $destination)[1];
                }

                $where .= " AND {$wpdb->prefix}st_flights.iata_from={$destination_id} AND {$wpdb->prefix}st_flights.iata_to={$origin_id} ";
            }else{
                $where .= " AND (1<>1) ";
            }

            if($end = STInput::get('end', false)){
                $str_end = strtotime(TravelHelper::convertDateFormat($end));

                $where .= " AND {$wpdb->prefix}st_flight_availability.start_date={$str_end} AND {$wpdb->prefix}st_flight_availability.`status`='available' ";
            }else{
                $where .= " AND (1<>1) ";
            }

            $where = $this->meta_where($where);

            return $where;
        }

        function _get_where_query($where){
            global $wpdb;

            if(($origin = STInput::get('origin',false)) && ($destination = STInput::get('destination',false))){
                $origin_id = '0'; $destination_id = '0';
                if(!empty(explode('--', $origin)[1])){
                    $origin_id = explode('--', $origin)[1];
                }
                if(!empty(explode('--', $destination)[1])){
                    $destination_id = explode('--', $destination)[1];
                }

                $where .= " AND {$wpdb->prefix}st_flights.iata_from={$origin_id} AND {$wpdb->prefix}st_flights.iata_to={$destination_id} ";
            }else{
                $where .= " AND (1<>1) ";
            }

            if($start = STInput::get('start', false)){
                $str_start = strtotime(TravelHelper::convertDateFormat($start));

                $where .= " AND {$wpdb->prefix}st_flight_availability.start_date={$str_start} AND {$wpdb->prefix}st_flight_availability.`status`='available' ";
            }else{
                $where .= " AND (1<>1) ";
            }

            $where = $this->meta_where($where);

            return $where;
        }

        function meta_where($where){
            global $wpdb;
            if($airlines = STInput::get('airline' ,false)){
                $where .= " AND {$wpdb->prefix}st_flights.airline IN ({$airlines}) ";
            }

            if($stops = STInput::get('stops', false)){
                $arr_stops = explode(',', $stops);
                $in = '';
                foreach($arr_stops as $key => $val){
                    if($key == 0){
                        $in = "'".$val."'";
                    }else{
                        $in .= ",'".$val."'";
                    }
                }

                $where .= " AND {$wpdb->prefix}st_flights.flight_type IN ({$in}) ";
            }

            if($dp_time = STInput::get('dp_time', false)){
                $departure = explode(',', $dp_time);
                if(count($departure) > 0 && count($departure) < 3) {
                    $where_depart_arr = array();
                    foreach ($departure as $val) {
                        switch ($val) {
                            case 'mn':
                                $start = 5 * 3600;
                                $end = 11 * 3600 + 59 * 60;
                                if ($start && $end) {
                                    $where_depart_arr[] = " ({$wpdb->prefix}st_flights.departure_time >= {$start} AND {$wpdb->prefix}st_flights.departure_time <= {$end}) ";
                                }
                                break;
                            case 'at':
                                $start = 12 * 3600;
                                $end = 17 * 3600 + 59 * 60;
                                if ($start && $end) {
                                    $where_depart_arr[] = " ({$wpdb->prefix}st_flights.departure_time >= {$start} AND {$wpdb->prefix}st_flights.departure_time <= {$end}) ";
                                }
                                break;
                            case 'ev':
                                $start = 18 * 3600;
                                $end = 23 * 3600 + 59 * 60;
                                if ($start && $end) {
                                    $where_depart_arr[] = " ({$wpdb->prefix}st_flights.departure_time >= {$start} AND {$wpdb->prefix}st_flights.departure_time <= {$end}) ";
                                }
                                break;
                        }
                    }
                    $where_depart = implode(' OR ', $where_depart_arr);
                    $where .= " AND ($where_depart)";
                }

            }

            if($price_range = STInput::get('price_range', false)){

                $min_max = explode(';',$price_range);
                $min = !empty($min_max[0])?$min_max[0]:0;
                $max = !empty($min_max[1])?$min_max[1]:0;
                if($max > 0){
                    $where .= " AND (({$wpdb->prefix}st_flight_availability.eco_price >= {$min} AND {$wpdb->prefix}st_flight_availability.eco_price <= {$max}) OR ({$wpdb->prefix}st_flight_availability.business_price >= {$min} AND {$wpdb->prefix}st_flight_availability.business_price <= {$max})) ";
                }
            }

            return $where;
        }

        function _add_to_cart(){

        }


        function add_menu_page()
        {
            //Add booking page
            add_submenu_page( 'edit.php?post_type=st_flight', __( 'Flight Booking', ST_TEXTDOMAIN ), __( 'Flight Booking', ST_TEXTDOMAIN ), 'manage_options', 'st_flight_booking', [ $this, '__flight_booking_page' ] );
        }

        function __flight_booking_page()
        {

            $section = isset( $_GET[ 'section' ] ) ? $_GET[ 'section' ] : FALSE;

            if ( $section ) {
                switch ( $section ) {
                    case "edit_order_item":
                        $this->edit_order_item();
                        break;
                }
            } else {

                $action = isset( $_POST[ 'st_action' ] ) ? $_POST[ 'st_action' ] : FALSE;
                switch ( $action ) {
                    case "delete":
                        $this->_delete_items();
                        break;
                }
                echo balanceTags( st_flight_load_view( 'admin/booking_index', FALSE ) );
            }

        }

        function _do_save_booking()
        {
            $section = isset( $_GET[ 'section' ] ) ? $_GET[ 'section' ] : FALSE;
            switch ( $section ) {
                case "edit_order_item":
                    $item_id = isset( $_GET[ 'order_item_id' ] ) ? $_GET[ 'order_item_id' ] : FALSE;
                    if ( !$item_id or get_post_type( $item_id ) != 'st_order' ) {
                        return FALSE;
                    }
                    if ( isset( $_POST[ 'submit' ] ) and $_POST[ 'submit' ] ) $this->_save_booking( $item_id );
                    break;
                case 'resend_email_flight':
                    $this->_resend_mail();
                    break;
            }
        }

        function _resend_mail()
        {
            $order_item = isset( $_GET[ 'order_item_id' ] ) ? $_GET[ 'order_item_id' ] : FALSE;

            $test = isset( $_GET[ 'test' ] ) ? $_GET[ 'test' ] : FALSE;
            if ( $order_item ) {

                $order = $order_item;

                if ( $test ) {
                    global $order_id;
                    $order_id       = $order_item;
                    $email_to_admin = st()->get_option( 'email_for_admin', '' );
                    $email          = st()->load_template( 'email/header' );
                    $email .= do_shortcode( $email_to_admin );
                    $email .= st()->load_template( 'email/footer' );
                    echo( $email );
                    die;
                }


                if ( $order ) {
                    STCart::send_mail_after_booking( $order );
                }
            }

            wp_safe_redirect( self::$booking_page . '&send_mail=success' );
        }

        function edit_order_item()
        {
            $item_id = isset( $_GET[ 'order_item_id' ] ) ? $_GET[ 'order_item_id' ] : FALSE;
            if ( !$item_id or get_post_type( $item_id ) != 'st_order' ) {
                return FALSE;
            }
            if ( isset( $_POST[ 'submit' ] ) and $_POST[ 'submit' ] ) $this->_save_booking( $item_id );

            echo balanceTags( st_flight_load_view( 'admin/booking_edit' ) );
        }

        function _check_validate()
        {
            $st_first_name = STInput::request( 'st_first_name', '' );
            if ( empty( $st_first_name ) ) {
                STAdmin::set_message( __( 'The firstname field is not empty.', ST_TEXTDOMAIN ), 'danger' );

                return FALSE;
            }

            $st_last_name = STInput::request( 'st_last_name', '' );
            if ( empty( $st_last_name ) ) {
                STAdmin::set_message( __( 'The lastname field is not empty.', ST_TEXTDOMAIN ), 'danger' );

                return FALSE;
            }

            $st_email = STInput::request( 'st_email', '' );
            if ( empty( $st_email ) ) {
                STAdmin::set_message( __( 'The email field is not empty.', ST_TEXTDOMAIN ), 'danger' );

                return FALSE;
            }

            $st_phone = STInput::request( 'st_phone', '' );
            if ( empty( $st_phone ) ) {
                STAdmin::set_message( __( 'The phone field is not empty.', ST_TEXTDOMAIN ), 'danger' );

                return FALSE;
            }


            return true;

        }

        function _save_booking( $order_id )
        {
            if ( !check_admin_referer( 'shb_action', 'shb_field' ) ) die( 'shb_action' );
            if ( $this->_check_validate() ) {

                $check_out_field = STCart::get_checkout_fields();

                if ( !empty( $check_out_field ) ) {
                    foreach ( $check_out_field as $field_name => $field_desc ) {
                        if($field_name != 'st_note'){
                            update_post_meta( $order_id, $field_name, STInput::post( $field_name ) );
                        }
                    }
                }

                $item_data = [
                    'status' => $_POST[ 'status' ]
                ];

                foreach ( $item_data as $key => $value ) {
                    update_post_meta( $order_id, $key, $value );
                }

                if ( TravelHelper::checkTableDuplicate( 'st_flights' ) ) {
                    global $wpdb;

                    $table = $wpdb->prefix . 'st_order_item_meta';
                    $data  = [
                        'status' => $_POST[ 'status' ]
                    ];

                    $where = [
                        'order_item_id' => $order_id
                    ];
                    $wpdb->update( $table, $data, $where );
                }

                STCart::send_mail_after_booking( $order_id, TRUE );

                wp_safe_redirect( self::$booking_page );
            }

        }

        function _delete_items()
        {

            if ( empty( $_POST ) or !check_admin_referer( 'shb_action', 'shb_field' ) ) {
                //// process form data, e.g. update fields
                return;
            }
            $ids = isset( $_POST[ 'post' ] ) ? $_POST[ 'post' ] : [];
            if ( !empty( $ids ) ) {
                foreach ( $ids as $id )
                    wp_delete_post( $id, TRUE );

            }

            STAdmin::set_message( __( "Delete item(s) success", ST_TEXTDOMAIN ), 'updated' );

        }

        function _flight_search_form($html, $data, $key, $val, $active){
            $html .= '<div class="tab-pane fade '.$active.'" id="tab-flight'.$key.'">';
            if (empty($val['tab_html_custom'])){
                $html .= st_flight_load_view('search/search-form',false, $data);
            }else {
                $html.= do_shortcode($val['tab_html_custom']);
            }
            $html .='</div>';

            return $html;

        }

        function is_booking_page()
        {
            if ( is_admin()
                and isset( $_GET[ 'post_type' ] )
                and $_GET[ 'post_type' ] == 'st_flight'
                and isset( $_GET[ 'page' ] )
                and $_GET[ 'page' ] = 'st_flight_booking'
            ) return TRUE;

            return FALSE;
        }

        function add_col_header( $defaults )
        {

            $this->array_splice_assoc( $defaults, 2, 0, [
                'airline'   => __( "Airline", ST_TEXTDOMAIN ),
                'departure'   => __( "Departure", ST_TEXTDOMAIN )
            ] );

            return $defaults;
        }

        function array_splice_assoc( &$input, $offset, $length = 0, $replacement = [] )
        {
            $tail      = array_splice( $input, $offset );
            $extracted = array_splice( $tail, 0, $length );
            $input += $replacement + $tail;

            return $extracted;
        }

        function add_col_content( $column_name, $post_ID )
        {
            if ( $column_name == 'airline' ) {
                // show content of 'directors_name' column
                $airline = get_post_meta( $post_ID, 'airline', TRUE );

                if ( $airline ) {
                    $airline_object = get_term_by('id', $airline, 'st_airline');
                    if(!empty($airline_object->name)){
                        echo esc_attr($airline_object->name);
                    }
                }
            }
            if( $column_name == 'departure'){
                $departure = get_post_meta($post_ID, 'departure_time', true);

                echo strtoupper($departure);
            }
        }

        static function inst(){
            if(!self::$_inst)
                self::$_inst = new self();

            return self::$_inst;
        }
    }

    ST_Flights_Controller::inst();
}