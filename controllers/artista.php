<?php

include "../php/core.php";

header("Content-Type: application/json");

if (!isset($_GET["id"]))
	$result["status"] = "ID is required";
elseif (!ctype_digit($_GET["id"]))
	$result["status"] = "ID must be an INT";
elseif (!$artista = ArtistaManager::doRetrieveByID($_GET["id"]))
	$result["status"] = "Artist is not present";
else {
	$result["id"] = $artista->getID();
	$result["nome"] = $artista->getNome();
	$result["nascita"] = $artista->getNascita();
	$result["descrizione"] = $artista->getDescrizione();
}
echo json_encode($result);
