<?php
session_start();
include_once(__DIR__ . '/classes/Db.php');
include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . 'nav.php');

if(!empty($_POST)) {
    try{
        $user = new User();
        $user->setUsername($_POST['username']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $existing = $user->checkEmailExists($_POST['email']);
        if($existing) {
           $error = "Deze email is al in gebruik!";
           } else {
            if($user-> register()){
                header("Location: login.php");
                exit;
            } else {
                $error = "Er is iets misgegaan bij het registreren! Probeer het opnieuw.";
            }
           }
} catch (Exception $e) {
    $error = $e->getMessage();
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://use.typekit.net/tkk7yuy.css">

    <title>registreren</title>
</head>

<body>
  
<div class="container-account">
<div class="container">
    <div class="form">
    <h1>Maak een account</h1>
    <form action="" method="post">
        <label for="username">Gebruikersnaam:</label><br>
        <input type="text" name="username" required><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" required><br>

        <label for="password">Wachtwoord:</label><br>
        <input type="password" name="password" required><br>

        <input class="btn" type="submit" value="Registreer">
        <?php if (isset($error)) {
            echo "<p class='error'>" . htmlspecialchars($error) . "</p>";
        }?>

    </form>
    <p>Heb je al een account? <a class="link" href="login.php">Log in</a></p>
    </div>
</div>
</div>
    
</body>

</html>