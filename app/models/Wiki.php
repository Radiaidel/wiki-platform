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
        $this->db->query(' SELECT Wikis.*, Users.username ,Users.profile_picture , Categories.category_name, Tags.tag_name
        FROM Wikis
        JOIN Users ON Wikis.author_id = Users.user_id
        JOIN Categories ON Wikis.category_id = Categories.category_id
        LEFT JOIN WikiTags ON Wikis.wiki_id = WikiTags.wiki_id
        LEFT JOIN Tags ON WikiTags.tag_id = Tags.tag_id where Wikis.archived =0 ORDER BY updated_at DESC;');
        return $this->db->resultSet();
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
    
       return  $this->db->lastInsertId();
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
}
