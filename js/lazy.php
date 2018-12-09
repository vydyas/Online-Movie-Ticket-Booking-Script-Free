<!DOCTYPE HTML>
<html>
<head>
	<title>Lazy Loading Images</title>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="lazyloading.js"></script>
	<script type="text/javascript">
	$(function()
	{
		var bLazy = new Blazy();

	});
	</script>

</head>
<body>
	<div id="wrapper">
	<img class="b-lazy" src="loading.gif" data-src="bg3.jpg"  alt="Lazy load images image1" />
		
	</div>
</body>
</html>