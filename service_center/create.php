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
        <link rel="stylesheet" href="src/css/create.css">

		<title>Create Operation</title>
    </head>
    <body>

        <div class="container">
            <h1 class="title">Add a New Operation</h1>

            <form method="post" action="src/php/api/addOperation.php">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="fcode">Fiscal Code</label>
                        <input type="text" class="form-control" id="fcode" name="fcode" minlength="16" maxlength="16" required autofocus>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" minlength="2" maxlength="32" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" minlength="2" maxlength="32" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="datebirth">Date of Birth</label>
                        <input type="date" class="form-control" name="dbirth" id="datebirth" min="1930-01-01" max="2005-01-01" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                </div>

                <div class="form-row" id="contactDiv">
                    <div class="form-group col-md-3">
                        <label for="type">Contact: Type</label>
                        <select id="type" name="type[]" class="form-control" required>
                            <option value="" disabled selected>Choose ...</option>
                            <option value="email">Email</option>
                            <option value="phone">Phone Number</option>
                        </select>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="value">Contact: Value</label>
                        <input type="text" class="form-control" id="value" name="value[]" minlength="8" maxlength="320" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="button" class="btn btn-info" onclick="addContact()"> <i class="fa-solid fa-plus"></i> </button>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="sn">Serial Number</label>
                        <input type="text" class="form-control" id="sn" name="sn" minlength="4" maxlength="50" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="brand">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" minlength="2" maxlength="32" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" id="model" name="model" minlength="2" maxlength="32" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="kind">Kind</label>
                        <select id="kind" name="kind" class="form-control" required>
                            <option value="" disabled selected>Choose ...</option>
                            <option value="desktop">Desktop PC</option>
                            <option value="notebook">Notebook</option>
                            <option value="smartphone">Smartphone</option>
                            <option value="printer">Printer</option>
                        </select>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                </div>

                <div class="form-row" id="accessoryDiv">
                    <div class="form-group col-md-4">
                        <label for="accessname">Accessory Name</label>
                        <input type="text" class="form-control" id="accessname" name="accessname[]" placeholder="...">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="accessdescr">Accessory Description</label>
                        <input type="text" class="form-control" id="accessdescr" name="accessdescr[]" placeholder="...">
                    </div>
                    <div class="form-group col-md-3">
                        <button type="button" class="btn btn-info" onclick="addAccessory()"> <i class="fa-solid fa-plus"></i> </button>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="wall">Wall</label>
                        <input type="number" class="form-control" id="wall" name="wall" min="1" max="2" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="col">Column</label>
                        <input type="number" class="form-control" id="col" name="col" min="1" max="7" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="row">Row</label>
                        <input type="number" class="form-control" id="row" name="row" min="1" max="5" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                </div>

                <div class="form-row" id="troubleDiv">
                    <div class="form-group col-md-5">
                        <label for="trouble">Trouble</label>
                        <input type="text" class="form-control" id="trouble" name="trouble[]" minlength="5" maxlength="255" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="note">Note</label>
                        <input type="text" class="form-control" id="note" name="note[]" placeholder="...">
                    </div>
                    <div class="form-group col-md-1">
                        <button type="button" class="btn btn-info" onclick="addTrouble()"> <i class="fa-solid fa-plus"></i> </button>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="vat">V.A.T.</label>
                        <input type="number" class="form-control" id="vat" name="vat" min="1" max="50" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="labor">Labor</label>
                        <input type="number" class="form-control" id="labor" name="labor" min="0" max="100" required>
                        <div class="invalid-feedback"> Required field. </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Insert</button>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="src/js/create.js"></script>
    </body>
</html>