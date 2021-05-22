<?php

class Post{
    //add database
    private $conn;
    private $table = 'posts';

    //add post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $create_date;

    //constructor with db connection
    public function __construct($db){
        $this->conn = $db;
    }

    //getting the posts from the database
    public function read(){
        //create query
        $query = 'SELECT
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.create_date
            FROM 
            ' .$this->table . ' p 
            LEFT JOIN
                categories c ON p.category_id = c.id
                ORDER BY p.create_date DESC';
        
        //prepare the statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

}

?>