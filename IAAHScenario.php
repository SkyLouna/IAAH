<?php

    /**
     * Author: Trana Valentin
     * Description:
     *              IAAH Scenario class
     */

    require_once 'IAAHToken.php';
    require_once 'IAAHFileutils.php';

    class IAAHScenario {

        protected $name;    //Scenario name

        /**
         * IAAHScenario constructor
         *
         * @param string $name
         */
        public function __construct($name) 
        {
            $this->name = $name;
        }

        /**
         * Gets the IAAH check form
         *
         * @param IAAHToken $token
         * @param boolean $ajaxSubmit
         * @return string
         */
        public function getIAAHForm($token, $ajaxSubmit = false){
            //init form
            $form = '';

            //If use ajax submit, include the script
            if($ajaxSubmit){
                $form .= file_get_contents('javascript/ajaxSubmit.js');
            }

            //Get the form data
            $formData = $this->getFormData($token);

            //Add the first div
            $form .= '<div id="iaah" style="border: black 1px solid; padding: 20px 0px 0px 20px;">';

            //Form div
            $form .='<div id="iaah_form">'; 

            //Form legend with title
            $form .= '<legend style="border-bottom: black 1px solid; margin-bottom: 10px; width: 15%; font-size: 40px; text-align: center;">IAAH</legend>';

            //Scenario name
            $form .= '<input type="hidden" name="iaah_name" value="'.$this->name.'" />';

            //Scenario data
            $form .= '<input type="hidden" name="iaah_data" value="'.htmlentities(serialize($formData)).'" />';

            //Add form content
            $form .= $this->getFormContent($token, $formData);

            //If ajax submit, add a send iaah form button
            if($ajaxSubmit){
                $form .= '<p><button id="iaah_ajaxsendbtn" onclick="return false;">Check IAAH</button></p>';
            }

            //Close divs
            $form .= '</div>';

            $form .= '</div>';

            return $form;
        }

        /**
         * Gets the form content
         *
         * @param IAAHToken $token
         * @param array $formData
         * @return string
         */
        public function getFormContent($token, $formData){
            return '';
        }

        /**
         * Gets the form data
         *
         * @param IAAHToken $token
         * @return string
         */
        public function getFormData($token){
            return array();
        }

        /**
         * Checks if received data is correct
         *
         * @param string $result
         * @param array $data
         * @return boolean
         */
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