var Buffer = function () {
	this.information = '[';
};


Buffer.prototype.insert = function( field, value, separator = '' ){
	this.information +=  '"' + field + '"' +":" +'"' + value + '"' + separator ;
};


Buffer.prototype.startElement = function( ){
		this.information += "{";
};

Buffer.prototype.endElement = function( ){
	this.information += "},";
};

Buffer.prototype.getInformation = function(){
	this.information = this.information.substring(0, this.information.length - 1);
	this.information += ']';
	console.log( this.information );
	return this.information;
};