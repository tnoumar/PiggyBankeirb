<!doctype html>
<html>
<?php
session_start();
//affiche les erreurs php sur le navigateur
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//ce bout de code sert à empecher les formulaires d'être envoyés lors du REFRESH_PAGE
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['postdata'] = $_POST;
    unset($_POST);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
} */ //en commentaire dû à un souci de log out

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
   //destroys the session after one hour
    session_unset();    
    session_destroy();
    logmeout();
    alert("You have been logged out due to one hour of inactivity");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time
require_once "config.php";
require_once "addfriend.php";
require_once "showfriends.php";
require_once "individual_transaction.php";
require_once "logout.php";
require_once "modify_transaction.php";
require_once "mybalance.php"
?>   
 <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="180x180" href="./images/ico/favicon_io/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./images/ico/favicon_io/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./images/ico/favicon_io/favicon-16x16.png">
        <link rel="manifest" href="./images/ico/favicon_io/site.webmanifest">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="fonts/icomoon/style.css">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">

        <link rel="stylesheet" href="css/jquery.fancybox.min.css">

        <link rel="stylesheet" href="css/bootstrap-datepicker.css">

        <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

        <link rel="stylesheet" href="css/aos.css">

        <link rel="stylesheet" href="css/style.css">

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


        <title>Piggy Bankeirb</title>
    </head>
    <body>
    <!--  this piece of code prints the id and username-->
      <?php
       
            alert("votre username est:". $_SESSION["username"]. ".....". "votre id est:".$_SESSION["id"]); //afficher mon id et mon pseudo
      //      alert("clique sur CANCEL pour rafraichir la page ;) ". "    ". "Bon Pigging");
            $friend_err=$amount_error=""; //gestion d'erreur de saisie ???

     
    ?>
    <div class="container-fuid p-3 mb-2 bg-light text-dark">
        <div class="container-fuid" >
            <div class="row">
              <div class="col-xl">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
            <input type="submit" class="btn btn-primary" name="logout" value="Log Out" /></form>
                <img src="../../piggybankeirb-logo.png" class="img-fluid" alt="Responsive image">
              </div>
          </div>
        </div>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active " href="#p1" data-toggle="tab" >Dashboard </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#p2" data-toggle="tab">Transaction Modifier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#p3" data-toggle="tab">My Friends</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#p4"data-toggle="tab">My Notifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#p5"data-toggle="tab">New friend</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#p6"data-toggle="tab">My Balance</a>
            </li>

        </ul>
    </div>
