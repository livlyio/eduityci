<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-25 09:58:32
         compiled from "application\views\templates\user\org_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204795562d359163626-83761966%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b8a54c7d1b3ff86e5391a4d260d21c72b43a05d' => 
    array (
      0 => 'application\\views\\templates\\user\\org_view.tpl',
      1 => 1432540435,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204795562d359163626-83761966',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5562d3591f8d49_13085961',
  'variables' => 
  array (
    'org_name' => 0,
    'crumbs' => 0,
    'heading' => 0,
    'info_panel' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5562d3591f8d49_13085961')) {function content_5562d3591f8d49_13085961($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


<div class="page-header container">
    <h1><small><?php echo $_smarty_tpl->tpl_vars['org_name']->value;?>
</small></h1>
    <?php if (isset($_smarty_tpl->tpl_vars['crumbs']->value)) {?><small><?php echo $_smarty_tpl->tpl_vars['crumbs']->value;?>
</small><?php }?>
    <br />
    <?php if (isset($_smarty_tpl->tpl_vars['heading']->value)) {?><h1><small><?php echo $_smarty_tpl->tpl_vars['heading']->value;?>
</small></h1><?php }?>
</div>

<div class="container">

<?php echo (($tmp = @$_smarty_tpl->tpl_vars['info_panel']->value)===null||$tmp==='' ? '' : $tmp);?>


</div>

<div class="container">

<?php echo (($tmp = @$_smarty_tpl->tpl_vars['content']->value)===null||$tmp==='' ? 'No Content Defined.' : $tmp);?>


</div>

<hr />

<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
