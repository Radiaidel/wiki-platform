<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function registerUser($name, $email, $password, $profilePicture)
    {
        $this->db->query('INSERT INTO Users (username, email, password, role, profile_picture) VALUES (:name, :email, :password, :role, :profilePicture)');
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        $this->db->bind(':role', 'auteur');
        $this->db->bind(':profilePicture', $profilePicture);

        return $this->db->execute();
    }


    public function findByEmail($email)
    {
        $this->db->query('SELECT * FROM Users WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->single();

        return $this->db->rowCount() > 0;
    }
    public function getUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        return $row;
    }
    public function getUserCount() {
        $this->db->query('SELECT COUNT(*) as count FROM users');
        return $this->db->single()->count;
    }}
