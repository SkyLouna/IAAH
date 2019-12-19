<?php

    /**
     * Author: Trana Valentin
     * Description:
     *              IAAH token class, compatible with json serialization
     */

    class IAAHToken implements JsonSerializable
    {
        protected $key;                 //Token key
        protected $result;              //Token result
        
        /**
         * IAAHToken constructor
         *
         * @param array $data
         */
        public function __construct(array $data) 
        {
            //Set key and result from data
            $this->key = $data['key'];
            $this->result = $data['result'];
        }
        
        /**
         * Gets the token key
         *
         * @return int
         */
        public function getKey() 
        {
            return $this->key;
        }
        
        /**
         * Gets the token result
         *
         * @return int
         */
        public function getResult() 
        {
            return $this->result;
        }

        /**
         * Serialize this object
         *
         * @return array
         */
        public function jsonSerialize()
        {
            return 
            [
                'key'   => $this->getKey(),
                'result' => $this->getResult()
            ];
        }
    }
?>