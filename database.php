<?php 
// Credenziali di accesso al database
$servername = "localhost"; // Nome del server del database
$username = "root";   // Nome utente del database
$password = "root";      // Password del database
$dbname = "edu_sogno_db";   // Nome del database

// Creazione della connessione
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica della connessione
if (!$conn) {
    echo "Connessione fallita!";
}

// echo "Connessione al database riuscita!";
