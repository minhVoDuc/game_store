<?php

class User{
    //db stuff
    private $conn;
    private $tableProd = 'product';
    private $tablePurchaseLog = 'log_purchase';
    private $tableCart = 'cart';
    private $tableUser = 'user'; 
    private $tableLibrary = 'user_library';

    //user properties
    public $User_id;
    public $cart;
    public $purchaseLog;
    public $gameLib;

    //constructor with db connection
    public function __construct($db){
        $this->conn = $db;
    }

    //change username by id
    public function changeName($newName){
        $query = 'UPDATE '.$this->tableUser.'   
                    SET User_name = :name
                    WHERE User_id = :id';
        //prepare statement
        $stmt = $this->conn->prepare($query);

        //binding of param
        $stmt->bindParam(':name', $newName);
        $stmt->bindParam(':id', $this->User_id);
        
        //execute the query
        if ($stmt->execute()) return true;

        //print error if sth goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    //change password by id
    public function changePass($newPass){
        $query = 'UPDATE '.$this->tableUser.'   
                    SET User_password = :pass
                    WHERE User_id = :id';
        //prepare statement
        $stmt = $this->conn->prepare($query);

        //binding of param
        $stmt->bindParam(':pass', $newPass);
        $stmt->bindParam(':id', $this->User_id);
        
        //execute the query
        if ($stmt->execute()) return true;

        //print error if sth goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    //get user's cart
    public function get_cart(){
        //create query
        $query = 'SELECT * 
            FROM '.$this->tableCart.'
            WHERE User_id = :user_id';
        
        //prepare statement
        $stmt = $this->conn->prepare($query);

        //binding param
        $stmt->bindParam(':user_id', $this->User_id);

        //execute query
        $stmt->execute();

        $this->cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //get user's purchase log
    public function get_purchaseLog(){
        //create query
        $query = 'SELECT * 
        FROM '.$this->tablePurchaseLog.'
        WHERE User_id = :user_id';
    
        //prepare statement
        $stmt = $this->conn->prepare($query);

        //binding param
        $stmt->bindParam(':user_id', $this->User_id);

        //execute query
        $stmt->execute();

        $this->purchaseLog = $stmt->fetchAll(PDO::FETCH_ASSOC);  
        
        //execute the query
        if ($stmt->execute()) return true;

        //print error if sth goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    //get user's cart
    public function get_gameLib(){
        //create query
        $query = 'SELECT * 
            FROM '.$this->tableLibrary.'
            WHERE User_id = :user_id';
        
        //prepare statement
        $stmt = $this->conn->prepare($query);

        //binding param
        $stmt->bindParam(':user_id', $this->User_id);

        //execute query
        $stmt->execute();

        $this->gameLib = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //execute the query
        if ($stmt->execute()) return true;

        //print error if sth goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    //add an product to cart
    public function addToCart($Product_Id){
        //create query
        $query = 'INSERT INTO ' . $this->tableCart . 
                    ' SET User_id = :user_id, Product_id = :prod_id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //binding of param
        $stmt->bindParam(':user_id', $this->User_id);
        $stmt->bindParam(':prod_id', $Product_id);
        
        //execute the query
        if ($stmt->execute()) return true;

        //print error if sth goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    //save log when purchasing event happend
    public function savePurchaseLog(){
        foreach($this->cart as $item){
            //create query
            $query = 'INSERT INTO ' . $this->tableLibrary . 
            ' SET User_id = :user_id, Product_id = :prod_id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //binding of param
            $stmt->bindParam(':user_id', $this->User_id);
            $stmt->bindParam(':prod_id', $item['Product_id']);

            $stmt->execute();
            $this->remove_cartItem($item['Product_id']);
        }

        $currDate = date("Y-m-d H:i:s");
        $query = 'INSERT INTO ' . $this->tablePurchaseLog . 
            ' SET User_id = :user_id, Time = :purchaseTime';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //binding of param
        $stmt->bindParam(':user_id', $this->User_id);
        $stmt->bindParam(':purchaseTime', $currDate);

        //execute the query
        if ($stmt->execute()) return true;

        //print error if sth goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    //add an item to cart with product_id
    public function add_cartItem($Prod_id){
        //create query
        $query = 'INSERT INTO ' . $this->tableCart . 
        ' SET User_id = :user_id, Product_id = :prod_id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //binding of param
        $stmt->bindParam(':user_id', $this->User_id);
        $stmt->bindParam(':prod_id', $Prod_id);

        //execute stmt
        return ($stmt->execute());
    }

    //remove an item from cart by product_id
    public function remove_cartItem($Prod_id){
        //create query
        $query = 'DELETE 
        FROM ' . $this->tableCart . 
        ' WHERE User_id = :user_id AND Product_id = :prod_id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //binding of param
        $stmt->bindParam(':user_id', $this->User_id);
        $stmt->bindParam(':prod_id', $Prod_id);

        //execute stmt
        return ($stmt->execute());
    }

    //check product exist in cart
    public function check_itemInCart($Prod_id){
        //create query
        $query = 'SELECT * 
                FROM '.$this->tableCart.'
                WHERE User_id = :user_id AND Product_id = :prod_id
                LIMIT 1';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //binding of param
        $stmt->bindParam(':user_id', $this->User_id);
        $stmt->bindParam(':prod_id', $Prod_id);

        //execute stmt
        $stmt->execute();
        return (bool)$stmt->fetchColumn();
    }

    //check product exist in cart
    public function check_itemInLib($Prod_id){
        //create query
        $query = 'SELECT * 
                FROM '.$this->tableLibrary.'
                WHERE User_id = :user_id AND Product_id = :prod_id
                LIMIT 1';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //binding of param
        $stmt->bindParam(':user_id', $this->User_id);
        $stmt->bindParam(':prod_id', $Prod_id);

        //execute stmt
        $stmt->execute();
        return (bool)$stmt->fetchColumn();
    }
}

?>