<?php 
//ici je définis des fonctions locales
function destroyVAR(){
    unset($_POST['friend_pseu_add'],$_POST['friend_pseu_trans'],$_POST['amount']);
                        }






             //ici se fera la gestion des boutons (add, confirm, cancel), and tabs transaction history, My friends, my notifications )

    

     
            switch (1) {
                case isset($_POST['conf_trans']):
                   
                        //la condition de non nullité des variables de la fonction suivante
                        add_transaction($_POST['friend_pseu_trans'],$_SESSION['id'],$_POST['open_msg'],$_POST['amount'],$_POST['status'],$_POST['close_msg']);
                   
                break;
                case isset($_POST['cancel']):
                    destroyVAR();
                    break;
                case isset($_POST['logout']):
                    logmeout();
                    destroyVAR();
                break;
                case isset($_POST['add_btn_last']):
                    if (isset($_POST['friend_pseu_add'])) {
                        add($_POST['friend_pseu_add'],$_SESSION['id']);                    }
                  else {
                      alert("Try again");
                  }
                break;
                case isset($_POST['MOD']):
                    if (isset($_POST['nv_montant']) and isset($_POST['msg_ex']) and isset($_POST['tr_id'])) {
                        modify($_POST['tr_id'],$_POST['nv_montant'],$_POST['msg_ex']);
                    }
                break;
            }
            
        
 ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="tab-content"> <!-- Menu déroulant pour créer la nouvelle transaction -->
            <div class="tab-pane active" id="p1">
                <div class="container-fuid p-3 mb-2 bg-light text-dark">
                    <button class="btn btn-primary btn-lg btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        New Transaction
                    </button>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <div class="container-fuid p-3 mb-2 bg-light text-dark">
                            
                                <div class="row">
                                    <div class="col-xl-6"><h1>Receiver friend</h1></div>
                                    <div class="col-xl-6"><h1>Transaction Amount</h1></div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-5">

                                        <input name="friend_pseu_trans" class="form-control mb-4"  type="text"
                                        placeholder="Search your friend by his name"/>
                                    </div>
                                    
                                    <div class="col-xl-6">
                                        <input name="amount" class="form-control mb-4"  type="number"
                                        placeholder="Amount">
                                    </div>
                                </div>
                                    
                            </div>
                            <div class="container-fuid container-fuid p-3 mb-2 bg-light text-dark">
                           <!-- <form action="<?php // echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> -->

                                <h1><b>Transaction informations</b></h1>
                                <hr>
                                <div class="row">
                                    <div class="col-6">

                                        <div class="list-group">
                                            <H2>
                                              Friends selected
                                              </H2>
                                          <a  class="list-group-item list-group-item-action">
                                            <?php 
                                           
                                           
                                               


                                                if (isset($_POST["friend_pseu_trans"])) {
                                                   echo("you wrote ".$_POST['friend_pseu_trans']);
                                                }
                                                else{ echo "You have no friends for the moment" ;}
                                           
                                            ?>
                                            </a>

                                          </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="list-group">
                                          
                                            <h2>Date de création</h2>
                                            <input class="form-control mb-4"name="dateop" type="date"
                                            placeholder="">
                                            <h2>Date de fermeture</h2>
                                            <input class="form-control mb-4"name="datecl" type="date"
                                            placeholder="">
                                          </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="list-group">
                                          <h1>Messages</h1>
                                            <input class="form-control mb-4"name="open_msg" type="text"
                                            placeholder="Message explicatif">
                                            <input class="form-control mb-4"name="close_msg" type="text"
                                            placeholder="Message de fermeture">
                                            
                                          </div>

                                    </div>
                               
                                </div>
                            <!--    </form> -->
                                <div class="col-xl-6">
                                <h1>Status</h1>
                                        <input name="status" class="form-control mb-4" type="number"
                                        placeholder="Ouvert=0, annulé=1, remboursé=2">
                                    </div>
                                <div class="w-100"></div>
                                <div class="row">
                                    <div class="col-xl-10"></div>
                                    <div class="col-xl-2">
                     <!--   <form action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post"> -->
                         <input name="cancel" type="submit" value="Cancel" class="btn btn-primary"/> 

                           <input type="submit" class="btn btn-primary" name="conf_trans" value="Confirm " />
                          <!-- </form> -->
                                    </div>

                                </div>




                            </div>



                        </div>
                    </div>


                </div>
            </div>

            <div class="tab-pane" id="p2">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="container-fuid p-3 mb-2 bg-light text-dark">
            <div class="row">
                    <div class="col-xl-3">
                    <input name="tr_id" class="form-control mb-4" type="number"
                                        placeholder="id"/>
                                
                    </div>
                    <div class="col-xl-3">
                    <input name="nv_montant" class="form-control mb-4" type="text"
                                        placeholder="montant"/>
                    </div>
                    <div class="col-xl-3">
                    <input name="msg_ex" class="form-control mb-4" type="text"
                                        placeholder="message"/>
                    </div>
                    <div class="col-xl-3">
                    <input type="submit" class="btn btn-primary" name="MOD" value="Modify" />

                    </div>
            </div>

            </div>
            </form>
            </div>

            <div class="tab-pane" id="p3">
                <div class="container-fuid p-3 mb-2 bg-light text-dark">
                    <div class="row">
                    <div class="col-xl-3">
                        <h1>Pseudo</h1>
                        
                        <?php showfriendspseudo($_SESSION['id']);
                        ?>                      
                    </div>
                    <div class="col-xl-3">
                        <h1>Prénom</h1>
                        <?php showfriendprenom($_SESSION['id']);
                        ?>                      
                    </div>
                    <div class="col-xl-3">
                        <h1>Nom</h1>
                        <?php showfriendnom($_SESSION['id']);
                        ?>                      
                    </div>
                    <div class="col-xl-3">
                        <h1>Solde</h1>
                        <?php solde($_SESSION['id']);
                        ?>
                    </div>
                    </div>
                </div>

        
            
            
            
            
            </div>



            <div class="tab-pane" id="p4">Contenu de Notifications</div>
            <div class="tab-pane" id="p5">
            <div class="col-xl-6"><h1>Add Friend</h1></div>  
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="row">
                                    <div class="col-xl-5">

                                        <input name="friend_pseu_add" class="form-control mb-4" type="text"
                                        placeholder="Search your friend by his name"/>
                                    </div>
                                    
                                    <div class="col-xl-1">
                                    <input type="submit" class="btn btn-primary" name="add_btn_last" value="Add friend" />
                                    
                                    </div>
                                 </div>
                                    </form>
            </div>
            
            
            <div class="tab-pane" id="p6">
            <h1>My Balance is <?php mybalance($_SESSION['id']);
                        ?></h1>
            </div>

            
      
    
            
                
        </div> <!-- div du menu déroulant-->
        </form>
     </body>


</html>
