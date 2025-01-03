<?php
    class connection
    {
        private $hostname;
        private $dbname;
        private $username;
        private $password;
        #constructor
        function __construct($hostname,$dbname,$username,$password)
        {
            $this->hostname = $hostname;
            $this->dbname = $dbname;
            $this->username = $username;
            $this->password = $password;
        }
        function getConnection(){
            try{
            $pdo = new PDO("mysql:hostname=$this->hostname;dbname=$this->dbname", $this->username,$this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "connected!</br>";
            return $pdo;
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
    }