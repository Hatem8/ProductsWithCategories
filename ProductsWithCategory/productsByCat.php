<?php require_once './layouts/head.php'?>
<?php require_once './helper/functions.php'?>
<div class="d-flex flex-column h-100 bg-light">
<?php require_once './layouts/nav.php';
      require_once './helper/dataFunctions.php';
      $categories = readAllCategories();
      if(isset($_SESSION['products'])){
        $products=$_SESSION['products'];
        unset($_SESSION['products']);
      }
?>
    <div class="row">
        <div class="col-8 mx-auto my-5">
            <h2 class="border p-2 my-2 text-center">Show Products By Category</h2>

            <form action="./controllers/productsByCategoryController.php" method="POST" class="border p-3" enctype="multipart/form-data">
                    <div class="form-group p-2 my-1">
                    <label> Category </label>
                    <select class="form-select" name="catId" aria-label="Default select example" >
                        <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id']?>"> <?= $category['name']?> </option>
                        <?php endforeach;?>
                    </select>
                    </div>
                    <div class="form-group p-2 my-1">
                        <input type="submit" value="Select" class="form-control">
                    </div>
            </form>
        </div>
        <div class="col-8 mx-auto my-5">
        <table class="table border rounded p-3 shadow-lg p-3 mb-5 bg-white">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($products)):?>
                    <?php foreach ($products as $product):?>
                    <tr>
                    <th scope="row"><?php echo $product['id']?></th>
                    <td><?php echo $product['name']?></td>
                    <td><?php echo $product['description']?></td>
                    <td><img width="100px" src="./uploads/<?php echo $product['image']?>" class="img-thumbnail" alt="..."></td>
                    <td><?php echo $product['price']?></td>
                    <td><?php $catName = readOneCategory($product['category_id']); echo $catName['name']; ?></td>
                    <td>
                        <form action="./controllers/deleteController.php" method="post">
                            <input type="hidden" name="id" value ="<?php echo $product['id']?>">
                            <input type="hidden" name="image" value ="<?php echo $product['image']?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <a href="./update.php?id=<?= $product['id'] ?>" class="btn btn-primary">Edit</a>
                        </form>
                    </td>
                    </tr>
                    <?php endforeach; endif;?>

                </tbody>
            </table>
            </div>
    </div>
    <?php require_once './layouts/footer.php'?>
</div>

