<?php
class WPSMT_Smart_Salesmate_API {
    
    var $api_key;
    var $store_link;
    
    function __construct() {
       
        $wpsmt_smart_salesmate_settings     = get_option( 'wpsmt_smart_salesmate_settings' );

        $api_key = isset($wpsmt_smart_salesmate_settings['smt-token']) ? esc_attr($wpsmt_smart_salesmate_settings['smt-token']) : '';
        $store_link= get_option('wpsmt_smart_salesmate_settings');

        $this->store_link = $store_link['smt-url'];
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
            'accessToken: '.$this->api_key,
            'x-linkname: '.$this->store_link
        );

        $url = 'https://'.$this->store_link.'/apis/'.$module.'/v4';
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
            'Content-Type: application/json',
            'accessToken: '.$this->api_key,
            'x-linkname: '.$this->store_link
        );
        
        $url = 'https://'.$this->store_link.'/apis/'.$module.'/v4/'.$record_id;
        
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