<?php 

    session_start();

// Mitä hx-post kohteena olevan tiedoston pitäisi tehdä:
// 1. otetaan vastaan käyttäjän lähettämä data
// 2. Tehdään datalla jotakin, esim tallennetaan se
// 2.a Tietokanta, $_SESSION (Disk/SSD), $_SESSION (RAM). SESSION on väliaikainen
// 3. palautetaan jotakin HTML koodia (valinnainen)


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['note'])){

            // 1. luetaan uusi data
            $newNote = $_POST['note'];

            // 2. tallennetaan data sessioon
            $_SESSION['notes'][] = $newNote; // $_POST['note'];

            // 3. palautetaan HTML
            header("Location: index.php");
            exit();
        }else{
            echo "No 'note' in POST";
        }
    }else {
        echo "Not a POST request method";
    };
?>