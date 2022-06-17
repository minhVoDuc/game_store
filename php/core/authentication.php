<?php

class Authentication{
    //db stuff
    private $conn;
    private $table = 'user';

    //properties for authentication
    public $User_id;
    public $User_name;
    public $User_password;
    public $is_Admin;

    //constructor with db connection
    public function __construct($db){
        $this->conn = $db;
    }

    //read record - getting all from db
    public function read_all(){
        //create query
        $query = 'SELECT * 
            FROM '.$this->table;
        
        //prepare statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

    //read single record
    public function getByUser_name($User_name){
        //create query
        $query = 'SELECT * FROM '.$this->table.'
                    WHERE User_name = ?';

        //prepare statement
        $stmt = $this->conn->prepare($query);
        //binding param
        $stmt->bindParam(1, $User_name);
        //execute the query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) return false;

        $this->User_id = $row['User_id'];
        $this->User_name =  $row['User_name'];
        $this->User_password = $row['User_password'];
        $this->is_Admin = $row['is_Admin'];
        return true;
    }

    //read single record
    public function getByUser_id($User_id){
        //create query
        $query = 'SELECT * FROM '.$this->table.'
                    WHERE User_id = ?';

        //prepare statement
        $stmt = $this->conn->prepare($query);
        //binding param
        $stmt->bindParam(1, $User_id);
        //execute the query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) return false;

        $this->User_id = $row['User_id'];
        $this->User_name =  $row['User_name'];
        $this->User_password = $row['User_password'];
        $this->is_Admin = $row['is_Admin'];
        return true;
    }

    //create a new record
    public function createUser(){
        //create query
        $query = 'INSERT INTO ' . $this->table . 
                    ' SET User_id = :id, User_name = :name, User_password = :pass, is_Admin = :is_Admin';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->is_Admin  = 0;

        //binding of param
        $stmt->bindParam(':id', $this->User_id);
        $stmt->bindParam(':name', $this->User_name);
        $stmt->bindParam(':pass', $this->User_password);
        $stmt->bindParam(':is_Admin', $this->is_Admin);
        
        //execute the query
        if ($stmt->execute()) return true;

        //print error if sth goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    public function createAdmin(){
        //create query
        $query = 'INSERT INTO ' . $this->table . 
                    ' SET User_id = :id, User_name = :name, User_password = :pass, is_Admin = :is_Admin';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->is_Admin  = 1;

        //binding of param
        $stmt->bindParam(':id', $this->User_id);
        $stmt->bindParam(':name', $this->User_name);
        $stmt->bindParam(':pass', $this->User_password);
        $stmt->bindParam(':is_Admin', $this->is_Admin);
        
        //execute the query
        if ($stmt->execute()) return true;

        //print error if sth goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    //update password
    public function updatePass($newPassword){
        //create query
        $query = 'UPDATE ' . $this->table . 
                    '  SET User_password = :pass
                      WHERE User_name = :name';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->User_name = htmlspecialchars(strip_tags($this->User_name));
        $this->User_password = $newPassword;

        //binding of param
        $stmt->bindParam(':pass', $this->User_password);
        $stmt->bindParam(':name', $this->User_name);
        
        //execute the query
        if ($stmt->execute()) return true;

        //print error if sth goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    //update user by id
    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' SET User_name=:name, User_password=:pass
        WHERE User_id=:id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->User_id);
        $stmt->bindParam(':name', $this->User_name);
        $stmt->bindParam(':pass', $this->User_password);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    //delete user by name
    public function delete(){
        //create query
        $query = 'DELETE 
                      FROM ' . $this->table . 
                    ' WHERE User_id = :id';

        //prepare statement
        $stmt = $this->conn->prepare($query);
       
        //binding of param
        $stmt->bindParam(':id', $this->User_id);
        
        //execute the query
        return ($stmt->execute());
    }

    //delete user by id
    public function deleteUser($id){
        $query = 'DELETE FROM ' . $this->table . ' WHERE User_id=:id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return ($stmt->execute());
    }

    //get user name by id
    public function getName(){
        $query = 'SELECT 
            User_name 
            FROM
            ' . $this->table .
            ' WHERE User_id='
            . $this->User_id;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    //get all info by id
    public function getInfo(){
        $query = 'SELECT 
            User_name,
            User_password
            FROM
            ' . $this->table .
            ' WHERE User_id='
            . $this->User_id;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    //get all user id from db
    public function readAllUserID(){
        $query = 'SELECT
            User_id
            FROM
            ' . $this->table;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    //get all user name from db
    public function readAllUserName(){
        $query = 'SELECT
            User_name
            FROM
            ' . $this->table;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    //get all user info from db
    public function getUser(){
        $query = 'SELECT
            User_id,
            User_name,
            User_password
            FROM
            ' . $this->table .
            ' WHERE is_Admin=0';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    //get all user info from db
    public function getAdmin(){
        $query = 'SELECT
            User_id,
            User_name,
            User_password
            FROM
            ' . $this->table .
            ' WHERE is_Admin=1';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}

?>