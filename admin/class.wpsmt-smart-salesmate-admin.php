<?php
class WPSMT_Smart_Salesmate_Admin {

    public function __construct() {
        $this->load();
        $this->menu();
    }

    private function load() {
        require_once WPSMT_PLUGIN_PATH . 'admin/class.settings.php';
        require_once WPSMT_PLUGIN_PATH . 'admin/class.fields-mappings.php';
        require_once WPSMT_PLUGIN_PATH . 'admin/class.synchronization.php';
        require_once WPSMT_PLUGIN_PATH . 'admin/class.customers-list.php';
        require_once WPSMT_PLUGIN_PATH . 'admin/class.orders-list.php';
        require_once WPSMT_PLUGIN_PATH . 'admin/class.products-list.php';
    }

    private function menu() {
        add_action( 'admin_enqueue_scripts', array($this, 'wpsmt_smart_salesmate_scripts_callback') );
        add_action( 'wp_ajax_wp_field', array($this, 'wpsmt_smart_salesmate_wp_field_callback') );
        add_action( 'wp_ajax_salesmate_field', array($this, 'wpsmt_smart_salesmate_field_callback') );
        add_action( 'admin_menu', array($this, 'wpsmt_smart_salesmate_main_menu_callback') );
    }

    public function wpsmt_smart_salesmate_scripts_callback(  $hook ) {
      
        $hook_array = array(
                            'toplevel_page_wpsmt-smart-salesmate-integration',
                            'smart-salesmate_page_wpsmt-smart-salesmate-mappings'
                        );
        if (  ! in_array($hook, $hook_array)  ) {
            return;
        }

        // Register the script

        wp_register_script( 
                    'jquery-dataTables-min-js', 
                    WPSMT_PLUGIN_URL . 'admin/js/jquery.dataTables.min.js', 
                    array(), 
                    time() 
                );

        wp_register_script( 
                    'wpsmt-smart-salesmate-js', 
                    WPSMT_PLUGIN_URL . 'admin/js/wpsmt-smart-salesmate.js', 
                    array(), 
                    time() 
                );

        wp_register_style( 
                    'jquery-dataTables-min-css', 
                    WPSMT_PLUGIN_URL . 'admin/css/jquery.dataTables.min.css', 
                    array(), 
                    time() 
                );

        wp_register_style( 
                    'wpsmt-smart-salesmate-style', 
                    WPSMT_PLUGIN_URL . 'admin/css/wpsmt-smart-salesmate.css', 
                    array(), 
                    time() 
                );
        

        // Localize the script with new data
        $localize_array = array(
            'ajaxurl'       => admin_url( 'admin-ajax.php' ),
        );

        wp_localize_script( 'wpsmt-smart-salesmate-js', 'smart_salesmate_js', $localize_array );
         
        // Enqueued script with localized data.

        wp_enqueue_script( 'jquery-dataTables-min-js' );
        wp_enqueue_script( 'wpsmt-smart-salesmate-js' );
        
        wp_enqueue_style( 'jquery-dataTables-min-css' );
        wp_enqueue_style( 'wpsmt-smart-salesmate-style' );
    }

    public function wpsmt_smart_salesmate_wp_field_callback() {
       ob_start(); 
       $wp_fields = array();

       if( isset( $_REQUEST['wp_module_name'] ) ){

            switch ( $_REQUEST['wp_module_name'] ) {
                case 'customers':
                    $wp_fields = WPSMT_Smart_Salesmate::get_customer_fields();
                    break;

                case 'orders':
                    $wp_fields = WPSMT_Smart_Salesmate::get_order_fields();
                    break;

                case 'products':
                    $wp_fields = WPSMT_Smart_Salesmate::get_product_fields();
                    break;

                default:
                    # code...
                    break;
            }
       }
       
       $wp_fields_options = "<option>".esc_html__('Select WP Fields', 'wpsmt-smart-salesmate')."</option>";
       
       if($wp_fields){
            foreach ($wp_fields as $option_value => $option_label) {
                $wp_fields_options .=  "<option value='".$option_value."'>".esc_html__($option_label, 'wpsmt-smart-salesmate')."</option>";
            }
       }
       
       ob_get_clean();
       echo $wp_fields_options;
       wp_die(); 
    }

