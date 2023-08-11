<?php
// Ceci représente mon modèle qui est le mappage de ma base de données
class Article
{
   
    private $conn;
    private $table = 'articles';

    //Article properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $url_image;
    public $content;
  

    //constructeur avec connexion db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //obtenir des articles a partir de db
    public function read()
    {
        // créer une requête
        $query = 'SELECT
            c.name as category_name,
            a.id,
            a.category_id,
            a.title,
            a.url_image,
            a.content
            FROM
            ' . $this->table . ' a
            LEFT JOIN
            categories c ON a.category_id = c.id ';

            //préparer la déclaration
            $stmt = $this->conn->prepare($query);
            
            //exécuter la requête 
            $stmt->execute();
            
            return $stmt;
    }
            
    public function retrieveArticle($id)
    {
        // créer une requête
        $query = 'SELECT
            c.name as category_name,
            a.id,
            a.category_id,
            a.title,
            a.url_image,
            a.content
            FROM
            ' . $this->table . ' a
            LEFT JOIN
            categories c ON a.category_id = c.id 
            WHERE a.id = :id';
                    
            //préparer la déclaration
            $stmt = $this->conn->prepare($query);

            // Paramètre de liaison
            $stmt->bindParam(':id', $id);

            //exécuter la requête 
            $stmt->execute();

            return $stmt;
    }    


    public function delete($id)
    {
        // créer une requête
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    
        // préparer la déclaration
        $stmt = $this->conn->prepare($query);
    
        // Paramètre de liaison
        $stmt->bindParam(':id', $id);
    
        // exécuter la requête 
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

        
    public function update($id, $title, $content,$url_image)
    {
        // créer une requête
        $query = 'UPDATE ' . $this->table . ' SET title = :title, url_image = :url_image , content = :content WHERE id = :id';

        // préparer la déclaration
        $stmt = $this->conn->prepare($query);

        // Paramètre de liaison
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':url_image', $url_image);
        // exécuter la requête 
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_title($id, $title)
    {
        // créer une requête
        $query = 'UPDATE ' . $this->table . ' SET title = :title WHERE id = :id';

        // préparer la déclaration
        $stmt = $this->conn->prepare($query);

        // Paramètre de liaison
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);

        // exécuter la requête
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function create($title, $content,$url_image,$category_id)
    {
        // créer une requête
        $query = 'INSERT INTO ' . $this->table . ' (title, url_image, content, category_id) VALUES (:title, :url_image, :content, :category_id)';

        // préparer la déclaration
        $stmt = $this->conn->prepare($query);

        // Paramètre de liaison
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':url_image', $url_image);
        // exécuter la requête 
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }










}   