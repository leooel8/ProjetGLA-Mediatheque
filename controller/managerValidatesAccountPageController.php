<?php
    function managerValidatesAccountPage() {
        $manager = new Manager();
        $client_list = $manager->getValidatesCustomer();
        $fournisseur_list = $manager->getValidatesProvider();
        require("view/managerValidatesAccountView.php");
    }

    function validateCustomer($cid) {
        $manager = new Manager();
        $manager->validCustomerAccount($cid);
        managerValidatesAccountPage();
    }

    function validateProvider($cid) {
        $manager = new Manager();
        $manager->validProviderAccount($cid);
        managerValidatesAccountPage();
    }

