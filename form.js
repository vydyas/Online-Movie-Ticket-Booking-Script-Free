function vaidateMovie()
{
	location1 = $("#location1").val();		
	movies1 = $("#selectmovies").val();
	mdate1 = $("#mdate").val();
	if(location1 == '')
	{
		alert('Please select location');
		return false;
	}
	else if(movies1 == '')
	{
		alert('Please select movie');
		return false;
	}
	else if(mdate1 == '')
	{
		alert('Please select date');
		return false;
	}
	else
	{
		document.forms['formone'].submit();
	}
}

function vaidateTheater()
{
	locationtwo = $("#locationtwo").val();		
	theatertwo = $("#selecttheatertwo").val();
	mdatetwo = $("#mdatetwo").val();

	if(locationtwo == '')
	{
		alert('Please select location');
		return false;
	}
	else if(theatertwo == '')
	{
		alert('Please select Theater');
		return false;
	}
	else if(mdatetwo == '')
	{
		alert('Please select date');
		return false;
	}
	else
	{
		document.forms['formtwo'].submit();
	}
}

/* script for movie search form */
$(document).ready(function()
{

	$("#location1").select2();
	$('#selectmovies').select2();
	$('#mdate').select2();

	$('#selectmovies').prop('disabled', 'disabled');
	$('#mdate').prop('disabled', 'disabled');


	$("#location1").change(function(){
		$.blockUI({ css: { backgroundColor: '#333', color: '#3399ff' } }); 
		loc_id= $("#location1").val();
		var params = "loc_id="+loc_id;
		var url = "get_movie.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) {
				$('#selectmovies').html(data);
				if($('#selectmovies').html(data))
				{
					$.unblockUI();
					$('#selectmovies').removeAttr('disabled');
				}
				else
				{
					$('#selectmovies').prop('disabled', 'disabled');
					return false;
				}
			}
			});
		});

	$("#selectmovies").change(function(){


        
         $.blockUI({ css: { backgroundColor: '#333', color: '#3399ff' } }); 

		mov_id= $("#selectmovies").val();
		loc_id= $("#location1").val();
		var params = "mov_id="+mov_id+"&loc_id="+loc_id;
		var url = "get_date.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) {
				$('#mdate').html(data);
				if($('#mdate').html(data))
				{
					$.unblockUI();
					$('#mdate').removeAttr('disabled');

				}
				else
				{
					$('#mdate').prop('disabled', 'disabled');
					return false;
				}
			}
			});
		});



});

/* script for theater form */
$(document).ready(function()
{
    $("#locationtwo").select2();
	$('#selecttheatertwo').select2();
	$('#mdatetwo').select2();

	$('#selecttheatertwo').prop('disabled', 'disabled');
	$('#mdatetwo').prop('disabled', 'disabled');

	$("#locationtwo").change(function(){
	loc_id= $("#locationtwo").val();
	var params = "loc_id="+loc_id;
	var url = "get_theater.php";
	$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
				
		success: function(data) {
			$('#selecttheatertwo').html(data);
			if($('#selecttheatertwo').html(data))
				{
					$('#selecttheatertwo').removeAttr('disabled');
				}
				else
				{
					$('#selecttheatertwo').prop('disabled', 'disabled');
					return false;
				}
		}
		});
	});

		$("#selecttheatertwo").change(function(){
		the_id= $("#selecttheatertwo").val();
		var params = "the_id="+the_id;
		var url = "get_theatre_date.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) {
				$('#mdatetwo').html(data);
				if($('#mdatetwo').html(data))
				{
					$('#mdatetwo').removeAttr('disabled');
				}
				else
				{
					$('#mdatetwo').prop('disabled', 'disabled');
					return false;
				}
			}
			});
		});
});

$(document).ready(function(){
	/* onload hide theater form */
	$('#theaterform').hide();
	$('#tabTheater').addClass('inactive');
			
	/* theater tab click */
	$('#tabTheater').click(function(){
		$('#theaterform').show();
		$('#tabTheater').removeClass('inactive');
		$('#tabTheater').addClass('active');
		$('#movieform').hide();
		$('#tabMovie').removeClass('active');
		$('#tabMovie').addClass('inactive');
	});
	
	/* theater tab click */
	$('#tabMovie').click(function(){
		$('#theaterform').hide();
		$('#tabTheater').removeClass('active');
		$('#tabTheater').addClass('inactive');
		$('#movieform').show();
		$('#tabMovie').removeClass('inactive');
		$('#tabMovie').addClass('active');
	});
	
});

$(function()
{
	var location=$('#location1').val();
	var movies=$('#selectmovies').val();

	if(location!='')
	{
		loc_id= $("#location1").val();
		var params = "loc_id="+loc_id;
		var url = "get_movie.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) {
				$('#selectmovies').html(data);
				if($('#selectmovies').html(data))
				{
					$('#selectmovies').removeAttr('disabled');
				}
				else
				{
					$('#selectmovies').prop('disabled', 'disabled');
					return false;
				}
			}
			});
	}

	if(movies!='')
	{
		mov_id= $("#selectmovies").val();
		var params = "mov_id="+mov_id;
		var url = "get_date.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) {
				$('#mdate').html(data);
				if($('#mdate').html(data))
				{
					$('#mdate').removeAttr('disabled');
				}
				else
				{
					$('#mdate').prop('disabled', 'disabled');
					return false;
				}
			}
			});
	}
})
