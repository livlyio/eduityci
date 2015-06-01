

<div class="page-header container">
    <h1><small>{$org_name}</small></h1>
    <small>{$crumbs} &gt; Edit</small>
</div>
<div class="container">

        <form method="post" action="{$base}user/organization/edit_unit/{$query_str}">
        <div class="panel-heading">Edit Unit Profile</div>
        <div class="panel-body">
        <table class="table table-striped table-hover">
        <tr><td>Name:</td><td><input type="text" size="50" value="{$unit_title}" name="unit_title" /> </td></tr>
        <tr><td>Description:</td><td><textarea name="unit_desc" rows="4" cols="50">{$unit_desc}</textarea> </td></tr>
        <tr><td>Location:</td><td><input type="text" size="50" value="{$unit_location}" name="unit_location" /> </td></tr>
        <tr><td>Website:</td><td><input type="text" size="50" value="{$unit_website|default:''}" name="unit_website" /> </td></tr>
        <tr><td><input type="submit" class="btn btn-success" value="Save Edits" name="save_unit" /></td><td></td></tr>
        </table>
        </form>
        </div>
  


<br /><br /><br /><br />
</div>

<hr />
