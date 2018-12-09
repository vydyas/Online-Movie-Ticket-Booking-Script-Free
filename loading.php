<html>
<head>
<style type="text/css">
	
 #register a {
text-shadow: 0px -1px 0px #524B4B;
      }
	  
#register fieldset {
      padding: 20px;
      }
	  
input.ipt {
      -webkit-border-radius: 15px;
      -moz-border-radius: 15px;
      border-radius: 5px;
      border:solid 1px #444;
      font-size: 14px;
      width: 90%;
      padding: 7px 8px 7px 3px;
      -moz-box-shadow: 0px 1px 0px #777;
      -webkit-box-shadow: 0px 1px 0px #777;
      text-shadow:0px 1px 0px #FFFFFF;
}	  


	
#register h3 {
    position:relative; 
	text-shadow: 0px -1px 0px #000;
	border-bottom: dashed #FFFFFF 1px ;
	-moz-box-shadow: 0px 1px 0px #3a3a3a;
	text-align: center;
	padding: 18px;
	margin: 0px;
	font-weight: normal;
	font-size: 24px;
	font-family: Calibri;
	}
	
#register h2:before{
    content:""; 
    display:block; 
    position:absolute; 
    left:0; 
    bottom:5px; 
    width:100%; 
    height:3px;                          
    background:#FFFFFF;
}	
	
.signup {
font-family: Calibri;
height: 43px;
line-height: 25px;
background: #3399ff;
border: none;
text-align: center;
display: inline-block;
color: #fff;
font-size: 17px;
margin-right: 0px;
margin-left: 11px;
font-weight: bold;
font-family: georgia;
cursor: pointer;
}
</style>
<link rel="stylesheet" type="text/css" href="http://www.infotuts.com/demo/lightbox-signup-form/css/colorbox.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script src="http://malsup.github.io/jquery.blockUI.js"></script>
<script src="popup.js"></script>
<script type="text/javascript"> 
    $(document).ready(function() { 

         //$('#pageDemo2').click(function() { 
            //$.blockUI({ css: { backgroundColor: '#333', color: '#3399ff' } }); 
            //setTimeout($.unblockUI, 2000); 
           // $.blockUI({ message: $('#register') }); 
        //}); 

     $.colorbox({width:"480px", inline:true, href:"#register"});

        $('#pageDemo2').click(function() { 
            //$.blockUI({ css: { backgroundColor: '#333', color: '#3399ff' } }); 
            //setTimeout($.unblockUI, 2000); 
           // $.blockUI({ message: $('#loginForm') }); 
           $.unblockUI();
        }); 
    }); 
 
</script> 
</head>
<body>

<!--<div id="loginForm">
	<button id="pageDemo2">Click Me</button>
</div>-->
<div id="register">
<h3>Subscribe to Book Movie Tickets And Get Updates!..</h3>
<form id="SignUpForm" action="" method="post">
<input id="email" type="email" class="ipt" placeholder="Enter Your Email ID"  onblur="this.placeholder = 'Enter Your Email ID'" value="" /></p><button type="submit" class="signup">Subscribe Please!!</button></form>
</div>

</body>
</html>

