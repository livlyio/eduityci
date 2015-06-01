<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 09:33:00
         compiled from "application\views\templates\user\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3515553a93ec298723-01882159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '025ad281a5261598669cd6d5f998e2d21cc93ab0' => 
    array (
      0 => 'application\\views\\templates\\user\\header.tpl',
      1 => 1433143944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3515553a93ec298723-01882159',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_553a93ec2e9d41_78939663',
  'variables' => 
  array (
    'title' => 0,
    'optional' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553a93ec2e9d41_78939663')) {function content_553a93ec2e9d41_78939663($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? 'EdUity' : $tmp);?>
</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url('adminlte/bootstrap/css/bootstrap.min.css');?>
" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/slickmap.css');?>
" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/custom.css');?>
" rel="stylesheet" type="text/css" />
    <!-- jQuery 2.1.4 -->
    <?php echo '<script'; ?>
 src="<?php echo base_url('adminlte/plugins/jQuery/jQuery-2.1.4.min.js');?>
"><?php echo '</script'; ?>
>
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="http://localhost/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="http://localhost/adminlte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="http://localhost/adminlte/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['optional']->value)===null||$tmp==='' ? '' : $tmp);?>

  </head><?php }} ?>
