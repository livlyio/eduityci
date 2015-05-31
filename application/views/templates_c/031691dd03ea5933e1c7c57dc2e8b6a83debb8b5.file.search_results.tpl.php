<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-31 11:17:27
         compiled from "application\views\templates\user\organization\search_results.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3693556acd5800a093-90506104%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '031691dd03ea5933e1c7c57dc2e8b6a83debb8b5' => 
    array (
      0 => 'application\\views\\templates\\user\\organization\\search_results.tpl',
      1 => 1433063842,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3693556acd5800a093-90506104',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556acd5819d068_38868831',
  'variables' => 
  array (
    'results' => 0,
    'search' => 0,
    'query_str' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556acd5819d068_38868831')) {function content_556acd5819d068_38868831($_smarty_tpl) {?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
 
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h2>
                        <?php echo count($_smarty_tpl->tpl_vars['results']->value);?>
 results found for: <span class="text-navy">"<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
"</span>
                    </h2>
                    <small>Request time  (0.23 seconds)</small>
        
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
                    
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['results']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>

                    <div class="hr-line-dashed"></div>
                    <div class="search-result">
                        <h3><a href="<?php echo base_url('user/organization/previewsoc/code');?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['onetsoc_code'];?>
/<?php echo $_smarty_tpl->tpl_vars['query_str']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</a></h3>
                        <a href="<?php echo base_url('user/organization/previewsoc/code');?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['onetsoc_code'];?>
/<?php echo $_smarty_tpl->tpl_vars['query_str']->value;?>
" class="search-link"><?php echo $_smarty_tpl->tpl_vars['item']->value['onetsoc_code'];?>
</a>
                        <p>
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>
  
                        </p>
                    </div>
                    
                    <?php } ?>
          
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

 <?php }} ?>
