<?php
$product->deleteFile($product->getPicName($id));
if ($product->deleleFromDB($id)) {
    echo "Файл удален";
} else {
    echo "Файл удален";
}

