<?php
    ob_start();
    include_once __DIR__.'/db/db.php';

    $user = null;
    
    if (check_auth() ) 
    {
        $stmt = pdo()->prepare("SELECT * FROM `accounts` WHERE `id` = :id");
        $stmt->execute(['id' => $_SESSION['usr_id']]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Главная</title>
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
        <header>
            <?php 
                if ($user != null) 
                {
            ?>
            <div class="header-wrapper">
                <div class="current-user">
                    <img class="user-avatar" src="css\img\default.png">
                    <p><?=$user['login']?></p>
                </div>
            <?php
                if($_SESSION['usr_id'] == 1)
                {
            ?>
                    <button class="adm-pnl" onclick="window.location.href='../db/adm/index.php'">Список отзывов</button>
            <?php
                }
            ?>
                <button class="exit-btn" onclick="window.location.href='../db/auth/exit.php'">Выйти</button>
            <?php 
                } 
                else 
                { 
                    header("Location: ../login.html");
                    ob_end_flush();
                }
            ?>
            </div>
        </header>
        <div class="main-container">
            <form action="db/reviews/handler.php" method="post">
                <p>Оставить отзыв</p>
                <input type="hidden" name="usr_id" value="<?=$_SESSION['usr_id']?>">
                <input type="text" name="message" placeholder="Сообщение">
                <select id="models-select" name="model">
                    <option value="samsung_galaxy_99">Sasung Galaxy A99</option>
                    <option value="iphone_2">Iphyne 2</option>
                    <option value="iphone_99">Iphyne 99</option>
                    <option value="iphone_18">Iphyne 18</option>
                </select>
                <select id="equip-select" name="equipment">
                    <option value="Max">Max</option>
                    <option value="Pro_Max">Pro Max</option>
                    <option value="Standard">Standard</option>
                    <option value="Ultra">Ultra</option>
                </select>
                <input type="submit" value="Отправить отзыв">
            </form>
            <button><a href="reviews.php">Ваши отзывы</a></button>
        </div>
	</body>
</html>