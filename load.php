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
$movie_id=$_POST['movies'];


$query="SELECT t.*,m.name as moviename,m.rating,m.image,m.cast,l.location FROM theatres t
 LEFT JOIN movies m on m.id=t.movies_id 
 LEFT JOIN location l on l.id=t.location_id WHERE  t.movies_id=$movie_id AND t.location_id=$location_id";

 $result=mysql_query($query);
 $row=mysql_fetch_array($result);

?>

          <table  style="background:white">
            <tr style="background:#3399ff;color:white">
              <td colspan=2>&nbsp;&nbsp;Movie In <b><?php echo $row['location'];?></b></td>
            </tr>
            <tr>
              <td style="padding:5px" valign="top">
                <table>
                  <tr>
                    <td>
                      <img src="uploads/<?php echo $row['image'];?>" height="200"/>
                    </td>
                    <td valign="top">
                       <br/>
                    </td>
                  </tr>
                </table>
                
              </td>
              <td valign="top">
                
                <h2><?php echo $row['moviename']; ?></h2>
                
                <b>Theatre:</b>&nbsp;<pstyle="color:f71d57"><?php echo $row['name']; ?></p>
                <p><b>Addr:</b>&nbsp;<?php echo $row['address']; ?></p>

                <span style="color:#444444"><b>Timings:</b>&nbsp;11:00 am &nbsp;2:30 pm &nbsp; 6:15pm &nbsp;9:30pm</span><br/><br/>
                <b>Rating:</b>&nbsp;<?php echo $row['rating'];?>/5<br/><br/>
                <b>Cast:</b>&nbsp;<?php echo $row['cast'];?><br/>
               
              </td>
              
            </tr>
          </table>

    <?php
  }
  ?>