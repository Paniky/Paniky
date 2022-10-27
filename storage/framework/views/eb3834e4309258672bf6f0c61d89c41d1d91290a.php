<p>Usuario <?php echo e(session('usid')); ?></p>
<p>Autor <?php echo e(session('auid')); ?></p>
	<?php if(empty($comics)): ?>
		<h2>Sin resultados</h2>
	<?php endif; ?>
<ul style="font-family: Arial, Helvetica, sans-serif;">
	
	<?php $__currentLoopData = $comics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li onclick="window.location.replace('/comics/<?php echo e($c[0]->comicid); ?>')" style="width: 100%;height: 30%;margin-top: 2%;list-style: none;">
			<div style="width: 100%;">
				<div style="width: 20%;height: 80%;float: left;"> 
					<img src="<?php echo e(url('comics/cover/'.$c[0]->comicid)); ?>" style="max-width: 100%;max-height: 100%;">
				</div>
				<div style="float:left;width: 80%;">
					<h2><?php echo e($c[0]->comicname); ?></h2>
					<?php if($c[0]->comicstate==1): ?>
						<h2>En emisión. Próximo capitulo el dia <?php echo e($c[0]->comicnext); ?></h2>
					<?php endif; ?>
					<?php if($c[0]->comicstate==2): ?>
						<h2>En pausa</h2>
					<?php endif; ?>
					<h4><?php echo e($c[0]->comicdesc); ?></h4>
					<a href="/<?php echo e($c[1][0][0]); ?>"><?php echo e($c[1][0][1]); ?></a>				
				</div>
			</div>
		</li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<?php /**PATH /var/www/html/resources/views/comicsList.blade.php ENDPATH**/ ?>