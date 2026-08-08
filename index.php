<?php
session_start();
include_once(__DIR__ . '/classes/Db.php');
include_once(__DIR__ . '/classes/User.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://use.typekit.net/tkk7yuy.css">
    <title>XD Currency</title>
</head> 


<body>
  <?php include_once(__DIR__ . '/nav.php'); ?>

</body>


</html>