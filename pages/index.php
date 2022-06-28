<?php
require_once "../app/src/ClassConnection.php";
require_once "../app/src/ClassLogin.php";
session_start();

if(isset($_POST['btn-login'])){

  $classLogin = new ClassLogin($_POST['login'], $_POST['key']);
  $loginError = $classLogin->getLoginError();
}
?>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../style/stylesheet.css">
</head>
<body>
    <div name="login" class="loginField">
        <section id ="animar" class="loginBlock">         
            <!-- login -->   
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <h1 class="index">Login</h1>     
                <div class="textField" name="user">                      
                    <label for="login">Username:</label> 
                    <input type="text" class="login" name="login"><br>       
                    <label for="key">Password:</label> 
                    <input type="password" class="key" name="key"><br>
                </div>
                <a href="register.php">Or create your acoount</a>
                <div class="errorLog">
                <!-- Log de erros PHP-->
                <?php
                    if(isset($loginError)){
                        echo $loginError;
                    } 
                ?>
                </div>
            <div class="btn-login">
                <button type="submit" name="btn-login">Send</button>
            </div>
        </form>
    </section>
</div>
</body>
</html>