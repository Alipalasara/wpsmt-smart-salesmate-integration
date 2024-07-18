<?php
class WPSMT_Smart_Salesmate_Admin_Settings {

    public function processSettingsForm($POST = array()){
       
        $client_id = $client_secret = "";
        
        if ( isset( $_POST['submit'] ) ) {
                        
            $wpsmt_smart_salesmate_settings  = !empty(get_option( 'wpsmt_smart_salesmate_settings' )) ? get_option( 'wpsmt_smart_salesmate_settings' ) : array();

            if (isset($_REQUEST['wpsmt_smart_salesmate_settings'])) {
                $wpsmt_smart_salesmate_settings = array_merge($wpsmt_smart_salesmate_settings, $_REQUEST['wpsmt_smart_salesmate_settings']);
            }
            
            update_option( 'wpsmt_smart_salesmate_settings', $wpsmt_smart_salesmate_settings );
            
        }

    }

    public function displaySettingsForm(){
        require_once WPSMT_PLUGIN_PATH . 'admin/partials/settings.php';
    }
}
?>
