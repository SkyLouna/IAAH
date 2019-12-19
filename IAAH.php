<?php

    /**
     * Author: Trana Valentin
     * Description:
     *              Main IAAH class
     */

    require_once 'scenarios/DefaultScenario.php';
    require_once 'scenarios/FlappyBirdScenario.php';

    //IF no session, start it
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }


    class IAAH {

        protected static $enabledscenarios = null;      //List of enabled scenarios

        /**
         * Gets the enabled scenarios
         *
         * @return array
         */
        static function getEnabledScenarios(){

            //If enabled scenarios not null, return it
            if(IAAH::$enabledscenarios != null){
                return IAAH::$enabledscenarios;
            }

            //Init the enabled scenarios
            IAAH::$enabledscenarios = array(
                new DefaultScenario(),          //x + y = z scenario
                new FlappyBirdScenario()        //flappy bird with a cube scenario
            );
            
            return IAAH::$enabledscenarios;
        }

        /**
         * Picks up a random scenario from the scenario list
         *
         * @return IAAHScenario
         */
        static function generateRandomScenario() : IAAHScenario {
            //Get random index
            $randIndex = array_rand(IAAH::getEnabledScenarios());
            
            //Get the scenario
            $scenario = IAAH::getEnabledScenarios()[$randIndex];

            //Return the scenario
            return $scenario;
        }

        /**
         * Gets the scenario by name
         * 
         * @return IAAHSCenario
         */
        static function getScenario($name){
            
            //Foreach scenario in scenario list
            foreach(IAAH::getEnabledScenarios() as $scenario){

                //Check if have the same name
                if($scenario->getName() == $name){
                    return $scenario;
                }
            }

            return null;
        }

        /**
         * Checks if user has passed the IAAH form
         *
         * @param array $post
         * @return boolean
         */
        static function checkUser($post) : bool {

            //IF user has an access token
            if(isset($_SESSION['iaah_accesstoken']) && $_SESSION['iaah_accesstoken'] != ''){
                $accessToken = IAAHFileUtils::getToken($_SESSION['iaah_accesstoken']);

                //If token exists, user can pass
                if($accessToken != null){
                    return true;
                }
            }

            //If there is no scenario name
            if(!isset($post['iaah_name']) || $post['iaah_name'] == ''){
                return false;
            }

            //If there is no scenario data
            if(!isset($post['iaah_data']) || $post['iaah_data'] == ''){
                return false;
            }

            //If there is no scenario result
            if(!isset($post['iaah_result']) || $post['iaah_result'] == ''){
                return false;
            }

            //Get the scenario to check
            $scenario = IAAH::getScenario($post['iaah_name']);
            $data = unserialize($_POST['iaah_data']);
            $result = $_POST['iaah_result'];

            return $scenario->checkReceivedData($result, $data);
        }

        
        /**
         * Generates a random token
         * 
         * @return IAAHToken
         */
        static function generateRandomToken() : IAAHToken {
            $randomKey = rand(0, 100000);
            $randomResult = (rand(1,10) * ($randomKey*$randomKey)) / 100;

            //Init the token
            $token = new IAAHToken(array('key'=>$randomKey, 'result'=>$randomResult));

            //Save the token
            IAAHFileUtils::saveToken($token);

            return $token;
        }

    }


?>