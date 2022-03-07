<?php

    session_start();
    if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] == false) header("Location: login.php");

    require_once 'src/php/classes/Operation.php';
    $operation = new Operation;

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
        <link rel="stylesheet" href="src/css/stats.css">

		<title>Analytics</title>
    </head>
    <body>

        <div class="container">
            <h1 class="title">Analytics</h1>
            
            <div class="row">
                <div class="col">
                    <label class="header">Total Amount of the Current Month:</label>
                    <p><?php echo $operation->stats_monthly_amount(); ?> &#128;</p>
                </div>

                <div class="col">
                    <label class="header">Most Active Technician of the Current Month:</label>
                    <p><?php echo $operation->stats_active_technician(); ?></p>
                </div>

                <div class="col">
                    <label class="header">Most Expensive Operation of the Current Month:</label>
                    <p><b>ID:</b> <?php echo $operation->stats_monthly_mostexp(); ?></p>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>