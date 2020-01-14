<?php

include "../../php/core.php";

$logged_user = Auth::getLoggedUser();
$to_user_id = trim(@$_GET["to_user_id"]);
$amicizia_dao = AmiciziaDAOFactory::getAmiciziaDAO();

if (!$logged_user)
	echo "Il client non ti ha bloccato?";
elseif (!ctype_digit($to_user_id))
	echo "Il client non ti ha bloccato?";
elseif (!$amicizia_dao->existsRequestFromTo($logged_user->getID(), $to_user_id))
	echo "La richiesta non esiste";
elseif ($amicizia_dao->removeFriendshipRequestFromTo($logged_user->getID(), $to_user_id))
	echo "ok";
else
	echo "Errore interno";