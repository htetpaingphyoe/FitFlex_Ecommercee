<?php 
    require_once "../db/connect.php";
    require_once "../login/checkloginforadmin.php";
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $gmail = $_POST['gmail'];
        $password = $_POST['password'];
        $phnum = $_POST['phone_number'];
        $address = $_POST['address'];
        function validate($fname,$lname, $gmail, $password, $phnum,$address): bool{
            if($fname == ""){
                // echo "name is empty."."<br>";
                return true;
            }if($lname == ""){
                // echo "name is empty."."<br>";
                return true;
            }if($gmail == ""){
                // echo "name is empty."."<br>";
                return true;
            }if($password == ""){
                // echo "name is empty."."<br>";
                return true;
            }if($phnum == 0){
                // echo "name is empty."."<br>";
                return true;
            }if($address == ""){
                // echo "stock is empty."."<br>";
                return true;
            }
            return false;
        }
        // var_dump(validate($name,$brand, $size, $description, $category,$stocks, $price, $image_url));
        if(!validate($fname,$lname,$gmail,$password,$phnum,$address)){
            try{
                $sql = "INSERT INTO users VALUES(0,'$fname','$lname','$address','$phnum','$gmail','$password');";
                $stmt = $pdo->prepare($sql);
                $result = $stmt ->execute();
                print_r($result);
                header("Location:usercreate.php?status=user_is_created");
            }catch(PDOException $e){
                echo "". $e -> getMessage() ."";
            }  
        }else{
            header("Location:usercreate.php?validation=empty");
        }
        
    }