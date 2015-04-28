<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-28 15:50:45
         compiled from "application\views\templates\user\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3515553a93ec298723-01882159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '025ad281a5261598669cd6d5f998e2d21cc93ab0' => 
    array (
      0 => 'application\\views\\templates\\user\\header.tpl',
      1 => 1430229037,
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
    'name' => 0,
    'css' => 0,
    'pg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553a93ec2e9d41_78939663')) {function content_553a93ec2e9d41_78939663($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo @constant('HTTP_CSS_PATH');?>
favicon.png">
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</title>
    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['css']->value)===null||$tmp==='' ? '' : $tmp);?>

        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo @constant('HTTP_JS_PATH');?>
jquery.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo @constant('HTTP_JS_PATH');?>
jquery-ui.js"><?php echo '</script'; ?>
>
    <link href="<?php echo @constant('HTTP_CSS_PATH');?>
jquery-ui.css" rel="stylesheet" type="text/css" />        
    
<style type="text/css">
.ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  float: left;
  display: none;
  min-width: 160px;
  _width: 160px;
  padding: 4px 0;
  margin: 2px 0 0 0;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
 
  .ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
 
    &.ui-state-hover, &.ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
    }
  }
}
</style>
    
    <?php echo '<script'; ?>
 type="text/javascript">
$(function(){
    var $sfield = $('#job_search').autocomplete({
        source: function(request, response){
            var url = "http://localhost/user/organization/control_areas";
              $.post(url, {data:request.term}, function(data){
                response($.map(data, function(jobs) {
                    return {
                        value: jobs.title
                    };
                }));
              }, "json");  
        },
        minLength: 2,
        autofocus: true
    });
});
<?php echo '</script'; ?>
>
            
    <!-- Bootstrap core CSS -->
    <link href="<?php echo @constant('HTTP_CSS_PATH');?>
bootstrap.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
          <?php echo '<script'; ?>
>var base_url = ‘<?php echo @constant('BASE_URL');?>
’; <?php echo '</script'; ?>
>
    <!--[if lt IE 9]>
      <?php echo '<script'; ?>
 src="<?php echo @constant('HTTP_JS_PATH');?>
html5shiv.js"><?php echo '</script'; ?>
>
      <?php echo '<script'; ?>
 src="<?php echo @constant('HTTP_JSS_PATH');?>
respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
     <link href="<?php echo @constant('HTTP_CSS_PATH');?>
fam-icons.css" rel="stylesheet">
  </head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <a class="navbar-brand" href="<?php echo @constant('BASE_URL');?>
">Eduity User Panel</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php if ($_smarty_tpl->tpl_vars['pg']->value=='dash') {?>class="active"<?php }?>><a href="<?php echo @constant('BASE_URL');?>
dashboard">Dashboard</a></li>
            <li <?php if ($_smarty_tpl->tpl_vars['pg']->value=='users') {?>class="active"<?php }?>><a href="<?php echo @constant('BASE_URL');?>
users">Users</a></li>
            <li <?php if ($_smarty_tpl->tpl_vars['pg']->value=='org') {?>class="active"<?php }?>><a href="<?php echo @constant('BASE_URL');?>
organization">Organization</a></li>
            <li <?php if ($_smarty_tpl->tpl_vars['pg']->value=='other') {?>class="active"<?php }?>><a href="<?php echo @constant('BASE_URL');?>
other">Other</a></li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo @constant('BASE_URL');?>
home/logout">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
<?php }} ?>
