<?php

    session_start();
    if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] == false) header("Location: login.php");    
    
    
    if (!isset($_POST['fcode']) || !isset($_POST['name']) || !isset($_POST['surname']) || !isset($_POST['dbirth'])) die('Missing Parameters 1');
    if (!isset($_POST['sn']) || !isset($_POST['brand']) || !isset($_POST['model']) || !isset($_POST['kind'])) die('Missing Parameters 2');
    if (!isset($_POST['wall']) || !isset($_POST['col']) || !isset($_POST['row'])) die('Missing Parameters 3');
    if (!isset($_POST['type']) || !isset($_POST['value'])) die('Missing Parameters 4');
    if (!isset($_POST['vat']) || !isset($_POST['labor'])) die('Missing Parameters 5');
    if (!isset($_POST['trouble'])) die('Missing Parameters 6');
               
    require_once '../classes/Client.php';
    $client = new Client;

    require_once '../classes/Device.php';
    $device = new Device;

    require_once '../classes/Contact.php';
    $contact = new Contact;

    require_once '../classes/Slot.php';
    $slot = new Slot;

    require_once '../classes/Operation.php';
    $operation = new Operation;

    require_once '../classes/Reparation.php';
    $reparation = new Reparation;

    require_once '../classes/Accessory.php';
    $accessory = new Accessory;


    function getIfSet($data) {
        return isset($data) ? $data : ' ';
    }


    $client->insertIfNotExists($_POST['fcode'], $_POST['name'], $_POST['surname'], $_POST['dbirth']);

    $device->insertIfNotExists($_POST['sn'], $_POST['brand'], $_POST['model'], $_POST['kind'], $_POST['fcode']);

    $slot_id = $slot->getId($_POST['wall'], $_POST['row'], $_POST['col']);
    if ($slot_id == null) die('Slot Error');

    $operation_id = $operation->insert($_POST['vat'], $_POST['labor'], $slot_id, $_POST['sn'], $_SESSION['fc']);
    if ($operation_id == null) die('Error in insert');

    for ($i = 0; $i < count($_POST['trouble']); $i++)
        $reparation->insert($_POST['trouble'][$i], getIfSet($_POST['note'][$i]), $operation_id);

    if (isset($_POST['accessname']))
        for ($i = 0; $i < count($_POST['accessname']); $i++)
            if (!empty($_POST['accessname'][$i]))
                $accessory->insert($_POST['accessname'][$i], $operation_id, $_POST['sn'], getIfSet($_POST['accessdescr'][$i]));

    for ($i = 0; $i < count($_POST['type']); $i++) {
        $contact->insertIfNotExists($_POST['type'][$i], $_POST['value'][$i]);
        $client->checkAndOwn($_POST['fcode'], $_POST['value'][$i]);
    }


    $_POST = array();
    header('Location: ../../../index.php');

?>