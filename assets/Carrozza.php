<?php
	
	require_once 'fx.php';

	class Carrozza {

		private $marcatura;
		private $attitudine1;
		private $attitudine2;
		private $naz;
		private $tipo_specif;
		private $tipo_gen;
		private $max_vel;
		private $cond_elettr;
		private $pr_aut;

		function __construct($marcatura) {
			$this->marcatura = $marcatura;
		}

		public function decodificaCarrozza(){
			require 'conn.php';

			/*
				CARROZZA
				61 87 2072021-1
				attitudine => 61
				naz => 87
				tipo => 20
				max_vel => 7
				cond_elettr => 2
				pr_aut => 021-1
			*/

			$crz = array();
			$crz = explode(' ', $this->marcatura);
			$N_att = $crz[0];
			$N_naz = $crz[1];
			$N_tipo_specif = substr($crz[2], 0, 1);
			$N_tipo_gen = substr($crz[2], 1, 1);
			$N_max_vel = substr($crz[2], 2, 1);
			$N_cond_elettr = substr($crz[2], 3, 1);
			$N_pr_aut = substr($crz[2], 4);

			$sql = "SELECT * FROM crz_attitudine";
			$result = $conn->query($sql);

			while ($row = $result->fetch_assoc()){
				if ($row['n'] == $N_att){
					$this->attitudine1 = $row['descr1'];
					$this->attitudine2 = $row['descr2'];
					break;
				}
				else {
					$this->attitudine1 = "Non valido"; 
					$this->attitudine1 = "Non valido";
				}
			}

			$sql = "SELECT * FROM cod_paes";
			$result = $conn->query($sql);
			while ($row = $result->fetch_assoc()){
				if ($row['n'] == $N_naz){
					$this->naz = $row['paese'].' ('.$row['cod_alfabetico'].')';
					break;
				}
				else {
					$this->naz = "Non valido"; 
				}
			}

			$sql = "SELECT * FROM crz_tipo";
			$result = $conn->query($sql);
			while ($row = $result->fetch_assoc()){
				if ($row['n'] == $N_tipo_specif.$N_tipo_gen){
					$this->tipo_specif = $row['descr1'];
					$this->tipo_gen = $row['descr2'];
					break;
				}
				else {
					$this->tipo_specif = "Non valido";
					$this->tipo_gen = "Non valido"; 
				}
			}


		}

		public function getMarcatura(){
			return $this->marcatura;
		}

		public function setMarcatura($marcatura){
			$this->marcatura = $marcatura;
		}

		public function getAttitudine1(){
			return $this->attitudine1;
		}

		public function setAttitudine1($attitudine1){
			$this->attitudine1 = $attitudine1;
		}

		public function getAttitudine2(){
			return $this->attitudine2;
		}

		public function setAttitudine2($attitudine2){
			$this->attitudine2 = $attitudine2;
		}

		public function getNaz(){
			return $this->naz;
		}

		public function setNaz($naz){
			$this->naz = $naz;
		}

		public function getTipo_specif(){
			return $this->tipo_specif;
		}

		public function setTipo_specif($tipo_specif){
			$this->tipo_specif = $tipo_specif;
		}

		public function getTipo_gen(){
			return $this->tipo_gen;
		}

		public function setTipo_gen($tipo_gen){
			$this->tipo_gen = $tipo_gen;
		}

		public function getMax_vel(){
			return $this->max_vel;
		}

		public function setMax_vel($max_vel){
			$this->max_vel = $max_vel;
		}

		public function getCond_elettr(){
			return $this->cond_elettr;
		}

		public function setCond_elettr($cond_elettr){
			$this->cond_elettr = $cond_elettr;
		}

		public function getPr_aut(){
			return $this->pr_aut;
		}

		public function setPr_aut($pr_aut){
			$this->pr_aut = $pr_aut;
		}


	}

?>