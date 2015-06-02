<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-02 20:36:31
         compiled from "application\views\templates\home\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7341556cbdb195cf64-35106421%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e18a1efd56e0bb5e1b1464a2c5a2c1716798b31' => 
    array (
      0 => 'application\\views\\templates\\home\\header.tpl',
      1 => 1433270186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7341556cbdb195cf64-35106421',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556cbdb199c0b4_21146703',
  'variables' => 
  array (
    'title' => 0,
    'name' => 0,
    'css' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556cbdb199c0b4_21146703')) {function content_556cbdb199c0b4_21146703($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? 'Eduity' : $tmp);?>
 - <?php echo (($tmp = @$_smarty_tpl->tpl_vars['name']->value)===null||$tmp==='' ? 'Workforce Planning' : $tmp);?>
</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="assets/css/font-lineicons.css" type="text/css" media="all" />
    <link rel="stylesheet" href="assets/css/animate.css" type="text/css" media="all" />
    <link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all" />
    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['css']->value)===null||$tmp==='' ? '' : $tmp);?>

    <!--[if lt IE 9]>
        <?php echo '<script'; ?>
 src="assets/js/html5.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/js/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
</head>

<body id="landing-page">

    <!-- Preloader -->
    <div id="mask">
        <div id="loader"></div>
    </div>
        
    <header>
        <nav class="navigation navigation-header">
            <div class="container">
                <div class="navigation-brand">
                    <div class="brand-logo">
						<a href="index.html" class="logo"></a>
						<span class="sr-only">eduity</span>
                    </div>
                    <button class="navigation-toggle visible-xs" type="button" data-toggle="dropdown" data-target=".navigation-navbar">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navigation-navbar">
                    <ul class="navigation-bar navigation-bar-left">
                        <li class="active"><a href="#hero">Home</a></li>
                        <li><a href="#process">Overview</a></li>
                        <li><a href="#levels">Levels</a></li>
						<!--<li><a href="#feedback">Testimonials</a></li>-->
						<li><a href="#team">About</a></li>
						<li><a href="#newsletter">Follow Us</a></li>
						<li><a href="<?php echo $_smarty_tpl->getConfigVariable('base_url');?>
blog">Blog</a></li>
                    </ul>
                    <ul class="navigation-bar navigation-bar-right">
                        <li><a href="<?php echo $_smarty_tpl->getConfigVariable('base_url');?>
login">Login</a></li>
                        <!--<li class="featured"><a href="register.html">Sign up</a></li>-->
                    </ul>  
                </div>
            </div>
        </nav>
    </header><?php }} ?>
