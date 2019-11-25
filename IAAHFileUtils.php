<?php

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

        static function saveToken($token){
            $actualTokens = IAAHFileUtils::readTokens();

            $actualTokens[] = $token;
            var_dump($actualTokens);

            $fileData = array();

            foreach($actualTokens as $tkn){
                $fileData[] = json_encode($tkn);
            }

            var_dump($fileData);
            var_dump(json_encode(array_values($fileData)));

            $file = fopen(IAAHFileUtils::$FILEPATH, "w") or die('IAAH: Unable to write to file');
            fwrite($file, json_encode($fileData));
            fclose($file);
        }


    }

?>