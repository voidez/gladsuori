<?php
    include_once '../db.php';
    
    if(isset($_POST) )
    {
        try
        {
            $fio        = $_POST['reg_fio'];
            $phone      = $_POST['reg_phone'];
            $email      = $_POST['reg_email'];
            $login      = $_POST['reg_login'];
            $password   = $_POST['reg_password'];

            $sql = "INSERT INTO accounts (fio, phone, email, login, password)
            VALUES (:fio, :phone, :email, :login, :password)";
            
            try 
            {
                pdo()->prepare($sql)->execute( 
                    array(
                        ":fio" => $fio,
                        ":phone" => $phone, 
                        ":email" => $email, 
                        ":login" => $login, 
                        ":password" => $password
                    ) 
                );

                echo "data has been sended to database!";
            }
            catch(PDOException $e) {
                print "Statement Error!: " . $e->getMessage();
            }
        }
        catch (PDOException $e) {
            print "Database error: " . $e->getMessage();
        }
    }
?>