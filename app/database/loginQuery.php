<?php
class LoginQuery
{

    private $connection;

    function __construct()
    {
        $this->connection = new ClassConnection();
    }

    public function verifyLogin($login)
    {
        try {
            echo 'entrou try';
            $sql = "SELECT `login` FROM `usuarios` WHERE `login` = '$login'";
            $sqlResult = mysqli_query($this->connection->connect(), $sql);
            return mysqli_num_rows($sqlResult);
        } catch (Exception $error) {
            echo 'entrou catch - ';
            $log = $error->getMessage();
            echo $log;
            return $log;
            
        }
    }
}
