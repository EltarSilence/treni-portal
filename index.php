<?php
require_once 'assets/conn.php';
require_once 'assets/Treno.php';
require_once 'assets/Locomotiva.php';
require_once 'assets/Carrozza.php';
require_once 'assets/fnc.php';

if (isset($_GET['locomotiva'])){

	//INIZIALIZZAZIONE LOCOMOTIVE

	$lines = explode("\n", $_GET['locomotiva']);
	$locomotive = array();
	$mar_loco = array();
	$mar_crz = array();
	$carrozze = array();
	$ogg_loco = array();
	$ogg_carrozze = array();

	foreach ($lines as $marcatura) {
				//ciclo su ogni marcatura
		array_push($locomotive, $marcatura);
		array_push($mar_loco, $marcatura);
		array_push($ogg_loco, new Locomotiva($marcatura));

		$locomotive = [];
	}

	$lines = explode("\n", $_GET['carrozze']);
	foreach ($lines as $marcatura) {
				//ciclo su ogni marcatura
		array_push($carrozze, $marcatura);
		array_push($mar_crz, $marcatura);
		array_push($ogg_carrozze, new Carrozza($marcatura));

		$carrozze = [];
	}

	$t = new Treno (
		$ogg_loco,
		$ogg_carrozze
	);

	$t->init_treno();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="css/mdb.min.css" rel="stylesheet">
	<!-- Flags -->
	<link href="flag-icon-css-master/css/flag-icon.css" rel="stylesheet">
	<link href="assets/style.css" rel="stylesheet">
	<title>Treni</title>
</head>
<body>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark unique-color scrolling-navbar">
    <a class="navbar-brand" href="#"><strong>Train Configurator</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </nav>
	<div class="container-fluid">
		<div class="row" id="main">

			<div class="col-sm-12 col-md-3">
				<div class="card">
					<div class="card-body">
						
						<form name="marcLoc" class="form-group" action="index.php" method="get">
							<div class="form-group">
								<h5>Locomotive</h5>
								<div class="md-form mb-4">
									<i data-toggle="tooltip" title="Locomotive" data-placement="bottom" class="fas fa fa-train prefix"></i>
									<textarea id="loc" name="locomotiva" class="md-textarea form-control" ><?php
											if (isset($mar_loco)){
												echo showMarcature($mar_loco);
											}
										?></textarea>
									<label for="form">Inserisci le marcature delle locomotive</label>
								</div>
								<hr>
								<h5>Carrozze</h5>
								<div class="md-form mb-4">
									<i data-toggle="tooltip" title="Carrozze" data-placement="bottom" class="fas fa fa-users prefix"></i>
									<textarea id="crz" name="carrozze" class="md-textarea form-control"><?php
										if (isset($mar_crz)){
											echo showMarcature($mar_crz);
										}
									?></textarea>
									<label for="form">Inserisci le marcature delle carrozze</label>
								</div>
								<hr>
								<h5>Carri</h5>
								<div class="md-form mb-4">
									<i data-toggle="tooltip" title="Carri" data-placement="bottom" class="fas fa fa-dolly prefix"></i>
									<textarea id="crr" name="carri" class="md-textarea form-control"></textarea>
									<label for="form">Inserisci le marcature dei carri</label>
								</div>
								<hr>
							</div>
						
						<button id="go" type="submit" class="btn btn-rounded heavy-rain-gradient btn-block">Configura il treno<i class="fas fa-train pl-1"></i></button>	
						
						</form>
					</div>
				</div>
				
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong>Attenzione</strong> La pagina &egrave; in costruzione. Pertanto potrebbe contenere errori e/o bug.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<table id="tablePreview" class="table table-hover table-bordered text-center">
<!--Table head-->
				  
				    <?php
				    /*include 'assets/nazioni.php';*/
				    	if (isset($t)){
				    ?>
				    <thead>
				    <tr>
				      <th colspan="6">TRENO</th>
				    </tr>
				  </thead>
				  <tbody>
				   <!--  <tr class="main-sec">
				      <td>
				      	Rotabile
				      </td>
				      <td>
				      	Tipologia
				      </td>
				      <td>
				      	Nazione
				      </td>
				      <td>
				      	Particolarit&agrave;
				      </td>
				      <td>
				      	Gruppo rotabile
				      </td>
				      <td>
				      	Progressivo
				      </td>
				    </tr> -->
				    <?php
				    		foreach ($t->getLocomotive() as $loc){
				    			$prog = explode('-', $loc->getPr_aut())[0];
				    			$autocontr = explode('-', $loc->getPr_aut())[1];
					    		echo '<tr>';
					    		echo '<td class="align-middle"><span class="badge badge-primary">'.$loc->getMarcatura().'</span></td>';
					    		echo '<td>'.$loc->getTipo().'</td>';							
					    		echo '<td>'.$loc->getNaz().'</td>';
					    		echo '<td> Veicolo con '.$loc->getPart().'</td>';
					    		echo '<td>'.$loc->getGr_rot().'</td>';
					    		echo '<td>'.$prog.' (AC: '.$autocontr.')</td>';
					    		echo '</tr>';
				    		}
				    ?>
				    <!-- <tr class="main-sec">
				      <td>
				      	Rotabile
				      </td>
				      <td>
				      	Attitudine
				      </td>
				      <td>
				      	Nazione
				      </td>
				      <td>
				      	Tipo
				      </td>
				      <td>
				      	Max Velocit&agrave;
				      </td>
				      <td>
				      	Progressivo
				      </td>
				    </tr> -->
					<?php
							foreach ($t->getCarrozze() as $crz){
								//$prog = explode('-', $crz->getPr_aut())[0];
								//$autocontr = explode('-', $crz->getPr_aut())[1];
								echo '<tr>';
						    		echo '<td class="align-middle"><span class="badge badge-secondary">'.$crz->getMarcatura().'</span></td>';
						    		echo '<td>'.$crz->getAttitudine1().'<br>'.$crz->getAttitudine2().'</td>';						
						    		echo '<td>'.$crz->getNaz().'</td>';
						    		echo '<td><b>'.$crz->getTipo_gen().'</b><br>'.$crz->getTipo_specif().'</td>';
						    		echo '<td>'.$crz->getMax_vel().'</td>';
						    		echo '<td>'.$crz->getPr_aut().'</td>';
						    		echo '</tr>';
							}
				    	} //chiusura isset(treno)
				    ?>
				  </tbody>
				  <!--Table body-->
				</table>
				<?php
					d_var_dump($t);
				?>

			</div>
			<div class="col-sm-12 col-md-3"></div>
		</div>
	</div>

	
	

</body>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="assets/script.js"></script>
</html>