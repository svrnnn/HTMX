<?php

// state, olotila, mitä dataa sovelluksessa on (muuttujia, tietokanta)
// update, päivitys, data muuttuu jollakin tavalla, uusi data jne
//      palvelimen logiikka, tai käyttäjän toiminta, kolmas osapuoli (sää api)
//      observers/listeners programming paradign / design
//      objektiA -> lähettää oman osoitteensa -> objektiB
//      javascript event systeemi, taitaa olla tuollainen
// render, generoidaan UI uudelleen, käyttämällä uutta dataa

include "data/images.php"; // $DATABASE_IMAGES muuttuja
include "components/image.php"; // renderImage()
include "funcs.php"; // getSuggestedImages()

session_start();
// session_destroy();

// Luodaan sessio muuttuja, jos sitä ei vielä ole
if(!isset($_SESSION['selected-images'])){
    $_SESSION['selected-images'] = [];
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- Tässä HTMX konfigurointi myös -->
    <!-- <meta name="htmx-config" content='{"defaultSwapStyle": "outerHTML"}'> -->
    <script src="htmx.js" defer></script>
    <script src="debug-htmx.js" defer></script>
    <script src="main.js" defer></script>
    <title>Image Picker</title>
</head>
<!-- Tässä testataan htmx lisäosaa -->
<!-- <body hx-ext="debug"> -->
<body>
    <header id="testi">
        <img src="logo.png" alt="Camera logo">
        <h1>PhotoPicker</h1>
        <p>Pick a collection of photos from the selection.</p>
    </header>
    <main>
        <section id="suggested-images-section">
            <h2>Currently suggested</h2>
            <ul id="suggested-images"
                hx-get="suggested-images.php"
                hx-swap="innerHTML"
                hx-trigger="every 5s"
            >
                <?php
                    $suggestedImages = getSuggestedImages($DATABASE_IMAGES);
                    foreach($suggestedImages as $image){                        
                        echo renderImage($image);
                    }
                ?>
            </ul>
            <div id="loading"></div>
        </section>

        <section id="selected-images-section">
            <!-- Käyttäjän valinnat -->
            <h2>Selected Images</h2>
            <ul id="selected-images">
                <?php
                    foreach($_SESSION['selected-images'] as $image){
                        // generoi li-elementin HTML koodin, $image datan pohjalta
                        echo renderImage($image, false);
                    }
                ?>
            </ul>

        </section>
        <section>
            <!-- Kaikki kuvat -->
             <h2>Available Images</h2>
             <ul id="available-images">
                <?php 
                    // Käydään läpi /data/images.php tiedoston
                    // muuttujan $DATABASE_IMAGES taulukko
                    // "tietokannasta haettu"

                    $selected = $_SESSION['selected-images'];
                    // Lisätään suodatus, joka ottaa pois kuvat, jotka käyttäjä on jo valinnut
                    $availableImages = array_filter(
                        $DATABASE_IMAGES, 
                        // anonyymi funktio
                        function($image) use ($selected){
                            // Tämä funktio on suodatin
                             // Mitä tämä päästää läpi, on array_filter lopputuloksena
                            return !in_array($image, $selected);
                            // tämän funktion pitää palauttaa joko TRUE tai FALSE
                        }
                    ); // array_filter ei muokkaa alkuperäistä taulukkoa, vaan palauttaa uuden version

                    foreach($availableImages as $image){
                        echo renderImage($image);
                    }
                ?>
             </ul>
        </section>
    </main>
</body>
</html>