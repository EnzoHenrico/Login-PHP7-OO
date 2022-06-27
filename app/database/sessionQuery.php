<?php
require_once '../src/ClassLogin.php';

class SeesionQuery extends Session {

    private $connection;

    function __construct(){
        $this->connection = new ClassConnection();    
    }

    public function getDataById($id){
     
        try {
            $sql = "SELECT * FROM usuarios WHERE id = '$id'";

            $result = mysqli_query($this->connection->connect(), $sql);
            $data = mysqli_fetch_array($result);
            mysqli_close($this->connection->connect());
            
            return $data;    
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }
}

?>