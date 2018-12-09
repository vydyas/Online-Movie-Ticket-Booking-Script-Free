$(document).ready(function(){
	$('#printtckt').click(function(){
		$('#printform').lightbox_me({
		centered: true, 
		onLoad: function() { 
        $('#printform').find('input:first').focus();
        }
		});
		e.preventDefault();
	});

	$('#sendid').click(function(){
		$('#printform1').lightbox_me({
		centered: true, 
		onLoad: function() { 
        $('#printform1').find('input:first').focus();
        }
		});
		e.preventDefault();
	});
	
	$('#close').click(function(){
		$('#printform').trigger('close');
	});
	$('#closes').click(function(){
		$('#printform1').trigger('close');
	});
});