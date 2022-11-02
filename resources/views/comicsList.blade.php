
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans);
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
</style>
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
		    <form class="search" action="/search">
                <input type="text" class="searchTerm" placeholder="Buscar comic, novela o autores" name="search_query">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
        <div class="menu-item">

        </div>
	</div>
	@if(empty($comics))
		<h2>Sin resultados</h2>
	@endif
<ul style="font-family: Arial, Helvetica, sans-serif;">

	@foreach($comics as $c)

		<li onclick="window.location.replace('@if($c[0]->comickind == 1)/comics/{{$c[0]->comicid}}@endif @if($c[0]->comickind == 2)/novels/{{$c[0]->comicid}}@endif')" style="width: 100%;height: 30%;margin-top: 2%;list-style: none;">
			<div style="width: 100%;">
				<div style="width: 20%;height: 80%;float: left;">
					<img src="{{url('comics/cover/'.$c[0]->comicid)}}" style="max-width: 100%;max-height: 100%;">
				</div>
				<div style="float:left;width: 80%;">
					<h2>{{$c[0]->comicname}}</h2>
					@if($c[0]->comicstate==1)
						<h2>En emisión. Próximo capitulo el dia {{$c[0]->comicnext}}</h2>
					@endif
					@if($c[0]->comicstate==2)
						<h2>En pausa</h2>
					@endif
					<h4>{{$c[0]->comicdesc}}</h4>
					<a href="/{{$c[1][0][0]}}">{{$c[1][0][1]}}</a>
				</div>
			</div>
		</li>
	@endforeach
</ul>

