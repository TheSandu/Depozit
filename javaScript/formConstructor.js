var counter = 0;
var	buffer = new Buffer();
var Constructor = function () {


	this.type = document.getElementById('type');
	this.model = document.getElementById('model');
	this.modelCount = document.getElementById('count');
	this.form = document.getElementById('formaToPrint');
};

Constructor.prototype.showForm = function () {


	$.ajax({
		url:"../ajax/formControl/getGestionar.php",
		method:"GET",
		datatype:'JSON',
		data:{ catedra_id: document.getElementById('catedre').selectedOptions[0].value },
		success: function( CatedreJson ){
			var requiestedCatedre = JSON.parse( CatedreJson );
			buffer.startElement();
			buffer.insert( 'catedre_si_gestionari_id', requiestedCatedre.catedre_si_gestionari_id , ',');
			buffer.insert( 'nr_depozit', requiestedCatedre.nr_depozit , ',');
			buffer.insert( 'catedra', requiestedCatedre.catedra , ',');
			buffer.insert( 'sef_catedra', requiestedCatedre.sef_catedra , ',');
			buffer.insert( 'gestionar', requiestedCatedre.gestionar );
			buffer.endElement();

			var url = "../forma/forma.php?tabeleJson="+ buffer.getInformation();

			window.open( url, "", "width=1085,height=500" );
		} 	 	 	 			
	});

};

Constructor.prototype.addIteamToForm = function() {
	$.ajax({
		url:"../ajax/formControl/getModel.php",
		method:"GET",
		datatype:'JSON',
		data:{ model_id: document.getElementById('model').value, model_need: document.getElementById('count').value },
		success: function( json ){
			var requiestedModel = JSON.parse( json );	
			buffer.startElement();
				for (property in requiestedModel) {
					buffer.insert( property, requiestedModel[property], ',' );
				}

			buffer.insert( 'cantitatea', document.getElementById('count').selectedOptions[0].innerText, ',' );
			buffer.insert( 'catedra', document.getElementById('catedre').selectedOptions[0].innerText, ',' );
			buffer.insert( 'deposit', document.getElementById('deposite').selectedOptions[0].innerText, ',' );
			buffer.insert( 'birou', document.getElementById('birouri').selectedOptions[0].innerText );
			buffer.endElement();
			
			$('#forma').append("<tr><th scope='row'>" + counter + "</th>" + "<td>" + requiestedModel.denumirea + "</td>" + "<td>" + requiestedModel.Eliberat + "</td>" + "<td>" + requiestedModel.sold + "</td>"+"<td>" + Number(requiestedModel.total - requiestedModel.Eliberat) + "</td>"+"<td>" + requiestedModel.Pret * document.getElementById('count').value + 'lei' + "</td></tr>");
			counter++;
		}
	});
};

Constructor.prototype.changeModels = function() {
	$.ajax( {
		url:"../ajax/formControl/changeModel.php?type=" + document.getElementById('type').value,
		dataType :"html",
		method: 'GET',
		success:function( html ){
	   		document.getElementById("model").innerHTML = html;
		}
	  });
};

// Constructor.prototype.insertUser = function( ){
// 		$.ajax({
// 		url: "../ajax/adminUse/insertUser.php",
// 		dataType: "html",
// 		method: 'POST',
// 		data: { 
// 			userName: document.getElementById('insertedUser').value , 
// 			roleId: document.getElementById('userRole').value
// 		},
// 		success:function( html ){
// 			alert(html);
// 		}
// 	});
// };

Constructor.prototype.insertModel = function( ){
	$.ajax({
		url: "../ajax/adminUse/insertModel.php",
		dataType: "html",
		method: 'POST',
		data: { 
			type: document.getElementById('typeToInsert').selectedOptions[0].value, 
			modelName: document.getElementById('modelToInsert').value,
			total: document.getElementById('totalModelCount').value,
			pret: document.getElementById('pretModel').value
		},
		success:function( html ){
			alert(html);
		}
	});
};

Constructor.prototype.insertType = function( ){
	$.ajax({
		url: "../ajax/adminUse/insertType.php",
		dataType: "html",
		method: 'POST',
		data: { 
			modelName: document.getElementById('typeInputToInsert').value,
		},
		success:function( html ){
			alert(html);
		}
	});
};