<?php
    function managerValidatesMediaPage() {
        $manager = new Manager();
        $media_list = $manager->getValidatesMedias();
        require("view/managerValidatesMediaView.php");
    }

    function validateMedia($mid) {
        $manager = new Manager();
        $manager->validMedia($mid);
        
        managerValidatesMediaPage();
    }