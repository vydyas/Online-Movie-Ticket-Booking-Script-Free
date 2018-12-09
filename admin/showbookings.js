$(document).ready(function(){
	var tcharges = 0;
	var selected_seats = '';
	noseats = 0;
	$('.seat img').click(function(){
		chk_status = $(this).attr('class');
		if(chk_status == 'a')
		{

			img_src = $(this).attr('src');
			if(img_src == '../images/available.png')
			{
				if(noseats == 10)
				{
					alert('You can only select 10 seats');
				}
				else
				{
					$(this).attr('src','../images/selected.png');
					img_id = $(this).attr('id');
					charge_id = 'charges'+img_id;
					seatnameid = 'seatname'+img_id;
					charges = document.getElementById(charge_id).value;
					seatnm = document.getElementById(seatnameid).value;
					tcharges = parseInt(tcharges) + parseInt(charges);
					if(selected_seats == '')
					{
						selected_seats = selected_seats + "<span>"+seatnm+"</span>";
					}
					else
					{
						selected_seats = selected_seats + "<span>,"+seatnm+"</span>";
					}
					noseats++;
				}
			}
			else
			{
				$(this).attr('src','../images/available.png');
				img_id = $(this).attr('id');
				charge_id = 'charges'+img_id;
				seatnameid = 'seatname'+img_id;
				charges = document.getElementById(charge_id).value;

				seatnm = document.getElementById(seatnameid).value;
				seatnm_one = seatnm;
				seatnm_two = ',' + seatnm;
				
				tcharges = tcharges - charges;
				selected_seats = selected_seats.replace(seatnm_two,'');
				selected_seats = selected_seats.replace(seatnm_one,'');
				noseats--;
			}
			$('#cost').html(tcharges);
			$('#seatno').html(selected_seats);
			$('#carttotal').html(tcharges);
			$('#cartseats').html(selected_seats);
			if(tcharges != '' && tcharges != 0)
			{
				$('#cart').show();
			}
			else

			{
				$('#cart').hide();
			}
		}
	});
});

$(document).ready(function(){

var mob = /^[1-9]{1}[0-9]{9}$/;
var mobile=$('#contact').val();
var a=$('#contact').val().charAt(0);
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	$('#book_seat').click(function(){
		if($('#fname').val() == '')
		{
			alert('Please enter your name');
		}
		else if($('#contact').val() == '')
		{
			alert('Please enter your mobile number');
		}
		else if(mob.test($.trim($('#contact').val()))==false)
		{
      alert("Please enter valid mobile number.");
    $("#contact").focus();
    return false;
		}
		else if($('#contact').val().charAt(0)=='1' || $('#contact').val().charAt(0)=='2' || $('#contact').val().charAt(0)=='3' || $('#contact').val().charAt(0)=='4' ||$('#contact').val().charAt(0)=='5' || $('#contact').val().charAt(0)=='6')
		{

 alert("Please enter valid mobile number.");
    $("#contact").focus();
    return false;
        }
        else  if($('#email').val()!='' && regex.test($.trim($('#email').val()))==false)
		{
      alert("Please enter valid Email");
    $("#email").focus();
    return false;
		}
		else{
				

		var get_imgs = $('.seat img').length;
		flag = false;
		myform = "<form method='post' action='../confirm-booking.php' name='bookform' id='bookform'>";
		for(i = 0; i<get_imgs; i++)
		{
			if($('.seat img').eq(i).attr('src') == '../images/selected.png')
			{
				flag = true;
				seat_id = $('.seat img').eq(i).attr('id');
				chargeid = "charges"+seat_id;
				seatid = "seatname"+seat_id;
				//charges = $("#"+chargeid).val();
				charges = document.getElementById(charge_id).value;
				seatname = document.getElementById(seatid).value;
				myform = myform + "<input type='text' name='seatid[]' value='"+seat_id+"'>";
				myform = myform + "<input type='text' name='charges[]' value='"+charges+"'>";
				myform = myform + "<input type='text' name='seatname[]' value='"+seatname+"'>";
			}
		}
		$('#sign_up').show();
		location_id = document.getElementById('location_id').value;
		movie_id = document.getElementById('movie_id').value;
		theater_id = document.getElementById('theater_id').value;
		movie_time = document.getElementById('movie_time').value;
		movie_date = document.getElementById('movie_date').value;
		fname = document.getElementById('fname').value;
		contact = document.getElementById('contact').value;
		email = document.getElementById('email').value;
		myform = myform + "<input type='text' name='location_id' value='"+location_id+"'>";
		myform = myform + "<input type='text' name='movie_id' value='"+movie_id+"'>";
		myform = myform + "<input type='text' name='theater_id' value='"+theater_id+"'>";
		myform = myform + "<input type='text' name='movie_time' value='"+movie_time+"'>";
		myform = myform + "<input type='text' name='movie_date' value='"+movie_date+"'>";
		myform = myform + "<input type='text' name='fname' value='"+fname+"'>";
		myform = myform + "<input type='text' name='contact' value='"+contact+"'>";
		myform = myform + "<input type='text' name='email' value='"+email+"'>";
		myform = myform + "</form>";
		if(flag)
		{
			$('#buy').html('');
			$('#sign_up').trigger('close');
			$('.terms').show();
			$('.seat-arrangement').hide();
			document.getElementById('result').innerHTML = myform;
		}
		else
		{
			alert('Please select seats');
		}
		
		}
	});
});

$(document).ready(function(){
	$('.buy').click(function(){
		getBooking = $('#cost').html();
		if(getBooking == '' || getBooking == 0)
		{
			alert('Please select seats');
		}
		else
		{
			$('#sign_up').lightbox_me({
			centered: true, 
			onLoad: function() 
			{ 
            $('#sign_up').find('input:first').focus();
            }
			});
			e.preventDefault();
		}
	});
});

$(document).ready(function(){
	$('#btn').click(function(){
		if($('#fname').val() == '')
		{
			alert('Please enter your name');
		}
		else if($('#mobile').val() == '')
		{
			alert('Please enter your mobile number');
		}
		else if($('#email').val() == '')
		{
			alert('Please enter your email id');
		}
		else
		{
			document.forms['confirmform'].submit();
		}
	});
	
	$('#close').click(function(){
		$('#sign_up').trigger('close');
	});
});

$(document).ready(function(){
	$('#payoo').click(function(){
	if($('#accept').is(':checked')){
		document.forms['bookform'].submit();
	}
	else
	{
		alert('Please accept Terms and Conditions');
	}
	});
});


