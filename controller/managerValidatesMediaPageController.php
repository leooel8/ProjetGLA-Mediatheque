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

    function refuseMedia($mid, $format) {
        $manager = new Manager();
        $manager->deleteMedia($mid, $format);

        managerValidatesMediaPage();
    }