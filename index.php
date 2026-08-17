<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
include_once(__DIR__ . '/classes/Db.php');
include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Transaction.php');
include_once(__DIR__ . '/classes/Date.php');
$transactions = Transaction::getUserTransactions($_SESSION['id']);

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
    <div class="container-account">
        <div class="container">
            <div class="content">
                <h2>Welkom <?php echo htmlspecialchars($_SESSION['username']); ?><br>bij XD Currency!</h2>
                <h1>Jouw transacties</h1>
                <div class="transaction-list" id="transactionList">
                    <?php foreach ($transactions as $transaction):
                        $datum = Date::format($transaction['date_created']);?>
                          <?php if ($transaction['sender_id'] == $_SESSION['id']): ?>
                            <a href="transaction.php?id=<?php echo $transaction['id']; ?>" class="transaction link">
                                <p><?php echo htmlspecialchars($_SESSION['username']); ?> heeft <?php echo htmlspecialchars($transaction['amount']); ?> XD gestuurd naar <?php echo htmlspecialchars($transaction['receiver_username']); ?> </p>
                                <p class="transaction-datum"><?php echo $datum ?></p>
                            </a>
                        <?php else: ?>
                            <a href="transaction.php?id=<?php echo $transaction['id']; ?>" class="transaction link">
                                <p><?php echo htmlspecialchars($transaction['sender_username']); ?> heeft <?php echo htmlspecialchars($transaction['amount']); ?> XD gestuurd naar <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                                <p class="transaction-datum"><?php echo $datum ?></p>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        const transactionList = document.getElementById("transactionList");
        let lastTransactionCount = <?php echo count($transactions); ?>;

        function renderTransaction(t) {
            const wrapper = document.createElement("a");
            wrapper.href = "transaction.php?id=" + t.id;
            wrapper.className = "transaction link";
            const naam = t.isSender ? t.ownUsername : t.otherUsername;
            const andereNaam = t.isSender ? t.otherUsername : t.ownUsername;
            wrapper.innerHTML = `<p>${naam} heeft ${t.amount} XD gestuurd naar ${andereNaam}</p><p class="transaction-datum">${t.datum}</p>`;
            return wrapper;
        }

        function updateTransactions() {
            fetch("ajax/getTransactions.php")
                .then(response => response.json())
                .then(data => {
                    if (data.status === "succes") {
                        if (data.transactions.length !== lastTransactionCount) {
                            transactionList.innerHTML = "";
                            data.transactions.forEach(t => {
                                transactionList.appendChild(renderTransaction(t));
                            });
                            lastTransactionCount = data.transactions.length;
                        }
                    }
                })
                .catch(error => console.error("Error:", error));
        }
        setInterval(updateTransactions, 10000);
    </script>
</body>


</html>