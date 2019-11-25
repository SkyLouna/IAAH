<?php

    require_once 'IAAHScenario.php';

    class DefaultScenario extends IAAHScenario{

        public function __construct(){
            parent::__construct('DefaultScenario');
        }

        public function getFormContent($token){
            return '';
        }

        public function getFormData($token){
            return array('key'=>$token->getKey());
        }

        public function checkReceivedData($result, $data){
            return false;
        }
    }


?>