<?php

    function managerCreatesCustomerPage() {
        require("view/managerCreatesCustomerView.php");
    }

    function managerCreatesAccount($last_name, $first_name, $email, $gender, $address, $premium) {
        $manager = new Manager();
        if ($premium === 'basic_account') {
            $final_premium = 0;
        }
        else if ($premium === 'premium_account') {
            $final_premium = 1;
        }

        if ($gender === 'Homme') {
            $gender = 0;
        }
        else if ($gender === 'Femme') {
            $gender = 1;
        }

        $manager->createCustomerAccount($last_name, $first_name, $email, $gender, $address, $final_premium);
        managerCreatesCustomerPage();
    
    }

