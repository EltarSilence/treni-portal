<?php

class Treno {

	private $locomotive = [];
	private $carrozze = [];
	private $carri;

	function __construct($l, $crz) {
        $this->locomotive = $l;
        $this->carrozze = $crz;
       /*  $this->carri = $crr;*/
    }

    public function init_treno(){
    	foreach ($this->locomotive as $locomotiva){
        	$locomotiva->decodificaLocomotiva();
        }
        foreach ($this->carrozze as $carrozza){
        	$carrozza->decodificaCarrozza();
        }
    }

	public function getLocomotive(){
		return $this->locomotive;
	}

	public function setLocomotive($locomotive){
		$this->locomotive = $locomotive;
	}

	public function getCarrozze(){
		return $this->carrozze;
	}

	public function setCarrozze($carrozze){
		$this->carrozze = $carrozze;
	}

	public function getCarri(){
		return $this->carri;
	}

	public function setCarri($carri){
		$this->carri = $carri;
	}

    

}


?>