<?php
session_start();
var_dump($_SESSION['id']);
include_once(__DIR__ . '/../classes/Db.php');
include_once(__DIR__ . '/../classes/User.php');


    if (!isset($_SESSION['id'])){
        header("Content-Type: application/json");
        echo json_encode(['status' => 'error', 'message' =>'Niet ingelogd']);
        exit;
    }
    $balance = User::getBalanceByUserId($_SESSION['id']);
    $_SESSION['balance'] = $balance;

    $response = ['status' => 'succes', 'balance' => $balance];
    header("Content-Type: application/json");
    echo json_encode($response);
?>