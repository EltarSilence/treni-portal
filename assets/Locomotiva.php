<?php
	
	require 'fx.php';

	class Locomotiva {
		
		private $marcatura;
		private $tipo;
		private $naz;
		private $part;
		private $gr_rot;
		private $pr_aut;

		function __construct($marcatura) {
			$this->marcatura = $marcatura;
		}

		public function decodificaLocomotiva(){
			require 'conn.php';

			/*
				LOCO
				[0] => String(2) "95"
				[1] => String(2) "85"
				[2] => Array(2) {
					[0] => String(1) "2"
					[1] => String(3) "464"
				}
				[3] => String(5) "160-5"

			*/
			$loco = explode(" ", $this->marcatura);
			$loco[2] = array(substr($loco[2], 0, 1), substr($loco[2], -3));

			$sql = "SELECT * FROM tipoveicolo";
			$result = $conn->query($sql);
			while ($row = $result->fetch_assoc()){
				if ($row['n'] == $loco[0]){
					$this->tipo = $row['descr'];
					break;
				}
				else {
					$this->tipo = "Non valido";
				}
			}

			$sql = "SELECT * FROM cod_paes";
			$result = $conn->query($sql);
			while ($row = $result->fetch_assoc()){
				if ($row['n'] == $loco[1]){
					$this->naz = $row['paese'].' ('.$row['cod_alfabetico'].')';
					break;
				}
				else {
					$this->naz = "Non valido";
				}
			}

			$sql = "SELECT * FROM particolarita";
			$result = $conn->query($sql);
			while ($row = $result->fetch_assoc()){
				if ($row['n'] == $loco[2][0]){
					$this->part = $row['descr'];
					break;
				}
				else {
					$this->part = "Non valido";
				}
			}

			$this->gr_rot = $loco[2][1];
			$this->pr_aut = $loco[3];

		}

		public function getMarcatura(){
			return $this->marcatura;
		}

		public function setMarcatura($marcatura){
			$this->marcatura = $marcatura;
		}

		public function getTipo(){
			return $this->tipo;
		}

		public function setTipo($tipo){
			$this->tipo = $tipo;
		}

		public function getNaz(){
			return $this->naz;
		}

		public function setNaz($naz){
			$this->naz = $naz;
		}

		public function getPart(){
			return $this->part;
		}

		public function setPart($part){
			$this->part = $part;
		}

		public function getGr_rot(){
			return $this->gr_rot;
		}

		public function setGr_rot($gr_rot){
			$this->gr_rot = $gr_rot;
		}

		public function getPr_aut(){
			return $this->pr_aut;
		}

		public function setPr_aut($pr_aut){
			$this->pr_aut = $pr_aut;
		}

	}

?>