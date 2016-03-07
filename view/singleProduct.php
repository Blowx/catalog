<div class="container">
    <div class="row">

        <?php foreach ($product->selectDirectData($id) as $row): ?>
            <div>
                <div class="col-md-2">
                    <img src="<?= $row['uploadfile'] ?>" style='width: 600px; height: 600px'>
                </div>
                <br>

                <div class="col-md-1" style="float: right; margin-right: 400px">
                    <h3><?= $row['title'] ?></h3>
                    <h4><?= $row['price'] ?>$</h4>
                    <?php if (isCookie('admin')): ?>
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
