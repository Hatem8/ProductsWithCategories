<?php 
session_start();
require_once './../helper/dataFunctions.php';
require_once './../helper/functions.php';
$products = readProductsByCatId($_POST['catId']);
$_SESSION['products']=$products;
redirect('./../productsByCat.php');
?>