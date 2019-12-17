function testNomPrenomPays(nom){
	var res = true;
	if(nom.value.length>32){
		nom.style.backgroundColor="#FFDDDE";
		res=false;
	}
	return res;
}

function testAdresse(adresse){
	var res = true;
	if(adresse.value.length > 128){
		adresse.style.backgroundColor="#FFDDDE";
		res=false;
	}
	return res;
}

function testNumTel(tel){
	var res = true;
	if(isNaN(tel.value) || tel.value.charAt(0)!=0){
		tel.style.backgroundColor="#FFDDDE";
		res = false
	}
	else{
		departement.style.backgroundColor= "white";
	}
	return res;
}

function testnSecu(num){
	res = true;
	if(num.value.length != 13){
		num.style.backgroundColor="#FFDDDE";
		res = false;
	}
	else{
		departement.style.backgroundColor= '';
	}
	return res;
}



function testDepNaissance(departement){
	var res = true;
	if(departement.value == '99'){
		chaine = '<select name="pays" size="3"><option value="Andalousie">Andalousie</option><option value="Russie">Russie</option><option value="Suède">Suède</option><option value="Australie">Autralie</option><option value="Mexique">Mexique</option>'
		document.getElementById('autrePays').innerHTML=chaine;
	}
	else if(departement.value.length != 2 ){
		departement.style.backgroundColor= '#FFDDDE';
		res=false;
	}
	else{
		departement.style.backgroundColor= '';
	}
	return res
}

function formValide(){
	return false;
}