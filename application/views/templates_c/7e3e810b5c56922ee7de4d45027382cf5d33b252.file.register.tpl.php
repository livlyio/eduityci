<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-31 12:44:10
         compiled from "application\views\templates\home\register.tpl" */ ?>
<?php /*%%SmartyHeaderCode:284365565e5265a2626-90706194%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e3e810b5c56922ee7de4d45027382cf5d33b252' => 
    array (
      0 => 'application\\views\\templates\\home\\register.tpl',
      1 => 1433002654,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '284365565e5265a2626-90706194',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5565e526641ea8_53227769',
  'variables' => 
  array (
    'message' => 0,
    'page_content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5565e526641ea8_53227769')) {function content_5565e526641ea8_53227769($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("home/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>



	<section id="team" class="section dark">
        <div class="container">
            <div class="section-header animated hiding col-sm-8 col-sm-offset-2" data-animation="fadeInDown">
                <h2><span class="highlight">Account Registration</span></h2>
                <?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?>
                <div class="subheading">
                <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                </div>
                </div>
                <?php }?>
				<div class="sub-heading">
                    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['page_content']->value)===null||$tmp==='' ? 'No Content Defined.' : $tmp);?>

                </div>




</div> 

</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("home/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
