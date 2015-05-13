<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-13 20:36:22
         compiled from "application\views\templates\user\viewunit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22124553db6bf02ce94-57713342%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de8e73077fece5af7322e1728d6e84d77757ed0c' => 
    array (
      0 => 'application\\views\\templates\\user\\viewunit.tpl',
      1 => 1431542167,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22124553db6bf02ce94-57713342',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_553db6bf0979c9_47595885',
  'variables' => 
  array (
    'org' => 0,
    'unit' => 0,
    'query_str' => 0,
    'org_name' => 0,
    'crumbs' => 0,
    'unit_info_panel' => 0,
    'base' => 0,
    'jobs' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553db6bf0979c9_47595885')) {function content_553db6bf0979c9_47595885($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


<div id="search-overlay">
	<h2>Begin typing to search</h2>
	<div id="close">X</div>
	<form>
        <input id="org" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['org']->value;?>
" />
        <input id="unit" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['unit']->value;?>
" />
		<input id="hidden-search" type="text" autocomplete="off" /> <!--hidden input the user types into-->
		<input id="display-search" type="text" autocomplete="off" readonly="readonly" /> <!--mirrored input that shows the actual input value-->
	<input id="securestr" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['query_str']->value;?>
" />
    
    </form>
	
	<div id="results">
		<h2 class="artists">Occupations</h2>
		<ul id="artists"></ul>
	</div>
</div>

<div class="page-header container">
    <h1><small><?php echo $_smarty_tpl->tpl_vars['org_name']->value;?>
</small></h1>
    <small><?php echo $_smarty_tpl->tpl_vars['crumbs']->value;?>
</small>
</div>
<div class="container">

    <?php echo $_smarty_tpl->tpl_vars['unit_info_panel']->value;?>


</div><!-- /.container -->

<div class="container">

<br /><br />

<div id="search">
	Search Occupations
	<img src="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
assets/images/bt-search.jpg" alt="Search" />
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
            <?php echo $_smarty_tpl->tpl_vars['jobs']->value;?>

            </table>
            </div>
            </div>


<br /><br />
</div>

<hr>

<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
