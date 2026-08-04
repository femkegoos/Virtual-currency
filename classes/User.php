<?php
include_once(__DIR__ . "/Db.php");

class User
{
    private $username;
    private $email;
    private $password;
    private $date_created;



    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        if (empty($username)) {
            throw new Exception("Username mag niet leeg zijn!");
        } 
    $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        if (empty($email)) {
            throw new Exception("Email mag niet leeg zijn!");
        }
        if (!str_ends_with($email, "@student.thomasmore.be")) {
            throw new Exception("Email moet eindigen met @student.thomasmore.be");
        }
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        if (empty($password)) {
            throw new Exception("Wachtwoord mag niet leeg zijn!");
        }
        if (strlen($password) < 5) {
            throw new Exception("Wachtwoord moet minstens 5 karakters bevatten!");
        }
        $options = ['cost' => 14];
        $this->password = password_hash($password, PASSWORD_DEFAULT, $options);

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

}

