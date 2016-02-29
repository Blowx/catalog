<?php
$menu = [
    ['href' => 'index.php?page=index', 'title' => 'Добавление'],
    ['href' => 'index.php?page=catalog', 'title' => 'Каталог'],
];

if (isCookie('admin')) {
    array_push($menu, ['href' => '#', 'title' => '|']);
    array_push($menu, ['href' => 'inc/logout.php', 'title' => 'Выход']);
}

if (!isCookie('admin')) {
    array_push($menu, ['href' => '#', 'title' => '|']);
    array_push($menu, ['href' => 'inc/AdminLog.php', 'title' => 'Вход как Админ']);
}

$page = (isset($_GET['page'])) ? strip_tags($_GET['page']) : 'index';
$id = (isset($_GET['id'])) ? strip_tags($_GET['id']) : 'id';

$ext = [
    'image/jpeg', 'image/png' //разрешенные расширения для загрузки
];