<?php
if(!isset($_GET["id"])){
    die("Product not found.");
}

$productId = $_GET["id"];
$product = array_filter($PRODUCTS, function ($productFilter) use ($productId) {
    return $productFilter["id"] === $productId;
});

if(empty($product)){
    die("Product not found.");
}

$product = array_values($product)[0]; // puretaan turha taulukko datan ympäriltä
$title = $product["title"];

include "../templates/header.php";
?>

<main id="product">
    <header>
        <img src="/shopping-SPA/public/images/<?= $product['image'] ?>" alt="<?= $product['title'] ?>">
        <div>
            <h1><?= $product["title"] ?></h1>
            <p id="product-price"><?= $product["price"] ?></p>
            <form method="post" action="/shopping-SPA/public/cart">
                <button>Add to Cart</button>
            </form>
        </div>
    </header>
    <p id="product-description"><?= $product["description"] ?></p>
</main>

<?php
include "../templates/footer.php";
?>