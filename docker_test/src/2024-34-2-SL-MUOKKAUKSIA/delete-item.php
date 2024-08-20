<?php 

session_start();

// usleep(400000);

// Kuinka otetaan DELETE parametri vastaan?

if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    // Vaihtoehto A
    // parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $queryParams);
    // echo "test". $queryParams['index'];

    // Vaihtoehto B
    if(isset($_GET['items'])){
        // Poistetaan taulukosta tietty id
        $id = $_GET['items'];
        // print_r($_SESSION['items']);
        unset($_SESSION['items'][$items]); // poisto id:n perusteella  
        // echo " - POISTO - ";      
        // print_r($_SESSION['items']);
    }else{
        echo "ei ole items";
    }
}else{
    echo "ei ole DELETE metodi";
}



// 0 => yksi
// 1 => kaksi
// 2 => kolme

// 0 => yksi
// 1 => kolme

?>