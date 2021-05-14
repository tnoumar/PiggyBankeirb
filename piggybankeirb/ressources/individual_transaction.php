<?php 
require_once "config.php";
// verifier si username est ami de l'utilisateur
// param user_source user_dest amount creation_date status closing_date closing_msg

function add_transaction($user_dest_pseudo,$user_source_id,$opening_msg,$amount , $status, $closing_msg){
    global $link;
    //this part checks the existence of the user in your list d'amis
    $sql_search_existence="SELECT user_id FROM USERS WHERE pseudo = ?";
    if($stmt = mysqli_prepare($link, $sql_search_existence)){
     
        mysqli_stmt_bind_param($stmt,"s",$user_dest_pseudo);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
              
                mysqli_stmt_bind_result($stmt,$user_dest_id);
                mysqli_stmt_fetch($stmt);

           
                alert("User_dest found successfuly his id and pseudo are ".$user_dest_id." ".$user_dest_pseudo);
                //the user exists and we have his id 
                //now let's check if he's our friend 
                $sql_search_friendship="SELECT users_id,id FROM liste_amis WHERE (users_id,id)= (?,?)";
                if($stmt = mysqli_prepare($link, $sql_search_friendship)){
                 
                    mysqli_stmt_bind_param($stmt,"ii",$user_source_id, $user_dest_id );
                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_store_result($stmt);
                        if (mysqli_stmt_num_rows($stmt)>=1) {
                            //he's our friend
                            // greater or equals 1 because of redundancy
                            alert($user_dest_pseudo." is your friend"."his id and pseudo are ".$user_dest_id." ".$user_dest_pseudo);
                          
                            alert($user_source_id."n".$user_dest_id."n"."n".$opening_msg."n".$amount."n". $status."n".  $closing_msg);
                         
                            //defining some variables for input 

                            $rawdateop = htmlentities($_POST['dateop']); //opening date
                            $date = date('Y-m-d', strtotime($rawdateop));
                            $rawdatecl = htmlentities($_POST['datecl']); //closing date
                            $datecl = date('Y-m-d', strtotime($rawdatecl));
                            $sql_insert = "INSERT INTO TRANSACTIONS (sender_id, receiver_id, msg_1, amount, stat , msg_2) VALUES (?,?,?,?,?,?)";
                            if($stmt = mysqli_prepare($link, $sql_insert)){
                                //INSERTING INTO TABLE
                                mysqli_stmt_bind_param($stmt,"iisiis", $user_source_id,$user_dest_id,$opening_msg,$amount, $status,$closing_msg);
                                
                                  
                              
                                if(mysqli_stmt_execute($stmt)){
                                     alert("Transaction succeeded");                  
                                }
                                     
                                else {
                                        alert("the exec if");
                                    }
                                
                            
                                
                                // this to solve the date problem 
                                
                                
                                
                                
                               
                               
                                $query1 = "UPDATE TRANSACTIONS SET date_1 = '$date' , date_2 = '$datecl' WHERE amount = '$amount' AND msg_1 = '$opening_msg' AND sender_id = '$user_source_id' AND receiver_id = '$user_dest_id'";
                                if ($stmt=mysqli_prepare($link,$query1)) {
                                    if (mysqli_stmt_execute($stmt)) {
                                        alert("dates also inserted");
                                    } 
                                }
                               
                               
                                
                                
                               else {
                                   alert("Something went wrong WHEN INSERTING. Please try again later.");
                                   alert($date."n".$datecl."n".mysqli_query($link,$query1));
                                }

                                
                            }//seventh
                            else {
                                alert("seventh if ");
                            }
                        }//sixth
                            else {
                                alert($user_dest_pseudo." IS NOT YOUR AMIGOOO");
                            }
                    }//fifth
                    else {
                        alert("fourth if ");
                    }
                }//fourth
                else {
                    alert("fourth if ");
                }
            }//third if
            else {
                alert($user_dest_pseudo." doesnt exist");
            }
        }//second if 
    }//first if 
}//function end
?>
