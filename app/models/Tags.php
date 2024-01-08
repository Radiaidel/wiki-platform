<?php

class Tags
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTagsByCategory($categoryId)
    {
        $this->db->query("SELECT * FROM Tags WHERE category_id = :category_id");
        $this->db->bind(':category_id', $categoryId);
        return $this->db->resultSet();
    }
    public function addNewTag($categoryId, $tagName)
    {
        $this->db->query('INSERT INTO Tags (tag_name, category_id) VALUES (:tagName, :categoryId)');
        $this->db->bind(':tagName', $tagName);
        $this->db->bind(':categoryId', $categoryId);

        return $this->db->execute();
    }
}
?>