<?php

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addCategory($categoryName, $categoryPicture)
    {
        $this->db->query('INSERT INTO Categories (category_name, category_picture) VALUES (:categoryName, :categoryPicture)');
        $this->db->bind(':categoryName', $categoryName);
        $this->db->bind(':categoryPicture', $categoryPicture);

        return $this->db->execute();
    }

    public function getAllCategories() {
        $this->db->query('SELECT * FROM Categories');
        return $this->db->resultSet();
    }
}
?>