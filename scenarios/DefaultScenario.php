<?php

    require_once 'IAAHScenario.php';

    class DefaultScenario extends IAAHScenario{

        public function __construct(){
            parent::__construct('DefaultScenario');
        }

        public function getFormContent($token, $formData){
            $a = $formData['a'];
            $b = $formData['b'];

            ob_start();
            include 'views/DefaultScenarioView.php';
            $view = ob_get_clean();

            return $view;
        }

        public function getFormData($token){
            $a = rand(2,10);
            $b = rand(2,10);

            $q = $token->getResult() / ($a * $b);
            return array('key'=>$token->getKey(), 'a'=> $a, 'b' => $b, 'q' => $q);
        }

        public function checkReceivedData($result, $data){
            $dataQ = $data['q'];
            $dataKey = $data['key'];

            $token = IAAHFileUtils::getToken($dataKey);

            if($token == null){
                return false;
            }

            return ($dataQ * $result) == $token->result;
        }
    }


?>