{include file="user/header.tpl" title="Eduity" name="$Name"}
{literal}
<link href="<?php echo HTTP_CSS_PATH; ?>starter-template.css" rel="stylesheet">
<style>
    .panel{
        margin-left: 55px;
        float: left;
        width: 500px;
        height: 303px;
    }

</style>
{/literal}

<div class="page-header container">
    <h1><small>{$org_name} </small></h1>
</div>
<div class="container">

    {$org_info_panel}


</div><!-- /.container -->

<div class="container">

	<div class="smap">
		
		<h1>Organizational Map</h1>
	
		<ul id="utilityNav">
			<li><a href="{$smarty.const.BASE_URL}/user/organization/add_unit/{$query_str}">Add Unit</a></li>
			<li><a href="/login">Reorder Units</a></li>
		</ul>

		<ul id="primaryNav" class="col4">
			<li id="home"><a href="#">{$org_name}</a></li>
		{$map}	
		</ul>

	</div>

</div>

<hr>

{include file="user/footer.tpl"}
