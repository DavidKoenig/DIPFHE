<?php
	$root = "";
	for($i = $rootPoint; $i != 0; --$i)
 	{
		$root .= "../";
 	}
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>DiPFHE | <?php echo $title; ?></title>
	<meta name="description" content="" />
	<meta name="author" content="Fischer, König, Lorper, Rochholz" />

	<link rel="stylesheet" type="text/css" href="<?php echo $root; ?>css/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $root; ?>css/grid.css" />
	<link rel="stylesheet/less" type="text/css" href="<?php echo $root; ?>css/main.less" />
	<script src="<?php echo $root; ?>js/less-1.3.3.min.js" type="text/javascript"></script>
</head>