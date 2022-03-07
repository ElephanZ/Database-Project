<?php

    if (isset($_POST['operation']) && $_POST['operation'] > 0 && $_POST['operation'] < 4) {

        require_once '../classes/Operation.php'; 
        $operation = new Operation;

        if ($_POST['operation'] == 1) $what = 'all';
        else if ($_POST['operation'] == 2) $what = 'finished'; 
        else if ($_POST['operation'] == 3) $what = 'active'; 

        echo json_encode($operation->get($what));

        die();

    }

?>