$(function()
{

	$('#selecttheater').select2();
	$('#show_time').select2();

	$('#selecttheater').prop('disabled', 'disabled');
	$('#show_time').prop('disabled', 'disabled');

	$("#selectmovies").change(function(){
		mov_id= $("#selectmovies").val();
		loc_id= $("#location1").val();

		var params = "mov_id="+mov_id+"&loc_id="+loc_id;
		var url = "get_theater_booking.php";
		$.ajax({
		type: 'POST',
		url: url,
		dataType: 'html',
		data: params,
		
		success: function(data) {
				$('#selecttheater').html(data);
				if($('#selecttheater').html(data))
				{
					$('#selecttheater').removeAttr('disabled');
				}
				else
				{
					$('#selecttheater').prop('disabled', 'disabled');
					return false;
				}
			}
			});
		});


});