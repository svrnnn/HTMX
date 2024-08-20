<?php

include "data/images.php"; // $DATABASE_IMAGES muuttuja
include "components/image.php"; //

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Käyttäjän klikkaaman kuvan id
    $imageId = $_POST['imageId'];

    // 1. Haetaan kuvan tiedot ID:n perusteella
    $image = null;
    // Jos meillä olisi tietokanta käytössä, tässä haetaan ID:n perusteella tietokannasta
    foreach($DATABASE_IMAGES as $img){
        if($img['id'] === $imageId){
            $image = $img;
            break; // Voidaan lopettaa silmukka, kun id löytyy
        }
    }
    // 2. Lisätään kuvan data sessioon 'selected-images'
    if($image){
        $_SESSION['selected-images'][] = $image;
    }

    // 3 .Palautetaan HTML
    echo renderImage($image);
}


?>