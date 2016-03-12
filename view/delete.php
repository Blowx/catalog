<?php
$product->deleteFile($product->getPicName($id));
if ($product->deleleFromDB($id)) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    echo "Файл удален";
} else {
    echo "Файл не удален";
}

