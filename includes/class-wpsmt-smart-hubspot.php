<?php
class WPSMT_Smart_Salesmate {

	protected $plugin_name;

	protected $version;

	public function __construct() {
		$this->version = '1.0.0';
		$this->plugin_name = 'wpsmt-smart-salesmate';
	}

	public function run() {
		/*
			Load all class files
		*/
		require_once WPSMT_PLUGIN_PATH . 'includes/class-wpsmt-smart-salesmate-api.php';
        require_once WPSMT_PLUGIN_PATH . 'admin/class.wpsmt-smart-salesmate-admin.php';
		require_once WPSMT_PLUGIN_PATH . 'public/class.wpsmt-smart-salesmate-public.php';
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}
	
	public function get_version() {
		return $this->version;
	}

	public function get_wp_modules(){
		return array(
                'customers' => esc_html__('Customers','wpsmt-smart-salesmate'),
                'orders'    => esc_html__('Orders','wpsmt-smart-salesmate'),
                'products'  => esc_html__('Products','wpsmt-smart-salesmate'),
            );
	}

	public function get_salesmate_modules(){

		$salesmate_api_obj   = new WPSMT_Smart_Salesmate_API();
       
        /*get list modules*/
        $getListModules = $salesmate_api_obj->getListModules();
        
        return $getListModules;
	}

	public static function get_customer_fields(){
    	
    	global $wpdb;
		$wc_fields = array(
		    'first_name'            => esc_html__('First Name', 'wpsmt-smart-salesmate'),
		    'last_name'             => esc_html__('Last Name', 'wpsmt-smart-salesmate'),
		    'user_email'            => esc_html__('Email', 'wpsmt-smart-salesmate'),
		    'billing_first_name'    => esc_html__('Billing First Name', 'wpsmt-smart-salesmate'),
		    'billing_last_name'     => esc_html__('Billing Last Name', 'wpsmt-smart-salesmate'),
		    'billing_company'       => esc_html__('Billing Company', 'wpsmt-smart-salesmate'),
		    'billing_address_1'     => esc_html__('Billing Address 1', 'wpsmt-smart-salesmate'),
		    'billing_address_2'     => esc_html__('Billing Address 2', 'wpsmt-smart-salesmate'),
		    'billing_city'          => esc_html__('Billing City', 'wpsmt-smart-salesmate'),
		    'billing_state'         => esc_html__('Billing State', 'wpsmt-smart-salesmate'),
		    'billing_postcode'      => esc_html__('Billing Postcode', 'wpsmt-smart-salesmate'),
		    'billing_country'       => esc_html__('Billing Country', 'wpsmt-smart-salesmate'),
		    'billing_phone'         => esc_html__('Billing Phone', 'wpsmt-smart-salesmate'),
		    'billing_email'         => esc_html__('Billing Email', 'wpsmt-smart-salesmate'),
		    'shipping_first_name'   => esc_html__('Shipping First Name', 'wpsmt-smart-salesmate'),
		    'shipping_last_name'    => esc_html__('Shipping Last Name', 'wpsmt-smart-salesmate'),
		    'shipping_company'      => esc_html__('Shipping Company', 'wpsmt-smart-salesmate'),
		    'shipping_address_1'    => esc_html__('Shipping Address 1', 'wpsmt-smart-salesmate'),
		    'shipping_address_2'    => esc_html__('Shipping Address 2', 'wpsmt-smart-salesmate'),
		    'shipping_city'         => esc_html__('Shipping City', 'wpsmt-smart-salesmate'),
		    'shipping_postcode'     => esc_html__('Shipping Postcode', 'wpsmt-smart-salesmate'),
		    'shipping_country'      => esc_html__('Shipping Country', 'wpsmt-smart-salesmate'),
		    'shipping_state'        => esc_html__('Shipping State', 'wpsmt-smart-salesmate'),
		    'user_url'              => esc_html__('Website', 'wpsmt-smart-salesmate'),
		    'description'           => esc_html__('Biographical Info', 'wpsmt-smart-salesmate'),
		    'display_name'          => esc_html__('Display name publicly as', 'wpsmt-smart-salesmate'),
		    'nickname'              => esc_html__('Nickname', 'wpsmt-smart-salesmate'),
		    'user_login'            => esc_html__('Username', 'wpsmt-smart-salesmate'),
		    'user_registered'       => esc_html__('Registration Date', 'wpsmt-smart-salesmate')
		);

		return $wc_fields;
    }


