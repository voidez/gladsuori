<?php
    session_start();

    function pdo(): PDO
    {
        static $pdo;

        if (!$pdo) 
        {
            $dbName = "dbmain";
            $dbUserName = "root";
            $dbPswd = "root";

            // Подключение к БД
            $pdo = new PDO("mysql:host=localhost; dbname=" . $dbName, $dbUserName, $dbPswd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $pdo;
    }

    function check_auth(): bool
    {
        return !!($_SESSION['usr_id'] ?? false);
    }

?>