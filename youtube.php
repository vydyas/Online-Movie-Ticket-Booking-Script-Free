<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$url = (isset($_POST['url']) && !empty($_POST['url'])) ? $_POST['url'] : false;
	if (!$url) {
		echo "Please enter a URL.";
	} else {
		$source = file_get_contents($url);
		$source = urldecode($source);
		
		// Extract video title.
		$vTitle_results_1 = explode('<title>', $source);
		$vTitle_results_2 = explode('</title>', $vTitle_results_1[1]);
		
		$title = trim(str_replace(' - YouTube', '', trim($vTitle_results_2[0])));
		
		// Extract video download URL.
		$dURL_results_1 = explode('url_encoded_fmt_stream_map": "url=', $source);
		$dURL_results_2 = explode('\u0026quality', $dURL_results_1[1]);
		
		// Force download of video.
		$file = str_replace(' ', '_', strtolower($title)).'.webm';
		
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$file");
		header("Content-Type: video/webm");
		header("Content-Transfer-Encoding: binary");
		
		readfile($dURL_results_2[0]);
		
		exit;
	}
}
?>
<form method="post">
	<label for="url">URL:</label> 
	<input type="text" name="url" value="" id="url"> 
	<input type="submit" name="submit" value="Download">
</form>