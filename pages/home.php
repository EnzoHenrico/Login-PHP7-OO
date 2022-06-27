<?php
require_once '../classes/ClassId.php';

session_start();

if(!isset ($_SESSION['logged'])){
    header('Location: index.php');
}

$homepage = new Session();
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