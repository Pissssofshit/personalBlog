<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU1 -->
		<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
			<!-- DOC: This is mobile version of the horizontal menu. The desktop version is defined(duplicated) in the header above -->
			@foreach($bar_tree as $key=>$item_1)
				<?php $listopen = false;?>
				@foreach($item_1["sub"] as $item_u)
					@if(trim($item_u["url"],"/")==$request_path)
                            <?php $listopen = true;?>
					@endif
				@endforeach
				<li  class="backend_menu_list
            @if($listopen)
						active open
			@endif
						" >
					<a href="">
						<i class="fa icon-settings"></i>
						<span class="title">{{$item_1["name"]}}</span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						@foreach($item_1["sub"] as $item_2)
							<li class="@if(trim($item_2["url"],"/")==$request_path)
									active open
@endif">
								<a href="{{$item_2["url"]}}" class="backend_menu
								@if(trim($item_2["url"],"/")==$request_path)
										active open
								@endif
										">
									{{$item_2["name"]}}
								</a>
							</li>
						@endforeach
					</ul>
				</li>
			@endforeach
		</ul>
		<!-- END SIDEBAR MENU1 -->
	</div>
</div>
<!-- END SIDEBAR -->