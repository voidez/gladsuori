<?php INCLUDE_ONCE __DIR__.'/db/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/OTZOVIK.NET.css">
        <title>Список отзывов</title>
    </head>
    <body>
        <div class='container'>
            <?php
                if(isset($_SESSION['usr_id']) )
                {
                    $usr_id = $_SESSION['usr_id'];
                    $incr = 0;

                    $sql = "SELECT * FROM `reviews` WHERE usr_id = $usr_id";
                    $result = pdo()->query($sql);

                    while($row = $result->fetch(PDO::FETCH_ASSOC) )
                    {
                        $incr++;
                        
                        echo '<p class="rev-text">Отзыв '. $incr . ':</p>
                        <p class="rev-text">Модель: '. ucwords(str_replace("_", " ", $row['model']) ) .'<br>'.
                        'Комментарий: '.$row['message'].'<br>'.'Комплектация: '.$row['equipment'].'<br>'.'Статус: '.$row['status'].'</p></td>';
                    }
                    
                    if($incr == 0)
                        echo "<p class='NET'>Отзывов пока не оставлено!";
                }
            ?>
        </div>
    </body>
</html>