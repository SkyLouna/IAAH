<?php

    require_once 'IAAHToken.php';

    class IAAHFileUtils {

        protected static $FILEPATH = 'data/data.json';
        protected static $KEY_MAX_AMOUNT = 5;
        protected static $KEY_REMOVE_AMOUNT = 1;

        static function readTokens() :array {
            $fileData = file_get_contents(IAAHFileUtils::$FILEPATH);

            $tokensArray = json_decode($fileData);

            if($tokensArray == null){
                return array();
            }

            $tokens = array();

            foreach($tokensArray as $token){
                $tokens[] = json_decode($token);
            }

            //If there are more tokens stored than allowed
            if(count($tokens) > IAAHFileUtils::$KEY_MAX_AMOUNT){

                //Remove the first N elements
                for ($i = 0; $i < IAAHFileUtils::$KEY_REMOVE_AMOUNT; $i++) {
                    //Remove first element of the array
                    $result = array_shift($tokens);

                    //if removed element is null, stop removing elements
                    if (is_null($result)) {
                      break;
                    }
                }
            }

            

            return $tokens;
        }

        static function getToken($key){
            $tokens = IAAHFileUtils::readTokens();

            /*foreach($tokens as $token){
                if($token->key == $key){
                    return $token;
                }
            }*/

            $arrayCount = count($tokens);

            for($i = 0; $i < $arrayCount; $i++){
                if($tokens[$i]->key == $key){

                    $token = $tokens[$i];
                    unset($tokens[$i]);

                    IAAHFileUtils::saveTokens($tokens);

                    return $token;
                }
            }

            return null;
        }

        static function saveToken($token){
            $actualTokens = IAAHFileUtils::readTokens();

            $actualTokens[] = $token;

            IAAHFileUtils::saveTokens($actualTokens);
        }

        static function saveTokens($tokens){
            $fileData = array();

            foreach($tokens as $token){
                $fileData[] = json_encode($token);
            }

            $file = fopen(IAAHFileUtils::$FILEPATH, "w") or die('IAAH: Unable to write to file');
            fwrite($file, json_encode($fileData));
            fclose($file);
        }


    }

?>