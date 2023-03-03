<?php include("view/header.php") ?>
<table class="table table-striped">
            <tr>
                <th>Category</th>
                <th>Delete</th>
            </tr>
<?php if ($categories) { ?>
    <body class="container">
    <br>
    <section id="list" class="list">
        <header>
            <h1>Categories</h1>
        </header>
        <?php foreach ($categories as $category)  : ?>
            <input type="hidden" name="action" value="list_categories">
            <table class="table table-striped">

            <div class="list__row">
                <div class="list__item">
                <tr>
                    <td><p class="bold"><?= $category['categoryName'] ?></p></td>
                <div class="delete_category">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" name="categoryName" value="<?= $category['categoryName'] ?>">
                        <td><button class="remove-button">X</button></td>
                </tr>
                    </form>
                </div>
            </div>
            </table>
        <?php endforeach; ?>
    </section>
<?php } else { ?>
    <p>No Categories exist yet</p>
<?php } ?>


<section>
    <h2>Add Category</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_category">
        <div class="add__inputs">
            <label>Name:</label>
            <input type="text" name="categoryName" maxlength="30" placeholder="Name" autofocus required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>
</body>
<p><a href="<?php echo $_SERVER['PHP_SELF'] ?>">View Tasks</a></p>
<?php include("view/footer.php") ?>

