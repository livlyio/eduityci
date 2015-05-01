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

<div class="page-header container">
    <h1><small>{$org_name}</small></h1>
</div>
<div class="container">

        <form method="post" action="{$base}user/organization/edit_unit/{$unit_id}">
        <div class="panel-heading">Organizaiton Profile</div>
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

<hr>

{include file="user/footer.tpl"}
