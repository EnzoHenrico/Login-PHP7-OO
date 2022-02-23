<?php

//Conexão com banco de dados
class ClassConnection{

    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $db_name = "sistemalogin";

    public function connect(){
        
    $connect = mysqli_connect($this->servername, $this->username, $this->password, $this->db_name);
    mysqli_set_charset($connect, "utf-8");
        
        if(mysqli_connect_error()){
          
            echo "Falha na conexão: ".mysqli_connect_error();
        } 
        return $connect;
    }

    public function clean($input){

        $clean = mysqli_escape_string($this->connect(), $input);
        return $clean;
    }
}



?>