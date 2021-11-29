<?php namespace App\Models;

use App\Core\Database;

class LoginModel{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    
    public function login($email , $password)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email ");

        // Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        $user = $this->db->single();


        $hashedPassword = $user->password;

        if(password_verify($password , $hashedPassword)){
            header('location:/');
        }else return false;
    }

    public function findUserByEmail($email)
    {
        // prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email ');

        // Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        // check if email is already registered
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }
}