
<div class="page-header container">
    <h1>{$org_name}</h1>
    <small>{$crumbs}</small>
    <br />
       <h1><small>{$pageh|default:''}</small></h1> 
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

<hr />


