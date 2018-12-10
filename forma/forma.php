<?php $Response = json_decode($_GET['tabeleJson']); ?>
<?php $Options = json_decode($_GET['options']); ?>
<!-- ------------------------------------------------------------------------------------- -->

<html>
<head>
	<script src="/js/myJs/api.js" ></script>
	<style>
		.bord{
			border-collapse: collapse;
			width: 653.8px;
		}


		.bord td, .bord th {
			border: 1px solid black;
			border-collapse: collapse;
		}

		#formaToPrint{
			padding-left: 50px;
		}
	</style>
</head>
<body>
	<div id="formaToPrint">
		<table>
			<tr>
				<td style="border-bottom: 1px solid black;text-align: center;width: 268.3px;padding:10px">USMF "N.Testimitanu"</td>
				<td style="width: 100px;"></td>
				<td style="text-align: center;width: 305px;">Forma nr.31</td>
			</tr>
			<tr>
				<td style="text-align: center;"><i>denumirea institutiei</i></td>
				<td></td>
				<td style="text-align: center;">Aprobat prin ordinul Ministerului Finantelor al <br> Republicii Moldova nr.216 din 28.12.2015</td>
			</tr>
			<tr>
				<td colspan="2">Sectia: <div style="border-bottom: 1px solid black;width: 20px;display: inline;"><?php print_r($Options->depozitul);//$Options->depozitul; ?></div></td>
				<td style="text-align: center;"><b>APROBAT:</b></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td style="text-align: center;">____________________________</td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td style="text-align: center;"><i>semnatura conducatorului institutiei</i></td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:center">FACTURA-COMANDA NR.______________</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:center">Temei(tel)_________________________________________"_____"______________________ <?=date("Y");?></td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:center">Cui <div style="border-bottom: 1px solid black;width: 20px;display: inline;"> <?php print_r($Options->destinatarul); //echo $Options->destinatarul ?></div> Prin intermediul <div style="border-bottom: 1px solid black;width: 20px;display: inline;"><?php print_r($Options->gestionar); ?></td>
			</tr>
		</table>

		<br>

		<table style="margin-left: 60px;" class="bord strangeTable">
			<tr>
				<td rowspan="2">Compar-<br>timentul</td>
				<td rowspan="2">Sursa</td>
				<td rowspan="2">Institutia</td>
				<td>Depozit</td>
				<td>Destinatar</td>
				<td rowspan="2">Fel operatie</td>
				<td rowspan="2">Cod, cont <br>bancar, subcont</td>
				<td></td>
			</tr>
			<tr>
				<td>Destinatar</td>
				<td>Expeditor</td>
				<td>Articole de <br>cheltuieli</td>
			</tr>
			<tr>
				<td rowspan="2"></td>
				<td rowspan="2"></td>
				<td rowspan="2"></td>
				<td><div style="height: 18.8px"></div></td>
				<td><div style="height: 18.8px"></div></td>
				<td rowspan="2"></td>
				<td rowspan="2"></td>
				<td rowspan="2"></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right;"><?php print_r($Options->nrDepozit);//=Options->nrDepozit; ?></td>
			</tr>
		</table>

		<div style="margin-top: 20px;width: 668px">
			<div style="display: inline-block;width: 49%;text-align: center;" > <?php print_r($Options->biroul);//=$Options->biroul; ?> </div>
			<div style="display: inline-block;width: 48%;text-align: right;">10.07.2018</div>
		</div>

		<table class="bord" style="width: 713px">
			<tr>
				<th rowspan="2" style="width: 264.5px">Denumire, Calitatea, marimea</th>
				<th rowspan="2">Un/mas</th>
				<th rowspan="2">Nr.Nomeencl</th>
				<th colspan="2">Cantitate</th>
				<th rowspan="2">Pretul</th>
				<th rowspan="2">Suma</th>
			</tr>
			<tr>
				<th>solicitat</th>
				<th>eliberat</th>
			</tr>
			<?php
			foreach ($Response as $info) {
				if ($info->denumirea == null) {
					continue;
				}
				echo "<tr>";
					echo "<td>";
						echo $info->denumirea;
					echo "</td>";

					echo "<td>";
						echo $info->masura;
					echo "</td>";

					echo "<td>";
					echo "</td>";

					echo "<td>";
						echo $info->cantitatea;
					echo "</td>";

					echo "<td>";
						echo $info->cantitatea;
					echo "</td>";

					echo "<td>";
						echo $info->pretul;
					echo "</td>";

					echo "<td>";
						$rez = (int)$info->pretul * (int)$info->cantitatea;
						echo $rez;
					echo "</td>";
				echo "</tr>";
			}
			?>
			<tr>
				<td>Sef departament, Departamentul TIC</td>
				<td></td>
				<td></td>
				<td colspan="2" style="text-align: center;">/Gabriel Russu/</td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
</body>
<input type="button" id="printButton" value="Print">
</html>

<!-- <script>
	setInterval( function () {
		location.reload();
	}, 2000);
</script> -->


<script>
	var result = new API();
	document.getElementById('printButton').onclick = function () {
		var printContents = document.getElementById('formaToPrint').innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.style.paddingLeft = "25px";
		document.body.innerHTML = printContents;

		window.print();
		window.onafterprint = function(){
			let parameters = window.location.search.replace("?","");
			result.inserUnite("/API/api.php", , function (json)
		};

		document.body.innerHTML = originalContents;
	};
</script>