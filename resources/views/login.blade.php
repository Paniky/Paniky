<form action="login/action" method="POST">
	@csrf
	<label>Nombre de Usuario o Correo: </label><br>
	<input type="text" name="mail"><br><br>
	<label>Contraseña: </label><br>
	<input type="password" name="psswd"><br><br>
	<input type="submit" value="login">
</form>