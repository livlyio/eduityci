<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-30 21:59:30
         compiled from "application\views\templates\home\support.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19919554288a9445040-24392265%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53ae0c1f6e8e7d5d7c547ed5dc4c75b1527c2c4c' => 
    array (
      0 => 'application\\views\\templates\\home\\support.tpl',
      1 => 1430423962,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19919554288a9445040-24392265',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_554288a94e9f83_95848241',
  'variables' => 
  array (
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554288a94e9f83_95848241')) {function content_554288a94e9f83_95848241($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("home/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


	<section id="login" class="section dark">
        <div class="container">
            <div class="section-header animated hiding col-sm-8 col-sm-offset-2" data-animation="fadeInDown">
            <h2>Access Error</h2>
            <p>The following message was generated: <?php echo (($tmp = @$_smarty_tpl->tpl_vars['message']->value)===null||$tmp==='' ? 'page_content' : $tmp);?>
</p> 
            <p>A system administrator has been alerted.  If you need additional help, please fill out the form below to contact us.</p>    
                </div>


        </div>
    </section>
  

<?php echo $_smarty_tpl->getSubTemplate ("home/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
