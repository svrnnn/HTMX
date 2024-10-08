<?php 

session_start();

// usleep(200000);

include "data/images.php"; // $DATABASE_IMAGES muuttuja
include "components/image.php"; // renderImage()
include "funcs.php"; // getSuggestedImages()

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Käyttäjän klikkaaman kuvan id
    $imageId = $_POST['imageId'];

    // 1. Haetaan kuvan tiedot ID:n perusteella
    $image = null;
    // Jos tietokanta olisi käytössä, tässä haetaan ID:n perusteella tietokannasta
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

    // 3. Palautetaan HTML, määritetään funktioon false, että kyseessä on DELETE-versio
    echo renderImage($image, false);

    // Lisätään OOB ominaisuus, joka poistaa valitun kuvan alemmasta listasta
    echo "<ul id=\"available-images\" hx-swap-oob=\"true\">";
        $selected = $_SESSION['selected-images'];
        $availableImages = array_filter(
            $DATABASE_IMAGES, 
            function($image) use ($selected){
                return !in_array($image, $selected);
            }
        );

        foreach($availableImages as $image){
            echo renderImage($image);
        }
    echo "</ul>";  

    // päivitetään suggested images section
    $suggestedImages = getSuggestedImages($DATABASE_IMAGES);
    echo "<ul id=\"suggested-images\" hx-swap-oob=\"innerHTML\">";

        foreach($suggestedImages as $image){
            echo renderImage($image);
        }

    echo "</ul>";
}

if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    if(isset($_GET['id'])){
        $imageId = $_GET['id'];

        // print_r($_SESSION['selected-images']);
        // echo "------------------------------------------------";

        // Etsitään sen taulukon indeksi, jossa on valitun kuvan id
        $imageIndex = null; // kuvan indeksi sessiossa
        foreach($_SESSION['selected-images'] as $index => $image){
            // echo $index; // string
            // print_r($image); // taulukot
            if($imageId === $image['id']){
                $imageIndex = $index;
                break; // Voidaan lopettaa silmukka, koska yksi id on vain kerran sessiossa
            }
        }

        // Poistetaan taulukosta elementti, indeksin perusteella
        if($imageIndex !== null){
            array_splice($_SESSION['selected-images'], $imageIndex, 1);

            // Lisätään vastaukseen "out of bounds" parametri/data
            // Joka on HTMX tekniikka, jolla voidaan päivittää muita HTML elementtejä
            echo "<ul id=\"available-images\" hx-swap-oob=\"true\">";
                $selected = $_SESSION['selected-images'];
                $availableImages = array_filter(
                    $DATABASE_IMAGES, 
                    function($image) use ($selected){
                        return !in_array($image, $selected);
                    }
                );

                foreach($availableImages as $image){
                    echo renderImage($image);
                }
            echo "</ul>";
            // echo "<header id=\"testi\" hx-swap-oob=\"true\">";
            // echo "</header>";

        }
    }
    // Tämä tiedosto lähettää vastauksen
    // Ja vastauksen data määritellään esim echo-funktiolla
    // Jos ei määritetä echo:lla sisältöä, response.body on tyhjä
}

?>