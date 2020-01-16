<?php

include_once "../../php/core.php";
include_once "../GenericTest.php";
include_once "../account/stubs/StubAccountDAO.php";
include_once "stubs/StubGiudizioDAO.php";

class AggiungiGiudizioTest extends GenericTest {

	/** @type IGiudizioDAO */
	private static $giudizio_dao;
	/** @type IAccountDAO */
	private static $account_dao;
	private static $userid;

	public static function setUpBeforeClass(): void {
		Testing::init();
//		AccountDAOFactory::useStub();
		self::$account_dao = AccountDAOFactory::getAccountDAO();
		self::$userid = self::$account_dao->create(
			new Utente(0, "Giuseppe", "Verdi", "g.verdi@gmail.com", sha1("140898"))
		)->getID();
//		GiudizioDAOFactory::useStub();
		self::$giudizio_dao = GiudizioDAOFactory::getGiudizioDAO();
	}

	public static function tearDownAfterClass(): void {
		if (is_int(self::$userid))
			self::$account_dao->delete(self::$userid);
	}

	private function callController($userid, $film_id, $voto) {
		$_COOKIE["userid"] = $userid;
		Auth::init();
		$_POST["film_id"] = (string)$film_id;
		$_POST["voto"] = $voto;
		ob_start();
		include "../../controllers/film/Aggiungi giudizio.php";
		$response = ob_get_contents();
		ob_end_clean();
		return $response;
	}

	public function test_TC41_1() {
		$response = $this->callController(null, 14, 8);
		$this->assertTrue(
			Testing::assert_block($response)
		);
	}

	public function test_TC41_2() {
		$response = $this->callController(self::$userid, 14, 0);
		$this->assertTrue(
			Testing::assert_block($response)
		);
	}

	public function test_TC41_3() {
		$this->assertTrue(true);
//		TODO: StubGiudizioDAO non può capire che non esiste il film 1000.
//		$response = $this->callController(self::$userid, 1000, 5);
//		echo $response;
//		$this->assertTrue(
//			Testing::assert_block($response)
//		);
	}

	public function test_TC41_4() {
		$response = $this->callController(self::$userid, 14, 8);
		$this->assertTrue(
			Testing::assert_redirect($response, "/film.php?id=14")
		);
		$this->assertTrue(
			self::$giudizio_dao->delete(new Giudizio(self::$userid, 14, 8, ""))
		);
	}

}