<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-01 01:48:31
         compiled from "application\views\templates\user\editunit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:317155542bb9dc93ed9-36431270%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dce6802072664ad459e1be19756d25aaab1d1fc0' => 
    array (
      0 => 'application\\views\\templates\\user\\editunit.tpl',
      1 => 1430437680,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '317155542bb9dc93ed9-36431270',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5542bb9dd0b0a6_61884830',
  'variables' => 
  array (
    'org_name' => 0,
    'base' => 0,
    'unit_id' => 0,
    'unit_title' => 0,
    'unit_desc' => 0,
    'unit_location' => 0,
    'unit_website' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5542bb9dd0b0a6_61884830')) {function content_5542bb9dd0b0a6_61884830($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


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

        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
user/organization/edit_unit/<?php echo $_smarty_tpl->tpl_vars['unit_id']->value;?>
">
        <div class="panel-heading">Organizaiton Profile</div>
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

<hr>

<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
