<?php 
require_once './../helper/functions.php';
session_start();

require_once '../helper/dataFunctions.php';
$name = $_POST['name'];
if(createCategory($name)==false){
    $_SESSION['error'] = 'You cant add 2 categories with the same name';
}
else {
    $_SESSION['success'] = 'Category created successfully';
}
redirect('./../createCat.php');

?>