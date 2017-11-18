<?php


class Branche{
	
	private $distance;

	private $cap;

	private $angle;

	private $avion;

	private $vent;

	public function __construct(Avion $avion, Vent $vent, $distance, $cap)
	{
		$this->distance = $distance;
		$this->cap 		= $cap;
		$this->avion 	= $avion;
		$this->vent 	= $vent;
		$this->setAngle();
	}

	public function getDistance()
	{
		return $this->distance;
	}

	public function getCap()
	{
		return $this->cap;
	}

	public function setDistance($value)
	{
		$this->distance = $value;
	}

	public function setCap($value)
	{
		$this->cap = $value;
	}

	public function getTempsSansVent()
	{
		return $this->avion->getFB() * $this->distance; 
	}

	/**
	 * Fonction pour calculer l dérive maximum
	 *
	 *
	*/
	public function getXmax()
	{
		return $this->vent->getForce() * $this->avion->getFB();
	}

	/**
	 * Fonction pour calculer la dérive
	 *
	*/
	public function getX()
	{
		return round($this->getXmax() * sin(deg2rad($this->getAngle())), 2);
	}

	/**
	 * Fonction pour calculer l'angle entre la direction du vent et le cap
	 *
	 *
	*/
	public function setAngle()
	{
		//$this->angle = abs($this->cap - $this->vent->getDirection())%90;
		if (abs($this->cap - $this->vent->getDirection()) > 90) {
			$this->angle = abs(($this->cap + 180) - $this->vent->getDirection())%90;
		} else {
			$this->angle = abs($this->cap - $this->vent->getDirection())%90;
		}

	}


	public function getAngle()
	{
		return $this->angle;
	}


	/**
	 * Fonction pour calculer le vent effectif
	 *
	 *
	*/
	public function getVentEffectif()
	{
		return round($this->vent->getForce() * cos(deg2rad($this->getAngle())), 2);
	}

	/**
	* Fonction pour calculer la vitesse sol
	*
	*
	*/
	public function getVS()
	{	//calcul des limit superieur et inferieur
		$limitSuperieur = ($this->cap + 90)%360;
		$limitInferieur = ($this->cap - 90) >= 0 ? ($this->cap-90) : (360 + ($this->cap - 90));

		if ( $this->cap < $limitSuperieur && $this->cap > $limitInferieur ) {
			
			return $this->avion->getVP() + $this->getVentEffectif();
		} else {
			
			return $this->avion->getVP() - $this->getVentEffectif();
		}
	}

	/**
	* Fonction pour déterminer le nouveau facteur de base
	*
	*
	*/
	public function getNewFB ()
	{
		return round(60/$this->getVS(), 2);
	}



	public function getTempsAvecVent()
	{
		return $this->getNewFB() * $this->distance;
	}


	public function getCapCorrected()
	{
		if ($this->getCap() < $this->vent->getDirection() || ($this->getCap()%180) > $this->vent->getDirection()){
			return $this->getCap() + $this->getX();
		} else {
			return $this->getCap() - $this->getX(); 
		}
	}

}