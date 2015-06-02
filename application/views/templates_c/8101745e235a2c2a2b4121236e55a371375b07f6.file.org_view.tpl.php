<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 17:23:23
         compiled from "application\views\templates\user\organization\org_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25994556c78eb8da2a2-68702702%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8101745e235a2c2a2b4121236e55a371375b07f6' => 
    array (
      0 => 'application\\views\\templates\\user\\organization\\org_view.tpl',
      1 => 1433051019,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25994556c78eb8da2a2-68702702',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info_panel' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556c78eb936146_55761238',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556c78eb936146_55761238')) {function content_556c78eb936146_55761238($_smarty_tpl) {?>

<div class="container">

<?php echo (($tmp = @$_smarty_tpl->tpl_vars['info_panel']->value)===null||$tmp==='' ? '' : $tmp);?>


</div>

<div class="container">

<?php echo (($tmp = @$_smarty_tpl->tpl_vars['content']->value)===null||$tmp==='' ? 'No Content Defined.' : $tmp);?>


</div>

<hr />


<?php }} ?>
