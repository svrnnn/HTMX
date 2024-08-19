<?php 

session_start();

// usleep(100000);

    // Kuinka otetaan DELETE parametri vastaan?
    if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
        
        if(isset($_GET['id'])){
            // Poistetaan taulukosta tietty id
            $id = $_GET['id'];
            print_r($_SESSION['items']);
            unset($_SESSION['items'][$id]);
            echo " -POISTO- ";
            print_r($_SESSION['items']);
        }
        else{
            echo "ei ole indeksi";
        }
    }else{
        echo "ei ole DELETE metodi";
    }

?>