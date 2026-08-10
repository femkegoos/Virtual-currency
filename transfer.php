<?php
session_start();
include_once(__DIR__ . '/classes/Db.php');
include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Transaction.php');

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
    <title>Geld overschrijven</title>
</head>

<body>
    <?php include_once(__DIR__ . '/nav.php'); ?>

     <div class="container-account">
  <div class="container">
    <div class="content">
     <h2>Stuur XD currency</h2>
    <form action="" method="post">
       
        <label for="receiver">Ontvanger:</label><br>
        <select name="receiver" id="receiver" required>
            <option value="">Selecteer een ontvanger</option>
            <?php foreach (User::getAll() as $u):?>
                <option value="<?php echo $u['id']; ?>"><?php echo htmlspecialchars($u['username']);?></option>
                <?php endforeach; ?>
        </select><br>

        <label for="amount">Bedrag:</label><br>
        <input type="number" name="amount" id="amount" step="0.01" min="1" required><br>
        <label for="reason">Reden:</label><br>
        <textarea name="reason" id="reason" required></textarea><br>

        <input class="btn" type="submit" value="Verzenden">
        <?php if (isset($error)) {
            echo "<p class='error'>" . htmlspecialchars($error) . "</p>";
        }?>

    </form>
    </div>
  </div>
  </div>
    
</body>
</html>