<?php

require("controller/mainPageController.php");

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      echo "<p> Post </p>";
    } else if(count($_GET)>0) {
        echo "<p> Get </p>";
    } else {
		mainPage();
	}		
} catch(Exception $e) {
	$errorMessage = $e->getMessage();
}