<?php
session_start();
include_once(__DIR__ . '/classes/Db.php');
include_once(__DIR__ . '/classes/User.php');

if (!empty($_POST)) {
    try {
        $user = new User();
        $user->setEmail($_POST['email']);
        $plainPassword = $_POST['password'];
        $result = $user->login($plainPassword);
        if($result) {
            $_SESSION['email'] = $result['email'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['id'] = $result['id'];
            exit;
        } else {
            $error = "Ongeldige inloggegevens! Je email of wachtwoord is incorrect.";
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

  
    <title>Inloggen</title>
</head>

<body>
     <?php include_once(__DIR__ . 'nav.php'); ?>
<div class="container-account">
<div class="container">
    <div class="form">
    <h1>Log in</h1>
    <form action="" method="post">
       
        <label for="email">Email:</label><br>
        <input type="email" name="email" required><br>

        <label for="password">Wachtwoord:</label><br>
        <input type="password" name="password" required><br>

        <input class="btn" type="submit" value="Inloggen">
        <?php if (isset($error)) {
            echo "<p class='error'>" . htmlspecialchars($error) . "</p>";
        }?>

    </form>
    <p>Heb je nog geen account? <a class="link" href="register.php">Registreer</a></p>
    </div>
</div>
</div>
    
</body>
</html>