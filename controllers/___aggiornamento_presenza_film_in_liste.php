<?php

include "../php/core.php";

$film_id = @$_GET["film_id"];
if ($film_id === null)
	die("Errore interno");

$logged_user = Auth::getLoggedUser();
if ($logged_user === null)
	die("Accedi per usare questa funzionalità");

$liste = ListaManager::getAllOf($logged_user->getID());
$liste_contenenti = [];

foreach ($liste as $lista)
	if (ListaManager::contains($lista->getID(), $film_id))
		$liste_contenenti[] = $lista->getID();

unset($_GET["film_id"]);
$_REQUEST["liste"] = $liste;
$_REQUEST["liste_contenenti"] = $liste_contenenti;
$_REQUEST["film_id"] = $film_id;

include "../views/Form di aggiornamento presenza film in liste.php";