<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-30 20:32:28
         compiled from "application\views\templates\user\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3515553a93ec298723-01882159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '025ad281a5261598669cd6d5f998e2d21cc93ab0' => 
    array (
      0 => 'application\\views\\templates\\user\\header.tpl',
      1 => 1430418744,
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
    'navigation' => 0,
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
 src="<?php echo @constant('HTTP_JS_PATH');?>
respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
     <link href="<?php echo @constant('HTTP_CSS_PATH');?>
fam-icons.css" rel="stylesheet" />
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
});
<?php echo '</script'; ?>
>
            
    <!-- Bootstrap core CSS -->
    <link href="<?php echo @constant('HTTP_CSS_PATH');?>
bootstrap.css" rel="stylesheet" />
    <?php echo '<script'; ?>
 src="<?php echo @constant('HTTP_JS_PATH');?>
bootstrap.js"><?php echo '</script'; ?>
>
  </head>
<body>
<?php echo $_smarty_tpl->tpl_vars['navigation']->value;?>

<?php }} ?>
