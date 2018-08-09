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
		Document.getElementById('RigtSide').innerHTML=user;
	}