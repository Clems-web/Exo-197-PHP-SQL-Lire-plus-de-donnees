<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="index.css">
    <title>Exo complet lecture SQL.</title>
</head>
<body>
<?php

try {
    $server = "localhost";
    $db = "exo_197";
    $user = "root";
    $password = "";

    $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


//exo 1
    $stmt = $pdo->prepare("SELECT * FROM exo_197.clients");
    $state = $stmt->execute();
    if ($state) {
        foreach ($stmt->fetchAll() as $user) {
            echo "<p>Utilisateur : ". $user['lastName']." ".$user['firstName']."</p>.<br>";
        }
    }

//exo 2
    $stmt2 = $pdo->prepare("SELECT * FROM exo_197.showtypes");
    $state2 = $stmt2->execute();
    if ($state2) {
        echo "Type de spectable :";
        foreach ($stmt2->fetchAll() as $user) {
            echo "<p>".$user['type']."</p>.<br>";
        }
    }

//exo 3
    $stmt3 = $pdo->prepare("SELECT * FROM exo_197.clients ORDER BY id ASC LIMIT 20");
    $state3 = $stmt3->execute();
    if ($state3) {
        echo "20 premier clients :";
        foreach ($stmt3->fetchAll() as $user) {
            echo "<p>".$user['firstName']." ".$user['lastName']."</p><br>";
        }
    }

//exo 4
    $stmt4 = $pdo->prepare("SELECT * FROM exo_197.clients WHERE card = 1");
    $state4 = $stmt4->execute();
    if ($state4) {
        echo "Possédant une carte de fidélité :";
        foreach ($stmt4->fetchAll() as $user) {
            echo "<p>".$user['firstName']." ".$user['lastName']."</p><br>";
        }
    }

//exo 5
    $stmt5 = $pdo->prepare("SELECT * FROM exo_197.clients WHERE lastName LIKE 'M%' ORDER BY lastName ASC");
    $state5 = $stmt5->execute();
    if ($state5) {
        echo "Nom commencant par la lettre M :"."<br>";
        foreach ($stmt5->fetchAll() as $user) {
            echo "Prenom : ".$user['firstName']."<br>"."Nom : ".$user['lastName']."<br>";
        }
    }

//exo 6
    $stmt6 = $pdo->prepare("SELECT * FROM exo_197.shows");
    $state6 = $stmt6->execute();
    if ($state6) {
        echo "Les spectacles : "."<br>";
        foreach ($stmt6->fetchAll() as $user) {
            echo "<p>".$user['title']." par ".$user['performer']." le ".$user['date']." à ".$user['startTime']."</p><br>";
        }
    }

// exo 7

    $stmt6 = $pdo->prepare("SELECT * FROM exo_197.clients");
    $state6 = $stmt6->execute();
    if ($state6) {
        echo "Les clients : "."<br>";
        foreach ($stmt6->fetchAll() as $user) {
            echo "Nom : ".$user['firstName']."<br>"."Prénom : ".$user['lastName']."<br>"."Date de naissance :".$user['birthDate']."<br>";
            if (!$user['card']) {
                echo "Carte de fidélité : Non"."<br>";
            }
            else {
                echo "Carte de fidélité : Oui"."<br>"." Numéro de carte : ".$user['cardNumber']."<br>";
            }
            echo "<br>";
        }
    }





}



catch (PDOException $exception) {
    echo $exception->getMessage();
}















?>
</body>
</html>
