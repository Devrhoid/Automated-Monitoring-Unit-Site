$('#button').click(function(){
	var j_parameter= $('#S_parameter').val();
	var j_unit= $('#S_unit').val();
	var string = "You will see results for "+j_parameter+" of "+j_unit; 
	alert(string);

	//send the variable to php file
	$.get('php/j_query_php_test.php',{ php_param: j_parameter, php_unit:j_unit },function(data)
	{	
		$('#ajax_resp').text(data);
	}
);

	
});
