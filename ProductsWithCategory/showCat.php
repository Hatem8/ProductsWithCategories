<?php require_once './layouts/head.php'?>
<div class="d-flex flex-column h-100 bg-light">
<?php require_once './layouts/nav.php';
require_once './helper/dataFunctions.php';
require_once './helper/functions.php';
$categories = readAllCategories();
?>
    <div class="container">
        <div class="row m-5">
            <div class="col-6 mx-auto border rounded p-2">
            <h1>Categories</h1>

                <?php if (isset($_SESSION['success'])) : ?>
                    <div class="alert alert-success text-center" role="alert">
                        <?=getSession('success') ?>
                </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="alert alert-danger text-center">
                        <?=getSession('error') ?>
                </div>
                <?php endif; ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($categories as $category):?>
                            <tr>
                                <th scope="row"><?php echo $category['id']?></th>
                                <td><?php echo $category['name']?></td>
                                <td> <form action="./controllers/deleteCategoryController.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $category['id']?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <a href="./updateCat.php?id=<?= $category['id'] ?>" class="btn btn-primary">Edit</a>
                                    </form>
                                </td>
                            
                            </tr>
                    <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once './layouts/footer.php'?>
    </div>
