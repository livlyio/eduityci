<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 12:46:39
         compiled from "application\views\templates\user\organization\editunit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10700556c380f2c4420-75957511%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ed03c8e469fe3ec11d6bfeb304b66d87a73b9f1' => 
    array (
      0 => 'application\\views\\templates\\user\\organization\\editunit.tpl',
      1 => 1433155594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10700556c380f2c4420-75957511',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'org_name' => 0,
    'crumbs' => 0,
    'base' => 0,
    'query_str' => 0,
    'unit_title' => 0,
    'unit_desc' => 0,
    'unit_location' => 0,
    'unit_website' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556c380f31d8c6_62111788',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556c380f31d8c6_62111788')) {function content_556c380f31d8c6_62111788($_smarty_tpl) {?>

<div class="page-header container">
    <h1><small><?php echo $_smarty_tpl->tpl_vars['org_name']->value;?>
</small></h1>
    <small><?php echo $_smarty_tpl->tpl_vars['crumbs']->value;?>
 &gt; Edit</small>
</div>
<div class="container">

        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
user/organization/edit_unit/<?php echo $_smarty_tpl->tpl_vars['query_str']->value;?>
">
        <div class="panel-heading">Edit Unit Profile</div>
        <div class="panel-body">
        <table class="table table-striped table-hover">
        <tr><td>Name:</td><td><input type="text" size="50" value="<?php echo $_smarty_tpl->tpl_vars['unit_title']->value;?>
" name="unit_title" /> </td></tr>
        <tr><td>Description:</td><td><textarea name="unit_desc" rows="4" cols="50"><?php echo $_smarty_tpl->tpl_vars['unit_desc']->value;?>
</textarea> </td></tr>
        <tr><td>Location:</td><td><input type="text" size="50" value="<?php echo $_smarty_tpl->tpl_vars['unit_location']->value;?>
" name="unit_location" /> </td></tr>
        <tr><td>Website:</td><td><input type="text" size="50" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['unit_website']->value)===null||$tmp==='' ? '' : $tmp);?>
" name="unit_website" /> </td></tr>
        <tr><td><input type="submit" class="btn btn-success" value="Save Edits" name="save_unit" /></td><td></td></tr>
        </table>
        </form>
        </div>
  


<br /><br /><br /><br />
</div>

<hr />
<?php }} ?>
