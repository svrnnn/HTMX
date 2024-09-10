<?php

require_once "../data/products.php";

// Yksinkertainen routing
// /shopping-spa?page=product&id=p3 => /shopping-spa/product/p3
$page = $_GET["page"] ?? "home";

// Jokainen yhteys tulee tätä kautta
// Tässä voidaan suorittaa koodia, jota tarvitaan joka sivulla "middleware"

switch($page){
    case "product":
        require "../routes/product.php";
        break;
    case "login":
        require "../routes/login.php"; // esimerkki
        break;
    case "cart":
        require "../routes/cart.php"; // esimerkki
        break;
    default:
        require "../routes/home.php";
}

?>