<?php

//search for friend first
//if exists down
//else
//echo user not found



//v1=friend_id different than mine

// Include config file
require_once "config.php";



function add($friend_pseudo,$my_id){
    global $link;




//ma fonction add cherche si le pseudo_ami existe et l'ajoute dans la table liste_amis 

    $sql_SEARCH = "SELECT  user_id FROM USERS WHERE pseudo = ?";

    if($stmt = mysqli_prepare($link, $sql_SEARCH)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $friend_pseudo );

    

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
           // Store result
           mysqli_stmt_store_result($stmt);

            // Check if username exists
            if(mysqli_stmt_num_rows($stmt) == 1){
                 alert($friend_pseudo." exists");
               
                mysqli_stmt_bind_result($stmt,$friend_id);
                mysqli_stmt_fetch($stmt);
                alert($friend_id);
            }
            else {
               
                    alert("user ".$friend_pseudo." not found");
                
            }
        }
    }
                // on doit check si friend_id est deja notre ami
                // si il ne l'est pas on l'ajoute
              $sql_check_ami="SELECT * from liste_amis WHERE users_id='$my_id' AND id='$friend_id'";
              $result = mysqli_query($link, $sql_check_ami); 
              if (mysqli_num_rows($result) >=1) {
                  alert("il est déjà votre ami");
              }
                     else {
                    
                            $sql_insert="INSERT INTO liste_amis (users_id, id) VALUES (?,?)";
                            if ($stmt_insert = mysqli_prepare($link, $sql_insert)){
                        
                            //alert($friend_id);
                            mysqli_stmt_bind_param($stmt_insert, "ii", $my_id,$friend_id );
                            if(mysqli_stmt_execute($stmt_insert)){
                            
                                alert("you have added a friend"." ".$friend_pseudo);
                                mysqli_stmt_bind_param($stmt_insert, "ii", $friend_id,$my_id );
                                if(mysqli_stmt_execute($stmt_insert)){
                                    alert("ajout bilatéral avec succes");
                                }
                            } 
                                    else{
                                alert("Something went wrong. Please try again later.");
                                }

                            // Close statement
                            mysqli_stmt_close($stmt_insert);
                            }
                        }
                    
                   
                
         /*   }//prepare
                else {
                    alert("prepare");
                }        */
        //close select statement
        mysqli_stmt_close($stmt);
    

}

 ?>
