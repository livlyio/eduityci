
<div class="container">
<div class="row">
<div class="col-xs-2 border">
    {$unit_info_panel}
</div>
<div class="col-xs-3 border col-xs-offset-6">   
{$unit_updates|default:''}
</div><!-- /.container -->
</div>  
</div>  



<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Search / Add Functions</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="display: block;">
     

<div class="container">
  <div class="row">
  	<div class="col-md-5">
      <div class="input-group">
        <div class="input-group-btn bs-dropdown-to-select-group">
        <form method="post" action="{base_url('user/organization/onetsoc_search/')}/{$query_str}" >
          <button type="button" class="btn btn-info dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown" tabindex="-1">
            <span data-bind="bs-drp-sel-label">Search Options</span>
            <input type="hidden" name="options" data-bind="bs-drp-sel-value" value="options" >
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <!-- Loop -->
            <li data-value="Title"><a href="#">Title </a></li>
            <li data-value="Description"><a href="#">Description </a></li>
            <li data-value="SOC_Code"><a href="#">SOC Code </a></li>
            <!-- END Loop -->
          </ul>
        </div><!-- /btn-group -->
      	<input type="text" id="string" name="string" class="form-control" aria-label="..." />
        <span class="input-group-btn">
        <button class="btn btn-primary" type="submit">Search</button>
        </form>
      </span>
      </div><!-- /input-group -->
    </div>
  </div>
</div>
<br />

</div>
</div>



<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Unit Functions List</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="display: block;">
              

<div class="container">
 <div class="panel-default" style="width: 1050px; height:auto; position: -40px">
        <!-- Default panel contents -->
        <div class="panel-heading">Function List <span style='float:right; margin-top: -7px;'></span></div>

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
            </tbody>
            </table>
            </div>
            </div>

</div></div></div>
<br /><br />
</div>
</div>

<hr />
