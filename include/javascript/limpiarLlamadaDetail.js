	$('#create_link').hide();
	$('#create_image').hide();

	$("[href='index.php?module=Calls&action=EditView&return_module=Calls&return_action=DetailView']").hide();
	$("[href='index.php?module=Import&action=Step1&import_module=Calls&return_module=Calls&return_action=index']").hide();
	
function openParent(idParent, parentModule){
	if (parentModule=!"undefined"){
		window.open('index.php?module='+parentModule+'&action=DetailView&record=' + idParent);
	}
	
}