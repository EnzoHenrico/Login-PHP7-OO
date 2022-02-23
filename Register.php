<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="CSS/style.css">
</head>
<body>
  
<?php
require_once 'ClassRegisterFunctions.php';
require_once 'ClassRegister.php';

$registerError[0] = "";
$registerError[1] = "";
$registerError[2] = ""; 
$registerError[3] = "";
$registerError[4] = "";

if(isset($_POST['btn-login'])){

  $classRegister = new ClassRegister($_POST['createName'], $_POST['createLogin'], $_POST['createKey'], $_POST['confirmKey']);
  
  $registerError = $classRegister->getRegisterError();

}

?>
<div name="createAccount" class="createField">
    <section id="animar"class="createBLock">

        <!-- Bloco de login-->   
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h1 class="register">Create account</h1>    
        <div class="textField" name="user">  

            <!-- Input Login -->
            <label for="createLogin">Login Username:</label> 
            <input type="text" class="createLogin" name="createLogin"><br>
            <?php echo '<div class="errorLog">'.$registerError[0].'</div>';?>

            <!-- Input Nome -->
            <label for="createName">Your Name:</label> 
            <input type="text" class="createName" name="createName"><br>
            <?php echo '<div class="errorLog">'.$registerError[1].'</div>';?>

            <!-- Input Senha -->
            <label for="createKey">Password:</label> 
            <input type="password" class="createKey" name="createKey"><br>
            <?php echo '<div class="errorLog">'.$registerError[2].'</div>';?>

            <!-- Input Confirmar Senha -->
            <label for="confirmKey">Confirm Password:</label> 
            <input type="password" class="confirmKey" name="confirmKey"><br>
            <?php echo '<div class="errorLog">'.$registerError[3].'</div>';?>

        </div>
<div class="errorLog">
<!-- erro PHP-->
<?php echo '<div class="errorLog">'.$registerError[4].'</div>';?>

</div>
            <div class="btn-login">
                <button type="submit" name="btn-login">Create</button>
            </div>
        </form>
    </section>
</div>
</body>
</html>