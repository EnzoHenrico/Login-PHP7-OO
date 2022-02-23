<?php

//conexão
require_once "ClassConnection.php";
require_once "ClassLogin.php";

session_start();

if(isset($_POST['btn-login'])){

  $classLogin = new ClassLogin( $_POST['login'], $_POST['key']);
  $loginError = $classLogin->getLoginError();
}

?>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="CSS/style.css">

</head>
<body>

<div name="login" class="loginField">
    <section id ="animar" class="loginBlock">
        
        <!-- Bloco de login-->   
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
if (!empty($loginError)){  
  foreach ($loginError as $log){
      echo $log;
  }
}
?>
<!-- Fim do log-->

</div>
            <div class="btn-login">
                <button type="submit" name="btn-login">Send</button>
            </div>
 
        </form>
    </section>
</div>
</body>
</html>