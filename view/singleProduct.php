<?php
require_once "classes/product.php";
require_once "inc/functions.php";

$product = new Product();

$id = (isset($_GET['id']))? strip_tags($_GET['id']) : 'id';

?>

<div class="container" style="border:0px solid black">
    <div class="row" style="border:0px solid black">

    <?php foreach ($product->selectDirectData($id) as $row ): ?>
            <div  style=" border 0px solid black;">

                <div class="col-md-2" style="border 0px solid black; float: left;">
                    <img src="<?= $row['uploadfile'] ?>" style='width: 600px; height: 600px'>
                </div>
                <br>

                <div class="col-md-1" style="float: right; margin-right: 400px">
                    <h3><?= $row['title'] ?></h3>
                    <h4><?= $row['price'] ?>$</h4>
                    <?php if(isCookie('admin')): ?>


                        <div style="margin-top: 100px">
                            <a href="index.php?page=edit&id=<?= $row['id'] ?>">Изменить</a>
                            <br>
                            <a href="index.php?page=delete&id=<?= $row['id'] ?>">Удалить</a>
                        </div>
                    <?php endif; ?>
                </div>



                <br>
                <br>
                <br>
            </div>
     <?php endforeach; ?>

    </div>
</div>
