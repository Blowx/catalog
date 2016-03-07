<?php
if (isPost()) {
    $AddPhotoToCatalog = new Add();
    $title = $_POST['title'];
    $price = $_POST['price'];
    $AddPhotoToCatalog->save($_FILES['userfile']['name'], $title, $price);
}
?>

<?php if (!isCookie('admin')): ?>
    <h1 style="color: red">Чтобы добавлять товары зайдите в админку</h1><br>
<?php endif; ?>

<?php if ($product->selectData()): ?>
<div>
    <div>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>title</th>
                <th>Price</th>
                <th>dir</th>
                <?php if (isCookie('admin')): ?>
                    <th>Изменить</th>
                    <th>Удалить</th>
                <?php endif; ?>
            </tr>
            <?php foreach ($product->selectData() as $row): ?>
                <tr>
                    <td><a href="index.php?page=singleproduct&id=<?= $row['id'] ?>"><?= $row['title'] ?></a></td>
                    <td><?= $row['price'] ?></td>
                    <td><a href="index.php?page=singleproduct&id=<?= $row['id'] ?>"><img src="<?= $row['uploadfile'] ?>" alt="" style='width: 50px; height: 50px'></a></td>
                    <?php if (isCookie('admin')): ?>
                        <td><a href="index.php?page=edit&id=<?= $row['id'] ?>">Изменить</a></td>
                        <td><a href="index.php?page=delete&id=<?= $row['id'] ?>">Удалить</a></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>

    <?php if (isCookie('admin')): ?>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" class="form-control" name="title" value="" placeholder="title">
            </div>
            <div class="form-group">
                <label for="Price">Price:</label>
                <input type="number" class="form-control" name="price" value="" placeholder="price">
            </div>
            <div class="form-group">
                <label for="InputFile">Pic</label>
                <input type="file" name="userfile" id="exampleInputFile">
            </div>
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000"/>
            <button type="submit" name='submit' class="btn btn-default">Загрузить</button>
            <br><br>
        </form>
        <ul class="list-group">
            <li class="list-group-item list-group-item-info">Все поля обязательны</li>
            <li class="list-group-item list-group-item-info">Вы можете сохранить файл в формате Jpeg или Png</li>
            <li class="list-group-item list-group-item-info">Вы можете соханить файл не более 3мб</li>
        </ul>
    <?php endif; ?>


