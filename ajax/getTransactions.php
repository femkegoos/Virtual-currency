<?php
session_start();
include_once(__DIR__ . '/../classes/Db.php');
include_once(__DIR__ . '/../classes/User.php');
include_once(__DIR__ . '/../classes/Transaction.php');


if (!isset($_SESSION['id'])) {
    header("Content-Type: application/json");
    echo json_encode(['status' => 'error', 'message' => 'Niet ingelogd']);
    exit;
}

$transactions = Transaction::getUserTransactions($_SESSION['id']);

$dagen = [
    'Monday' => 'maandag',
    'Tuesday' => 'dinsdag',
    'Wednesday' => 'woensdag',
    'Thursday' => 'donderdag',
    'Friday' => 'vrijdag',
    'Saturday' => 'zaterdag',
    'Sunday' => 'zondag'
];

$maanden = [
    'January' => 'januari',
    'February' => 'februari',
    'March' => 'maart',
    'April' => 'april',
    'May' => 'mei',
    'June' => 'juni',
    'July' => 'juli',
    'August' => 'augustus',
    'September' => 'september',
    'October' => 'oktober',
    'November' => 'november',
    'December' => 'december'
];

$response = [];

foreach ($transactions as $transaction) {
    $datum = date('l d F Y', strtotime($transaction['date_created']));
    $datum = str_replace(array_keys($dagen), array_values($dagen), $datum);
    $datum = str_replace(array_keys($maanden), array_values($maanden), $datum);

    $isSender = ($transaction['sender_id'] == $_SESSION['id']);

    $response[] = [
        'id' => $transaction['id'],
        'amount' => htmlspecialchars($transaction['amount']),
        'datum' => $datum,
        'isSender' => $isSender,
        'otherUsername' => htmlspecialchars($isSender ? $transaction['receiver_username'] : $transaction['sender_username']),
        'ownerUsername' => htmlspecialchars($_SESSION['username'])
    ];
}
header("Content-Type: application/json");
echo json_encode($response);
?>
