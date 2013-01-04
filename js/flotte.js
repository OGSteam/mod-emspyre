//constante
flotte_name = new Array('SAT','PT', 'GT', 'CLE', 'CLO', 'CR', 'VB', 'VC', 'REC', 'SE', 'BMD', 'DST', 'EDLM', 'TRA');
flotte_price = new Array(2.5,4,12,4,10,29,60,40,18,1,90,125,10000,85);
flotte_manquante_a = 0;
flotte_manquante_nb_a = 0;


// fonction d appel principal
function update_page() {
	total_flotte();
	analyse();
   
     
}

function analyse()
{
    var nb_vaisseaux_classement = document.getElementById("nb_vaisseaux_classement").value;
    flotte_manquante_nb_a =  parseInt(document.getElementById("nb_vaisseaux_classement").value) - parseInt(document.getElementById("total_flotte_scanne").innerHTML ) ;
    // flotte manquante nb 
    document.getElementById("flotte_manquante_nb_a").innerHTML = flotte_manquante_nb_a ;
    // flotte manquante pt 
    var vaisseaux_classement = parseInt(document.getElementById("total_flottes_points").innerHTML);
    flotte_manquante_a =  parseInt(document.getElementById("pts_flotte_calcule").innerHTML )  - parseInt(vaisseaux_classement);
    
    document.getElementById("flotte_manquante_pt_a").innerHTML = flotte_manquante_a ;

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

 function create_option_value()
 {
    var retour = "";
    for (var i = 0; i < flotte_name.length; i++) {
       retour =  retour + "<option value=\"" + flotte_name[i] + "\">" + flotte_name[i] + "</option>";
    }
   
    document.getElementById("nom_select").innerHTML = retour;
   
 }
 
 function calcul_max_vaisseaux()
 {
 var index = document.getElementById('nom_select'); 
var valeur_index = index.options[index.selectedIndex].value


alert(valeur_index);
   
 }