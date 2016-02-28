<?php

require_once 'inc/functions.php';
require_once 'inc/data.php';
require_once "classes/product.php";
//require_once 'view/edit.php';

$product = new Product;
$id = (isset($_GET['id']))? strip_tags($_GET['id']) : 'id';

$product->del($id);


if($product->del($id)){
    echo "Файл удален";
}
else{
    echo "Файл не удален";
}
?>
