<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['note'])){
            header("Location: index.php");
            exit();
        }else{
            echo "No 'note' in POST";
        }
    }else {
        echo "Not a post request method";
    };
?>