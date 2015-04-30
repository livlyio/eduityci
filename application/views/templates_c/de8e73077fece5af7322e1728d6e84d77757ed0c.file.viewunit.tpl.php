<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-29 23:42:41
         compiled from "application\views\templates\user\viewunit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22124553db6bf02ce94-57713342%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de8e73077fece5af7322e1728d6e84d77757ed0c' => 
    array (
      0 => 'application\\views\\templates\\user\\viewunit.tpl',
      1 => 1430343742,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22124553db6bf02ce94-57713342',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_553db6bf0979c9_47595885',
  'variables' => 
  array (
    'org_name' => 0,
    'unit_title' => 0,
    'unit_desc' => 0,
    'unit_location' => 0,
    'website' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553db6bf0979c9_47595885')) {function content_553db6bf0979c9_47595885($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


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

    <div class="panel panel-info">
        <!-- Default panel contents -->
        <div class="panel-heading">Organizaiton Profile</div>
        <div class="panel-body">
        <table class="table table-striped table-hover">
        <tr><td>Name:</td><td><?php echo $_smarty_tpl->tpl_vars['unit_title']->value;?>
 </td></tr>
        <tr><td>Description:</td><td><?php echo $_smarty_tpl->tpl_vars['unit_desc']->value;?>
 </td></tr>
        <tr><td>Location:</td><td><?php echo $_smarty_tpl->tpl_vars['unit_location']->value;?>
 </td></tr>
        <tr><td>Website:</td><td><?php echo (($tmp = @$_smarty_tpl->tpl_vars['website']->value)===null||$tmp==='' ? '' : $tmp);?>
 </td></tr>
        </table>
        
        </div>
    </div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Panel heading</div>
        <div class="panel-body">
            <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien.</p>
        </div>
    </div>

</div><!-- /.container -->

<div class="container">

<input type="text" name="job_search" id="job_search" size="50" placeholder="Type Work Function" />
<br /><br /><br /><br />
</div>

<hr>

<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
