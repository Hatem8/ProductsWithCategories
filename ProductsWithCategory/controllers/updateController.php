<?php 
require_once('./../helper/dataFunctions.php');
require_once('./../helper/functions.php');
require_once('./../helper/validations.php');
$errors=[];
$oldProduct = readOnePro($_POST['id']);
$image = empty($_FILES['file']['name']) ? $oldProduct['image'] : uploadFile('file');
//validations for photo
valImage($image,$errors);
if(empty($errors)){
    if ($oldProduct['image']!=$image){
        deleteFile($oldProduct['image']);
    }
    $updatedProduct = ['id'=> $_POST['id'],'name' =>$_POST['name'] , 'description' => $_POST['description'] , 'image' =>$image,'price'=> $_POST['price'] ,'catId'=>$_POST['catId']];
    updateData($updatedProduct);
    redirect('./../index.php');
}
else{
    $_SESSION['errors']= $errors;
    redirect('./../index.php');
}


?>