//constante
flotte_name = new Array('SAT','PT', 'GT', 'CLE', 'CLO', 'CR', 'VB', 'VC', 'REC', 'SE', 'BMD', 'DST', 'EDLM', 'TRA');
flotte_price = new Array(2.5,4,12,4,10,29,60,40,18,1,90,125,10000,85);


// fonction d appel principal
function update_page() {
	total_flotte();
}

function total_flotte() {
	 
    var total_flotte_scanne = 0;
    var total_flotte_estime = 0;
    var total_flotte_total = 0;
    var total_flottes_points = 0;
    
	for (var i = 0; i < flotte_name.length; i++) {
	   var temp_total_flotte = 0;
       var temp_total_point = 0
       
		total_flotte_scanne = total_flotte_scanne + parseInt(document.getElementById("flotte_scanne_" + flotte_name[i]).innerHTML) ;
       	total_flotte_estime = total_flotte_estime + parseInt(document.getElementById("flotte_estime_" + flotte_name[i]).value) ;
        
        temp_total_flotte = parseInt(document.getElementById("flotte_scanne_" + flotte_name[i]).innerHTML)+parseInt(document.getElementById("flotte_estime_" + flotte_name[i]).value);
        document.getElementById("flotte_flottes_" + flotte_name[i]).innerHTML = temp_total_flotte;
        
        temp_total_point = temp_total_flotte * flotte_price[i];
        document.getElementById("flotte_flottes_points_" + flotte_name[i]).innerHTML = temp_total_point;
        total_flottes_points = total_flottes_points + temp_total_point
        
            
	}

	document.getElementById("total_flotte_scanne").innerHTML = total_flotte_scanne;
    document.getElementById("total_flotte_estime").innerHTML = total_flotte_estime;
    document.getElementById("total_flottes").innerHTML = parseInt(document.getElementById("total_flotte_scanne").innerHTML) + parseInt(document.getElementById("total_flotte_estime").innerHTML);
    document.getElementById("total_flottes_points").innerHTML = total_flottes_points;
    
}