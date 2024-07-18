<?php
    global $wpdb;
    $fieldlists = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}smart_salesmate_field_mapping");
?>
    <h2><?php echo esc_html__('Fields Mapping List'); ?></h2>

    <table id="mapping-list-table" class="wp-list-table widefat fixed striped table-view-list display">
        <thead>
            <th><?php echo esc_html__('Id', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('Salesmate Module', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('Salesmate Field', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('WP Module', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('WP Field', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('Status', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('Description', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('Action', 'wpsmt-smart-salesmate'); ?></th>
        </thead>

        <tfoot>
            <th><?php echo esc_html__('Id', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('Salesmate Module', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('Salesmate Field', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('WP Module', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('WP Field', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('Status', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('Description', 'wpsmt-smart-salesmate'); ?></th>
            <th><?php echo esc_html__('Action', 'wpsmt-smart-salesmate'); ?></th>
        </tfoot>
        <tbody>
            <!-- WP Modules Row -->
            <?php
                if ( $fieldlists ) {
                    foreach ( $fieldlists as $singlelist ) {
                        ?>
                        <tr>
                            <td><?php echo esc_html__($singlelist->id, 'wpsmt-smart-salesmate'); ?></td>
                            <td><?php echo esc_html__($singlelist->salesmate_module, 'wpsmt-smart-salesmate'); ?></td>
                            <td><?php echo esc_html__($singlelist->salesmate_field, 'wpsmt-smart-salesmate'); ?></td>
                            <td><?php echo esc_html__($singlelist->wp_module, 'wpsmt-smart-salesmate'); ?></td>
                            <td><?php echo esc_html__($singlelist->wp_field, 'wpsmt-smart-salesmate'); ?></td>
                            <td><?php echo ucfirst( esc_html__($singlelist->status, 'wpsmt-smart-salesmate') ); ?></td>
                            <td><?php echo esc_html__($singlelist->description, 'wpsmt-smart-salesmate'); ?></td>
                            <td>
                                <?php if($singlelist->is_predefined != 'yes' ){ ?>
                                    <a href="<?php echo admin_url('admin.php?page=wpsmt-smart-salesmate-mappings&action=trash&id='.$singlelist->id); ?>">
                                        <button type="submit"><?php echo esc_html__('Delete', 'wpsmt-smart-salesmate'); ?></button>
                                    </a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php
                    }   
                } else {
                    ?>
                    <tr>
                        <td colspan="7">
                            <?php echo esc_html__('No Record Found', 'wpsmt-smart-salesmate'); ?>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>