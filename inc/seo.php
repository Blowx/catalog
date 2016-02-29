<?php
switch($page){
    case 'index':
        $title = 'Главная';
        break;
    case 'catalog':
        $title = 'Каталог';
        break;
    case 'edit':
        $title = "Изменение товара" ;
        break;
    case 'delete':
        $title = "Удаление товара" ;
        break;
    case 'singleproduct':
        $title = "Просмотр товара" ;
        break;
}