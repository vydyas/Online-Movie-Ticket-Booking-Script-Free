<?php
include('db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();
?>
<html>
    <head>
        <title>Telugu Mp3 Songs Download | Latest Movies | Cinemachoodu.com</title>
        <style type="text/css">
        body{font-family: calibri;}
            #loading{
                width: 100%;
                position: absolute;
                top: 100px;
                left: 100px;
        margin-top:200px;
            }
            #container .pagination ul li.inactive,
            #container .pagination ul li.inactive:hover{
                background-color:#ededed;
                color:#bababa;
                border:1px solid #bababa;
                cursor: default;
            }
            #container .data ul li{
                list-style: none;
                font-family: verdana;
                margin: 5px 0 5px 0;
                color: #000;
                font-size: 13px;
            }

             #container1 ul li{
                list-style: none;
                color: #000;
                font-size: 17px;
                padding: 4px;
                border-bottom: solid 1px #bdbdbd;
            }
             #container1 ul li a{
               text-decoration: none;
            }


            #container .pagination{
                height: 25px;
            }
            #container .pagination ul li{
                list-style: none;
                float: left;
                border: 1px solid #006699;
                padding: 2px 6px 2px 6px;
                margin: 0 3px 0 3px;
                font-family: arial;
                font-size: 14px;
                color: #006699;
                font-weight: bold;
                background-color: #f2f2f2;
            }
            #container .pagination ul li:hover{
                color: #fff;
                background-color: #006699;
                cursor: pointer;
            }
            #container1 h2
            {
                padding: 10px;
            }
      .go_button
      {
      background-color:#f2f2f2;border:1px solid #006699;color:#cc0000;padding:2px 6px 2px 6px;cursor:pointer;position:absolute;margin-top:-1px;
      }
      .total
      {
      float:right;font-family:arial;color:#999;
      } 
        </style>

        <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="jquery-1.8.0.min.js"></script>
    <script src="http://malsup.github.io/jquery.blockUI.js"></script>
     <script type="text/javascript">
            $(document).ready(function(){
                function loading_show(){
                   $.blockUI({ css: { backgroundColor: '#333', color: '#3399ff' } }); 
                }
                function loading_hide(){
                    $.unblockUI();
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax
                    ({
                        type: "POST",
                        url: "load_data.php",
                        data: "page="+page,
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);
                    
                });           
                $('#go_btn').live('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto').val("").focus();
                        return false;
                    }
                    
                });
            });
        </script>
   
    </head>
    <body style="background:#eee">
<?php
include('header.php');
?>
     <center style="margin-top:-10px">
           <nav class="menu">
           <ul class="active">
            <li><a href="index.php">Home</a></li>
            <li><a href="movies.php">Movies</a></li>
            <li><a href="theatres.php">Theatres</a></li>
            <li><a href="trailers.php">Trailers</a></li>
            <li><a href="moibile-app.php">Mobile App</a></li>
            <li style="float:right;margin-right:10px;">
            
            <a class="toggle-nav" href="#">&#9776;</a>

            <input type="text" id="filter" style="padding:3px;width:250px;" placeholder="Search Movies.." ></li>
           </ul>

           </nav>
        <h1>Latest Telugu Mp3 Songs - Free Download - CinemaChoodu.Com</h1>
            
          <div id="loading"></div>
        <div id="container">
            <div class="data"></div>
            <div class="pagination"></div>
        </div> 
        
        </center>
    <br/>
<script type="text/javascript">
	$(document).ready(function(){
    $("#filter").keyup(function(){
 
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val();
 
        // Loop through the comment list
        $("table tr").each(function(){
 
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
                count++;
            }
        });
 
    });
});
</script>
    </body>
</html>