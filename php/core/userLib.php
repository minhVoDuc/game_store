<?php
    class userLib
    {
        //db stuff
        private $conn;
        private $table = 'user_library';

        //post properties
        public $userID;
        public $productID;
        public $libID;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function count(){
            $query = 'SELECT COUNT(Product_id)
                FROM '.$this->table;
            
            //prepare statement
            $stmt = $this->conn->prepare($query);
    
            //execute query
            $stmt->execute();
    
            return $stmt;
        }

        public function getInfo(){
            //create query
            $query = 'SELECT * 
                FROM '. $this->table .
                ' WHERE Product_id=' . $this->productID;
            
            //prepare statement
            $stmt = $this->conn->prepare($query);
    
            //execute query
            $stmt->execute();
    
            return $stmt;
        }
    }
?>