    public static  function get_order_fields(){
    	
    	global $wpdb;


        $wc_fields =  array(
                'get_id'                       => esc_html__('Order Number', 'wpsmt-smart-salesmate'),
                'get_order_key'                => esc_html__('Order Key', 'wpsmt-smart-salesmate'),
                'get_billing_first_name'       => esc_html__('Billing First Name', 'wpsmt-smart-salesmate'),
                'get_billing_last_name'        => esc_html__('Billing Last Name', 'wpsmt-smart-salesmate'),
                'get_billing_company'          => esc_html__('Billing Company', 'wpsmt-smart-salesmate'),
                'get_billing_address_1'        => esc_html__('Billing Address 1', 'wpsmt-smart-salesmate'),
                'get_billing_address_2'        => esc_html__('Billing Address 2', 'wpsmt-smart-salesmate'),
                'get_billing_city'             => esc_html__('Billing City', 'wpsmt-smart-salesmate'),
                'get_billing_state'            => esc_html__('Billing State', 'wpsmt-smart-salesmate'),
                'get_billing_postcode'         => esc_html__('Billing Postcode', 'wpsmt-smart-salesmate'),
                'get_billing_country'          => esc_html__('Billing Country', 'wpsmt-smart-salesmate'), 
                'get_billing_phone'            => esc_html__('Billing Phone', 'wpsmt-smart-salesmate'),
                'get_billing_email'            => esc_html__('Billing Email', 'wpsmt-smart-salesmate'),
                'get_shipping_first_name'      => esc_html__('Shipping First Name', 'wpsmt-smart-salesmate'),
                'get_shipping_last_name'       => esc_html__('Shipping Last Name', 'wpsmt-smart-salesmate'),
                'get_shipping_company'         => esc_html__('Shipping Company', 'wpsmt-smart-salesmate'),
                'get_shipping_address_1'       => esc_html__('Shipping Address 1', 'wpsmt-smart-salesmate'),
                'get_shipping_address_2'       => esc_html__('Shipping Address 2', 'wpsmt-smart-salesmate'),
                'get_shipping_city'            => esc_html__('Shipping City', 'wpsmt-smart-salesmate'),
                'get_shipping_state'           => esc_html__('Shipping State', 'wpsmt-smart-salesmate'),
                'get_shipping_postcode'        => esc_html__('Shipping Postcode', 'wpsmt-smart-salesmate'),
                'get_shipping_country'         => esc_html__('Shipping Country',  'wpsmt-smart-salesmate'),
                'get_formatted_order_total'     => esc_html__('Formatted Order Total', 'wpsmt-smart-salesmate'),
                'get_cart_tax'                  => esc_html__('Cart Tax', 'wpsmt-smart-salesmate'),
                'get_currency'                  => esc_html__('Currency', 'wpsmt-smart-salesmate'),
                'get_discount_tax'              => esc_html__('Discount Tax', 'wpsmt-smart-salesmate'),
                'get_discount_to_display'       => esc_html__('Discount to Display', 'wpsmt-smart-salesmate'),
                'get_discount_total'            => esc_html__('Discount Total', 'wpsmt-smart-salesmate'),
                'get_shipping_tax'              => esc_html__('Shipping Tax', 'wpsmt-smart-salesmate'),
                'get_shipping_total'            => esc_html__('Shipping Total', 'wpsmt-smart-salesmate'),
                'get_subtotal'                  => esc_html__('SubTotal', 'wpsmt-smart-salesmate'),
                'get_subtotal_to_display'       => esc_html__('SubTotal to Display', 'wpsmt-smart-salesmate'),
                'get_total'                     => esc_html__('Get Total', 'wpsmt-smart-salesmate'),
                'get_total_discount'            => esc_html__('Get Total Discount', 'wpsmt-smart-salesmate'),
                'get_total_tax'                 => esc_html__('Total Tax', 'wpsmt-smart-salesmate'),
                'get_total_refunded'            => esc_html__('Total Refunded', 'wpsmt-smart-salesmate'),
                'get_total_tax_refunded'        => esc_html__('Total Tax Refunded', 'wpsmt-smart-salesmate'),
                'get_total_shipping_refunded'   => esc_html__('Total Shipping Refunded', 'wpsmt-smart-salesmate'),
                'get_item_count_refunded'       => esc_html__('Item count refunded', 'wpsmt-smart-salesmate'),
                'get_total_qty_refunded'        => esc_html__('Total Quantity Refunded', 'wpsmt-smart-salesmate'),
                'get_remaining_refund_amount'   => esc_html__('Remaining Refund Amount', 'wpsmt-smart-salesmate'),
                'get_item_count'                => esc_html__('Item count', 'wpsmt-smart-salesmate'),
                'get_shipping_method'           => esc_html__('Shipping Method', 'wpsmt-smart-salesmate'),
                'get_shipping_to_display'       => esc_html__('Shipping to Display', 'wpsmt-smart-salesmate'),
                'get_date_created'              => esc_html__('Date Created', 'wpsmt-smart-salesmate'),
                'get_date_modified'             => esc_html__('Date Modified', 'wpsmt-smart-salesmate'),
                'get_date_completed'            => esc_html__('Date Completed', 'wpsmt-smart-salesmate'),
                'get_date_paid'                 => esc_html__('Date Paid', 'wpsmt-smart-salesmate'),
                'get_customer_id'               => esc_html__('Customer ID', 'wpsmt-smart-salesmate'),
                'get_user_id'                   => esc_html__('User ID', 'wpsmt-smart-salesmate'),
                'get_customer_ip_address'       => esc_html__('Customer IP Address', 'wpsmt-smart-salesmate'),
                'get_customer_user_agent'       => esc_html__('Customer User Agent', 'wpsmt-smart-salesmate'),
                'get_created_via'               => esc_html__('Order Created Via', 'wpsmt-smart-salesmate'),
                'get_customer_note'             => esc_html__('Customer Note', 'wpsmt-smart-salesmate'),
                'get_shipping_address_map_url'  => esc_html__('Shipping Address Map URL', 'wpsmt-smart-salesmate'),
                'get_formatted_billing_full_name'   => esc_html__('Formatted Billing Full Name', 'wpsmt-smart-salesmate'),
                'get_formatted_shipping_full_name'  => esc_html__('Formatted Shipping Full Name', 'wpsmt-smart-salesmate'),
                'get_formatted_billing_address'     => esc_html__('Formatted Billing Address', 'wpsmt-smart-salesmate'),
                'get_formatted_shipping_address'    => esc_html__('Formatted Shipping Address', 'wpsmt-smart-salesmate'),
                'get_payment_method'            => esc_html__('Payment Method', 'wpsmt-smart-salesmate'),
                'get_payment_method_title'      => esc_html__('Payment Method Title', 'wpsmt-smart-salesmate'),
                'get_transaction_id'            => esc_html__('Transaction ID', 'wpsmt-smart-salesmate'),
                'get_checkout_payment_url'      => esc_html__( 'Checkout Payment URL', 'wpsmt-smart-salesmate'),
                'get_checkout_order_received_url'   => esc_html__('Checkout Order Received URL', 'wpsmt-smart-salesmate'),
                'get_cancel_order_url'          => esc_html__('Cancel Order URL', 'wpsmt-smart-salesmate'),
                'get_cancel_order_url_raw'      => esc_html__('Cancel Order URL Raw', 'wpsmt-smart-salesmate'),
                'get_cancel_endpoint'           => esc_html__('Cancel Endpoint', 'wpsmt-smart-salesmate'),
                'get_view_order_url'            => esc_html__('View Order URL', 'wpsmt-smart-salesmate'),
                'get_edit_order_url'            => esc_html__('Edit Order URL', 'wpsmt-smart-salesmate'),
                'get_status'                    => esc_html__('Status', 'wpsmt-smart-salesmate'),
            );
        
        return $wc_fields;
    }


