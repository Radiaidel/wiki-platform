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


    public function updateTag($id_tag,$id_category,$name_tag) {
        $this->db->query('UPDATE Tags SET tag_name = :tagName ,  category_id = :categoryId where tag_id = :tagId');
        $this->db->bind(':categoryId', $id_category);
        $this->db->bind(':tagId',$id_tag);
        $this->db->bind(':tagName', $name_tag);

        return  $this->db->execute();

    }

    public function deleteTag($id_tag) {
        $this->db->query('DELETE FROM Tags WHERE tag_id = :tagId');
        $this->db->bind(':tagId', $id_tag);

        return  $this->db->execute();

    }
    public function getTagCount() {
        $this->db->query('SELECT COUNT(*) as count FROM tags');
        return $this->db->single()->count;
    }
    public function searchTags($searchTerm) {
        $this->db->query("SELECT * FROM Tags WHERE tag_name LIKE :searchTerm");
        $this->db->bind(':searchTerm', '%' . $searchTerm . '%');
        return $this->db->resultSet();
    }
}
?>