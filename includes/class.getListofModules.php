<?php
class GetListofModules{
    
      public function execute(){
        $getListModules = array(
                        'modules' => array(
                                            'contact' => array(
                                                        'creatable' => 1,
                                                        'deletable' => 1,
                                                        'api_name' =>  'contact',
                                                        'plural_label' =>  'Contact',
                                                        ),
                                            'deal' => array(
                                                        'creatable' => 1,
                                                        'deletable' => 1,
                                                        'api_name' =>  'deal',
                                                        'plural_label' =>  'Deal',
                                                        ),
                                            'company' => array(
                                                        'creatable' => 1,
                                                        'deletable' => 1,
                                                        'api_name' =>  'company',
                                                        'plural_label' =>  'Company',
                                                        ),
                                            'activity' => array(
                                                        'creatable' => 1,
                                                        'deletable' => 1,
                                                        'api_name' =>  'activity',
                                                        'plural_label' =>  'Activity',
                                                        ),
                                        )
        );
        return $getListModules;
    }
}