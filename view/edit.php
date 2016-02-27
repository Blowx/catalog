<?php
require_once 'inc/functions.php';
require_once 'inc/data.php';


const DB_NAME ='myDatabase.db';
$database = new SQLite3(DB_NAME);

$id = (isset($_GET['id']))? strip_tags($_GET['id']) : 'id';

/*$sqls = "SELECT * FROM catalog WHERE id='$id'";

$result = $database->query($sqls);*/







?>




