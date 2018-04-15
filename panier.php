<?php
require('includes/_header.php');
$panier = new App\Products\Basket($db);
$ids = array_keys($panier->getRawBasket());
if ($ids) {
    $products = $db->query('SELECT * FROM products WHERE id IN (' . implode(',', $ids) . ')');
} else {
    $products = [];
}
?>
    <div class="col-lg-12">

        <div class="row my-5">
            <table class="table my-5">
                <thead>
                <tr>
                    <th scope="col">ID du produit</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Options</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <th scope="row"><?= $product->id ?></th>
                        <td><?= $product->title ?></td>
                        <td><?= $_SESSION['panier'][$product->id] ?></td>
                        <td><?= $product->price ?></td>
                        <td><a id="del-panier" href="delpanier.php?id=<?= $product->id ?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <span class="badge badge-dark">Prix total : <?= $panier->total() ?> €</span>
        </div>
    </div>
<?php include('includes/footer.php'); ?>