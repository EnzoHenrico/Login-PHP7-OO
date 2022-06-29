<?php
session_start();

if (isset($_POST['btn-redirect'])){

  header('location: login.php');
  session_unset();
  session_destroy();  
}

?>

<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style/stylesheet.css">
</head>
<body>
    <div name="createSucess" class="successField">
        <section id="animar" class="successBlock">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">       
                <h1 class="success">Account Created Successfully!</h1>    
                <div class="btn-redirect">
                    <button type="submit" name="btn-redirect">Go to login!</button>
                </div>
            </form>
        </section>
    </div>
</body> 
</html>