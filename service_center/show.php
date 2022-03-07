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
        <link rel="stylesheet" href="src/css/show.css">

		<title>Show Operations</title>
    </head>
    <body>

        <div class="container">
            <h1 class="title">List of Operations</h1>
            
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="finished_cb" value="finished" onchange="getData(checkWhichChecked())">
                <label class="form-check-label" for="finished_cb">Finished Operations</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="active_cb" value="active" onchange="getData(checkWhichChecked())">
                <label class="form-check-label" for="active_cb">Active Operations</label>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Device</th>
                    <th scope="col">Client</th>
                    <th scope="col">Slot</th>
                    <th scope="col">Date Pickup</th>
                    <th scope="col">Date Delivery</th>
                    <th scope="col">Technician</th>
                    <th scope="col">Total Cost</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody> </tbody>
            </table>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="src/js/show.js"></script>
    </body>
</html>