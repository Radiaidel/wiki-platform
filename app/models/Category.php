<?php

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCategories() {
        $this->db->query('SELECT * FROM Categories');
        return $this->db->resultSet();
    }
    public function addCategory($categoryName, $categoryPicture)
    {
        $this->db->query('INSERT INTO Categories (category_name, category_picture) VALUES (:categoryName, :categoryPicture)');
        $this->db->bind(':categoryName', $categoryName);
        $this->db->bind(':categoryPicture', $categoryPicture);

        return $this->db->execute();
    }

    public function updateCategory($categoryId, $categoryName,$categoryPicture) {
        $this->db->query('UPDATE categories SET category_name = :categoryName , category_picture =:categoryPicture WHERE category_id = :categoryId');
        $this->db->bind(':categoryId', $categoryId);
        $this->db->bind(':categoryName', $categoryName);
        $this->db->bind(':categoryPicture', $categoryPicture);


        // Exécuter la requête
        return $this->db->execute();
    }
    public function deleteCategoryById($categoryId) {
        $this->db->query('DELETE FROM Categories WHERE category_id = :categoryId');
        $this->db->bind(':categoryId', $categoryId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false; 
        }
    }
    public function CategoriesByCountWiki() {
        $this->db->query('
            SELECT Categories.category_name, COUNT(Wikis.category_id) AS count
            FROM Categories
            LEFT JOIN Wikis ON Categories.category_id = Wikis.category_id
            GROUP BY Categories.category_name
        ');

        return $this->db->resultSet();
    }
}
?>