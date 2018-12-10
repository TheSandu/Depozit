$( document ).ready(function() {

var eventHeandler = new Heandler();
var formConstructor = new Constructor();

eventHeandler.onAppendButtonClick( formConstructor.addIteamToForm );

eventHeandler.onTypeChange( formConstructor.changeModels );

eventHeandler.openPopUpButtonClick( formConstructor.showForm );

// eventHeandler.onInsertUserButtonClick( formConstructor.insertUser );

eventHeandler.onInsertModelButtonClick( formConstructor.insertModel );

eventHeandler.onInsertTypeButtonClick( formConstructor.insertType );

});