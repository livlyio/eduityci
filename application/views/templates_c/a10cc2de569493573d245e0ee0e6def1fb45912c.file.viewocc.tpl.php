<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-26 21:46:12
         compiled from "application\views\templates\user\viewocc.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13066554faead205930-13992912%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a10cc2de569493573d245e0ee0e6def1fb45912c' => 
    array (
      0 => 'application\\views\\templates\\user\\viewocc.tpl',
      1 => 1432669457,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13066554faead205930-13992912',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_554faead490116_65860676',
  'variables' => 
  array (
    'org_name' => 0,
    'crumbs' => 0,
    'heading' => 0,
    'occ_info_panel' => 0,
    'generic_info_panel' => 0,
    'tabcontent' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554faead490116_65860676')) {function content_554faead490116_65860676($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


<div class="page-header container">
    <h1><small><?php echo $_smarty_tpl->tpl_vars['org_name']->value;?>
</small></h1>
    <?php if (isset($_smarty_tpl->tpl_vars['crumbs']->value)) {?><small><?php echo $_smarty_tpl->tpl_vars['crumbs']->value;?>
</small><?php }?>
    <br />
    <?php if (isset($_smarty_tpl->tpl_vars['heading']->value)) {?><h1><small><?php echo $_smarty_tpl->tpl_vars['heading']->value;?>
</small></h1><?php }?>
</div>

<div class="container">

    <?php echo $_smarty_tpl->tpl_vars['occ_info_panel']->value;?>


     <?php echo $_smarty_tpl->tpl_vars['generic_info_panel']->value;?>


</div><!-- /.container -->
<div class="container" style="margin:10px; margin-left:100px; padding: 10px; width:90%;">

<br /><br />

<div id="tabs">
    <ul class="nav nav-tabs" id="prodTabs">
 <li> <a href="#" id="link_activities">Activities</a></li>
<li><a href="#" id="link_knowledge">Knowledge</a></li>
 <li><a href="#" id="link_context">Context</a></li>
   <li><a href="#" id="link_values">Values</a></li>
<li><a href="#" id="link_skills">Skills</a></li>
    </ul>
    <div class="tab-content">
    <div id="tabcontent" class="tab-pane active"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['tabcontent']->value)===null||$tmp==='' ? '' : $tmp);?>
</div>

    </div>
</div>
</div>

<hr>

<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
