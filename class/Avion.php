<?php

class Avion{

	/**
	 *@var int $vp
	 *
	 */
	private $vp;

	/**
	 *@var float 
	 *
	*/
	private $masse_vide;


	private $mass_max; 

	/**
	 *@var float 
	 *
	*/
	private $bras_levier_avion;

	/**
	 *@var float 
	 *
	*/
	private $bras_levier_passagers;

	/**
	 *@var float 
	 *
	*/
	private $bras_levier_bagages;

	/**
	 *@var float 
	 *
	*/
	private $bras_levier_carburant;


	public function __construct($vp)
	{
		$this->vp = $vp;
	}

	public function getVP()
	{
		return $this->vp;
	}

	public function setVP($vp) {

		$this->vp = $vp;
	}

    /*
    * Fonction pour avoir le Facteur de Base
    *
    *
	*/
	public function getFB(){

		return round(60/$this->vp, 2);
	}

}