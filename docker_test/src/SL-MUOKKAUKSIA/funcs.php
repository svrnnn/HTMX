<?php

// Lisätään funktio, joka generoi <li> elementin koodin
function generateListItem($id, $item){

    // li-elementin id voidaan poistaa, käytettäessä hx-target="closest li"
    $html = "<li id='item-$id'>";
    $html .= "<span>$item</span>";
    $html .= "<button
                hx-delete=\"delete-item.php?id=$id\"
                hx-target=\"closest li\"
                >Remove</button>";
    $html .= "</li>";

    return $html;
}

?>