<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-31 03:39:04
         compiled from "application\views\templates\user\org_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204795562d359163626-83761966%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b8a54c7d1b3ff86e5391a4d260d21c72b43a05d' => 
    array (
      0 => 'application\\views\\templates\\user\\org_view.tpl',
      1 => 1433036337,
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
    'info_panel' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5562d3591f8d49_13085961')) {function content_5562d3591f8d49_13085961($_smarty_tpl) {?>

<div class="container">

<?php echo (($tmp = @$_smarty_tpl->tpl_vars['info_panel']->value)===null||$tmp==='' ? '' : $tmp);?>


</div>

<div class="container">

<?php echo (($tmp = @$_smarty_tpl->tpl_vars['content']->value)===null||$tmp==='' ? 'No Content Defined.' : $tmp);?>


</div>

<hr />


<?php }} ?>
