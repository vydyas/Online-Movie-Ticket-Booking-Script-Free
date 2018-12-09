<html>
<?php
#
# Script to download YouTube videos
# Originally crafted by panefsky on Developer On Line- Salonica,Greece 2008
# Use free. Credits welcome.#
# Input: Post parameter 'name' is the YouTube URL
# Known issues: sometimes the parsing fails either because
#YouTube does not send the proper format or
#whatever.. However 2nd invocation of script always succeeds! You might contribute at that.
#
# Enjoy!
if(!empty($_POST['name'])) {

$location = htmlspecialchars($_POST['name']);
try {
$handle = fopen($location, "r");
if($handle) {
$contents = '';
while (!feof($handle)) {
$contents .= fread($handle, 8192);
}
fclose($handle);
$result1 = preg_match("/&t=([\w]*)&/",$contents,$tickets);
$result2 = preg_match("/v=(\w*)/",$location,$video_id);

if($result1) {
echo "<a href = \"http://www.youtube.com/get_video?video_id=";
echo $video_id[1];
echo "&t=";
echo $tickets[1];
echo "\">Download link.</a>";
echo "<br>";
echo "Click n Save with flv extension";
}
else echo "Damn! Click Back and try again..Sorry :(";
}
else echo "\nYou liked that? Ha?";
}
catch(Exception $e) {echo "I made an error. So what?";}
}

else echo "Empty input! Bad boy...!";
?>
<br><br>
<a href="dolUTubeFrame.html">Back</a>
</hmtl>