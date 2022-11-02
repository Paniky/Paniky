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
		 #header-menu{
              width:100%;
              height:15%;
              display:flex;
              flex-direction: row;
              align-items:center;
              justify-content:center;
              font-family: "Source Sans Pro","Helvetica Neue",Helvetica,Arial,sans-serif;
            }
            .menu-item{
              color:white;
              flex:1;
              height:20%;

            }
            		.search-bar{
            		    flex:3;
            		}
            		.search {
            		  font-family: 'Open Sans', sans-serif;
                      width: 100%;
                      display: flex;
                    }

                    .searchTerm {
                      width: 100%;
                      border: 1px solid grey;
                      border-right: none;
                      padding: 5px;
                      height: 20%;
                      border-radius: 5px 0 0 5px;
                      outline: none;
                      color: grey;

                    }

                    .searchTerm:focus{
                      color: #00B4CC;
                    }

                    .searchButton {
                      width: 40px;
                      height: 36px;
                      border: 1px solid black;
                      background: black;
                      text-align: center;
                      color: white;
                      border-radius: 0 5px 5px 0;
                      cursor: pointer;
                      font-size: 20px;
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
	<div id="header-menu" style="background-color: black;">
            <div class="menu-item">

            </div>
            <div class="menu-item" onclick="window.location.replace('/')">PANIKY</div>
            <div class="menu-item" onclick="window.location.replace('comics')">Comics</div>
            <div class="menu-item" onclick="window.location.replace('novels')">Novelas</div>
            <div class="menu-item">Mercancía</div>
            <div class="menu-item">Publica</div>
    		<div class="menu-item" style="flex:2;" onclick="window.location.replace('/{{session('usid')}}')">{{session('usname')}}</div>
    		<div class="menu-item search-bar">
    		    <div class="search">
                    <input type="text" class="searchTerm" placeholder="Buscar comic, novela o autores">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="menu-item">

            </div>
    	</div>
	<div id="profile">

	@if(empty($profile))
		<h2>Equivocado pa</h2>
	@endif


			<div id="portada">
				<img src="{{url('lands/'.$profile[1][0]->auimgfr)}}" style="background-size: cover;" alt="{{$profile[1][0]->auimgfr}}">
				<div id="followers" style="position: absolute;">{{$profile[2][0]->followers}} seguidores</div>

			</div>
			<div id="author-data">
				<div style="width:100%:">
					<div style="width: 20%;height: 80%;float: left;">
						<img src="{{url('profiles/'.$profile[0][0]->usimgpro)}}" style="max-width: 100%;max-height: 100%;">
					</div>
					<h1 id="author-name">{{$profile[0][0]->usname}}</h1>
				@if(!empty(session('usid')) && null !== session('usid'))
					@if(session('usid')!==$profile[0][0]->usid)
						<span style="margin-left:10%;width: 10%"><a href="user/follow/{{serialize([$profile[0][0]->usid,session('usid')])}}">Seguir</a></span>
					@endif
				@endif
				</div>
				<div id="spans-container">
					<span class="author-span">20k vistas</span>•
				<span class="author-span">{{$profile[2][0]->followers}} suscriptores</span>•
				<span class="author-span">4.5k likes</span>
				</div>
				<!--<h2>User name: {{$profile[0][0]->usnamepro}}</h2>
				<h4>User id: {{$profile[0][0]->usid}}</h4>
				<p>User email: {{$profile[0][0]->usmail}}</p>
				<h4>Author id: {{$profile[1][0]->auid}}</h4>-->

				<div id="web-link-cont">
					<span class="links-external" id="web-link"><i class="fa fa-external-link" style="margin-right: 3%"></i>{{$profile[1][0]->auwebs}}</span>
					<span class="links-external" id="location-link"><i class="fas fa-map-marker-alt" style="margin-right: 2%;color: black">  </i>{{$profile[1][0]->auloc}}</span>
				</div>

				<div id="description">
					<p> {{$profile[1][0]->audesc}}</p>
				</div>
			</div>


	</div>
</body>
</html>

