function slide(part){
    var display=($('#'+part).css('display'));
    if(display==='block'){
        $('#'+part).hide(1000);
    }
    else{
        $('#'+part).slideToggle(500);
    }
}

function showInfosUser(user){
	$.ajax(
		{
		type:"GET",
		url:"js/php/users/fullInfosUser.php",
		data:{idUser:user},
		success:function(retour){
			document.getElementById('RightSide').innerHTML=retour;
			}
		}
	);
}

function modifUser(idUser){
	var divContent=document.getElementById('RightSide').innerHTML;	
	var nom=document.getElementById('nom').value;
	var prenom=document.getElementById('prenom').value;
	var e=document.getElementById('grade');
	var grade=e.options[e.selectedIndex].value;
	var e=document.getElementById('service');
	var service=e.options[e.selectedIndex].value;
	var e=document.getElementById('acces');
	var acces=e.options[e.selectedIndex].value;	
	var matricule=document.getElementById('matricule').value;
	var mail=document.getElementById('mail').value;
	var gsm=document.getElementById('gsm').value;
	var tel=document.getElementById('tel').value;
	$.ajax({		
		type:"GET",
		url:"js/php/users/updateUser.php",
		data:{
			idUser:idUser,
			nom:nom,
			prenom:prenom,
			grade:grade,
			service:service,
			matricule:matricule,
			mail:mail,
			gsm:gsm,
			tel:tel,
			acces:acces
			},
			success:function(retour){
					if(retour>'0'){
						document.getElementById('bEnregistrer').innerHTML='Enregistrement réussi';
						document.getElementById('bEnregistrer').setAttribute("class","btn btn-success");
						}
					else{
						document.getElementById('bEnregistrer').innerHTML='Rien n\'a été modifié, est-ce une erreur ?';
					}
					
				}			
		}
		);
	}


function deReactiveUser(idUser,a){
	var ok=confirm('Êtes vous sur ?');
	if(ok){
		$.ajax({
			type:"GET",
			url:"js/php/users/deReactivateUser.php",
			data:{
				idUser:idUser,
				actif:a
				},
			success:function(retour){
				if(retour==='1'){
					location.reload();
					}
				}
			}
			);
		}
}

function addMail(){
	var nom=document.getElementById('nom').value;
	var prenom=document.getElementById('prenom').value;
	document.getElementById('mail').value=prenom+'.'+nom+'@police.belgium.eu';
	}
	
function verifMatricule(){
	var matricule = document.getElementById('matricule').value;
	$.ajax({
		type:"GET",
		url:"js/php/users/verifMatricule.php",
		data:{mat:matricule},
		success:function(retour){
			if(retour=='1'){
				alert('Ce matricule existe déjà en base de données !');
				document.getElementById('matricule').value='Erreur !';
				}
			}
		});
	}