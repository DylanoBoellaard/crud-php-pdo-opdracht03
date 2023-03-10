<?php
/**
 * We gaan een verbinding maken met de MySQL database
 */
require('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo 'Er is een verbinding gemaakt met de mysqldatabase';
    } else {
        echo 'Interne servererror, neem contact op met de databasebeheerder';
    }
} catch(PDOException $e) {
    echo $e->getMessage();
}

$post = var_dump($_POST);


// Schrijf de sql-insertquery
$sql = "INSERT INTO achtbaan (Id
                            ,NaamAchtbaan
                            ,NaamPretpark
                            ,Land
                            ,Topsnelheid
                            ,Hoogte
                            ,Datum
                            ,Cijfer)
        VALUES              (NULL
                            ,:achtbaan
                            ,:pretpark
                            ,:land
                            ,:topsnelheid
                            ,:hoogte
                            ,:datum
                            ,:cijfer);";

// Maak de sql-query gereed om te worden afgevuurd op de mysql-database
$statement = $pdo->prepare($sql);

// De bindValue method bind de $_POST waarde aan de placeholder
$statement->bindValue(':achtbaan', $_POST['achtbaan'], PDO::PARAM_STR);
$statement->bindValue(':pretpark', $_POST['pretpark'], PDO::PARAM_STR);
$statement->bindValue(':land', $_POST['land'], PDO::PARAM_STR);
$statement->bindValue(':topsnelheid', $_POST['topsnelheid'], PDO::PARAM_STR);
$statement->bindValue(':hoogte', $_POST['hoogte'], PDO::PARAM_STR);
$statement->bindValue(':datum', $_POST['datum'], PDO::PARAM_STR);
$statement->bindValue(':cijfer', $_POST['cijferR'], PDO::PARAM_STR);

// Voer de sql-query uit op de database
$statement->execute();

echo "Het opslaan is gelukt";
// Link door naar read.php voor een overzicht van de gegevens in tabel achtbaan
header('Refresh:4; url=read.php');