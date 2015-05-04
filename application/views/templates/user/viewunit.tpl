{include file="user/header.tpl" title="Eduity" name="$Name"}
{literal}
<style>
    .panel{
        margin-left: 55px;
        float: left;
        width: 500px;
        height: 303px;
    }

</style>
{/literal}

<div id="search-overlay">
	<h2>Begin typing to search</h2>
	<div id="close">X</div>
	<form>
		<input id="hidden-search" type="text" autocomplete="off" /> <!--hidden input the user types into-->
		<input id="display-search" type="text" autocomplete="off" readonly="readonly" /> <!--mirrored input that shows the actual input value-->
	</form>
	
	<div id="results">
		<h2 class="artists">Artists</h2>
		<ul id="artists"></ul>
	</div>
</div>

<div class="page-header container">
    <h1><small>{$org_name}</small></h1>
    <small>{$crumbs}</small>
</div>
<div class="container">

    <div class="panel panel-info">
        <!-- Default panel contents -->
        <div class="panel-heading">Unit Profile</div>
        <div class="panel-body">
        <table class="table table-striped table-hover">
        <tr><td>Name:</td><td>{$unit_title} </td></tr>
        <tr><td>Description:</td><td>{$unit_desc} </td></tr>
        <tr><td>Location:</td><td>{$unit_location} </td></tr>
        <tr><td>Website:</td><td>{$unit_website|default:''} </td></tr>
        <tr><td><a href="{$base}user/organization/edit_unit/{$query_str}" class="btn btn-warning" role="button">Edit Unit</a></td><td><a href="{$base}user/organization/add_unit/{$query_str}" class="btn btn-info" role="button">Add Sub-Unit</a> &nbsp;&nbsp; <a href="{$base}user/organization/del_unit/{$query_str}" class="btn btn-danger" role="button" onclick="javascript:return confirm('Are you sure you want to delete this unit?')">Delete Unit</a></td></tr>
        </table>
        
        </div>
    </div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Panel heading</div>
        <div class="panel-body">
            <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien.</p>
        </div>
    </div>

</div><!-- /.container -->

<div class="container">

<br /><br />

<div id="search">
	Search Occupations
	<img src="{$base}assets/images/bt-search.jpg" alt="Search" />
</div>

<br /><br />
</div>

<hr>

{include file="user/footer.tpl"}
