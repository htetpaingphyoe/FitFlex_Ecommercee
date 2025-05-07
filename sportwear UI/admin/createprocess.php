<?php 
    require_once "../db/connect.php";
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $stocks = $_POST['stock'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $category = $_POST['category'];
        $size = $_POST['size'];
        $description = $_POST['description'];
        $image_url = $_FILES['img_url']['name'];
        print_r($image_url);
        function validate($name,$brand, $size, $color, $description, $category,$stocks, $price, $image_url): bool{
            if($name == ""){
                return true;
            }if($brand == ""){
                return true;
            }if($size == ""){
                return true;
            }if($description == ""){
                return true;
            }if($category == ""){
                return true;
            }if($stocks == 0){
                return true;
            }if($price == 0){
                return true;
            }
            if($color == ""){
                return true;
            }if($image_url==""){
                return true;
            }
            return false;
        }
        if(!validate($name,$brand,$size,$color,$description,$category,$stocks,$price,$image_url)){
            try{
                $sql = "INSERT INTO products VALUES(0,'$name','$description','$category','$brand','$size','$color','$price','$stocks','$image_url',now());";
                $stmt = $pdo->prepare($sql);
                $result = $stmt ->execute();
                print_r($result);
                header("Location:newcreateproduct.php?status=product_is_created&image_url=$image_url");
            }catch(PDOException $e){
                echo "". $e -> getMessage() ."";
            }  
        }else{
            header("Location:newcreateproduct.php?validation=empty");
        }
        
    }
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    if(isset($_FILES['img_url']) && $_FILES['img_url']["error"]=== UPLOAD_ERR_OK){
        $upload_dir = "../product_img/";
        $target_File = $upload_dir.basename(($_FILES['img_url']['name']));
        if(move_uploaded_file($_FILES['img_url']['tmp_name'], $target_File)){
            echo "image is uploaded";
        }
    }