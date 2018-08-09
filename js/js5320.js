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