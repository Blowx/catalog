<?php
setcookie('admin', true, 0, '/');

header('Location: ' . $_SERVER['HTTP_REFERER']);
