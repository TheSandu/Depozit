<?php
session_start();

include '../config.php';

if ( !Account::isLogIn() ) {
  Routes::toLoginPage();
}

$DB = new DB();

$Validator = new Validator();

$Models = new Models();
$Types = new Types();
$Deposite = new Deposite();
$Birouri = new Birouri();
$Catedre = new Catedre();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Demersuri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script  src="../js/Buffer.js"></script>
	<script src="../js/eventhandler.js"></script>
	<script src="../js/formConstructor.js"></script>
	<script src="../js/script.js" ></script>
</head>
<body class="container-fluid" >

<div class="row" style="margin-top: 15%;">
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profile</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-insert" role="tab" aria-controls="insert">Insert</a>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
		 <div>
		 	<p>
		 		<h2>
		 			Usename: <?=Account::getUserName();?>
		 		</h2>		
		 	</p>
		 	<p>
		 		<h3>
		 			Role: <?=Account::role();?>
		 		</h3>		
		 	</p>
		 </div>
      </div>
      
      <div class="tab-pane fade" id="list-insert" role="tabpanel" aria-labelledby="list-insert-list">
		<div class="row">
			<div class="col-md-3" id="demersConstructor">
				<form>
				  <div class="form-group">
				  	<div class="input-group">
						<select id="type" class="custom-select">
							<?php 
								echo $Types->getAllTypesAsOptions( $DB ); 
							?>
						</select>
						 <div class="input-group-append">
						 	<select id="count" class='custom-select'>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
						 	</select>
						 </div>
				  	</div>
				    <small id="emailHelp" class="form-text text-muted">Selectati tipul tehnicii</small>
				  </div>
				  <div class="form-group">
					<select id="model" class="custom-select">
						<?php 
							echo $Models->getAllModelsByTypeAsOptions( "1", $DB  ); 
						?>
					</select>
				    <small id="emailHelp" class="form-text text-muted">Selectati modelul</small>
				  </div>
				  <div class="form-group">
					<select id='catedre' class="custom-select">
						<?php 
							echo $Catedre->getAllCatedreAsOptions( $DB );
						 ?>
					</select>
				    <small id="emailHelp" class="form-text text-muted">Selectati catedra</small>
				  </div>
				  <div class="form-group">
					<select id='deposite' class="custom-select">
						<?php 
							echo $Deposite->getAllDepositeAsOptions( $DB ); 
						?>
					</select>
				    <small id="emailHelp" class="form-text text-muted">Selectati deposite</small>
				  </div>
				  <div class="form-group">
					<select id='birouri' class="custom-select">
						<?php 
							echo $Birouri->getAllBirouriAsOptions( $DB ); 
						?>
					</select>
				    <small id="emailHelp" class="form-text text-muted">Selectati biroul</small>
				  </div>
				  <input type="button" class="btn btn-primary" id="appendButton" value="Adauga">
				  <input type="button" class="btn btn-primary" id="openPopUp" value="Afisheaza forma">
				</form>
			</div>
			<div class="col-md-6">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Denumirea Marcii</th>
							<th scope="col">Elibberat</th>
							<th scope="col">Stoc</th>
							<th scope="col">Ramas</th>
							<th scope="col">Pret Final</th>
						</tr>
						<tbody id='forma'>
						</tbody>
					</thead>
				</table>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<!-- 
<script>
	setInterval( function () {
		location.reload();
	}, 2000);
</script> -->