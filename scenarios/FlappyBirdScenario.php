<?php

    require_once 'IAAHScenario.php';

    class FlappyBirdScenario extends IAAHScenario{

        public function __construct(){
            parent::__construct('FlappyBirdScenario');
        }

        public function getFormContent($token, $formData){
            $goal = $formData['goal'];

            ob_start();
            include 'views/FlappyBirdScenarioView.php';
            $view = ob_get_clean();

            return $view;
        }

        public function getFormData($token){

            return array('key'=>$token->getKey(), 'goal' => 600);
        }

        public function checkReceivedData($result, $data){
            $dataKey = $data['key'];

            $token = IAAHFileUtils::getToken($dataKey);

            if($token == null){
                return false;
            }

            $dataGoal = $data['goal'];

            return $dataGoal + 1 == $result;
        }
    }


?>