<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../style/stylesheet.css">
</head>
<body>
<?php
require_once '../app/controllers/ClassRegister.php';

$loginError = null;
$nameError = null;
$passwordError = null;
$confirmError = null;
$createError = null;

if(isset($_POST['btn-login'])){

    $usernameLogin = $_POST['createLogin'];
    $name = $_POST['createName']; 
    $passwordKey = $_POST['createKey']; 
    $passwordConfirmation = $_POST['confirmKey'];

    $classRegister = new ClassRegister($usernameLogin, $name, $passwordKey, $passwordConfirmation);

    $loginError = $classRegister->checkField($usernameLogin, "Login");
    $nameError = $classRegister->checkField($name, "Name");
    $passwordError = $classRegister->checkField($passwordKey, "Password");
    $confirmError = $classRegister->checkField($passwordConfirmation, "Confirmation");     

    $createError = $classRegister->createUser();
}
?>
<div name="createAccount" class="createField">
    <section id="animar"class="createBLock">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h1 class="register">Create account</h1>    
            <div class="textField" name="user">  
                <!-- Input Username -->
                <label for="createLogin">Login Username:</label> 
                <input type="text" class="createLogin" name="createLogin"><br>
                <?php if($loginError != null) echo '<div class="errorLog">'.$loginError.'<br></div>';?>
                <!-- Input Name -->
                <label for="createName">Your Name:</label> 
                <input type="text" class="createName" name="createName"><br>
                <?php if($nameError != null) echo '<div class="errorLog">'.$nameError.'<br></div>';?>
                <!-- Input PasswordKey -->
                <label for="createKey">Password:</label> 
                <input type="password" class="createKey" name="createKey"><br>
                <?php if($passwordError != null) echo '<div class="errorLog">'.$passwordError.'<br></div>';?>
                <!-- Input Confirm Key -->
                <label for="confirmKey">Confirm Password:</label> 
                <input type="password" class="confirmKey" name="confirmKey"><br>
                <?php if($confirmError != null) echo '<div class="errorLog">'.$confirmError.'<br></div>';?>
            </div>
            <div class="errorLog">
                <?php if($createError != null) echo '<div class="errorLog">'.$createError.'<br></div>';?>
            </div>
            <div class="btn-login">
                <button type="submit" name="btn-login">Create</button>
            </div>
        </form>
    </section>
</div>
</body>
</html>