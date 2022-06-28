<?php
require_once '../app/src/ClassConnection.php';
class RegisterQuery
{
    // private $connection;

    // function __construct(){
    //     $this->connection = new ClassConnection();    
    // }

    public function loginVerify($login){
        $connection = new ClassConnection();  

        try {
            $sql = "SELECT `login` FROM `usuarios` WHERE `login` = '$login'";
            $sqlResult = mysqli_query($connection->connect(), $sql);
            return mysqli_num_rows($sqlResult);            
        } catch (\Exception $error) {
            echo "Verify Login Query Exp: ".$error;
        }
    }

    protected function createNewUser($name, $login, $key) {
        
        $connection = new ClassConnection();  
        
        try {
            $hashKey = password_hash($key, PASSWORD_DEFAULT);
            echo "Name: ".$name."<br>Login: ".$login."<br>key: ".$hashKey."<br>";
            $sql = "INSERT INTO `usuarios`(`nome`, `login`, `senha`) VALUES ('$name', '$login', '$hashKey')";

            $response = mysqli_query($connection->connect(), $sql);
            
            if(!$response){
                mysqli_close($connection->connect());
                throw new Exception("Response error");
            }else{
                header('location: sucess.php');
                mysqli_close($connection->connect());
            }
        } catch (\Exception $error) {
            echo $error;
        }
    }
}

?>