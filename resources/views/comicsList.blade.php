<p>Usuario {{session('usid')}}</p>
<p>Autor {{session('auid')}}</p>
	@if(empty($comics))
		<h2>Sin resultados</h2>
	@endif
<ul style="font-family: Arial, Helvetica, sans-serif;">
	
	@foreach($comics as $c)
		<li onclick="window.location.replace('/comics/{{$c[0]->comicid}}')" style="width: 100%;height: 30%;margin-top: 2%;list-style: none;">
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

