<?php

class Wiki
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllWikis()
    {
        $this->db->query('SELECT Wikis.*, Users.username, Users.profile_picture, Categories.category_name, GROUP_CONCAT(Tags.tag_name) AS tag_names
            FROM Wikis
            JOIN Users ON Wikis.author_id = Users.user_id
            JOIN Categories ON Wikis.category_id = Categories.category_id
            LEFT JOIN WikiTags ON Wikis.wiki_id = WikiTags.wiki_id
            LEFT JOIN Tags ON WikiTags.tag_id = Tags.tag_id
            WHERE Wikis.archived = 0
            GROUP BY Wikis.wiki_id
            ORDER BY Wikis.updated_at DESC;');

        return $this->db->resultSet();
    }

    public function getMyWikis()
    {
        $this->db->query('SELECT Wikis.*, Users.username, Users.profile_picture, Categories.category_name, GROUP_CONCAT(Tags.tag_name) AS tag_names
            FROM Wikis
            JOIN Users ON Wikis.author_id = Users.user_id
            JOIN Categories ON Wikis.category_id = Categories.category_id
            LEFT JOIN WikiTags ON Wikis.wiki_id = WikiTags.wiki_id
            LEFT JOIN Tags ON WikiTags.tag_id = Tags.tag_id
            WHERE Wikis.archived = 0 and author_id= :user_id
            GROUP BY Wikis.wiki_id
            ORDER BY Wikis.updated_at DESC;');

        $this->db->bind(':user_id', $_SESSION['user_id']);

        return $this->db->resultSet();
    }

    public function getWikiById($wikiId)
    {
        $this->db->query('SELECT Wikis.*, Users.username, Users.profile_picture, Categories.category_name, GROUP_CONCAT(Tags.tag_name) AS tag_names
        FROM Wikis
        JOIN Users ON Wikis.author_id = Users.user_id
        JOIN Categories ON Wikis.category_id = Categories.category_id
        LEFT JOIN WikiTags ON Wikis.wiki_id = WikiTags.wiki_id
        LEFT JOIN Tags ON WikiTags.tag_id = Tags.tag_id
        WHERE Wikis.wiki_id = :wiki_id
        GROUP BY Wikis.wiki_id
        ORDER BY Wikis.updated_at DESC;');


        $this->db->bind(':wiki_id', $wikiId);

        return $this->db->single();
    }
    public function addWiki($imageWiki, $title, $content, $categoryId)
    {
        $this->db->query('INSERT INTO Wikis (image_wiki, title, content, category_id, author_id) VALUES (:image, :title, :content, :categoryId, :author_id)');
        $this->db->bind(':image', $imageWiki);
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        $this->db->bind(':categoryId', $categoryId);
        $this->db->bind(':author_id', $_SESSION['user_id']);
        $this->db->execute();

        return $this->db->lastInsertId();
    }

    public function addWikiTags($wikiId, $tagId)
    {
        try {
            $query = "INSERT INTO WikiTags (wiki_id, tag_id) VALUES (:wikiId, :tagId)";
            $this->db->query($query);
            $this->db->bind(':wikiId', $wikiId);
            $this->db->bind(':tagId', $tagId);

            $this->db->execute();
            return true;
        } catch (PDOException $e) {

            return false;
        }
    }
    public function deleteWikiTags($wikiId)
    {
        $query = "DELETE FROM wikitags WHERE wiki_id = :wiki_id";
        $this->db->query($query);
        $this->db->bind(':wiki_id', $wikiId, PDO::PARAM_INT);
        $this->db->execute();
    }

    public function deleteWiki($wikiId)
    {
        $this->db->query('DELETE FROM Wikis WHERE wiki_id = :wikiId');
        $this->db->bind(':wikiId', $wikiId);
        return $this->db->execute();
    }


    public function updateWiki($wikiId, $title, $content, $categoryId, $imageWiki)
    {
        $query = "UPDATE wikis SET title = :title, content = :content, category_id = :category_id WHERE wiki_id = :wiki_id";
        $this->db->query($query);
        $this->db->bind(':title', $title, PDO::PARAM_STR);
        $this->db->bind(':content', $content, PDO::PARAM_STR);
        $this->db->bind(':category_id', $categoryId, PDO::PARAM_INT);
        $this->db->bind(':wiki_id', $wikiId, PDO::PARAM_INT);
        $this->db->execute();

        if ($imageWiki != NULL) {
            $queryImage = "UPDATE wikis SET image_wiki = :image_wiki WHERE wiki_id = :wiki_id";
            $this->db->query($queryImage);
            $this->db->bind(':image_wiki', $imageWiki, PDO::PARAM_STR);
            $this->db->bind(':wiki_id', $wikiId, PDO::PARAM_INT);

            $this->db->execute();
        }

        return true;

    }

    public function archiveWikiById($wikiId)
    {
        $this->db->query('UPDATE wikis SET archived = 1 WHERE wiki_id = :wiki_id');
        $this->db->bind(':wiki_id', $wikiId);

        return $this->db->execute();
    }

    public function WikisByDate() {
        // Assuming you have a 'created_at' column in your 'Wikis' table
        $this->db->query('
            SELECT DATE(created_at) as date, COUNT(*) as count
            FROM Wikis
            GROUP BY DATE(created_at)
            ORDER BY DATE(created_at) DESC
        ');
    
        return $this->db->resultSet();
    }

    public function searchWiki($searchTerm) {
        $this->db->query('
            SELECT * FROM Wikis
            WHERE title LIKE :searchTerm
        ');
        $this->db->bind(':searchTerm', "%$searchTerm%");
        
        return $this->db->resultSet();
    }
    
    public function searchTag($searchTerm) {
        $this->db->query('
            SELECT * FROM Tags
            WHERE tag_name LIKE :searchTerm
        ');
        $this->db->bind(':searchTerm', "%$searchTerm%");
        
        return $this->db->resultSet();
    }
    
    public function searchCategory($searchTerm) {
        $this->db->query('
            SELECT * FROM Categories
            WHERE category_name LIKE :searchTerm
        ');
        $this->db->bind(':searchTerm', "%$searchTerm%");
        
        return $this->db->resultSet();
    }
    

}
