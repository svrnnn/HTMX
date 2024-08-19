<?php 

include "funcs.php";

session_start();

usleep(4000000); // simuloidaan viive

// Otetaan vastaan POST ja tallennetaan sessioon uusi item

// Onko POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Onko POSTin mukana 'item'
    if(isset($_POST['item'])){

        $id = uniqid(); // Korvataan index, uniikilla ID:llä

        // tallennetaan data sessioon
        $_SESSION['items'][$id] = $_POST['item'];
        // Palautuksena riittää pelkkä uusin li-elementti
        echo generateListItem($id, $_POST['item']);

    }else{
        echo "No 'item' in POST";
    }
}else {
    echo "Not a POST request method";
}

exit()

?>