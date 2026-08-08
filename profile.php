<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://use.typekit.net/tkk7yuy.css">

    <title>Profiel</title>
</head>
<body>
      <nav class="bottom-nav">
    <div class="nav-container">
    <a href="index.php"><img class="logo" alt="this is the logo of the XD Currency app" src="img/XD_currency_logo.png"></a>
    <a href="register.php"><img class="profile" alt="this the icon of the profile page" src="img/XD_currency_icons_profile.png"></a>
    <a href="transfer.php"><img class="transfer" alt="this the icon of the transfer page" src="img/XD_currency_icons_transfer.png"></a>
    <a href="list.php"><img class="list" alt="this the icon of the list page" src="img/XD_currency_icons_list.png"></a>
</nav>

<div class="container-account">
<div class="container">
   
    <h1>Mijn profiel</h1>
    <p>Gebruikersnaam: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <p>saldo: <?php echo htmlspecialchars($_SESSION['balance']); ?> XD</p>
   <a class="link" href="logout.php">Uitloggen</a>
</div>
</div>
    
</body>
</html>