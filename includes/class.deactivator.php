<?php

class WPSMT_Smart_Salesmate_Deactivator
{
    public function deactivate() {
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		$smart_salesmate_report_table_name 			= $wpdb->prefix . 'smart_salesmate_report';
		$smart_salesmate_field_mapping_table_name 	= $wpdb->prefix . 'smart_salesmate_field_mapping';

		delete_option('wpsmt_smart_salesmate_settings');
		delete_option('wpsmt_smart_salesmate');
		delete_option('wpsmt_smart_salesmate_modules_fields');
	}
}
?>