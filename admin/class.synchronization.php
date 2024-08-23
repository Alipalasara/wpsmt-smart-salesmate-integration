<?php
class WPSMT_Smart_Salesmate_Admin_Synchronization {

    public function processSynch($POST = array()){
       
       	if ( isset( $_POST['submit'] ) ) {

            if(isset($_REQUEST['tab']) && $_REQUEST['tab'] == "general"){
                $api_key                  = sanitize_text_field($_REQUEST['wpsmt_smart_salesmate_settings']['smt-token']);
                $sales_link              = sanitize_text_field($_REQUEST['wpsmt_smart_salesmate_settings']['smt-url']);
            }
                        
            $wpsmt_smart_salesmate_settings  = !empty(get_option( 'wpsmt_smart_salesmate_settings' )) ? get_option( 'wpsmt_smart_salesmate_settings' ) : array();

            $wpsmt_smart_salesmate_settings = array_merge($wpsmt_smart_salesmate_settings, $_REQUEST['wpsmt_smart_salesmate_settings']);
            
            update_option( 'wpsmt_smart_salesmate_settings', $wpsmt_smart_salesmate_settings );
            
        }


        /*Synch product*/
        if( isset( $_POST['smart_synch'] ) && $_POST['smart_synch'] == 'salesmate' ){

           
            $id = $_POST['id'];

            switch ($_POST['wp_module']) {
                
                case 'products':
                    
                    $WPSMT_Smart_Salesmate_Public = new WPSMT_Smart_Salesmate_Public();
                    $WPSMT_Smart_Salesmate_Public->addProductToSalesmate( $id );

                    break;

                case 'orders':
                    
                    $WPSMT_Smart_Salesmate_Public = new WPSMT_Smart_Salesmate_Public();
                    $WPSMT_Smart_Salesmate_Public->addOrderToSalesmate( $id );

                    break;

                case 'customers':
                    
                    $WPSMT_Smart_Salesmate_Public = new WPSMT_Smart_Salesmate_Public();
                    $WPSMT_Smart_Salesmate_Public->addUserToSalesmate( $id );

                    break;    
                
                default:
                    # code...
                    break;
            }
            
        }
        

    }

    public function displaySynchData(){
        require_once WPSMT_PLUGIN_PATH . 'admin/partials/synchronization.php';
    }
}
?>