<?php
session_start();
include_once(__DIR__ . '/classes/Db.php');
include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Transaction.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (!empty($_POST)) {
    try {
        $transaction = new Transaction();
        $transaction->setSender_id($_SESSION['id']);
        $transaction->setReceiver_id($_POST['receiver']);
        $transaction->setAmount($_POST['amount']);
        $transaction->setReason($_POST['reason']);

        $balance = User::getBalanceByUserId($_SESSION['id']);
        if ($_POST['amount'] > $balance) {
            $error = "Je hebt niet genoeg saldo";
        } else {
            if ($transaction->save()) {
                $_SESSION['balance'] = User::getBalanceByUserId($_SESSION['id']);
                header("Location: index.php");
                exit;
            } else {
                $error = "Er is iets misgegaan! Probeer opnieuw.";
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
                    <input type="text" name="receiver" id="receiver" required>
                    <input class="search" type="hidden" name="receiver_id" id="receiver_id"><br><br>
                    <div id="results"></div>
                    <label for="amount">Bedrag:</label><br>
                    <input type="number" name="amount" id="amount" step="0.01" min="1" required><br>
                    <label for="reason">Reden:</label><br>
                    <textarea name="reason" id="reason" required></textarea><br>

                    <input class="btn" type="submit" value="Verzenden">
                    <?php if (isset($error)) {
                        echo "<p class='error'>" . htmlspecialchars($error) . "</p>";
                    } ?>

                </form>
            </div>
        </div>
    </div>
    <script>
        const receiver = document.getElementById("receiver");
        const results = document.getElementById("results");
        receiver.addEventListener("input", function() {
            if (receiver.value.length >= 2) {
                const formData = new FormData();
                formData.append("username", receiver.value);
                fetch("ajax/searchUsers.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        results.innerHTML = "";
                        data.items.forEach(user => {
                            const result = document.createElement("div");
                            result.innerHTML = user.username;
                            result.addEventListener("click", function(){
                                receiver.value = user.username;
                                document.getElementById("receiver_id").value = user.id;
                                results.innerHTML = "";
                            });
                            results.appendChild(result);
                        });
                    });
            } else {
                results.innerHTML = "";
            }

        });
    </script>
</body>

</html>