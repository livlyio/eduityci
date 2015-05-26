{include file="user/header.tpl" title="Eduity" name="$Name"}

<div class="page-header container">
    <h1><small>{$org_name}</small></h1>
    {if isset($crumbs)}<small>{$crumbs}</small>{/if}
    <br />
    {if isset($heading)}<h1><small>{$heading}</small></h1>{/if}
</div>

<div class="container">

    {$occ_info_panel}

     {$generic_info_panel}

</div><!-- /.container -->
<div class="container" style="margin:10px; margin-left:100px; padding: 10px; width:90%;">

<br /><br />

<div id="tabs">
    <ul class="nav nav-tabs" id="prodTabs">
 <li> <a href="#" id="link_activities">Activities</a></li>
<li><a href="#" id="link_knowledge">Knowledge</a></li>
 <li><a href="#" id="link_context">Context</a></li>
   <li><a href="#" id="link_values">Values</a></li>
<li><a href="#" id="link_skills">Skills</a></li>
    </ul>
    <div class="tab-content">
    <div id="tabcontent" class="tab-pane active">{$tabcontent|default:''}</div>

    </div>
</div>
</div>

<hr>

{include file="user/footer.tpl"}
