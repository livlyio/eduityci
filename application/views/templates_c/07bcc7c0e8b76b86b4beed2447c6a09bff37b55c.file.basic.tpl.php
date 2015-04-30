<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-28 20:53:48
         compiled from "application\views\templates\home\basic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14500553f9a43454995-29386492%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '07bcc7c0e8b76b86b4beed2447c6a09bff37b55c' => 
    array (
      0 => 'application\\views\\templates\\home\\basic.tpl',
      1 => 1430247226,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14500553f9a43454995-29386492',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_553f9a434be976_42404300',
  'variables' => 
  array (
    'page_content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553f9a434be976_42404300')) {function content_553f9a434be976_42404300($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("home/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


	<section id="login" class="section dark">
        <div class="container">
            <div class="section-header animated hiding col-sm-8 col-sm-offset-2" data-animation="fadeInDown">
            
			     <?php echo (($tmp = @$_smarty_tpl->tpl_vars['page_content']->value)===null||$tmp==='' ? 'page_content' : $tmp);?>

            
                </div>


        </div>
    </section>
  

<?php echo $_smarty_tpl->getSubTemplate ("home/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
