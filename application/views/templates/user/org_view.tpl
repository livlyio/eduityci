{include file="user/header.tpl" title="Eduity" name="$Name"}

<div class="page-header container">
    <h1><small>{$org_name}</small></h1>
    {if isset($crumbs)}<small>{$crumbs}</small>{/if}
    <br />
    {if isset($heading)}<h1><small>{$heading}</small></h1>{/if}
</div>

<div class="container">

{$info_panel|default:''}

</div>

<div class="container">

{$content|default:'No Content Defined.'}

</div>

<hr />

{include file="user/footer.tpl"}
