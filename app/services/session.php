<?php
require_once '../app/ClassConnection.php';

class SeesionServices
{

    private $connection;

    function __construct()
    {
        $this->connection = new ClassConnection();
    }

    public function getSessionData(){        
    
        $data = self::getDataById($_SESSION['id_usuario']);
        return $data;
    }

    public function getDataById($id)
    {

        try {
            $sql = "SELECT * FROM usuarios WHERE id = '$id'";

            $result = mysqli_query($this->connection->connect(), $sql);
            $data = mysqli_fetch_array($result);
            mysqli_close($this->connection->connect());

            return $data;
        } catch (\Exception $error) {
            echo $error->getMessage();
        }
    }

    public function getDataByUsername($login)
    {
        try {
            $sql = "SELECT * FROM `usuarios` WHERE (`usuarios`.`login` = '$login')";
            $rowResult  = mysqli_query($this->connection->connect(), $sql);
            $query = $rowResult->fetch_array();

            if(!$query){
                throw new \Exception("User or password Invalid");
            } else{
                return $query;
            }
        } catch (\Exception $error) {
            throw $error;
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
            throw new \Exception("User or password Invalid");
        }
    }
}
