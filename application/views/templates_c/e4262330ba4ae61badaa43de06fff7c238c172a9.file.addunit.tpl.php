<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-30 22:27:28
         compiled from "application\views\templates\user\addunit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1595055414f50777717-63912903%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4262330ba4ae61badaa43de06fff7c238c172a9' => 
    array (
      0 => 'application\\views\\templates\\user\\addunit.tpl',
      1 => 1430425646,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1595055414f50777717-63912903',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55414f50835da1_11733374',
  'variables' => 
  array (
    'org_name' => 0,
    'org_id' => 0,
    'parents' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55414f50835da1_11733374')) {function content_55414f50835da1_11733374($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


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

    <div class="panel" style="width:800px; height:400px;">
        <!-- Default panel contents -->
        <div class="panel-heading">Add Unit</div>
        <div class="panel-body">
        <form method="post" action="<?php echo @constant('BASE_URL');?>
/user/organization/add_unit/<?php echo $_smarty_tpl->tpl_vars['org_id']->value;?>
">
        <table class="table table-striped table-hover">
        <tr><td>Parent Unit:</td><td><select name="parent_id" style="width:300px;"><option value="0">Home</option> <?php echo $_smarty_tpl->tpl_vars['parents']->value;?>
</select></td></tr>
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

<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
