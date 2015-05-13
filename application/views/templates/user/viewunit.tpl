{include file="user/header.tpl" title="Eduity" name="$Name"}

<div id="search-overlay">
	<h2>Begin typing to search</h2>
	<div id="close">X</div>
	<form>
        <input id="org" type="hidden" value="{$org}" />
        <input id="unit" type="hidden" value="{$unit}" />
		<input id="hidden-search" type="text" autocomplete="off" /> <!--hidden input the user types into-->
		<input id="display-search" type="text" autocomplete="off" readonly="readonly" /> <!--mirrored input that shows the actual input value-->
	<input id="securestr" type="hidden" value="{$query_str}" />
    
    </form>
	
	<div id="results">
		<h2 class="artists">Occupations</h2>
		<ul id="artists"></ul>
	</div>
</div>

<div class="page-header container">
    <h1><small>{$org_name}</small></h1>
    <small>{$crumbs}</small>
</div>
<div class="container">

    {$unit_info_panel}

</div><!-- /.container -->

<div class="container">

<br /><br />

<div id="search">
	Search Occupations
	<img src="{$base}assets/images/bt-search.jpg" alt="Search" />
</div>
<br /><br />
</div>

<div class="container">
 
 <div class="panel-default" style="width: auto; height:auto; position: -40px">
        <!-- Default panel contents -->
        <div class="panel-heading">Occupations List <span style='float:right; margin-top: -7px;'></span></div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th style="width:100px;">Soc Code</th>
              <th>Title</th>
              <th>Description</th>
              <th>Controls</th>
            </tr>
          </thead>
          <tbody>
            {$jobs}
            </table>
            </div>
            </div>


<br /><br />
</div>

<hr>

{include file="user/footer.tpl"}
