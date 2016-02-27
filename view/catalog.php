<?php
require_once "classes/product.php";

require_once "inc/functions.php";
$product = new Product();


/*const DB_NAME ='myDatabase.db';
$database = new SQLite3(DB_NAME);

$sqls = "SELECT * FROM catalog ORDER BY id, title, price";
$result = $database->query($sqls);*/
?>


<div class="container">
    <div class="row">
        <?php foreach ($product->selectData() as $row ):  ?>

            <div class="col-sm-4">
                <img src="<?= $row['uploadfile'] ?>" style='width: 200px; height: 200px'><br>
                <h4><?= $row['title'] ?></h4>
                <?= $row['price'] ?>$<br>
                <?php if(isCookie('admin')): ?>
                    <div  style="border: 1px solid black">
                        <td><a href="index.php?page=index?edit=id<?= $row['id'] ?>">Изменить <?= $row['id']  ?> (<?= ($row[('title')]) ?>)</a></td><br>
                        <td><a href="index.php?page=index?edit=id<?= $row['id'] ?>">Удалить <?= $row['id'] ?> (<?= ($row['title']) ?>)</a></td><br>
                    </div>
                <?php endif; ?>
                <br>
                <br>
                <br>
            </div>

        <?php endforeach; ?>
    </div>
</div>

