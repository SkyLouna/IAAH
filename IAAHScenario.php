<?php

    require_once 'IAAHToken.php';
    require_once 'IAAHFileutils.php';

    class IAAHScenario {

        protected $name;

        public function __construct($name) 
        {
            $this->name = $name;
        }

        public function getIAAHForm($token){
            $form = '<div id="iaah">';
            
            $form .= '<input type="hidden" name="iaah_name" value="'.$this->name.'" />';

            $form .= '<input type="hidden" name="iaah_data" value="'.htmlentities(serialize($this->getFormData($token))).'" />';

            $form .= $this->getFormContent($token);

            $form .= '</div>';
            return $form;
        }

        public function getFormContent($token){
            return '';
        }

        public function getFormData($token){
            return array();
        }

        public function checkReceivedData($result, $data){
            return false;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }
    }


?>