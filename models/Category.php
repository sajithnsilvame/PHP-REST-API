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

    // view all categories  ======>>> ======>>> 
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

    // view a category ======>>> ======>>>
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

    // create category ======>>> ======>>>
    public function create_category(){
        $query = 'INSERT INTO
        '.$this->table.'
        SET
          name = :name
        ';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam('name', $this->name);

        if($stmt->execute()){
            return true;
        }
    
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;

    }

    // update category
    public function update_category(){
        $query = 'UPDATE
            ' .$this->table. '
            SET
              name = :name
            WHERE
             id = :id  
        ';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam('name', $this->name);
        $stmt->bindParam('id', $this->id);

        if($stmt->execute()){
            return true;
        }

        // otherwise get error
        printf("Error: %s .\n", $stmt->error);
        return false;

    }

    // delete category
    public function delete_category(){
        $query = 'DELETE FROM 
            ' .$this->table. '

            WHERE
              id = :id
        ';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id
        $stmt->bindParam('id', $this->id);

        if($stmt->execute()){
            return true;
        }else{
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }
}



























