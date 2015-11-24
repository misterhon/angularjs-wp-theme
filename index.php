<!DOCTYPE html>
<html lang="en" ng-app="wpa">
<head>
	<meta charset="UTF-8">
	<?php wp_head(); ?>
	<base href="/">
	<title><?php wp_title(); ?></title>
</head>
<body>

<header>
	<h1>Alex Hon</h1>
	<h2>Developer, Mecha Enthusiast</h2>
</header>

<div ng-view></div>

<footer>&copy; <?php echo date('Y');?></footer>
<?php wp_footer(); ?>
</body>
</html>