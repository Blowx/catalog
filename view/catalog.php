<div class="container">
    <div class="row">
        <?php foreach ($product->selectData() as $row): ?>

            <div class="col-sm-4">
                <a href="index.php?page=singleproduct&id=<?= $row['id'] ?>"><img src="<?= $row['uploadfile'] ?>"
                                                                                 style='width: 200px; height: 200px'></a><br>
                <h4><a href="index.php?page=singleproduct&id=<?= $row['id'] ?>"><?= $row['title'] ?></a></h4>
                <?= $row['price'] ?><br>
                <?php if (isCookie('admin')): ?>
                    <div>
                        <td><a href="index.php?page=edit&id=<?= $row['id'] ?>">Изменить</a></td>
                        <br>
                        <td><a href="index.php?page=delete&id=<?= $row['id'] ?>">Удалить</a></td>
                    </div>
                <?php endif; ?>
                <br>
                <br>
                <br>
            </div>

        <?php endforeach; ?>
    </div>
</div>

