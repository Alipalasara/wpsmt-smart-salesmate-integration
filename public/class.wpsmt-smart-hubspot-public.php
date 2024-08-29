<?php
class WPSMT_Smart_Salesmate_Public {
  
    public function __construct() {
        
        $this->loadCustomerAction();
        $this->loadOrderAction();
        $this->loadProductAction();
    }


    private function loadCustomerAction() {
        add_action( 'user_register', array($this, 'addUserToSalesmate') );
        add_action( 'profile_update', array($this, 'addUserToSalesmate'), 10, 1 );
        add_action( 'woocommerce_update_customer', array($this, 'addUserToSalesmate'), 10, 1 );
    }


    private function loadOrderAction() {
        add_action( 'save_post', array( $this, 'addOrderToSalesmate' ), 10, 1 );
        add_action('woocommerce_thankyou', array( $this, 'addOrderToSalesmate' ), 10, 1);
    }


    private function loadProductAction() {
        add_action( 'woocommerce_update_product', array( $this, 'addProductToSalesmate' ), 10, 1 );
    }

    public function addUserToSalesmate( $user_id ){
        global $wpdb;
        $data       = array();
        $user_info  = get_userdata($user_id);

        $default_wp_module = "customers";

        $wpsmt_smart_salesmate_settings = get_option( 'wpsmt_smart_salesmate_settings' );
        $synch_settings         = !empty( $wpsmt_smart_salesmate_settings['synch'] ) ? $wpsmt_smart_salesmate_settings['synch'] : array();

        foreach ($synch_settings as $wp_salesmate_module => $enable) {
            
            $wp_salesmate_module = explode('_', $wp_salesmate_module);
            $wp_module      = $wp_salesmate_module[0];
            $salesmate_module    = $wp_salesmate_module[1];

            if($default_wp_module == $wp_module){
                
                $get_salesmate_field_mapping = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}smart_salesmate_field_mapping WHERE wp_module ='".$wp_module."' AND salesmate_module = '".$salesmate_module."' AND status='active'");

                foreach ($get_salesmate_field_mapping as $key => $value) {
                    $wp_field   = $value->wp_field;
                    $salesmate_field = $value->salesmate_field;

                    if ( $salesmate_field ) {
                        if ( isset( $user_info->{$wp_field} ) ) {
                            if ( is_array( $user_info->{$wp_field} ) ) {
                                $user_info->{$wp_field} = implode(';', $user_info->{$wp_field} );
                            }
                            $data[$salesmate_module][$salesmate_field] = strip_tags( $user_info->{$wp_field} );
                        }
                    }
                }
            }   
        }

        if( $data != null ){
            $this->prepareAndActionOnData( $user_id, $data, $default_wp_module );
        }
    }


    public function addOrderToSalesmate( $order_id ){
        global $wpdb, $post_type; 
        $data       = array();

        if ( get_post_type( $order_id ) !== 'shop_order' ){
            return;
        }

        $order = wc_get_order( $order_id );
        
        $default_wp_module = "orders";

        $wpsmt_smart_salesmate_settings = get_option( 'wpsmt_smart_salesmate_settings' );
        $synch_settings         = !empty( $wpsmt_smart_salesmate_settings['synch'] ) ? $wpsmt_smart_salesmate_settings['synch'] : array();

        foreach ($synch_settings as $wp_salesmate_module => $enable) {
            
            $wp_salesmate_module = explode('_', $wp_salesmate_module);
            $wp_module      = $wp_salesmate_module[0];
            $salesmate_module    = $wp_salesmate_module[1];

            if($default_wp_module == $wp_module){
                
                $get_salesmate_field_mapping = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}smart_salesmate_field_mapping WHERE wp_module ='".$wp_module."' AND salesmate_module = '".$salesmate_module."' AND status='active'");

                foreach ($get_salesmate_field_mapping as $key => $value) {
                    $wp_field   = $value->wp_field;
                    $salesmate_field = $value->salesmate_field;

                    if ( $salesmate_field ) {

                        if ( null !== $order->{$wp_field}() ) {
                            $data[$salesmate_module][$salesmate_field] = strip_tags( $order->{$wp_field}() );
                        }
                    }
                }
            }   
        }
        
        if( $data != null ){
            $this->prepareAndActionOnData( $order_id, $data, $default_wp_module );
        }
    }


    public function addProductToSalesmate( $post_id ){
        global $wpdb, $post_type, $data; 
        $data = array();

        if ( get_post_type( $post_id ) !== 'product' ){
            return;
        }
        
        $product = wc_get_product( $post_id );

        $default_wp_module = "products";

        $wpsmt_smart_salesmate_settings = get_option( 'wpsmt_smart_salesmate_settings' );
        $synch_settings         = !empty( $wpsmt_smart_salesmate_settings['synch'] ) ? $wpsmt_smart_salesmate_settings['synch'] : array();

        foreach ($synch_settings as $wp_salesmate_module => $enable) {
            
            $wp_salesmate_module = explode('_', $wp_salesmate_module);
            $wp_module      = $wp_salesmate_module[0];
            $salesmate_module    = $wp_salesmate_module[1];

            if($default_wp_module == $wp_module){
                
                $get_salesmate_field_mapping = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}smart_salesmate_field_mapping WHERE wp_module ='".$wp_module."' AND salesmate_module = '".$salesmate_module."' AND status='active'");

                foreach ($get_salesmate_field_mapping as $key => $value) {
                    $wp_field   = $value->wp_field;
                    $salesmate_field = $value->salesmate_field;

                    if ( $salesmate_field ) {

                        if ( null !== $product->{$wp_field}() ) {
                            if(is_array($product->{$wp_field}())){
                                $data[$salesmate_module][$salesmate_field] = implode(',', $product->{$wp_field}());
                            }else{
                                $data[$salesmate_module][$salesmate_field] = strip_tags( $product->{$wp_field}() );    
                            }
                        }
                    }
                }
            }   
        }

        if($data != null ){
            $this->prepareAndActionOnData( $post_id, $data, $default_wp_module );
        }
    }


    public function prepareAndActionOnData($id, $data = array(), $default_wp_module = NULL){
        
        if( $default_wp_module == 'orders' ||  $default_wp_module == 'products' ){
            $smart_salesmate_relation = get_post_meta( $id, 'smart_salesmate_relation', true );
        }else{
            $smart_salesmate_relation = get_user_meta( $id, 'smart_salesmate_relation', true );    
        }
        

        if ( ! is_array( $smart_salesmate_relation ) ) {
            $smart_salesmate_relation = array();
        }

        $salesmate_api_obj   = new WPSMT_Smart_Salesmate_API();
        
        foreach ($data as $salesmate_module => $salesmate_data) {
            
            $record_id = ( isset( $smart_salesmate_relation[$salesmate_module] ) ? $smart_salesmate_relation[$salesmate_module] : 0 );

            if ( $record_id ) {
                $response = $salesmate_api_obj->updateRecord($salesmate_module, $salesmate_data, $record_id);
            }else{
                $response = $salesmate_api_obj->addRecord($salesmate_module, $salesmate_data);
            }

            if ( isset( $response->data[0]->details->id ) ) {
                $record_id = $response->data[0]->details->id;
                $smart_salesmate_relation[$salesmate_module] = $record_id;
            }
        }

        if( $default_wp_module == 'orders' ||  $default_wp_module == 'products' ){
            update_post_meta( $id, 'smart_salesmate_relation', $smart_salesmate_relation );
        }else{
            update_user_meta( $id, 'smart_salesmate_relation', $smart_salesmate_relation );    
        }
        
    }
}

new WPSMT_Smart_Salesmate_Public();
?>