<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-13 22:32:28
         compiled from "application\views\templates\user\edit-common.tpl" */ ?>
<?php /*%%SmartyHeaderCode:188655538de0990fd4-37619332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fedcb843834b98f99ab5f38ff3e1889be56c1b5d' => 
    array (
      0 => 'application\\views\\templates\\user\\edit-common.tpl',
      1 => 1431541881,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '188655538de0990fd4-37619332',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55538de09e0861_73181479',
  'variables' => 
  array (
    'org_name' => 0,
    'crumbs' => 0,
    'edit_form' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55538de09e0861_73181479')) {function content_55538de09e0861_73181479($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>



<div class="page-header container">
    <h1><small><?php echo $_smarty_tpl->tpl_vars['org_name']->value;?>
</small></h1>
    <small><?php echo $_smarty_tpl->tpl_vars['crumbs']->value;?>
 &gt; Edit</small>
</div>

<?php echo $_smarty_tpl->tpl_vars['edit_form']->value;?>


<hr />

<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
