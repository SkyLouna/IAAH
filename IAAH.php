<?php

    require_once 'scenarios/DefaultScenario.php';

    class IAAH {

        protected $PRIVATEKEY = '190497501589';

        protected static $enabledscenarios = null;

        static function getEnabledScenarios(){
            if(IAAH::$enabledscenarios != null){
                return IAAH::$enabledscenarios;
            }

            IAAH::$enabledscenarios = array(
                new DefaultScenario()
            );
            
            return IAAH::$enabledscenarios;
        }


        static function generateRandomScenario() : IAAHScenario {
            $randIndex = array_rand(IAAH::getEnabledScenarios());
            
            $scenario = IAAH::getEnabledScenarios()[$randIndex];

            return $scenario;
        }

        /**
         * Gets the scenario by name
         */
        static function getScenario($name){
            
            foreach(IAAH::getEnabledScenarios() as $scenario){
                if($scenario->getName() == $name){
                    return $scenario;
                }
            }

            return null;
        }

        static function checkUser($post) : bool {
            if(!isset($post['iaah_name']) || $post['iaah_name'] == ''){
                return false;
            }

            if(!isset($post['iaah_data']) || $post['iaah_data'] == ''){
                return false;
            }

            if(!isset($post['iaah_result']) || $post['iaah_result'] == ''){
                return false;
            }

            $scenario = IAAH::getScenario($post['iaah_name']);
            $data = unserialize($_POST['iaah_data']);
            $result = $_POST['iaah_result'];

            return $scenario->checkReceivedData($result, $data);
        }

        
        static function generateRandomToken() : IAAHToken {
            $randomKey = rand(0, 100000);
            $randomResult = (rand(1,10) * ($randomKey*$randomKey)) / 100;

            $token = new IAAHToken(array('key'=>$randomKey, 'result'=>$randomResult));

            IAAHFileUtils::saveToken($token);

            return $token;
        }

    }


?>