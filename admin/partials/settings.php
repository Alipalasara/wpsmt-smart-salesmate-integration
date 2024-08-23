<?php
	
	$wpsmt_smart_salesmate 			= get_option( 'wpsmt_smart_salesmate' );
	$wpsmt_smart_salesmate_settings = get_option( 'wpsmt_smart_salesmate_settings' );
	$apitoken 						=  isset($wpsmt_smart_salesmate_settings['smt-token']) ? $wpsmt_smart_salesmate_settings['smt-token'] : "";
	$apiurl 						=  isset($wpsmt_smart_salesmate_settings['smt-url']) ? $wpsmt_smart_salesmate_settings['smt-url'] : "";

?>

<div class="wrap">                
	
	<h1><?php echo esc_html__( 'Salesmate CRM Settings and Authorization' ); ?></h1>
	<hr>

	<form method="post">
		<?php 
			$tab = isset( $_REQUEST['tab'] ) ? $_REQUEST['tab'] : 'general';
		?>

		<nav class="nav-tab-wrapper woo-nav-tab-wrapper">
			<a href="<?php echo admin_url('admin.php?page=wpsmt-smart-salesmate-integration&tab=general'); ?>" class="nav-tab <?php if($tab == 'general'){ echo 'nav-tab-active';} ?>"><?php echo esc_html__( 'General', 'wpsmt-smart-salesmate' ); ?></a>
			<a href="<?php echo admin_url('admin.php?page=wpsmt-smart-salesmate-integration&tab=synch_settings'); ?>" class="nav-tab <?php if($tab == 'synch_settings'){ echo 'nav-tab-active';} ?>"><?php echo esc_html__( 'Synch Settings', 'wpsmt-smart-salesmate' ); ?></a>
		</nav>
		
		<input type="hidden" name="tab" value="<?php echo esc_html($tab); ?>">

		<?php if( isset($tab) && 'general' == $tab ){ ?>
			
			<table class="form-table general_settings">
				<tbody>

					<tr>
						<th scope="row">
							<label><?php echo esc_html__( 'Session Token	', 'wpsmt-smart-salesmate' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" name="wpsmt_smart_salesmate_settings[smt-token]" placeholder=" Enter Your Session Token" value="<?php echo esc_attr($apitoken); ?>" required />
							<br>
							<a href="https://app.salesmate.com/settings/api">Get Session Token</a>
						</td>
					</tr>				
					<tr>
						<th scope="row">
							<label><?php echo esc_html__( 'x-linkname', 'wpsmt-smart-salesmate' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" name="wpsmt_smart_salesmate_settings[smt-url]" placeholder=" Example : yourlinkname.salesmate.io" value="<?php echo esc_attr($apiurl); ?>" required />
							<br>
							<a href="https://ibb.co/Ss18GFn">Enter Your Deshboard Link</a>
						</td>
					</tr>				
				</tbody>
			</table>

			<div class="inline">
				<p>
					<input type='submit' class='button-primary' name="submit" value="<?php echo esc_html__( 'Save & Authorize', 'wpsmt-smart-salesmate' ); ?>" />
				</p>
			</div>

		<?php }else if( isset($tab) && 'synch_settings' == $tab ){ ?>
			<?php 
				$smart_salesmate_obj   = new WPSMT_Smart_Salesmate();
		        $wp_modules 	= $smart_salesmate_obj->get_wp_modules();
		        $getListModules = $smart_salesmate_obj->get_salesmate_modules();
			?>
			<table class="form-table synch_settings">
				<tbody>
					<?php
						if($getListModules['modules']){
					        foreach ($getListModules['modules'] as $key => $singleModule) {
					            if( $singleModule['deletable'] &&  $singleModule['creatable'] ){
					            	foreach ($wp_modules as $wp_module_key => $wp_module_name) {
					            		?>
						            		<tr>
												<th scope="row"><label><?php echo esc_html__( "Enable {$wp_module_key} to Salesmate {$singleModule['api_name']} Sync", 'wpsmt-smart-salesmate' ); ?></label></th>
												<td>
													<fieldset>
														<label>
															<input 
																type="checkbox" 
																name="wpsmt_smart_salesmate_settings[synch][<?php echo $wp_module_key.'_'.$singleModule['api_name']; ?>]" 
																<?php @checked( $wpsmt_smart_salesmate_settings['synch']["{$wp_module_key}_{$singleModule['api_name']}"], 1 ); ?>
																value="1" />
																Enable
														</label>
													</fieldset>
												</td>
											</tr>
						            	<?php	
					            	}
					            }
					        }
					    }
					?>    
    				
				</tbody>
			</table>
			<p><input type='submit' class='button-primary' name="submit" value="<?php echo esc_html__( 'Save', 'wpsmt-smart-salesmate' ); ?>" /></p>
		
		<?php }?>	
		
	</form>
</div>