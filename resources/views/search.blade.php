<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$term}} - Resultado de busqueda</title>
    <style>
        html,body{
            height: 100%;
            width: 100%;
            margin: 0 auto;
        }
        #content{
            display: flex;
            height: 85%;
            width: 100%;
        }
        #selectSearchList{
            flex: 3;
            height: 100%;
            background-color: #242526;
            display: flex;
            flex-direction: column;
        }
        #lista{
            flex: 8;
            background-color: #18191a;
            height: 100%;
            font-family:Helvetica Neue, Helvetica, Arial, sans-serif;
            -webkit-font-smoothing:subpixel-antialiased;
            overflow-y: scroll;
        }
        #selectSearchList{

        }
        .listElement{
            display: flex;
            flex-direction: column;
            width: 100%;

        }
        .listResult{
            color: white;
            flex: 1;
            width: 80%;
            margin-left: 10%;
            background-color: #242526;
            padding: 1%;
            border-radius: 12px;
        }
        #header-menu{
            width:100%;
            height:15%;
            display :flex;
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
        .selector{
            width: 100%;
            flex: 2;
            border-radius: 5%;
        }
        .selector button{
            width: 120%;
            background-color: #3a3b3c;
            border: none;
            color: white;
            font-family: "Source Sans Pro","Helvetica Neue",Helvetica,Arial,sans-serif;
            text-align: left;
            margin-left: 15%;
            font-size: 1.1rem;
            padding: 6%;
            border-radius: 12px;
        }
        .selector button:hover{
            width: 120%;
            background-color: white;
            border: none;
            color: #3a3b3c;
            font-family: "Source Sans Pro","Helvetica Neue",Helvetica,Arial,sans-serif;
            text-align: left;
            margin-left: 15%;
            font-size: 1.1rem;
            padding: 6%;
            border-radius: 12px;
            transition-duration: 0.5s;
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
        <div class="menu-item search-bar">
            <form class="search" action="/search">
                <input type="text" class="searchTerm" placeholder="Buscar comic, novela o autores" name="search_query">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="menu-item">

    </div>
</div>
    <div id="content">
        <div id="selectSearchList" style="padding-left:3%;">
            <div style='display: flex;flex-direction: column;color: white;font-family: "Source Sans Pro","Helvetica Neue",Helvetica,Arial,sans-serif;'>
                <p style="font-size: 1.6rem;font-weight: bold;">Resultados de la busqueda</p>
                <p style="font-size: 1.2rem;font-weight: bold;">Filtrar por</p>
            </div>
            <div id="selectores" style="display: flex;flex-direction: column;row-gap: 1.2rem;width: 70%">
                @if(count($results['authors']) == 0 && count($results['comics']) == 0 &&
                count($results['novels']) == 0 && count($results['users']) == 0)
                    <div id="noMatchList">No hay resultados</div>

                @endif
                @if(count($results['comics'])>0)
                    <div id="comicsSelector" class="selector">
                        <button>Comics ({{count($results['comics'])}})</button>
                    </div>

                @endif
                @if(count($results['novels'])>0)
                    <div id="novelsSelector" class="selector">
                        <button>Novelas ({{count($results['novels'])}})</button>
                    </div>

                @endif
                @if(count($results['authors'])>0)
                    <div id="comicsSelector" class="selector">
                        <button>Autores ({{count($results['authors'])}})</button>
                    </div>

                @endif
                @if(count($results['users'])>0)
                    <div id="comicsSelector" class="selector">
                        <button>Usuarios ({{count($results['users'])}})</button>
                    </div>

                @endif
            </div>
        </div>
        <div id="lista">
            @if(count($results['comics'])>0)
                <div id="comics" class="listElement">
                    @foreach($results['comics'] as $c)

                        <div onclick="window.location.replace('@if($c[0]->comickind == 1)/comics/{{$c[0]->comicid}}@endif @if($c[0]->comickind == 2)/novels/{{$c[0]->comicid}}@endif')" style="margin-top: 2%;" class="listResult">
                            <div style="width: 100%;">
                                <div style="width: 20%;height: 80%;float: left;overflow-y: hidden;align-content: center">
                                    <img src="{{url('comics/cover/'.$c[0]->comicid)}}" style="object-fit: cover;width: 100%;height: 13rem;">
                                </div>
                                <div style="float:left;width: 75%;margin-left: 3%">
                                    <h2>{{$c[0]->comicname}}</h2>
                                    @if($c[0]->comicstate==1)
                                        <h4 style="color: #8f9195">En emisión. Próximo capitulo el dia {{$c[0]->comicnext}}</h4>
                                    @endif
                                    @if($c[0]->comicstate==2)
                                        <h4>En pausa</h4>
                                    @endif
                                    <h5 style="font-weight: lighter;">{{$c[0]->comicdesc}}</h5>
                                    <a href="/{{$c[1][0][0]}}" style="text-decoration: none;color: #94989a">{{$c[1][0][1]}}</a>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            @endif
            @if(count($results['novels'])>0)
                    @foreach($results['novels'] as $c)

                        <div onclick="window.location.replace('@if($c[0]->comickind == 1)/comics/{{$c[0]->comicid}}@endif @if($c[0]->comickind == 2)/novels/{{$c[0]->comicid}}@endif')" style="margin-top: 2%;display: none" class="listResult">
                            <div style="width: 100%;">
                                <div style="width: 20%;height: 80%;float: left;">
                                    <img src="{{url('comics/cover/'.$c[0]->comicid)}}" style="max-width: 100%;max-height: 100%;">
                                </div>
                                <div style="float:left;width: 80%;">
                                    <h2>{{$c[0]->comicname}}</h2>
                                    @if($c[0]->comicstate==1)
                                        <h4 style="color: #8f9195">En emisión. Próximo capitulo el dia {{$c[0]->comicnext}}</h4>
                                    @endif
                                    @if($c[0]->comicstate==2)
                                        <h4>En pausa</h4>
                                    @endif
                                    <h5 style="font-weight: lighter;">{{$c[0]->comicdesc}}</h5>
                                    <a href="/{{$c[1][0][0]}}" style="text-decoration: none;color: #94989a">{{$c[1][0][1]}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
            @endif

            @if(count($results['authors']) == 0 && count($results['comics']) == 0 &&
                count($results['novels']) == 0 && count($results['users']) == 0)
                <div id="noMatch" >No hay resultados</div>
            @endif
        </div>
    </div>
</body>
</html>
