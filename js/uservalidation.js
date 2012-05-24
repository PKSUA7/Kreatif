function checkAll()
	{
	usernameListener('username','usernameDiv');
	mailListener('mail','mailDiv');
	mailTwoListener('mail','mail2','mail2Div');
	passwordListener('pass','passDiv');
	passwordTwoListener('passtwo','pass','passtwoDIV');
	}

function usernameListener(ID,divID)
	{
	var input = document.getElementById(ID);
	var div = document.getElementById(divID);
	if (input.value=="")
		{
		div.innerHTML = "Indtast venligst dit navn";
		div.setAttribute("class", "error");
		return;
		}
	if (input.value.length<5)
		{
		div.innerHTML = "Dit brugernavn skal minimum indeholde 5 tegn";
		div.setAttribute("class", "error");
		return;
		}
	var re = new RegExp("^([A-Za-z]| )+$");
	if (!input.value.match(re))
		{
		div.innerHTML = "Du må kun bruge små bogstaver, store bogstaver og mellemrum";
		div.setAttribute("class", "error");
		return;
		}
	div.innerHTML = "Godkendt";
	div.setAttribute("class", "success");
	}

function mailListener(ID,divID)
	{
	var input = document.getElementById(ID);
	var div = document.getElementById(divID);
	if (input.value=="")
		{
		div.innerHTML = "Indtast venligst din email adresse";
		div.setAttribute("class", "error");
		return;
		}
	var re = new RegExp("^[a-zA-Z0-9_.-]+@([a-zA-Z0-9_]+[\.])+[a-zA-Z_]+$");
	if (!input.value.match(re))
		{
		div.innerHTML = "Din email adresse skal være på formen: eksempel@eksempel.fx";
		div.setAttribute("class", "error");
		return;
		}
	div.innerHTML = "Godkendt";
	div.setAttribute("class", "success");
	}

function mailTwoListener(ID, ID2,divID)
	{
	var input = document.getElementById(ID);
	var input2 = document.getElementById(ID2);
	var div = document.getElementById(divID);
	if (input.value=="")
		{
		div.innerHTML = "Indtast venligst din email adresse igen";
		div.setAttribute("class", "error");
		return;
		}
	if (input.value!=input2.value)
		{
		div.innerHTML = "Email adresserne stemmer ikke overens";
		div.setAttribute("class", "error");
		return;
		}
	div.innerHTML = "Godkendt";
	div.setAttribute("class", "success");
	}

function passwordListener(ID,divID)
	{
	var input = document.getElementById(ID);
	var div = document.getElementById(divID);
	if (input.value=="")
		{
		div.innerHTML = "Indtast venligst din adgangskode";
		div.setAttribute("class", "error");
		return;
		}
	if (input.value.length<8)
		{
		div.innerHTML = "Din adgangskode skal minimum indholde 8 tegn";
		div.setAttribute("class", "error");
		return;
		}
	var re = new RegExp("[^A-Za-z0-9\!\?\-\_\.\,]");
	if (input.value.match(re))
		{
		div.innerHTML = "Du må kun bruge små bogstaver, store bogstaver og -_.,!?";
		div.setAttribute("class", "error");
		return;
		}
	var re = new RegExp("([A-Z])+");
	var re2 = new RegExp("([a-z])+");
	var re3 = new RegExp("([0-9])+");
	if (!input.value.match(re) || !input.value.match(re2) || !input.value.match(re3))
		{
		div.innerHTML = "Din adgangskode skal indeholde små bogstaver, store bogstaver og tal";
		div.setAttribute("class", "error");
		return;
		}
	div.innerHTML = "Godkendt";
	div.setAttribute("class", "success");
	}

function passwordTwoListener(ID, ID2,divID)
	{
	var input = document.getElementById(ID);
	var input2 = document.getElementById(ID2);
	var div = document.getElementById(divID);
	if (input.value=="")
		{
		div.innerHTML = "Indtast venligst din adgangskode igen";
		div.setAttribute("class", "error");
		return;
		}
	if (input.value!=input2.value)
		{
		div.innerHTML = "adgangskoderne stemmer ikke overens";
		div.setAttribute("class", "error");
		return;
		}
	div.innerHTML = "Godkendt";
	div.setAttribute("class", "success");
	}