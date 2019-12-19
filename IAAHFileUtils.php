<?php

    /**
     * Author: Trana Valentin
     * Description:     
     *              File utils class
     */

    require_once 'IAAHToken.php';

    class IAAHFileUtils {

        protected static $FILEPATH = 'data/data.json';      //Tokens file
        protected static $KEY_MAX_AMOUNT = 100;               //Max tokens amount
        protected static $KEY_REMOVE_AMOUNT = 5;            //Tokens amount removed when max amount reached

        /**
         * Read all tokens from resource file
         *
         * @return array
         */
        static function readTokens() :array {
            //Read file contents
            $fileData = file_get_contents(IAAHFileUtils::$FILEPATH);

            //Decode json array
            $tokensArray = json_decode($fileData);

            //If null, return empty result
            if($tokensArray == null){
                return array();
            }

            $tokens = array();

            //Foreach json token, decode it
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

            //Return tokens
            return $tokens;
        }

        /**
         * Get a specific token from the file
         * 
         * @return IAAHToken
         */
        static function getToken($key) {
            //Read all tokens
            $tokens = IAAHFileUtils::readTokens();
            
            //Count amount of tokens
            $arrayCount = count($tokens);

            //Foreach token
            for($i = 0; $i < $arrayCount; $i++){
                if($tokens[$i]->key == $key){

                    //Get the token and remove from the main array
                    $token = $tokens[$i];
                    unset($tokens[$i]);

                    //Save the main array
                    IAAHFileUtils::saveTokens($tokens);

                    //Return token
                    return $token;
                }
            }

            return null;
        }

        /**
         * Saves the token to the tokens file
         *
         * @param IAAHToken $token
         * @return void
         */
        static function saveToken($token){
            //Read all tokens
            $actualTokens = IAAHFileUtils::readTokens();

            //Add the new one
            $actualTokens[] = $token;

            //Save the tokens
            IAAHFileUtils::saveTokens($actualTokens);
        }

        /**
         * Save tokens
         *
         * @param array $tokens
         * @return void
         */
        static function saveTokens($tokens){
            $fileData = array();

            //Foreach token, encode to the array
            foreach($tokens as $token){
                $fileData[] = json_encode($token);
            }

            //OPen file and encode array inside
            $file = fopen(IAAHFileUtils::$FILEPATH, "w") or die('IAAH: Unable to write to file');
            fwrite($file, json_encode($fileData));
            fclose($file);
        }


    }

?>