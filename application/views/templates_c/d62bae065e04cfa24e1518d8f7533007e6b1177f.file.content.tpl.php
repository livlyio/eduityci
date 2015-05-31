<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-31 07:48:16
         compiled from "application\views\templates\user\content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13502556a2f87b02f96-12885747%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd62bae065e04cfa24e1518d8f7533007e6b1177f' => 
    array (
      0 => 'application\\views\\templates\\user\\content.tpl',
      1 => 1433051277,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13502556a2f87b02f96-12885747',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556a2f87b461d3_41875948',
  'variables' => 
  array (
    'topnav' => 0,
    'sidebar' => 0,
    'page_title' => 0,
    'page_sub_title' => 0,
    'crumbs' => 0,
    'heading' => 0,
    'box_title' => 0,
    'page_content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556a2f87b461d3_41875948')) {function content_556a2f87b461d3_41875948($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


<?php echo $_smarty_tpl->tpl_vars['topnav']->value;?>


<?php echo $_smarty_tpl->tpl_vars['sidebar']->value;?>


      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo (($tmp = @$_smarty_tpl->tpl_vars['page_title']->value)===null||$tmp==='' ? '' : $tmp);?>

            <small><?php echo (($tmp = @$_smarty_tpl->tpl_vars['page_sub_title']->value)===null||$tmp==='' ? '' : $tmp);?>
</small>
          </h1>
          <ol class="breadcrumb">
          <?php if (isset($_smarty_tpl->tpl_vars['crumbs']->value)) {?><small><?php echo $_smarty_tpl->tpl_vars['crumbs']->value;?>
</small><?php }?>
          <br />
          <?php if (isset($_smarty_tpl->tpl_vars['heading']->value)) {?><h1><small><?php echo $_smarty_tpl->tpl_vars['heading']->value;?>
</small></h1><?php }?>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['box_title']->value)===null||$tmp==='' ? '' : $tmp);?>
</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <?php echo $_smarty_tpl->tpl_vars['page_content']->value;?>

            </div><!-- /.box-body -->

      
<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
