<?php

    if (isset($_POST['operation']) && $_POST['operation'] > 0) {

        require_once '../classes/Operation.php'; 
        $operation = new Operation;

        $res = $operation->delivery($_POST['operation']);
        if ($res) echo(json_encode("ok"));

        die();

    }

?>