<?php
$product->del($id);

if ($product->del($id)) {
    echo "Файл удален";
} else {
    echo "Файл не удален";
}

