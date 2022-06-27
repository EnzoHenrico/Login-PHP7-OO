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
            $sql = "SELECT `login` FROM `usuarios` WHERE `login` = '$login'";
            $sqlResult = mysqli_query($this->connection->connect(), $sql);
            return mysqli_num_rows($sqlResult);
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }
}
