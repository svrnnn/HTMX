<?php 

session_start();

// usleep(100000);

// Otetaan vastaan POST ja tallennetaan sessioon uusi item

// Onko POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Onko POSTin mukana 'item'
    if(isset($_POST['item'])){

        $id = uniqid(); // Korvataan index, uniikilla ID:llä

        // tallennetaan data sessioon
        $_SESSION['items'][$id] = $_POST['item'];
        // Palautuksena riittää pelkkä uusin li-elementti
        echo "
        <li id='item-$id'>
            <span>" . htmlspecialchars($_POST['item']) . "</span>
            <button
            hx-delete=\"delete-item.php?id=$id\"
            hx-target=\"#item-$id\"
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