    public static function get_product_fields(){
    	global $wpdb;
		$wc_fields = array(
		    'get_id'              		=> esc_html__('Product Id', 'wpsmt-smart-salesmate'),
            'get_type'       			=> esc_html__('Product Type', 'wpsmt-smart-salesmate'),
            'get_name'       			=> esc_html__('Name', 'wpsmt-smart-salesmate'),
            'get_slug'          		=> esc_html__('Slug', 'wpsmt-smart-salesmate'),
            'get_date_created'      	=> esc_html__('Date Created', 'wpsmt-smart-salesmate'),
            'get_date_modified'     	=> esc_html__('Date Modified', 'wpsmt-smart-salesmate'),
            'get_status'            	=> esc_html__('Status', 'wpsmt-smart-salesmate'),
            'get_featured'          	=> esc_html__('Featured', 'wpsmt-smart-salesmate'),
            'get_catalog_visibility'	=> esc_html__('Catalog Visibility', 'wpsmt-smart-salesmate'),
            'get_description'       	=> esc_html__('Description', 'wpsmt-smart-salesmate'),
            'get_short_description' 	=> esc_html__('Short Description', 'wpsmt-smart-salesmate'),
            'get_sku'            		=> esc_html__('Sku', 'wpsmt-smart-salesmate'),
            'get_menu_order'      		=> esc_html__('Menu Order', 'wpsmt-smart-salesmate'),
            'get_virtual'       		=> esc_html__('Virtual', 'wpsmt-smart-salesmate'),
            'get_permalink'         	=> esc_html__('Product Permalink', 'wpsmt-smart-salesmate'),
            'get_price'       			=> esc_html__('Price', 'wpsmt-smart-salesmate'),
            'get_regular_price'       	=> esc_html__('Regular Price', 'wpsmt-smart-salesmate'),
            'get_sale_price'            => esc_html__('Sale Price', 'wpsmt-smart-salesmate'),
            'get_date_on_sale_from'     => esc_html__('Date on Sale From', 'wpsmt-smart-salesmate'),
            'get_date_on_sale_to'       => esc_html__('Date on Sale To', 'wpsmt-smart-salesmate'),
            'get_total_sales'         	=> esc_html__('Total Sales', 'wpsmt-smart-salesmate'),
            'get_tax_status'     		=> esc_html__('Tax Status', 'wpsmt-smart-salesmate'),
            'get_tax_class'           	=> esc_html__('Tax Class', 'wpsmt-smart-salesmate'),
            'get_manage_stock'          => esc_html__('Manage Stock', 'wpsmt-smart-salesmate'),
            'get_stock_quantity'        => esc_html__('Stock Quantity', 'wpsmt-smart-salesmate'),
            'get_stock_status'          => esc_html__('Stock Status', 'wpsmt-smart-salesmate'),
            'get_backorders'       		=> esc_html__('Backorders', 'wpsmt-smart-salesmate'),
            'get_sold_individually'     => esc_html__('Sold Individually', 'wpsmt-smart-salesmate'),
            'get_purchase_note'         => esc_html__('Purchase Note', 'wpsmt-smart-salesmate'),
            'get_shipping_class_id'     => esc_html__('Shipping Class ID', 'wpsmt-smart-salesmate'),
            'get_weight'               	=> esc_html__('Weight', 'wpsmt-smart-salesmate'),
            'get_length'              	=> esc_html__('Length', 'wpsmt-smart-salesmate'),
            'get_width'            		=> esc_html__('Width', 'wpsmt-smart-salesmate'),
            'get_height'            	=> esc_html__('Height', 'wpsmt-smart-salesmate'),
            'get_categories'            => esc_html__('Categories', 'wpsmt-smart-salesmate'),
            'get_category_ids'          => esc_html__('Categories IDs', 'wpsmt-smart-salesmate'),
            'get_tag_ids'            	=> esc_html__('Tag IDs', 'wpsmt-smart-salesmate'),
		);
        
		return $wc_fields;
    }

