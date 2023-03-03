
<?php include('header.php') ?>
<!-- Display tasks from database on screen -->
<body class="container">
    <br>
<section id="list" class="list">
    <header>
        <h1>Tasks</h1>
        <form action="." method="get" id="list_todoitems" class="list_todoitems">
            <input type="hidden" name="action" value="list_categories">
            <select name="categoryID" required>
                <option value="0">View All</option>
                <?php foreach ($categories as $category)  : ?>
                    <?php if ($categoryID == $category['categoryID']) { ?>
                        <option value="<?= $category['categoryID'] ?>" selected>
                        <?php } else { ?>
                        <option value="<?= $category['categoryID'] ?>">
                        <?php } ?>
                        <?= $category['categoryName'] ?>
                        </option>
                    <?php endforeach; ?>
            </select>
            <button class="add-button bold">Go</button>
        </form>
    </header>
    
    <table class="table table-striped">
        <tr>
            <th>Category</th>
            <th>Title</th>
            <th>Description</th>
            <th>Delete</th>
        </tr>
    <?php if ($todoitems) {  ?>
        <?php foreach ($todoitems as $todoitem) : ?>
            <table class="table table-striped">
            <div class="list__row">
                <div class="list__item">
                    
                    <tr>
                        <td ><p><?= $category['categoryName'] ?></p></td>
                        <td ><p><?= $todoitem['Title'] ?></p></td>
                        <td ><p><?= $todoitem['Description'] ?></p></td>
                       
                </div>
                <div class="delete_task">
                    <br>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_task">
                        <input type="hidden" name="title" value="<?= $todoitem['Title'] ?>">
                        <td><button>X</button></td>
                </tr>
                    </form>
                </div>
            </div>
            </table>
        <?php endforeach; ?>
    <?php } else {  ?>
        <br>
        <?php if ($categoryID) { ?>
            <p>No Tasks exist for this category yet.</p>
        <?php } else { ?>
            <p>No tasks exist yet.</p>
        <?php } ?>
        <br>
    <?php } ?>
</section>


<!-- Display fields to add a task -->
    <section id="add" class="add">
        <h1>Add a Task</h1>
        <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_task">
            <div class="add__inputs">
            <label>Category: </label>
            <select name="categoryID" required>
            <option value="">Please select</option>
            <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['categoryID'] ?>">
                        <?= $category['categoryName']; ?>
                    </option>
                <?php endforeach; ?>
                </select>
                    <label>Title:</label>
                    <input type="text" id="todoitems" name="title" required>
                    <label>Description:</label>
                    <input type="text" name="description" required>
            </div>
            <div class="add_addItem">
                <button class="add-button bold">Submit</button>
            </div>
        </form>
    </section>
<?php include('view/footer.php'); ?>
<p><a href=".?action=list_categories"> Add Category</a></p>
</body>