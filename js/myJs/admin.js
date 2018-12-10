$(document).ready(function ()
{
	var list = $('.page-list');
	for (var i = 0; i < list.length; i++)
	{
		list[i].onclick = function (event)
		{
			var pages = $('.page');
			for (var i = 0; i < pages.length; i++)
			{
				pages[i].style.display = 'none';
			}
			pages[this.dataset.page].style.display = 'block';
		};
	}

	$("#clearTableButt").click( function ()
	{
		$("#selectedResult tr").remove();
	});

	$("#printBonButt").click( function ()
	{
       var tableRows = $("#selectedResult tr");

       // var tabeleJson = "[{ \"denumirea\":\""+ tableRows[i].cells[1].innerText +"\", "\" \" : },";
		var result = new API();
		result.getUnite("/API/api.php?q=mentenance/catedre_id/1", function (json)
		{
			var catedra = JSON.parse( json );
			result.getUnite("/API/api.php?q=users/users_id/" + catedra[0].users_id, function (json)
			{
				var usersData = JSON.parse( json );
				var gestionar = usersData[0].name;
				
				var destinatarul = document.getElementById('catedrale').selectedOptions[0].innerText;
				var depozitul = document.getElementById('depozite').selectedOptions[0].innerText;
				var nrDepozit = catedra[0].depozit;
				var biroul = document.getElementById('birouri').selectedOptions[0].innerText;

				var options = "{";
				    options += '"destinatarul":"'+ destinatarul +'",';
				    options += '"depozitul":"'+ depozitul +'",';
				    options += '"nrDepozit":"'+ nrDepozit +'",';
				    options += '"biroul":"'+ biroul +'",';
				    options += '"gestionar":"'+ gestionar +'"';
				    options += '}';

				var tabeleJson = '[';
				console.log(tableRows);
				for (var i = 0; i < tableRows.length; i++) {
					tabeleJson += "{";
					tabeleJson += '"denumirea":"'+ tableRows[i].cells[1].innerText +'",';
					tabeleJson += '"masura":"'+ tableRows[i].cells[9].innerText +'",';
					tabeleJson += '"solicitat":"'+ tableRows[i].cells[4].innerText +'",';
					tabeleJson += '"eliberat":"'+ tableRows[i].cells[4].innerText +'",';
					tabeleJson += '"pretul":"'+ tableRows[i].cells[3].innerText +'",';
					tabeleJson += '"cantitatea":"'+ tableRows[i].cells[11].innerText +'"}';
				
					if ( tableRows.length !== (i + 1) )
						tabeleJson += ",";
				};
					tabeleJson += ']';
        		window.open("../../forma/forma.php?options="+ options +"&tabeleJson="+ tabeleJson , "Forma", "width=800,height=600");

			});
		});
	});

	$("#makeTableButt").click(function ()
	{

		var result = new API();

		var selectedModels = document.getElementById('framework').selectedOptions;

		for (var i = 0; i < selectedModels.length; i++) {
			result.getUnite("/API/api.php?q=materiale/materiale_id/" + selectedModels[i].value, function (json)
			{
				var queryResult = JSON.parse( json );
				queryResult.forEach( function(element, index)
				{
					var tableContainer = "<tr>";
					if ( parseInt(element.stoc) >= parseInt(document.getElementById("count").value) )
					{					
						for (variable in element)
						{
							tableContainer += "<td>" + element[variable] + "</td>";
						}
	
						if ( Number.isInteger( Number($("#count")[0].value) ) )   
						{
							tableContainer += "<td>" + $("#count")[0].value + "</td>";
							tableContainer += "<td>";
								tableContainer += "<div class='btn btn-danger' onclick='$(this).parent().parent().remove();'>";
								tableContainer += "X";
								tableContainer += "</div>";
							tableContainer += "</td>";
							tableContainer += "</tr>";
							document.getElementById('selectedResult').innerHTML += tableContainer;
						} else
						{
						 alert('Introduce numar !!!!!!!!!!')	
						}
					}

				});
			});
		}
	});
});