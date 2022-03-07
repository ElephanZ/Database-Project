<?php

    session_start();
    if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] == false) header("Location: login.php");

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
        <link rel="stylesheet" href="src/css/font-awesome/all.css">
        <link rel="stylesheet" href="src/css/main.css">
        <link rel="stylesheet" href="src/css/home.css">

	<title>Home</title>
    </head>
    <body>

        <div class="container">
            <div class="intro">
                <h1 class="title">Welcome <?php echo $_SESSION['fc']; ?></h2>
                <h5 class="subtitle">Choose what to do among these possible operations:</h4>
            </div>

            <div class="buttons">
                <a href="create.php" class="btn btn-primary"><i class="fa-solid fa-square-plus"></i> Create a New Operation</a> <br/>
                <a href="show.php" class="btn btn-primary"><i class="fa-solid fa-eye"></i> Show Operations</a> <br/>
                <a href="stats.php" class="btn btn-primary"><i class="fa-solid fa-chart-line"></i> Analytics</a> <br/>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
