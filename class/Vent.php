<?php

class Vent{
	
	/*
	 * @var
	 *
	*/
	private $force;

	/*
	 * @var
	 * 
	*/
	private $direction;


	public function __construct($force, $direction)
	{
		$this->force 	 = $force;
		$this->direction = $direction;
	}

	public function getForce()
	{
		if ($vent < 0) {
			throw new Exception("Error Processing Request", 1);
		}
		
		return $this->force;
	}


	public function getDirection()
	{
		return $this->direction;
	}

	public function setDirection($direction)
	{
		if ($direction>360 || $direction < 0) {
			throw new Exception("Error SET DIRECTION WIND", 1);
		}

		$this->direction = $direction;
	}

	public function setForce($force)
	{
		$this->force = $force;
	}

}