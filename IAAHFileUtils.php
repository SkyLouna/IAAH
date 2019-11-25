<?php

    require_once 'IAAHToken.php';

    class IAAHFileUtils {

        protected static $FILEPATH = 'data/data.json';

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

            return $tokens;
        }

        static function getToken($key){
            $tokens = IAAHFileUtils::readTokens();

            foreach($tokens as $token){
                if($token->key == $key){
                    return $token;
                }
            }

            return null;
        }

        static function saveToken($token){
            $actualTokens = IAAHFileUtils::readTokens();

            $actualTokens[] = $token;

            $fileData = array();

            foreach($actualTokens as $tkn){
                $fileData[] = json_encode($tkn);
            }

            $file = fopen(IAAHFileUtils::$FILEPATH, "w") or die('IAAH: Unable to write to file');
            fwrite($file, json_encode($fileData));
            fclose($file);
        }


    }

?>