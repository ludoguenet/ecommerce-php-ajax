<?php
require('includes/_header.php');
$product = new \App\Products\Product($db);
$products = $product->getProducts();
?>
    <div class="col-lg-12">

        <div class="row my-4">

            <?php foreach ($products as $product): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top"
                                         src="<?= $product->image ?>"
                                         alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#"><?= ucfirst($product->title) ?></a>
                            </h4>
                            <h5><?= $product->price ?> €</h5>
                            <p class="card-text"><?= $product->description ?></p>
                        </div>
                        <div class="card-footer">
                            <a id="add-panier" href="addpanier.php?id=<?= $product->id ?>" class="btn btn-secondary"><i
                                        class="fas fa-shopping-basket"></i> Ajouter au panier</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <!-- /.row -->

    </div>
<?php include('includes/footer.php'); ?>