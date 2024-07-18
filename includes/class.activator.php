<?php
class WPSMT_Smart_Salesmate_Activator
{
    public function activate() {
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		$smart_salesmate_report_table_name 			= $wpdb->prefix . 'smart_salesmate_report';
		$smart_salesmate_field_mapping_table_name 	= $wpdb->prefix . 'smart_salesmate_field_mapping';

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $smart_salesmate_report_table_name (
			id 			int(9) 			NOT NULL AUTO_INCREMENT,
			wp_id 		varchar(255) 	NOT NULL,
			record_id 	varchar(255) 	NOT NULL,
			action 		varchar(255) 	NOT NULL,
			table_name 	varchar(255) 	NOT NULL,
			datetime 	datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		dbDelta( $sql );
		
		$sql = "CREATE TABLE IF NOT EXISTS $smart_salesmate_field_mapping_table_name (
			id 					int(11) 		NOT NULL AUTO_INCREMENT,
			wp_module 			varchar(100) 	NOT NULL,
			wp_field 			varchar(100) 	NOT NULL,
			salesmate_module 		varchar(100) 	NOT NULL,
			salesmate_field 			varchar(100) 	NOT NULL,
			status 				varchar(20) 	NOT NULL,
			description 		varchar(255) 	NOT NULL,
			is_predefined 		varchar(5) 		NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		dbDelta( $sql );
	}
}
?>