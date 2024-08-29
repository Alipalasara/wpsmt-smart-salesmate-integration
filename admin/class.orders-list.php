<?php 
if( !defined( 'ABSPATH' ) ) exit;


if ( ! class_exists( 'WP_List_Table' ) ) {
require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}	

class Order_Listed extends WP_List_Table {
	/** Class constructor */
	public function __construct() {
		parent::__construct( [
			'singular' => esc_html__( 'Order', 'wpspi-smart-pipedrive' ), //singular name of the listed records
			'plural'   => esc_html__( 'Orders', 'wpspi-smart-pipedrive' ), //plural name of the listed records
			'ajax'     => true //does this table support ajax?
		] );
	}

	/**
	 * Retrieve customers data from the database
	 *
	 * @param int $per_page
	 * @param int $page_number
	 *
	 * @return mixed
	 */
	public static function get_order( $per_page = 10, $page_number = 1) {
			global $wpdb;

		$orderTableName = $wpdb->prefix.'wc_orders';
		$orderSql = "SELECT $orderTableName.id, $orderTableName.date_created_gmt FROM $orderTableName";

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$orderSql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$orderSql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}
		$orderSql .= " LIMIT $per_page";
		$orderSql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;
		
		$orderData = $wpdb->get_results( $orderSql, 'ARRAY_A' );
		$orderResult = json_decode(json_encode($orderData), true);	
		
		return $orderResult;
	}

	/**
	 * Returns the count of records in the database.
	 *
	 * @return null|string
	 */
	public static function record_count() {
		global $wpdb;
		return $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM ".$wpdb->prefix."posts WHERE post_type = %s AND post_status != %s", 'shop_order', 'draft') );
	}
	
	/** Text displayed when no customer data is available */
	public function no_items() {
		echo esc_html__( 'No orders avaliable.', 'wpspi-smart-pipedrive' );
	}

	/**
	 * Render a column when no column specific method exist.
	 *
	 * @param array $item
	 * @param string $column_name
	 *
	 * @return mixed
	 */
	public function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'id':
			case 'date_created_gmt':
				return $item[ $column_name ];
			default:
				return print_r( $item, true ); //Show the whole array for troubleshooting purposes
		}
	}

	/**
	 * Method for name column
	 *
	 * @param array $item an array of DB data
	 *
	 * @return string
	 */
		
	function column_action( $item ) {							
		$action = '<form action="" method="post">                      
						<input name="wp_module" value="orders" type="hidden" />
						<input name="id" value="'.esc_attr($item['id']).'" type="hidden" />
						<button class="button" name="smart_synch" value="pipedrive" type="submit">'.esc_html__('Sync', 'wpspi-smart-pipedrive').'</button>
					</form>';
		return $action;
	}

	/**
	 *  Associative array of columns
	 *
	 * @return array
	 */
	function get_columns() {
		$columns = [
			'id'    	=> esc_html__( 'Order Id', 'wpspi-smart-pipedrive' ),
			'date_created_gmt' => esc_html__( 'Create Time', 'wpspi-smart-pipedrive' ),
			'action'    => esc_html__( 'Action', 'wpspi-smart-pipedrive' )
		];
		return $columns;
	}

	/**
	 * Columns to make sortable.
	 *
	 * @return array
	 */
	
	public function get_sortable_columns() {
		$sortable_columns = array(
			'id' => array( 'id', true ),
			'date_created_gmt' => array( 'date_created_gmt', true )
		);
		return $sortable_columns;
	}
	
	/**
	 * Handles data query and filter, sorting, and pagination.
	 */
	public function prepare_items() {
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
										
		/** Process bulk action */
		$this->process_bulk_action();
		$per_page     = $this->get_items_per_page( 'customers_per_page', 10 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();

		$this->set_pagination_args( [
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page'    => $per_page //WE have to determine how many items to show on a page
		] );
		
		$this->items = self::get_order( $per_page, $current_page );
	}
}
?>