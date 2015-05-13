<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-13 20:21:55
         compiled from "application\views\templates\user\orghome.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26479553ae149b053e8-03963172%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e9996fd78d31906fbf31ac9e1a5a45b794ffbbd' => 
    array (
      0 => 'application\\views\\templates\\user\\orghome.tpl',
      1 => 1431541313,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26479553ae149b053e8-03963172',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_553ae149cc18c9_99736113',
  'variables' => 
  array (
    'org_name' => 0,
    'org_info_panel' => 0,
    'query_str' => 0,
    'map' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553ae149cc18c9_99736113')) {function content_553ae149cc18c9_99736113($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


<link href="<?php echo '<?php'; ?>
 echo HTTP_CSS_PATH; <?php echo '?>'; ?>
starter-template.css" rel="stylesheet">
<style>
    .panel{
        margin-left: 55px;
        float: left;
        width: 500px;
        height: 303px;
    }

</style>


<div class="page-header container">
    <h1><small><?php echo $_smarty_tpl->tpl_vars['org_name']->value;?>
 </small></h1>
</div>
<div class="container">

    <?php echo $_smarty_tpl->tpl_vars['org_info_panel']->value;?>



</div><!-- /.container -->

<div class="container">

	<div class="smap">
		
		<h1>Organizational Map</h1>
	
		<ul id="utilityNav">
			<li><a href="<?php echo @constant('BASE_URL');?>
/user/organization/add_unit/<?php echo $_smarty_tpl->tpl_vars['query_str']->value;?>
">Add Unit</a></li>
			<li><a href="/login">Reorder Units</a></li>
		</ul>

		<ul id="primaryNav" class="col4">
			<li id="home"><a href="#"><?php echo $_smarty_tpl->tpl_vars['org_name']->value;?>
</a></li>
		<?php echo $_smarty_tpl->tpl_vars['map']->value;?>
	
		</ul>

	</div>

</div>

<hr>

<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
