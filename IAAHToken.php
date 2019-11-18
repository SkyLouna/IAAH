<?php

    class IAAHToken {

        protected $key;
        protected $result;

        /**
         * IAAHToken constructor
         */
        function __construct($key, $result){
            $this->key = $key;
            $this->result = $result;
        }

        /**
         * Get the value of key
         */ 
        public function getKey()
        {
                return $this->key;
        }

        /**
         * Get the value of result
         */ 
        public function getResult()
        {
                return $this->result;
        }
    }

?>