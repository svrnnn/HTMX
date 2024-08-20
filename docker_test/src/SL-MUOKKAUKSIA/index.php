<?php

    include "funcs.php";

    session_start();
    // session_destroy();

    // Tarkistetaan onko muuttuja olemassa valmiina
    // Jotta ei tyhjennetä käyttäjän ostoslistaa
    if(isset($_SESSION['items']) === false){

        // Luodaan session muuttuja, jossa oletuksena tyhjä taulukko
        $_SESSION['items'] = [];
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="htmx.js"></script>
</head>
<body>
    <main>
        <h1>Shopping List</h1>
        <section>
            <form id="item-form" 
            hx-post="post-item.php"
            hx-target="#items"
            hx-swap="beforeend"
            hx-on::after-request="this.reset();
            document.querySelector('input').focus();"
            hx-disabled-elt="form button"
            >
                <div>
                    <label for="item">Item</label>
                    <input required type="text" id="item" name="item" />
                </div>
                <button type="submit">Add item</button>
            </form>
        </section>
        <section>
            <ul id="items"
            hx-swap="outerHTML"
            hx-confirm="Are you sure?">
                <?php 
                    foreach($_SESSION['items'] as $id => $item){
                        echo generateListItem($id, $item);
                    }
                ?>
            </ul>
        </section>
    </main>
</body>
</html>