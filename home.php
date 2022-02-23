<?php
//conexão
require_once 'ClassId.php';

//sessão
session_start();

//Verificação de acesso
if(!isset ($_SESSION['logged'])){
  
    header('Location: index.php');
}

$homepage = new Id();
$data = $homepage->sessionData();

?>

<html>
<head>
<meta charset="utf-8">
    <title>Página Restrita</title>
    <meta chrset="utf-8">

</head>
<body>

<h1> Olá, <?php echo $data['nome']; ?></h1>

<a href="logout.php">Logout</a>

</body>


</html>