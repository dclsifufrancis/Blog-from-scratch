

<?php
// création variable $contenu_json pour Récupérer le contenu du fichier db.json 
    $contenu_json = file_get_contents('db.json');
    
// création variable $db_Info décoder le contenu sous forme de tableau (true)
    $db_Info = json_decode($contenu_json, true);

    //connexion à la bdd
    try{
        $pdo = new PDO('mysql:host=' . $db_Info['hostname'] . ';dbname=' . $db_Info['db_name'], $db_Info['db_user'], $db_Info['db_password']);

        $pdo->exec("SET NAMES utf8");
        
    }
    catch (Exception $e) {
        die ('Erreur : ' . $e->getMessage());
    }
        
