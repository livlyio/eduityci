<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-31 09:46:06
         compiled from "application\views\templates\user\organization\org_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5492556abc3e2f7294-97585626%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '5492556abc3e2f7294-97585626',
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
  'unifunc' => 'content_556abc3e35e421_36671165',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556abc3e35e421_36671165')) {function content_556abc3e35e421_36671165($_smarty_tpl) {?>

<div class="container">

<?php echo (($tmp = @$_smarty_tpl->tpl_vars['info_panel']->value)===null||$tmp==='' ? '' : $tmp);?>


</div>

<div class="container">

<?php echo (($tmp = @$_smarty_tpl->tpl_vars['content']->value)===null||$tmp==='' ? 'No Content Defined.' : $tmp);?>


</div>

<hr />


<?php }} ?>
