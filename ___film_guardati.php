<?php
include "parts/initial_page.php";
$logged_user = Auth::getLoggedUser();
if ($logged_user) {

	$films = [];
	$film_guardati = FilmGuardatiManager::get($logged_user->getID());
	foreach ($film_guardati as $film_guardato)
		if (!isset($films[$film_guardato->getFilm()]))
			$films[$film_guardato->getFilm()] = FilmManager::doRetrieveByID($film_guardato->getFilm());
	$_REQUEST["films"] = $films;
	$_REQUEST["film_guardati"] = $film_guardati;
	unset($logged_user);
	unset($film_guardato);
	unset($films);
	include "views/___film_guardati.php";

}