    public function wpsmt_smart_salesmate_field_callback() {
       ob_start(); 
       $salesmate_fields = array();

       if( isset($_REQUEST['salesmate_module_name']) ){
            $salesmate_module    = $_REQUEST['salesmate_module_name'];
                $salesmate_api_obj   = new WPSMT_Smart_Salesmate_API();
                $salesmate_fields    = $salesmate_api_obj->getFieldsMetaData($salesmate_module);
       }
       
       $salesmate_fields_options = "<option>".esc_html__('Select Salesmate Fields', 'wpsmt-smart-salesmate')."</option>";
       
       if($salesmate_fields){
            foreach ($salesmate_fields['fields'] as $salesmate_field_key => $salesmate_field_data) {
                if($salesmate_field_data['field_read_only'] == NULL){

                    $system_mandatory   = ($salesmate_field_data['system_mandatory'] == 1) ? " ( Required ) " : "";
                    $data_type          = isset($salesmate_field_data['data_type']) ? " ( ".ucfirst($salesmate_field_data['data_type'])." ) " : "";

                    echo 
                    $salesmate_fields_options .= "<option value='".$salesmate_field_data['api_name']."'>". esc_html__($salesmate_field_data['display_label'], 'wpsmt-smart-salesmate') . esc_html($data_type) . esc_html($system_mandatory) . "</option>";
                }
            }
       }
       
       ob_get_clean();
       echo $salesmate_fields_options;
       wp_die(); 
    }

    public function wpsmt_smart_salesmate_main_menu_callback() {
        add_menu_page( 
                        esc_html__('Smart Salesmate', 'wpsmt-smart-salesmate'), 
                        esc_html__('Smart Salesmate', 'wpsmt-smart-salesmate'), 
                        'manage_options', 
                        'wpsmt-smart-salesmate-integration', 
                        array($this, 'settings_callback'), 
                        'dashicons-rest-api' 
                    );

        add_submenu_page( 
                        'wpsmt-smart-salesmate-integration', 
                        esc_html__( 'Smart Salesmate Settings', 'wpsmt-smart-salesmate' ), 
                        esc_html__( 'Smart Salesmate', 'wpsmt-smart-salesmate' ), 
                        'manage_options', 
                        'wpsmt-smart-salesmate-integration', 
                        array($this, 'settings_callback')
                    );

        add_submenu_page( 
                        'wpsmt-smart-salesmate-integration', 
                        esc_html__( 'Smart Salesmate Fields Mappings', 'wpsmt-smart-salesmate' ), 
                        esc_html__( 'Fields Mappings', 'wpsmt-smart-salesmate' ), 
                        'manage_options', 
                        'wpsmt-smart-salesmate-mappings', 
                        array($this, 'mappings_callback')
                    );

        add_submenu_page( 
                        'wpsmt-smart-salesmate-integration', 
                        esc_html__( 'Smart Salesmate Synchronization', 'wpsmt-smart-salesmate' ), 
                        esc_html__( 'Synchronization', 'wpsmt-smart-salesmate' ), 
                        'manage_options', 
                        'wpsmt-smart-salesmate-synchronization', 
                        array($this, 'Synchronization_callback')
                    );

        add_submenu_page( 
                        'wpsmt-smart-salesmate-integration', 
                        NULL, 
                        NULL, 
                        'manage_options', 
                        'wpsmt_smart_salesmate_process', 
                        array($this, 'salesmate_process_callback')
                    );
    }

    public function salesmate_process_callback(){
        
        global $wpdb;

        if ( isset( $_REQUEST['code'] ) ) {
            $code           = sanitize_text_field($_REQUEST['code']);
            $salesmate_api_obj   = new WPSMT_Smart_Salesmate_API();
            $token          = $salesmate_api_obj->getToken( $code, WPSMT_REDIRECT_URI );
            
            if ( isset( $token->error ) ) {
                /*Error logic*/
            } else {
                $salesmate_api_obj->manageToken( $token );    
            }
        }

        $smart_salesmate_obj = new WPSMT_Smart_Salesmate();
        $smart_salesmate_obj->store_required_field_mapping_data();
        
        wp_redirect(WPSMT_SETTINGS_URI);
        exit();
    }

    public function settings_callback(){
        $admin_settings_obj = new WPSMT_Smart_Salesmate_Admin_Settings();
        $admin_settings_obj->processSettingsForm();
        $admin_settings_obj->displaySettingsForm();
    }

    public function mappings_callback(){
        $field_mapping_obj = new WPSMT_Smart_Salesmate_Field_Mappings();
        $field_mapping_obj->processMappingsForm();
        $field_mapping_obj->displayMappingsForm(); 
        $field_mapping_obj->displayMappingsFieldList();
    }

    public function Synchronization_callback(){
        $admin_synch_obj = new WPSMT_Smart_Salesmate_Admin_Synchronization();
        $admin_synch_obj->processSynch();
        $admin_synch_obj->displaySynchData();
    }
}

new WPSMT_Smart_Salesmate_Admin();
?>