<?php

class InputError {
    
    public $message;
    public $code;

    private function __construct($code, $message){
        $this->code = $code;
        $this->error = $message;
    }

    public function getMessage(){
        return $this->message;
    }
    public function getCode(){
        return $this->code;
    }
}
?>