<?php
require_once './../helper/functions.php';
session_start();
require_once './../helper/dataFunctions.php';
$id = $_POST['id'];
deleteCategory($id);
$_SESSION['success'] = 'Category deleted successfully';

redirect('./../showCat.php');
