<?php

session_start();

include '../config.php';


if ( Account::isNotLogIn() )
{
  Routes::toLoginPage();
}

$DB = new DB();
$Types = new Types();
$Models = new Models();
$Catedre = new Catedre();
$Birouri = new Birouri();
$Depozite = new Depozite();
$Users = new Users();


if ( isset( $_POST['submitModel'] ) )
{
	if ( $_POST['nameModel'] !== '' )
	{
		$Models->insert( [
						  $_POST['nameModel'],
						  $_POST['yearModel'],
						  $_POST['priceModel'],
						  $_POST['countModel'],
						  $_POST['countModel'],
						  $_POST['serisModel'],
						  $_POST['invodModel'],
						  $_POST['dateModel'],
						  $_POST['masuraModel'],
						  $_POST['abouteModel'],
						  $_POST['typeModel']
						 ], $DB );
	}
}



if ( isset( $_POST['submitType']) )
{
	$Types->insert( [ $_POST['typeName'] ], $DB );
}

if ( isset( $_POST['catedreButt']) )
{
	switch ( $_POST['catedreType'] )
	{
		case 'Catedra':
			$Catedre->insert( [ $_POST['catedreName'] ], $DB );
			break;
		
		case 'Birour':
			$Birouri->insert( [ $_POST['catedreName'] ], $DB );
			break;
		
		case 'Depozit':
			$Depozite->insert( [ $_POST['catedreName'] ], $DB );
			break;

		default:
		// Cazul nu este inca analizat
			break;
	}


	$Types->insert( [ $_POST['typeName'] ], $DB );
}

