<!DOCTYPE html>
<html>
<head>
	<title></title>
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>

	<style type="text/css">
		
	body {
		padding-top: 45px;
		font-family: 'Sofia';
		}
	#mainH {
		color: black;
		width:100%; 
		text-align: center;
		margin: 20px 20px 20px 20px;
		/* border: 1px solid red; */
		text-align: center;
		
	}

	#leftLeaf {
		display: inline-block;
		width: 10%;
		float: left;

	}
	#rightLeaf {
		display: inline-block;
		width: 10%;
		float: right;
	}
	#created {
		display: inline-block;
		width: 40%;
		font-size: 40px;
	}
	.leaf {
		width:70px;
		height:70px;
	}

	#myNavbar {
		vertical-align: bottom;
		padding-top: 5px;
	}
	#logo{
		float: left;
		padding-top: 5px;
	}
	.navRight {
		float:right;
	}
	.navbar-fixed-top {
		background-color: black;
		color: white;
		font-size: 22px;
	}
	.navbar-toggle{
		color:white;
		background-color: white;
		border-color: white;
	}
	.navbar-toggle:hover {  
		background-color: blue;
	} 
	
	ul>li { 
		margin-right: 25px;
	} 

	ul>li: hover {
		background-color: grey;

	}
	.categImages {
		width: 150px;
		height: 150px;
		/* border: 1px solid red; */
	}
	.col-md-3 {
		padding-bottom: 10px;
		padding-top: 10px;
	}
	.lupa {
		color: white;	
	}
	#lookingFor {

	}
	.navbar-fixed-bottom {
		background-color: black;
		color: white;
		font-size: 22px;
		text-align: center;
		vertical-align: bottom;
	}
	#categ {
		font-size: 18px;
		
	}
	
	</style>
</head>
	<body>
		<header>
			<nav class="navbar navbar-default navbar-fixed-top"> 
				<div class="container">
					<span id="logo"> LOGO </span>
					<form class="navbar-form navbar-left" role="search" >
						<div class="input-group"> 
  							<input type="text" class="form-control" placeholder="I am interested in" id="placeholder" > 
    						<span class="input-group-btn"> 
    						<button type="submit" value="go" class="btn btn-default" id="lookingFor"> 
    						<span class="glyphicon glyphicon-search" aria-hidden="true" id="lupa" ></span>
  							</button>
  							</span>
  						</div>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
  						<span class="icon-bar"></span>
  						<span class="icon-bar"></span>
  					</button>
  					
  					</form>
					<div class="collapse navbar-collapse" id="myNavbar">
  						<ul class="nav navbar-nav navRight">	
							<li id="signIn"> Sign in </li>
							<li id="signUp"> Become a member </li>
				</div>
			</nav>
		</header>
			<div class="container">
				<div id="mainH" class="row">
					<div id="leftLeaf" class="col-md-4"><img src="imgs/left_leaf.png" class="leaf">
					</div>
					<div id="created" class="col-md-4"><span> Created to create </span> </div>
					<div id="rightLeaf" class="col-md-4"> <img src="imgs/right_leaf.png" class="leaf"></div>
			</div>
		</div>
			<div class="container" id="categ"> 
				<div class="row" class="" >
					<div class="col-md-3"> <span> <a href =""> Handicraft </a></span><img src="imgs/handicraft_bw_art.png" class="categImages"> </div>

					<div class="col-md-3">  <span> <a href="">Photography </a></span><img src="imgs/camera.jpg" class="categImages"> </div>

					<div class="col-md-3"> <span> <a href="">Illustration </a></span><img src="imgs/pencil_2.jpg" class="categImages"></div>

					<div class="col-md-3"> <span> <a href="">Paint </a></span><img src="imgs/sztaluga_art.jpg" class="categImages"></div>

					<!-- <div class="col-md-3"> <span> Jewellery </span><img src=""></div>
					 -->
				</div>
			</div>
			<br>
			
			<div class="navbar navbar-default navbar-fixed-bottom">
				<div class="container" >
					<div class="col-md-4"> 
						<span > Contact </span> 
					</div>
					<div class="col-md-4"> 
						<span > Follow us </span> 
					</div>
					<div class="col-md-4"> 
						<span> Community </span> 
					</div>
					
				</div>
			</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">

	var searchBtn = $("#lookingFor");
	var logIn = $("#signIn");
	var becomeMem = $("#signUp");

	becomeMem.click(signUpFunction);
	function signUpFunction(e) { }

    logIn.click(function() {
        window.location.href = "loginSession.php?from=artistory.php&action=login";
    });
	becomeMem.click(function() {
        window.location.href = "loginSession.php?from=artistory.php&action=create";
    });
    </script>
</body>
</html>