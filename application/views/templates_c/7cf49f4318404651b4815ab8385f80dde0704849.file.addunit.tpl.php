<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-03 07:32:24
         compiled from "application\views\templates\user\organization\addunit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23974556d98e886b426-82659070%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7cf49f4318404651b4815ab8385f80dde0704849' => 
    array (
      0 => 'application\\views\\templates\\user\\organization\\addunit.tpl',
      1 => 1433309410,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23974556d98e886b426-82659070',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556d98e893c6f2_75738332',
  'variables' => 
  array (
    'org_name' => 0,
    'crumbs' => 0,
    'query_str' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556d98e893c6f2_75738332')) {function content_556d98e893c6f2_75738332($_smarty_tpl) {?>

<div class="page-header container">
    <h1><small><?php echo $_smarty_tpl->tpl_vars['org_name']->value;?>
</small></h1>
    <small><?php echo $_smarty_tpl->tpl_vars['crumbs']->value;?>
 &gt; Create Unit</small>
</div>
<div class="container">

    <div class="panel" style="width:800px; height:400px;">
        <!-- Default panel contents -->
        <div class="panel-heading">Add Unit</div>
        <div class="panel-body">
        <form method="post" action="<?php echo @constant('BASE_URL');?>
/user/organization/add_unit/<?php echo $_smarty_tpl->tpl_vars['query_str']->value;?>
">
        <table class="table table-striped table-hover">
        <tr><td>Parent Unit:</td><td> <?php echo $_smarty_tpl->tpl_vars['crumbs']->value;?>
</td></tr>
        <tr><td>Name:</td><td><input type="text" name="unit_title" size="50" /></td></tr>
        <tr><td>Description:</td><td><textarea rows="4" cols="50" name="unit_desc"></textarea></td></tr>
        <tr><td>Location:</td><td><input type="text" name="unit_location" size="50" /></td></tr>
        <tr><td>Website:</td><td><input type="text" name="unit_website" size="50" /></td></tr>
        <tr><td></td><td><input type="submit" name="add_unit" /></td></tr>
        </table>
        
        </div>
    </div>

  
</div>
<hr>
<?php }} ?>
