

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
 
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h2>
                        {count($results)} results found for: <span class="text-navy">"{$search}"</span>
                    </h2>
                    <small>Request time  (0.23 seconds)</small>
        
<div class="container">
  <div class="row">
  	<div class="col-md-5">
      <div class="input-group">
        <div class="input-group-btn bs-dropdown-to-select-group">
        <form method="post" action="{base_url('user/organization/onetsoc_search/')}/{$query_str}" >
          <button type="button" class="btn btn-info dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown" tabindex="-1">
            <span data-bind="bs-drp-sel-label">Search Options</span>
            <input type="hidden" name="options" data-bind="bs-drp-sel-value" value="options" />
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
      	<input type="text" id="string" name="string" style="width:400px;" class="form-control" aria-label="..." />
        <span class="input-group-btn">
        <button class="btn btn-primary" type="submit">Search</button>
        </form>
      </span>
      </div><!-- /input-group -->
    </div>
  </div>
</div>
<br />
                    
                    {foreach from=$results item=item}

                    <div class="hr-line-dashed"></div>
                    <div class="search-result">
                        <h3><a href="{base_url('user/organization/previewsoc/code')}/{$item.onetsoc_code}/{$query_str}">{$item.title}</a></h3>
                        <a href="{base_url('user/organization/previewsoc/code')}/{$item.onetsoc_code}/{$query_str}" class="search-link">{$item.onetsoc_code}</a>
                        <p>
                        {$item.description}  
                        </p>
                    </div>
                    
                    {/foreach}
          
                    <div class="text-center">
                        <div class="btn-group">
                            <button class="btn btn-white" type="button"><i class="glyphicon glyphicon-chevron-left"></i></button>
                            <button class="btn btn-white">1</button>
                            <button class="btn btn-white  active">2</button>
                            <button class="btn btn-white">3</button>
                            <button class="btn btn-white">4</button>
                            <button class="btn btn-white">5</button>
                            <button class="btn btn-white">6</button>
                            <button class="btn btn-white">7</button>
                            <button class="btn btn-white" type="button"><i class="glyphicon glyphicon-chevron-right"></i> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                    

            </div><!-- /.box-body -->

 