    public function store_required_field_mapping_data(){

        global $wpdb;
        $salesmate_api_obj   = new WPSMT_Smart_Salesmate_API();
        $wp_modules     = $this->get_wp_modules();
        $getListModules = $this->get_salesmate_modules();

        if($getListModules['modules']){
            foreach ($getListModules['modules'] as $key => $singleModule) {
                if( $singleModule['deletable'] &&  $singleModule['creatable'] ){
        
                    $salesmate_fields = $salesmate_api_obj->getFieldsMetaData( $singleModule['api_name'] );
        
                    if($salesmate_fields){
                        foreach ($salesmate_fields['fields'] as $salesmate_field_key => $salesmate_field_data) {
                            if($salesmate_field_data['field_read_only'] == NULL){
                                if( $salesmate_field_data['system_mandatory'] == 1 ){
                                    if($wp_modules){
                                        foreach ($wp_modules as $wpModuleSlug => $wpModuleLabel) {
        
                                            switch ( $wpModuleSlug ) {
                                                case 'customers':
                                                    $wp_field = "first_name";
                                                    break;
                                                
                                                case 'orders':
                                                    $wp_field = "get_id";
                                                    break;

                                                case 'products':
                                                    $wp_field = "get_name";
                                                    break;

                                                default:
                                                    $wp_field = "";
                                                    break;
                                            }

                                            $status         = 'active';
                                            $description    = '';

                                            $record_exists = $wpdb->get_row( 
                                                $wpdb->prepare(
                                                    "
                                                    SELECT * FROM ".$wpdb->prefix ."smart_salesmate_field_mapping  WHERE wp_module = %s AND wp_field = %s  AND salesmate_module = %s AND salesmate_field = %s
                                                    " ,
                                                    $wpModuleSlug, $wp_field, $singleModule['api_name'], $salesmate_field_data['api_name']
                                                    )
                                                
                                            );

                                            if ( null !== $record_exists ) {
                                                
                                              $reccord_id       = $record_exists->id;
                                              $is_predefined    = $record_exists->is_predefined;
                                              

                                                $wpdb->update(
                                                    $wpdb->prefix . 'smart_salesmate_field_mapping', 
                                                    array( 
                                                        'wp_module'     => sanitize_text_field($wpModuleSlug),
                                                        'wp_field'      => sanitize_text_field($wp_field),
                                                        'salesmate_module'   => sanitize_text_field($singleModule['api_name']),
                                                        'salesmate_field'    => sanitize_text_field($salesmate_field_data['api_name']), 
                                                        'status'        => sanitize_text_field($status),
                                                        'description'   => sanitize_text_field($description), 
                                                        'is_predefined' => sanitize_text_field($is_predefined), 
                                                    ), 
                                                    array( 'id' => $reccord_id ), 
                                                    array( 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s'
                                                    ),
                                                    array( '%d' )
                                                );

                                            }else{
                                                $wpdb->insert( 
                                                    $wpdb->prefix . 'smart_salesmate_field_mapping', 
                                                    array( 
                                                        'wp_module'     => sanitize_text_field($wpModuleSlug),
                                                        'wp_field'      => sanitize_text_field($wp_field),
                                                        'salesmate_module'   => sanitize_text_field($singleModule['api_name']),
                                                        'salesmate_field'    => sanitize_text_field($salesmate_field_data['api_name']), 
                                                        'status'        => sanitize_text_field($status),
                                                        'description'   => sanitize_text_field($description), 
                                                        'is_predefined' => 'yes', 
                                                    ),
                                                    array( 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s'
                                                    ) 
                                                );
                                            }
                                            
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
?>