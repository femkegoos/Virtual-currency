<?php
session_start();
include_once(__DIR__ . '/../classes/Db.php');
include_once(__DIR__ . '/../classes/User.php');

if (!empty($_POST)){
    if (isset($_POST['username']) && !empty($_POST['username'])){
        $username = $_POST['username'];
        $user = new User();
        $items = $user->getByUsername($username);
        $response = ['status' => 'succes', 'items' => $items];
        header("Content-Type: application/json");
        echo json_encode($response);
    }
}
?>