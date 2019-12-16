<?php

    require_once 'IAAHToken.php';
    require_once 'IAAHFileutils.php';

    class IAAHScenario {

        protected $name;

        public function __construct($name) 
        {
            $this->name = $name;
        }

        public function getIAAHForm($token, $ajaxSubmit = false){

            $form = '';

            if($ajaxSubmit){
                $form .= file_get_contents('javascript/ajaxSubmit.js');
            }

            $formData = $this->getFormData($token);

            $form .= '<div id="iaah" style="border: black 1px solid; padding: 20px 0px 0px 20px;">';

            $form .='<div id="iaah_form">';

            

            $form .= '<legend style="border-bottom: black 1px solid; margin-bottom: 10px; width: 15%; font-size: 40px; text-align: center;">IAAH</legend>';

            $form .= '<input type="hidden" name="iaah_name" value="'.$this->name.'" />';

            $form .= '<input type="hidden" name="iaah_data" value="'.htmlentities(serialize($formData)).'" />';

            $form .= $this->getFormContent($token, $formData);

            if($ajaxSubmit){
                $form .= '<p><button id="iaah_ajaxsendbtn" onclick="return false;">Check IAAH</button></p>';
            }

            $form .= '</div>';

            $form .= '</div>';

            return $form;
        }

        public function getFormContent($token, $formData){
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