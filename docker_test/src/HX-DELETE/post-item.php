<?php 

session_start();

usleep(100000);

// Otetaan vastaan POST ja tallennetaan sessioon uusi item

// Onko POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Onko POSTin mukana 'item'
    if(isset($_POST['item'])){

        // tallennetaan data sessioon
        $_SESSION['items'][] = $_POST['item'];

        // Saadaan uusimman elementin indeksi selville
        // Tarkistamalla taulukon pituus esim 5
        // Jos pituus on 5, indeksit ovat 0,1,2,3,4
        // Joten uusin on pituus -1

        $newIndex = count($_SESSION['items']) - 1;

        // Palautuksena riittää pelkkä uusin li-elementti
        echo "
        <li id='item-$newIndex'>
            <span>" . htmlspecialchars($_POST['item']) . "</span>
            <button
            hx-delete=\"delete-item.php?index=$newIndex\"
            hx-target=\"#item-$newIndex\"
            hx-swap=\"outerHTML\"
            >REMOVE</button>
        </li>
        ";

    }else{
        echo "No 'item' in POST";
    }
}else {
    echo "Not a POST request method";
}

exit()

?>