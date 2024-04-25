

<?php require_once './layouts/head.php';

?>
<div class="d-flex flex-column h-100 bg-light">
<?php require_once './layouts/nav.php' ;
require_once './helper/dataFunctions.php';

$category = readOneCategory($_GET['id']);

?>
    <div class="container">
        <div class="row m-5">
            <div class="col-6 mx-auto border rounded p-2">
                <h1>Update Category</h1>
                <form method="POST" action="./controllers/updateCategoryController.php">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $category['id']?>">
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" value=<?php echo $category['name']?>>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <?php require_once './layouts/footer.php'?>
    </div>
