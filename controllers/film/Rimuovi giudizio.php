<?php

include "../../php/core.php";

$logged_user = Auth::getLoggedUser();
$film_id = @$_GET["film_id"];

$ff = new FormFeedbacker();

if (!$logged_user)
	$ff->message("Il client non ti ha bloccato?");
elseif (!ctype_digit($film_id))
	$ff->message("dammi un numero per id");
elseif (!$giudizio = GiudizioManager::get_from_utente_and_film($logged_user->getID(), $film_id))
	$ff->message("Il client non ti ha bloccato?");
elseif (GiudizioManager::delete($giudizio))
	header("Location: /giudizi.php");
else
	$ff->bug();

$ff->process();