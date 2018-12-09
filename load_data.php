    <script src="jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="js/lazyloading.js"></script>
    <script type="text/javascript">
    $(function()
    {
        var bLazy = new Blazy();

    });
    </script>
<?php
if($_POST['page'])
{
$page = $_POST['page'];
$cur_page = $page;
$page -= 1;
$per_page = 7;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;
include('db/db.php');

//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

$query_pag_data = "SELECT * FROM movies ORDER BY id DESC LIMIT $start, $per_page";
$result_pag_data = mysql_query($query_pag_data);

$msg = '<table class="data">';
            while($row=mysql_fetch_array($result_pag_data))
            {
$msg.= '<tr>
              <td id="leftcontents">
                <img class="b-lazy" src="images/loading.gif" data-src="uploads/'.$row["image"].'" width=100px>
              </td>
              <td id="rightcontents" valign="top">
                <div id="contents">
                <b>Movie Name:</b>&nbsp;&nbsp;<a>'.$row["name"].'</a><br/>
                <b>Cast:</b>&nbsp;&nbsp;'.$row["cast"].'<br/>
                <b>Direction:</b>&nbsp;&nbsp;'.$row["director"].'<br/>
                <b>Music:</b>&nbsp;&nbsp;'.$row["music"].'<br/>
                <b style="float:right"><a href="#"><img src="images/download.png" alt="'.$row["name"].' Movie Songs Download"></a></b>
              </div>

              </td>';
  $msg.=    '</tr>';
             }
  $msg.=    '</table>';
$msg = "<div class='data'>" . $msg . "</div>"; // Content for Data


/* --------------------------------------------- */
$query_pag_num = "SELECT COUNT(*) AS count FROM movies";
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='active'>First</li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='inactive'>First</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='active'>Previous</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive'>Previous</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
    else
        $msg .= "<li p='$i' class='active'>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active'>Next</li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive'>Next</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
}
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul></div>";  // Content for pagination
echo $msg;
}
?>