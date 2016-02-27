<?php
switch($page){
    case 'index':
        $title = 'Главная';
        $header = 'Вы на главной странице';
        break;
    case 'test':
        $title = 'Тест';
        $header = 'Вы на тест';
        break;
    case 'catalog':
        $title = 'Каталог';
        $header = 'Вы на странице каталога';
        break;
    case 'catalogLoad':
        $title = 'Каталог';
        $header = 'Вы на странице загрузки';
        break;

}