<p>Usuario <?php echo e(session('usid')); ?></p>
<p>Autor <?php echo e(session('auid')); ?></p>
	<?php if(empty($authors)): ?>
		<h2>Sin resultados</h2>
	<?php endif; ?>
<ul style="font-family: Arial, Helvetica, sans-serif;">
	
	<?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li onclick="window.location.replace('/<?php echo e($a[2]->usid); ?>')" style="width: 100%;height: 30%;margin-top: 2%;list-style: none;">
			<div style="width: 100%;">
				<div style="width: 20%;height: 80%;float: left;"> 
					<img src="<?php echo e(url('profiles/'.$a[2]->usimgpro)); ?>" style="max-width: 100%;max-height: 100%;">
				</div>
				<div style="float:left;width: 80%;">
					
				<h2><?php echo e($a[2]->usname); ?></h2>
				<h2><?php echo e('@'.$a[2]->usnamepro); ?></h2>
				
				<p><?php echo e($a[1][0]->followers); ?> followers</p>
				
				<h4><?php echo e($a[0]->audesc); ?></h4>

				<?php if(!empty(session('usid')) && null !== session('usid')): ?>
					<?php if(session('usid')!==$a[2]->usid): ?>
						<a href="user/follow/<?php echo e(serialize([$a[2]->usid,session('usid')])); ?>">Seguir</a>
					<?php endif; ?>
				<?php endif; ?>
				</div>
			</div>
		</li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<?php /**PATH /var/www/html/resources/views/authorsList.blade.php ENDPATH**/ ?>