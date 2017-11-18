<?php


class BrancheFactory{
	
	/**
	 * Fonction qui permettra d'instacier des branches
	 *
	 *
	*/
	public function createBranche($vp, $force, $direction, $distance, $cap)
	{	
		$avion 	= new Avion($vp);
		$vent 	= new Vent($force, $direction);
		
		return new Branche($avion, $vent, $distance, $cap);
	}

}