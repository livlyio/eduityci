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

    <div class="panel" style="width:800px; height:400px;">
        <!-- Default panel contents -->
        <div class="panel-heading">Add Unit</div>
        <div class="panel-body">
        <form method="post" action="{$smarty.const.BASE_URL}/user/organization/add_unit/{$org_id}">
        <table class="table table-striped table-hover">
        <tr><td>Parent Unit:</td><td><select name="parent_id" style="width:300px;"><option value="0">Home</option> {$parents}</select></td></tr>
        <tr><td>Name:</td><td><input type="text" name="unit_title" size="50" /></td></tr>
        <tr><td>Description:</td><td><textarea rows="4" cols="50" name="unit_desc"></textarea></td></tr>
        <tr><td>Location:</td><td><input type="text" name="unit_location" size="50" /></td></tr>
        <tr><td>Website:</td><td><input type="text" name="unit_website" size="50" /></td></tr>
        <tr><td></td><td><input type="submit" name="add_unit" /></td></tr>
        </table>
        
        </div>
    </div>

  
</div>
<hr>

{include file="user/footer.tpl"}
