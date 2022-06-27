<?php
require_once '../src/ClassRegister.php';

class RegisterQuery extends ClassRegister{

    private $connection;

    function __construct(){
        $this->connection = new ClassConnection();    
    }

    public function loginVerify($login){

        try {
            $sql = "SELECT `login` FROM `usuarios` WHERE `login` = '$login'";
            $sqlResult = mysqli_query($this->connection->connect(), $sql);
            return mysqli_num_rows($sqlResult);            
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }

    protected function createNewUser($name, $login, $key) {
        try {
            $sql = "INSERT INTO `usuarios`(`nome`, `login`, `senha`) VALUES ('$name ', '$login', '$key')";
            mysqli_query($this->connection->connect(), $sql);
            header('location: sucess.php');
            mysqli_close($this->connection->connect());
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }
}

?>