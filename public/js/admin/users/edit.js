$(function(){
	
	$('#select-project').on('change', onSelectProjectChange);

});

//para capturar o id do projecto selecionado
function onSelectProjectChange(){
	var project_id = $(this).val();

	//se o project_id for vasio
	if(! project_id) {
		$('#select-level').html('<option value="">Seleccionar nivel</option>');
		return;
	}

	//AJAX para dizer quais os niveis associados ao projecto seleccionado
	//criando webservice
	$.get('/api/projecto/'+project_id+'/niveis', function(data){

		var html_select = '<option value="">Seleccionar nivel</option>';
		for (var i = 0; i < data.length; i++) 
			html_select += '<option value="'+data[i].id+'">'+data[i].nome+'</option>'
			
			$('#select-level').html(html_select);
		
		
	});
	
}