<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-02 09:47:37
         compiled from "application\views\templates\user\timeline.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29482556d5f99d89c67-90825761%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f8dd59b9706e625a074ccb9da2ee9e1407f36e7' => 
    array (
      0 => 'application\\views\\templates\\user\\timeline.tpl',
      1 => 1433046643,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29482556d5f99d89c67-90825761',
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
  'unifunc' => 'content_556d5f99de83a6_77473325',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556d5f99de83a6_77473325')) {function content_556d5f99de83a6_77473325($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


<?php echo $_smarty_tpl->tpl_vars['topnav']->value;?>


<?php echo $_smarty_tpl->tpl_vars['sidebar']->value;?>



     <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Timeline
            <small>example</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">UI</a></li>
            <li class="active">Timeline</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['page_content']->value)===null||$tmp==='' ? 'No Updates' : $tmp);?>

</div>
  
    
<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
