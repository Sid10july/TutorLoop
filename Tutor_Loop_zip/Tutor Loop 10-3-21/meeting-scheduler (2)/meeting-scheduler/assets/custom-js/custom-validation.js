/*allow alphabet and space*/
function validateName(name){
	var nameReg = /^[a-zA-Z\'\-\s]+$/;
	return nameReg.test(name);
}

/*only number is allowed*/
$(".onlyNumber").keydown(function(event) {
// Allow only backspace and delete
if ( event.keyCode == 46 || event.keyCode == 8 ) {
    // let it happen, don't do anything
}
else {
    // Ensure that it is a number and stop the keypress
    if (event.keyCode < 48 || event.keyCode > 57 ) {
        event.preventDefault(); 
    }   
}
});

/*allow only alphabet and space*/
$('.onlyAlpha').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(strigChar)) {
        return true;
    }
    return false
  });

 function ValidateAlpha(evt)
    {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
         
        return false;
            return true;
    }