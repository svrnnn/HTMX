<?php

// Tällä tiedostolla voisi tyhjentää koko listan
session_start();

$_SESSION['items'] = []; // Tyhjennetään session taulukko

// päivitetään HTML käyttäjlle
exit();
?>