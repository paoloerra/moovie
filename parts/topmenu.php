<nav>
	<a href="/">M</a>
	<?php
	$_REQUEST["search_users_too"] = !is_null(Auth::getLoggedUser());
	include $_SERVER["DOCUMENT_ROOT"] . "/views/ricerca/Area di ricerca.php";
	?>
</nav>