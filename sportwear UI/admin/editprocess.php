<?php 
    require_once "../db/connect.php";
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $id=$_POST['id'];
        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $stocks = $_POST['stock'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $size = $_POST['size'];
        $color = $_POST['color'];
        $description = $_POST['description'];
        $image_url = $_FILES['img_url']['name'];
        print_r($image_url);
        function validate($name, $brand, $size, $color, $description, $category, $stocks, $price, $image_url): bool{
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
            }if($color == ""){
                return true;
            }
            if($image_url==""){
                return true;
            }
            return false;
        }
       var_dump(validate($name,$brand, $size,$color, $description, $category,$stocks, $price, $image_url));
        if(!validate($name, $brand, $size, $color, $description, $category, $stocks, $price, $image_url)){
            try{
                $sql = "UPDATE products SET Name=:name,Description=:description,Category=:category,Brand=:brand,Size=:size,Color=:color, Price=:price, Stock_Quantity=:stocks, Image_URL=:img_url WHERE Product_ID=:id;";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":description", $description);
                $stmt->bindParam("category", $category);
                $stmt->bindParam(":brand", $brand);
                $stmt->bindParam(":size", $size);
                $stmt->bindParam(":color", $color);
                $stmt->bindParam(":stocks", $stocks);
                $stmt->bindParam(":price", $price);
                $stmt->bindParam(":img_url", $image_url);
                $result = $stmt ->execute();
                print_r($result);
                if($result){
                    header("location: newproductedit.php?status=product_is_updated&image_url=$image_url");
                }
                
            }catch(PDOException $e){
                echo "". $e -> getMessage() ."";
            }  
        }else{
            header("Location:newproductedit.php?validation=empty&id=$id");
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