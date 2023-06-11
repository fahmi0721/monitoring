function out_load() {
	$('.preload-wrapper').hide();
}
function in_load() {
	$('.preload-wrapper').show();
}
function error_detail(error) {
	console.log(error);
	if(error.status=="500") {
		if(error.responseJSON.messages) {
			swal(''+error.status+'',''+error.responseJSON.messages[2]+'','error');
			return false;
		} else {	
			response = error.responseJSON.messages?error.responseJSON.messages:error.statusText;
			swal(''+error.status+'',''+response+'','error');
			return false;
		}
	}else if(error.status=="405") {
			if(error.responseJSON.messages) {
				swal(''+error.status+'',''+error.responseJSON.messages[2]+'','error');
				return false;
			} else {	
				response = error.responseJSON.messages?error.responseJSON.messages:error.statusText;
				swal(''+error.status+'',''+response+'','error');
				return false;
			}
	}else if(error.status=="404") {
		if(error.responseJSON.messages) {
			swal(''+error.status+'',''+error.responseJSON.messages+'','error');
			return false;
		} else {	
			response = error.responseJSON.messages?error.responseJSON.messages:error.statusText;
			swal(''+error.status+'',''+response+'','error');
			return false;
		}
	} else if(error.responseJSON.status=="warning") {
		swal('Warning',''+error.responseJSON.messages+'','warning');
		return false;

	} else if(error.responseJSON.status=="error") {
		swal('Error',''+error.responseJSON.messages+'','error');
		return false;
	}
}


function angka(objek) {
	a = objek.value;
	b = a.replace(/[^\d]/g,"");
	objek.value = b;
}

function rupiah(objek) {
	separator = ".";
	a = objek.value;
	b = a.replace(/[^\d]/g,"");
	c = "";
	panjang = b.length; 
	j = 0; 
	for (i = panjang; i > 0; i--) {
			j = j + 1;
			if (((j % 3) == 1) && (j != 1)) {
				c = b.substr(i-1,1) + separator + c;
		} else {
				c = b.substr(i-1,1) + c;
		}
	}
	objek.value = c;
}

$.extend( $.fn.dataTable.defaults, {
		autoWidth: false,
		responsive: true,
		processing: true,
		language: {
			search: '_INPUT_',
		searchPlaceholder: 'Cari Data',
		lengthMenu: '_MENU_',
		paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
	},
});

$.extend( $.fn.datepicker.defaults, {
	autoclose: true,
	format:'yyyy-mm-dd',
	todayHighlight: true

});

