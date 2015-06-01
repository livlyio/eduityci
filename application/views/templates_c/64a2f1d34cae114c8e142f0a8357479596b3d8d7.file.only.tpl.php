<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 09:09:37
         compiled from "application\views\templates\user\only.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20350556c0531700031-51465225%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64a2f1d34cae114c8e142f0a8357479596b3d8d7' => 
    array (
      0 => 'application\\views\\templates\\user\\only.tpl',
      1 => 1433142500,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20350556c0531700031-51465225',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'topnav' => 0,
    'sidebar' => 0,
    'page_content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556c053177d791_37378928',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556c053177d791_37378928')) {function content_556c053177d791_37378928($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


<?php echo $_smarty_tpl->tpl_vars['topnav']->value;?>


<?php echo $_smarty_tpl->tpl_vars['sidebar']->value;?>


<?php echo $_smarty_tpl->tpl_vars['page_content']->value;?>

    
<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
