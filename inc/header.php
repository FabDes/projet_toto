<!DOCTYPE html>
<html>
<head>
	<title>Projet_toto</title>
	<meta charset="utf-8">
	<style type="text/css">
		body{
			font-family: verdana, sans-serif;
			margin:0;
			padding: 0;
		}
		nav{
			width: 100%;
			background-color: #34495e;
			height: 50px;
		}
		table{
			border: 0;
			width: 100%;
			text-align: center;
			text-transform: uppercase;
			font-size: 12px;
		}

		table a {
			text-decoration: none;
		}

		thead{
			background-color: #2c3e50;
			color: white;
		}

		tbody tr:nth-child(odd){
			background-color: #bdc3c7;
		}
		.formContainer{
			width: 800px;
			margin: auto;
		}
		.selectResearch{
			width: 650px;
			margin:10px;
			border-radius: 10px;
			border-radius: solid 0 white;
			padding-left: 10px
		}
		.selectBtn{
			width:100px;
			background-color:  #1abc9c;
			border:0;
			color: white;
			font-weight: bold;
		}
		nav a{
			text-decoration: none;
			color: white;
			text-transform: uppercase;
			line-height: 50px;
			height: 50px;
			width: 120px;
			display: inline-block;
			text-align: center;
		}

		nav a:hover{
			background-color: #16a085;
		}

		.research{
			width: 100%;
			background-color: #1abc9c;
		}
		.content{
			font-weight: 400;
			color:red;
			text-transform: uppercase;
		}
		main{
			width:800px;
			margin:auto;
		}
	</style>
</head>
<body>	
		<nav>
			<a href="index.php">index</a>
			<a href="list.php">list</a>
		</nav>
		<form class="research" action="search.php" method="get">
			<div class="formContainer">
				<input class="selectResearch" type="text" name="search" value=""/>
				<button class="selectBtn" type="submit" >OK</button>
			</div>
		</form>
		<main>


	
