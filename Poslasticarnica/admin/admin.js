function klik(id){
	var elem = document.getElementById(id);
	var data = elem.getAttribute('data-page');
	window.location = data;
}