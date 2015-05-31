<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-31 10:32:48
         compiled from "application\views\templates\user\organization\viewunit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26555556a9fddb44581-57214771%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd917f75c754b47f035864a434feb72947d4f6c6' => 
    array (
      0 => 'application\\views\\templates\\user\\organization\\viewunit.tpl',
      1 => 1433061160,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26555556a9fddb44581-57214771',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556a9fddba2f77_08231885',
  'variables' => 
  array (
    'unit_info_panel' => 0,
    'unit_updates' => 0,
    'query_str' => 0,
    'jobs' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556a9fddba2f77_08231885')) {function content_556a9fddba2f77_08231885($_smarty_tpl) {?>
<div class="container">
<div class="row">
<div class="col-xs-2 border">
    <?php echo $_smarty_tpl->tpl_vars['unit_info_panel']->value;?>

</div>
<div class="col-xs-3 border col-xs-offset-6">   
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['unit_updates']->value)===null||$tmp==='' ? '' : $tmp);?>

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
        <form method="post" action="<?php echo base_url('user/organization/onetsoc_search/');?>
/<?php echo $_smarty_tpl->tpl_vars['query_str']->value;?>
" >
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
            <?php echo $_smarty_tpl->tpl_vars['jobs']->value;?>

            </tbody>
            </table>
            </div>
            </div>

</div></div></div>
<br /><br />
</div>
</div>

<hr />
<?php }} ?>
