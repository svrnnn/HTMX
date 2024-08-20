<?php

include "funcs.php";

session_start();

// usleep(4000000); // simuloidaan viive

// Otetaan vastaan POST ja tallennetaan sessioon uusi item

// Onko POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Onko POST:n mukana 'item'
    if(isset($_POST['item'])){     

        $id = uniqid(); // Korvataan index, uniikilla ID:llä
        
        // Tallennus SESSIOON
        $_SESSION['items'][$id] = $_POST['item'];

        // Palautuksena riittää pelkkä uusin li-elementti
        echo generateListItem($id, $_POST['item']);
    }
    else {
        echo "POST mukana puuttuu 'item' parametri";
    }
}
else {
    echo "ei ole POST metodi";
}

exit();
?>