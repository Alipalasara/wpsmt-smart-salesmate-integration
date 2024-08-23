<?php
class GetFieldsMetaData{
    public function execute($module = NULL){

        if ($module == 'contact') {
                    $GetFieldsMetaData = array(
                                                'fields' => array(
                                                                    'owner' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Owner',
                                                                                'api_name' => 'owner'
                                                                            ),

                                                                     'firstName' => array(
                                                                                'system_mandatory' => 1,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'FirstName',
                                                                                'api_name' => 'firstName'
                                                                            ),

                                                                    'lastName' => array(
                                                                                'system_mandatory' => 1,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'LastName',
                                                                                'api_name' => 'lastName'
                                                                            ),
                                                                    'tags' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Tags',
                                                                                'api_name' => 'tags'
                                                                            ),
                                                                    'mobile' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Mobile',
                                                                                'api_name' => 'mobile'
                                                                            ),
                                                                    'company' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Company',
                                                                                'api_name' => 'company'
                                                                            ),
                                                                    'email' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Email',
                                                                                'api_name' => 'email'
                                                                            ),
                                                                    'website' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Website',
                                                                                'api_name' => 'website'
                                                                            ),
                                                             
                                                                    'googlePlusHandle' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Google PlusHandle',
                                                                                'api_name' => 'googlePlusHandle'
                                                                            ),    

                                                                    'linkedInHandle' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'LinkedIn Handle',
                                                                                'api_name' => 'linkedInHandle'
                                                                            ),
                                                                    'phone' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Phone',
                                                                                'api_name' => 'phone'
                                                                            ),
                                                                    'skypeId' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Skype ID',
                                                                                'api_name' => 'skypeId'
                                                                            ),
                                                                    'facebookHandle' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Facebook Handle',
                                                                                'api_name' => 'facebookHandle'
                                                                            ),
                                                                    'twitterHandle' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Twitter Handle',
                                                                                'api_name' => 'twitterHandle'
                                                                            ),
                                                             
                                                                    'currency' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Currency',
                                                                                'api_name' => 'currency'
                                                                            ),


                                                                    'designation' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Designation',
                                                                                'api_name' => 'designation'
                                                                            ),
                                                             
                                                                    'billingAddressLine1' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Billing AddressLine 1',
                                                                                'api_name' => 'billingAddressLine1'
                                                                            ),    

                                                                    'billingCity' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Billing City',
                                                                                'api_name' => 'billingCity'
                                                                            ),
                                                                    'billingZipCode' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Billing ZipCode',
                                                                                'api_name' => 'billingZipCode'
                                                                            ),
                                                                    'billingState' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Billing State',
                                                                                'api_name' => 'billingState'
                                                                            ),
                                                                    'billingCountry' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Billing Country',
                                                                                'api_name' => 'billingCountry'
                                                                            ),
                                                                    'description' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Description',
                                                                                'api_name' => 'description'
                                                                            ),       
                                                    ),
                                            );

                    }elseif ($module == 'company') {
 
                     $GetFieldsMetaData = array(
                                        'fields' => array(
                                                        'name' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Name',
                                                                    'api_name' => 'name'
                                                                ),
                                                        'owner' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Owner',
                                                                    'api_name' => 'owner'
                                                                ),
                                                        'website' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Website',
                                                                    'api_name' => 'website'
                                                                ),
                                                        
                                                        'phone' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Phone',
                                                                    'api_name' => 'phone'
                                                                ),
                                                        'skypeId' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Skype ID',
                                                                    'api_name' => 'skypeId'
                                                                ),
                                                        'facebookHandle' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Facebook Handle',
                                                                    'api_name' => 'facebookHandle'
                                                                ),
                                                        'twitterHandle' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Twitter Handle',
                                                                    'api_name' => 'twitterHandle'
                                                                ),
                                                        'googlePlusHandle' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'GooglePlus Handle',
                                                                    'api_name' => 'googlePlusHandle'
                                                                ),
                                                        'linkedInHandle' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Twitter Handle',
                                                                    'LinkedIn Handle' => 'linkedInHandle'
                                                                ),
                                                 
                                                        'currency' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Currency',
                                                                    'api_name' => 'currency'
                                                                ),
                                                        'billingAddressLine1' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Billing AddressLine 1',
                                                                                'api_name' => 'billingAddressLine1'
                                                                ),    
                                                        'billingCity' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Billing City',
                                                                    'api_name' => 'billingCity'
                                                                ),
                                                        'billingZipCode' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Billing ZipCode',
                                                                    'api_name' => 'billingZipCode'
                                                                ),
                                                        'billingState' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Billing State',
                                                                    'api_name' => 'billingState'
                                                                ),
                                                        'billingCountry' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Billing Country',
                                                                    'api_name' => 'billingCountry'
                                                                ),

                                                        'description' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Organization ID',
                                                                    'api_name' => 'organization_id'
                                                                ),
                                                    ),
                                    );
                }elseif($module == 'deal'){
                     $GetFieldsMetaData = array(
                                    'fields' => array(
                                                        'title' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Title',
                                                                    'api_name' => 'title'
                                                                ),
                                                        'primaryContact' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Primary Contact',
                                                                    'api_name' => 'primaryContact'
                                                                ),
                                                        'owner' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Owner ',
                                                                    'api_name' => 'owner'
                                                                ),
                                                        'pipeline' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Pipeline',
                                                                    'api_name' => 'pipeline'
                                                                ),
                                                        'status' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Status',
                                                                    'api_name' => 'status'
                                                                ),
                                                        'stage' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Stage',
                                                                    'api_name' => 'stage'
                                                                ),
                                                        'primaryCompany' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Primary Company',
                                                                    'api_name' => 'primaryCompany'
                                                                 ),
                                                        'source' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Source',
                                                                    'api_name' => 'source'
                                                                ),
                                                        'estimatedCloseDate' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Estimated CloseDate',
                                                                    'api_name' => 'estimatedCloseDate'
                                                                ),
                                                        'dealValue' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Deal Value',
                                                                    'api_name' => 'dealValue'
                                                                ),
                                                        'currency' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Currency',
                                                                    'api_name' => 'currency'
                                                                ),
                                                        'priority' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Priority',
                                                                    'api_name' => 'priority'
                                                                ),
                                                        'followers' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Followers',
                                                                    'api_name' => 'followers'
                                                                ),
                                                       
                                                    ),
                                            );

                }elseif($module == 'activity'){
                     $GetFieldsMetaData = array(
                                    'fields' => array(
                                                        'title' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Title',
                                                                    'api_name' => 'title'
                                                                ),
                                                        'owner' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Owner',
                                                                    'api_name' => 'owner'
                                                                ),
                                                        'type' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Type',
                                                                    'api_name' => 'type'
                                                                ),
                                                        'description' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Description',
                                                                    'api_name' => 'description'
                                                                ),
                                                        'dueDate' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Due Date',
                                                                    'api_name' => 'dueDate'
                                                                ),
                                                        'duration' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Duration',
                                                                    'api_name' => 'duration'
                                                                ),
                                                        'followers' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Followers',
                                                                    'api_name' => 'followers'
                                                                ),
                                                        ),
                                                   
                                );   
                 }
                return $GetFieldsMetaData;
            }
        }

