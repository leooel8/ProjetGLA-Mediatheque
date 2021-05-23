<?php

function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=mediatheque;charset=utf8', 'root', 'password');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}