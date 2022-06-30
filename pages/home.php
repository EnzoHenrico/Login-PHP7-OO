<?php
require_once '../app/services/session.php';

session_start();

if(!isset ($_SESSION['logged'])){
    header('Location: index.php');
}

$homepage = new SeesionServices();
$data = $homepage->getSessionData();

?>

<html>
<head>
<meta charset="utf-8">
    <title>Página Restrita</title>
    <meta chrset="utf-8">
    <link rel="stylesheet" href="../style/stylesheet.css">
</head>
<body>
    <div class="profileField">
        <section class="profileBlock">
                <h1 class="success">Ola, <?php echo  $data['nome']; ?></h1>    
                <div class="btn-redirect">
                    <a class="btn-redirect" href="logout.php">
                        <button type="submit" name="btn-redirect">Logout</button>
                    </a>
                </div>     
        </section>
    </div>
</body>
</html>