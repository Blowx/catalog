<?php


$menu = [
    ['href' => 'index.php?page=index', 'title' => 'Главная + таблица в админе'],
    //['href' => 'index.php?page=catalogLoad', 'title' => 'Каталогload'],
    ['href' => 'index.php?page=catalog', 'title' => 'catalog'],
    //['href' => 'index.php?page=ctlg', 'title' => 'Таблица ООП НОВЫЙ'],
    //['href' => 'view/AdminLog.php', 'title' => 'Админ'],
    //['href' => 'index.php?page=catalogLoad', 'title' => 'Загрузка в каталог']
];


if(isCookie('admin')){
    array_push($menu, ['href' => '#', 'title' => '|']);
    array_push($menu, ['href' => 'inc/logout.php', 'title' => 'Выход']);

    //array_push($menu, ['href' => 'index.php?page=catalogLoad', 'title' => 'Загрузка']);


}elseif(isCookie('user')){
    array_push($menu, ['href' => '#', 'title' => '|']);
    array_push($menu, ['href' => 'inc/logout.php', 'title' => 'Выход']);
    array_push($menu, ['href' => '#', 'title' => '|']);
    array_push($menu, ['href' => '', 'title' => 'Привет, Юзер']);

}

if(!isCookie('admin')){
    array_push($menu, ['href' => 'inc/AdminLog.php', 'title' => 'Вход как Админ']);
}

//$page = (isset($_GET['id']))? strip_tags($_GET['id']) : 'id';
$page = (isset($_GET['page']))? strip_tags($_GET['page']) : 'index';

$ext = [
    'image/jpeg', 'image/png'
];