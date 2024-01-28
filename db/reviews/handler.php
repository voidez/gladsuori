<?php
    include_once '../db.php';
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $message = $_POST['message'];
        $model = $_POST['model'];
        $equipment = $_POST['equipment'];
        $status = $_POST['status'];

        $sql = "INSERT INTO reviews (usr_id, message, model, equipment, status)
            VALUES (:usr_id, :message, :model, :equipment, :status)";
            
        try 
        {
            pdo()->prepare($sql)->execute( 
                [
                    ":usr_id" => $_POST['usr_id'], 
                    ":message" => $message, 
                    ":model" => $model, 
                    ":equipment" => $equipment,
                    ":status" => "new", 
                ]
            );

            echo "Отзыв оставлен!<br>";
        }
        catch(PDOException $e) {
            print "Statement Error!: " . $e->getMessage();
        }

    }
?>
<button class="review-exit-button"><a href="../../">На главную</a></button>