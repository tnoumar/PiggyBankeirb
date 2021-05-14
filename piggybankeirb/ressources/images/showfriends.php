<?php

    $id_utilisateur=3;
    //create an array with the user's friend ids


    //récupère les infos dans la bdd


    // Include config file
    require_once "config.php";
    function showfriendspseudo($id_utilisateur){
        global $link;
        $sql = 'SELECT id from liste_amis WHERE users_id ='.$id_utilisateur;
        $rslt = $link->query($sql);
        $nbamis=mysqli_num_rows($rslt);
        for ($i = 1; $i <=$nbamis; $i++) { 
            $identifiant=mysqli_fetch_array($rslt);
            $id_ami=$identifiant[0];
            $sql1='SELECT pseudo from USERS WHERE user_id='. $id_ami;
            $rslt1 = $link->query($sql1);
            if(!$rslt1){
                echo ("erreur de requete");
            }
            $ami=mysqli_fetch_array($rslt1);
            echo "$ami[0]<br/>";
        }
    }
    function showfriendprenom($id_utilisateur){
        global $link;
        $sql = 'SELECT id from liste_amis WHERE users_id ='.$id_utilisateur;
        $rslt = $link->query($sql);
        $nbamis=mysqli_num_rows($rslt);
        for ($i = 1; $i <=$nbamis; $i++) { 
            $identifiant=mysqli_fetch_array($rslt);
            $id_ami=$identifiant[0];
            $sql1='SELECT prenom from USERS WHERE user_id='. $id_ami;
            $rslt1 = $link->query($sql1);
            if(!$rslt1){
                echo ("erreur de requete");
            }
            $prenom=mysqli_fetch_array($rslt1);
            echo "$prenom[0]<br/>";
        }
    }

    function showfriendnom($id_utilisateur){
        global $link;
        $sql = 'SELECT id from liste_amis WHERE users_id ='.$id_utilisateur;
        $rslt = $link->query($sql);
        $nbamis=mysqli_num_rows($rslt);
        for ($i = 1; $i <=$nbamis; $i++) { 
            $identifiant=mysqli_fetch_array($rslt);
            $id_ami=$identifiant[0];
            $sql1='SELECT nom from USERS WHERE user_id='. $id_ami;
            $rslt1 = $link->query($sql1);
            if(!$rslt1){
                echo ("erreur de requete");
            }
            $nom=mysqli_fetch_array($rslt1);
            echo "$nom[0]<br/>";
        }
    }


    function solde($id_utilisateur){

        global $link;
        $sql = 'SELECT id from liste_amis WHERE users_id ='.$id_utilisateur;
        $rslt = $link->query($sql);
        $nbamis=mysqli_num_rows($rslt);
        for ($i = 1; $i <=$nbamis; $i++) {
            $identifiant=mysqli_fetch_array($rslt);
            $id_ami=$identifiant[0];
            $sql2='SELECT sum(amount) FROM `TRANSACTIONS` WHERE receiver_id='.$id_ami;
            $rslt2 = $link->query($sql2);
            if(!$rslt2){
                echo ("erreur de requete, il n'y a peut être pas encore de trasaction à ce nom");
            }
            $montant=mysqli_fetch_array($rslt2);
            echo "$montant[0]"
            echo "<br/>"; // Cela saute une ligne même si le solde est nul avec le dit utilisateur


        }


    }
    
    ?>
    

