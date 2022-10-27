<!DOCTYPE html>
<html>
<?php if(empty(session('usid')) || null == session('usid') || 
	empty(session('ustype')) || null == session('ustype')): ?>
	<?php if(session('ustype')!==1): ?>
		<script type="text/javascript">
			window.location.replace('http://test.paniky.com');
		</script>
	<?php endif; ?>
<?php endif; ?>
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
	<form action="create/action" method="POST" name="create-form" id="create-form" style="width:60%;margin-left: 20%;" enctype="multipart/form-data"> 
		<?php echo csrf_field(); ?>
		<h1>Crear Comic</h1>
		<div id="comic-data">
			<label>Nombre: </label><br>
			<input type="text" name="comicname"><br><br>
			<label>Tipo de publicación: </label><br>
			<select name="comictype">
				<option value="1">Serie</option>
				<option value="2">One Shot</option>
			</select><br><br>
			<label>Categoria</label>
			<select name="autitle">
				<?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($c->catid); ?>"><?php echo e($c->catname); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
			<label>Tipo de redacción: </label><br>
			<select name="comickind">
				<option value="1">Comic</option>
				<option value="2">Novela</option>
			</select>
			<br><br>
			<label>Descripción: </label><br>
			<textarea name="comicdesc" form="create-form"></textarea><br><br>
			<label>Fecha de estreno: </label><br>
			<input type="date" name="comicnext"><br><br>
			<label>Cover: </label><br>
			<input type="file" name="cover"><br><br>
			<label>Portada: </label><br>
			<input type="file" name="portada"><br><br>
		</div>
		<input type="submit" value="Crear" style="float: right; margin-right: 50%;width: 25%;line-height: 10%;padding: 2%;"> 
	</form>
</body>
</html><?php /**PATH /var/www/html/resources/views/createComic.blade.php ENDPATH**/ ?>