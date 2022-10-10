<?php
class Category{
    private $conn;
    private $table= 'categories';

    public $id;
    public $name;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // view all categories
    public function read_category()
    {
        // Create query
        $query = 'SELECT
        id,
        name,
        created_at

        FROM
        ' . $this->table . '
        ORDER BY
        created_at DESC';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    // view a category
    public function read_single_category(){
        $query = 'SELECT 
            id,
            name
            FROM
            ' .$this->table. '
            WHERE
            id = ?
            LIMIT 0,1
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];

    }
}