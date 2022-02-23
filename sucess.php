<?php
session_start();

if (isset($_POST['btn-redirect'])){

  header('location: index.php');
  session_unset();
  session_destroy();  
}

?>

<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="CSS/style.css">

</head>
<body>

<div name="createSucess" class="successField">
    <section id="animar" class="successBlock">

        <!-- Conta criada com sucesso -->   
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