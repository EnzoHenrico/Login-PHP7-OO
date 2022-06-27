<?php
require_once '../src/ClassLogin.php';

class SeesionQuery extends Session
{

    private $connection;

    function __construct()
    {
        $this->connection = new ClassConnection();
    }

    public function getDataById($id)
    {

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

    public function getDataByUsername($login)
    {
        try {
            $sql = "SELECT * FROM `usuarios` WHERE (`usuarios`.`login` = '$login')";
            $rowResult  = mysqli_query($this->connection->connect(), $sql);

            return $rowResult->fetch_array();
        } catch (Exception $error) {
            $error->getMessage();
        }
    }

    public function authenticateSession($data, $key)
    {

        if (password_verify($key, $data['senha'])) {

            $_SESSION['logged'] = true;
            $_SESSION['id_usuario'] = $data['id'];

            header('location: home.php');
            mysqli_close($this->connection->connect());
        } else {
            $this->loginError[1] = "User and Password don't match.";
        }
    }
}
