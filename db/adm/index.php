<?php
    ob_start();
    INCLUDE_ONCE '../db.php';
    
    if($_SESSION['usr_id'] != 1)
    {
        header("HTTP/1.1 401 Unauthorized");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Список отзывов</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class='container'>
            <table class='user-data'>
                <thead>
                    <?php
                        INCLUDE_ONCE '../../db/db.php';
                        
                        $sql = "SELECT * FROM `reviews`";
                        $result = pdo()->query($sql);

                        if($row = $result->fetch(PDO::FETCH_ASSOC) )
                        {                   
                            $encoded = json_encode($row);
                            $data    = json_decode($encoded, true);
                                
                            echo '<tr>';

                            foreach ($data as $key => $value)
                                echo '<th>' . $key . " " . '</th>';
                        }
                    ?>
                </thead>
                <tbody>
                    <?php
                        /* Удаление записи из БД */
                        if(isset($_GET['delete_id']) )
                        {
                            $sql = 'DELETE FROM reviews WHERE id = :del_id';

                            try
                            {
                                pdo()->prepare($sql)->execute(array('del_id' => $_GET['delete_id']) );
                                
                                header("Location: index.php");
                                ob_end_flush();
                            }
                            catch(PDOException $e) {
                                print "Error!: " . $e->getMessage();
                            }
                        }

                        $sql = "SELECT * FROM `reviews`";
                        $result = pdo()->query($sql);

                        while($row = $result->fetch(PDO::FETCH_ASSOC) )
                        {
                            echo '<tr><form action="upd/update.php" method="get">';

                            foreach ($row as $key => $value) 
                                echo '<td><input type="hidden" name="' . $key . '"value="' . $value . '"> ' . $value . '</td>';

                            echo "<td>";
                            echo "</form><br><a href='?delete_id={$row['id']}'><button class='option-btn'>Удалить</button></a></tr>";
                        }
                    ?>
                </tbody>
            </table>
            <button class="review-btn-panel"><a href="../../">Главная</a></button>
        </div>
    </body>
</html>