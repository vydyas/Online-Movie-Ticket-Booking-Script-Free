<script src="jquery-1.8.0.min.js"></script>
<span id="Time">02:30 PM</span>
<span id="Date">2015-01-13</span>
<span id="chargeid">1</span>
<div class="seat">
<img src="available.png" title="available" Alt="available" class="a">  
</div>

<span id="ip"><?php echo $_SERVER['REMOTE_ADDR'];?></span>

<span id="countdown" class="timer"></span>

<script type="text/javascript">
$(document).ready(function(){
  var tcharges = 0;
  var selected_seats = '';
  noseats = 0;
  $('.seat img').click(function(){
    chk_status = $(this).attr('class');
    if(chk_status == 'a')
    {

      img_src = $(this).attr('src');
      if(img_src == 'available.png')
      {
        if(noseats == 6)
        {
          alert('You can only select 6 seats');
        }
        else
        {
          resetTimer();
          $('#session').show();
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
        changeseat();
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

function resetTimer() 
{
  var time=$('#Time').html();
  var date=$('#Date').html();
  var chargeid=$('#chargeid').html();
  var ip=$('#ip').html();

  var url = "seatsession.php";
  var params = "time="+time+"&date="+date+"&chargeid="+chargeid+"&ip="+ip;

      $.ajax({
        type: 'POST',
        url: url,
        dataType: 'html',
        data: params,
        success: function(data) {
               if(data=="blocked")
               {
                   $('.seat img').attr('src','blocked.png');  
               }
               else
               {
                   $('.seat img').attr('src','selected.png');  
               }
        }
        });
setTimeout(function(){changeseat(); }, 8000);
}

function timer()
{
	var seconds = 8;
var countdownTimer = setInterval('secondPassed()', 1000);
function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;  
    }
    document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "";
        alert("Time Over");
    } else {
        seconds--;
    }
}

}

function changeseat()
{
  var ip=$('#ip').html();
  var url = "deletesession.php";
  var params = "ip="+ip;       
            $.ajax({
              type:'POST',
              url:url,
              dataType:'html',
              data:params,
              success:function(data)
              {
                    $('.seat img').attr('src','available.png');                  
              }

            });
}

</script>
