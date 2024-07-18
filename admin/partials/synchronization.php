<div class="wrap">                
	
	<h1><?php echo esc_html__( 'Salesmate Synchronization' ); ?></h1>
	<hr>

	<form method="post">
		<?php 
			$tab = isset( $_REQUEST['tab'] ) ? $_REQUEST['tab'] : 'products';
		?>

		<nav class="nav-tab-wrapper woo-nav-tab-wrapper">
			<a href="<?php echo admin_url('admin.php?page=wpsmt-smart-salesmate-synchronization&tab=products'); ?>" class="nav-tab <?php if($tab == 'products'){ echo 'nav-tab-active';} ?>"><?php echo esc_html__( 'Products', 'wpsmt-smart-salesmate' ); ?></a>
			<a href="<?php echo admin_url('admin.php?page=wpsmt-smart-salesmate-synchronization&tab=orders'); ?>" class="nav-tab <?php if($tab == 'orders'){ echo 'nav-tab-active';} ?>"><?php echo esc_html__( 'Orders', 'wpsmt-smart-salesmate' ); ?></a>
			<a href="<?php echo admin_url('admin.php?page=wpsmt-smart-salesmate-synchronization&tab=customers'); ?>" class="nav-tab <?php if($tab == 'customers'){ echo 'nav-tab-active';} ?>"><?php echo esc_html__( 'Customers', 'wpsmt-smart-salesmate' ); ?></a>
		</nav>
		
		<input type="hidden" name="tab" value="<?php echo esc_attr($tab); ?>">

		<?php if( isset($tab) && 'products' == $tab ){ ?>
			<?php
			$Product_List = new Product_Listed();
				$Product_List->prepare_items();
				$Product_List->display(); 
			?>	

		<?php }else if( isset($tab) && 'orders' == $tab ){ ?>
			<?php
				$Orders_List = new Order_Listed();
				$Orders_List->prepare_items();
				$Orders_List->display(); 
			?>	
		
		<?php }else if( isset($tab) && 'customers' == $tab ){ ?>
			
			<?php 
				$Customers_List = new Customers_List();
				$Customers_List->prepare_items();
				$Customers_List->display(); 
			?>

		<?php }?>	
		
	</form>
</div>