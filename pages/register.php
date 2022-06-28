<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../style/stylesheet.css">
</head>
<body>
<?php
require_once '../app/src/ClassRegister.php';

$message = "";

if(isset($_POST['btn-login'])){

    $classRegister = new ClassRegister($_POST['createName'], $_POST['createLogin'], $_POST['createKey'], $_POST['confirmKey']);
    
    $classRegister->createUser();
    
    $message = $classRegister->getRegisterError();

}
?>
<div name="createAccount" class="createField">
    <section id="animar"class="createBLock">
        <!--login-->   
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h1 class="register">Create account</h1>    
            <div class="textField" name="user">  
                <!-- Input Username -->
                <label for="createLogin">Login Username:</label> 
                <input type="text" class="createLogin" name="createLogin"><br>
                <?php echo '<div class="errorLog">*'.$message.'<br></div>';?>
                <!-- Input Name -->
                <label for="createName">Your Name:</label> 
                <input type="text" class="createName" name="createName"><br>
                <?php echo '<div class="errorLog">*'.$message.'<br></div>';?>
                <!-- Input PasswordKey -->
                <label for="createKey">Password:</label> 
                <input type="password" class="createKey" name="createKey"><br>
                <?php echo '<div class="errorLog">*'.$message.'<br></div>';?>
                <!-- Input Confirm Key -->
                <label for="confirmKey">Confirm Password:</label> 
                <input type="password" class="confirmKey" name="confirmKey"><br>
                <?php echo '<div class="errorLog">*'.$message.'<br></div>';?>
            </div>
            <div class="errorLog">
                <?php echo '<div class="errorLog">*'.$message.'<br></div>';?>
            </div>
            <div class="btn-login">
                <button type="submit" name="btn-login">Create</button>
            </div>
        </form>
    </section>
</div>
</body>
</html>