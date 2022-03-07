<?php

    session_start();
    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) header("Location: index.php");

    if (isset($_POST['fc']) && isset($_POST['pwd'])) {

        require_once 'src/php/classes/Technician.php';
        $technician = new Technician;

        $res = $technician->check($_POST['fc'], md5($_POST['pwd']));
        if ($res) $technician->login();

        $_POST = array();
        
    }

?>
<!DOCTYPE html>
<html translate="no">
    <head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="author" content="Antonio Scardace">
        
        <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="src/css/main.css">
        <link rel="stylesheet" href="src/css/login.css">

		<title>Sign In</title>
    </head>
    <body>

        <div class="container">
            <h1 class="title">Sign in</h2>

            <form method="post" action="?">
                <div class="form-group">
                    <label for="fiscalcode">Fiscal Code</label>
                    <input type="text" class="form-control" id="fiscalcode" name="fc" placeholder="...">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="pwd" placeholder="...">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>