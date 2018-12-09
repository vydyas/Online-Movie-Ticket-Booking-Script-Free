<?php
include('db/db.php');
include('frontend.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$frontend=new frontend();

//loation
$array=$frontend->getlocation();
  $size=sizeof($array);
  $t_size=$size;
  $i=0;
  $t=0;

if($_POST)
{
$location_id=$_POST['location'];

$query2=mysql_query("SELECT location from location WHERE id='$location_id'");
$s=mysql_fetch_array($query2);

$query="SELECT m.* FROM theatres t LEFT JOIN movies m on m.id=t.movies_id WHERE t.location_id=$location_id";

 $result=mysql_query($query);
 ?>
 <div style="width:950px;border:solid 1px #bdbdbd;background:#eee;min-height:200px">
 <h2 style="float:left;color:red;margin-left:10px">Movies in <span style="color:black"><?php echo $s['location'];?>:</span></h2>
 <center>
  <div style="width:950px">
 <ul style="float:left">
<?php
 while($row=mysql_fetch_array($result))
 {
?>
 <li><a href="#myModals" class="popup" id="<?php echo $row['id']; ?>" data-toggle="modal"><img src="uploads/<?php  echo $row['image']; ?>" alt="<?php  echo $row['name']; ?>" title="<?php  echo $row['name']; ?>" width=125px height=155px/></a>&nbsp;&nbsp;</li>
    
<?php
}
}
?>
</ul>
</div>
</div>
</center>
<div id="myModals" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Movie Information</h4>
                </div>
                <div class="modal-bodys">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(function()
{
  $('.popup').click(function()
  {
    var location=<?php echo $location_id;?>;
    var movies=$(this).attr("id");
    $('.modal-bodys').html("<br/><img src='ajax-loader.gif' alt='Loading...' /><br/>");
    $.post("load.php",
    {
      location:location,
      movies:movies
    },
    function(data,status)
    {
      $('.modal-bodys').html(data);

    });
    
  });
});
</script>