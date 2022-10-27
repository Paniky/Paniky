<p>Usuario {{session('usid')}}</p>
<p>Autor {{session('auid')}}</p>
	@if(empty($authors))
		<h2>Sin resultados</h2>
	@endif
<ul style="font-family: Arial, Helvetica, sans-serif;">
	
	@foreach($authors as $a)
		<li onclick="window.location.replace('/{{$a[2]->usid}}')" style="width: 100%;height: 30%;margin-top: 2%;list-style: none;">
			<div style="width: 100%;">
				<div style="width: 20%;height: 80%;float: left;"> 
					<img src="{{url('profiles/'.$a[2]->usimgpro)}}" style="max-width: 100%;max-height: 100%;">
				</div>
				<div style="float:left;width: 80%;">
					
				<h2>{{$a[2]->usname}}</h2>
				<h2>{{'@'.$a[2]->usnamepro}}</h2>
				
				<p>{{$a[1][0]->followers}} followers</p>
				
				<h4>{{$a[0]->audesc}}</h4>

				@if(!empty(session('usid')) && null !== session('usid'))
					@if(session('usid')!==$a[2]->usid)
						<a href="user/follow/{{serialize([$a[2]->usid,session('usid')])}}">Seguir</a>
					@endif
				@endif
				</div>
			</div>
		</li>
	@endforeach
</ul>

