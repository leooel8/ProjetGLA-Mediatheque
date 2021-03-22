<?php
//session_start(); // Cookie

require("model/db.php");
require("controller/mainPageController.php");

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      echo "<p> Post </p>";
    } else if(count($_GET) > 0) {
        if(isset($_GET['action'])) {
			if($_GET['action'] === 'login') {
				echo 'login';
			}
		} else if(isset($_GET['search'])) {
			search();
		}
    } else {
		mainPage();
	}		
} catch(Exception $e) {
	$errorMessage = $e->getMessage();
}