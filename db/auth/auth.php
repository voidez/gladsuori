<?php
    include_once '../db.php';
    
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"]) )
    {
        $stmt = pdo()->prepare("SELECT * FROM `accounts` WHERE `login` = :login");
        $stmt->execute(
            [
                'login' => $_POST['login']
            ]
        );

        if (!$stmt->rowCount() ) 
        {
            echo "Несуществующие данные!";
            die;
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(password_verify($_POST['password'], password_hash($row['password'], PASSWORD_DEFAULT ) ) )
        {
            $_SESSION['usr_id'] = $row['id'];
            header("Location: ../../");

            die;
        }
        
        echo "Неверный пароль!";
    }
?>