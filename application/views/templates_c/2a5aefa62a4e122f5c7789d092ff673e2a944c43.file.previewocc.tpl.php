<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-31 11:24:43
         compiled from "application\views\templates\user\organization\previewocc.tpl" */ ?>
<?php /*%%SmartyHeaderCode:767556ad35b4b3347-19462982%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a5aefa62a4e122f5c7789d092ff673e2a944c43' => 
    array (
      0 => 'application\\views\\templates\\user\\organization\\previewocc.tpl',
      1 => 1433063681,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '767556ad35b4b3347-19462982',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'occ_info_panel' => 0,
    'generic_info_panel' => 0,
    'tabcontent' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556ad35b506815_26801862',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556ad35b506815_26801862')) {function content_556ad35b506815_26801862($_smarty_tpl) {?>

<div class="container">

    <?php echo $_smarty_tpl->tpl_vars['occ_info_panel']->value;?>


     <?php echo $_smarty_tpl->tpl_vars['generic_info_panel']->value;?>


</div><!-- /.container -->
<div class="container" style="margin:10px; margin-left:100px; padding: 10px; width:90%;">

<br /><br />

<!--<div id="tabs">
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
</div>-->

<hr>


<?php }} ?>
