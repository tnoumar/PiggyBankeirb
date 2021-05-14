<?php

require_once "config.php";


function mybalance($id_utilisateur){

    global $link;
    $solde=0;
    $sql = 'SELECT id from liste_amis WHERE users_id ='.$id_utilisateur;
    $rslt = $link->query($sql);
    $nbamis=mysqli_num_rows($rslt);
    for ($i = 1; $i <=$nbamis; $i++) {
        $identifiant=mysqli_fetch_array($rslt);
        $id_ami=$identifiant[0];
        $sql2='SELECT sum(amount) FROM `TRANSACTIONS` WHERE receiver_id='.$id_ami;
        $sql3='SELECT sum(amount) FROM `TRANSACTIONS` WHERE sender_id='.$id_ami;
        $rslt2 = $link->query($sql2);
        $rslt3 = $link->query($sql3);

        $montant2=mysqli_fetch_array($rslt2);
        $montant3=mysqli_fetch_array($rslt3);
        $montant=$montant3[0]-$montant2[0];
        if ($montant==NULL){
            $montant=0;
        }
        else {
            $solde = $solde + $montant;
        }
        

}
echo $solde;
        echo "<br/>";
}
?>