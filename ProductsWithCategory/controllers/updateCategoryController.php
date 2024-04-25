<?php 
require_once('./../helper/dataFunctions.php');
require_once('./../helper/functions.php');
require_once('./../helper/validations.php');

if(updateCategory($_POST)==false){
    $_SESSION['error'] = 'There is another category with the same name';
}
else {
    $_SESSION['success'] = 'Category updated successfully';
}
redirect('./../showCat.php');
?>