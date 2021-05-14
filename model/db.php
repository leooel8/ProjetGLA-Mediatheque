<?php

function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=gla_projet_db;charset=utf8', 'user_mediatheque', 'password_mediatheque');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}