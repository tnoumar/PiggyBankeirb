<?php
/*
    Seulement les transactions non-réglés peuvent être modifiés
    Seulement le montant et le message explicatif peuvent être modifiés

*/


require_once "config.php"   ;

function modify($transaction_id,$nv_montant,$msg_ex){
    global $link;
    //check if transaction est non reglée
    $sql_status="SELECT stat FROM TRANSACTIONS WHERE tr_id = ?";
    if($stmt = mysqli_prepare($link, $sql_status)){
     
        mysqli_stmt_bind_param($stmt,"i",$transaction_id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt,$stat_reslt);
                mysqli_stmt_fetch($stmt);
                if ($stat_reslt==0) {
                    alert("La transaction id ".$transaction_id." est non réglée" );
                    alert($msg_ex." ".$nv_montant." ");
                    $sql_update="UPDATE TRANSACTIONS SET msg_1= '$msg_ex' ,amount= '$nv_montant'  WHERE tr_id= '$transaction_id' ";
                    if ($stmt_update=mysqli_prepare($link,$sql_update)) {
                        if (mysqli_stmt_execute($stmt_update)) {
                            alert("TRANSACTION NUMBER ".$transaction_id." MODIFIED");
                        } 
                    }
                   
                   
                    
                    
                   else {
                       alert("Something went wrong WHEN MODIFYING. Please try again later.");
                       alert($stat_reslt);
                    }





                }
                else {
                    alert("La transaction est réglée : status: ".$stat_reslt);
                }
            }
           else {
               alert("exec");
           }
        }
        else {
            alert("prep");
        }



    
    mysqli_close($link);

}

?>