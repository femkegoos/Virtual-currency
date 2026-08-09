<!--alleen wanneer het ingelogd is, wordt de nav getoond -->
<?php if (isset($_SESSION['id'])): ?>

<header class="top-nav">
    <div class="top-nav-container">
   <p class="saldo"><?php echo htmlspecialchars($_SESSION['balance']); ?> XD</p>
   <div class="user-info">
    <p class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
   <a href="logout.php"><img class="logout" alt="this the icon of the logout page" src="img/XD_currency_icons_logout.png"></a>
    </div>
    </div>
</header>
  <?php endif; ?>
  
  <nav class="bottom-nav">
    <div class="nav-container">
    <a href="index.php"><img class="logo" alt="this is the logo of the XD Currency app" src="img/XD_currency_logo.png"></a>
    <a href="transfer.php"><img class="transfer" alt="this the icon of the transfer page" src="img/XD_currency_icons_transfer.png"></a>
</nav>