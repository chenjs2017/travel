<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STUser_f
     *
     * Created by ShineTheme
     *
     */
    $cancel_order_id    = '';
    $cancel_cancel_data = [];
    if ( !class_exists( 'STUser_f' ) ) {
        class STUser_f extends TravelerObject
        {
            public static $msg = '';
            public static $validator;

            function init()
            {
                parent::init();
                self::$validator = new STValidate();

                add_action( 'init', [ $this, 'st_is_partner' ] );
                add_action( 'init', [ $this, 'st_login_func' ] );
                add_action( 'init', [ $this, 'update_user' ] );
                add_action( 'init', [ $this, 'update_info_partner' ] );
                add_action( 'init', [ $this, 'update_pass' ] );
                add_action( 'init', [ $this, 'upload_image' ] );

                add_action( 'init', [ $this, 'st_update_post_type_hotel' ], 50 );
                add_action( 'init', [ $this, 'st_update_post_type_room' ], 50 );

                add_action( 'init', [ $this, 'st_update_post_type_rental' ], 50 );
                add_action( 'init', [ $this, 'st_update_rental_room' ], 50 );

                add_action( 'init', [ $this, 'st_update_post_type_tours' ], 50 );

                add_action( 'init', [ $this, 'st_update_post_type_flight' ], 50 );

                add_action( 'init', [ $this, 'st_update_post_type_activity' ], 50 );

                add_action( 'init', [ $this, 'st_update_post_type_cars' ], 50 );

                add_action( 'init', [ $this, 'st_insert_post_type_location' ], 50 );
                add_action( 'init', [ $this, 'st_write_review' ], 50 );

                add_action( 'init', [ $this, '_update_certificate_user' ], 50 );


                add_action( 'wp_ajax_st_add_wishlist', [ $this, 'st_add_wishlist_func' ] );
                add_action( 'wp_ajax_nopriv_st_add_wishlist', [ $this, 'st_add_wishlist_func' ] );

                add_action( 'wp_ajax_st_remove_wishlist', [ $this, 'st_remove_wishlist_func' ] );
                add_action( 'wp_ajax_nopriv_st_remove_wishlist', [ $this, 'st_remove_wishlist_func' ] );

                add_action( 'wp_ajax_st_load_more_wishlist', [ $this, 'st_load_more_wishlist_func' ] );
                add_action( 'wp_ajax_nopriv_st_load_more_wishlist', [ $this, 'st_load_more_wishlist_func' ] );

                add_action( 'wp_ajax_st_remove_post_type', [ $this, 'st_remove_post_type_func' ] );
                add_action( 'wp_ajax_nopriv_st_remove_post_type', [ $this, 'st_remove_post_type_func' ] );

                add_action( 'wp_ajax_st_change_status_post_type', [ $this, 'st_change_status_post_type_func' ] );
                add_action( 'wp_ajax_nopriv_st_change_status_post_type', [ $this, 'st_change_status_post_type_func' ] );


                add_action( 'template_redirect', [ $this, 'check_login' ] );

                add_action( 'wp_ajax_st_load_more_history_book', [ $this, 'get_book_history' ] );
                add_action( 'wp_ajax_nopriv_st_load_more_history_book', [ $this, 'get_book_history' ] );


                add_action( 'wp_ajax_st_load_month_by_year_partner', [ $this, '_st_load_month_by_year_partner' ] );
                add_action( 'wp_ajax_nopriv_st_load_month_by_year_partner', [ $this, '_st_load_month_by_year_partner' ] );
                add_action( 'wp_ajax_st_load_day_by_month_and_year_partner', [ $this, '_st_load_day_by_month_and_year_partner' ] );
                add_action( 'wp_ajax_nopriv_st_load_day_by_month_and_year_partner', [ $this, '_st_load_day_by_month_and_year_partner' ] );

                add_action( 'wp_ajax_st_load_month_all_time_by_year_partner', [ $this, '_st_load_month_all_time_by_year_partner' ] );
                add_action( 'wp_ajax_nopriv_st_load_month_all_time_by_year_partner', [ $this, '_st_load_month_all_time_by_year_partner' ] );
                add_action( 'wp_ajax_st_load_day_all_time_by_month_and_year_partner', [ $this, '_st_load_day_all_time_by_month_and_year_partner' ] );

                add_action( 'wp_ajax_nopriv_st_load_day_all_time_by_month_and_year_partner', [ $this, '_st_load_day_all_time_by_month_and_year_partner' ] );


                add_action( 'wp_ajax_update_certificates', [ $this, '_update_certificates' ] );
                add_action( 'wp_ajax_nopriv_update_certificates', [ $this, '_update_certificates' ] );

                add_action( 'wp_ajax_send_email_for_user_partner', [ $this, '_send_email_for_user_partner' ] );
                add_action( 'wp_ajax_nopriv_send_email_for_user_partner', [ $this, '_send_email_for_user_partner' ] );

                add_action( 'wp_ajax_get_list_item_service_available', [ $this, '_get_list_item_service_available' ] );
                add_action( 'wp_ajax_nopriv_get_list_item_service_available', [ $this, '_get_list_item_service_available' ] );

                add_action( 'wp_ajax_st_get_cancel_booking_step_1', [ $this, 'st_get_cancel_booking_step_1' ] );
                add_action( 'wp_ajax_st_get_cancel_booking_step_2', [ $this, 'st_get_cancel_booking_step_2' ] );
                add_action( 'wp_ajax_st_get_cancel_booking_step_3', [ $this, 'st_get_cancel_booking_step_3' ] );
                add_action( 'wp_ajax_st_get_refund_infomation', [ $this, 'st_get_refund_infomation' ] );
                add_action( 'wp_ajax_st_check_complete_refund', [ $this, 'st_check_complete_refund' ] );

                add_action( 'wp_ajax_st_login_popup', [ $this, '_st_login_popup' ] );
                add_action( 'wp_ajax_nopriv_st_login_popup', [ $this, '_st_login_popup' ] );

                add_action( 'wp_ajax_st_registration_popup', [ $this, '_st_registration_popup' ] );
                add_action( 'wp_ajax_nopriv_st_registration_popup', [ $this, '_st_registration_popup' ] );

                add_action( 'init', [ __CLASS__, 'session_init' ] );

                add_action( 'init', [ $this, 'reset_password' ], 50 );

                /**
                 *   Upload media partner
                 * @since 1.3.1
                 **/
                add_action( 'init', [ $this, '_enuque_media_partner' ] );


            }

            /**
             *   Upload media partner
             * @since 1.3.1
             **/
            public function _enuque_media_partner()
            {
                add_action( 'wp_enqueue_scripts', [ $this, '_enqueue_scripts' ] );
                add_filter( 'ajax_query_attachments_args', [ $this, '_filter_media' ] );
            }

            public function _enqueue_scripts()
            {
                wp_enqueue_media();
                wp_register_script( 'user_upload.js', get_template_directory_uri() . '/js/user-upload.js', [ 'jquery' ], null, true );
            }

            public function _filter_media( $query )
            {
                if ( !current_user_can( 'manage_options' ) )
                    $query[ 'author' ] = get_current_user_id();

                return $query;
            }

            static function session_init()
            {
                if ( session_id() == false ) {
                    session_start();
                }
            }

            public function reset_password()
            {
                if ( STInput::post( 'action', '' ) == 'reset_password' &&
                    wp_verify_nonce( $_POST[ 'security_field' ], 'security' )
                ) {
                    $email = esc_html( STInput::post( 'email', '' ) );
                    if ( empty( $email ) || !email_exists( $email ) ) {
                        STTemplate::set_message( __( 'Your email is invalid', ST_TEXTDOMAIN ), 'danger' );

                        return false;
                    }
                    $user = get_user_by( 'email', $email );
                    if ( !$user ) {
                        STTemplate::set_message( __( 'You account is not exists. Please re-check your information.', ST_TEXTDOMAIN ), 'danger' );

                        return false;
                    }
                    $random_password = wp_generate_password( 12, false );
                    $update_user     = wp_update_user( [
                            'ID'        => $user->ID,
                            'user_pass' => $random_password
                        ]
                    );
                    if ( $update_user ) {
                        $to      = $email;
                        $subject = 'Your new password';
                        $sender  = get_option( 'name' );

                        $message = 'Your new password is: ' . $random_password;

                        $headers[] = 'MIME-Version: 1.0' . "\r\n";
                        $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers[] = "X-Mailer: PHP \r\n";
                        $headers[] = 'From: ' . $sender . ' < ' . $email . '>' . "\r\n";

                        $mail = @wp_mail( $to, $subject, $message, $headers );
                        if ( $mail ) {
                            STTemplate::set_message( __( 'Check your email address for your new password.', ST_TEXTDOMAIN ), 'success' );

                            return true;
                        } else {
                            STTemplate::set_message( __( 'Oops something went wrong updaing your account.', ST_TEXTDOMAIN ), 'danger' );

                            return false;
                        }
                    } else {
                        STTemplate::set_message( __( 'Oops something went wrong updaing your account.', ST_TEXTDOMAIN ), 'danger' );

                        return false;
                    }
                }
            }

            public function add_where_join_refund()
            {
                add_filter( 'posts_where', [ $this, 'where_refund' ] );
                add_filter( 'posts_join', [ $this, 'join_refund' ] );
                add_filter( 'posts_fields', [ $this, 'field_refund' ] );
            }

            public function remove_where_join_refund()
            {
                remove_filter( 'posts_where', [ $this, 'where_refund' ] );
                remove_filter( 'posts_join', [ $this, 'join_refund' ] );
                remove_filter( 'posts_fields', [ $this, 'field_refund' ] );
            }

            public function where_refund( $where )
            {
                $where .= " AND od.`status` = 'canceled'
            AND CAST(od.cancel_refund AS UNSIGNED)
            AND od.cancel_refund_status = 'pending'";

                return $where;
            }

            public function join_refund( $join )
            {
                global $wpdb;
                $join .= " INNER JOIN {$wpdb->prefix}st_order_item_meta AS od ON od.order_item_id = {$wpdb->prefix}posts.ID";

                return $join;
            }

            public function field_refund( $fields )
            {
                $fields = " od.* ";

                return $fields;
            }

            public function st_check_complete_refund()
            {
                global $cancel_order_id, $cancel_cancel_data;

                $order_id      = STInput::request( 'order_id', '' );
                $order_encrypt = STInput::request( 'order_encrypt' );

                if ( TravelHelper::st_compare_encrypt( $order_id, $order_encrypt ) ) {
                    $cancel_data                 = get_post_meta( $order_id, 'cancel_data', true );
                    $enable_email_cancel_success = st()->get_option( 'enable_email_cancel_success', 'on' );

                    if ( $cancel_data ) {
                        $cancel_data[ 'cancel_refund_status' ] = 'complete';
                        update_post_meta( $order_id, 'cancel_data', $cancel_data );

                        global $wpdb;

                        $query = "UPDATE {$wpdb->prefix}st_order_item_meta set cancel_refund_status='complete' where order_item_id={$order_id}";

                        $wpdb->query( $query );

                        $message = st()->load_template( 'user/cancel-booking/cancel', 'success-refund', [ 'cancel_data' => $cancel_data ] );


                        $cancel_order_id    = $order_id;
                        $cancel_cancel_data = $cancel_data;

                        if ( $enable_email_cancel_success == 'on' ) {
                            $this->_send_email_refund( $order_id, 'success' );
                        }


                        echo json_encode( [
                            'status'  => 1,
                            'message' => $message
                        ] );
                        die;

                    }
                }
                echo json_encode( [
                    'status'  => 1,
                    'message' => '<div class="text-danger">' . __( 'Have an error when get data. Try again!', ST_TEXTDOMAIN ) . '</div>',
                ] );
                die;
            }

            public function st_get_refund_infomation()
            {
                $order_id      = STInput::request( 'order_id', '' );
                $order_encrypt = STInput::request( 'order_encrypt' );
                if ( TravelHelper::st_compare_encrypt( $order_id, $order_encrypt ) ) {
                    $cancel_data = get_post_meta( $order_id, 'cancel_data', true );
                    if ( $cancel_data ) {
                        $message = st()->load_template( 'user/cancel-booking/cancel', 'with-refund', [ 'cancel_data' => $cancel_data ] );
                        echo json_encode( [
                            'status'        => 1,
                            'message'       => $message,
                            'step'          => 'st_check_complete_refund',
                            'order_id'      => $order_id,
                            'order_encrypt' => $order_encrypt
                        ] );
                        die;
                    }
                }
                echo json_encode( [
                    'status'        => 0,
                    'message'       => '<div class="text-danger">' . __( 'Have an error when get data. Try again!', ST_TEXTDOMAIN ) . '</div>',
                    'step'          => '',
                    'order_id'      => $order_id,
                    'order_encrypt' => $order_encrypt
                ] );
                die;
            }

            public function st_get_cancel_booking_step_1()
            {
                $order_id      = STInput::request( 'order_id', '' );
                $order_encrypt = STInput::request( 'order_encrypt' );
                if ( TravelHelper::st_compare_encrypt( $order_id, $order_encrypt ) ) {
                    $message = st()->load_template( 'user/cancel-booking/cancel', 'step-1', [ 'order_id' => $order_id ] );

                    $_SESSION[ 'cancel_data' ][ 'order_id' ]      = $order_id;
                    $_SESSION[ 'cancel_data' ][ 'order_encrypt' ] = $order_encrypt;
                    $status                                       = get_post_meta( $order_id, 'status', true );

                    $step = 'next-to-step-2';
                    if ( $status != 'complete' ) {
                        $step = 'next-to-step-3';
                    }

                    echo json_encode( [
                        'status'        => 1,
                        'message'       => $message,
                        'order_id'      => $order_id,
                        'order_encrypt' => $order_encrypt,
                        'step'          => $step
                    ] );
                    die;
                }

                echo json_encode( [
                    'status'        => 0,
                    'message'       => '<div class="text-danger">' . __( 'Have an error when get data. Try again!', ST_TEXTDOMAIN ) . '</div>',
                    'order_id'      => $order_id,
                    'order_encrypt' => $order_encrypt,
                    'step'          => ''
                ] );
                die;
            }

            public function st_get_cancel_booking_step_2()
            {
                $order_id      = STInput::request( 'order_id', '' );
                $order_encrypt = STInput::request( 'order_encrypt' );
                $why_cancel    = STInput::request( 'why_cancel', '' );
                $detail        = STInput::request( 'detail', '' );

                if ( TravelHelper::st_compare_encrypt( $order_id, $order_encrypt ) ) {
                    $message = st()->load_template( 'user/cancel-booking/cancel', 'step-2', [ 'order_id' => $order_id ] );

                    $_SESSION[ 'cancel_data' ][ 'why_cancel' ] = $why_cancel;
                    $_SESSION[ 'cancel_data' ][ 'detail' ]     = $detail;

                    echo json_encode( [
                        'status'        => 1,
                        'message'       => $message,
                        'order_id'      => $order_id,
                        'order_encrypt' => $order_encrypt,
                        'step'          => 'next-to-step-3'
                    ] );
                    die;
                }

                echo json_encode( [
                    'status'        => 0,
                    'message'       => '<div class="text-danger">' . __( 'Have an error when get data. Try again!', ST_TEXTDOMAIN ) . '</div>',
                    'order_id'      => $order_id,
                    'order_encrypt' => $order_encrypt,
                    'step'          => ''

                ] );
                die;
            }

            public function st_get_cancel_booking_step_3()
            {
                global $wpdb;
                global $cancel_order_id, $cancel_cancel_data;

                $order_id      = STInput::request( 'order_id', '' );
                $order_encrypt = STInput::request( 'order_encrypt' );
                if ( TravelHelper::st_compare_encrypt( $order_id, $order_encrypt ) ) {

                    $item_id   = (int)get_post_meta( $order_id, 'st_booking_id', true );
                    $post_type = get_post_meta( $order_id, 'st_booking_post_type', true );
                    if ( $post_type == 'st_hotel' ) {
                        $room_id = (int)get_post_meta( $order_id, 'room_id', true );
                    }
                    $total_price = (float)get_post_meta( $order_id, 'total_price', true );
                    $currency    = STUser_f::_get_currency_book_history( $order_id );

                    $percent = (int)get_post_meta( $item_id, 'st_cancel_percent', true );
                    if ( $post_type == 'st_hotel' && isset( $room_id ) ) {
                        $percent = (int)get_post_meta( $room_id, 'st_cancel_percent', true );
                    }

                    $refunded             = $total_price - ( $total_price * $percent / 100 );
                    $status               = get_post_meta( $order_id, 'status', true );
                    $cancel_refund_status = 'pending';

                    if ( $status != 'complete' ) {
                        $refunded             = 0;
                        $cancel_refund_status = 'complete';
                    }

                    $select_account = STInput::request( 'select_account', '' );

                    $refund_for_partner  = 'false';
                    $percent_for_partner = 'false';

                    $enable_email_cancel = st()->get_option( 'enable_email_cancel', 'on' );

                    if ( empty( $select_account ) ) {
                        $cancel_data = [
                            'order_id'             => $order_id,
                            'cancel_percent'       => $percent,
                            'refunded'             => $refunded,
                            'your_paypal'          => false,
                            'your_bank'            => false,
                            'your_stripe'          => false,
                            'your_payfast'         => false,
                            'currency'             => $currency,
                            'why_cancel'           => $_SESSION[ 'cancel_data' ][ 'why_cancel' ],
                            'detail'               => $_SESSION[ 'cancel_data' ][ 'detail' ],
                            'status_before'        => $status,
                            'cancel_refund_status' => $cancel_refund_status,
                            'refund_for_partner'   => $refund_for_partner,
                            'percent_for_partner'  => $percent_for_partner
                        ];

                        $cancel = self::_cancel_booking( $order_id );
                        if ( $cancel ) {

                            $query = "UPDATE {$wpdb->prefix}st_order_item_meta set cancel_refund='{$refunded}' , cancel_refund_status='{$cancel_refund_status}' where order_item_id={$order_id}";

                            $wpdb->query( $query );

                            update_post_meta( $order_id, 'cancel_data', $cancel_data );
                            unset( $_SESSION[ 'cancel_data' ] );

                            $message = st()->load_template( 'user/cancel-booking/success', 'none', [ 'cancel_data' => $cancel_data ] );

                            $cancel_order_id    = $order_id;
                            $cancel_cancel_data = $cancel_data;

                            echo json_encode( [
                                'status'  => 1,
                                'message' => $message,
                                'step'    => ''
                            ] );
                            die;
                        }
                    }
                    if ( $select_account == 'your_bank' ) {
                        $account_name   = STInput::request( 'account_name', '' );
                        $account_number = STInput::request( 'account_number', '' );
                        $bank_name      = STInput::request( 'bank_name', '' );
                        $swift_code     = STInput::request( 'swift_code', '' );

                        $cancel_data = [
                            'order_id'             => $order_id,
                            'cancel_percent'       => $percent,
                            'refunded'             => $refunded,
                            'your_paypal'          => false,
                            'your_bank'            => [
                                'account_name'   => $account_name,
                                'account_number' => $account_number,
                                'bank_name'      => $bank_name,
                                'swift_code'     => $swift_code
                            ],
                            'your_stripe'          => false,
                            'your_payfast'         => false,
                            'currency'             => $currency,
                            'why_cancel'           => $_SESSION[ 'cancel_data' ][ 'why_cancel' ],
                            'detail'               => $_SESSION[ 'cancel_data' ][ 'detail' ],
                            'status_before'        => $status,
                            'cancel_refund_status' => $cancel_refund_status,
                            'refund_for_partner'   => $refund_for_partner,
                            'percent_for_partner'  => $percent_for_partner
                        ];

                        $cancel = self::_cancel_booking( $order_id );
                        if ( $cancel ) {

                            $query = "UPDATE {$wpdb->prefix}st_order_item_meta set cancel_refund='{$refunded}' , cancel_refund_status='{$cancel_refund_status}' where order_item_id={$order_id}";

                            $wpdb->query( $query );

                            update_post_meta( $order_id, 'cancel_data', $cancel_data );
                            unset( $_SESSION[ 'cancel_data' ] );

                            $message = st()->load_template( 'user/cancel-booking/success', 'bank', [ 'cancel_data' => $cancel_data ] );

                            $cancel_order_id    = $order_id;
                            $cancel_cancel_data = $cancel_data;

                            if ( $enable_email_cancel == 'on' ) {
                                $this->_send_email_refund( $order_id, 'has-refund' );
                            }


                            echo json_encode( [
                                'status'  => 1,
                                'message' => $message,
                                'step'    => ''
                            ] );
                            die;
                        }

                    }
                    if ( $select_account == 'your_paypal' ) {

                        $paypal_email = STInput::request( 'paypal_email', '' );

                        $cancel_data = [
                            'order_id'             => $order_id,
                            'cancel_percent'       => $percent,
                            'refunded'             => $refunded,
                            'your_paypal'          => [
                                'paypal_email' => $paypal_email
                            ],
                            'your_bank'            => false,
                            'your_stripe'          => false,
                            'your_payfast'         => false,
                            'currency'             => $currency,
                            'why_cancel'           => $_SESSION[ 'cancel_data' ][ 'why_cancel' ],
                            'detail'               => $_SESSION[ 'cancel_data' ][ 'detail' ],
                            'status_before'        => $status,
                            'cancel_refund_status' => $cancel_refund_status,
                            'refund_for_partner'   => $refund_for_partner,
                            'percent_for_partner'  => $percent_for_partner
                        ];

                        $cancel = self::_cancel_booking( $order_id );
                        if ( $cancel ) {

                            $query = "UPDATE {$wpdb->prefix}st_order_item_meta set cancel_refund='{$refunded}' , cancel_refund_status='{$cancel_refund_status}' where order_item_id={$order_id}";

                            $wpdb->query( $query );

                            update_post_meta( $order_id, 'cancel_data', $cancel_data );
                            unset( $_SESSION[ 'cancel_data' ] );

                            $message = st()->load_template( 'user/cancel-booking/success', 'paypal', [ 'cancel_data' => $cancel_data ] );

                            $cancel_order_id    = $order_id;
                            $cancel_cancel_data = $cancel_data;

                            if ( $enable_email_cancel == 'on' ) {
                                $this->_send_email_refund( $order_id, 'has-refund' );
                            }


                            echo json_encode( [
                                'status'  => 1,
                                'message' => $message,
                                'step'    => ''
                            ] );
                            die;
                        }

                    }
                    if ( $select_account == 'your_stripe' ) {

                        $transaction_id = STInput::request( 'transaction_id', '' );

                        $cancel_data = [
                            'order_id'             => $order_id,
                            'cancel_percent'       => $percent,
                            'refunded'             => $refunded,
                            'your_paypal'          => false,
                            'your_bank'            => false,
                            'your_stripe'          => false,
                            'your_payfast'         => false,
                            'your_stripe'          => [
                                'transaction_id' => $transaction_id
                            ],
                            'currency'             => $currency,
                            'why_cancel'           => $_SESSION[ 'cancel_data' ][ 'why_cancel' ],
                            'detail'               => $_SESSION[ 'cancel_data' ][ 'detail' ],
                            'status_before'        => $status,
                            'cancel_refund_status' => $cancel_refund_status,
                            'refund_for_partner'   => $refund_for_partner,
                            'percent_for_partner'  => $percent_for_partner
                        ];

                        $cancel = self::_cancel_booking( $order_id );
                        if ( $cancel ) {

                            $query = "UPDATE {$wpdb->prefix}st_order_item_meta set cancel_refund='{$refunded}' , cancel_refund_status='{$cancel_refund_status}' where order_item_id={$order_id}";

                            $wpdb->query( $query );

                            update_post_meta( $order_id, 'cancel_data', $cancel_data );
                            unset( $_SESSION[ 'cancel_data' ] );

                            $message = st()->load_template( 'user/cancel-booking/success', 'stripe', [ 'cancel_data' => $cancel_data ] );

                            $cancel_order_id    = $order_id;
                            $cancel_cancel_data = $cancel_data;

                            if ( $enable_email_cancel == 'on' ) {
                                $this->_send_email_refund( $order_id, 'has-refund' );
                            }


                            echo json_encode( [
                                'status'  => 1,
                                'message' => $message,
                                'step'    => ''
                            ] );
                            die;
                        }

                    }
                    if ( $select_account == 'your_payfast' ) {

                        $transaction_id = STInput::request( 'transaction_id', '' );

                        $cancel_data = [
                            'order_id'             => $order_id,
                            'cancel_percent'       => $percent,
                            'refunded'             => $refunded,
                            'your_paypal'          => false,
                            'your_bank'            => false,
                            'your_stripe'          => false,
                            'your_stripe'          => false,
                            'your_payfast'         => [
                                'transaction_id' => $transaction_id
                            ],
                            'currency'             => $currency,
                            'why_cancel'           => $_SESSION[ 'cancel_data' ][ 'why_cancel' ],
                            'detail'               => $_SESSION[ 'cancel_data' ][ 'detail' ],
                            'status_before'        => $status,
                            'cancel_refund_status' => $cancel_refund_status,
                            'refund_for_partner'   => $refund_for_partner,
                            'percent_for_partner'  => $percent_for_partner
                        ];

                        $cancel = self::_cancel_booking( $order_id );
                        if ( $cancel ) {

                            $query = "UPDATE {$wpdb->prefix}st_order_item_meta set cancel_refund='{$refunded}' , cancel_refund_status='{$cancel_refund_status}' where order_item_id={$order_id}";

                            $wpdb->query( $query );

                            update_post_meta( $order_id, 'cancel_data', $cancel_data );
                            unset( $_SESSION[ 'cancel_data' ] );

                            $message = st()->load_template( 'user/cancel-booking/success', 'payfast', [ 'cancel_data' => $cancel_data ] );

                            $cancel_order_id    = $order_id;
                            $cancel_cancel_data = $cancel_data;

                            if ( $enable_email_cancel == 'on' ) {
                                $this->_send_email_refund( $order_id, 'has-refund' );
                            }
                            echo json_encode( [
                                'status'  => 1,
                                'message' => $message,
                                'step'    => ''
                            ] );
                            die;
                        }

                    }

                }
                echo json_encode( [
                    'status'  => 1,
                    'message' => '<div class="text-danger">' . __( 'You can not cancel this booking', ST_TEXTDOMAIN ) . '</div>',
                    'step'    => ''

                ] );
                die;
            }

            public function _send_email_refund( $order_id = '', $type = 'success' )
            {

                if ( $type == 'success' ) {
                    $to       = get_post_meta( $order_id, 'st_email', true );
                    $subject  = __( 'Your cancel booking is completed.', ST_TEXTDOMAIN );
                    $template = st()->get_option( 'email_cancel_booking_success', '' );
                    $message  = do_shortcode( $template );

                } elseif ( $type == 'has-refund' ) {
                    $to      = st()->get_option( 'email_admin_address', '' );
                    $subject = __( 'You have a request for cancel booking.', ST_TEXTDOMAIN );

                    $template = st()->get_option( 'email_has_refund', '' );
                    $message  = do_shortcode( $template );
                }

                $check = $this->_send_mail( $to, $subject, $message );

                return $check;
            }

            public function _send_mail( $to, $subject, $message, $attachment = false )
            {

                if ( !$message ) return [
                    'status'  => false,
                    'data'    => '',
                    'message' => __( "Email content is empty", ST_TEXTDOMAIN )
                ];
                $from         = st()->get_option( 'email_from' );
                $from_address = st()->get_option( 'email_from_address' );
                $headers      = [];

                if ( $from and $from_address ) {
                    $headers[] = 'From:' . $from . ' <' . $from_address . '>';
                }

                add_filter( 'wp_mail_content_type', [ $this, 'set_html_content_type' ] );

                $check = @wp_mail( $to, $subject, $message, $headers, $attachment );

                remove_filter( 'wp_mail_content_type', [ $this, 'set_html_content_type' ] );

                return [
                    'status' => $check,
                    'data'   => [
                        'to'      => $to,
                        'subject' => $subject,
                        'message' => $message,
                        'headers' => $headers
                    ]
                ];
            }

            public function set_html_content_type()
            {

                return 'text/html';
            }

            public static function set_control_data( $data )
            {
                $_SESSION[ 'st_control_data' ] = $data;

            }

            public static function get_control_data()
            {
                $data                          = isset( $_SESSION[ 'st_control_data' ] ) ? $_SESSION[ 'st_control_data' ] : false;
                $_SESSION[ 'st_control_data' ] = false;

                return $data;
            }

            // from 1.2.1
            function _send_email_for_user_partner()
            {
                $name         = STInput::request( 'st_name' );
                $email        = STInput::request( 'st_email' );
                $content      = STInput::request( 'st_content' );
                $user_id      = STInput::request( 'user_id' );
                $user_data    = new WP_User( $user_id );
                $to           = $user_data->user_email;
                $from         = $email;
                $subject      = $name;
                $from_address = $from;
                $headers[]    = 'From:' . $name . ' <' . $from_address . '>';
                $check        = wp_mail( $to, $subject, $content, $headers );
                if ( $check == true ) {
                    $msg = '<div class="alert alert-success">
                            <p class="text-small">' . __( "Your message was sent successfully. Thanks.", ST_TEXTDOMAIN ) . '</p>
                        </div>';
                } else {
                    $msg = '<div class="alert alert-danger">
                            <p class="text-small">' . __( "Failed to send your message.", ST_TEXTDOMAIN ) . '</p>
                        </div>';
                }
                echo json_encode( [
                    'status' => $check,
                    'msg'    => $msg,
                    'data'   => [
                        'to'      => $to,
                        'subject' => $subject,
                        'message' => $content,
                        'headers' => $headers
                    ]
                ] );
                die();
            }

            // disable admin bar only patner
            // from 1.1.9
            function st_is_partner()
            {

                if ( is_user_logged_in() ) {
                    global $current_user;

                    $user_roles = $current_user->roles;
                    $user_role  = array_shift( $user_roles );
                    $return     = '__return_false';
                    // administrtor
                    if ( $user_role == 'administrator' ) return;
                    if ( $user_role == 'partner' ) {
                        $partner_option = st()->get_option( 'admin_menu_partner', 'off' );
                        if ( $partner_option == "on" ) {
                            $return = '__return_true';
                        }
                        add_filter( 'show_admin_bar', $return, 1000 );
                        if ( STInput::post( 'action', '' ) != 'upload-attachment' ) {
                            if ( is_admin() && !st_is_ajax() ) {
                                $page = st()->get_option( 'page_my_account_dashboard' );
                                wp_redirect( get_permalink( $page ) );
                            }
                        }

                    } else {
                        $normal_user_option = st()->get_option( 'admin_menu_normal_user', 'off' );
                        if ( $normal_user_option == 'on' ) {
                            $return = '__return_true';
                        }
                        add_filter( 'show_admin_bar', $return, 1000 );
                    }
                }
            }

            function add_scripts()
            {


            }

            function check_login()
            {
                if ( is_page_template( 'template-user.php' ) ) {
                    if ( !is_user_logged_in() ) {
                        $page_login = st()->get_option( 'page_user_login' );
                        if ( !empty( $page_login ) ) {
                            $url_redirect = ( is_ssl() ? "https" : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            $location     = add_query_arg( [ 'st_url_redirect' => urlencode( $url_redirect ) ], get_permalink( $page_login ) );
                            wp_redirect( $location );
                            exit;
                        } else {
                            wp_redirect( home_url() );
                            exit;
                        }

                    }
                }
                if ( is_page_template( 'template-login.php' ) || is_page_template( 'template-login-normal.php' ) || is_page_template( 'template-register.php' ) || is_page_template( 'template-reset-pasword.php' ) ) {
                    if ( is_user_logged_in() ) {
                        wp_redirect( home_url() );
                        exit;
                    }
                }
            }

            /**
             *  Login form and regedit
             */
            function dlf_auth( $username, $password )
            {

                global $user;
                global $status_error_login;
                $creds                    = [];
                $creds[ 'user_login' ]    = $username;
                $creds[ 'user_password' ] = $password;
                $creds[ 'remember' ]      = true;
                $user                     = wp_signon( $creds, true );
                if ( is_wp_error( $user ) ) {
                    $status_error_login = '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';

                    $status_error_login .= $user->get_error_message();

                    $status_error_login .= ' </div>';
                } else {
                    $page_login   = ( st()->get_option( 'page_redirect_to_after_login' ) );
                    $url_redirect = ( STInput::request( 'st_url_redirect' ) );
                    $url          = ( STInput::request( 'url' ) );
                    $need_link    = home_url();
                    if ( !empty( $page_login ) ) $need_link = get_permalink( $page_login );
                    if ( !empty( $url_redirect ) ) $need_link = urldecode( $url_redirect );
                    if ( !empty( $url ) ) $need_link = get_permalink( $url );
                    $userID = $user->ID;

                    wp_set_current_user( $userID, $user->user_email );
                    wp_set_auth_cookie( $userID, true, false );

                    wp_redirect( $need_link );
                    exit;
                }
            }


            function st_login_func()
            {
                if ( isset( $_POST[ 'dlf_submit' ] ) ) {
                    $this->dlf_auth( $_POST[ 'login_name' ], $_POST[ 'login_password' ] );
                }
            }

            static function validation()
            {
                $user_name = $_REQUEST[ 'user_name' ];
                $password  = $_REQUEST[ 'password' ];
                $email     = $_REQUEST[ 'email' ];

                if ( empty( $user_name ) ) {
                    return new WP_Error( 'field', __( 'Required form field user name is missing', ST_TEXTDOMAIN ) );
                }
                if ( empty( $password ) ) {
                    return new WP_Error( 'field', __( 'Required form field password is missing', ST_TEXTDOMAIN ) );
                }
                if ( empty( $email ) ) {
                    return new WP_Error( 'field', __( 'Required form field email is missing', ST_TEXTDOMAIN ) );
                }
                if ( strlen( $user_name ) < 3 ) {
                    return new WP_Error( 'username_length', __( 'User Name too short. At least 3 characters is required', ST_TEXTDOMAIN ) );
                }
                if ( strlen( $password ) < 6 ) {
                    return new WP_Error( 'password', __( 'Password length must be greater than 6', ST_TEXTDOMAIN ) );
                }
                if ( !is_email( $email ) ) {
                    return new WP_Error( 'email_invalid', __( 'Email is not valid', ST_TEXTDOMAIN ) );
                }
                if ( email_exists( $email ) ) {
                    return new WP_Error( 'email', __( 'Email already used', ST_TEXTDOMAIN ) );
                }
                if ( STInput::request( 'term_condition', '' ) == '' ) {
                    return new WP_Error( 'field', esc_html__( 'The terms and conditions field is required', ST_TEXTDOMAIN ) );
                }
            }


            static function registration_user()
            {
                $userdata = [
                    'user_login' => esc_attr( $_REQUEST[ 'user_name' ] ),
                    'user_email' => esc_attr( $_REQUEST[ 'email' ] ),
                    'user_pass'  => esc_attr( $_REQUEST[ 'password' ] ),
                    'first_name' => esc_attr( $_REQUEST[ 'full_name' ] ),
                ];

                if ( is_wp_error( self::validation() ) ) {
                    echo '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                    echo '<strong>' . self::validation()->get_error_message() . '</strong>';
                    echo '</div>';
                } else {
                    $register_user = wp_insert_user( $userdata );
                    wp_new_user_notification( $register_user, null, 'user' );
                    if ( !is_wp_error( $register_user ) ) {
                        $class_user = new STUser_f();
                        $class_user->_update_info_user( $register_user );

                        return "true";
                    } else {
                        echo '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                        echo '<strong>' . $register_user->get_error_message() . '</strong>';
                        echo '</div>';
                    }
                }

            }

            function _update_certificates()
            {
                $post_type = STInput::request( 'post_type' );
                $id_image  = $url_image = $html_image = "";
                $erro_msg  = "";
                if ( !empty( $_FILES[ 'st_certificates_' . $post_type ] ) ) {
                    $id_image = self::upload_image_return( $_FILES[ 'st_certificates_' . $post_type ], 'st_certificates_' . $post_type, $_FILES[ 'st_certificates_' . $post_type ][ 'type' ], 1 );
                    if ( is_array( $id_image ) ) {
                        $erro_msg = $id_image[ 'msg' ];
                    } else {
                        $data = wp_get_attachment_image_src( $id_image, 'full' );
                    }
                    if ( !empty( $data[ 0 ] ) ) {
                        $url_image  = $data[ 0 ];
                        $html_image = wp_get_attachment_image( $id_image, 'full', false, [ "class" => 'thumbnail' ] );
                    }
                }

                echo json_encode(
                    [
                        'image_id'   => $id_image,
                        'image_url'  => $url_image,
                        'html_image' => $html_image,
                        'post_type'  => $post_type,
                        'erro_msg'   => $erro_msg
                    ]
                );
                die();
            }

            function _update_certificate_user()
            {

                if ( !empty( $_REQUEST[ 'btn_st_update_certificate' ] ) ) {
                    if ( wp_verify_nonce( $_REQUEST[ 'st_update_certificate' ], 'user_setting' ) ) {

                        $allowedTypes = [ IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF ];

                        global $current_user;
                        wp_get_current_user();
                        $user_id = $current_user->ID;
                        $role    = $current_user->roles;
                        $role    = array_shift( $role );

                        $data_certificates = [];
                        if ( STInput::request( "st_service_st_hotel" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_hotel_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_hotel' ] ) || empty( $_FILES[ 'st_certificates_st_hotel' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for hotel', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_hotel' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file   = self::upload_image_return( $file, 'st_certificates_st_hotel', $file[ 'type' ] );
                                    $url_image = get_post_field( 'guid', $id_file );
                                }


                            } else {
                                $url_image = $_POST[ 'st_certificates_st_hotel_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                             = get_post_type_object( 'st_hotel' );
                                $data_certificates[ "st_hotel" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_rental" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_rental_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_rental' ] ) || empty( $_FILES[ 'st_certificates_st_rental' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for rental', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_rental' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_rental', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_rental_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                              = get_post_type_object( 'st_rental' );
                                $data_certificates[ "st_rental" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_cars" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_cars_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_cars' ] ) || empty( $_FILES[ 'st_certificates_st_cars' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for cars', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_cars' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_cars', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_cars_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                            = get_post_type_object( 'st_cars' );
                                $data_certificates[ "st_cars" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_tours" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_tours_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_tours' ] ) || empty( $_FILES[ 'st_certificates_st_tours' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for tours', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_tours' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_tours', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_tours_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                             = get_post_type_object( 'st_tours' );
                                $data_certificates[ "st_tours" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_activity" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_activity_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_activity' ] ) || empty( $_FILES[ 'st_certificates_st_activity' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for activity', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_activity' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_activity', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_activity_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                                = get_post_type_object( 'st_activity' );
                                $data_certificates[ "st_activity" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }

                        if ( $role == "partner" ) {
                            update_user_meta( $user_id, 'st_pending_partner', '2' );
                        } else {
                            update_user_meta( $user_id, 'st_pending_partner', '1' );
                        }
                        if ( !empty( $data_certificates ) ) {
                            update_user_meta( $user_id, 'st_certificates', $data_certificates );
                            STUser::_resend_send_admin_update_certificate_partner( $user_id );
                        } else {
                            update_user_meta( $user_id, 'st_certificates', "" );
                        }

                        self::$msg = [
                            'status' => 'success',
                            'msg'    => 'Update successfully !'
                        ];

                        return true;
                    }
                }
            }

            static function _update_info_user( $register_user, $echo = true )
            {

                $html        = '';
                $register_as = STInput::request( 'register_as' );
                switch ( $register_as ) {
                    case "normal":
                        $html = '<div  class="alert alert-success"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                        $html .= "<strong>" . __( 'Success!.', ST_TEXTDOMAIN ) . "</strong>" . __( 'Registration successful...', ST_TEXTDOMAIN );
                        $html .= '</div>';
                        STUser::_send_admin_new_register_user( $register_user );
                        break;
                    case "partner":
                        $data_certificates = [];
                        $validate          = true;

                        update_user_meta( $register_user, 'st_pending_partner', '1' );
                        update_user_meta( $register_user, 'st_certificates', $data_certificates );

                        STUser::_send_admin_new_register_partner( $register_user );
                        STUser::_send_customer_register_partner( $register_user );

                        $html = '<div  class="alert alert-success"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                        $html .= "<strong>" . __( 'Success!.', ST_TEXTDOMAIN ) . "</strong>" . __( 'Registration successful! Please wait for administrator\'s approval', ST_TEXTDOMAIN );
                        $html .= '</div>';
                        break;
                }
                if ( $echo )
                    echo $html;
                else return $html;
            }


            //ver 1.2.1
            function update_info_partner()
            {
                global $current_user;
                if ( !empty( $_REQUEST[ 'btn_update_user_partner' ] ) ) {
                    if ( wp_verify_nonce( $_REQUEST[ 'st_update_info_partner' ], 'user_setting' ) ) {

                        $id_user = $current_user->ID;
                        if ( !empty( $_FILES[ 'st_avatar' ][ 'name' ] ) ) {
                            $st_avatar = $_FILES[ 'st_avatar' ];
                            $id_avatar = self::upload_image_return( $st_avatar, 'st_avatar', $st_avatar[ 'type' ] );
                        } else {
                            $id_avatar = STInput::request( "id_avatar" );
                        }
                        if ( !empty( $_FILES[ 'st_banner_image' ][ 'name' ] ) ) {
                            $banner_image    = $_FILES[ 'st_banner_image' ];
                            $id_banner_image = self::upload_image_return( $banner_image, 'st_banner_image', $banner_image[ 'type' ] );
                        } else {
                            $id_banner_image = $_REQUEST[ 'id_banner_image' ];
                        }

                        $userdata = [
                            'ID'           => $id_user,
                            'display_name' => STInput::request( 'st_display_name' ),
                        ];
                        $user_id  = wp_update_user( $userdata );

                        update_user_meta( $id_user, 'st_avatar', $id_avatar );
                        update_user_meta( $id_user, 'st_phone', STInput::request( 'st_phone' ) );
                        update_user_meta( $id_user, 'st_address', STInput::request( 'st_address' ) );
                        update_user_meta( $id_user, 'st_contact_info', STInput::request( 'st_contact_info' ) );
                        update_user_meta( $id_user, 'st_desc', STInput::request( 'st_desc' ) );
                        update_user_meta( $id_user, 'st_banner_image', $id_banner_image );

                        $data_social_icon = [];
                        if ( !empty( $_REQUEST[ 'st_add_social_icon' ] ) ) {
                            $st_add_social_icon = STInput::request( 'st_add_social_icon' );
                            if ( !empty( $st_add_social_icon ) ) {
                                $icon = $st_add_social_icon[ 'icon' ];
                                $link = $st_add_social_icon[ 'link' ];
                                foreach ( $icon as $k => $v ) {
                                    $data_social_icon[] = [
                                        "icon" => $icon[ $k ],
                                        "link" => $link[ $k ],
                                    ];
                                }
                            }
                        }
                        update_user_meta( $id_user, 'st_social', $data_social_icon );

                        $gmap = STInput::request( 'gmap' );
                        if ( !empty( $gmap ) ) {
                            update_user_meta( $id_user, 'map_lat', $gmap[ 'lat' ] );
                            update_user_meta( $id_user, 'map_lng', $gmap[ 'lng' ] );
                            update_user_meta( $id_user, 'map_zoom', $gmap[ 'zoom' ] );
                            update_user_meta( $id_user, 'map_type', $gmap[ 'type' ] );
                        }

                        $data_certificates = [];
                        $validate          = true;
                        $allowedTypes      = [ IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF ];
                        if ( STInput::request( "st_service_st_hotel" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_hotel_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_hotel' ] ) || empty( $_FILES[ 'st_certificates_st_hotel' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for hotel', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_hotel' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file   = self::upload_image_return( $file, 'st_certificates_st_hotel', $file[ 'type' ] );
                                    $url_image = get_post_field( 'guid', $id_file );
                                }


                            } else {
                                $url_image = $_POST[ 'st_certificates_st_hotel_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                             = get_post_type_object( 'st_hotel' );
                                $data_certificates[ "st_hotel" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_rental" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_rental_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_rental' ] ) || empty( $_FILES[ 'st_certificates_st_rental' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for rental', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_rental' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_rental', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_rental_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                              = get_post_type_object( 'st_rental' );
                                $data_certificates[ "st_rental" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_cars" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_cars_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_cars' ] ) || empty( $_FILES[ 'st_certificates_st_cars' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for cars', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_cars' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_cars', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_cars_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                            = get_post_type_object( 'st_cars' );
                                $data_certificates[ "st_cars" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_tours" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_tours_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_tours' ] ) || empty( $_FILES[ 'st_certificates_st_tours' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for tours', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_tours' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_tours', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_tours_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                             = get_post_type_object( 'st_tours' );
                                $data_certificates[ "st_tours" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_activity" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_activity_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_activity' ] ) || empty( $_FILES[ 'st_certificates_st_activity' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for activity', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_activity' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_activity', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_activity_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                                = get_post_type_object( 'st_activity' );
                                $data_certificates[ "st_activity" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( !empty( $data_certificates ) ) {
                            update_user_meta( $user_id, 'st_pending_partner', '2' );
                            update_user_meta( $user_id, 'st_certificates', $data_certificates );
                        } else {
                            update_user_meta( $user_id, 'st_pending_partner', '0' );
                            update_user_meta( $user_id, 'st_certificates', "" );
                        }
                        if ( !$validate ) {
                            return false;
                        }


                        if ( is_wp_error( $user_id ) ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            wp_redirect( add_query_arg( [ 'sc' => "update-info-partner", "status" => "danger" ], get_the_permalink( $page_my_account_dashboard ) ) );
                            exit();
                        } else {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            wp_redirect( add_query_arg( [ 'sc' => "update-info-partner", "status" => "success" ], get_the_permalink( $page_my_account_dashboard ) ) );
                            exit();
                        }

                    }
                }

            }

            /* Function update meta user */
            function update_user()
            {
                global $current_user;
                if ( !empty( $_REQUEST[ 'st_btn_update' ] ) ) {

                    if ( wp_verify_nonce( $_REQUEST[ 'st_update_user' ], 'user_setting' ) ) {
                        $id_user = $current_user->ID;
                        if ( !empty( $_FILES[ 'st_avatar' ][ 'name' ] ) ) {
                            $st_avatar = $_FILES[ 'st_avatar' ];
                            $id_avatar = self::upload_image_return( $st_avatar, 'st_avatar', $st_avatar[ 'type' ] );
                        } else {
                            $id_avatar = STInput::request( "id_avatar" );
                        }

                        update_user_meta( $id_user, 'st_avatar', $id_avatar );
                        update_user_meta( $id_user, 'st_phone', $_REQUEST[ 'st_phone' ] );
                        update_user_meta( $id_user, 'st_airport', $_REQUEST[ 'st_airport' ] );
                        update_user_meta( $id_user, 'st_address', $_REQUEST[ 'st_address' ] );
                        update_user_meta( $id_user, 'st_city', $_REQUEST[ 'st_city' ] );
                        update_user_meta( $id_user, 'st_province', $_REQUEST[ 'st_province' ] );
                        update_user_meta( $id_user, 'st_zip_code', $_REQUEST[ 'st_zip_code' ] );
                        update_user_meta( $id_user, 'st_country', $_REQUEST[ 'st_country' ] );
                        update_user_meta( $id_user, 'nickname', $_REQUEST[ 'st_name' ] );
                        update_user_meta( $id_user, 'st_paypal_email', $_REQUEST[ 'st_paypal_email' ] );
                        $is_check = '';
                        if ( !empty( $_REQUEST[ 'st_is_check_show_info' ] ) ) {
                            $is_check = 'on';
                        }
                        update_user_meta( $id_user, 'st_is_check_show_info', $is_check );


                        $userdata = [
                            'ID'           => $id_user,
                            'display_name' => esc_attr( $_REQUEST[ 'st_name' ] ),
                            'user_email'   => $_REQUEST[ 'st_email' ],
                        ];
                        $user_id  = wp_update_user( $userdata );
                        if ( is_wp_error( $user_id ) ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            wp_redirect( add_query_arg( [ 'sc' => "setting", "status" => "danger" ], get_the_permalink( $page_my_account_dashboard ) ) );
                            exit();
                        } else {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            wp_redirect( add_query_arg( [ 'sc' => "setting", "status" => "success" ], get_the_permalink( $page_my_account_dashboard ) ) );
                            exit();
                        }

                    } else {
                        print 'Sorry, your nonce did not verify.';
                        exit;
                    }

                }
            }

            /* Function update meta user */
            function update_pass()
            {
                if ( !empty( $_REQUEST[ 'btn_update_pass' ] ) ) {
                    $old_pass       = $_REQUEST[ 'old_pass' ];
                    $new_pass       = $_REQUEST[ 'new_pass' ];
                    $new_pass_again = $_REQUEST[ 'new_pass_again' ];
                    $user_login     = $_REQUEST[ 'user_login' ];
                    $user           = get_user_by( 'login', $user_login );
                    if ( $user && wp_check_password( $old_pass, $user->data->user_pass, $user->ID ) ) {
                        if ( $new_pass == $new_pass_again && $new_pass != "" ) {
                            $userdata = [
                                'ID'        => $user->ID,
                                'user_pass' => $new_pass,
                            ];
                            wp_update_user( $userdata );
                            //wp_set_password( $new_pass, $user->ID );
                            self::$msg = [
                                'status' => 'success',
                                'msg'    => __( 'Change password successfully !', ST_TEXTDOMAIN )
                            ];
                        } else {
                            self::$msg = [
                                'status' => 'danger',
                                'msg'    => __( 'New password does not match!', ST_TEXTDOMAIN )
                            ];
                        }
                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => __( 'Current password incorrect!', ST_TEXTDOMAIN )
                        ];
                    }
                }
            }

            function st_add_wishlist_func()
            {
                $data_id   = $_REQUEST[ 'data_id' ];
                $data_type = $_REQUEST[ 'data_type' ];

                $current_user = wp_get_current_user();
                $data_list    = get_user_meta( $current_user->ID, 'st_wishlist', true );
                $data_list    = json_decode( $data_list );
                $date         = new DateTime();
                $date         = mysql2date( 'M d, Y', $date->format( 'Y-m-d' ) );

                $tmp_data = [];
                if ( $data_list != '' and is_array( $data_list ) ) {
                    $check = true;
                    $i     = 0;
                    foreach ( $data_list as $k => $v ) {
                        if ( $v->id == $data_id and $v->type == $data_type ) {
                            $check = false;
                        } else {
                            array_unshift( $tmp_data, $data_list[ $i ] );
                        }
                        $i++;
                    }
                    if ( $check == true ) {
                        array_unshift( $tmp_data, [
                                'id'   => $data_id,
                                'type' => $data_type,
                                'date' => $date
                            ]
                        );
                        echo json_encode( [
                            'status' => 'true',
                            'msg'    => 'ID :' . $data_id,
                            'icon'   => '<i class="fa fa-heart"></i>',
                            'title'  => st_get_language( 'remove_to_wishlist' )
                        ] );
                    } else {
                        echo json_encode( [
                            'status' => 'true',
                            'msg'    => 'ID :' . $data_id,
                            'icon'   => '<i class="fa fa-heart-o"></i>',
                            'title'  => st_get_language( 'add_to_wishlist' )
                        ] );
                    }
                    update_user_meta( $current_user->ID, 'st_wishlist', json_encode( $tmp_data ) );
                } else {
                    $user_meta = [
                        [
                            'id'   => $data_id,
                            'type' => $data_type,
                            'date' => $date
                        ],
                    ];
                    update_user_meta( $current_user->ID, 'st_wishlist', json_encode( $user_meta ) );
                    echo json_encode( [
                        'status' => 'true',
                        'msg'    => 'ID :' . $data_id,
                        'icon'   => '<i class="fa fa-heart"></i>'
                    ] );
                }
                die();
            }

            function st_remove_wishlist_func()
            {
                $data_id   = $_REQUEST[ 'data_id' ];
                $data_type = $_REQUEST[ 'data_type' ];

                $current_user = wp_get_current_user();
                $data_list    = get_user_meta( $current_user->ID, 'st_wishlist', true );
                $data_list    = json_decode( $data_list );
                $tmp_data     = [];
                if ( $data_list != '' and is_array( $data_list ) ) {
                    $i = 0;
                    foreach ( $data_list as $k => $v ) {
                        if ( $v->id == $data_id and $v->type == $data_type ) {
                        } else {
                            array_push( $tmp_data, $data_list[ $i ] );
                        }
                        $i++;
                    }
                    update_user_meta( $current_user->ID, 'st_wishlist', json_encode( $tmp_data ) );
                    echo json_encode( [
                        'status'  => 'true',
                        'msg'     => $data_id,
                        'type'    => 'success',
                        'content' => __( 'Delete successfully', ST_TEXTDOMAIN )
                    ] );
                } else {
                    echo json_encode( [
                        'status'  => 'false',
                        'msg'     => $data_id,
                        'type'    => 'danger',
                        'content' => __( 'Delete not successfully', ST_TEXTDOMAIN )
                    ] );
                }

                die();
            }

            function st_load_more_wishlist_func()
            {
                $data_per     = $_REQUEST[ 'data_per' ];
                $data_next    = $_REQUEST[ 'data_next' ];
                $data_html    = '';
                $current_user = wp_get_current_user();
                $data_list    = get_user_meta( $current_user->ID, 'st_wishlist', true );
                $i_check      = 0;
                if ( $data_list != '[]' or $data_list != '' ):
                    $data_list = json_decode( $data_list );
                    $i         = 0;
                    foreach ( $data_list as $k => $v ):
                        if ( $i >= $data_per and $i < $data_next + $data_per ):
                            $args = [
                                'post_type' => $v->type,
                                'post__in'  => [ $v->id ],
                            ];
                            query_posts( $args );
                            $data_html .= st()->load_template( 'user/loop/loop', 'wishlist', get_object_vars( $data_list[ $i ] ) );
                            $i_check++;
                            wp_reset_query();
                        endif;
                        $i++;
                    endforeach;
                endif;

                $status = 'true';
                if ( $i_check < $data_next ) {
                    $status = 'false';
                }
                echo json_encode( [
                    'status'   => $status,
                    'msg'      => $data_html,
                    'data_per' => $data_next + $data_per
                ] );
                die();
            }

            function upload_image()
            {
                if (
                    isset( $_POST[ 'my_image_upload_nonce' ], $_POST[ 'post_id' ] )
                    && wp_verify_nonce( $_POST[ 'my_image_upload_nonce' ], 'my_image_upload' )
                    && current_user_can( 'edit_post', $_POST[ 'post_id' ] )
                ) {
                    $f_type = $_FILES[ 'my_image_upload' ][ 'type' ];
                    if ( $f_type == "image/gif" OR $f_type == "image/png" OR $f_type == "image/jpeg" OR $f_type == "image/JPEG" OR $f_type == "image/PNG" OR $f_type == "image/GIF" ) {
                        // The nonce was valid and the user has the capabilities, it is safe to continue.

                        // These files need to be included as dependencies when on the front end.
                        require_once( ABSPATH . 'wp-admin/includes/image.php' );
                        require_once( ABSPATH . 'wp-admin/includes/file.php' );
                        require_once( ABSPATH . 'wp-admin/includes/media.php' );

                        // Let WordPress handle the upload.
                        // Remember, 'my_image_upload' is the name of our file input in our form above.
                        $attachment_id = media_handle_upload( 'my_image_upload', '' );

                        if ( is_wp_error( $attachment_id ) ) {
                            // There was an error uploading the image.
                        } else {
                            // The image was uploaded successfully!
                            self::$msg = [
                                'status' => 'success',
                                'msg'    => 'Uploaded successfully !'
                            ];
                        }
                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => 'Uploaded not successfully !'
                        ];
                    }
                } else {
                    // The security check failed, maybe show the user an error.
                }
            }

            function upload_image_return( $file, $flied_name, $type_file, $lever_erro = 0 )
            {
                $f_type    = $type_file;
                $size_file = $file[ "size" ];
                if ( $f_type == "image/gif" OR $f_type == "image/png" OR $f_type == "image/jpeg" OR $f_type == "image/JPEG" OR $f_type == "image/PNG" OR $f_type == "image/GIF" ) {
                    if ( $size_file < ( 1024 * 1024 * 2 ) ) {
                        // The nonce was valid and the user has the capabilities, it is safe to continue.

                        // These files need to be included as dependencies when on the front end.
                        require_once( ABSPATH . 'wp-admin/includes/image.php' );
                        require_once( ABSPATH . 'wp-admin/includes/file.php' );
                        require_once( ABSPATH . 'wp-admin/includes/media.php' );

                        // Let WordPress handle the upload.
                        // Remember, 'my_image_upload' is the name of our file input in our form above.
                        $attachment_id = media_handle_upload( $flied_name, '' );

                        if ( is_wp_error( $attachment_id ) ) {
                            return $attachment_id;
                            // There was an error uploading the image.
                        } else {
                            // The image was uploaded successfully!
                            return $attachment_id;
                        }
                    } else {
                        if ( $lever_erro > 0 ) {
                            return [ 'msg' => 'Maximum upload file size: 2 MB' ];
                        }
                    }
                } else {

                    if ( $lever_erro > 0 ) {
                        return [ 'msg' => 'This does not appear to be a image file !' ];
                    }

                }
            }

            function st_remove_post_type_func()
            {
                $data_id      = $_REQUEST[ 'data_id' ];
                $data_id_user = $_REQUEST[ 'data_id_user' ];
                $data_post    = get_post( $data_id );
                if ( $data_post->post_author == $data_id_user ) {
                    wp_delete_post( $data_id );
                    echo json_encode( [
                        'status'  => 'true',
                        'msg'     => $data_id,
                        'type'    => 'success',
                        'content' => 'Delete successfully'
                    ] );
                } else {
                    echo json_encode( [
                        'status'  => 'false',
                        'msg'     => $data_id,
                        'type'    => 'danger',
                        'content' => 'Delete not successfully'
                    ] );
                }
                die();
            }

            static function get_list_layout()
            {
                $arg  = [
                    'post_type'   => 'st_layouts',
                    'numberposts' => -1
                ];
                $list = query_posts( $arg );
                $txt  = '<select name="st_custom_layout" class="form-control">';
                while ( have_posts() ) {
                    the_post();
                    $txt .= '<option value="' . get_the_ID() . '">' . get_the_title() . '</option>';
                }
                $txt .= ' </select>';
                wp_reset_query();

                return $txt;
            }

            static function get_list_taxonomy( $tax = 'category', $array = [] )
            {

                $args       = [
                    'hide_empty' => 0
                ];
                $taxonomies = get_terms( $tax, $args );

                $r = [];

                if ( !is_wp_error( $taxonomies ) ) {
                    foreach ( $taxonomies as $key => $value ) {
                        # code...
                        $r[ $value->term_id ] = $value->name;

                    }
                }

                return $r;
            }


            static function get_list_value_taxonomy( $post_type )
            {
                $data_value = [];

                $taxonomy = get_object_taxonomies( $post_type, 'object' );
                foreach ( $taxonomy as $key => $value ) {
                    if ( $key != 'st_category_cars' ) {
                        if ( $key != 'st_cars_pickup_features' ) {
                            if ( $key != 'cabin_type' ) {
                                if ( $key != 'room_type' ) {
                                    $args      = [
                                        'hide_empty' => 0
                                    ];
                                    $data_term = get_terms( $key, $args );
                                    if ( !empty( $data_term ) ) {
                                        foreach ( $data_term as $k => $v ) {
                                            $icon = get_tax_meta( $v->term_id, 'st_icon' );
                                            $icon = TravelHelper::handle_icon( $icon );
                                            array_push(
                                                $data_value, [
                                                    'value'    => $v->term_id,
                                                    'label'    => $v->name,
                                                    'taxonomy' => $v->taxonomy,
                                                    'icon'     => $icon
                                                ]
                                            );
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                return $data_value;
            }

            static function get_msg()
            {
                if ( !empty( STUser_f::$msg ) ) {
                    return '<div class="alert alert-' . STUser_f::$msg[ 'status' ] . '">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">' . STUser_f::$msg[ 'msg' ] . '</p>
                      </div>';
                }
                $status = STInput::request( 'create' );
                if ( !empty( $status ) and $status == 'true' ) {
                    return '<div class="alert alert-success">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">' . __( "Create successfully !", ST_TEXTDOMAIN ) . '</p>
                      </div>';
                }

                return '';
            }

            static function get_msg_html( $msg, $status )
            {
                if ( !empty( $msg ) ) {
                    $msg = str_ireplace( "<p>", "", $msg );
                    $msg = str_ireplace( "</p>", "", $msg );

                    return '<div class="alert alert-' . $status . '">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">' . $msg . '</p>
                      </div>';
                }

                return '';

            }

            static function get_status_msg()
            {
                if ( !empty( STUser_f::$msg ) ) {
                    return STUser_f::$msg[ 'status' ];
                }

                return '';
            }

            static function _update_content_meta_box( $id )
            {
                $my_post = get_post( $id );
                wp_update_post( $my_post );;
            }

            function validate_hotel()
            {

                if ( !st_check_service_available( 'st_hotel' ) ) {
                    return;
                }

                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'logo' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $logo_image            = $_FILES[ 'logo' ];
                    $id_logo_image         = self::upload_image_return( $logo_image, 'logo', $logo_image[ 'type' ] );
                    $_REQUEST[ 'id_logo' ] = $id_logo_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;
                /// Location ///
                $validator->set_rules( 'st_title', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'st_content', __( "Content", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'st_desc', __( "Description", ST_TEXTDOMAIN ), 'required' );
                $id_featured_image = STInput::request( 'id_featured_image' );
                if ( empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND empty( $id_featured_image ) ) {
                    $validator->set_error_message( 'featured_image', __( "The Featured Image field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' ) ) {
                    $validator->set_error_message( 'gallery', __( "The Gallery field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'logo' ][ 'name' ] ) AND !STInput::request( 'id_logo' ) ) {
                    $validator->set_error_message( 'logo', __( "The Logo field is required.", ST_TEXTDOMAIN ) );
                }
                $validator->set_rules( 'address', __( "Address", ST_TEXTDOMAIN ), 'required|max_length[100]' );
                $validator->set_rules( 'gmap[zoom]', __( "Zoom", ST_TEXTDOMAIN ), 'required|numeric' );


                $validator->set_rules( 'card_accepted[]', __( "Card Accepted", ST_TEXTDOMAIN ), 'required' );

                $validator->set_rules( 'phone', __( "Phone", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'video', __( "Video", ST_TEXTDOMAIN ), 'valid_url' );
                $validator->set_rules( 'email', __( "Email", ST_TEXTDOMAIN ), 'required|valid_email' );
                $validator->set_rules( 'website', __( "Website", ST_TEXTDOMAIN ), 'valid_url' );
                $validator->set_rules( 'hotel_star', __( "Star Rating", ST_TEXTDOMAIN ), 'required|numeric' );

                $validator->set_rules( 'hotel_booking_period', __( "Booking Period", ST_TEXTDOMAIN ), 'required|unsigned_integer' );

                // /is_featured
                $admin_packages   = STAdminPackages::get_inst();
                $num_set_featured = $admin_packages->count_item_can_featured( get_current_user_id(), STInput::get( 'id', '' ) );
                if ( $admin_packages->enabled_membership() ) {
                    if ( $admin_packages->get_user_role() == 'partner' && ( $num_set_featured !== 'unlimited' && $num_set_featured <= 0 ) && STInput::request( 'is_featured', 'off' ) == 'on' ) {
                        STTemplate::set_message( sprintf( __( "You cannot set featured for this hotel. Your remaining item is %s (items)", ST_TEXTDOMAIN ), $num_set_featured ), 'warning' );

                        return false;
                    }
                }


                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );

                    return false;
                }

                return true;
            }

            /* Update Hotel */
            function st_update_post_type_hotel()
            {
                if ( !st_check_service_available( 'st_hotel' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_post_hotel', '' ), 'user_setting' ) ) {

                    if ( self::validate_hotel() == false ) {
                        return;
                    }

                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_hotel' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }

                        $current_user = wp_get_current_user();

                        $my_post = [
                            'post_title'   => 'Title',
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'st_hotel',
                            'post_excerpt' => ''
                        ];
                        $post_id = wp_insert_post( $my_post );
                    }

                    if ( !empty( $_REQUEST[ 'btn_update_post_type_hotel' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }

                    if ( !empty( $post_id ) ) {

                        $my_post = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' ),
                            'post_content' => STInput::request( 'st_content' ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );
                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );
                        /////////////////////////////////////
                        /// Update featured
                        /////////////////////////////////////
                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );
                        /////////////////////////////////////
                        /// Update logo
                        /////////////////////////////////////


                        $logo = (int)STInput::request( 'id_logo', '' );
                        update_post_meta( $post_id, 'logo', $logo );


                        /////////////////////////////////////
                        /// Update gallery
                        /////////////////////////////////////
                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        /////////////////////////////////////
                        /// Update Metabox
                        /////////////////////////////////////
                        //tab hotel details
                        update_post_meta( $post_id, 'email', STInput::request( 'email' ) );
                        update_post_meta( $post_id, 'website', STInput::request( 'website' ) );
                        update_post_meta( $post_id, 'phone', STInput::request( 'phone' ) );
                        update_post_meta( $post_id, 'fax', STInput::request( 'fax' ) );;
                        update_post_meta( $post_id, 'show_agent_contact_info', STInput::request( 'show_agent_contact_info' ) );
                        update_post_meta( $post_id, 'video', STInput::request( 'video' ) );
                        update_post_meta( $post_id, 'hotel_star', STInput::request( 'hotel_star' ) );
                        update_post_meta( $post_id, 'st_custom_layout', STInput::request( 'st_custom_layout' ) );
                        update_post_meta( $post_id, 'is_featured', STInput::request( 'is_featured' ) );

                        update_post_meta( $post_id, 'card_accepted', STInput::request( 'card_accepted' ) );

                        update_post_meta( $post_id, 'allow_full_day', STInput::request( 'allow_full_day', 'off' ) );
                        update_post_meta( $post_id, 'check_in_time', STInput::request( 'check_in_time', '' ) );
                        update_post_meta( $post_id, 'check_out_time', STInput::request( 'check_out_time', '' ) );
                        //tab price
                        update_post_meta( $post_id, 'is_auto_caculate', STInput::request( 'is_auto_caculate' ) );
                        update_post_meta( $post_id, 'price_avg', STInput::request( 'price_avg' ) );
                        update_post_meta( $post_id, 'min_price', STInput::request( 'min_price' ) );
                        update_post_meta( $post_id, 'total_sale_number', '1' );
                        update_post_meta( $post_id, 'rate_review', '1' );
                        //tab location
                        if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                            $location = $_REQUEST[ 'multi_location' ];
                            if ( is_array( $location ) && count( $location ) ) {
                                $location_str = '';
                                foreach ( $location as $item ) {
                                    if ( empty( $location_str ) ) {
                                        $location_str .= $item;
                                    } else {
                                        $location_str .= ',' . $item;
                                    }
                                }
                            } else {
                                $location_str = '';
                            }
                            update_post_meta( $post_id, 'multi_location', $location_str );
                            update_post_meta( $post_id, 'id_location', '' );
                        }
                        update_post_meta( $post_id, 'address', STInput::request( 'address' ) );
                        $gmap = STInput::request( 'gmap' );
                        update_post_meta( $post_id, 'map_lat', $gmap[ 'lat' ] );
                        update_post_meta( $post_id, 'map_lng', $gmap[ 'lng' ] );
                        update_post_meta( $post_id, 'map_zoom', $gmap[ 'zoom' ] );
                        update_post_meta( $post_id, 'map_type', $gmap[ 'type' ] );

                        update_post_meta( $post_id, 'st_google_map', $gmap );
                        update_post_meta( $post_id, 'enable_street_views_google_map', STInput::request( 'enable_street_views_google_map' ) );
                        //tab other options
                        update_post_meta( $post_id, 'hotel_booking_period', (int)STInput::request( 'hotel_booking_period' ) );
                        update_post_meta( $post_id, 'min_book_room', (int)STInput::request( 'min_book_room' ) );
                        //tab discount flash

                        if ( !empty( $_REQUEST[ 'policy_title' ] ) and !empty( $_REQUEST[ 'policy_description' ] ) ) {
                            $policy_title       = $_REQUEST[ 'policy_title' ];
                            $policy_description = $_REQUEST[ 'policy_description' ];
                            $array_policy       = [];
                            if ( is_array( $policy_title ) ) {
                                foreach ( $policy_title as $key => $value ) {
                                    $array_policy[ $key ] = [
                                        'title'              => $value,
                                        'policy_description' => stripslashes( $policy_description[ $key ] )
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'hotel_policy', $array_policy );
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = STInput::request( 'taxonomy' );
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }

                        /////////////////////////////////////
                        /// Update Custom Field
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'hotel_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }

                        /**
                         * @since 1.3.1
                         **/
                        /*---- Properties*/
                        $properties = STInput::post( 'property-item', '' );
                        if ( !empty( $properties ) ) {
                            $list = [];
                            for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                    $list[] = [
                                        'title'          => $properties[ 'title' ][ $i ],
                                        'featured_image' => $properties[ 'featured_image' ][ $i ],
                                        'description'    => $properties[ 'description' ][ $i ],
                                        'icon'           => $properties[ 'icon' ][ $i ],
                                        'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                        'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                    ];
                                }

                            }
                            update_post_meta( $post_id, 'properties_near_by', $list );
                        }

                        $class_hotel = new STAdminHotel();
                        $class_hotel->_update_avg_price( $post_id );
                        self::$msg = [
                            'status' => 'success',
                            'msg'    => 'Updated hotel successfully !'
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-hotel', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }

                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => 'Error : Update hotel not successfully !'
                        ];
                    }
                }
            }

            function validate_hotel_room()
            {

                if ( !st_check_service_available( 'hotel_room' ) ) {
                    return;
                }

                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

            $validator=self::$validator;
            /// Location ///
            $validator->set_rules('st_title',__("Title",ST_TEXTDOMAIN),'required|min_length[6]|max_length[100]');
            $validator->set_rules('st_content',__("Content",ST_TEXTDOMAIN),'required');
            $validator->set_rules('st_desc',__("Description",ST_TEXTDOMAIN),'required');
            $id_featured_image = STInput::request('id_featured_image');
            if(empty($_FILES[ 'featured-image' ]['name']) AND empty($id_featured_image)){
                $validator->set_error_message('featured_image',__("The Featured Image field is required.",ST_TEXTDOMAIN));
            }
            if(empty($_FILES[ 'gallery' ]['name'][0]) AND !STInput::request('id_gallery')){
                $validator->set_error_message('gallery',__("The Gallery field is required.",ST_TEXTDOMAIN));
            }
            $validator->set_rules('number_room',__("Number of Room",ST_TEXTDOMAIN),'required|unsigned_integer');
            $validator->set_rules('price',__("Price Per Night",ST_TEXTDOMAIN),'required|unsigned_integer');
            
            
            $validator->set_rules('discount_rate',__("Discount Rate",ST_TEXTDOMAIN),'unsigned_integer');
            if(STInput::request('is_sale_schedule') == 'on'){
                $validator->set_rules('sale_price_from',__("Sale Start Date",ST_TEXTDOMAIN),'required');
                $validator->set_rules('sale_price_to',__("Sale End Date",ST_TEXTDOMAIN),'required');
            }
            if(STInput::request('deposit_payment_status') != ''){
                $validator->set_rules('deposit_payment_amount',__("Deposit Amount",ST_TEXTDOMAIN),'required|unsigned_integer');
                $deposit_payment_status = STInput::request('deposit_payment_status');
                $deposit_payment_amount = STInput::request('deposit_payment_amount');
                $partner_commission = st()->get_option('partner_commission','0');
                if($deposit_payment_status == "percent"){
                    if( $deposit_payment_amount <= $partner_commission){
                        $validator->set_error_message('deposit_payment_amount',__("The commission does not match the criteria.",ST_TEXTDOMAIN));
                    }
                }
            }
            $validator->set_rules('adult_number',__("Adults Number",ST_TEXTDOMAIN),'required|unsigned_integer|greater_than[0]');
            $validator->set_rules('children_number',__("Children Number",ST_TEXTDOMAIN),'required|unsigned_integer');
            $validator->set_rules('bed_number',__("Beds Number",ST_TEXTDOMAIN),'required|unsigned_integer|greater_than[0]');
            $validator->set_rules('room_footage',__("Room footage",ST_TEXTDOMAIN),'required|unsigned_integer|greater_than[0]');
            if(STInput::request('st_room_external_booking') == 'on'){
                $validator->set_rules('st_room_external_booking_link',__("External Booking URL",ST_TEXTDOMAIN),'required|valid_url');
            }

                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );


                    return false;
                }

                return true;
            }

            /* Update Room */
            function st_update_post_type_room()
            {
                if ( !st_check_service_available( 'st_hotel' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_room', '' ), 'user_setting' ) ) {
                    if ( self::validate_hotel_room() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_room' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();
                        $st_content   = STInput::request( 'st_content' );
                        $my_post      = [
                            'post_title'   => 'Title',
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'hotel_room',
                            'post_excerpt' => '',
                        ];
                        $post_id      = wp_insert_post( $my_post );
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_room' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }
                    if ( !empty( $post_id ) ) {
                        $st_content = STInput::request( 'st_content' );
                        $my_post    = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' ),
                            'post_content' => stripslashes( $st_content ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );

                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }


                        wp_update_post( $my_post );

                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );

                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        /////////////////////////////////////
                        /// Update Metabox
                        /////////////////////////////////////
                        //tab location
                        if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                            $location = $_REQUEST[ 'multi_location' ];
                            if ( is_array( $location ) && count( $location ) ) {
                                $location_str = '';
                                foreach ( $location as $item ) {
                                    if ( empty( $location_str ) ) {
                                        $location_str .= $item;
                                    } else {
                                        $location_str .= ',' . $item;
                                    }
                                }
                            } else {
                                $location_str = '';
                            }
                            update_post_meta( $post_id, 'multi_location', $location_str );
                            update_post_meta( $post_id, 'id_location', '' );
                        }
                        update_post_meta( $post_id, 'address', STInput::request( 'address' ) );
                        //tab general
                        update_post_meta( $post_id, 'room_parent', STInput::request( 'room_parent' ) );
                        update_post_meta( $post_id, 'number_room', STInput::request( 'number_room' ) );
                        update_post_meta( $post_id, 'st_custom_layout', STInput::request( 'st_custom_layout' ) );
                        //tab general
                        update_post_meta( $post_id, 'allow_full_day', STInput::request( 'allow_full_day', 'off' ) );
                        update_post_meta( $post_id, 'price', STInput::request( 'price' ) );
                        update_post_meta( $post_id, 'discount_rate', STInput::request( 'discount_rate' ) );
                        update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );
                        update_post_meta( $post_id, 'sale_price_from', STInput::request( 'sale_price_from' ) );
                        update_post_meta( $post_id, 'sale_price_to', STInput::request( 'sale_price_to' ) );
                        update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                        update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );
                        update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                        update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                        update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );
                        //tab room facility
                        update_post_meta( $post_id, 'default_state', STInput::request( 'default_state' ) );

                        update_post_meta( $post_id, 'adult_number', STInput::request( 'adult_number' ) );
                        update_post_meta( $post_id, 'children_number', STInput::request( 'children_number' ) );
                        update_post_meta( $post_id, 'bed_number', STInput::request( 'bed_number' ) );
                        update_post_meta( $post_id, 'room_footage', STInput::request( 'room_footage' ) );
                        update_post_meta( $post_id, 'room_description', stripslashes( STInput::request( 'room_description' ) ) );
                        update_post_meta( $post_id, 'st_room_external_booking', STInput::request( 'st_room_external_booking' ) );
                        update_post_meta( $post_id, 'st_room_external_booking_link', STInput::request( 'st_room_external_booking_link' ) );
                        //tab other facility
                        $add_new_facility_title = STInput::request( 'add_new_facility_title' );
                        $add_new_facility_value = STInput::request( 'add_new_facility_value' );
                        $add_new_facility_icon  = STInput::request( 'add_new_facility_icon' );
                        if ( !empty( $add_new_facility_title ) ) {
                            $data = [];
                            foreach ( $add_new_facility_title as $k => $v ) {
                                $data[] = [ 'title' => $v, 'facility_value' => $add_new_facility_value[ $k ], 'facility_icon' => $add_new_facility_icon[ $k ] ];
                            }
                            update_post_meta( $post_id, 'add_new_facility', $data );
                        }

                        /////////////////////////////////////
                        /// Update Payment
                        /////////////////////////////////////
                        $data_paypment = STPaymentGateways::$_payment_gateways;
                        if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                            foreach ( $data_paypment as $k => $v ) {
                                update_post_meta( $post_id, 'is_meta_payment_gateway_' . $k, STInput::request( 'is_meta_payment_gateway_' . $k ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = STInput::request( 'taxonomy' );
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }
                        /////////////////////////////////////
                        /// Update Custom Price
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'st_price' ] ) ) {
                            $price_new  = STInput::request( 'st_price' );
                            $price_type = STInput::request( 'st_price_type' );
                            $start_date = STInput::request( 'st_start_date' );
                            $end_date   = STInput::request( 'st_end_date' );
                            $status     = STInput::request( 'st_status' );
                            $priority   = STInput::request( 'st_priority' );
                            STAdmin::st_delete_price( $post_id );
                            if ( $price_new and $start_date and $end_date ) {
                                foreach ( $price_new as $k => $v ) {
                                    if ( !empty( $v ) ) {
                                        STAdmin::st_add_price( $post_id, $price_type[ $k ], $v, $start_date[ $k ], $end_date[ $k ], $status[ $k ], $priority[ $k ] );
                                    }
                                }
                            }
                        }
                        // Update extra
                        $extra = STInput::request( 'extra', '' );
                        if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                            $list_extras = [];
                            foreach ( $extra[ 'title' ] as $key => $val ) {
                                if ( !empty( $val ) ) {
                                    $list_extras[ $key ] = [
                                        'title'            => $val,
                                        'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                        'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                        'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'extra_price', $list_extras );
                        } else {
                            update_post_meta( $post_id, 'extra_price', '' );
                        }

                        $class_room = new STAdminRoom();
                        $class_room->_update_avg_price( $post_id );
                        self::$msg = [
                            'status' => 'success',
                            'msg'    => 'Update Room successfully !'
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-room', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }
                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => 'Error : Update Room not successfully !'
                        ];
                    }
                }
            }

            function validate_tour()
            {

                if ( !st_check_service_available( 'st_tours' ) ) {
                    return;
                }
                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;
                $validator->set_rules( 'st_title', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'st_content', __( "Content", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'st_desc', __( "Description", ST_TEXTDOMAIN ), 'required' );
                if ( empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND !STInput::request( 'id_featured_image' ) ) {
                    $validator->set_error_message( 'featured_image', __( "The Featured Image field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' ) ) {
                    $validator->set_error_message( 'gallery', __( "The Gallery field is required.", ST_TEXTDOMAIN ) );
                }

                $validator->set_rules( 'address', __( "Address", ST_TEXTDOMAIN ), 'required|max_length[100]' );

                $validator->set_rules( 'gmap[zoom]', __( "Zoom", ST_TEXTDOMAIN ), 'required|numeric' );

                $validator->set_rules( 'email', __( "Email", ST_TEXTDOMAIN ), 'required|valid_email' );

                if ( STInput::post( 'hide_adult_in_booking_form' ) == 'off' )
                    $validator->set_rules( 'adult_price', __( "Adult Price", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                if ( STInput::post( 'hide_children_in_booking_form' ) == 'off' )
                    $validator->set_rules( 'child_price', __( "Child Price", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                if ( STInput::post( 'hide_infant_in_booking_form' ) == 'off' )
                    $validator->set_rules( 'infant_price', __( "Infant Price", ST_TEXTDOMAIN ), 'required|unsigned_integer' );


                $validator->set_rules( 'discount', __( "Discount", ST_TEXTDOMAIN ), 'unsigned_integer' );
                if ( STInput::request( 'is_sale_schedule' ) == 'on' ) {
                    $validator->set_rules( 'sale_price_from', __( "Sale Start Date", ST_TEXTDOMAIN ), 'required' );
                    $validator->set_rules( 'sale_price_to', __( "Sale End Date", ST_TEXTDOMAIN ), 'required' );
                }
                if ( STInput::request( 'deposit_payment_status' ) != '' ) {
                    $validator->set_rules( 'deposit_payment_amount', __( "Deposit Amount", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                }


                $validator->set_rules('discount',__("Discount",ST_TEXTDOMAIN),'unsigned_integer');
                if(STInput::request('is_sale_schedule') == 'on'){
                    $validator->set_rules('sale_price_from',__("Sale Start Date",ST_TEXTDOMAIN),'required');
                    $validator->set_rules('sale_price_to',__("Sale End Date",ST_TEXTDOMAIN),'required');
                }
                if(STInput::request('deposit_payment_status') != ''){
                    $validator->set_rules('deposit_payment_amount',__("Deposit Amount",ST_TEXTDOMAIN),'required|unsigned_integer');
                    $deposit_payment_status = STInput::request('deposit_payment_status');
                    $deposit_payment_amount = STInput::request('deposit_payment_amount');
                    $partner_commission = st()->get_option('partner_commission','0');
                    if($deposit_payment_status == "percent"){
                        if( $deposit_payment_amount <= $partner_commission){
                            $validator->set_error_message('deposit_payment_amount',__("The commission does not match the criteria.",ST_TEXTDOMAIN));
                        }
                    }
                }

                if ( STInput::request( 'tour_type' ) == 'specific_date' ) {
                } else {
                    $validator->set_rules( 'duration', __( "Duration", ST_TEXTDOMAIN ), 'required' );
                }
                $validator->set_rules( 'tours_booking_period', __( "Booking Period", ST_TEXTDOMAIN ), 'unsigned_integer' );
                $validator->set_rules( 'min_people', __( "Min No. People", ST_TEXTDOMAIN ), 'required|greater_than[0]' );
                if ( STInput::request( 'st_tour_external_booking' ) == 'on' ) {
                    $validator->set_rules( 'st_tour_external_booking_link', __( "External Booking URL", ST_TEXTDOMAIN ), 'required|valid_url' );
                }


                // /is_featured
                $admin_packages   = STAdminPackages::get_inst();
                $num_set_featured = $admin_packages->count_item_can_featured( get_current_user_id(), STInput::get( 'id', '' ) );
                if ( $admin_packages->enabled_membership() ) {
                    if ( $admin_packages->get_user_role() == 'partner' && ( $num_set_featured !== 'unlimited' && $num_set_featured <= 0 ) && STInput::request( 'is_featured', 'off' ) == 'on' ) {
                        STTemplate::set_message( sprintf( __( "You cannot set featured for this car. Your remaining item is %s (items)", ST_TEXTDOMAIN ), $num_set_featured ), 'warning' );

                        return false;
                    }
                }

                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );

                    return false;
                }

                return true;
            }

            /* Update Tours */
            function st_update_post_type_tours()
            {
                if ( !st_check_service_available( 'st_tours' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_post_tours', '' ), 'user_setting' ) ) {
                    if ( self::validate_tour() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_tours' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();

                        $my_post = [
                            'post_title'   => 'Title',
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'st_tours',
                            'post_excerpt' => '',
                        ];
                        $post_id = wp_insert_post( $my_post );
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_tours' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }
                    if ( !empty( $post_id ) ) {
                        $my_post = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' ),
                            'post_content' => STInput::request( 'st_content' ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }
                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );
                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );

                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );

                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        //tab location
                        if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                            $location = $_REQUEST[ 'multi_location' ];
                            if ( is_array( $location ) && count( $location ) ) {
                                $location_str = '';
                                foreach ( $location as $item ) {
                                    if ( empty( $location_str ) ) {
                                        $location_str .= $item;
                                    } else {
                                        $location_str .= ',' . $item;
                                    }
                                }
                            } else {
                                $location_str = '';
                            }
                            update_post_meta( $post_id, 'multi_location', $location_str );
                            update_post_meta( $post_id, 'id_location', '' );
                        }
                        update_post_meta( $post_id, 'address', STInput::request( 'address' ) );
                        $gmap = STInput::request( 'gmap' );
                        update_post_meta( $post_id, 'map_lat', $gmap[ 'lat' ] );
                        update_post_meta( $post_id, 'map_lng', $gmap[ 'lng' ] );
                        update_post_meta( $post_id, 'map_zoom', $gmap[ 'zoom' ] );
                        update_post_meta( $post_id, 'map_type', $gmap[ 'type' ] );

                        update_post_meta( $post_id, 'st_google_map', $gmap );
                        update_post_meta( $post_id, 'enable_street_views_google_map', STInput::request( 'enable_street_views_google_map' ) );
                        //tab general
                        update_post_meta( $post_id, 'st_custom_layout', STInput::request( 'st_custom_layout' ) );
                        update_post_meta( $post_id, 'is_featured', STInput::request( 'is_featured' ) );
                        update_post_meta( $post_id, 'contact_email', STInput::request( 'email' ) );
                        update_post_meta( $post_id, 'website', STInput::request( 'website' ) );
                        update_post_meta( $post_id, 'phone', STInput::request( 'phone' ) );
                        update_post_meta( $post_id, 'fax', STInput::request( 'fax' ) );;
                        update_post_meta( $post_id, 'show_agent_contact_info', STInput::request( 'show_agent_contact_info' ) );

                        update_post_meta( $post_id, 'video', STInput::request( 'video' ) );
                        update_post_meta( $post_id, 'gallery_style', STInput::request( 'gallery_style' ) );
                        //tab price
                        update_post_meta( $post_id, 'type_price', 'people_price' );
                        // update_post_meta( $post_id , 'price' , STInput::request( 'price' ) );
                        update_post_meta( $post_id, 'adult_price', STInput::request( 'adult_price' ) );
                        update_post_meta( $post_id, 'child_price', STInput::request( 'child_price' ) );
                        update_post_meta( $post_id, 'infant_price', STInput::request( 'infant_price' ) );
                        update_post_meta( $post_id, 'discount', (int)STInput::request( 'discount' ) );
                        update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );
                        update_post_meta( $post_id, 'sale_price_from', STInput::request( 'sale_price_from' ) );
                        update_post_meta( $post_id, 'sale_price_to', STInput::request( 'sale_price_to' ) );
                        update_post_meta( $post_id, 'hide_adult_in_booking_form', STInput::request( 'hide_adult_in_booking_form' ) );
                        update_post_meta( $post_id, 'hide_children_in_booking_form', STInput::request( 'hide_children_in_booking_form' ) );
                        update_post_meta( $post_id, 'hide_infant_in_booking_form', STInput::request( 'hide_infant_in_booking_form' ) );
                        update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                        update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                        update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );
                        update_post_meta( $post_id, 'discount_by_people_type', STInput::request( 'discount_by_people_type' ) );
                        update_post_meta( $post_id, 'discount_type', STInput::request( 'discount_type' ) );

                        $discount_by_adult_title = STInput::request( 'discount_by_adult_title' );
                        if ( !empty( $discount_by_adult_title ) ) {
                            $discount_by_adult_value  = $_REQUEST[ 'discount_by_adult_value' ];
                            $discount_by_adult_key    = $_REQUEST[ 'discount_by_adult_key' ];
                            $discount_by_adult_key_to = $_REQUEST[ 'discount_by_adult_key_to' ];
                            $data                     = [];
                            foreach ( $discount_by_adult_title as $k => $v ) {
                                if ( !empty( $v ) ) {
                                    array_push( $data, [
                                        'title'  => $v,
                                        'value'  => $discount_by_adult_value[ $k ],
                                        'key'    => $discount_by_adult_key[ $k ],
                                        'key_to' => $discount_by_adult_key_to[ $k ],
                                    ] );
                                }

                            }
                            update_post_meta( $post_id, 'discount_by_adult', $data );
                        } else {
                            update_post_meta( $post_id, 'discount_by_adult', [] );
                        }

                        $discount_by_child_title = STInput::request( 'discount_by_child_title' );
                        if ( !empty( $discount_by_child_title ) ) {
                            $discount_by_child_value  = $_REQUEST[ 'discount_by_child_value' ];
                            $discount_by_child_key    = $_REQUEST[ 'discount_by_child_key' ];
                            $discount_by_child_key_to = $_REQUEST[ 'discount_by_child_key_to' ];
                            $data                     = [];
                            foreach ( $discount_by_child_title as $k => $v ) {
                                if ( !empty( $v ) ) {
                                    array_push( $data, [
                                        'title'  => $v,
                                        'value'  => $discount_by_child_value[ $k ],
                                        'key'    => $discount_by_child_key[ $k ],
                                        'key_to' => $discount_by_child_key_to[ $k ],
                                    ] );
                                }
                            }

                            update_post_meta( $post_id, 'discount_by_child', $data );
                        } else {
                            update_post_meta( $post_id, 'discount_by_child', [] );
                        }
                        update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                        update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );
                        //tab info
                        update_post_meta( $post_id, 'type_tour', STInput::request( 'tour_type' ) );
                        update_post_meta( $post_id, 'check_in', STInput::request( 'check_in' ) );
                        update_post_meta( $post_id, 'check_out', STInput::request( 'check_out' ) );
                        update_post_meta( $post_id, 'duration_day', STInput::request( 'duration' ) );
                        //update_post_meta( $post_id , 'duration_unit' , STInput::request( 'duration_unit' ) );
                        update_post_meta( $post_id, 'max_people', STInput::request( 'max_people' ) );
                        update_post_meta( $post_id, 'min_people', STInput::request( 'min_people' ) );
                        update_post_meta( $post_id, 'tours_booking_period', (int)STInput::request( 'tours_booking_period' ) );
                        update_post_meta( $post_id, 'st_tour_external_booking', STInput::request( 'st_tour_external_booking' ) );
                        update_post_meta( $post_id, 'st_tour_external_booking_link', STInput::request( 'st_tour_external_booking_link' ) );
                        if ( !empty( $_REQUEST[ 'program_title' ] ) ) {
                            $program_title = $_REQUEST[ 'program_title' ];
                            $program_desc  = $_REQUEST[ 'program_desc' ];
                            $program       = [];
                            if ( !empty( $program_title ) ) {
                                foreach ( $program_title as $k => $v ) {
                                    array_push( $program, [
                                        'title' => $v,
                                        'desc'  => $program_desc[ $k ]
                                    ] );
                                }
                            }
                            update_post_meta( $post_id, 'tours_program', $program );
                        }
                        /////////////////////////////////////
                        /// Update Payment
                        /////////////////////////////////////
                        $data_paypment = STPaymentGateways::$_payment_gateways;
                        if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                            foreach ( $data_paypment as $k => $v ) {
                                update_post_meta( $post_id, 'is_meta_payment_gateway_' . $k, STInput::request( 'is_meta_payment_gateway_' . $k ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update custom field
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'tours_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = $_REQUEST[ 'taxonomy' ];
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }

                        /**
                         * @since 1.3.1
                         **/
                        /*---- Properties*/
                        $properties = STInput::post( 'property-item', '' );
                        if ( !empty( $properties ) ) {
                            $list = [];
                            for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                    $list[] = [
                                        'title'          => $properties[ 'title' ][ $i ],
                                        'featured_image' => $properties[ 'featured_image' ][ $i ],
                                        'description'    => $properties[ 'description' ][ $i ],
                                        'icon'           => $properties[ 'icon' ][ $i ],
                                        'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                        'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                    ];
                                }

                            }
                            update_post_meta( $post_id, 'properties_near_by', $list );
                        }

                        // Update extra
                        $extra = STInput::request( 'extra', '' );
                        if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                            $list_extras = [];
                            foreach ( $extra[ 'title' ] as $key => $val ) {
                                if ( !empty( $val ) ) {
                                    $list_extras[ $key ] = [
                                        'title'            => $val,
                                        'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                        'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                        'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'extra_price', $list_extras );
                        } else {
                            update_post_meta( $post_id, 'extra_price', '' );
                        }
                        self::$msg = [
                            'status' => 'success',
                            'msg'    => 'Update tours successfully !'
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-tours', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }

                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => 'Error : Update tours not successfully !'
                        ];
                    }
                }
            }

            function validate_activity()
            {

                if(!st_check_service_available( 'st_activity' )) {
                    return;
                }

                if(!empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner') {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image , 'featured-image' , $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if(!empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner') {
                    $gallery = $_FILES[ 'gallery' ];
                    if(!empty( $gallery )) {
                        $tmp_array = [];
                        for( $i = 0 ; $i < count( $gallery[ 'name' ] ) ; $i++ ) {
                            array_push( $tmp_array , [
                                'name'     => $gallery[ 'name' ][ $i ] ,
                                'type'     => $gallery[ 'type' ][ $i ] ,
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ] ,
                                'error'    => $gallery[ 'error' ][ $i ] ,
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery .= self::upload_image_return( $_FILES[ 'gallery' ] , 'gallery' , $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery , 0 , -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;

                $validator->set_rules( 'st_title' , __( "Title" , ST_TEXTDOMAIN ) , 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'st_content' , __( "Content" , ST_TEXTDOMAIN ) , 'required' );
                $validator->set_rules( 'st_desc' , __( "Description" , ST_TEXTDOMAIN ) , 'required' );
                $id_featured_image = STInput::request( 'id_featured_image' );
                if(empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND empty( $id_featured_image )) {
                    $validator->set_error_message( 'featured_image' , __( "The Featured Image field is required." , ST_TEXTDOMAIN ) );
                }
                if(empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' )) {
                    $validator->set_error_message( 'gallery' , __( "The Gallery field is required." , ST_TEXTDOMAIN ) );
                }
                $validator->set_rules( 'address' , __( "Address" , ST_TEXTDOMAIN ) , 'required|max_length[100]' );
                $validator->set_rules( 'gmap[zoom]' , __( "Zoom" , ST_TEXTDOMAIN ) , 'required|numeric' );


                $validator->set_rules( 'email' , __( "Email" , ST_TEXTDOMAIN ) , 'required|valid_email' );
                $validator->set_rules( 'phone' , __( "Phone" , ST_TEXTDOMAIN ) , 'required' );
                $validator->set_rules( 'website' , __( "Website" , ST_TEXTDOMAIN ) , 'valid_url' );
                $validator->set_rules( 'video' , __( "Video" , ST_TEXTDOMAIN ) , 'valid_url' );

                if(STInput::request( 'type_activity' ) == 'specific_date') {

                } else {
                    $validator->set_rules( 'duration' , __( "Duration" , ST_TEXTDOMAIN ) , 'required' );
                }
                $validator->set_rules( 'activity-time' , __( "Activity time" , ST_TEXTDOMAIN ) , 'required' );
                $validator->set_rules( 'activity_booking_period' , __( "Booking Period" , ST_TEXTDOMAIN ) , 'unsigned_integer' );
                $validator->set_rules( 'venue-facilities' , __( "Venue facilities" , ST_TEXTDOMAIN ) , 'required' );

                if(STInput::post( 'hide_adult_in_booking_form' ) == 'off')
                    $validator->set_rules( 'adult_price' , __( "Adult Price" , ST_TEXTDOMAIN ) , 'required|unsigned_integer' );
                if(STInput::post( 'hide_children_in_booking_form' ) == 'off')
                    $validator->set_rules( 'child_price' , __( "Child Price" , ST_TEXTDOMAIN ) , 'required|unsigned_integer' );
                if(STInput::post( 'hide_infant_in_booking_form' ) == 'off')
                    $validator->set_rules( 'infant_price' , __( "Infant Price" , ST_TEXTDOMAIN ) , 'required|unsigned_integer' );

                $validator->set_rules( 'discount' , __( "Discount" , ST_TEXTDOMAIN ) , 'unsigned_integer' );
                if(STInput::request( 'is_sale_schedule' ) == 'on') {
                    $validator->set_rules( 'sale_price_from' , __( "Sale Start Date" , ST_TEXTDOMAIN ) , 'required' );
                    $validator->set_rules( 'sale_price_to' , __( "Sale End Date" , ST_TEXTDOMAIN ) , 'required' );
                }
                if(STInput::request( 'st_activity_external_booking' ) == 'on') {
                    $validator->set_rules( 'st_activity_external_booking_link' , __( "External Booking URL" , ST_TEXTDOMAIN ) , 'required|valid_url' );
                }
                if(STInput::request( 'deposit_payment_status' ) != '') {
                    $validator->set_rules( 'deposit_payment_amount' , __( "Deposit Amount" , ST_TEXTDOMAIN ) , 'required|unsigned_integer' );
                }
                if(STInput::request( 'best-price-guarantee' ) == 'on') {
                    $validator->set_rules( 'best-price-guarantee-text' , __( "Best Price Guarantee Text" , ST_TEXTDOMAIN ) , 'required' );
                }
                // /is_featured
                $admin_packages   = STAdminPackages::get_inst();
                $num_set_featured = $admin_packages->count_item_can_featured( get_current_user_id() , STInput::get( 'id' , '' ) );
                if($admin_packages->enabled_membership()) {
                    if($admin_packages->get_user_role() == 'partner' && ( $num_set_featured !== 'unlimited' && $num_set_featured <= 0 ) && STInput::request( 'is_featured' , 'off' ) == 'on') {
                        STTemplate::set_message( sprintf( __( "You cannot set featured for this activity. Your remaining item is %s (items)" , ST_TEXTDOMAIN ) , $num_set_featured ) , 'warning' );

                        return false;
                    }
                }

                if(STInput::request( 'type_activity' ) == 'specific_date') {

                } else {
                    $validator->set_rules( 'duration' , __( "Duration" , ST_TEXTDOMAIN ) , 'required' );
                }
                $validator->set_rules( 'activity-time' , __( "Activity time" , ST_TEXTDOMAIN ) , 'required' );
                $validator->set_rules( 'activity_booking_period' , __( "Booking Period" , ST_TEXTDOMAIN ) , 'unsigned_integer' );
                $validator->set_rules( 'venue-facilities' , __( "Venue facilities" , ST_TEXTDOMAIN ) , 'required' );

                if(STInput::post( 'hide_adult_in_booking_form' ) == 'off')
                    $validator->set_rules( 'adult_price' , __( "Adult Price" , ST_TEXTDOMAIN ) , 'required|unsigned_integer' );
                if(STInput::post( 'hide_children_in_booking_form' ) == 'off')
                    $validator->set_rules( 'child_price' , __( "Child Price" , ST_TEXTDOMAIN ) , 'required|unsigned_integer' );
                if(STInput::post( 'hide_infant_in_booking_form' ) == 'off')
                    $validator->set_rules( 'infant_price' , __( "Infant Price" , ST_TEXTDOMAIN ) , 'required|unsigned_integer' );

                $validator->set_rules( 'discount' , __( "Discount" , ST_TEXTDOMAIN ) , 'unsigned_integer' );
                if(STInput::request( 'is_sale_schedule' ) == 'on') {
                    $validator->set_rules( 'sale_price_from' , __( "Sale Start Date" , ST_TEXTDOMAIN ) , 'required' );
                    $validator->set_rules( 'sale_price_to' , __( "Sale End Date" , ST_TEXTDOMAIN ) , 'required' );
                }
                if(STInput::request( 'st_activity_external_booking' ) == 'on') {
                    $validator->set_rules( 'st_activity_external_booking_link' , __( "External Booking URL" , ST_TEXTDOMAIN ) , 'required|valid_url' );
                }
                if(STInput::request( 'deposit_payment_status' ) != '') {
                    $validator->set_rules( 'deposit_payment_amount' , __( "Deposit Amount" , ST_TEXTDOMAIN ) , 'required|unsigned_integer' );
                    $deposit_payment_status = STInput::request( 'deposit_payment_status' );
                    $deposit_payment_amount = STInput::request( 'deposit_payment_amount' );
                    $partner_commission     = st()->get_option( 'partner_commission' , '0' );
                    if($deposit_payment_status == "percent") {
                        if($deposit_payment_amount <= $partner_commission) {
                            $validator->set_error_message( 'deposit_payment_amount' , __( "The commission does not match the criteria." , ST_TEXTDOMAIN ) );
                        }
                    }
                }
                if(STInput::request( 'best-price-guarantee' ) == 'on') {
                    $validator->set_rules( 'best-price-guarantee-text' , __( "Best Price Guarantee Text" , ST_TEXTDOMAIN ) , 'required' );
                }
                // /is_featured
                $admin_packages = STAdminPackages::get_inst();
                $num_set_featured = $admin_packages->count_item_can_featured(get_current_user_id(), STInput::get('id',''));
                if($admin_packages->enabled_membership()){
                    if($admin_packages->get_user_role() == 'partner' &&  ($num_set_featured !== 'unlimited' && $num_set_featured <= 0) && STInput::request('is_featured','off') == 'on'){
                        STTemplate::set_message(sprintf(__("You cannot set featured for this activity. Your remaining item is %s (items)",ST_TEXTDOMAIN), $num_set_featured),'warning');
                        return false;
                    }
                }

                $result=$validator->run();
                if(!$result){
                    STTemplate::set_message(__("Warning: Some fields must be filled in",ST_TEXTDOMAIN),'warning');
                    return false;
                }
                return true;
            }

            /* Update Activity */
            function st_update_post_type_activity()
            {
                if ( !st_check_service_available( 'st_activity' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_post_activity', '' ), 'user_setting' ) ) {
                    if ( self::validate_activity() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_activity' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();

                        $my_post = [
                            'post_title'   => 'Title',
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'st_activity',
                            'post_excerpt' => '',
                        ];
                        $post_id = wp_insert_post( $my_post );
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_activity' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }

                    if ( !empty( $post_id ) ) {
                        $st_content = STInput::request( 'st_content' );
                        $my_post    = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' ),
                            'post_content' => stripslashes( $st_content ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );

                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );
                        /////////////////////////////////////
                        /// Update featured
                        /////////////////////////////////////
                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );

                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        /////////////////////////////////////
                        /// Update Meta Box
                        /////////////////////////////////////
                        //tab location
                        if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                            $location = $_REQUEST[ 'multi_location' ];
                            if ( is_array( $location ) && count( $location ) ) {
                                $location_str = '';
                                foreach ( $location as $item ) {
                                    if ( empty( $location_str ) ) {
                                        $location_str .= $item;
                                    } else {
                                        $location_str .= ',' . $item;
                                    }
                                }
                            } else {
                                $location_str = '';
                            }
                            update_post_meta( $post_id, 'multi_location', $location_str );
                            update_post_meta( $post_id, 'id_location', '' );
                        }
                        update_post_meta( $post_id, 'address', STInput::request( 'address' ) );
                        $gmap = STInput::request( 'gmap' );
                        update_post_meta( $post_id, 'map_lat', $gmap[ 'lat' ] );
                        update_post_meta( $post_id, 'map_lng', $gmap[ 'lng' ] );
                        update_post_meta( $post_id, 'map_zoom', $gmap[ 'zoom' ] );
                        update_post_meta( $post_id, 'map_type', $gmap[ 'type' ] );

                        update_post_meta( $post_id, 'st_google_map', $gmap );
                        update_post_meta( $post_id, 'enable_street_views_google_map', STInput::request( 'enable_street_views_google_map' ) );
                        //tab general
                        update_post_meta( $post_id, 'st_custom_layout', STInput::request( 'st_custom_layout' ) );
                        update_post_meta( $post_id, 'is_featured', STInput::request( 'is_featured' ) );
                        update_post_meta( $post_id, 'contact_email', STInput::request( 'email' ) );
                        update_post_meta( $post_id, 'contact_web', STInput::request( 'website' ) );
                        update_post_meta( $post_id, 'contact_phone', STInput::request( 'phone' ) );
                        update_post_meta( $post_id, 'contact_fax', STInput::request( 'contact_fax' ) );;
                        update_post_meta( $post_id, 'show_agent_contact_info', STInput::request( 'show_agent_contact_info' ) );
                        update_post_meta( $post_id, 'video', STInput::request( 'video' ) );
                        update_post_meta( $post_id, 'gallery_style', STInput::request( 'gallery_style' ) );
                        update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                        update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                        update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );
                        update_post_meta( $post_id, 'discount_by_people_type', STInput::request( 'discount_by_people_type' ) );
                        update_post_meta( $post_id, 'discount_type', STInput::request( 'discount_type' ) );
                        //tab info
                        update_post_meta( $post_id, 'type_activity', STInput::request( 'type_activity' ) );

                        update_post_meta( $post_id, 'activity-time', STInput::request( 'activity-time' ) );
                        update_post_meta( $post_id, 'duration', STInput::request( 'duration' ) );
                        update_post_meta( $post_id, 'venue-facilities', stripslashes( STInput::request( 'venue-facilities' ) ) );
                        update_post_meta( $post_id, 'activity_booking_period', (int)STInput::request( 'activity_booking_period' ) );
                        update_post_meta( $post_id, 'max_people', STInput::request( 'max_people' ) );
                        //tab price settings
                        update_post_meta( $post_id, 'type_price', 'people_price' );

                        update_post_meta( $post_id, 'adult_price', STInput::request( 'adult_price' ) );
                        update_post_meta( $post_id, 'child_price', STInput::request( 'child_price' ) );
                        update_post_meta( $post_id, 'infant_price', STInput::request( 'infant_price' ) );
                        update_post_meta( $post_id, 'discount', (int)STInput::request( 'discount' ) );
                        update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );
                        update_post_meta( $post_id, 'sale_price_from', STInput::request( 'sale_price_from' ) );
                        update_post_meta( $post_id, 'sale_price_to', STInput::request( 'sale_price_to' ) );
                        update_post_meta( $post_id, 'st_activity_external_booking', STInput::request( 'st_activity_external_booking' ) );
                        update_post_meta( $post_id, 'st_activity_external_booking_link', STInput::request( 'st_activity_external_booking_link' ) );
                        update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                        update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );
                        update_post_meta( $post_id, 'best-price-guarantee', STInput::request( 'best-price-guarantee' ) );
                        update_post_meta( $post_id, 'best-price-guarantee-text', STInput::request( 'best-price-guarantee-text' ) );
                        update_post_meta( $post_id, 'hide_adult_in_booking_form', STInput::request( 'hide_adult_in_booking_form' ) );
                        update_post_meta( $post_id, 'hide_children_in_booking_form', STInput::request( 'hide_children_in_booking_form' ) );
                        update_post_meta( $post_id, 'hide_infant_in_booking_form', STInput::request( 'hide_infant_in_booking_form' ) );

                        $discount_by_adult_title = STInput::request( 'discount_by_adult_title' );
                        if ( !empty( $discount_by_adult_title ) ) {
                            $discount_by_adult_value = $_REQUEST[ 'discount_by_adult_value' ];
                            $discount_by_adult_key   = $_REQUEST[ 'discount_by_adult_key' ];
                            $data                    = [];
                            foreach ( $discount_by_adult_title as $k => $v ) {
                                if ( !empty( $v ) ) {
                                    array_push( $data, [
                                        'title' => $v,
                                        'value' => $discount_by_adult_value[ $k ],
                                        'key'   => $discount_by_adult_key[ $k ],
                                    ] );
                                }

                            }
                            update_post_meta( $post_id, 'discount_by_adult', $data );
                        } else {
                            update_post_meta( $post_id, 'discount_by_adult', [] );
                        }

                        $discount_by_child_title = STInput::request( 'discount_by_child_title' );
                        if ( !empty( $discount_by_child_title ) ) {
                            $discount_by_child_value = STInput::request( 'discount_by_child_value' );
                            $discount_by_child_key   = STInput::request( 'discount_by_child_key' );
                            $data                    = [];
                            foreach ( $discount_by_child_title as $k => $v ) {
                                if ( !empty( $v ) ) {
                                    array_push( $data, [
                                        'title' => $v,
                                        'value' => $discount_by_child_value[ $k ],
                                        'key'   => $discount_by_child_key[ $k ],
                                    ] );
                                }
                            }

                            update_post_meta( $post_id, 'discount_by_child', $data );
                        } else {
                            update_post_meta( $post_id, 'discount_by_child', [] );
                        }
                        /////////////////////////////////////
                        /// Update Payment
                        /////////////////////////////////////
                        $data_paypment = STPaymentGateways::$_payment_gateways;
                        if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                            foreach ( $data_paypment as $k => $v ) {
                                update_post_meta( $post_id, 'is_meta_payment_gateway_' . $k, STInput::request( 'is_meta_payment_gateway_' . $k ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update custom flied
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'st_activity_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = $_REQUEST[ 'taxonomy' ];
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }

                        /**
                         * @since 1.3.1
                         **/
                        /*---- Properties*/
                        $properties = STInput::post( 'property-item', '' );
                        if ( !empty( $properties ) ) {
                            $list = [];
                            for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                    $list[] = [
                                        'title'          => $properties[ 'title' ][ $i ],
                                        'featured_image' => $properties[ 'featured_image' ][ $i ],
                                        'description'    => $properties[ 'description' ][ $i ],
                                        'icon'           => $properties[ 'icon' ][ $i ],
                                        'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                        'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                    ];
                                }

                            }
                            update_post_meta( $post_id, 'properties_near_by', $list );
                        }


                        // Update extra
                        $extra = STInput::request( 'extra', '' );
                        if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                            $list_extras = [];
                            foreach ( $extra[ 'title' ] as $key => $val ) {
                                if ( !empty( $val ) ) {
                                    $list_extras[ $key ] = [
                                        'title'            => $val,
                                        'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                        'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                        'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'extra_price', $list_extras );
                        } else {
                            update_post_meta( $post_id, 'extra_price', '' );
                        }
                        self::$msg = [
                            'status' => 'success',
                            'msg'    => __( 'Update activity successful!', ST_TEXTDOMAIN )
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-activity', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }

                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => __( 'Error : Update activity not successful!', ST_TEXTDOMAIN )
                        ];
                    }
                }
            }

            function validate_car()
            {

                if ( !st_check_service_available( 'st_cars' ) ) {
                    return;
                }
                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'logo' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $logo_image            = $_FILES[ 'logo' ];
                    $id_logo_image         = self::upload_image_return( $logo_image, 'logo', $logo_image[ 'type' ] );
                    $_REQUEST[ 'id_logo' ] = $id_logo_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;
                $validator->set_rules( 'st_title_car', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );

                $validator->set_rules( 'st_desc', __( "Description", ST_TEXTDOMAIN ), 'required' );
                if ( empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND !STInput::request( 'id_featured_image' ) ) {
                    $validator->set_error_message( 'featured_image', __( "The Featured Image field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' ) ) {
                    $validator->set_error_message( 'gallery', __( "The Gallery field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'logo' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_logo' ) ) {
                    $validator->set_error_message( 'logo', __( "The Logo field is required.", ST_TEXTDOMAIN ) );
                }

                $validator->set_rules( 'address', __( "Address", ST_TEXTDOMAIN ), 'required|max_length[100]' );

                $validator->set_rules( 'gmap[zoom]', __( "Zoom", ST_TEXTDOMAIN ), 'required|numeric' );

                $validator->set_rules( 'email', __( "Email", ST_TEXTDOMAIN ), 'required|valid_email' );
                $validator->set_rules( 'st_name', __( "Car Manufacturer Name", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'phone', __( "Phone", ST_TEXTDOMAIN ), 'required' );

                $validator->set_rules( 'about', __( "About", ST_TEXTDOMAIN ), 'required' );

                $validator->set_rules('price',__("Price",ST_TEXTDOMAIN),'required|unsigned_integer');
                $validator->set_rules('discount',__("Discount",ST_TEXTDOMAIN),'unsigned_integer');
                $validator->set_rules('number_car',__("Number of cars for Rent",ST_TEXTDOMAIN),'required|unsigned_integer');
                if(STInput::request('is_sale_schedule') == 'on'){
                    $validator->set_rules('sale_price_from',__("Sale Start Date",ST_TEXTDOMAIN),'required');
                    $validator->set_rules('sale_price_to',__("Sale End Date",ST_TEXTDOMAIN),'required');
                }
                if(STInput::request('deposit_payment_status') != ''){
                    $validator->set_rules('deposit_payment_amount',__("Deposit Amount",ST_TEXTDOMAIN),'required|unsigned_integer');
                    $deposit_payment_status = STInput::request('deposit_payment_status');
                    $deposit_payment_amount = STInput::request('deposit_payment_amount');
                    $partner_commission = st()->get_option('partner_commission','0');
                    if($deposit_payment_status == "percent"){
                        if( $deposit_payment_amount <= $partner_commission){
                            $validator->set_error_message('deposit_payment_amount',__("The commission does not match the criteria.",ST_TEXTDOMAIN));
                        }
                    }
                }
                $validator->set_rules('cars_booking_period',__("Booking Period",ST_TEXTDOMAIN),'unsigned_integer');
                if(STInput::request('st_car_external_booking') == 'on'){
                    $validator->set_rules('st_car_external_booking_link',__("External Booking URL",ST_TEXTDOMAIN),'required|valid_url');
                }

                // /is_featured
                $admin_packages   = STAdminPackages::get_inst();
                $num_set_featured = $admin_packages->count_item_can_featured( get_current_user_id(), STInput::get( 'id', '' ) );
                if ( $admin_packages->enabled_membership() ) {
                    if ( $admin_packages->get_user_role() == 'partner' && ( $num_set_featured !== 'unlimited' && $num_set_featured <= 0 ) && STInput::request( 'is_featured', 'off' ) == 'on' ) {
                        STTemplate::set_message( sprintf( __( "You cannot set featured for this car. Your remaining item is %s (items)", ST_TEXTDOMAIN ), $num_set_featured ), 'warning' );
                        return false;
                    }
                }
                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );
                    return false;
                }
                return true;
            }

            /* Update Cars */
            function st_update_post_type_cars()
            {
                if ( !st_check_service_available( 'st_cars' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_post_cars', '' ), 'user_setting' ) ) {
                    if ( self::validate_car() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_cars' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();

                        $my_post = [
                            'post_title'   => 'Title',
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'st_cars',
                            'post_excerpt' => '',
                        ];
                        $post_id = wp_insert_post( $my_post );
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_cars' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }
                    if ( !empty( $post_id ) ) {
                        $my_post = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title_car' ),
                            'post_content' => "",
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );

                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );
                        /////////////////////////////////////
                        /// Update featured
                        /////////////////////////////////////
                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );
                        /////////////////////////////////////
                        /// Update logo
                        /////////////////////////////////////


                        $logo = (int)STInput::request( 'id_logo', '' );
                        update_post_meta( $post_id, 'logo', $logo );


                        /////////////////////////////////////
                        /// Update gallery
                        /////////////////////////////////////
                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        /////////////////////////////////////
                        /// Update Meta
                        /////////////////////////////////////
                        if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                            $location = STInput::request( 'multi_location' );
                            if ( is_array( $location ) && count( $location ) ) {
                                $location_str = '';
                                foreach ( $location as $item ) {
                                    if ( empty( $location_str ) ) {
                                        $location_str .= $item;
                                    } else {
                                        $location_str .= ',' . $item;
                                    }
                                }
                            } else {
                                $location_str = '';
                            }
                            update_post_meta( $post_id, 'multi_location', $location_str );
                            update_post_meta( $post_id, 'id_location', '' );
                        }
                        update_post_meta( $post_id, 'location_type', STInput::request( 'location_type', 'multi_location' ) );

                        update_post_meta( $post_id, 'is_featured', STInput::request( 'is_featured' ) );
                        update_post_meta( $post_id, 'cars_name', STInput::request( 'st_name' ) );
                        update_post_meta( $post_id, 'st_custom_layout', STInput::request( 'st_custom_layout' ) );
                        update_post_meta( $post_id, 'gallery_style', STInput::request( 'gallery_style' ) );
                        update_post_meta( $post_id, 'cars_email', STInput::request( 'email' ) );
                        update_post_meta( $post_id, 'cars_phone', STInput::request( 'phone' ) );
                        update_post_meta( $post_id, 'cars_fax', STInput::request( 'cars_fax' ) );
                        update_post_meta( $post_id, 'show_agent_contact_info', STInput::request( 'show_agent_contact_info' ) );

                        update_post_meta( $post_id, 'cars_website', STInput::request( 'cars_website' ) );
                        update_post_meta( $post_id, 'cars_about', STInput::request( 'about' ) );
                        update_post_meta( $post_id, 'video', STInput::request( 'video' ) );
                        update_post_meta( $post_id, 'cars_address', STInput::request( 'address' ) );
                        update_post_meta( $post_id, 'cars_price', STInput::request( 'price' ) );
                        update_post_meta( $post_id, 'is_custom_price', STInput::request( 'is_custom_price' ) );
                        update_post_meta( $post_id, 'discount', (int)STInput::request( 'discount' ) );
                        update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );
                        update_post_meta( $post_id, 'sale_price_from', STInput::request( 'sale_price_from' ) );
                        update_post_meta( $post_id, 'sale_price_to', STInput::request( 'sale_price_to' ) );
                        update_post_meta( $post_id, 'number_car', STInput::request( 'number_car' ) );
                        update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                        update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );
                        update_post_meta( $post_id, 'cars_booking_period', (int)STInput::request( 'cars_booking_period' ) );
                        update_post_meta( $post_id, 'cars_booking_min_day', (int)STInput::request( 'cars_booking_min_day' ) );
                        update_post_meta( $post_id, 'cars_booking_min_hour', (int)STInput::request( 'cars_booking_min_hour' ) );
                        update_post_meta( $post_id, 'st_car_external_booking', STInput::request( 'st_car_external_booking' ) );
                        update_post_meta( $post_id, 'st_car_external_booking_link', STInput::request( 'st_car_external_booking_link' ) );
                        update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                        update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                        update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );
                        $gmap = STInput::request( 'gmap' );
                        update_post_meta( $post_id, 'map_lat', $gmap[ 'lat' ] );
                        update_post_meta( $post_id, 'map_lng', $gmap[ 'lng' ] );
                        update_post_meta( $post_id, 'map_zoom', $gmap[ 'zoom' ] );
                        update_post_meta( $post_id, 'map_type', $gmap[ 'type' ] );

                        update_post_meta( $post_id, 'st_google_map', $gmap );
                        update_post_meta( $post_id, 'enable_street_views_google_map', STInput::request( 'enable_street_views_google_map' ) );
                        /////////////////////////////////////
                        /// Update Payment
                        /////////////////////////////////////
                        $data_paypment = STPaymentGateways::$_payment_gateways;
                        if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                            foreach ( $data_paypment as $k => $v ) {
                                update_post_meta( $post_id, 'is_meta_payment_gateway_' . $k, STInput::request( 'is_meta_payment_gateway_' . $k ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update Custom Price
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'st_price' ] ) ) {
                            $price_new  = STInput::request( 'st_price' );
                            $price_type = STInput::request( 'st_price_type' );
                            $start_date = STInput::request( 'st_start_date' );
                            $end_date   = STInput::request( 'st_end_date' );
                            $status     = STInput::request( 'st_status' );
                            $priority   = STInput::request( 'st_priority' );
                            STAdmin::st_delete_price( $post_id );
                            if ( $price_new and $start_date and $end_date ) {
                                foreach ( $price_new as $k => $v ) {
                                    if ( !empty( $v ) ) {
                                        STAdmin::st_add_price( $post_id, $price_type[ $k ], $v, $start_date[ $k ], $end_date[ $k ], $status[ $k ], $priority[ $k ] );
                                    }
                                }
                            }
                        }
                        if ( !empty( $_REQUEST[ 'st_price_by_number' ] ) ) {
                            $data               = [];
                            $st_number_start    = STInput::request( 'st_number_start' );
                            $st_number_end      = STInput::request( 'st_number_end' );
                            $st_price_by_number = STInput::request( 'st_price_by_number' );
                            $st_title           = STInput::request( 'st_title' );
                            if ( !empty( $st_price_by_number ) ) {
                                foreach ( $st_price_by_number as $k => $v ) {
                                    if ( !empty( $st_title[ $k ] ) ) {
                                        $data[] = [
                                            'title'        => $st_title[ $k ],
                                            'number_start' => $st_number_start[ $k ],
                                            'number_end'   => $st_number_end[ $k ],
                                            'price'        => $v,
                                        ];
                                    }

                                }
                            }
                            update_post_meta( $post_id, 'price_by_number_of_day_hour', $data );
                        }
                        /////////////////////////////////////
                        /// Update equipment item
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'equipment_item_title' ] ) ) {
                            $equipment                  = [];
                            $equipment_item_title       = STInput::request( 'equipment_item_title' );
                            $equipment_item_price       = STInput::request( 'equipment_item_price' );
                            $equipment_item_price_unit  = STInput::request( 'equipment_item_price_unit' );
                            $equipment_item_price_max   = STInput::request( 'equipment_item_price_max' );
                            $cars_equipment_list_number = STInput::request( 'cars_equipment_list_number' );
                            if ( !empty( $equipment_item_title ) ) {
                                foreach ( $equipment_item_title as $k => $v ) {
                                    if ( !empty( $v ) ) {
                                        array_push( $equipment, [
                                            'title'                         => $v,
                                            'cars_equipment_list_price'     => $equipment_item_price[ $k ],
                                            'price_unit'                    => $equipment_item_price_unit[ $k ],
                                            'cars_equipment_list_price_max' => $equipment_item_price_max[ $k ],
                                            'cars_equipment_list_number'    => $cars_equipment_list_number[ $k ],
                                        ] );
                                    }

                                }
                            }
                            update_post_meta( $post_id, 'cars_equipment_list', $equipment );
                        }

                        /////////////////////////////////////
                        /// Update equipment item
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'features_taxonomy' ] ) ) {
                            $features               = [];
                            $features_taxonomy      = STInput::request( 'features_taxonomy' );
                            $features_taxonomy_info = STInput::request( 'taxonomy_info' );
                            if ( !empty( $features_taxonomy ) ) {
                                foreach ( $features_taxonomy as $k => $v ) {
                                    $tmp = explode( ',', $v );
                                    array_push( $features, [
                                        'title'                        => $tmp[ 1 ],
                                        'cars_equipment_taxonomy_id'   => $tmp[ 0 ],
                                        'cars_equipment_taxonomy_info' => $features_taxonomy_info[ $k ]
                                    ] );
                                }
                            }
                            update_post_meta( $post_id, 'cars_equipment_info', $features );
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            $taxonomy = STInput::request( 'taxonomy' );
                            if ( !empty( $taxonomy ) ) {
                                $tax = [];
                                foreach ( $taxonomy as $item ) {
                                    $tmp                = explode( ",", $item );
                                    $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                }
                                foreach ( $tax as $key2 => $val2 ) {
                                    wp_set_post_terms( $post_id, $val2, $key2 );
                                }
                            }
                        }

                        /**
                         * @since 1.3.1
                         **/
                        /*---- Properties*/
                        $properties = STInput::post( 'property-item', '' );
                        if ( !empty( $properties ) ) {
                            $list = [];
                            for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                    $list[] = [
                                        'title'          => $properties[ 'title' ][ $i ],
                                        'featured_image' => $properties[ 'featured_image' ][ $i ],
                                        'description'    => $properties[ 'description' ][ $i ],
                                        'icon'           => $properties[ 'icon' ][ $i ],
                                        'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                        'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                    ];
                                }

                            }
                            update_post_meta( $post_id, 'properties_near_by', $list );
                        }

                        /////////////////////////////////////
                        /// Update Custom field
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'st_cars_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }

                        self::$msg = [
                            'status' => 'success',
                            'msg'    => 'Update car successfully !'
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-cars', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }

                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => 'Error : Update car not successfully !'
                        ];
                    }
                }
            }

            function validate_rental()
            {

                if ( !st_check_service_available( 'st_rental' ) ) {
                    return;
                }

                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;
                /// Location ///
                $validator->set_rules( 'st_title', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'st_content', __( "Content", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'st_desc', __( "Description", ST_TEXTDOMAIN ), 'required' );
                $id_featured_image = STInput::request( 'id_featured_image' );
                if ( empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND empty( $id_featured_image ) ) {
                    $validator->set_error_message( 'featured_image', __( "The Featured Image field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' ) ) {
                    $validator->set_error_message( 'gallery', __( "The Gallery field is required.", ST_TEXTDOMAIN ) );
                }

                $validator->set_rules( 'address', __( "Address", ST_TEXTDOMAIN ), 'required|max_length[100]' );

                $validator->set_rules( 'gmap[zoom]', __( "Zoom", ST_TEXTDOMAIN ), 'required|numeric' );

                $validator->set_rules( 'rental_number', __( "Number", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                $validator->set_rules( 'rental_max_adult', __( "Max of Adult", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                $validator->set_rules( 'rental_max_children', __( "Max of Children", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                $validator->set_rules( 'phone', __( "Phone", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'video', __( "Video", ST_TEXTDOMAIN ), 'valid_url' );
                $validator->set_rules( 'email', __( "Email", ST_TEXTDOMAIN ), 'valid_email' );
                $validator->set_rules( 'website', __( "Website", ST_TEXTDOMAIN ), 'valid_url' );

                $validator->set_rules('price',__("Price",ST_TEXTDOMAIN),'required|unsigned_integer');
                $validator->set_rules('discount',__("Discount",ST_TEXTDOMAIN),'unsigned_integer');
                if(STInput::request('is_sale_schedule') == 'on'){
                    $validator->set_rules('sale_price_from',__("Sale Start Date",ST_TEXTDOMAIN),'required');
                    $validator->set_rules('sale_price_to',__("Sale End Date",ST_TEXTDOMAIN),'required');
                }
                if(STInput::request('deposit_payment_status') != ''){
                    $validator->set_rules('deposit_payment_amount',__("Deposit Amount",ST_TEXTDOMAIN),'required|unsigned_integer');
                    $deposit_payment_status = STInput::request('deposit_payment_status');
                    $deposit_payment_amount = STInput::request('deposit_payment_amount');
                    $partner_commission = st()->get_option('partner_commission','0');
                    if($deposit_payment_status == "percent"){
                        if( $deposit_payment_amount <= $partner_commission){
                            $validator->set_error_message('deposit_payment_amount',__("The commission does not match the criteria.",ST_TEXTDOMAIN));
                        }
                    }
                }
                $validator->set_rules('rentals_booking_period',__("Booking Period",ST_TEXTDOMAIN),'unsigned_integer');
                $validator->set_rules('rentals_booking_min_day',__("Minimum day",ST_TEXTDOMAIN),'unsigned_integer');

                if ( STInput::request( 'st_rental_external_booking' ) == 'on' ) {
                    $validator->set_rules( 'st_rental_external_booking_link', __( "External Booking URL", ST_TEXTDOMAIN ), 'required|valid_url' );
                }
                // /is_featured
                $admin_packages   = STAdminPackages::get_inst();
                $num_set_featured = $admin_packages->count_item_can_featured( get_current_user_id(), STInput::get( 'id', '' ) );
                if ( $admin_packages->enabled_membership() ) {
                    if ( $admin_packages->get_user_role() == 'partner' && ( $num_set_featured !== 'unlimited' && $num_set_featured <= 0 ) && STInput::request( 'is_featured', 'off' ) == 'on' ) {
                        STTemplate::set_message( sprintf( __( "You cannot set featured for this rental. Your remaining item is %s (items)", ST_TEXTDOMAIN ), $num_set_featured ), 'warning' );

                        return false;
                    }
                }


                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );

                    return false;
                }

                return true;
            }

            /* Update Rental */
            function st_update_post_type_rental()
            {
                if ( !st_check_service_available( 'st_rental' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_post_rental', '' ), 'user_setting' ) ) {
                    if ( self::validate_rental() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_rental' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();
                        $my_post      = [
                            'post_title'   => 'Title',
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'st_rental',
                            'post_excerpt' => '',
                        ];
                        $post_id      = wp_insert_post( $my_post );
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_rental' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }
                    if ( !empty( $post_id ) ) {
                        $st_content = STInput::request( 'st_content' );
                        $my_post    = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' ),
                            'post_content' => stripslashes( $st_content ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );
                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );

                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );

                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        /////////////////////////////////////
                        /// Update Muti location
                        /////////////////////////////////////
                        if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                            $location = $_REQUEST[ 'multi_location' ];
                            if ( is_array( $location ) && count( $location ) ) {
                                $location_str = '';
                                foreach ( $location as $item ) {
                                    if ( empty( $location_str ) ) {
                                        $location_str .= $item;
                                    } else {
                                        $location_str .= ',' . $item;
                                    }
                                }
                            } else {
                                $location_str = '';
                            }
                            update_post_meta( $post_id, 'multi_location', $location_str );
                            update_post_meta( $post_id, 'location_id', '' );
                        }
                        //tab rental info
                        update_post_meta( $post_id, 'is_featured', STInput::request( 'is_featured' ) );
                        update_post_meta( $post_id, 'rental_number', STInput::request( 'rental_number' ) );
                        update_post_meta( $post_id, 'custom_layout', STInput::request( 'st_custom_layout' ) );
                        update_post_meta( $post_id, 'rental_max_adult', STInput::request( 'rental_max_adult' ) );
                        update_post_meta( $post_id, 'rental_max_children', STInput::request( 'rental_max_children' ) );
                        update_post_meta( $post_id, 'video', STInput::request( 'video' ) );
                        //tab agent info
                        update_post_meta( $post_id, 'agent_email', STInput::request( 'email' ) );
                        update_post_meta( $post_id, 'agent_website', STInput::request( 'website' ) );
                        update_post_meta( $post_id, 'agent_phone', STInput::request( 'phone' ) );
                        update_post_meta( $post_id, 'st_fax', STInput::request( 'st_fax' ) );
                        update_post_meta( $post_id, 'show_agent_contact_info', STInput::request( 'show_agent_contact_info' ) );
                        update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                        update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                        update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );

                        //tab price
                        update_post_meta( $post_id, 'price', STInput::request( 'price' ) );
                        update_post_meta( $post_id, 'discount_rate', (int)STInput::request( 'discount' ) );
                        update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );
                        update_post_meta( $post_id, 'sale_price_from', STInput::request( 'sale_price_from' ) );
                        update_post_meta( $post_id, 'sale_price_to', STInput::request( 'sale_price_to' ) );
                        update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                        update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );
                        //tab other options
                        update_post_meta( $post_id, 'allow_full_day', STInput::request( 'allow_full_day', 'off' ) );
                        update_post_meta( $post_id, 'rentals_booking_period', (int)STInput::request( 'rentals_booking_period' ) );
                        update_post_meta( $post_id, 'rentals_booking_min_day', (int)STInput::request( 'rentals_booking_min_day' ) );
                        update_post_meta( $post_id, 'st_rental_external_booking', STInput::request( 'st_rental_external_booking' ) );
                        update_post_meta( $post_id, 'st_rental_external_booking_link', STInput::request( 'st_rental_external_booking_link' ) );
                        //tab location settings
                        update_post_meta( $post_id, 'address', STInput::request( 'address' ) );
                        $gmap = STInput::request( 'gmap' );
                        update_post_meta( $post_id, 'map_lat', $gmap[ 'lat' ] );
                        update_post_meta( $post_id, 'map_lng', $gmap[ 'lng' ] );
                        update_post_meta( $post_id, 'map_zoom', $gmap[ 'zoom' ] );
                        update_post_meta( $post_id, 'map_type', $gmap[ 'type' ] );

                        update_post_meta( $post_id, 'st_google_map', $gmap );
                        update_post_meta( $post_id, 'enable_street_views_google_map', STInput::request( 'enable_street_views_google_map' ) );
                        /////////////////////////////////////
                        /// Update Payment
                        /////////////////////////////////////
                        $data_paypment = STPaymentGateways::$_payment_gateways;
                        if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                            foreach ( $data_paypment as $k => $v ) {
                                update_post_meta( $post_id, 'is_meta_payment_gateway_' . $k, STInput::request( 'is_meta_payment_gateway_' . $k ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = $_REQUEST[ 'taxonomy' ];
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }
                        // Update extra
                        $extra = STInput::request( 'extra', '' );
                        if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                            $list_extras = [];
                            foreach ( $extra[ 'title' ] as $key => $val ) {
                                if ( !empty( $val ) ) {
                                    $list_extras[ $key ] = [
                                        'title'            => $val,
                                        'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                        'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                        'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'extra_price', $list_extras );
                        } else {
                            update_post_meta( $post_id, 'extra_price', '' );
                        }

                        /**
                         * @since 1.3.1
                         **/
                        /*---- Properties*/
                        $properties = STInput::post( 'property-item', '' );
                        if ( !empty( $properties ) ) {
                            $list = [];
                            for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                    $list[] = [
                                        'title'          => $properties[ 'title' ][ $i ],
                                        'featured_image' => $properties[ 'featured_image' ][ $i ],
                                        'description'    => $properties[ 'description' ][ $i ],
                                        'icon'           => $properties[ 'icon' ][ $i ],
                                        'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                        'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                    ];
                                }

                            }
                            update_post_meta( $post_id, 'properties_near_by', $list );
                        }

                        /////////////////////////////////////
                        /// Update custom flied
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'rental_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }

                        self::$msg = [
                            'status' => 'success',
                            'msg'    => 'Update rental successfully !'
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-rental', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }
                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => 'Error : Update rental not successfully !'
                        ];
                    }
                }
            }

            function validate_rental_room()
            {

                if ( !st_check_service_available( 'rental_room' ) ) {
                    return;
                }

                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;
                /// Location ///
                $validator->set_rules( 'st_title', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'st_content', __( "Content", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'st_desc', __( "Description", ST_TEXTDOMAIN ), 'required' );
                $id_featured_image = STInput::request( 'id_featured_image' );
                if ( empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND empty( $id_featured_image ) ) {
                    $validator->set_error_message( 'featured_image', __( "The Featured Image field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' ) ) {
                    $validator->set_error_message( 'gallery', __( "The Gallery field is required.", ST_TEXTDOMAIN ) );
                }
                $validator->set_rules( 'room_parent', __( "Select Rental", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                $validator->set_rules( 'adult_number', __( "Adults Number", ST_TEXTDOMAIN ), 'required|unsigned_integer|greater_than[0]' );
                $validator->set_rules( 'children_number', __( "Children Number", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                $validator->set_rules( 'bed_number', __( "Beds Number", ST_TEXTDOMAIN ), 'required|unsigned_integer|greater_than[0]' );
                $validator->set_rules( 'room_footage', __( "Room footage", ST_TEXTDOMAIN ), 'required|unsigned_integer|greater_than[0]' );
                $validator->set_rules( 'room_description', __( "Description", ST_TEXTDOMAIN ), 'required' );
                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );

                    return false;
                }

                return true;
            }

            /* Rental room */
            function st_update_rental_room()
            {
                if ( !st_check_service_available( 'rental_room' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_rental_room', '' ), 'user_setting' ) ) {
                    if ( self::validate_rental_room() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_rental_room' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }

                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_rental_room' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();

                        $my_post = [
                            'post_title'   => 'Title',
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'rental_room',
                            'post_excerpt' => '',
                        ];
                        $post_id = wp_insert_post( $my_post );
                    }
                    if ( !empty( $post_id ) ) {
                        $st_content = STInput::request( 'st_content' );
                        $my_post    = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' ),
                            'post_content' => stripslashes( $st_content ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );
                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );

                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );

                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        /////////////////////////////////////
                        /// Update Meta Box
                        /////////////////////////////////////
                        update_post_meta( $post_id, 'st_custom_layout', STInput::request( 'st_custom_layout' ) );
                        update_post_meta( $post_id, 'room_parent', STInput::request( 'room_parent' ) );
                        update_post_meta( $post_id, 'adult_number', STInput::request( 'adult_number' ) );
                        update_post_meta( $post_id, 'children_number', STInput::request( 'children_number' ) );
                        update_post_meta( $post_id, 'bed_number', STInput::request( 'bed_number' ) );
                        update_post_meta( $post_id, 'room_footage', STInput::request( 'room_footage' ) );
                        $add_new_facility_title = STInput::request( 'add_new_facility_title' );
                        $add_new_facility_value = STInput::request( 'add_new_facility_value' );
                        $add_new_facility_icon  = STInput::request( 'add_new_facility_icon' );
                        if ( !empty( $add_new_facility_title ) ) {
                            $data = [];
                            foreach ( $add_new_facility_title as $k => $v ) {
                                $data[] = [ 'title' => $v, 'value' => $add_new_facility_value[ $k ], 'facility_icon' => $add_new_facility_icon[ $k ] ];
                            }
                            update_post_meta( $post_id, 'add_new_facility', $data );
                        }
                        update_post_meta( $post_id, 'room_description', stripslashes( STInput::request( 'room_description' ) ) );
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = $_REQUEST[ 'taxonomy' ];
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }
                        /////////////////////////////////////
                        /// Update custom_field
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'rental_room_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }

                        self::$msg = [
                            'status' => 'success',
                            'msg'    => __( 'Update rental room successfully !', ST_TEXTDOMAIN )
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-room-rental', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }
                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => __( 'Error : Update rental room not successfully !', ST_TEXTDOMAIN )
                        ];
                    }
                }
            }

            function validate_flight(){
                if ( !st_check_service_available( 'st_flight' ) ) {
                    return false;
                }

                $validator = self::$validator;
                $validator->set_rules( 'st_title', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'airline', __( "Airline Company", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'origin', __( "Origin", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'destination', __( "Destination", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'departure_time', __( "Departure time", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'total_time', __( "Total time", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'flight_type', __( "Flight Type", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'enable_tax', __( "Enable Tax", ST_TEXTDOMAIN ), 'required' );
                if(STInput::request('enable_tax') == 'yes_not_included') {
                    $validator->set_rules('vat_amount', __("Tax Percent", ST_TEXTDOMAIN), 'required|numeric');
                }

                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );

                    return false;
                }

                return true;
            }
            /**
             * Since 1.4.7
             */
            function st_update_post_type_flight(){
                if ( !st_check_service_available( 'st_flight' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_post_flight', '' ), 'user_setting' ) ) {
                    if ( $this->validate_flight() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_flight' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }

                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_flight' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();

                        $my_post = [
                            'post_title'   => 'Title',
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'st_flight',
                            'post_excerpt' => '',
                        ];
                        $post_id = wp_insert_post( $my_post );
                    }
                    if ( !empty( $post_id ) ) {
                        $my_post    = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' )
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );
                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );

                        //Update metabox
                        update_post_meta($post_id, 'airline', STInput::request('airline'));
                        if($airline = STInput::request('airline')) {
                            wp_set_post_terms($post_id, $airline, 'st_airline');
                        }

                        update_post_meta($post_id, 'origin', STInput::request('origin'));
                        update_post_meta($post_id, 'destination', STInput::request('destination'));
                        update_post_meta($post_id, 'departure_time', STInput::request('departure_time'));
                        update_post_meta($post_id, 'total_time', STInput::request('total_time'));
                        update_post_meta($post_id, 'flight_type', STInput::request('flight_type'));
                        update_post_meta($post_id, 'airport_stop', STInput::request('airport_stop'));
                        update_post_meta($post_id, 'airline_stop', STInput::request('airline_stop'));
                        update_post_meta($post_id, 'arrival_stop', STInput::request('arrival_stop'));
                        update_post_meta($post_id, 'st_stopover_time', STInput::request('st_stopover_time'));
                        update_post_meta($post_id, 'departure_stop', STInput::request('departure_stop'));
                        update_post_meta($post_id, 'airport_stop_1', STInput::request('airport_stop_1'));
                        update_post_meta($post_id, 'airline_stop_1', STInput::request('airline_stop_1'));
                        update_post_meta($post_id, 'arrival_stop_1', STInput::request('arrival_stop_1'));
                        update_post_meta($post_id, 'st_stopover_time_1', STInput::request('st_stopover_time_1'));
                        update_post_meta($post_id, 'airport_stop_2', STInput::request('airport_stop_2'));
                        update_post_meta($post_id, 'airline_stop2', STInput::request('airline_stop2'));
                        update_post_meta($post_id, 'arrival_stop_2', STInput::request('arrival_stop_2'));
                        update_post_meta($post_id, 'st_stopover_time_2', STInput::request('st_stopover_time_2'));
                        update_post_meta($post_id, 'departure_stop_2', STInput::request('departure_stop_2'));
                        update_post_meta($post_id, 'max_ticket', STInput::request('max_ticket'));
                        update_post_meta($post_id, 'enable_tax', STInput::request('enable_tax'));
                        update_post_meta($post_id, 'vat_amount', STInput::request('vat_amount'));

                        $flight = ST_Flights_Models::inst();
                        $location_from = get_tax_meta(STInput::request('origin'), 'location_id');
                        $location_to = get_tax_meta(STInput::request('destination'), 'location_id');
                        if ($flight->get_data($post_id)) {
                            $data = array(
                                'iata_from' => STInput::request('origin'),
                                'location_from' => $location_from,
                                'iata_to' => STInput::request('destination'),
                                'location_to' => $location_to,
                                'flight_type' => STInput::request('flight_type'),
                                'max_ticket' => STInput::request('max_ticket'),
                                'departure_time' => st_flight_convert_time_to_str(STInput::request('departure_time')),
                                'airline' => STInput::request('airline')
                            );

                            $flight->update_data($data, array('post_id' => $post_id));
                        } else {
                            $data = array(
                                'post_id' => $post_id,
                                'iata_from' => STInput::request('origin'),
                                'location_from' => $location_from,
                                'iata_to' => STInput::request('destination'),
                                'location_to' => $location_to,
                                'flight_type' => STInput::request('flight_type'),
                                'max_ticket' => STInput::request('max_ticket'),
                                'departure_time' => st_flight_convert_time_to_str(STInput::request('departure_time')),
                                'airline' => STInput::request('airline')
                            );

                            $flight->insert_data($data);
                        }

                        /////////////////////////////////////
                        /// Update Payment
                        /////////////////////////////////////
                        $data_paypment = STPaymentGateways::$_payment_gateways;
                        if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                            foreach ( $data_paypment as $k => $v ) {
                                update_post_meta( $post_id, 'is_meta_payment_gateway_' . $k, STInput::request( 'is_meta_payment_gateway_' . $k ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = $_REQUEST[ 'taxonomy' ];
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }
                        /////////////////////////////////////
                        /// Update custom_field
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'flight_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }

                        self::$msg = [
                            'status' => 'success',
                            'msg'    => __( 'Update flight successfully !', ST_TEXTDOMAIN )
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-flights', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }
                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => __( 'Error : Update flight not successfully !', ST_TEXTDOMAIN )
                        ];
                    }
                }
            }
            /**
             * Since 1.1.0
             */
            /* Location */
            function st_insert_post_type_location()
            {
                if ( !empty( $_REQUEST[ 'btn_insert_post_type_location' ] ) ) {
                    if ( wp_verify_nonce( $_REQUEST[ 'st_insert_post_location' ], 'user_setting' ) ) {
                        $current_user = wp_get_current_user();
                        $title        = STInput::request( 'st_title' );
                        $st_content   = $_REQUEST[ 'st_content' ];
                        $desc         = STInput::request( 'st_desc' );
                        $post_parent  = $_REQUEST[ 'post_parent' ];
                        $my_post      = [
                            'post_title'   => $title,
                            'post_content' => stripslashes( $st_content ),
                            'post_status'  => "publish",
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'location',
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                            'post_parent'  => $post_parent
                        ];
                        $post_id      = wp_insert_post( $my_post );
                        if ( !empty( $post_id ) ) {
                            $featured_image    = $_FILES[ 'featured-image' ];
                            $id_featured_image = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                            set_post_thumbnail( $post_id, $id_featured_image );

                            $logo    = $_FILES[ 'logo' ];
                            $id_logo = self::upload_image_return( $logo, 'logo', $logo[ 'type' ] );
                            update_post_meta( $post_id, 'logo', $id_logo );

                            update_post_meta( $post_id, 'zipcode', $_REQUEST[ 'zipcode' ] );
                            update_post_meta( $post_id, 'map_lat', $_REQUEST[ 'map_lat' ] );
                            update_post_meta( $post_id, 'map_lng', $_REQUEST[ 'map_lng' ] );
                            update_post_meta( $post_id, 'is_featured', $_REQUEST[ 'is_featured' ] );

                            self::$msg = [
                                'status' => 'success',
                                'msg'    => __( 'Create Location successfully !', ST_TEXTDOMAIN )
                            ];
                        } else {
                            self::$msg = [
                                'status' => 'danger',
                                'msg'    => __( 'Error : Create Location not successfully !', ST_TEXTDOMAIN )
                            ];
                        }

                    }
                }
            }

            public function _get_join( $join )
            {
                global $wpdb;
                $type = isset( $_SESSION[ 'type_booking' ] ) ? $_SESSION[ 'type_booking' ] : '';

                $join .= " INNER JOIN {$wpdb->prefix}postmeta as mt ON {$wpdb->prefix}posts.ID = mt.post_id AND mt.meta_key = 'id_user' ";
                $join .= " INNER JOIN {$wpdb->prefix}postmeta as mt1 ON {$wpdb->prefix}posts.ID = mt1.post_id AND mt1.meta_key = 'st_email' ";
                $join .= " INNER JOIN {$wpdb->prefix}postmeta as mt2 ON {$wpdb->prefix}posts.ID = mt2.post_id ";
                if ( !empty( $type ) ) {
                    $join .= " INNER JOIN {$wpdb->prefix}postmeta as mt3 ON {$wpdb->prefix}posts.ID = mt3.post_id AND mt3.meta_key = 'status'";
                }

                return $join;
            }

            public function _get_where( $where )
            {
                global $wpdb;

                global $current_user;

                $type = isset( $_SESSION[ 'type_booking' ] ) ? $_SESSION[ 'type_booking' ] : '';

                //get_bloginfo('version');
                //get_currentuserinfo();
                $user_id    = $current_user->ID;
                $user_email = $current_user->user_email;

                $data_type = STInput::request( 'data_type', '' );

                $where .= " AND ((CAST(mt.meta_value AS UNSIGNED) = '{$user_id}')";

                $where .= " OR (mt2.meta_key = 'booking_by'
            AND mt2.meta_value = 'admin' AND mt1.meta_value = '{$user_email}')";

                $where .= " OR (mt2.meta_key = 'booking_by'
            AND mt2.meta_value = 'partner' AND mt1.meta_value = '{$user_email}'))";

                if ( !empty( $type ) ) {
                    $where .= " AND mt3.meta_value = '{$type}'";
                }

                return $where;
            }

            public function _get_distinct()
            {
                return 'DISTINCT';
            }

            /* book history */


            static function _get_currency_book_history( $post_id )
            {
                $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                if ( $st_is_woocommerce_checkout ) {
                    global $wpdb;
                    $querystr    = "SELECT meta_value FROM  " . $wpdb->prefix . "woocommerce_order_itemmeta
                                    WHERE
                                    1=1
                                    AND order_item_id = '{$post_id}'
                                    AND meta_key = '_st_currency'";
                    $st_currency = $wpdb->get_row( $querystr, OBJECT );
                    if ( !empty( $st_currency->meta_value ) ) {
                        return $st_currency->meta_value;
                    }
                } else {
                    $currency = get_post_meta( $post_id, 'currency', true );

                    return $currency[ 'symbol' ];
                }
            }

            static function _get_order_statuses()
            {

                $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                $order_statuses             = [];
                if ( $st_is_woocommerce_checkout ) {
                    if ( function_exists( 'wc_get_order_statuses' ) ) {
                        $order_statuses = wc_get_order_statuses();
                    }
                } else {
                    $order_statuses = [
                        'pending'    => __( 'Pending', ST_TEXTDOMAIN ),
                        'complete'   => __( 'Completed', ST_TEXTDOMAIN ),
                        'incomplete' => __( 'Incomplete', ST_TEXTDOMAIN ),
                        'canceled'   => __( 'Cancelled', ST_TEXTDOMAIN ),
                    ];
                }

                return apply_filters( 'st_order_statuses', $order_statuses );
            }


            static function _get_order_total_price( $post_id )
            {
                $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                if ( $st_is_woocommerce_checkout ) {
                    global $wpdb;
                    $querystr   = "SELECT meta_value FROM  " . $wpdb->prefix . "woocommerce_order_itemmeta
                                    WHERE
                                    1=1
                                    AND order_item_id = '{$post_id}'
                                    AND (
                                        meta_key = '_line_total'
                                        OR meta_key = '_line_tax'
                                    )
                                    ";
                    $price      = $wpdb->get_results( $querystr, OBJECT );
                    $data_price = 0;
                    if ( !empty( $price ) ) {
                        foreach ( $price as $k => $v ) {
                            $data_price += $v->meta_value;
                        }
                    }

                    return $data_price;
                } else {
                    return get_post_meta( $post_id, 'total_price', true );
                }
            }

            static function _get_all_order_statuses()
            {
                $order_statuses = [
                    'pending'    => __( 'Pending', ST_TEXTDOMAIN ),
                    'complete'   => __( 'Completed', ST_TEXTDOMAIN ),
                    'incomplete' => __( 'Incomplete', ST_TEXTDOMAIN ),
                    'canceled'   => __( 'Cancelled', ST_TEXTDOMAIN ),
                ];
                if ( function_exists( 'wc_get_order_statuses' ) ) {
                    $order_statuses_woo = wc_get_order_statuses();
                    $order_statuses     = array_merge( $order_statuses, $order_statuses_woo );
                }

                return apply_filters( 'st_order_statuses', $order_statuses );
            }


            function get_book_history( $status = '' )
            {

                $paged = 1;
                $limit = 10;
                if(!empty( $_REQUEST[ 'paged' ] )) {
                    $paged = $_REQUEST[ 'paged' ];
                }
                $offset = ($paged-1) * $limit;
                global $wpdb;
                $where = "";
                if(!empty($status)){
                    $where .= " AND status = '".$status."' ";
                }
                if(!empty($_REQUEST['data_type'])){
                    $where .= " AND status = '".$_REQUEST['data_type']."' ";
                }
                $st_is_woocommerce_checkout = apply_filters('st_is_woocommerce_checkout',false);
                if($st_is_woocommerce_checkout){
                    $where .= " AND type = 'woocommerce' ";
                }else{
                    $where .= " AND type = 'normal_booking' ";
                }

                $where_user = " AND user_id = ". get_current_user_id();

                $querystr = "SELECT SQL_CALC_FOUND_ROWS * FROM
                                       " . $wpdb->prefix . "st_order_item_meta
                                                            WHERE 1=1 {$where_user}
                                                            {$where}
                         ORDER BY " . $wpdb->prefix . "st_order_item_meta.id DESC LIMIT {$offset},{$limit}
            ";
                $pageposts = $wpdb->get_results( $querystr , OBJECT );
                $html = '';

                if(!empty($pageposts)){
                    foreach($pageposts as $key=>$value){
                        $id_item         = $value->st_booking_id;
                        /////////////////// REVIEW //////////////////

                        $action          = '';
                        $action_cancel = '';

                        $user_url          = st()->get_option( 'page_my_account_dashboard' );
                        $data[ 'sc' ]      = 'write_review';
                        $data[ 'item_id' ] = $id_item;

                        if(STReview::review_check($id_item) =='true') {
                            $action = '<a class="btn btn-xs btn-primary" class="user_write_review" href="' . st_get_link_with_search( get_permalink( $user_url ) , array(
                                    'sc' ,
                                    'item_id'
                                ) , $data ) . '">' . st_get_language( 'user_write_review' ) . '</a>';

                        }
                        else {
                            $action = "<p style='display: none'>".STReview::review_check($id_item)."</p>" ;
                        }

                        if(TravelerObject::check_cancel_able($value->order_item_id) && $value->type == 'normal_booking' ){
                            $url=add_query_arg(array(
                                'sc'=>'booking-history',
                                'st_action'=>'cancel_booking',
                                'order_item_id'=>$value->order_item_id
                            ),get_permalink($user_url));
                            /*$action .= sprintf("<a onclick='return confirm(\"%s\")' class='btn btn-xs btn-primary mt10' href='%s'>%s</a>",__('Are you sure?',ST_TEXTDOMAIN),$url,__('Cancel Booking',ST_TEXTDOMAIN)) ;*/
                            $action .= '<a  data-toggle="modal" data-target="#cancel-booking-modal" class="btn btn-xs btn-primary mt5 confirm-cancel-booking" href="javascript: void(0);" data-order_id="'. $value->order_item_id .'" data-order_encrypt="'. TravelHelper::st_encrypt( $value->order_item_id ) .'">'. __('Cancel Booking', ST_TEXTDOMAIN).'</a>';
                        }

                        /////////////////// DATE //////////////////
                        $check_in        = $value->check_in;
                        $check_out       = $value->check_out;
                        $format=TravelHelper::getDateFormat();
                        if($check_in and $check_out) {
                            $date = date_i18n( $format , $value->check_in_timestamp ) . ' <i class="fa fa-long-arrow-right"></i> ' . date_i18n( $format , $value->check_out_timestamp );
                        }
                        if($value->st_booking_post_type == 'st_tours') {
                            $type_tour = get_post_meta( $id_item , 'type_tour' , true );
                            if($type_tour == 'daily_tour') {
                                $duration = get_post_meta( $id_item , 'duration_day' , true );
                                if ($date){
                                    $date     = __( "Check in : " , ST_TEXTDOMAIN ) . date_i18n( $format , $value->check_in_timestamp ) . "<br>";
                                    $date .= __( "Duration : " , ST_TEXTDOMAIN ) . $duration. " ";
                                }
                            }
                        }
                        if (!isset($date)){$date = "";}
                        /////////////////// HTML //////////////////
                        $icon_type = $this->get_icon_type_order_item( $id_item );
                        if(!empty( $icon_type )) {
                            $price =  self::_get_order_total_price($value->order_item_id);
                            $currency = self::_get_currency_book_history($value->order_item_id);
                            $status_string = "";
                            $data_status =  self::_get_order_statuses();
                            if(!empty($data_status[$value->status])){
                                $status_string = $data_status[$value->status];
                                if( isset( $value->cancel_refund_status ) && $value->cancel_refund_status == 'pending'){
                                    $status_string = __('Cancelling', ST_TEXTDOMAIN);
                                }
                            }
                            global $wpdb;
                            $address = get_post_meta( $id_item, 'address', true);
                            if(get_post_type($id_item) == 'st_cars'){
                                $address = get_post_meta($id_item, 'cars_address', true);
                            }
                            $other_html = apply_filters('st_after_body_order_information_table','',$value->order_item_id);

                            if(get_post_type($id_item) == 'st_flight') {
                                if(!empty($value->raw_data)) {
                                    $raw_data = json_decode($value->raw_data);

                                    $title = '';
                                    if(!empty($raw_data->depart_data_location->origin_location_full) && !empty($raw_data->depart_data_location->destination_location_full)) {
                                        $title .= $raw_data->depart_data_location->origin_location_full . ' ('. $raw_data->depart_data_location->origin_iata . ') <i class="fa fa-long-arrow-right"></i> ' . $raw_data->depart_data_location->destination_location_full .' ('. $raw_data->depart_data_location->destination_iata.')';
                                    }
                                    $date = esc_html__('Depart: ', ST_TEXTDOMAIN).$raw_data->depart_data_time->depart_time. ' '.date_i18n( $format , $value->check_in_timestamp );
                                    if($raw_data->flight_type == 'return'){
                                        $title .= esc_html__(' (return)', ST_TEXTDOMAIN);
                                        $date .= '<br>'.esc_html__('Return: ', ST_TEXTDOMAIN).$raw_data->return_data_time->depart_time. ' '.date_i18n( $format , $value->check_out_timestamp );
                                    }
                                    $html .= '
                                    <tr class="' . $id_item . ' " data-id-order="' . $value->id . '">
                                        <td class="booking-history-type ' . get_post_type($id_item) . '">
                                           ' . $this->get_icon_type_order_item($id_item) . '
                                        </td>

                                        <td> '.$value->order_item_id.'</td>
                                        <td class="booking-history-title">  ' . $title . '</td>
                                        <td class="hidden-xs" style=""></td>
                                        <td class="hidden-xs" >' . date_i18n($format, strtotime($value->created)) . '</td>
                                        <td class="hidden-xs" >' . $date . '</td>
                                        <td >' . TravelHelper::format_money_raw($price, $currency) . '</td>
                                        <td class="hidden-xs" >' . $status_string . '</td>
                                        <td class="hidden-xs" style="width:1%" >' . $action . '</td>
                                        ' . $other_html . '
                                    </tr>';

                                }
                            }else{
                                $html .= '
                            <tr class="' . $id_item . ' " data-id-order="' . $value->id . '">
                                <td class="booking-history-type ' . get_post_type($id_item) . '">
                                   ' . $this->get_icon_type_order_item($id_item) . '
                                </td>
                                
                                        <td> '.$value->order_item_id.'</td>
                                <td class="booking-history-title"> <a href="' . $this->get_link_order_item($id_item) . '">' . $this->get_title_order_item($id_item) . '</a></td>
                                <td class="hidden-xs" style="">' . $address . '</td>
                                <td class="hidden-xs" >' . date_i18n($format, strtotime($value->created)) . '</td>
                                <td class="hidden-xs" >' . $date . '</td>
                                <td >' . TravelHelper::format_money_raw($price, $currency) . '</td>
                                <td class="hidden-xs" >' . $status_string . '</td>
                                <td class="hidden-xs" style="width:1%" >' . $action . '</td>
                                ' . $other_html . '
                            </tr>';
                            }
                        }
                    }
                }
                if(!empty( $_REQUEST[ 'show' ] )) {
                    if(!empty( $html ))
                        $status = 'true';
                    else
                        $status = 'false';

                    echo json_encode( array(
                        'html'     => $html ,
                        'data_per' => $paged + 1 ,
                        'status'   => $status
                    ) );
                    die();
                } else {
                    return $html;
                }

            }

            function get_location_order_item( $id_item )
            {
                $post_type = get_post_type( $id_item );
                switch ( $post_type ) {
                    case "st_hotel":
                        $location = TravelHelper::locationHtml( $id_item );
                        break;
                    case "cruise_cabin":
                        $id_cruise   = get_post_meta( $id_item, 'cruise_id', true );
                        $id_location = get_post_meta( $id_cruise, 'location_id', true );
                        if ( !$id_location )
                            return;
                        $location = get_the_title( $id_location );
                        break;
                    case "st_tours":
                        $id_location = get_post_meta( $id_item, 'id_location', true );
                        if ( !$id_location )
                            return;
                        $location = get_the_title( $id_location );
                        break;
                    case "st_cars":
                        $id_location = get_post_meta( $id_item, 'id_location', true );
                        if ( !$id_location )
                            return;
                        $location = get_the_title( $id_location );
                        break;
                    case "st_rental":
                        $id_location = get_post_meta( $id_item, 'location_id', true );
                        if ( !$id_location )
                            return;
                        $location = get_the_title( $id_location );
                        break;
                    case "st_activity":
                        $id_location = get_post_meta( $id_item, 'id_location', true );
                        if ( !$id_location )
                            return;
                        $location = get_the_title( $id_location );
                        break;
                    default :
                        $location = '';
                }

                return $location;
            }

            function get_link_order_item( $id_item )
            {
                $post_type = get_post_type( $id_item );
                switch ( $post_type ) {
                    case "st_hotel":
                        $title = get_the_permalink( $id_item );
                        break;
                    case "hotel_room":
                        $title = get_the_permalink( $id_item );
                        break;
                    case "cruise_cabin":
                        $id_cruise = get_post_meta( $id_item, 'cruise_id', true );
                        $title     = get_the_permalink( $id_cruise );
                        break;
                    case "st_tours":
                        $title = get_the_permalink( $id_item );
                        break;
                    case "st_cars":
                        $title = get_the_permalink( $id_item );
                        break;
                    case "st_rental":
                        $title = get_the_permalink( $id_item );
                        break;
                    case "st_activity":
                        $title = get_the_permalink( $id_item );
                        break;
                    default :
                        $title = get_the_permalink( $id_item );
                }

                return $title;
            }

            function get_title_order_item( $id_item )
            {
                $post_type = get_post_type( $id_item );
                switch( $post_type ) {
                    case "st_hotel":
                        $title = get_the_title( $id_item );
                        break;
                    case "hotel_room":
                        $title = get_the_title( $id_item );
                        break;
                    case "cruise_cabin":
                        $id_cruise = get_post_meta( $id_item , 'cruise_id' , true );
                        $title     = get_the_title( $id_cruise );
                        break;
                    case "st_tours":
                        $title = get_the_title( $id_item );
                        break;
                    case "st_cars":
                        $title = get_the_title( $id_item );
                        break;
                    case "st_rental":
                        $title = get_the_title( $id_item );
                        break;
                    case "st_activity":
                        $title = get_the_title( $id_item );
                        break;
                    default :
                        $title = get_the_title( $id_item );
                }
                return $title;
            }

            function get_icon_type_order_item( $id_item )
            {
                $post_type = get_post_type( $id_item );
                switch ( $post_type ) {
                    case "st_hotel":
                        $html = '<i class="fa fa-building-o"></i><small>' . __( "hotel", ST_TEXTDOMAIN ) . '</small>';
                        break;
                    case "hotel_room":
                        $html = '<i class="fa fa-building-o"></i><small>' . __( "room", ST_TEXTDOMAIN ) . '</small>';
                        break;
                    case "st_tours":
                        $html = '<i class="fa fa-bolt"></i><small>' . __( 'tour', ST_TEXTDOMAIN ) . '</small>';
                        break;
                    case "st_cars":
                        $html = '<i class="fa fa-dashboard"></i><small>' . __( "car", ST_TEXTDOMAIN ) . '</small>';
                        break;
                    case "st_rental":
                        $html = '<i class="fa fa-home"></i><small>' . __( "rental", ST_TEXTDOMAIN ) . '</small>';
                        break;
                    case "st_activity":
                        $html = '<i class="fa fa-bolt"></i><small>' . __( "activity", ST_TEXTDOMAIN ) . '</small>';
                        break;
                    case "cruise_cabin":
                        $html = '<i class="fa fa-bolt"></i><small>' . __( "cruise", ST_TEXTDOMAIN ) . '</small>';
                        break;
                    case "st_flight":
                        $html = '<i class="fa fa-plane"></i><small>' . __( "flight", ST_TEXTDOMAIN ) . '</small>';
                        break;
                    default :
                        $html = '';
                }

                return $html;
            }

            

            /**
             * @updated 1.3.1
             **/
            static function check_lever_partner( $lever )
            {
                $dk = true;
                switch ( $lever ) {
                    case "subscriber":
                        $dk = false;
                        break;
                    case "contributor":
                        $dk = false;
                        break;
                    case "author":
                        $dk = false;
                        break;
                    case "editor":
                        $dk = false;
                        break;
                    case "partner":
                        $dk = true;
                        break;
                    case "administrator":
                        $dk = true;
                        break;
                    default :
                        $dk = false;
                }
                $user_id        = get_current_user_id();
                $admin_packages = STAdminPackages::get_inst();

                $enable = $admin_packages->enabled_membership();
                if ( $enable && $lever == 'partner' ) {
                    $order = $admin_packages->get_order_by_partner( $user_id );

                    if ( !$order ) {
                        $dk = false;
                    }
                    $verified = $admin_packages->partner_verified_package( $user_id );
                    if ( !$verified ) {
                        $dk = false;
                    }
                }

                return $dk;
            }

            function st_write_review()
            {
                if ( STInput::request( 'write_review' ) ) {
                    if ( !STInput::request( 'item_id' ) ) {
                        $user_url = st()->get_option( 'page_my_account_dashboard' );
                        if ( $user_url ) {
                            wp_safe_redirect( get_permalink( $user_url ) );
                        } else {
                            wp_safe_redirect( home_url() );
                        }
                        die;
                    } else {
                        if ( !get_post_status( STInput::request( 'item_id' ) ) ) {
                            $user_url = st()->get_option( 'page_my_account_dashboard' );
                            if ( $user_url ) {
                                wp_safe_redirect( get_permalink( $user_url ) );
                            } else {
                                wp_safe_redirect( home_url() );
                            }
                            die;
                        }
                    }
                }

                if ( STInput::post() and STInput::post( 'comment_post_ID' ) ) {

                    if ( wp_verify_nonce( STInput::post( 'st_user_write_review' ), 'st_user_settings' ) ) {
                        global $current_user;
                        $comment_data[ 'comment_post_ID' ]      = STInput::post( 'comment_post_ID' );
                        $comment_data[ 'comment_author' ]       = $current_user->data->user_nicename;
                        $comment_data[ 'comment_author_email' ] = $current_user->data->user_email;
                        $comment_data[ 'comment_content' ]      = STInput::post( 'comment' );
                        $comment_data[ 'comment_type' ]         = 'st_reviews';
                        $comment_data[ 'user_id' ]              = $current_user->ID;

                        if ( STInput::post( 'item_id' ) ) {
                            $comment_data[ 'comment_post_ID' ] = STInput::post( 'item_id' );
                        }
                        if ( STReview::check_reviewable( STInput::post( 'comment_post_ID' ) ) ) {
                            $comment_id = wp_new_comment( $comment_data );

                            if ( $comment_id ) {
                                update_comment_meta( $comment_id, 'comment_title', STInput::post( 'comment_title' ) );
                                if ( STInput::post( 'comment_rate' ) )
                                    update_comment_meta( $comment_id, 'comment_rate', STInput::post( 'comment_rate' ) );
                            }

                            wp_safe_redirect( get_permalink( STInput::post( 'comment_post_ID' ) ) );
                            die;
                        }

                    }
                }
            }


            static function get_icon_wishlist()
            {
                $current_user = wp_get_current_user();
                $data_list    = get_user_meta( $current_user->ID, 'st_wishlist', true );
                $data_list    = json_decode( $data_list );

                if ( $data_list != '' and is_array( $data_list ) ) {
                    $check = false;
                    foreach ( $data_list as $k => $v ) {
                        if ( $v->id == get_the_ID() and $v->type == get_post_type( get_the_ID() ) ) {
                            $check = true;
                        }
                    }
                    if ( $check == true ) {
                        return [
                            'original-title' => st_get_language( 'remove_to_wishlist' ),
                            'icon'           => '<i class="fa fa-heart"></i>'
                        ];
                    } else {
                        return [
                            'original-title' => st_get_language( 'add_to_wishlist' ),
                            'icon'           => '<i class="fa fa-heart-o"></i>'
                        ];
                    }
                } else {
                    return [
                        'original-title' => st_get_language( 'add_to_wishlist' ),
                        'icon'           => '<i class="fa fa-heart-o"></i>'
                    ];
                }
            }

            static function get_title_account_setting()
            {
                if ( !empty( $_REQUEST[ 'sc' ] ) ) {
                    $type = $_REQUEST[ 'sc' ];
                    switch ( $type ) {
                        case "setting":
                            st_the_language( 'user_settings' );
                            break;
                        case "photos":
                            st_the_language( 'user_my_travel_photos' );
                            break;
                        case "booking-history":
                            st_the_language( 'user_booking_history' );
                            break;
                        case "wishlist":
                            st_the_language( 'user_wishlist' );
                            break;
                        case "create-hotel":
                            st_the_language( 'user_create_hotel' );
                            break;
                        case "my-hotel":
                            st_the_language( 'user_my_hotel' );
                            break;
                        case "create-room":
                            st_the_language( 'user_create_room' );
                            break;
                        case "my-room":
                            st_the_language( 'user_my_room' );
                            break;
                        case "create-tours":
                            st_the_language( 'user_create_tour' );
                            break;
                        case "my-tours":
                            st_the_language( 'user_my_tour' );
                            break;
                        case "create-flight":
                            esc_html_e('Create new flight', ST_TEXTDOMAIN);
                            break;
                        case "my-flights":
                            esc_html_e('My flights', ST_TEXTDOMAIN);
                            break;
                        case "create-activity":
                            st_the_language( 'user_create_activity' );
                            break;
                        case "my-activity":
                            st_the_language( 'user_my_activity' );
                            break;
                        case "create-cars":
                            st_the_language( 'user_create_car' );
                            break;
                        case "my-cars":
                            st_the_language( 'user_my_car' );
                            break;
                        case "create-rental":
                            st_the_language( 'user_create_rental' );
                            break;
                        case "my-rental":
                            st_the_language( 'user_my_rental' );
                            break;
                        case "create-cruise":
                            st_the_language( 'user_create_cruise' );
                            break;
                        case "my-cruise":
                            st_the_language( 'user_my_cruise' );
                            break;
                        case "create-cruise-cabin":
                            st_the_language( 'user_create_cruise_cabin' );
                            break;
                        case "my-cruise-cabin":
                            st_the_language( 'user_my_cruise_cabin' );
                            break;
                        case "setting-info":
                            st_the_language( 'user_setting_info' );
                            break;
                        case "write-review":
                            st_the_language( 'user_write_review' );
                            break;
                        case "list-refund":
                            esc_html_e("Refund Manager",ST_TEXTDOMAIN);
                            break;
                    }
                } else if ( !empty( $_REQUEST[ 'id_user' ] ) ) {
                    st_the_language( 'user_setting_info' );
                } else {
                    st_the_language( 'user_settings' );
                }
            }

            static function get_info_total_traveled()
            {
                $data = [
                    'st_hotel'    => 0,
                    'st_rental'   => 0,
                    'st_cars'     => 0,
                    'st_activity' => 0,
                    'st_tours'    => 0,
                    'address'     => []
                ];
                global $wpdb;

                $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                $type                       = 'normal_booking';
                if ( $st_is_woocommerce_checkout ) {
                    $type = 'woocommerce';
                }

                $querystr  = "SELECT order_item_id,st_booking_post_type,st_booking_id FROM
                                       " . $wpdb->prefix . "st_order_item_meta
                                                            WHERE 1=1
                                                            AND user_id = " . get_current_user_id() . " and type='" . $type . "'
            ";
                $pageposts = $wpdb->get_results( $querystr, OBJECT );

                if ( !empty( $pageposts ) ) {
                    foreach ( $pageposts as $k => $v ) {
                        $item_id   = $v->st_booking_id;
                        $post_type = $v->st_booking_post_type;
                        if ( !empty( $post_type ) and isset( $data[ $post_type ] ) and st_check_service_available( $post_type ) ) {
                            $data[ $post_type ] += 1;
                            $lat  = get_post_meta( $item_id, 'map_lat', true );
                            $lng  = get_post_meta( $item_id, 'map_lng', true );
                            $icon = 'http://maps.google.com/mapfiles/marker_green.png';
                            switch ( $post_type ) {
                                case"st_hotel";
                                    $icon = st()->get_option( 'st_hotel_icon_map_marker', 'http://maps.google.com/mapfiles/marker_black.png' );
                                    break;
                                case"st_rental";
                                    $icon = st()->get_option( 'st_rental_icon_map_marker', 'http://maps.google.com/mapfiles/marker_brown.png' );
                                    break;
                                case"st_cars";
                                    $icon = st()->get_option( 'st_cars_icon_map_marker', 'http://maps.google.com/mapfiles/marker_green.png' );
                                    break;
                                case"st_tours";
                                    $icon = st()->get_option( 'st_tours_icon_map_marker', 'http://maps.google.com/mapfiles/marker_purple.png' );
                                    break;
                                case"st_activity";
                                    $icon = st()->get_option( 'st_activity_icon_map_marker', 'http://maps.google.com/mapfiles/marker_yellow.png' );
                                    break;
                            }
                            $data[ 'address' ][] = [ $lat, $lng, $icon ];
                        }
                    }
                }

                return $data;
            }

            /*
         * since 1.1.2
         */
            static function get_week_reports()
            {

                $day        = date( 'w' );
                $week_start = date( 'Y-m-d', strtotime( '-' . ( $day - 1 ) . ' days' ) );
                $week_end   = date( 'Y-m-d', strtotime( '+' . ( 7 - $day ) . ' days' ) );

                $last_week_start = date( 'Y-m-d', strtotime( '-' . ( $day + 7 ) . ' days' ) );
                $last_week_end   = date( 'Y-m-d', strtotime( '+' . ( 6 - $day - 7 ) . ' days' ) );

                return [
                    'this_week' => [
                        'start' => $week_start,
                        'end'   => $week_end,
                    ],
                    'last_week' => [
                        'start' => $last_week_start,
                        'end'   => $last_week_end,
                    ]
                ];
            }

            /*
         * since 1.1.2
         */
            static function get_fist_year_reports()
            {
                $the_week     = STUser_f::get_week_reports();
                $last_7_days  = date( 'Y-m-d', strtotime( 'today - 7 days' ) );
                $last_15_days = date( 'Y-m-d', strtotime( 'today - 30 days' ) );
                $last_60_days = date( 'Y-m-d', strtotime( 'today - 60 days' ) );
                $last_90_days = date( 'Y-m-d', strtotime( 'today - 90 days' ) );
                $yesterday    = date( 'Y-m-d', strtotime( 'today - 1 days' ) );
                $defaut       = [
                    'd'           => '',
                    'm'           => '',
                    'y'           => '',
                    'full'        => '',
                    'last_7days'  => $last_7_days,
                    'last_15days' => $last_15_days,
                    'last_60days' => $last_60_days,
                    'last_90days' => $last_90_days,
                    'yesterday'   => $yesterday,
                    'date_now'    => date( 'Y-m-d' ),
                    'the_week'    => $the_week,
                    'last_year'   => date( "Y" ) - 1,
                ];
                global $current_user;
                wp_get_current_user();
                $user_id = $current_user->ID;
                $query   = [
                    'post_type'      => 'shop_order',
                    'post_status'    => [ 'wc-completed' ],
                    'posts_per_page' => 1,
                    'author'         => $user_id,
                    'order'          => "ASC",
                    'orderby'        => "date",
                ];
                query_posts( $query );
                while ( have_posts() ) {
                    the_post();
                    $defaut = [
                        'd'           => get_the_date( "d" ),
                        'm'           => get_the_date( "n" ),
                        'y'           => get_the_date( "Y" ),
                        'full'        => get_the_date( "Y-m-d" ),
                        'last_7days'  => $last_7_days,
                        'last_15days' => $last_15_days,
                        'last_60days' => $last_60_days,
                        'last_90days' => $last_90_days,
                        'yesterday'   => $yesterday,
                        'date_now'    => date( 'Y-m-d' ),
                        'the_week'    => $the_week,
                        'last_year'   => date( "Y" ) - 1,
                    ];
                }

                return $defaut;
            }

            static function get_info_reports_old( $type = 'month', $year = false, $year_start = false, $year_end = false, $_date_start = false, $_date_end = false )
            {
                $data      = self::get_default_info_reports( $type, $_date_start, $_date_end );
                $data_year = current_time( 'Y' );
                if ( !empty( $year ) ) {
                    $data_year = $year;
                }
                $date_start = $data_year . '-01-1';
                $date_end   = $data_year . '-12-31';
                if ( !empty( $year_start ) and !empty( $year_end ) and $year_start <= $year_end ) {
                    $date_start = $year_start . '-01-1';
                    $date_end   = $year_end . '-12-31';
                }
                if ( !empty( $_date_start ) and !empty( $_date_end ) ) {
                    $date_start = $_date_start;
                    $date_end   = $_date_end;
                }
                global $current_user;
                wp_get_current_user();
                $user_id = $current_user->ID;
                $query   = [
                    'post_type'      => 'st_order',
                    'post_status'    => [ 'publish' ],
                    'posts_per_page' => -1,
                    'meta_query'     => [
                        [
                            'key'     => 'id_user',
                            'value'   => $user_id,
                            'compare' => '=',
                            'type'    => "NUMERIC"
                        ],
                    ],
                    'date_query'     => [
                        [
                            'after'     => $date_start,
                            'before'    => $date_end,
                            'inclusive' => true,
                        ],
                    ],
                ];
                query_posts( $query );
                global $wp_query;
                while ( have_posts() ) {
                    the_post();
                    $item_id   = get_post_meta( get_the_ID(), 'item_id', true );
                    $post_type = get_post_type( $item_id );
                    if ( !empty( $post_type ) and isset( $data[ 'post_type' ][ $post_type ] ) ) {


                        $price         = get_post_meta( get_the_ID(), 'total_price', true );
                        $item_number   = get_post_meta( get_the_ID(), 'item_number', true );
                        $number_orders = 1;

                        //
                        $data[ 'number_orders' ] = $data[ 'number_orders' ] + 1;
                        $data[ 'number_items' ]  = $data[ 'number_items' ] + $item_number;
                        $data[ 'average_total' ] = $data[ 'average_total' ] + $price;

                        // price by post type
                        $data[ 'post_type' ][ $post_type ][ 'ids' ][] = $item_id;
                        $data[ 'post_type' ][ $post_type ][ 'number_orders' ] += $number_orders;
                        $data[ 'post_type' ][ $post_type ][ 'number_items' ] += $item_number;
                        $data[ 'post_type' ][ $post_type ][ 'average_total' ] += $price;

                        /// price by custom date ---------------------------------------------
                        if ( $type == "15days" or $type == 'custom_date' ) {
                            $date_create = get_the_date( "m-d-Y" );
                            if ( isset( $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ] ) ) {
                                $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ][ 'number_orders' ] += $number_orders;
                                $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ][ 'number_items' ] += $item_number;
                                $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ][ 'average_total' ] += $price;
                            }
                        } else {
                            /// price by year ---------------------------------------------
                            $year_create = get_the_date( "Y" );
                            foreach ( $data[ 'post_type' ] as $k => $v ) {
                                if ( empty( $data[ 'post_type' ][ $k ][ 'year' ][ $year_create ] ) ) {
                                    $data[ 'post_type' ][ $k ][ 'year' ][ $year_create ] = [
                                        'number_orders' => 0,
                                        'number_items'  => 0,
                                        'average_total' => 0,
                                    ];
                                }
                                if ( !empty( $data[ 'post_type' ][ $k ][ 'year' ] ) ) {
                                    ksort( $data[ 'post_type' ][ $k ][ 'year' ] );
                                }
                            }
                            $data[ 'post_type' ][ $post_type ][ 'year' ][ $year_create ][ 'number_orders' ] = $number_orders;
                            $data[ 'post_type' ][ $post_type ][ 'year' ][ $year_create ][ 'number_items' ] += $item_number;
                            $data[ 'post_type' ][ $post_type ][ 'year' ][ $year_create ][ 'average_total' ] += $price;

                            /// price by month ---------------------------------------------

                            $month_create = get_the_date( "n" );
                            $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'number_order' ] += 1;

                            $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'number_items' ] += $item_number;
                            $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'average_total' ] += $price;

                            /// price by day ---------------------------------------------
                            $day_create = get_the_date( "j" );


                            $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'day' ][ $day_create ][ 'number_order' ] += 1;
                            $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'day' ][ $day_create ][ 'number_items' ] += $item_number;
                            $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'day' ][ $day_create ][ 'average_total' ] += $price;

                        }


                        /*       $date_create = get_the_date("n");
                    $data['post_type'][$post_type]['ids'][] = get_the_ID();
                    $data['post_type'][$post_type]['number_orders'] = $data['post_type'][$post_type]['number_orders'] + 1 ;
                    $item_number = get_post_meta(get_the_ID(), 'item_number', true);
                    $data['post_type'][$post_type]['number_items']  = $data['post_type'][$post_type]['number_items']  + $item_number;
                    $total_price = get_post_meta(get_the_ID(), 'total_price', true);
                    $data['post_type'][$post_type]['average_total'] = $data['post_type'][$post_type]['average_total'] + $total_price;

                    $data['post_type'][$post_type]['date'][$date_create]['number_order']  = $data['post_type'][$post_type]['date'][$date_create]['number_order'] + 1;
                    $data['post_type'][$post_type]['date'][$date_create]['number_items']  = $data['post_type'][$post_type]['date'][$date_create]['number_items'] + $item_number;
                    $data['post_type'][$post_type]['date'][$date_create]['average_total'] = $data['post_type'][$post_type]['date'][$date_create]['average_total'] + $total_price;

                    $data['number_orders'] = $data['number_orders'] + 1 ;
                    $data['number_items']  = $data['number_items'] + $item_number;
                    $data['average_total'] = $data['average_total'] + $total_price;*/

                    }
                }
                wp_reset_query();

                return $data;
            }

            /*
         * since 1.1.2
         * remove ver 1.2.0
        */
            static function get_info_reports( $type = 'month', $year = false, $year_start = false, $year_end = false, $_date_start = false, $_date_end = false )
            {

                $data = self::get_default_info_reports( $type, $_date_start, $_date_end );
                if ( !class_exists( 'WooCommerce' ) ) {
                    return $data;
                }

                global $wp_query;
                global $wpdb;

                $data_year = current_time( 'Y' );
                if ( !empty( $year ) ) {
                    $data_year = $year;
                }
                $date_start = $data_year . '-01-1';
                $date_end   = $data_year . '-12-31';

                if ( !empty( $year_start ) and !empty( $year_end ) and $year_start <= $year_end ) {
                    $date_start = $year_start . '-01-1';
                    $date_end   = $year_end . '-12-31';
                }

                if ( !empty( $_date_start ) and !empty( $_date_end ) ) {

                    $date_start = $_date_start;
                    $date_end   = $_date_end;
                }

                global $current_user;
                wp_get_current_user();
                $user_id       = $current_user->ID;
                $query         = [
                    'post_type'      => 'shop_order',
                    'post_status'    => [ 'wc-completed' ],
                    'posts_per_page' => -1,
                    'author'         => $user_id,
                    'date_query'     => [
                        [
                            'after'     => $date_start,
                            'before'    => $date_end,
                            'inclusive' => true,
                        ],
                    ],
                ];
                $list_partner  = st()->get_option( 'list_partner' );
                $array_partner = [];
                if ( !empty( $list_partner ) ) {
                    foreach ( $list_partner as $key => $value ) {
                        $id = 'st_' . $value[ 'id_partner' ];
                        if ( $value[ 'id_partner' ] == 'car' or $value[ 'id_partner' ] == 'tour' ) {
                            $id = 'st_' . $value[ 'id_partner' ] . 's';
                        }
                        $array_partner[ $id ] = $value[ 'title' ];
                    }
                }

                query_posts( $query );

                while ( have_posts() ) {
                    the_post();
                    $id_order          = get_the_ID();
                    $data_items        = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_order_items  WHERE 1=1 AND " . $wpdb->prefix . "woocommerce_order_items.order_id IN (" . $id_order . ") AND " . $wpdb->prefix . "woocommerce_order_items.order_item_type = 'line_item'" );
                    $total_price       = 0;
                    $total_item_number = 0;
                    $number_orders     = 0;
                    if ( !empty( $data_items ) and is_array( $data_items ) ) {
                        foreach ( $data_items as $key => $value ) {
                            $order_item_id = $value->order_item_id;
                            $data_item     = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_order_itemmeta  WHERE 1=1 AND " . $wpdb->prefix . "woocommerce_order_itemmeta.order_item_id IN (" . $order_item_id . ")" );
                            $item_id       = 0;
                            $price         = 0;
                            if ( !empty( $data_item ) ) {
                                foreach ( $data_item as $k => $v ) {
                                    if ( $v->meta_key == '_product_id' ) {
                                        $item_id = $v->meta_value;
                                    }
                                    if ( $v->meta_key == '_line_total' ) {
                                        $price = $v->meta_value;
                                    }
                                    if ( $v->meta_key == '_qty' ) {
                                        $item_number = $v->meta_value;
                                    }
                                }
                            }
                            $post_type = get_post_type( $item_id );

                            if ( !empty( $post_type ) and isset( $data[ 'post_type' ][ $post_type ] ) and isset( $array_partner[ $post_type ] ) ) {

                                $total_price += $price;
                                $total_item_number += $item_number;
                                $number_orders = 1;

                                // price by post type
                                $data[ 'post_type' ][ $post_type ][ 'ids' ][] = $item_id;
                                if ( $key == 0 ) {
                                    $data[ 'post_type' ][ $post_type ][ 'number_orders' ] += $number_orders;
                                }
                                $data[ 'post_type' ][ $post_type ][ 'number_items' ] += $item_number;
                                $data[ 'post_type' ][ $post_type ][ 'average_total' ] += $price;

                                /// price by custom date ---------------------------------------------
                                if ( $type == "15days" or $type == 'custom_date' ) {
                                    $date_create = get_the_date( "m-d-Y" );
                                    if ( isset( $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ] ) ) {
                                        $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ][ 'number_orders' ] += $number_orders;
                                        $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ][ 'number_items' ] += $item_number;
                                        $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ][ 'average_total' ] += $price;
                                    }
                                } else {
                                    /// price by year ---------------------------------------------
                                    $year_create = get_the_date( "Y" );
                                    foreach ( $data[ 'post_type' ] as $k => $v ) {
                                        if ( empty( $data[ 'post_type' ][ $k ][ 'year' ][ $year_create ] ) ) {
                                            $data[ 'post_type' ][ $k ][ 'year' ][ $year_create ] = [
                                                'number_orders' => 0,
                                                'number_items'  => 0,
                                                'average_total' => 0,
                                            ];
                                        }
                                        if ( !empty( $data[ 'post_type' ][ $k ][ 'year' ] ) ) {
                                            ksort( $data[ 'post_type' ][ $k ][ 'year' ] );
                                        }
                                    }
                                    if ( $key == 0 ) {
                                        $data[ 'post_type' ][ $post_type ][ 'year' ][ $year_create ][ 'number_orders' ] = $number_orders;
                                    }
                                    $data[ 'post_type' ][ $post_type ][ 'year' ][ $year_create ][ 'number_items' ] += $item_number;
                                    $data[ 'post_type' ][ $post_type ][ 'year' ][ $year_create ][ 'average_total' ] += $price;

                                    /// price by month ---------------------------------------------

                                    $month_create = get_the_date( "n" );
                                    if ( $key == 0 ) {
                                        $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'number_order' ] += 1;
                                    }
                                    $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'number_items' ] += $item_number;
                                    $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'average_total' ] += $price;

                                    /// price by day ---------------------------------------------
                                    $day_create = get_the_date( "j" );

                                    if ( $key == 0 ) {
                                        $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'day' ][ $day_create ][ 'number_order' ] += 1;
                                    }
                                    $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'day' ][ $day_create ][ 'number_items' ] += $item_number;
                                    $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'day' ][ $day_create ][ 'average_total' ] += $price;

                                }
                            }
                        }
                    }
                    $data[ 'number_orders' ] = $data[ 'number_orders' ] + $number_orders;
                    $data[ 'number_items' ]  = $data[ 'number_items' ] + $total_item_number;
                    $data[ 'average_total' ] = $data[ 'average_total' ] + $total_price;

                }

                wp_reset_query();

                return $data;
            }

            /*
         * since 1.1.2
         */
            static function get_default_info_reports( $type, $date_start = false, $date_end = false )
            {
                $data = [
                    'post_type'          => [
                        'st_hotel'    => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ],
                        'hotel_room'  => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ],
                        'st_rental'   => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ],
                        'st_cars'     => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ],
                        'st_activity' => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ],
                        'st_tours'    => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ],
                        'st_flight'    => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ]
                    ],
                    'number_orders'      => 0,
                    'number_items'       => 0,
                    'average_total'      => 0,
                    'average_daily_sale' => 0,
                ];
                if ( !self::_check_service_available_partner( 'st_hotel' ) ) {
                    unset( $data[ 'post_type' ][ 'st_hotel' ] );
                    unset( $data[ 'post_type' ][ 'hotel_room' ] );
                }
                if ( !self::_check_service_available_partner( 'st_rental' ) ) {
                    unset( $data[ 'post_type' ][ 'st_rental' ] );
                }
                if ( !self::_check_service_available_partner( 'st_cars' ) ) {
                    unset( $data[ 'post_type' ][ 'st_cars' ] );
                }
                if ( !self::_check_service_available_partner( 'st_tours' ) ) {
                    unset( $data[ 'post_type' ][ 'st_tours' ] );
                }
                if ( !self::_check_service_available_partner( 'st_activity' ) ) {
                    unset( $data[ 'post_type' ][ 'st_activity' ] );
                }
                if ( !self::_check_service_available_partner( 'st_flight' ) ) {
                    unset( $data[ 'post_type' ][ 'st_flight' ] );
                }

                foreach ( $data[ 'post_type' ] as $k => $v ) {

                    if ( $type != '15days' and $type != 'custom_date' ) {
                        // add 12 month
                        for ( $i = 1; $i <= 12; $i++ ) {
                            $data[ 'post_type' ][ $k ][ 'date' ][ $i ] = [
                                'number_order'  => 0,
                                'number_items'  => 0,
                                'average_total' => 0
                            ];
                            // add day
                            if ( $i == 2 )
                                $day = 28; else $day = 31;
                            for ( $j = 1; $j <= $day; $j++ ) {
                                $data[ 'post_type' ][ $k ][ 'date' ][ $i ][ 'day' ][ $j ] = [
                                    'number_order'  => 0,
                                    'number_items'  => 0,
                                    'average_total' => 0
                                ];
                            }
                        }
                    } else {
                        $number_days = STDate::date_diff( strtotime( $date_start ), strtotime( $date_end ) );
                        for ( $i = 0; $i <= $number_days; $i++ ) {
                            $next_day = date( 'm-d-Y', strtotime( $date_start . "+" . $i . " days" ) );
                            if ( empty( $data[ 'post_type' ][ $k ][ 'date' ][ $next_day ] ) ) {
                                $data[ 'post_type' ][ $k ][ 'date' ][ $next_day ] = [
                                    'number_orders' => 0,
                                    'number_items'  => 0,
                                    'average_total' => 0,
                                ];
                            }
                            $data[ 'date' ][ $next_day ] = [
                                'number_orders' => 0,
                                'number_items'  => 0,
                                'average_total' => 0,
                            ];

                        }
                    }

                }

                return $data;
            }

            /*
         * since 1.1.2
         */
            static function get_js_reports( $data_post, $type, $date_start = false, $date_end = false )
            {
                $_number_order = $data_post[ 'number_orders' ];
                $data_post     = $data_post[ 'post_type' ];
                $default       = [
                    'data_key'   => 'var data_key=[];',
                    'data_lable' => 'var data_lable=[];',
                    'data_value' => 'var data_value=[];',
                    'data_ticks' => 'var data_ticks=[];',
                ];
                if ( !empty( $data_post ) and $_number_order > 0 ) {
                    $data_lable = $data_key = $data_value = $data_ticks = "";
                    switch ( $type ) {
                        case "month":
                            foreach ( $data_post as $k => $v ) {
                                $data_date_js = "";
                                $data_ticks   = '';
                                foreach ( $v[ 'date' ] as $key => $value ) {
                                    $data_date_js .= ceil( $value[ 'average_total' ] ) . ',';
                                    $dt = DateTime::createFromFormat( '!m', $key );
                                    $dt->format( 'F' );
                                    $data_ticks .= "'" . $dt->format( 'F' ) . "',";
                                }
                                $obj = get_post_type_object( $k );
                                $data_lable .= "{label:'" . $obj->labels->singular_name . "'},";
                                $data_value .= $k . ',';
                                $data_key .= " var " . $k . " = [" . $data_date_js . "]; ";
                            }
                            $default[ 'data_key' ]   = $data_key;
                            $default[ 'data_lable' ] = "var data_lable=[" . $data_lable . "];";
                            $default[ 'data_value' ] = "var data_value=[" . $data_value . "];";
                            $default[ 'data_ticks' ] = "var data_ticks=[" . $data_ticks . "];";
                            break;
                        case "quarter":
                            foreach ( $data_post as $k => $v ) {
                                $data_date_js = "";
                                $data_ticks   = '';
                                $total_price  = 0;
                                foreach ( $v[ 'date' ] as $key => $value ) {
                                    if ( $key <= 3 ) {
                                        $total_price += ceil( $value[ 'average_total' ] );
                                        if ( $key == 3 ) {
                                            $data_date_js .= $total_price . ',';
                                            $data_ticks .= "'" . __( "Quarter 1", ST_TEXTDOMAIN ) . "',";
                                            $total_price = 0;
                                        }
                                    }
                                    if ( $key <= 6 and $key > 3 ) {
                                        $total_price += ceil( $value[ 'average_total' ] );
                                        if ( $key == 6 ) {
                                            $data_date_js .= $total_price . ',';
                                            $data_ticks .= "'" . __( "Quarter 2", ST_TEXTDOMAIN ) . "',";
                                            $total_price = 0;
                                        }
                                    }
                                    if ( $key <= 9 and $key > 6 ) {
                                        $total_price += ceil( $value[ 'average_total' ] );
                                        if ( $key == 9 ) {
                                            $data_date_js .= $total_price . ',';
                                            $data_ticks .= "'" . __( "Quarter 3", ST_TEXTDOMAIN ) . "',";
                                            $total_price = 0;
                                        }
                                    }
                                    if ( $key <= 12 and $key > 9 ) {
                                        $total_price += ceil( $value[ 'average_total' ] );
                                        if ( $key == 12 ) {
                                            $data_date_js .= $total_price . ',';
                                            $data_ticks .= "'" . __( "Quarter 4", ST_TEXTDOMAIN ) . "',";
                                            $total_price = 0;
                                        }
                                    }
                                }
                                $obj = get_post_type_object( $k );
                                $data_lable .= "{label:'" . $obj->labels->singular_name . "'},";
                                $data_value .= $k . ',';
                                $data_key .= " var " . $k . " = [" . $data_date_js . "]; ";
                            }
                            $default[ 'data_key' ]   = $data_key;
                            $default[ 'data_lable' ] = "var data_lable=[" . $data_lable . "];";
                            $default[ 'data_value' ] = "var data_value=[" . $data_value . "];";
                            $default[ 'data_ticks' ] = "var data_ticks=[" . $data_ticks . "];";
                            break;
                        case "year":
                            foreach ( $data_post as $k => $v ) {
                                $data_date_js = $total_price = "";
                                $data_ticks   = '';
                                foreach ( $v[ 'year' ] as $key => $value ) {
                                    $price = 0;
                                    if ( !empty( $value[ 'average_total' ] ) ) {
                                        $price = ceil( $value[ 'average_total' ] );
                                    }
                                    $data_date_js .= $price . ',';
                                    $data_ticks .= "'" . $key . "',";
                                }
                                $obj = get_post_type_object( $k );
                                $data_lable .= "{label:'" . $obj->labels->singular_name . "'},";
                                $data_value .= $k . ',';
                                $data_key .= " var " . $k . " = [" . $data_date_js . "]; ";
                            }
                            $default[ 'data_key' ]   = $data_key;
                            $default[ 'data_lable' ] = "var data_lable=[" . $data_lable . "];";
                            $default[ 'data_value' ] = "var data_value=[" . $data_value . "];";
                            $default[ 'data_ticks' ] = "var data_ticks=[" . $data_ticks . "];";
                            break;
                        case "15days":
                            foreach ( $data_post as $k => $v ) {
                                $data_date_js = "";
                                $data_ticks   = '';
                                foreach ( $v[ 'date' ] as $key => $value ) {
                                    $data_date_js .= ceil( $value[ 'average_total' ] ) . ',';
                                    $data_ticks .= "'" . $key . "',";
                                }
                                $obj = get_post_type_object( $k );
                                $data_lable .= "{label:'" . $obj->labels->singular_name . "'},";
                                $data_value .= $k . ',';
                                $data_key .= " var " . $k . " = [" . $data_date_js . "]; ";
                            }
                            $default[ 'data_key' ]   = $data_key;
                            $default[ 'data_lable' ] = "var data_lable=[" . $data_lable . "];";
                            $default[ 'data_value' ] = "var data_value=[" . $data_value . "];";
                            $default[ 'data_ticks' ] = "var data_ticks=[" . $data_ticks . "];";
                            break;
                        case "custom_date":
                            foreach ( $data_post as $k => $v ) {
                                $data_date_js = "";
                                $data_ticks   = '';
                                foreach ( $v[ 'date' ] as $key => $value ) {
                                    $data_date_js .= ceil( $value[ 'average_total' ] ) . ',';
                                    $data_ticks .= "'" . $key . "',";
                                }
                                $obj = get_post_type_object( $k );
                                $data_lable .= "{label:'" . $obj->labels->singular_name . "'},";
                                $data_value .= $k . ',';
                                $data_key .= " var " . $k . " = [" . $data_date_js . "]; ";
                            }
                            $default[ 'data_key' ]   = $data_key;
                            $default[ 'data_lable' ] = "var data_lable=[" . $data_lable . "];";
                            $default[ 'data_value' ] = "var data_value=[" . $data_value . "];";
                            $default[ 'data_ticks' ] = "var data_ticks=[" . $data_ticks . "];";
                            break;
                    }
                }

                return $default;
            }

            /*
        * since 1.1.2
        */
            function st_change_status_post_type_func()
            {
                $data_id      = $_REQUEST[ 'data_id' ];
                $data_id_user = $_REQUEST[ 'data_id_user' ];
                $status       = $_REQUEST[ 'status' ];
                $data_post    = get_post( $data_id );
                if ( $data_post->post_author == $data_id_user ) {
                    if ( $status == 'on' ) {
                        $_status_old = get_post_meta( $data_post->ID, '_post_status_old', true );
                        if ( empty( $_status_old ) or $_status_old == 'trash' )
                            $_status_old = 'draft';

                        $data_post->post_status = $_status_old;
                    }
                    if ( $status == 'off' ) {
                        update_post_meta( $data_post->ID, '_post_status_old', $data_post->post_status );
                        $data_post->post_status = 'trash';
                    }
                    $post = [ 'ID' => $data_post->ID, 'post_status' => $data_post->post_status ];
                    wp_update_post( $post );
                    echo json_encode( [
                        'status'      => 'true',
                        'msg'         => $data_id,
                        'type'        => 'success',
                        'content'     => 'Update successfully',
                        'data_status' => $data_post->post_status
                    ] );
                } else {
                    echo json_encode( [
                        'status'      => 'false',
                        'msg'         => $data_id,
                        'type'        => 'danger',
                        'content'     => 'Update not successfully',
                        'data_status' => $data_post->post_status
                    ] );
                }
                die();
            }

            /*
        * since 1.1.2
        */
            static function st_get_icon_status_partner( $id = false )
            {
                if ( !$id )
                    $id = get_the_ID();

                $status = get_post_status( $id );
                if ( $status == 'draft' ) {
                    $icon_class = 'status_warning fa-warning';
                }
                if ( $status == 'publish' ) {
                    $icon_class = 'status_ok  fa-check-square-o';
                }
                if ( empty( $icon_class ) ) {
                    $_status = get_post_meta( get_the_ID(), '_post_status_old', true );
                    if ( $_status == 'draft' ) {
                        $icon_class = 'status_warning fa-warning';
                    }
                    if ( $_status == 'publish' ) {
                        $icon_class = 'status_ok  fa-check-square-o';
                    }
                }
                if ( empty( $icon_class ) ) {
                    $icon_class = 'status_warning fa-warning';
                }

                return $icon_class;
            }

            /***
             *
             *
             * since 1.1.6
             */
            static function st_check_edit_partner( $id )
            {
                if ( empty( $id ) ) return false;
                $current_user = wp_get_current_user();
                $data_post    = get_post( $id );
                if ( $data_post->post_author == $current_user->ID ) {
                    return true;
                } else {
                    return false;
                }
            }

            /***
             *
             *
             * since 1.1.6
             */
            static function st_check_post_term_partner( $post_id, $taxonomy, $terms )
            {
                $is_check = false;
                if ( !empty( $post_id ) ) {
                    $my_terms = wp_get_post_terms( $post_id, $taxonomy );
                    foreach ( $my_terms as $k => $v ) {
                        if ( $terms == $v->term_id ) {
                            $is_check = true;
                        }
                    }
                }

                if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                    $array = STInput::request( 'taxonomy' );
                    $value = $terms . ',' . $taxonomy;
                    if ( in_array( $value, $array ) ) {
                        $is_check = true;
                    }

                }

                return $is_check;

            }

            /***
             *
             *
             * since 1.1.6
             */
            static function st_get_breadcrumb_partner()
            {
                $current_user = wp_get_current_user();
                $lever        = $current_user->roles;
                $lever        = array_shift( $lever );
                $default_page = "setting";
                if ( STUser_f::check_lever_partner( $lever ) and st()->get_option( 'partner_enable_feature' ) == 'on' ) {
                    $default_page = "dashboard";
                }
                $html = ' <li><i class="fa fa-home"></i><a href="' . add_query_arg( 'sc', $default_page, get_the_permalink() ) . '"> ' . __( " Home ", ST_TEXTDOMAIN ) . ' </a><i class="fa fa-angle-right"></i></li>';
                $sc   = STInput::request( 'sc' );
                switch ( $sc ) {
                    case "dashboard":
                        $html .= '<li>&nbsp;<a href="' . add_query_arg( 'sc', 'dashboard', get_the_permalink() ) . '">' . __( " Dashboard ", ST_TEXTDOMAIN ) . '</a></li>';
                        break;
                    case "dashboard-info":
                        $type          = STInput::request( 'type' );
                        $obj_post_type = get_post_type_object( $type );
                        $html .= '<li>&nbsp;' . $obj_post_type->labels->singular_name . ' ' . __( "statistics", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "overview":
                        $html .= '<li>&nbsp;' . __( " Overview ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "setting":
                        $html .= '<li>&nbsp;' . __( " Setting ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-history":
                        $html .= '<li>&nbsp;' . __( " Booking History ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "wishlist":
                        $html .= '<li>&nbsp;' . __( "Wishlist", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "reports":
                        $html .= '<li>&nbsp;' . __( "Reports", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-hotel":
                        $html .= '<li>&nbsp;' . __( "Add new Hotel", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-hotel":
                        $html .= '<li>&nbsp;' . __( "My Hotel", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-room":
                        $html .= '<li>&nbsp;' . __( "Add new room", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-room":
                        $html .= '<li>&nbsp;' . __( "My Room", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-hotel":
                        $html .= '<li>&nbsp;' . __( "Hotel Bookings", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-hotel-room":
                        $html .= '<li>&nbsp;' . __( "Room Bookings", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-rental":
                        $html .= '<li>&nbsp;' . __( "Add new rental", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-rental":
                        $html .= '<li>&nbsp;' . __( "My Rental", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-room-rental":
                        $html .= '<li>&nbsp;' . __( "Add new Rental Room", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-room-rental":
                        $html .= '<li>&nbsp;' . __( "My Rental Room", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-rental":
                        $html .= '<li>&nbsp;' . __( "Rental Bookings/Reservations", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-cars":
                        $html .= '<li>&nbsp;' . __( "Add new car", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-cars":
                        $html .= '<li>&nbsp;' . __( "Add new car", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-cars":
                        $html .= '<li>&nbsp;' . __( "Car Bookings", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-tours":
                        $html .= '<li>&nbsp;' . __( "Add new tour", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-tours":
                        $html .= '<li>&nbsp;' . __( "My Tour", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-tours":
                        $html .= '<li>&nbsp;' . __( "Tour Bookings", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-flight":
                        $html .= '<li>&nbsp;' . __( "Add new flight", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-flights":
                        $html .= '<li>&nbsp;' . __( "My Flights", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-flight":
                        $html .= '<li>&nbsp;' . __( "Flight Bookings", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-activity":
                        $html .= '<li>&nbsp;' . __( "Add new activity ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-activity":
                        $html .= '<li>&nbsp;' . __( "My Activities", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-hotel":
                        $html .= '<li>&nbsp;' . __( "Edit Hotel", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-room":
                        $html .= '<li>&nbsp;' . __( "Edit Room Hotel", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-rental":
                        $html .= '<li>&nbsp;' . __( "Edit Rental ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-room-rental":
                        $html .= '<li>&nbsp;' . __( "Edit Room Rental", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-car":
                        $html .= '<li>&nbsp;' . __( "Edit Car ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-tour":
                        $html .= '<li>&nbsp;' . __( "Edit Tour ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-activity":
                        $html .= '<li>&nbsp;' . __( "Edit Activity ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "certificate":
                        $html .= '<li>&nbsp;' . __( "Certificate ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "withdrawal":
                        $html .= '<li>&nbsp;' . __( "Withdrawal ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "withdrawal-history":
                        $html .= '<li>&nbsp;' . __( "Withdrawal History ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "list-refund":
                        $html .= '<li>&nbsp;' . __( "Refund", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    default:
                        $html .= '<li>&nbsp;' . __( "Dashboard", ST_TEXTDOMAIN ) . '</li>';
                }

                return $html;
            }

            /***
             *
             *
             * since 1.1.6
             */
            static function st_get_title_head_partner()
            {
                $html = "";
                $sc   = STInput::request( 'sc' );
                switch ( $sc ) {
                    case "dashboard":
                        $html .= __( " Dashboard ", ST_TEXTDOMAIN );
                        break;
                    case "dashboard-info":
                        $type          = STInput::request( 'type' );
                        $obj_post_type = get_post_type_object( $type );
                        $html .= $obj_post_type->labels->singular_name . ' ' . __( "statistics", ST_TEXTDOMAIN );
                        break;
                    case "overview":
                        $html .= __( " Overview ", ST_TEXTDOMAIN );
                        break;
                    case "setting":
                        $html .= __( " Setting ", ST_TEXTDOMAIN );
                        break;
                    case "booking-history":
                        $html .= __( " Booking History ", ST_TEXTDOMAIN );
                        break;
                    case "wishlist":
                        $html .= __( "Wishlist", ST_TEXTDOMAIN );
                        break;
                    case "reports":
                        $html .= __( "Reports", ST_TEXTDOMAIN );
                        break;
                    case "create-hotel":
                        $html .= __( "Add new Hotel", ST_TEXTDOMAIN );
                        break;
                    case "my-hotel":
                        $html .= __( "My Hotel", ST_TEXTDOMAIN );
                        break;
                    case "create-room":
                        $html .= __( "Add new room", ST_TEXTDOMAIN );
                        break;
                    case "my-room":
                        $html .= __( "My Room", ST_TEXTDOMAIN );
                        break;
                    case "booking-hotel":
                        $html .= __( "Hotel Bookings", ST_TEXTDOMAIN );
                        break;
                    case "create-rental":
                        $html .= __( "Add new rental", ST_TEXTDOMAIN );
                        break;
                    case "my-rental":
                        $html .= __( "My Rental", ST_TEXTDOMAIN );
                        break;
                    case "create-room-rental":
                        $html .= __( "Add new Rental Room", ST_TEXTDOMAIN );
                        break;
                    case "my-room-rental":
                        $html .= __( "My Rental Room", ST_TEXTDOMAIN );
                        break;
                    case "booking-rental":
                        $html .= __( "Rental Bookings/Reservations", ST_TEXTDOMAIN );
                        break;
                    case "create-cars":
                        $html .= __( "Add new car", ST_TEXTDOMAIN );
                        break;
                    case "my-cars":
                        $html .= __( "Add new car", ST_TEXTDOMAIN );
                        break;
                    case "booking-cars":
                        $html .= __( "Car Bookings", ST_TEXTDOMAIN );
                        break;
                    case "create-tours":
                        $html .= __( "Add new tour", ST_TEXTDOMAIN );
                        break;
                    case "my-tours":
                        $html .= __( "My Tour", ST_TEXTDOMAIN );
                        break;
                    case "booking-tours":
                        $html .= __( "Tour Bookings", ST_TEXTDOMAIN );
                        break;
                    case "create-flight":
                        $html .= __( "Add new flight", ST_TEXTDOMAIN );
                        break;
                    case "my-flights":
                        $html .= __( "My Flight", ST_TEXTDOMAIN );
                        break;
                    case "booking-flight":
                        $html .= __( "Flight Bookings", ST_TEXTDOMAIN );
                        break;
                    case "create-activity":
                        $html .= __( "Add new activity ", ST_TEXTDOMAIN );
                        break;
                    case "my-activity":
                        $html .= __( "My Activities", ST_TEXTDOMAIN );
                        break;
                    case "edit-hotel":
                        $html .= __( "Edit Hotel", ST_TEXTDOMAIN );
                        break;
                    case "edit-room":
                        $html .= __( "Edit Room Hotel", ST_TEXTDOMAIN );
                        break;
                    case "edit-rental":
                        $html .= __( "Edit Rental ", ST_TEXTDOMAIN );
                        break;
                    case "edit-room-rental":
                        $html .= __( "Edit Room Rental", ST_TEXTDOMAIN );
                        break;
                    case "edit-car":
                        $html .= __( "Edit Car ", ST_TEXTDOMAIN );
                        break;
                    case "edit-tour":
                        $html .= __( "Edit Tour ", ST_TEXTDOMAIN );
                        break;
                    case "edit-activity":
                        $html .= __( "Edit Activity ", ST_TEXTDOMAIN );
                        break;
                    case "booking-activity":
                        $html .= __( "Activity Bookings", ST_TEXTDOMAIN );
                        break;
                    default:
                        $html .= __( "Dashboard", ST_TEXTDOMAIN );
                }

                return $html;
            }

            /***
             *
             *
             * since 1.1.9
             */
            static function get_custom_date_reports_partner()
            {
                $the_week     = STUser_f::get_week_reports();
                $last_7_days  = date( 'Y-m-d', strtotime( 'today - 7 days' ) );
                $last_15_days = date( 'Y-m-d', strtotime( 'today - 15 days' ) );
                $last_60_days = date( 'Y-m-d', strtotime( 'today - 60 days' ) );
                $last_90_days = date( 'Y-m-d', strtotime( 'today - 90 days' ) );
                $yesterday    = date( 'Y-m-d', strtotime( 'today - 1 days' ) );

                $last_month_start = date( "Y-m-d", strtotime( "first day of previous month" ) );
                $last_month_end   = date( "Y-m-d", strtotime( "last day of previous month" ) );

                $_4_month_ago_start = date( "Y-m-d", strtotime( "first day of previous month - 2 month" ) );
                $_4_month_ago_end   = date( "Y-m-t" );

                return $defaut = [
                    'd'           => date( 'd' ),
                    'm'           => date( 'm' ),
                    'y'           => date( 'Y' ),
                    'last_7days'  => $last_7_days,
                    'last_15days' => $last_15_days,
                    'last_60days' => $last_60_days,
                    'last_90days' => $last_90_days,
                    'yesterday'   => $yesterday,
                    'date_now'    => date( 'Y-m-d' ),
                    'the_week'    => $the_week,
                    'last_year'   => date( "Y" ) - 1,
                    'last_month'  => [
                        'start' => $last_month_start,
                        'end'   => $last_month_end,
                    ],
                    '4_month_ago' => [
                        'start' => $_4_month_ago_start,
                        'end'   => $_4_month_ago_end,
                    ],
                ];
            }

            /***
             *
             *
             * since 1.1.9
             */
            static function _get_data_reports_partner_new( $post_type, $date_start = false, $date_end = false )
            {
                $data_items = [];
                if ( !empty( $post_type ) and is_array( $post_type ) ) {
                    $data_post_type = "";
                    foreach ( $post_type as $k => $v ) {
                        $data_post_type .= "'" . $v . "',";
                    }
                    $data_post_type = substr( $data_post_type, 0, -1 );
                    $date_start     = date( "Y-m-d", strtotime( $date_start ) );
                    $date_end       = date( "Y-m-d", strtotime( $date_end ) );
                    global $wpdb;
                    global $current_user;
                    wp_get_current_user();
                    $user_id    = $current_user->ID;
                    $sql        = "SELECT * FROM  " . $wpdb->prefix . "st_order_item_meta
                        WHERE 1=1
                        AND
                        (
                          created >= '" . $date_start . "' AND created <= '" . $date_end . "'
                        )
                        AND partner_id = " . $user_id . "
                        AND (status = 'complete' OR status = 'wc-completed' OR(status ='canceled' AND CAST(cancel_refund as UNSIGNED ) > 0 AND cancel_refund_status IN ('complete', 'pending')))
                        AND st_booking_post_type IN (" . $data_post_type . ")
                        AND st_booking_post_type != ''
                        GROUP BY wc_order_id
                ";
                    $data_items = $wpdb->get_results( $sql );
                }

                return $data_items;
            }


            /***
             *
             *
             * since 1.1.9
             */
            static function st_get_data_reports_partner( $post_type, $type_date, $date_start = false, $date_end = false )
            {
                $data = self::get_default_info_reports( $type_date, $date_start, $date_end );
                if ( $post_type == "all" ) $post_type = TravelHelper::get_all_post_type();
                if ( !empty( $post_type ) and is_array( $post_type ) ) {
                    $data_items   = self::_get_data_reports_partner_new( $post_type, $date_start, $date_end );
                    $total_price  = 0;
                    $total_orders = 0;
                    foreach ( $data_items as $k => $v ) {
                        $item_price = 0;
                        if ( !empty( $v->st_booking_post_type ) ) {

                            //  $item_price = $v->total_order;
                            $currency = TravelHelper::_get_currency_book_history( $v->order_item_id );

                            $item_price = 0;
                            if ( $v->type == 'normal_booking' ) {
                                $item_price = get_post_meta( $v->order_item_id, 'total_price', true );
                                $item_price = TravelHelper::convert_money_from_to( $item_price, $currency );
                            }
                            if ( $v->type == 'woocommerce' ) {
                                $item_price = get_post_meta( $v->wc_order_id, '_order_total', true );
                                $item_price = TravelHelper::convert_money_from_to( $item_price, $currency );
                            }

                            if ( $v->type == 'normal_booking' && $v->status == 'canceled' && (float)$v->cancel_refund > 0 && $v->cancel_refund_status == 'complete' ) {
                                $total_order    = (float)get_post_meta( $v->order_item_id, 'total_price', true );
                                $price          = $total_order - (float)$v->cancel_refund;
                                $cancel_data    = get_post_meta( $v->order_item_id, 'cancel_data', true );
                                $item_price     = TravelHelper::get_price_refund_for_partner( $price, $cancel_data , $v->commission );
                            } else {
                                $commission     = $v->commission;
                                if ( !empty( $commission ) AND (float)$commission > 0 ) {
                                    $item_price = $item_price - ( $item_price / 100 ) * (float)$commission;
                                }
                            }

                            $date_create = date( "m-d-Y", strtotime( $v->created ) );
                            if ( !empty( $data[ 'post_type' ] ) ) {
                                $data[ 'post_type' ][ $v->st_booking_post_type ][ 'ids' ][] = $v->st_booking_id;
                                $data[ 'post_type' ][ $v->st_booking_post_type ][ 'date' ][ $date_create ][ 'average_total' ] += $item_price;
                                $data[ 'post_type' ][ $v->st_booking_post_type ][ 'average_total' ] += $item_price;
                                $total_price += $item_price;


                                $data[ 'post_type' ][ $v->st_booking_post_type ][ 'date' ][ $date_create ][ 'number_orders' ] += 1;
                                $data[ 'post_type' ][ $v->st_booking_post_type ][ 'number_orders' ] += 1;
                                $total_orders += 1;

                                $data[ 'date' ][ $date_create ][ 'average_total' ] += $item_price;
                                $data[ 'date' ][ $date_create ][ 'number_orders' ] += 1;

                                $data[ 'post_type' ][ $v->st_booking_post_type ][ 'ids_orders' ][] = $v->wc_order_id;
                            }

                        }
                    }
                    $data[ 'average_total' ] = $total_price;
                    $data[ 'number_orders' ] = $total_orders;
                }

                return $data;
            }

            /***
             * SINGLE TIME
             *
             * since 1.1.9
             */
            static function st_get_data_reports_partner_info_year( $post_type )
            {
                $data_item = [];
                if ( !empty( $post_type ) ) {
                    global $wpdb;
                    global $current_user;
                    wp_get_current_user();


                    $user_id     = $current_user->ID;
                    $list_not_in = TravelHelper::get_all_post_type_not_in();
                    $sql         = "SELECT * FROM  " . $wpdb->prefix . "st_order_item_meta
                        WHERE 1=1
                        AND partner_id = " . $user_id . "
                        AND st_booking_post_type IN ('" . $post_type . "')
                        AND (status = 'complete' OR ( status = 'canceled' AND CAST( cancel_refund as UNSIGNED ) > 0 AND cancel_refund_status IN ('complete', 'pending')) )
                        AND st_booking_post_type not in {$list_not_in}
                        GROUP BY wc_order_id
                ";

                    $data_items = $wpdb->get_results( $sql );
                    if ( !empty( $data_items ) ) {
                        foreach ( $data_items as $k => $v ) {
                            //$item_price = $v->total_order;
                            $item_price = 0;
                            if ( $v->type == 'normal_booking' ) {
                                $item_price = get_post_meta( $v->order_item_id, 'total_price', true );
                            }
                            if ( $v->type == 'woocommerce' ) {
                                $item_price = get_post_meta( $v->wc_order_id, '_order_total', true );
                            }
                            if ( $v->type == 'normal_booking' && $v->status == 'canceled' && (float)$v->cancel_refund > 0 && $v->cancel_refund_status == 'complete' ) {
                                $total_order    = (float)get_post_meta( $v->order_item_id, 'total_price', true );
                                $price          = $total_order - (float)$v->cancel_refund;
                                $cancel_data    = get_post_meta( $v->order_item_id, 'cancel_data', true );
                                $item_price     = TravelHelper::get_price_refund_for_partner( $price, $cancel_data , $v->commission );
                            } else {
                                $commission     = $v->commission;
                                if ( !empty( $commission ) AND (float)$commission > 0 ) {
                                    $item_price = $item_price - ( $item_price / 100 ) * (float)$commission;
                                }
                            }
                            $date_create = date( "Y", strtotime( $v->created ) );
                            if ( empty( $data_item[ $date_create ][ 'average_total' ] ) ) $data_item[ $date_create ][ 'average_total' ] = 0;
                            if ( empty( $data_item[ $date_create ][ 'number_orders' ] ) ) $data_item[ $date_create ][ 'number_orders' ] = 0;
                            $data_item[ $date_create ][ 'average_total' ] += $item_price;
                            $data_item[ $date_create ][ 'number_orders' ] += 1;
                        }
                    }
                    ksort( $data_item );
                }

                return $data_item;
            }

            /***
             * SINGLE TIME
             *
             * since 1.1.9
             */
            static function _st_load_month_by_year_partner()
            {
                $year      = STInput::request( 'data_year' );
                $post_type = STInput::request( 'data_post_type' );
                $start     = $year . "-1-1";
                $end       = $year . "-12-31";
                global $wpdb;
                global $current_user;
                wp_get_current_user();
                $user_id     = $current_user->ID;
                $list_not_in = TravelHelper::get_all_post_type_not_in();
                $sql         = "SELECT * FROM  " . $wpdb->prefix . "st_order_item_meta
                        WHERE 1=1
                         AND
                        (
                          created >= '" . $start . "' AND created <= '" . $end . "'
                        )
                        AND partner_id = " . $user_id . "
                        AND (status = 'complete' OR ( status = 'canceled' AND CAST( cancel_refund as UNSIGNED ) > 0 AND cancel_refund_status IN ('complete', 'pending')) )
                        AND st_booking_post_type IN ('" . $post_type . "')
                        AND st_booking_post_type not in {$list_not_in}
                        GROUP BY wc_order_id
                ";
                for ( $i = 1; $i <= 12; $i++ ) {
                    $number              = sprintf( '%02d', $i );
                    $data_tmp[ $number ] = [
                        'price' => 0,
                        'order' => 0
                    ];
                }
                $data_items  = $wpdb->get_results( $sql );
                $price_total = 0;
                $order_total = 0;
                if ( !empty( $data_items ) ) {
                    foreach ( $data_items as $k => $v ) {
                        $item_price = 0;
                        if ( $v->type == 'normal_booking' ) {
                            $item_price = get_post_meta( $v->order_item_id, 'total_price', true );
                        }
                        if ( $v->type == 'woocommerce' ) {
                            $item_price = get_post_meta( $v->wc_order_id, '_order_total', true );
                        }

                        if ( $v->type == 'normal_booking' && $v->status == 'canceled' && (float)$v->cancel_refund > 0 && $v->cancel_refund_status == 'complete' ) {
                            $total_order    = (float)get_post_meta( $v->order_item_id, 'total_price', true );
                            $price          = $total_order - (float)$v->cancel_refund;
                            $cancel_data    = get_post_meta( $v->order_item_id, 'cancel_data', true );
                            $item_price     = TravelHelper::get_price_refund_for_partner( $price, $cancel_data , $v->commission );
                        } else {
                            $commission     = $v->commission;
                            if ( !empty( $commission ) AND (float)$commission > 0 ) {
                                $item_price = $item_price - ( $item_price / 100 ) * (float)$commission;
                            }
                        }

                        $date_create = date( "m", strtotime( $v->created ) );
                        $data_tmp[ $date_create ][ 'price' ] += $item_price;
                        $data_tmp[ $date_create ][ 'order' ] += 1;
                        $price_total += $item_price;
                        $order_total += 1;
                    }
                    $html       = $data_lable = $data_price = '';
                    $data_lable = $data_price = '[';
                    foreach ( $data_tmp as $k => $v ) {
                        $dt = DateTime::createFromFormat( '!m', $k );
                        if ( $v[ 'price' ] > 0 ) {
                            if ( $v[ 'price' ] == 0 ) $price = $v[ 'price' ]; else $price = TravelHelper::format_money( $price = $v[ 'price' ] );
                            $html .= '<tr>
                            <td>
                            <span class="btn_show_day_by_month_year_partner text-color" data-title="' . __( "View", ST_TEXTDOMAIN ) . '" data-loading="' . __( "Loading...", ST_TEXTDOMAIN ) . '" data-post-type="' . $post_type . '" data-year="' . $year . '" data-month="' . $k . '" >
                            ' . $dt->format( 'F' ) . '
                             </a>
                            </td>
                            <td class="text-center">' . $v[ 'order' ] . '</td>
                            <td class="text-center">' . $price . '</td>
                        </tr>';
                        }
                        $data_lable .= '"' . $dt->format( 'F' ) . '",';
                        $data_price .= '"' . $v[ 'price' ] . '",';
                    }
                    if ( $price_total > 0 ) $tmp_price = TravelHelper::format_money( $price_total ); else $tmp_price = 0;
                    $html .= '<tr class="bg-white">
                        <th>' . __( "Total", ST_TEXTDOMAIN ) . '</th>
                        <td class="text-center">' . $order_total . '</td>
                        <td class="text-center">' . $tmp_price . '</td>
                    </tr>';
                    $data_lable = substr( $data_lable, 0, -1 );
                    $data_price = substr( $data_price, 0, -1 );
                    $data_lable .= ']';
                    $data_price .= ']';
                    $json = [
                        'id_rand'  => strtotime( 'now' ),
                        'html'     => $html,
                        'js'       => [
                            'lable' => $data_lable,
                            'data'  => $data_price,
                        ],
                        'bc_title' => '<span class="btn_single_all_time">' . __( "All Time", ST_TEXTDOMAIN ) . '</span> / <span class="active">' . $year . '</span>',
                    ];
                    echo json_encode( $json );
                    die();
                }
            }

            /***
             * SINGLE TIME
             *
             * since 1.1.9
             */
            static function _st_load_day_by_month_and_year_partner()
            {
                $month     = STInput::request( 'data_month' );
                $year      = STInput::request( 'data_year' );
                $post_type = STInput::request( 'data_post_type' );

                $start = $year . "-" . $month . "-1";
                $end   = date( "Y-m-t", strtotime( $start ) );

                $data = self::st_get_data_reports_partner( [ $post_type ], 'custom_date', $start, $end );
                $data = $data[ 'post_type' ][ $post_type ];

                $html = "";
                foreach ( $data[ 'date' ] as $k => $v ) {
                    $dt = DateTime::createFromFormat( 'm-d-Y', $k );
                    if ( $v[ 'number_orders' ] > 0 ) {
                        if ( $v[ 'average_total' ] == 0 ) $price = $v[ 'average_total' ]; else $price = TravelHelper::format_money( $price = $v[ 'average_total' ] );
                        $html .= '<tr>
                            <td>' . $dt->format( 'd' ) . '</td>
                            <td class="text-center">' . $v[ 'number_orders' ] . '</td>
                            <td class="text-center">' . $price . '</td>
                          </tr>';
                    }
                }
                if ( $data[ 'average_total' ] > 0 ) $tmp_price = TravelHelper::format_money( $data[ 'average_total' ] ); else $tmp_price = 0;
                $html .= '<tr class="bg-white">
                        <th>' . __( "Total", ST_TEXTDOMAIN ) . '</th>
                        <td class="text-center">' . $data[ 'number_orders' ] . '</td>
                        <td class="text-center">' . $tmp_price . '</td>
                    </tr>';
                $data_js = STUser_f::_conver_array_to_data_js_reports( $data[ 'date' ], 'all', 'month' );
                $dt      = DateTime::createFromFormat( '!m', $month );
                echo json_encode( [
                    'js'       => $data_js,
                    'html'     => $html,
                    'bc_title' => '<span class="btn_single_all_time">' . __( "All Time", ST_TEXTDOMAIN ) . '</span> / <span class="btn_single_year">' . $year . '</span> / <span class="active">' . $dt->format( 'F' ) . '</span>',
                    'id_rand'  => strtotime( 'now' )
                ] );


                die();
            }

            /***
             * ALL TIME
             *
             * since 1.1.9
             */

            /***
             * ALL TIME
             *
             * since 1.1.9
             */
            static function st_get_data_reports_total_all_time_partner( $user_id = false )
            {
                $data = [];
                global $wpdb;
                global $current_user;
                wp_get_current_user();
                if ( empty( $user_id ) ) {
                    $user_id = $current_user->ID;
                }

                /*$year_start = date_i18n('Y',strtotime($current_user->data->user_registered));
            $year_end = date("Y");
            $number = $year_end - $year_start;
            if($number >= 0){
                $data_item[$year_start] = array('average_total'=>0,'number_orders'=>0);
                for($i=0 ; $i <= $number ; $i++){
                    $year = $year_start + $i;
                    $data['date'][$year]['average_total'] = 0;
                    $data['date'][$year]['number_orders'] = 0;
                }
            }*/
                $list_not_in = TravelHelper::get_all_post_type_not_in();
                $sql         = "SELECT * FROM  " . $wpdb->prefix . "st_order_item_meta
                    WHERE 1=1
                    AND partner_id = " . $user_id . "
                    AND (status = 'complete' OR status = 'wc-completed' OR ( status = 'canceled' AND CAST( cancel_refund as UNSIGNED ) > 0 AND cancel_refund_status IN ('complete', 'pending')) )
                    AND st_booking_post_type not in {$list_not_in}
                    GROUP BY wc_order_id";

                $data[ 'post_type' ][ 'st_hotel' ][ 'average_total' ]    = 0;
                $data[ 'post_type' ][ 'hotel_room' ][ 'average_total' ]  = 0;
                $data[ 'post_type' ][ 'st_rental' ][ 'average_total' ]   = 0;
                $data[ 'post_type' ][ 'st_cars' ][ 'average_total' ]     = 0;
                $data[ 'post_type' ][ 'st_tours' ][ 'average_total' ]    = 0;
                $data[ 'post_type' ][ 'st_activity' ][ 'average_total' ] = 0;
                $data[ 'post_type' ][ 'st_flight' ][ 'average_total' ] = 0;

                $data[ 'post_type' ][ 'st_hotel' ][ 'total' ]    = 0;
                $data[ 'post_type' ][ 'hotel_room' ][ 'total' ]  = 0;
                $data[ 'post_type' ][ 'st_rental' ][ 'total' ]   = 0;
                $data[ 'post_type' ][ 'st_cars' ][ 'total' ]     = 0;
                $data[ 'post_type' ][ 'st_tours' ][ 'total' ]    = 0;
                $data[ 'post_type' ][ 'st_activity' ][ 'total' ] = 0;
                $data[ 'post_type' ][ 'st_flight' ][ 'total' ] = 0;

                $data[ 'post_type' ][ 'st_hotel' ][ 'number_orders' ]    = 0;
                $data[ 'post_type' ][ 'hotel_room' ][ 'number_orders' ]  = 0;
                $data[ 'post_type' ][ 'st_rental' ][ 'number_orders' ]   = 0;
                $data[ 'post_type' ][ 'st_cars' ][ 'number_orders' ]     = 0;
                $data[ 'post_type' ][ 'st_tours' ][ 'number_orders' ]    = 0;
                $data[ 'post_type' ][ 'st_activity' ][ 'number_orders' ] = 0;
                $data[ 'post_type' ][ 'st_flight' ][ 'number_orders' ] = 0;

                $data[ 'average_total' ] = 0;
                $data[ 'total' ]         = 0;
                $data[ 'number_orders' ] = 0;
                $data[ 'date' ]          = [];

                $data_items = $wpdb->get_results( $sql );
                if ( !empty( $data_items ) ) {
                    foreach ( $data_items as $k => $v ) {
                        $currency = TravelHelper::_get_currency_book_history( $v->order_item_id );
                        $type_id  = $v->st_booking_post_type;
                        if ( $v->type == 'normal_booking' ) {
                            $item_price = get_post_meta( $v->order_item_id, 'total_price', true );
                            $item_price = TravelHelper::convert_money_from_to( $item_price, $currency );
                        }
                        if ( $v->type == 'woocommerce' ) {
                            $item_price = get_post_meta( $v->wc_order_id, '_order_total', true );
                            $item_price = TravelHelper::convert_money_from_to( $item_price, $currency );
                            if ( !$v->st_booking_post_type ) {
                                $type_id = get_post_type( $v->st_booking_id );
                            }
                        }
                        if ( st_check_service_available( $type_id ) ) {
                            $item_price_old = $item_price;
                            if ( $v->type == 'normal_booking' && $v->status == 'canceled' && (float)$v->cancel_refund > 0 && $v->cancel_refund_status == 'complete' ) {
                                $total_order    = (float)get_post_meta( $v->order_item_id, 'total_price', true );
                                $price          = $total_order - (float)$v->cancel_refund;
                                $item_price_old = $price;
                                $cancel_data    = get_post_meta( $v->order_item_id, 'cancel_data', true );
                                $item_price     = TravelHelper::get_price_refund_for_partner( $price, $cancel_data , $v->commission );
                            } else {
                                $commission     = $v->commission;
                                if ( !empty( $commission ) AND (float)$commission > 0 ) {
                                    $item_price = $item_price - ( $item_price / 100 ) * (float)$commission;
                                }
                            }
                            $date_create = date( "Y", strtotime( $v->created ) );
                            if ( empty( $data[ 'date' ][ $date_create ][ 'average_total' ] ) ) $data[ 'date' ][ $date_create ][ 'average_total' ] = 0;
                            if ( empty( $data[ 'date' ][ $date_create ][ 'total' ] ) ) $data[ 'date' ][ $date_create ][ 'total' ] = 0;
                            if ( empty( $data[ 'date' ][ $date_create ][ 'number_orders' ] ) ) $data[ 'date' ][ $date_create ][ 'number_orders' ] = 0;

                            $data[ 'total' ] += $item_price_old;
                            $data[ 'number_orders' ] += 1;

                            $data[ 'date' ][ $date_create ][ 'total' ] += $item_price_old;
                            $data[ 'date' ][ $date_create ][ 'number_orders' ] += 1;

                            $data[ 'post_type' ][ $type_id ][ 'total' ] += $item_price_old;
                            $data[ 'post_type' ][ $type_id ][ 'number_orders' ] += 1;

                            if ( !TravelerObject::check_cancel_able( $v->order_item_id ) ) {
                                $data[ 'average_total' ] += $item_price;
                                $data[ 'date' ][ $date_create ][ 'average_total' ] += $item_price;
                                $data[ 'post_type' ][ $type_id ][ 'average_total' ] += $item_price;
                            }
                        }
                        ksort( $data[ 'date' ] );
                    }

                    return $data;
                }

                return $data;
            }

            static function _get_total_price_split_adaptivepayment( $user_id = false )
            {
                $total_price = 0;
                global $wpdb;
                global $current_user;
                wp_get_current_user();
                if ( empty( $user_id ) ) {
                    $user_id = $current_user->ID;
                }
                $list_not_in = TravelHelper::get_all_post_type_not_in();
                $sql         = "SELECT * FROM  " . $wpdb->prefix . "st_order_item_meta
                    LEFT JOIN {$wpdb->prefix}postmeta ON {$wpdb->prefix}st_order_item_meta.order_item_id = {$wpdb->prefix}postmeta.post_id 
                    WHERE 1=1
                    AND {$wpdb->prefix}postmeta.meta_key = 'st_is_split_payment' AND {$wpdb->prefix}postmeta.meta_value = 'yes'
                    AND partner_id = " . $user_id . "
                    AND (status = 'complete' OR ( status = 'canceled' AND CAST( cancel_refund as UNSIGNED ) > 0 AND cancel_refund_status IN ('complete', 'pending')) )
                    AND st_booking_post_type not in {$list_not_in}
                    GROUP BY wc_order_id
            ";
                $data_items  = $wpdb->get_results( $sql );
                if ( !empty( $data_items ) ) {
                    foreach ( $data_items as $k => $v ) {
                        $item_price = 0;
                        $currency   = TravelHelper::_get_currency_book_history( $v->order_item_id );
                        $type_id    = $v->st_booking_post_type;
                        if ( $v->type == 'normal_booking' ) {
                            $item_price = get_post_meta( $v->order_item_id, 'total_price', true );
                            $item_price = TravelHelper::convert_money_from_to( $item_price, $currency );
                        }
                        if ( $v->type == 'woocommerce' ) {
                            $item_price = get_post_meta( $v->wc_order_id, '_order_total', true );
                            $item_price = TravelHelper::convert_money_from_to( $item_price, $currency );
                            if ( !$v->st_booking_post_type ) {
                                $type_id = get_post_type( $v->st_booking_id );
                            }
                        }
                        if ( st_check_service_available( $type_id ) ) {
                            if ( $v->type == 'normal_booking' && $v->status == 'canceled' && (float)$v->cancel_refund > 0 && $v->cancel_refund_status == 'complete' ) {
                                $total_order = (float)get_post_meta( $v->order_item_id, 'total_price', true );
                                $price       = $total_order - (float)$v->cancel_refund;
                                $cancel_data = get_post_meta( $v->order_item_id, 'cancel_data', true );
                                $commission     = $v->commission;
                                $item_price  = TravelHelper::get_price_refund_for_partner( $price, $cancel_data ,$commission);
                            } else {
                                $commission     = $v->commission;
                                if ( !empty( $commission ) AND (float)$commission > 0 ) {
                                    $item_price = $item_price - ( $item_price / 100 ) * (float)$commission;
                                }
                            }
                            $total_price += $item_price;
                        }
                    }
                }
                return $total_price;
            }


            /***
             * ALL TIME
             *
             * since 1.1.9
             */
            static function _st_load_month_all_time_by_year_partner()
            {
                $year  = STInput::request( 'data_year' );
                $start = $year . "-1-1";
                $end   = $year . "-12-31";
                global $wpdb;
                global $current_user;
                wp_get_current_user();
                $user_id     = $current_user->ID;
                $list_not_in = TravelHelper::get_all_post_type_not_in();
                $sql         = "SELECT * FROM  " . $wpdb->prefix . "st_order_item_meta
                        WHERE 1=1
                         AND
                        (
                          created >= '" . $start . "' AND created <= '" . $end . "'
                        )
                        AND partner_id = " . $user_id . "
                        AND (status = 'complete' OR ( status = 'canceled' AND CAST( cancel_refund as UNSIGNED ) > 0 AND cancel_refund_status IN ('complete', 'pending')) )
                        AND st_booking_post_type not in {$list_not_in}
                        GROUP BY wc_order_id
                ";
                for ( $i = 1; $i <= 12; $i++ ) {
                    $number              = sprintf( '%02d', $i );
                    $data_tmp[ $number ] = [
                        'price' => 0,
                        'order' => 0
                    ];
                }
                $data_items  = $wpdb->get_results( $sql );
                $price_total = 0;
                $order_total = 0;
                if ( !empty( $data_items ) ) {
                    foreach ( $data_items as $k => $v ) {
                        //$item_price = $v->total_order;
                        $item_price = 0;
                        if ( $v->type == 'normal_booking' ) {
                            $item_price = get_post_meta( $v->order_item_id, 'total_price', true );
                        }
                        if ( $v->type == 'woocommerce' ) {
                            $item_price = get_post_meta( $v->wc_order_id, '_order_total', true );
                        }

                        if ( $v->type == 'normal_booking' && $v->status == 'canceled' && (float)$v->cancel_refund > 0 && $v->cancel_refund_status == 'complete' ) {
                            $total_order    = (float)get_post_meta( $v->order_item_id, 'total_price', true );
                            $price          = $total_order - (float)$v->cancel_refund;
                            $cancel_data    = get_post_meta( $v->order_item_id, 'cancel_data', true );
                            $item_price     = TravelHelper::get_price_refund_for_partner( $price, $cancel_data , $v->commission );
                        } else {
                            $commission     = $v->commission;
                            if ( !empty( $commission ) AND (float)$commission > 0 ) {
                                $item_price = $item_price - ( $item_price / 100 ) * (float)$commission;
                            }
                        }


                        $date_create = date( "m", strtotime( $v->created ) );
                        $data_tmp[ $date_create ][ 'price' ] += $item_price;
                        $data_tmp[ $date_create ][ 'order' ] += 1;

                        $price_total += $item_price;
                        $order_total += 1;
                    }
                }
                $html       = $data_lable = $data_price = '';
                $data_lable = $data_price = '[';

                foreach ( $data_tmp as $k => $v ) {

                    $dt = DateTime::createFromFormat( '!m', $k );
                    if ( $v[ 'price' ] > 0 ) {
                        if ( $v[ 'price' ] == 0 ) $price = $v[ 'price' ]; else $price = TravelHelper::format_money( $price = $v[ 'price' ] );
                        $html .= '<tr>
                            <td>
                            <span class="btn_all_time_show_day_by_month_year_partner text-color" data-title="' . __( "View", ST_TEXTDOMAIN ) . '" data-loading="' . __( "Loading...", ST_TEXTDOMAIN ) . '"  data-year="' . $year . '" data-month="' . $k . '" >
                            ' . $dt->format( 'F' ) . '
                             </span>
                            </td>
                            <td class="text-center">' . $v[ 'order' ] . '</td>
                            <td class="text-center">' . $price . '</td>
                        </tr>';
                    }
                    $data_lable .= '"' . $dt->format( 'F' ) . '",';
                    $data_price .= '"' . $v[ 'price' ] . '",';
                }

                if ( $price_total > 0 ) $tmp_price = TravelHelper::format_money( $price_total ); else $tmp_price = 0;
                $html .= '<tr class="bg-white">
                        <th>' . __( "Total", ST_TEXTDOMAIN ) . '</th>
                        <td class="text-center">' . $order_total . '</td>
                        <td class="text-center">' . $tmp_price . '</td>
                    </tr>';

                $data_lable = substr( $data_lable, 0, -1 );
                $data_price = substr( $data_price, 0, -1 );
                $data_lable .= ']';
                $data_price .= ']';
                $json = [
                    'id_rand'  => strtotime( 'now' ),
                    'html'     => $html,
                    'js'       => [
                        'lable' => $data_lable,
                        'data'  => $data_price,
                    ],
                    'bc_title' => '<span class="btn_all_time">' . __( "All Time", ST_TEXTDOMAIN ) . '</span> / <span class="active">' . $year . '</span>',
                ];
                echo json_encode( $json );
                die();
            }

            /***
             * ALL TIME
             *
             * since 1.1.9
             */
            static function _st_load_day_all_time_by_month_and_year_partner()
            {
                $month = STInput::request( 'data_month' );
                $year  = STInput::request( 'data_year' );
                $start = $year . "-" . $month . "-1";
                $end   = date( "Y-m-t", strtotime( $start ) );
                $data  = self::st_get_data_reports_partner( 'all', 'custom_date', $start, $end );

                $html = "";
                foreach ( $data[ 'date' ] as $k => $v ) {
                    $dt = DateTime::createFromFormat( 'm-d-Y', $k );
                    if ( $v[ 'number_orders' ] > 0 ) {
                        if ( $v[ 'average_total' ] == 0 ) $price = $v[ 'average_total' ]; else $price = TravelHelper::format_money( $price = $v[ 'average_total' ] );
                        $html .= '<tr>
                             <td>' . $dt->format( 'd' ) . '</td>
                             <td class="text-center">' . $v[ 'number_orders' ] . '</td>
                             <td class="text-center">' . $price . '</td>
                          </tr>';
                    }
                }
                if ( $data[ 'average_total' ] > 0 ) $tmp_price = TravelHelper::format_money( $data[ 'average_total' ] ); else $tmp_price = 0;
                $html .= '<tr class="bg-white">
                        <th>' . __( "Total", ST_TEXTDOMAIN ) . '</th>
                        <td class="text-center">' . $data[ 'number_orders' ] . '</td>
                        <td class="text-center">' . $tmp_price . '</td>
                    </tr>';
                $data_js = STUser_f::_conver_array_to_data_js_reports( $data[ 'date' ], 'all', 'month' );
                $dt      = DateTime::createFromFormat( '!m', $month );
                echo json_encode( [
                    'js'       => $data_js,
                    'html'     => $html,
                    'bc_title' => '<span class="btn_all_time">' . __( "All Time", ST_TEXTDOMAIN ) . '</span> / <span class="btn_all_time_year">' . $year . '</span> / <span class="active">' . $dt->format( 'F' ) . '</span>',
                    'id_rand'  => strtotime( 'now' )
                ] );
                die();
            }

            /***
             *
             *
             * since 1.1.9
             */
            static function get_request_custom_date_partner()
            {
                $data             = [];
                $start_date_month = date( 'Y' ) . '-' . date( 'm' ) . '-01';
                $end_date_month   = date( 'Y' ) . '-' . date( 'm' ) . '-' . date( 't' );

                $request_type = STInput::request( 'custom_select_date', 'this_month|' . $start_date_month . '|' . $end_date_month );
                $request_type = explode( "|", $request_type );
                if ( !empty( $request_type ) ) {
                    if ( $request_type[ 0 ] == 'custom_date' ) {
                        $start = STInput::request( 'date_start' );
                        if ( empty( $start ) ) $start = $start_date_month;
                        $end = STInput::request( 'date_end' );
                        if ( empty( $end ) ) $end = $end_date_month;
                        $data = [
                            'type'  => $request_type[ 0 ],
                            'start' => $start,
                            'end'   => $end,
                        ];
                    } else {
                        $data = [
                            'type'  => $request_type[ 0 ],
                            'start' => $request_type[ 1 ],
                            'end'   => $request_type[ 2 ],
                        ];
                    }
                }
                if ( STInput::request( 'sc' ) == 'dashboard-info' ) {
                    $start = date( "Y" ) . '-1-1';
                    $end   = date( "Y" ) . '-12-31';
                    $data  = [
                        'type'  => 'this_year',
                        'start' => $start,
                        'end'   => $end,
                    ];
                }
                switch ( $data[ 'type' ] ) {
                    case "this_year":
                        $data[ 'title' ] = __( "this year", ST_TEXTDOMAIN );
                        break;
                    case "this_month":
                        $data[ 'title' ] = __( "this month", ST_TEXTDOMAIN );
                        break;
                    case "this_week":
                        $data[ 'title' ] = __( "this week", ST_TEXTDOMAIN );
                        break;
                    case "all_time":
                        $data[ 'title' ] = __( "all time", ST_TEXTDOMAIN );
                        break;
                    case "custom_date":
                    default:
                        $data[ 'title' ] = date_i18n( TravelHelper::getDateFormat(), strtotime( $data[ 'start' ] ) ) . ' - ' . date_i18n( TravelHelper::getDateFormat(), strtotime( $data[ 'end' ] ) );
                        $data[ 'start' ] = TravelHelper::convertDateFormat( $data[ 'start' ] );
                        $data[ 'end' ]   = TravelHelper::convertDateFormat( $data[ 'end' ] );
                        break;
                }

                return $data;
            }

            /***
             *
             *
             * since 1.1.9
             */
            static function _conver_array_to_data_js_reports( $array_php, $type_post_type, $type_date )
            {
                if ( empty( $array_php ) or !is_array( $array_php ) ) return;
                $total_price    = 0;
                $number_orders  = 0;
                $data_lable     = '[';
                $data_price     = '[';
                $data_array_php = [];
                if ( empty( $array_php ) ) $array_php = [];
                if ( $type_post_type == "all" ) {
                    if ( $type_date == 'this_year' ) {
                        /* show month */
                        $data_tmp = [ '01' => [ 'average_total' => 0, 'number_orders' => 0 ], '02' => [ 'average_total' => 0, 'number_orders' => 0 ], '03' => [ 'average_total' => 0, 'number_orders' => 0 ], '04' => [ 'average_total' => 0, 'number_orders' => 0 ], '05' => [ 'average_total' => 0, 'number_orders' => 0 ], '06' => [ 'average_total' => 0, 'number_orders' => 0 ], '07' => [ 'average_total' => 0, 'number_orders' => 0 ], '08' => [ 'average_total' => 0, 'number_orders' => 0 ], '09' => [ 'average_total' => 0, 'number_orders' => 0 ], '10' => [ 'average_total' => 0, 'number_orders' => 0 ], '11' => [ 'average_total' => 0, 'number_orders' => 0 ], '12' => [ 'average_total' => 0, 'number_orders' => 0 ] ];
                        foreach ( $array_php as $k => $v ) {
                            $date = explode( '-', $k );
                            $data_tmp[ $date[ 0 ] ][ 'average_total' ] += $v[ 'average_total' ];
                            $data_tmp[ $date[ 0 ] ][ 'number_orders' ] += $v[ 'number_orders' ];
                        }
                        foreach ( $data_tmp as $k => $v ) {
                            $dt = DateTime::createFromFormat( '!m', $k );
                            $data_lable .= '"' . $dt->format( 'F' ) . '",';
                            $data_price .= '"' . $v[ 'average_total' ] . '",';

                            if ( $v[ 'number_orders' ] > 0 ) {
                                $data_array_php[ $k ][ 'title' ]         = $dt->format( 'F' );
                                $data_array_php[ $k ][ 'average_total' ] = $v[ 'average_total' ];
                                $data_array_php[ $k ][ 'number_orders' ] = $v[ 'number_orders' ];
                                $total_price += $v[ 'average_total' ];
                                $number_orders += $v[ 'number_orders' ];
                            }

                        }
                        $data_lable = substr( $data_lable, 0, -1 );
                        $data_price = substr( $data_price, 0, -1 );
                    } elseif ( $type_date == 'year' ) {
                        /* show year */
                        foreach ( $array_php as $k => $v ) {
                            $data_lable .= '"' . $k . '",';
                            $data_price .= '"' . $v[ 'average_total' ] . '",';

                            if ( $v[ 'number_orders' ] > 0 ) {
                                $data_array_php[ $k ][ 'title' ]         = $k;
                                $data_array_php[ $k ][ 'average_total' ] = $v[ 'average_total' ];
                                $data_array_php[ $k ][ 'number_orders' ] = $v[ 'number_orders' ];
                                $total_price += $v[ 'average_total' ];
                                $number_orders += $v[ 'number_orders' ];
                            }

                        }
                        $data_lable = substr( $data_lable, 0, -1 );
                        $data_price = substr( $data_price, 0, -1 );
                    } else {
                        /* show custom date */
                        foreach ( $array_php as $k => $v ) {
                            $date_tmp = explode( '-', $k );
                            $date     = $date_tmp[ 1 ]/*."/".$date[0]."/".$date[2]*/
                            ;
                            $data_lable .= '"' . $date . '",';
                            $data_price .= '"' . $v[ 'average_total' ] . '",';


                            $start = strtotime( $date_tmp[ 1 ] . "-" . $date_tmp[ 0 ] . "-" . $date_tmp[ 2 ] );
                            $end   = strtotime( date( 'd-m-Y' ) );
                            if ( $start <= $end ) {
                                if ( $v[ 'number_orders' ] > 0 ) {
                                    $data_array_php[ $k ][ 'title' ]         = date_i18n( 'l, d', $start );
                                    $data_array_php[ $k ][ 'average_total' ] = $v[ 'average_total' ];
                                    $data_array_php[ $k ][ 'number_orders' ] = $v[ 'number_orders' ];
                                    $total_price += $v[ 'average_total' ];
                                    $number_orders += $v[ 'number_orders' ];
                                }

                            }
                        }
                        $data_lable = substr( $data_lable, 0, -1 );
                        $data_price = substr( $data_price, 0, -1 );
                    }
                }
                if ( $type_post_type == "custom" ) {

                }
                $data_lable .= ']';
                $data_price .= ']';
                $data_array = [
                    'lable'          => $data_lable,
                    'data'           => $data_price,
                    'data_array_php' => $data_array_php,
                    'info_total'     => [
                        'average_total' => $total_price,
                        'number_orders' => $number_orders,
                    ]
                ];

                return $data_array;
            }


            static function _cancel_booking( $order_id )
            {
                $check_cancel_able = TravelerObject::check_cancel_able( $order_id );

                if ( $check_cancel_able ) {
                    global $wpdb;
                    $user_id       = get_current_user_id();
                    $order_item_id = $order_id;

                    $check_order = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}st_order_item_meta where user_id={$user_id} and  order_item_id = {$order_item_id} and `status`!='canceled' and `status`!='wc-canceled' LIMIT 0,1" );

                    if ( $check_order ) {
                        $item_id = $check_order->st_booking_id;
                        if ( $check_order->room_id ) $item_id = $check_order->room_id;
                        $cancel_percent = get_post_meta( $item_id, 'st_cancel_percent', true );

                        $query = "UPDATE {$wpdb->prefix}st_order_item_meta set `status`='canceled' , cancel_percent={$cancel_percent} where order_item_id={$order_item_id}";

                        $wpdb->query( $query );

                        update_post_meta( $order_item_id, 'status', 'canceled' );

                        return true;
                    }
                } else {
                    return false;
                }
            }

            static function get_history_bookings( $type = "st_hotel", $offset, $limit, $author = false )
            {
                global $wpdb;
                $querystr  = "
                            SELECT SQL_CALC_FOUND_ROWS * FROM (
                                           SELECT  *  FROM  " . $wpdb->prefix . "st_order_item_meta
                                                                WHERE 1=1
                                                                AND partner_id = " . $author . "
                                                                AND st_booking_post_type IN ('" . $type . "')
                                                                GROUP BY wc_order_id

                            ) AS tmp_table ORDER BY id DESC LIMIT {$offset},{$limit}
                ";
                $pageposts = $wpdb->get_results( $querystr, OBJECT );

                return [ 'total' => $wpdb->get_var( "SELECT FOUND_ROWS();" ), 'rows' => $pageposts ];
            }

            static function _check_service_available_partner( $post_type, $user_id = false )
            {
                if ( !empty( $user_id ) ) {
                    $current_user = new WP_User( $user_id );
                    $role         = $current_user->roles;
                    $role         = array_shift( $role );
                } else {
                    $current_user = wp_get_current_user();
                    $user_id      = $current_user->ID;
                    $role         = $current_user->roles;
                    $role         = array_shift( $role );
                }
                if ( st_check_service_available( $post_type ) ) {
                    if ( $role == 'administrator' || $role == 'partner' ) {
                        return true;
                    }

                    return false;
                }

                return false;
            }

            static function _get_service_available()
            {

                $data = [];

                if ( st_check_service_available( 'st_hotel' ) ) {
                    $data [] = 'st_hotel';
                }
                if ( st_check_service_available( 'st_rental' ) ) {
                    $data [] = 'st_rental';
                }
                if ( st_check_service_available( 'st_tours' ) ) {
                    $data [] = 'st_tours';
                }
                if ( st_check_service_available( 'st_cars' ) ) {
                    $data [] = 'st_cars';
                }
                if ( st_check_service_available( 'st_activity' ) ) {
                    $data [] = 'st_activity';
                }

                return $data;
            }

            static function check_lever_service_partner( $sc, $lever )
            {
                if ( $lever == 'administrator' ) {
                    return true;
                }
                switch ( $sc ) {
                    case "create-hotel":
                    case "my-hotel":
                    case "create-room":
                    case "my-room":
                    case "booking-hotel":
                    case "edit-hotel":
                    case "edit-room":
                        if ( STUser_f::_check_service_available_partner( 'st_hotel' ) )
                            return true;
                        break;
                    case "create-rental":
                    case "my-rental":
                    case "create-room-rental":
                    case "my-room-rental":
                    case "booking-rental":
                    case "edit-rental":
                    case "edit-room-rental":
                        if ( STUser_f::_check_service_available_partner( 'st_rental' ) )
                            return true;
                        break;
                    case "create-cars":
                    case "edit-car":
                    case "my-cars":
                    case "booking-cars":
                        if ( STUser_f::_check_service_available_partner( 'st_cars' ) )
                            return true;
                        break;
                    case "create-tours":
                    case "edit-tour":
                    case "my-tours":
                    case "booking-tours":
                        if ( STUser_f::_check_service_available_partner( 'st_tours' ) )
                            return true;
                        break;
                    case "create-activity":
                    case "edit-activity":
                    case "my-activity":
                    case "booking-activity":
                        if ( STUser_f::_check_service_available_partner( 'st_activity' ) )
                            return true;
                        break;
                    case "create-flight":
                    case "edit-flight":
                    case "my-flights":
                    case "booking-flight":
                        if ( STUser_f::_check_service_available_partner( 'st_flight' ) )
                            return true;
                        break;
                    case "list-refund":
                            return false;
                        break;

                    default:
                        return true;
                }
            }

            static function _get_list_item_service_available( $post_type = "st_hotel", $user_id, $page = 1 )
            {

                $st_post_type     = STInput::request( 'data_post_type', $post_type );
                $st_user_id       = STInput::request( 'data_user_id', $user_id );
                $st_page          = STInput::request( 'data_page', $page );
                $st_ajax          = STInput::request( 'st_ajax' );
                $arg              = [
                    'post_type'      => $st_post_type,
                    'posts_per_page' => '5',
                    'paged'          => $st_page,
                    'author'         => $st_user_id
                ];
                $result[ 'data' ] = "";
                global $wp_query;
                query_posts( $arg );
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        switch ( $st_post_type ) {
                            case"st_hotel":
                                $result[ 'data' ] .= st()->load_template( 'hotel/loop', 'list', [ "taxonomy" => [] ] );
                                break;
                            case"st_rental":
                                $result[ 'data' ] .= st()->load_template( 'hotel/loop', 'list' );
                                break;
                            case"st_cars":
                                $result[ 'data' ] .= st()->load_template( 'cars/elements/loop/loop-1' );
                                break;
                            case"st_tours":
                                $result[ 'data' ] .= st()->load_template( 'tours/elements/loop/loop-1' );
                                break;
                            case"st_activity":
                                $result[ 'data' ] .= st()->load_template( 'activity/elements/loop/loop-1' );
                                break;
                        }
                    }
                }
                $result[ 'paging' ] = TravelHelper::paging_single_partner( '', $st_user_id ) . '<img class="ajax_loader" src="' . admin_url( "/images/wpspin_light.gif" ) . '" style="display: none;" alt="' . TravelHelper::get_alt_image() . '">';
                wp_reset_query();

                if ( $st_ajax == '1' ) {
                    echo json_encode( $result );
                    die();
                } else {
                    return $result;
                }
            }


            //version 1.2.9
            function _st_login_popup()
            {
                $creds                    = [];
                $creds[ 'user_login' ]    = STInput::post( 'user_login' );
                $creds[ 'user_password' ] = STInput::post( 'user_password' );
                $creds[ 'remember' ]      = true;
                $user                     = wp_signon( $creds, true );
                if ( is_wp_error( $user ) ) {
                    if ( $user->get_error_message() != "" ) {
                        $status_error_login = '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                        if ( $user->get_error_code() == "incorrect_password" ) {
                            $status_error_login .= sprintf( __( "The password you entered for the username <strong>%s</strong> is incorrect.", ST_TEXTDOMAIN ), $creds[ 'user_login' ] );
                        }
                        if ( $user->get_error_code() == "invalid_username" ) {
                            $status_error_login .= __( "Invalid username.", ST_TEXTDOMAIN );
                        }
                        if ( $user->get_error_code() == "empty_password" ) {
                            $status_error_login .= __( "The password field is empty.", ST_TEXTDOMAIN );
                        }
                        if ( $user->get_error_code() == "empty_username" ) {
                            $status_error_login .= __( "The username field is empty.", ST_TEXTDOMAIN );
                        }
                        $status_error_login .= ' </div>';
                    }
                }
                if ( empty( $creds[ 'user_login' ] ) and empty( $creds[ 'user_password' ] ) ) {
                    $status_error_login = '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                    $status_error_login .= '<strong>' . __( 'ERROR', ST_TEXTDOMAIN ) . '</strong>: ' . __( 'The username and password field is empty', ST_TEXTDOMAIN );
                    $status_error_login .= ' </div>';
                }
                $need_link   = '';
                $check_error = true;
                if ( !is_wp_error( $user ) ) {
                    $userID = $user->ID;

                    wp_set_current_user( $userID, $user->user_email );
                    wp_set_auth_cookie( $userID, true, false );
                    do_action( 'wp_login', $user->user_email );

                    $check_error  = false;
                    $page_login   = ( st()->get_option( 'page_redirect_to_after_login' ) );
                    $url_redirect = ( STInput::request( 'st_url_redirect' ) );
                    $url          = ( STInput::request( 'url' ) );
                    $need_link    = home_url();
                    if ( !empty( $page_login ) ) $need_link = get_permalink( $page_login );
                    if ( !empty( $url_redirect ) ) $need_link = urldecode( $url_redirect );
                    if ( !empty( $url ) ) $need_link = get_permalink( $url );
                }
                echo json_encode( [ 'error' => $check_error, 'message' => $status_error_login, 'need_link' => $need_link ] );
                unset( $status_error_login );
                die();

            }

            //version 1.2.9
            function _st_registration_popup()
            {
                $userdata = [
                    'user_login' => esc_attr( $_REQUEST[ 'user_name' ] ),
                    'user_email' => esc_attr( $_REQUEST[ 'email' ] ),
                    'user_pass'  => esc_attr( $_REQUEST[ 'password' ] ),
                    'first_name' => esc_attr( $_REQUEST[ 'full_name' ] ),
                ];

                $notice = '';
                $error  = true;

                if ( is_wp_error( self::validation() ) ) {
                    $notice .= '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                    $notice .= '<strong>' . self::validation()->get_error_message() . '</strong>';
                    $notice .= '</div>';
                } else {
                    $register_user = wp_insert_user( $userdata );
                    wp_new_user_notification( $register_user, null, 'user' );
                    if ( !is_wp_error( $register_user ) ) {
                        $class_user = new STUser_f();
                        $notice .= $class_user->_update_info_user( $register_user, false );
                        $error = false;

                    } else {
                        $notice .= '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                        $notice .= '<strong>' . $register_user->get_error_message() . '</strong>';
                        $notice .= '</div>';
                    }
                }

                echo json_encode( [ 'error' => $error, 'notice' => $notice ] );
                die;
            }
            static function _is_user_partner($user_id=false){
                if(empty($user_id)) $user_id = get_current_user_id();
                $user_info = get_userdata($user_id);
                if(!empty($user_info)) {
                    $roles = $user_info->roles;
                    if (is_array($roles) and in_array('partner', $roles)) {
                        return true;
                    }
                }
                return false;
            }
        }



        $user = new STUser_f();
        $user->init();
    }
