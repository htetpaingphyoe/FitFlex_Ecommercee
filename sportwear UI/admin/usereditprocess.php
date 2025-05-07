<?php 
    require_once "../db/connect.php";
    require_once "../login/checkloginforadmin.php";
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $id=$_POST['id'];
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
        if(!validate($fname,$lname,$address,$gmail,$password,$phnum)){
            try{
                $sql = "UPDATE users SET First_name=:firstname, Last_name=:lastname, Address=:address, Ph_number=:phonenumber, Gmail=:gmail, Password=:password where User_Id=:id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->bindParam(":firstname", $fname);
                $stmt->bindParam(":lastname", $lname);
                $stmt->bindParam(":address", $address);
                $stmt->bindParam(":phonenumber", $phnum);
                $stmt->bindParam(":gmail", $gmail);
                $stmt->bindParam(":password", $password);
                $result = $stmt ->execute();
                // print_r($result);
                header("Location:useredit.php?status=user_is_updated");
            }catch(PDOException $e){
                echo "". $e -> getMessage() ."";
            }  
        }else{
            header("Location:useredit.php?validation=empty&id=$id");
        }
        
    }