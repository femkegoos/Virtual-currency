<?php
include_once(__DIR__ . "/Db.php");

class Transaction
{
    private $sender_id;
    private $receiver_id;
    private $amount;
    private $reason;
    private $date_created;



    /**
     * Get the value of sender_id
     */
    public function getSender_id()
    {
        return $this->sender_id;
    }

    /**
     * Set the value of sender_id
     *
     * @return  self
     */
    public function setSender_id($sender_id)
    {
        if (empty($sender_id)) {
            throw new Exception("Verzender mag niet leeg zijn!");
        }
        $this->sender_id = $sender_id;
        return $this;
    }

    /**
     * Get the value of receiver_id
     */
    public function getReceiver_id()
    {
        return $this->receiver_id;
    }

    /**
     * Set the value of receiver_id
     *
     * @return  self
     */
    public function setReceiver_id($receiver_id)
    {
        if (empty($receiver_id)) {
            throw new Exception("Ontvanger mag niet leeg zijn!");
        }
        $this->receiver_id = $receiver_id;
        return $this;
    }

    /**
     * Get the value of amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */
    public function setAmount($amount)
    {
        if (empty($amount)) {
            throw new Exception("Bedrag mag niet leeg zijn!");
        }
        if ($amount < 1) {
            throw new Exception("Bedrag moet groter zijn dan 1!");
        }
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of reason
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set the value of reason
     *
     * @return  self
     */
    public function setReason($reason)
    {
        if (empty($reason)) {
            throw new Exception("Reden mag niet leeg zijn!");
        }
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get the value of date_created
     */
    public function getDate_created()
    {
        return $this->date_created;
    }

    /**
     * Set the value of date_created
     *
     * @return  self
     */
    public function setDate_created($date_created)
    {
        $this->date_created = $date_created;

        return $this;
    }

    /**
     * Wat gebeurd er na het drukken op de verzend knop
     */
    public function save()
    {
        $conn = Db::getConnection();
        /**
         * Transactie opslaan in de database van transactions
         */
        $statement = $conn->prepare("INSERT INTO transactions (sender_id, receiver_id, amount, reason, date_created) VALUES (:sender_id, :receiver_id, :amount, :reason, NOW())");
        $statement->bindValue(':sender_id', $this->sender_id);
        $statement->bindValue(':receiver_id', $this->receiver_id);
        $statement->bindValue(':amount', $this->amount);
        $statement->bindValue(':reason', $this->reason);
        $statement->execute();

        /**
         * Saldo in database van de verzender verminderen
         */
        $statement2 = $conn->prepare("UPDATE balances SET amount = amount - :amount, date_updated = NOW() WHERE user_id = :user_id");
        $statement2->bindValue(':amount', $this->amount);
        $statement2->bindValue(':user_id', $this->sender_id);
        $statement2->execute();

             /**
         * Saldo in database van de ontvanger verhogen
         */
        $statement3 = $conn->prepare("UPDATE balances SET amount = amount + :amount, date_updated = NOW() WHERE user_id = :user_id");
        $statement3->bindValue(':amount', $this->amount);
        $statement3->bindValue(':user_id', $this->receiver_id);
        $statement3->execute();

        return true;
    }

    public static function getById($id, $userId){
         $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT transactions.*, 
        sender.username as sender_username,
        receiver.username as receiver_username
        FROM transactions
        JOIN users as sender ON transactions.sender_id = sender.id
        JOIN users as receiver ON transactions.receiver_id = receiver.id
        WHERE transactions.id = :id 
        AND (transactions.sender_id = :userId OR transactions.receiver_id = :userId)");
         $statement->bindValue(':id', $id);
         $statement->bindValue(':userId', $userId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
}
