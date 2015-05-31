	<div class="smap">
		
		<h1>Organizational Map</h1>
	
		<ul id="utilityNav">
			<li><a href="<?=site_url('/user/organization/add_unit/'.$query_str); ?>">Add Unit</a></li>
	<!--		<li><a href="/login">Reorder Units</a></li> -->
		</ul>

		<ul id="primaryNav" class="col4">
			<li id="home"><a href="#"><?php echo $org_name; ?></a></li>
		<?php echo $map; ?>	
		</ul>

	</div>