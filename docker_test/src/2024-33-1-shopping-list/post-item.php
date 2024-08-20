<?php 

session_start();

// Otetaan vastaan POST ja tallennetaan sessioon uusi item

// Onko POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Onko POSTin mukana 'item'
    if(isset($_POST['item'])){

        // tallennetaan data sessioon
        $_SESSION['items'][] = $_POST['item'];

        // Palautuksena riittää pelkkä uusin li-elementti
        echo "
        <li>
            <span>" . htmlspecialchars($_POST['item']) . "</span>
            <button>Remove</button>
        ";

    }else{
        echo "No 'item' in POST";
    }
}else {
    echo "Not a POST request method";
}

exit()

?>