<?php
require_once '../app/ClassConnection.php';

class AuthenticationServices
{
    private $connection;

    function __construct()
    {
        $this->connection = new ClassConnection();
    }

    public function loginVerify($login){

        try {
            $sql = "SELECT `login` FROM `usuarios` WHERE `login` = '$login'";
            $sqlResult = mysqli_query($this->connection->connect(), $sql);
            return mysqli_num_rows($sqlResult);            
        } catch (\Exception $error) {
            throw $error;
        }
    }

    protected function createNewUser($name, $login, $key) {
                
        try {
            $hashKey = password_hash($key, PASSWORD_DEFAULT);
            echo "Name: ".$name."<br>Login: ".$login."<br>key: ".$hashKey."<br>";
            $sql = "INSERT INTO `usuarios`(`nome`, `login`, `senha`) VALUES ('$name', '$login', '$hashKey')";

            $response = mysqli_query($this->connection->connect(), $sql);
            
            if(!$response){
                mysqli_close($this->connection->connect());
                throw new Exception("Response error");
            }else{
                header('location: sucess.php');
                mysqli_close($this->connection->connect());
            }
        } catch (\Exception $error) {
            throw $error;
        }
    }
}

?>