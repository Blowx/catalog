<?php
switch ($page) {

    case 'index':
        include 'view/index.php';
        break;
    case 'test':
        include 'view/test.php';
        break;
    case 'catalog':
        include 'view/catalog.php';
        break;
    case 'edit':
        include 'view/edit.php';
        break;
    case 'delete':
        include 'view/delete.php';
        break;
    case 'singleproduct':
        include 'view/singleproduct.php';
        break;
}
