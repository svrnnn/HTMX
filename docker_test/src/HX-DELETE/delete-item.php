<?php 

session_start();

    // Kuinka otetaan DELETE parametri vastaan?
    if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
        
        if(isset($_GET['index'])){
            // Poistetaan taulukosta tietty indeksi
            $index = (int)$_GET['index'];
            unset($_SESSION['items'][$index]);
        }
        else{
            echo "ei ole indeksi";
        }
    }else{
        echo "ei ole DELETE metodi";
    }

?>