<?php

    class IAAHToken implements JsonSerializable
    {
        protected $key;
        protected $result;
        
        public function __construct(array $data) 
        {
            $this->key = $data['key'];
            $this->result = $data['result'];
        }
        
        public function getKey() 
        {
            return $this->key;
        }
        
        public function getResult() 
        {
            return $this->result;
        }

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