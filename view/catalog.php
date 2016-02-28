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
                <a href="index.php?page=singleproduct&id=<?= $row['id'] ?>"><img src="<?= $row['uploadfile'] ?>" style='width: 200px; height: 200px'></a><br>
                <h4><?= $row['title'] ?></h4>
                <?= $row['price'] ?>$<br>
                <?php if(isCookie('admin')): ?>
                    <div  style="border: 1px solid black">
                        <td><a href="index.php?page=edit&id=<?= $row['id'] ?>">Изменить <?= $row['id'] ?></a></td>
                        <br>
                        <td><a href="index.php?page=delete&id=<?= $row['id'] ?>">Удалить <?= $row['id'] ?></a></td>
                    </div>
                <?php endif; ?>
                <br>
                <br>
                <br>
            </div>

        <?php endforeach; ?>
    </div>
</div>

