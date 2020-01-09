<?php

/** @author Umberto Loria */
class Promemoria {

	/** @var int */
	private $utente;
	/** @var int */
	private $film;
	/** @var string */
	private $timestamp;

	public function __construct(int $utente, int $film, string $timestamp) {
		$this->utente = $utente;
		$this->film = $film;
		$this->timestamp = $timestamp;
	}

	public function getUtente(): int {
		return $this->utente;
	}

	public function getFilm(): int {
		return $this->film;
	}

	public function getTimestamp(): string {
		return $this->timestamp;
	}

}