if ( isset( $_POST['excelButt'] )) 
{
	if ( $_FILES["excel"]["tmp_name"] != '' )
	{
		$Excel = new Excel();


		$excelRows = $Excel->getDataFromUrl($_FILES["excel"]["tmp_name"]);
		for ( $i = 1; $i < count( $excelRows ); $i++ )
		{
			if ($excelRows[$i][0] !== '')
			{
				$Models->insert( [
								  $excelRows[$i][0],
								  $excelRows[$i][1],
								  $excelRows[$i][2],
								  $excelRows[$i][3],
								  $excelRows[$i][4],
								  $excelRows[$i][5],
								  $excelRows[$i][6],
								  $excelRows[$i][7],
								  $excelRows[$i][8],
								  $excelRows[$i][9],
								  $excelRows[$i][10]
								 ], $DB );
			}
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en" style=" height: 100%;">
<head>
	<meta charset="UTF-8">
	<title>Demersuri</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
	<script src="../js/myJs/api.js"></script>
	<script src="../js/myJs/admin.js"></script>

</head>

<body class="container-fluid" style=" height: 100%;padding-top: 100px;" >
	<div class="col-md-2" style=" height: 100%;margin: 0;">
		<div class="list-group">
			<a href="#" data-page='0' class="list-group-item page-list">Modelele</a>
			<a href="#" data-page='1' class="list-group-item page-list">Introduce Modele</a>
			<a href="#" data-page='2' class="list-group-item page-list">Introduce Catedre</a>
			<a href="#" data-page='3' class="list-group-item page-list">Utilizatori</a>
			<a href="#" data-page='4' class="list-group-item page-list">Printeaza bon</a>
		</div>
	</div>
	<div class="col-md-4 page" >
		<h3>Modelele in stoc</h3>
		<?= $Models->getModelsInStocAsTable( $DB ); ?>
	</div>

	<div class="page" style="display: none">
		<div class="col-md-3">
			<h3>Introduce un model</h3>
			<hr>
			<form action="admin.php" method="POST">
				<div class="form-group">
					<input name="nameModel" type="text" placeholder="Denumirea modelului" required class="form-control">
				</div>
				<div class="form-group">
					<input name="serisModel" type="text" placeholder="Seria facturii" required class="form-control">
				</div>
				<div class="form-group">
					<input name="invodModel" type="text" placeholder="Numarul facturii" required class="form-control">
				</div>
				<div class="form-group">
					<input name="countModel" type="text" placeholder="Cantitatea" required class="form-control">
				</div>
				<div class="form-group">
					<input name="yearModel" type="text" placeholder="Anul" class="form-control">
				</div>
				<div class="form-group">
					<input name="priceModel" type="text" placeholder="Pretul modelului" class="form-control">
				</div>
				<div class='form-group'>
					<select name="typeModel" id="" required class="form-control">
						<?= $Types->getAllTypesAsOptions( $DB );  ?>
					</select>
				</div>
				<div class='form-group'>
					<select name="masuraModel" required class="form-control">
						<option value="metri">metri</option>
						<option value="metru">metri</option>
						<option value="bucata">bucati</option>
						<option value="bucati">bucati</option>
					</select>
				</div>
				<div class="form-group">
					<input name="abouteModel" type="text" placeholder="Despre modelului" class="form-control">
				</div>
				<div class="form-group">
					<input name="dateModel" type="date" required class="form-control">
				</div>
				<input type="submit" name="submitModel" class="btn btn-primary" value="Submit">
			</form>
		</div>
		<div class="col-md-2">
		<h3>Introduce un tip</h3>
			<hr>
			<form action="admin.php" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<input name="typeName" type="text" placeholder="Tipul modelului nou" class="form-control">
				</div>
				<input type="submit" name="submitType" class="btn btn-primary" value="Submit">
			</form>
		</div>
		<div class="col-md-3">
			<h3>Export din excel</h3>
			<hr>
			<form action="admin.php" method="POST" enctype="multipart/form-data">
				<div class="input-group mb-3">
					<div class="custom-file">
						<label class="btn btn-default btn-file">
							Browse Excel File<input type="file" name="excel" style="display: none;" class="custom-file-input" id="inputGroupFile01"><input type="submit" style="margin-left: 3px" class="btn btn-primary" value="Send">
						</label>
					</div>
				</div>
				<img src="../img/Excel.png" class="rounded float-left" alt="...">
			</form>
		</div>
	</div>
	<div class="page col-md-6 " style="display: none">
		<div class="col-md-6">
			<h3>Introduce Catedra || Biru || Depozit</h3>
			<hr>
			<form action="admin.php" method="POST" >
				<div class="form-group">
					<select name="catedreType" class="form-control" value="1" id="catedrele">
						<option value="Catedra">Catedra</option>
						<option value="Birour">Birour</option>
						<option value="Depozit">Depozit</option>
					</select>
				</div>
				<div class="form-group">
					<input name="catedreName" type="text" placeholder="Anul" class="form-control">
				</div>
				<input type="submit" name="catedreButt" class="btn btn-primary" value="Submit">
			</form>
		</div>
	</div>
	<div class="col-md-6 page" style="display: none">
		<div class="col-md-3">
			<h3>Introducerea utilizatorului</h3>
			<hr>
		</div>
		<div class="col-md-3">
			<h3>Modificarea utilizatorului</h3>
			<hr>
			<select class="form-control selectpicker" data-live-search="true" data-size="5" multiple>
				<?= $Users->getAllUsersAsOptions( $DB );?>
			</select>
		</div>
		<div class="col-md-3">
			<h3>Stergerea utilizatorului</h3>
			<hr>
			<select class="form-control selectpicker" data-live-search="true" data-size="5" multiple>
				<?= $Users->getAllUsersAsOptions( $DB );?>
			</select>
		</div>
	</div>
	<div class="col-md-6 page" style="display: none">
		<h3>Printarea bonurilor</h3>
		<hr>
		<form method="post" id="multiple_select_form" style="margin: 5px">
			<select name="framework" id="framework" class="form-control selectpicker" data-live-search="true" data-size="5" multiple>
				<?= $Models->getAllModelsAsOptions( $DB );?>
			</select>
			<br />
			<br />
			<input type="hidden" name="hidden_framework" id="hidden_framework" />
			<input type="button" name="submit" id="makeTableButt" class="btn btn-info" value="Select" />
			<input type="button" name="clearButton" id="clearTableButt" class="btn btn-info" value="Clear" />
			<input type="button" name="printButton" id="printBonButt" class="btn btn-danger" value="Print" />
			<input type="text" class="form-control" placeholder="Unitati"  value="1" id="count" style="width: 100px; display: inline;">
			<select name="" class="form-control" id="catedrale">
				<?=$Catedre->getAllCatedreAsOptions( $DB ); ?>
			</select>
			<select name="" class="form-control" id="birouri">
				<?=$Birouri->getAllBirouriAsOptions( $DB );?>
			</select>
			<select name="" class="form-control" id="depozite">
				<?=$Depozite->getAllDepositeAsOptions( $DB );?>
			</select>
		</form>
		<table class="table">
			<thead>
				<th>materiale_id</th>
				<th>name</th>
				<th>anul</th>
				<th>price</th>
				<th>stoc</th>
				<th>amount</th>
				<th>series</th>
				<th>nr_invoice</th>
				<th>ziua</th>
				<th>masura</th>
				<th>tipuri_id</th>
				<th>count</th>
			</thead>
			<tbody id="selectedResult"></tbody>
		</table>
	</div>
</body>
</html>
<!-- 
<script>
	setInterval( function () {
		location.reload();
	}, 2000);
</script> -->