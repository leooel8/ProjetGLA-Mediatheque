<?php
    function manageReservationPage() {
        $reservation_list = getReservations();
        require('view/manageReservationView.php');
    }

    function getReservations() {
        $manager = new Manager();
        return $manager->reservationList();
    }

    function validReservation($rmid) {
        $manager = new Manager();
        $manager->validReservation($rmid);
        manageReservationPage();
    }

    function deleteReservation($rmid) {
        $manager = new Manager();
        $manager->cancelReservation($rmid);
        manageReservationPage();
    }

    //href='index.php?action=cancelReservation&rmid=XXX'