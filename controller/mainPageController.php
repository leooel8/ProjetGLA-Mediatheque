<?php
require("model/mainPageModel.php");
   
function mainPage() {	
	require("view/mainPageView.php");
}

function search() {
	bdSearch('Voyage');
}