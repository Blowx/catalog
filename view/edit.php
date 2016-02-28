<?php
require_once 'inc/functions.php';
require_once 'inc/data.php';


/*const DB_NAME ='myDatabase.db';
$database = new SQLite3(DB_NAME);*/

$id = (isset($_GET['edit']))? strip_tags($_GET['edit']) : 'edit';

/*$sqls = "SELECT * FROM catalog WHERE id='$id'";

$result = $database->query($sqls);*/







?>


<form  method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="Title">Title</label>
        <input type="text" class="form-control" name="title" value=""  placeholder="title">
    </div>
    <div class="form-group">
        <label for="Price">Price:</label>
        <input type="text" class="form-control" name="price" value="" placeholder="price">
    </div>
    <div class="form-group">
        <label for="InputFile">Pic</label>
        <input type="file" name="userfile" id="exampleInputFile">
    </div>
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <button type="submit" name='submit' class="btn btn-default">Загрузить</button>
    <br><br>
</form>

<ul class="list-group">
    <li class="list-group-item list-group-item-info">Все поля обязательны</li>
    <li class="list-group-item list-group-item-info">Вы можете сохранить файл в формате Jpeg или Png</li>
    <li class="list-group-item list-group-item-info">Вы можете соханить файл не более 3мб</li>
</ul>

