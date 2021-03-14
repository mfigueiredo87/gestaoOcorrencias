$(function(){
	// alert('testando o script');

	$('[data-category]').on('click',editCategoryModal);
	$('[data-level]').on('click',editLevelModal);

});

function editCategoryModal(){
	//para devolver o id da categoria
	var category_id = $(this).data('category');
	//alert(category_id);
	//pegando o id do modal e associar seu valor
	$('#category_id').val(category_id);
	// pegando nome no modal
	var category_nome = $(this).parent().prev().text();
	// alert(nome);
	$('#category_nome').val(category_nome);

	$('#modalEditCategory').modal('show');
}

//modal do nivel ou level
function editLevelModal(){
	//para devolver o id da categoria
	var level_id = $(this).data('level');
	//alert(level_id);
	//pegando o id do modal e associar seu valor
	$('#level_id').val(level_id);
	// pegando nome no modal
	var level_nome = $(this).parent().prev().text();
	// alert(nome);
	$('#level_nome').val(level_nome);
	
	$('#modalEditLevel').modal('show');
}