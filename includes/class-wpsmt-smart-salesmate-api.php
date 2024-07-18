<?php
class WPSMT_Smart_Salesmate_API {
    
    var $url;
    var $api_key;
    
    function __construct() {
       
        $wpsmt_smart_salesmate_data_center    = 'https://oauth.salesmate.com';
        $wpsmt_smart_salesmate_settings     = get_option( 'wpsmt_smart_salesmate_settings' );

        $api_key = isset($wpsmt_smart_salesmate_settings['psn-token']) ? esc_attr($wpsmt_smart_salesmate_settings['psn-token']) : '';

        $this->url      = $wpsmt_smart_salesmate_data_center;
        $this->api_key  = $api_key;
        $this->loadAPIFiles();

    }
    
    function loadAPIFiles(){
        require_once WPSMT_PLUGIN_PATH . 'includes/class.getListofModules.php';
        require_once WPSMT_PLUGIN_PATH . 'includes/class.getFieldsMetaData.php';
    }

    function getListModules(){
        return (new GetListofModules())->execute();
    }

    function getFieldsMetaData( $module_name = NULL ){
        return (new GetFieldsMetaData())->execute($module_name);
    }
    
    function addRecord( $module, $data ) {

        $json = json_encode( $data );
        $header = array(
            'Content-Type: application/json',
        );

        $url = WPSMT_SALESMATEAPIS_URL.'/v1/'.$module.'/?api_token='.$this->api_key;
        
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $json );
        $json_response = curl_exec( $ch );
        curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close( $ch );
        
        $response = json_decode( $json_response );
        
        if ( isset($response->error) && !empty($response->error) ) {
            $log = "errorCode: " . $response->error_info . "\n";
            $log .= "message: " . $response->error . "\n";
            $log .= "Date: " . date('Y-m-d H:i:s') . "\n\n";

            file_put_contents(WPSMT_PLUGIN_PATH . 'debug.log', $log, FILE_APPEND);
        }
        
        return $response;
    }
    
    function updateRecord( $module, $data, $record_id ) {

        
        $data = json_encode( $data );
        $header = array(
            'Authorization: Salesmate-oauthtoken '.$this->token->access_token,
        );
        
        $url = WPSMT_SALESMATEAPIS_URL.'/crm/v2/'.$module.'/'.$record_id;
        
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'PUT' );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
        $json_response = curl_exec( $ch );
        curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close( $ch );
        
        $response = json_decode( $json_response );
        if ( isset( $response->data[0]->status ) && $response->data[0]->status == 'error' ) {
            $log = "errorCode: ".$response->data[0]->code."\n";
            $log .= "message: ".$response->data[0]->message."\n";
            $log .= "Date: ".date( 'Y-m-d H:i:s' )."\n\n";                            

            file_put_contents( WPSMT_PLUGIN_PATH.'debug.log', $log, FILE_APPEND );
        }
        
        return $response;
    }
}
?>