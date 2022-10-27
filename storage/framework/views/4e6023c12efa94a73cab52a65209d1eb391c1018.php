<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		html,body{
			height: 100%;
			width: 100%;
			margin: 0 auto;
		}
		.menu-item{
			width: 10%;
			float: right;
			color: white;
		}
		#header-menu{
			height: 12%;
			width: 100%;
			margin: 0;
		}
		#profile{
			font-family: Arial, Helvetica, sans-serif;
			width: 55%;
			margin-left: 10%;
			margin-top: 5%;
			//background-color: black;
			height: 100%;
		}
		#portada{
			width: 100%;
			height: 40%;
			background-color: black;
			border-radius: 20px;
			position: relative;
			overflow: hidden;
		}
		#author-name{
			margin-left: 25%;
			font-size: 25px;
		}
		#spans-container{
			margin-left: 25%;
		}
		.author-span{
			margin-right: 1%;
		}
		#web-link-cont{
			margin-left: 25%;
			margin-top: 5%;
			width: 100%;
		}
		#web-link{
			float: left;
			margin-right: 1%;
			
		}
		#locatoin-link{
			float: left;
		}
		.links-external{
			font-size: 20px;
			font-weight: lighter;
			width: 40%;
		}
		#decription{
			margin-left: 25%;

		}
		#followers{
			height: 20%;
			width: 20%;
			margin-left: 55%;
			background-color: gray;
			text-align: center;
			display: inline-block;
			margin-bottom: 10%;
		}
		#followers p{

		}
	</style>
</head>
<body>
	<div id="header-menu" style="background-color: black;display: inline-block;">
		<div class="menu-item">profile</div>
		<div class="menu-item">Publica</div>
		<div class="menu-item">Mercancía</div>
		<div class="menu-item">Novelas</div>
		<div class="menu-item">Comics</div>
		<div class="menu-item">PANIKY</div>
	</div>
	<div id="profile">
	
	<?php if(empty($profile)): ?>
		<h2>Equivocado pa</h2>
	<?php endif; ?>

			
			<div id="portada"> 
				<img src="<?php echo e(url('lands/'.$profile[1][0]->auimgfr)); ?>" style="background-size: cover;" alt="<?php echo e($profile[1][0]->auimgfr); ?>">
				<div id="followers" style="position: absolute;"><?php echo e($profile[2][0]->followers); ?> seguidores</div>
				
			</div>
			<div id="author-data">
				<div style="width:100%:">
					<div style="width: 20%;height: 80%;float: left;"> 
						<img src="<?php echo e(url('profiles/'.$profile[0][0]->usimgpro)); ?>" style="max-width: 100%;max-height: 100%;">
					</div>
					<h1 id="author-name"><?php echo e($profile[0][0]->usname); ?></h1>
				<?php if(!empty(session('usid')) && null !== session('usid')): ?>
					<?php if(session('usid')!==$profile[0][0]->usid): ?>
						<span style="margin-left:10%;width: 10%"><a href="user/follow/<?php echo e(serialize([$profile[0][0]->usid,session('usid')])); ?>">Seguir</a></span>
					<?php endif; ?>
				<?php endif; ?>
				</div>
				<div id="spans-container">
					<span class="author-span">20k vistas</span>•
				<span class="author-span"><?php echo e($profile[2][0]->followers); ?> suscriptores</span>•
				<span class="author-span">4.5k likes</span>
				</div>
				<!--<h2>User name: <?php echo e($profile[0][0]->usnamepro); ?></h2>
				<h4>User id: <?php echo e($profile[0][0]->usid); ?></h4>
				<p>User email: <?php echo e($profile[0][0]->usmail); ?></p>
				<h4>Author id: <?php echo e($profile[1][0]->auid); ?></h4>-->
				
				<div id="web-link-cont">
					<span class="links-external" id="web-link"><i class="fa fa-external-link" style="margin-right: 3%"></i><?php echo e($profile[1][0]->auwebs); ?></span>
					<span class="links-external" id="location-link"><i class="fas fa-map-marker-alt" style="margin-right: 2%;color: black">  </i><?php echo e($profile[1][0]->auloc); ?></span>
				</div>
				
				<div id="description">
					<p> <?php echo e($profile[1][0]->audesc); ?></p>
				</div>
			</div>
		
	
	</div>
</body>
</html>

<?php /**PATH /var/www/html/resources/views/profile.blade.php ENDPATH**/ ?>