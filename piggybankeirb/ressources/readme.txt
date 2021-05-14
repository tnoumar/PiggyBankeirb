la procédure pour l'installation:
***********************************************************************************************************
        - Vous accéder à localhost/*/install.php:
                si le script s'execute très bien vous aurez des notifications de succès au fur et à mesure, 
                vous aurez votre BDD avec toutes les tables nécessaires.

     WARNING:    N'executez pas install.php deux fois, vous aurez une erreur dûe aux clés primaires...

     REMARQUE:   - le fichier config.php contient la poignée de connexion à la BDD 'crosscoders' .

***********************************************************************************************************

Contenu de la BDD:
    crosscoders:
            -USERS :
                *toto
                *timtim
                *tester votre id est 3
            -TRANSACTIONS: 3 ouvertes et une fermée
                * 1 -> 2 ouverte
                * 1 -> 2 ouverte
                * 1 -> 2 ouverte
                * 2 -> 1 fermée
            -liste_amis:
                * 1 -- 2
                * 2 -- 1

POUR PLUS D'INFO, REFEREZ VOUS A PHPMYADMIN, UNE FOIS LA BDD CRÉÉE.

***********************************************************************************************************

Comment ça marche:
        Premièrement, allez sur localhost/*/login.php pour vous connecter avec tester@gmail.com | mdp 

        Vous allez être redirigés vers Piggybankeirb.php et c'est là où tout se passe.

        Si certaines fonctionnalités ne vous semblent pas intuitives, je vous prie de consulter
         l'onglet ISSUES sur notre répo github "crosscoders".

***********************************************************************************************************
MERCI et bon Piggin'
