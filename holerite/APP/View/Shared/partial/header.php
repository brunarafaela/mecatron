<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!-- TODO: keywords -->
	<meta name="keywords" content="" />
	<?php echo call('Helper/OpenGraph')->generate($pData['ogp']);?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- arquivos de css -->
	<link rel="shortcut icon" href="" type="image/x-icon" />

	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/font-awesome.min.css" rel="stylesheet">
	<link href="/css/datepicker3.css" rel="stylesheet">
	<link href="/css/styles.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<?php getCs(); ?>
	<!-- arquivos de javascript -->
	<script src="/js/jquery-1.11.1.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<?php getJs(); ?>
</head>
<body>