<?php
require_once "classes/product.php";
require_once "inc/functions.php";

$product = new Product();

$id = (isset($_GET['id']))? strip_tags($_GET['id']) : 'id';

?>

<div class="container">
    <div class="row">

    <?php foreach ($product->selectDirectData($id) as $row ): ?>
            <div class="col-sm-4">


                <a href="index.php?page=singleproduct&id=<?= $row['id'] ?>"><img src="<?= $row['uploadfile'] ?>" style='width: 600px; height: 600px'></a><br>
                <h4><?= $row['title'] ?></h4>
                <?= $row['price'] ?>$<br>
                <?php if(isCookie('admin')): ?>
                    <div  style="border: 0px solid black" >
                        <a href="index.php?page=edit&id=<?= $row['id'] ?>">Изменить <?= $row['id'] ?></a>
                        <br>
                        <a href="index.php?page=delete&id=<?= $row['id'] ?>">Удалить <?= $row['id'] ?></a>
                    </div>
                <?php endif; ?>
                <br>
                <br>
                <br>
            </div>
     <?php endforeach; ?>

    </div>
</div>
