<?php
//includes
//creation de la bdd
//fonction alert pour le deboggage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

$db = "CREATE DATABASE IF NOT EXISTS `crosscoders`;";

$usedb = "USE `crosscoders`;";
//creation de la table USERS
$cr_USERS = "CREATE TABLE IF NOT EXISTS `USERS` (
    `user_id` int(60) UNSIGNED NOT NULL AUTO_INCREMENT,
    `prenom` varchar(60)  NOT NULL,
    `nom` varchar(60) NOT NULL,
    `email` varchar(60) NOT NULL,
    `passwd` varchar(60) NOT NULL,
    `birth` date NOT NULL,
    `pseudo`varchar(60) NOT NULL,
    PRIMARY KEY (`user_id`)
    );";
    //creation de la table query
$cr_transactions = "CREATE TABLE IF NOT EXISTS `TRANSACTIONS`(
    `tr_id` int(60) UNSIGNED NOT NULL AUTO_INCREMENT,
    `sender_id` int(11) UNSIGNED  NOT NULL,
    `receiver_id` int(60) UNSIGNED NOT NULL,
    `msg_1` varchar(60) DEFAULT NULL,
    `amount` int(60) NOT NULL,
    `date_1` date DEFAULT NULL,

    `stat` int(60)   NOT NULL DEFAULT 0,
    `date_2` date DEFAULT NULL,

    `msg_2` varchar(60) DEFAULT NULL,
    PRIMARY KEY (`tr_id`)
   
  );";
  //creatiçon de la table liste_amis 
$cr_liste_amis = "CREATE TABLE IF NOT EXISTS liste_amis (
    `users_id` int(60) UNSIGNED NOT NULL ,
    `id` int(20) UNSIGNED NOT NULL 
    );";

//insrertion de deux users et le troisieme qui est tester
  $insert_USERS = "INSERT INTO `USERS` (`user_id`, `prenom`,`nom`,`email`, `passwd`, `birth`,`pseudo`) VALUES
  (1, 'toto','titi','toto@gmail.com', 'tata', '1999-05-01','user1'),
  (2, 'timtim','janvier','timtim@gmail.com', 'modepas', '1999-01-22','timtim64'),
  (3, 'tester','testerrrr','tester@gmail.com', 'mdp', '2004-10-22','tester');";




//inserer deux amis recipriques dans la tables liste_amis
$insertliste_amis = "INSERT INTO `liste_amis` (`users_id`,`id`) VALUES
   (1, 2),
  (2, 1);";

//inserer dans transactions query
$insert_TRANSACTIONS = "INSERT INTO `TRANSACTIONS` (`tr_id`, `sender_id`, `receiver_id`, `msg_1`, `amount`,`date_1`,`stat`,`date_2`, `msg_2`) VALUES 
(1,1,2,'merci pour les 10 balles',10,'2020-05-05',0,'2020-08-09',NULL),
(2,1,2,'merci pour les 102 balles',10,'2020-10-05',0,'2020-10-09','je te les passe jeudi'),
(3,1,2,'SOIREE',10,'2020-06-05',0,'2020-08-09','la semaine prochaine'),
(4,2,1,'SOIREE',10,'2020-08-09',2,'2020-08-09','MERCI');";

/*
// Create connection
$conn = new mysqli('localhost', 'admin', 'it103','crosscoders');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
*/
$link = new mysqli('localhost', 'admin', 'it103'); //creatiung link

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else {
    alert("connected to successfully to mysql server");
   /* if ($conn->query($db) === TRUE) {
        echo "Database created successfully with the name crosscoders";
    
*/

if (mysqli_query($link, $db)) {//code1 linking database
    alert("one more step");
    if (mysqli_query($link, $usedb)    ) {//code2 using database
        alert("SUCCESS");
        if (mysqli_query($link, $cr_USERS)        ) { //code3 creating USERS
            alert("TABLE USERS CREATED");
            if (mysqli_query($link, $cr_liste_amis)            ) { //code4 creating liste_amis
                alert("TABLE liste_amis CREATED");
                if (mysqli_query($link, $cr_transactions)                ) { //code5 creating transactions
                    alert("TABLE TRANSACTIONS CREATED");
                    if (mysqli_query($link, $insert_USERS)                    ) { //code6 inserting USERS
                        alert("TABLE USERS inserting elements");
                        if (mysqli_query($link, $insertliste_amis)                        ) { //code7 inserting listeamis
                            alert("TABLE liste_amis INSERTING ELEMENTS");
                            if (mysqli_query($link, $insert_TRANSACTIONS)                            ) { //code8 inserting transactions
                                alert("TABLE TRANSACTIONS INSERTING ELEMENTS");
                            }
                            else {
                                alert("erreur code8");
                    
                            }
                        }
                        else {
                            alert("erreur code7");
                
                        }
                    }
                    else {
                        alert("erreur code6");
            
                    }
                }
                else {
                    alert("erreur code5");
        
                }
            }
            else {
                alert("erreur code4");
    
            }
        }
        else {
            alert("erreur code3");

        }
    }
    else {
        alert("error code2");
    }
}
else {
    alert("error code1");

}

}
/*
 else {
    alert( "Error creating database: " . $conn->error);
}
*/




mysqli_close($link);
?>
