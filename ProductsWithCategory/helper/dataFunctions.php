<?php 

function mysqlConnect(){
    $hostName = 'localhost';
    $userName = 'root';
    $password = '';
    return new mysqli($hostName,$userName,$password);
    
}
function databaseConnect(){
    $hostName = 'localhost';
    $userName = 'root';
    $password = '';
    $conn = mysqlConnect();
    $sql = 'CREATE DATABASE IF NOT EXISTS `crud_system`';
    $conn->query($sql);
    $conn->close();
    $database = 'crud_system';
    return mysqli_connect($hostName,$userName,$password,$database);
    }
function createCatTable(){
    $conn = databaseConnect();
    $sql = 'CREATE TABLE IF NOT EXISTS categories(
        id BIGINT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL UNIQUE
    );';
    $conn ->query($sql);

}
function createCategory($name){
    $conn = databaseConnect();
    createCatTable();
    $sql = "SELECT * FROM categories WHERE `name`='$name'";
    $result=$conn ->query($sql);
    $product = mysqli_fetch_array($result , MYSQLI_ASSOC);
    if($product==NULL){
        $sql = "INSERT INTO categories (name) VALUES ('$name');";
        $conn ->query($sql);
        $conn ->close();
        return true;
    }
    else {
        $conn ->close();
        return false;
    }
}
function readAllCategories(){
    $conn = databaseConnect();
    createCatTable();
    $query = "SELECT * FROM `categories`";
    $result = mysqli_query($conn,$query);
    $products = mysqli_fetch_all ($result , MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $products;
}
function readOneCategory($id){
    $conn = databaseConnect();
    createCatTable();
    $sql = "SELECT * FROM `categories` WHERE `id` = $id";
    $result = $conn -> query($sql);
    $category = mysqli_fetch_array($result,MYSQLI_ASSOC);
    mysqli_free_result($result);
    $conn ->close();
    return $category;

}
function updateCategory(array $inputData){
    $conn = databaseConnect();
    $id = $inputData['id'];
    $name = $inputData['name'];
    $sql = "SELECT * FROM categories WHERE `name`='$name' AND `id`!='$id'";
    $result=$conn ->query($sql);
    $product = mysqli_fetch_array($result , MYSQLI_ASSOC);
    if($product==NULL){
        $sql = "UPDATE `categories`
                  SET `name` = '$name'
                 WHERE `id` = $id;
        ";
        $conn -> query($sql);
        $conn ->close();
        return true;
        }
        else {
            $conn ->close();
            return false;
        }
 
}
function deleteCategory($id){
    $conn = databaseConnect();
    $query = "DELETE FROM `categories`
             WHERE `id` = $id;
    ";
    mysqli_query($conn,$query);
    mysqli_close($conn);

}
function createProductsTable(){
    $conn = databaseConnect();
    createCatTable();
    $sql = 'CREATE TABLE IF NOT EXISTS products (
        id BIGINT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        description VARCHAR(255),
        image VARCHAR(255),
        price FLOAT,
        category_id BIGINT,
        FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
    );';
    $conn ->query($sql);
}
function readProductsByCatId($id){
    $conn = databaseConnect();
    createProductsTable();
    $query = "SELECT * FROM `products` WHERE `category_id` = '$id' ";
    $result = mysqli_query($conn,$query);
    $products = mysqli_fetch_all ($result , MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $products;
}
function readData(){
    $conn = databaseConnect();
    createProductsTable();
    $query = "SELECT * FROM `products`";
    $result = mysqli_query($conn,$query);
    $products = mysqli_fetch_all ($result , MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $products;
}
function readOnePro($id){
    $conn = databaseConnect();
    $query = "SELECT * FROM `products`
                       WHERE `id`=$id; 
    ";
    $result = mysqli_query($conn,$query);
    $product = mysqli_fetch_array($result , MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $product;
}
function insertData(array $inputData){
    $conn = databaseConnect();
    $name = $inputData['name'];
    $description = $inputData['description'];
    $image = $inputData['image'];
    $price = $inputData['price'];
    $catId = $inputData['catId'];

    $query = "INSERT INTO `products`(`name`,`description`,`image`,`price`,`category_id`)
            VALUES ('$name','$description','$image','$price','$catId')
    ";
    mysqli_query($conn,$query);
    mysqli_close($conn);
}

function updateData(array $inputData){
    $conn = databaseConnect();
    $id = $inputData['id'];
    $name = $inputData['name'];
    $description = $inputData['description'];
    $image = $inputData['image'];
    $price = $inputData['price'];
    $catId = $inputData['catId'];

    $query = "UPDATE `products`
              SET `name` = '$name' , `description` = '$description' , `image` = '$image', `price` = '$price', `category_id` = '$catId'
             WHERE `id` = $id;
    ";
    mysqli_query($conn,$query);
    mysqli_close($conn);
}
function deleteData($delete){
    $conn = databaseConnect();
    $id = $delete['id'];
    $query = "DELETE FROM `products`
             WHERE `id` = $id;
    ";
    deleteFile($delete['image']);
    mysqli_query($conn,$query);
    mysqli_close($conn);

}
function deleteFile($fileName){
    unlink(__DIR__ . '/../uploads/'.$fileName);
}

?>