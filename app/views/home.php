<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $metas['title']; ?></title>
	<meta name="description" content="<?php echo $metas['description']; ?>">
	<meta name="keywords" content="<?php echo $metas['keywords']; ?>">
	<meta property="og:title" content="<?php echo $metas['title']; ?>">
	<meta property="og:description" content="<?php echo $metas['description']; ?>>">

	<link href="/favicon.ico" rel="shortcut icon">
	<link href="/apple-touch-icon.png" rel="apple-touch-icon">
	<link href="/static/build/css/<?php echo $css ?>" rel="stylesheet">

	<link href='http://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
	<!--[if lt IE 9]>
	<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>

    <div class="page">
		<h1>SlimInit</h1>
	</div>

	<script type="text/javascript" src="/static/build/js/<?php echo $js; ?>"></script>

</body>
</html>