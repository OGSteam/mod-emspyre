//constante
flotte_name = new Array('SAT','PT', 'GT', 'CLE', 'CLO', 'CR', 'VB', 'VC', 'REC', 'SE', 'BMD', 'DST', 'EDLM', 'TRA');
flotte_price = new Array(2500,4000,12000,4000,10000,29000,60000,40000,18000,1000,90000,125000,10000000,85000);


// fonction d appel principal
function update_page() {
	total_flotte();
}

function total_flotte() {
	 
    var total_flotte_scanne = 0;
    var total_flotte_estime = 0;
    var total_flotte_total = 0;
    
	for (var i = 0; i < flotte_name.length; i++) {
		total_flotte_scanne = total_flotte_scanne + parseInt(document.getElementById("flotte_scanne_" + flotte_name[i]).innerHTML) ;
       	total_flotte_estime = total_flotte_estime + parseInt(document.getElementById("flotte_estime_" + flotte_name[i]).value) ;
        document.getElementById("flotte_flottes_" + flotte_name[i]).innerHTML = parseInt(document.getElementById("flotte_scanne_" + flotte_name[i]).innerHTML)+parseInt(document.getElementById("flotte_estime_" + flotte_name[i]).value)
            
	}

	document.getElementById("total_flotte_scanne").innerHTML = total_flotte_scanne;
    document.getElementById("total_flotte_estime").innerHTML = total_flotte_estime;
    document.getElementById("total_flottes").innerHTML = parseInt(document.getElementById("total_flotte_scanne").innerHTML) + parseInt(document.getElementById("total_flotte_estime").innerHTML);
    
}