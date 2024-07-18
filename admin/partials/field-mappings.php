<div class="loader"></div>

<form method="post" action="<?php echo admin_url('/admin.php?page=wpsmt-smart-salesmate-mappings') ?>" id="wpsmt-smart-salesmate-mappings-form">

    <h2><?php echo esc_html__('Fields Mapping', 'wpsmt-smart-salesmate'); ?></h2>

    <table class="form-table">
        <!-- WP Modules Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'WP Modules', 'wpsmt-smart-salesmate' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="wp_module">
                    <option><?php echo  esc_html__('Select Module', 'wpsmt-smart-salesmate'); ?></option>
                    <?php 
                        if($wp_modules){
                            foreach ($wp_modules as $key => $singleModule) {
                                ?>            
                                <option value = "<?php echo $key; ?>"><?php echo esc_html__($singleModule, 'wpsmt-smart-salesmate'); ?></option>
                                <?php            
                            }
                        }
                    ?>
                </select>
            </td>
        </tr>

        <!-- WP Fields Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'WP Fields', 'wpsmt-smart-salesmate' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="wp_field">
                    <option><?php echo  esc_html__('Please select WP Modules', 'wpsmt-smart-salesmate'); ?></option>
                </select>
            </td>
        </tr>

        <!-- Salesmate Modules Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'Salesmate Modules', 'wpsmt-smart-salesmate' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="salesmate_module">
                    <option><?php echo  esc_html__('Select Salesmate Module', 'wpsmt-smart-salesmate'); ?></option>
                    <?php
                        $salesmate_modules_options = "";

                        if($getListModules['modules']){
                            foreach ($getListModules['modules'] as $key => $singleModule) {
                                if( $singleModule['deletable'] &&  $singleModule['creatable'] ){
                    ?>
                                <option value = '<?php echo $singleModule['api_name']; ?>'> 
                                    <?php echo  esc_html__($singleModule['plural_label'], 'wpsmt-smart-salesmate'); ?>
                                </option>
                    <?php                
                                }
                            }
                        }
                    ?>
                </select>
            </td>
        </tr>

        <!-- Salesmate Fields Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'Salesmate Fields', 'wpsmt-smart-salesmate' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="salesmate_field">
                    <option><?php echo  esc_html__('Please select Salesmate Modules', 'wpsmt-smart-salesmate'); ?></option>
                </select>
            </td>
        </tr>

        <!-- Salesmate Modules Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'Status', 'wpsmt-smart-salesmate' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="status">
                    <option value="active"><?php echo esc_html__( 'Active', 'wpsmt-smart-salesmate' ); ?></option>
                    <option value="inactive"><?php echo esc_html__( 'In Active', 'wpsmt-smart-salesmate' ); ?></option>
                </select>
            </td>
        </tr>

        <!-- Salesmate Modules Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo esc_html__( 'Description', 'wpsmt-smart-salesmate' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <textarea name="description" rows="5" cols="46"></textarea>
            </td>
        </tr>

    </table>

    <p class="submit">
        <input type="submit" name="add_mapping" class="button-primary woocommerce-save-button" value="<?php echo  esc_html__( 'Add Mapping', 'wpsmt-smart-salesmate' ); ?>">
    </p>
</form>