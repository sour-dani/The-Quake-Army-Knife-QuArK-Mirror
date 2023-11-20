#!/usr/bin/php
<?php
include("_functions.php");

function pageLocalDisplay() {
  pageName("News");
  displayNews();
}

pageDisplay("News", 'pageLocalDisplay');
?>
