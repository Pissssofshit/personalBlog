<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU1 -->
		<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
			<!-- DOC: This is mobile version of the horizontal menu. The desktop version is defined(duplicated) in the header above -->
			<?php $__currentLoopData = $bar_tree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item_1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<li  class="backend_menu_list
            <?php if($loop->first): ?>
						active open
<?php endif; ?>
						" >
					<a href="">
						<i class="fa icon-settings"></i>
						<span class="title"><?php echo e($item_1["name"]); ?></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<?php $__currentLoopData = $item_1["sub"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li class="">
								<a href="<?php echo e($item_2["url"]); ?>" class="backend_menu
                            	<?php echo e($request_path); ?>

								<?php if(trim($item_2["url"],"/")==$request_path): ?>
										active open
								<?php endif; ?>
										">
									<?php echo e($item_2["name"]); ?>

								</a>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
		<!-- END SIDEBAR MENU1 -->
	</div>
</div>
<!-- END SIDEBAR -->

<script type="text/javascript">
	function show_menu(idname) {
		$("#"+idname).toggle();
	}
</script>