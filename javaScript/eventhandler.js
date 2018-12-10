var Heandler = function () {
	this.appendButton  = document.getElementById('appendButton');
	this.form = document.getElementById('formaToPrint');
	this.printButton = document.getElementById('printButton');
	this.type = document.getElementById('type');
};

Heandler.prototype.onAppendButtonClick = function( event ) {
	document.getElementById('appendButton').onclick = event;
};

Heandler.prototype.openPopUpButtonClick = function( event ) {
	document.getElementById('openPopUp').onclick = event;
};

Heandler.prototype.onTypeChange = function( event ) {
	document.getElementById('type').onchange = event;
};

// Heandler.prototype.onInsertUserButtonClick = function( event ){
// 	document.getElementById('insertUserIdButton').onclick = event;
// };

Heandler.prototype.onInsertModelButtonClick = function( event ){
	document.getElementById('insertModelButton').onclick = event;
};

Heandler.prototype.onInsertTypeButtonClick = function( event ){
	document.getElementById('insertTypeButton').onclick = event;
};