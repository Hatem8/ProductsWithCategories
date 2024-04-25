<?php require_once './layouts/head.php'?>
<div class="d-flex flex-column h-100 bg-light">
<?php require_once './layouts/nav.php';
      require_once './helper/functions.php';
?>
    <div class="container">
        <div class="row m-5">
            <div class="col-6 mx-auto border rounded p-2">
                <h1>Create Category</h1>
                <?php if (isset($_SESSION['success'])) : ?>
                    <div class="alert alert-success text-center" role="alert">
                        <?= getSession('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?= getSession('error') ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="./controllers/createCategoryController.php">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
                    </div>
               
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <?php require_once './layouts/footer.php'?>
    </div>
