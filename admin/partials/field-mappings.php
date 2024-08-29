<div class="loader"></div>

<form method="post" action="<?php echo admin_url('/admin.php?page=wpspi-smart-pipedrive-mappings') ?>" id="wpspi-smart-pipedrive-mappings-form">

    <h2><?php echo esc_html__('Fields Mapping', 'wpspi-smart-pipedrive'); ?></h2>

    <table class="form-table">
        <!-- WP Modules Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'WP Modules', 'wpspi-smart-pipedrive' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="wp_module">
                    <option><?php echo  esc_html__('Select Module', 'wpspi-smart-pipedrive'); ?></option>
                    <?php 
                        if($wp_modules){
                            foreach ($wp_modules as $key => $singleModule) {
                                ?>            
                                <option value = "<?php echo $key; ?>"><?php echo esc_html__($singleModule, 'wpspi-smart-pipedrive'); ?></option>
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
                <label><?php echo  esc_html__( 'WP Fields', 'wpspi-smart-pipedrive' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="wp_field">
                    <option><?php echo  esc_html__('Please select WP Modules', 'wpspi-smart-pipedrive'); ?></option>
                </select>
            </td>
        </tr>

        <!-- Pipedrive Modules Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'Pipedrive Modules', 'wpspi-smart-pipedrive' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="pipedrive_module">
                    <option><?php echo  esc_html__('Select Pipedrive Module', 'wpspi-smart-pipedrive'); ?></option>
                    <?php
                        $pipedrive_modules_options = "";

                        if($getListModules['modules']){
                            foreach ($getListModules['modules'] as $key => $singleModule) {
                                if( $singleModule['deletable'] &&  $singleModule['creatable'] ){
                    ?>
                                <option value = '<?php echo $singleModule['api_name']; ?>'> 
                                    <?php echo  esc_html__($singleModule['plural_label'], 'wpspi-smart-pipedrive'); ?>
                                </option>
                    <?php                
                                }
                            }
                        }
                    ?>
                </select>
            </td>
        </tr>

        <!-- Pipedrive Fields Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'Pipedrive Fields', 'wpspi-smart-pipedrive' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="pipedrive_field">
                    <option><?php echo  esc_html__('Please select Pipedrive Modules', 'wpspi-smart-pipedrive'); ?></option>
                </select>
            </td>
        </tr>

        <!-- Pipedrive Modules Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'Status', 'wpspi-smart-pipedrive' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="status">
                    <option value="active"><?php echo esc_html__( 'Active', 'wpspi-smart-pipedrive' ); ?></option>
                    <option value="inactive"><?php echo esc_html__( 'In Active', 'wpspi-smart-pipedrive' ); ?></option>
                </select>
            </td>
        </tr>

        <!-- Pipedrive Modules Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo esc_html__( 'Description', 'wpspi-smart-pipedrive' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <textarea name="description" rows="5" cols="46"></textarea>
            </td>
        </tr>

    </table>

    <p class="submit">
        <input type="submit" name="add_mapping" class="button-primary woocommerce-save-button" value="<?php echo  esc_html__( 'Add Mapping', 'wpspi-smart-pipedrive' ); ?>">
    </p>
</form>