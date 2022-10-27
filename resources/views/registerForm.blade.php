<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#user-data{
			float: left;
			width: 50%;
		}
		#author-data{
			float: left;
			width: 50%;
		}
	</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro Usuario</title>
</head>
<body>
	<form action="register/action" method="POST" name="register-form" id="register-form" style="width:60%;margin-left: 20%;" enctype="multipart/form-data"> 
		@csrf
		<h1>Registro Autor</h1>
		<div id="user-data">
			<label>Nombre Completo: </label><br>
			<input type="text" name="name"><br><br>
			<label>Nombre de Usuario: </label><br>
			<span>@</span><input type="text" name="alias"><br><br>
			<label>Correo: </label><br>
			<input type="text" name="mail"><br><br>
			<label>Contraseña: </label><br>
			<input type="password" name="psswd"><br><br>
			<label>Img URL: </label><br>
			<input type="file" name="usimgpro"><br><br>
		</div>
		<div id="author-data">
			<label>Locación: </label><br>
			<input type="text" name="auloc"><br><br>
			<label>Web personal: </label><br>
			<input type="text" name="auwebs"><br><br>
			<label>Link Personalizado: </label><br>
			<input type="text" name="aupermal"><br><br>
			<label>Titulo: </label><br>
			<select name="autitle">
				@foreach($titles as $t)
					<option value="{{$t->titleid}}">{{$t->titlename}}</option>
				@endforeach
			</select>
			<br><br>
			<label>Descripción de perfil: </label><br>
			<textarea name="audesc" form="register-form"></textarea><br><br>
			<label>PayPal para donaciones: </label><br>
			<input type="text" name="audonl"><br><br>
			
			<label>Portada URL: </label><br>
			<input type="file" name="auimgfr"><br><br>
		</div>
		<input type="submit" value="Registrate" style="float: right; margin-right: 50%;width: 25%;line-height: 10%;padding: 2%;"> 
	</form>
</body>
</html>