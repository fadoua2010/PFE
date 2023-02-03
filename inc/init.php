<?php

// Connection à la bdd en utilisant PDO
$pdo = new PDO('mysql:host=localhost; dbname=thym', 'root', '', array(// crée une nouvelle instance de l'objet PDO (PHP Data Object) qui est utilisé pour se connecter à une base de données MySQL. Elle prend en paramètres l'URL de l'hôte de la base de données (localhost), le nom de la base de données (thym), le nom d'utilisateur (root) et le mot de passe ('').array définit un tableau d'options pour la connexion à la base de données.
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,//option PDO::ATTR_ERRMODE est utilisée pour définir le mode d'erreur pour les erreurs de requêtes SQL à PDO::ERRMODE_WARNING, cela signifie que les erreurs de requêtes SQL généreront des avertissements.
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'//est utilisée pour exécuter une commande SQL lorsque la connexion est établie, ici la commande "SET NAMES utf8" est utilisée pour définir le jeu de caractères de la connexion à UTF-8, ce qui permet de travailler avec des caractères spéciaux dans les données de la base de données.
));

//lancement session
session_start(); // Crée un fichier de session sur le server dans lequel on stockera des données : celle du membre ou de son panier. Si la session existe déjà, on y accède directement à l'aide de l'identifiant reçu dans un cookie depuis le navigateur de l'internaute


//definition d'une constante pour définir la racine du site =>  ça sert à modifier le chemin vers le fichier source sur tous les liens en même temps (avec une ligne de cde) ==> utile pour la mise en ligne du site par ex car le dépot distant n'aura plus le meme chemain que notre stockage local
define("RACINE_SITE", "/PFE/");// ici on indique le dossier dans lequel se trouve le site à partir de "localhost". S'il n'est dans aucun dossier, on met un "/" seul. Permet de créer des chemins absolus à partir de "localhost". 

// variable qu'on utilisera pour afficher sur la page des messages de retour d'erreur pour la saisie du formulaire par ex
$contenu = '';//Initialisation d'une variable pour afficher du contenu HTML

//inclusion du fichier functions.php
require_once 'functions.php';
