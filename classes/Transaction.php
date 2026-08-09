<?php
include_once(__DIR__ . "/Db.php");

class Transaction
{
    private $sender_id;
    private $receiver_id;
    private $amount;
    private $reason;
    private $date_created;

}