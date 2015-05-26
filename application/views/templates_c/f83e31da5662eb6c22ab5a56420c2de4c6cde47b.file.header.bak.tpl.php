<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-25 04:43:34
         compiled from "application\views\templates\user\header.bak.tpl" */ ?>
<?php /*%%SmartyHeaderCode:222155628c5660af17-90714877%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f83e31da5662eb6c22ab5a56420c2de4c6cde47b' => 
    array (
      0 => 'application\\views\\templates\\user\\header.bak.tpl',
      1 => 1432477277,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '222155628c5660af17-90714877',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'name' => 0,
    'css' => 0,
    'navigation' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55628c566a96c6_17704704',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55628c566a96c6_17704704')) {function content_55628c566a96c6_17704704($_smarty_tpl) {?><!DOCTYPE html>
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
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<?php echo '<script'; ?>
 src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"><?php echo '</script'; ?>
>

        <?php echo '<script'; ?>
 src="<?php echo @constant('HTTP_JS_PATH');?>
jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo @constant('HTTP_JS_PATH');?>
jquery.mockjax.js"><?php echo '</script'; ?>
>

        <link href="http://vitalets.github.io/x-editable/assets/bootstrap300/css/bootstrap.css" rel="stylesheet">
        <?php echo '<script'; ?>
 src="./X-editable Demo_files/bootstrap.js"><?php echo '</script'; ?>
>

        <!-- bootstrap-datetimepicker -->
   <!--     <link href="http://vitalets.github.io/x-editable/assets/bootstrap-datetimepicker/css/datetimepicker.css" rel="stylesheet">
        <?php echo '<script'; ?>
 src="./X-editable Demo_files/bootstrap-datetimepicker.js"><?php echo '</script'; ?>
>                  -->
        
        <!-- x-editable (bootstrap 3) -->
        <link href="http://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
          <?php echo '<script'; ?>
>var base_url = ‘<?php echo @constant('BASE_URL');?>
’; 
          var base_url = ‘<?php echo @constant('BASE_URL');?>
’;<?php echo '</script'; ?>
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

<link href="http://localhost/assets/jquery/jquery-ui-1.11.2/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="http://localhost/assets/flexigrid/css/flexigrid.css" rel="stylesheet" type="text/css" />

<?php echo '<script'; ?>
 type="text/javascript" src="http://localhost/assets/jquery/jquery-1.11.2.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="http://localhost/assets/jquery/jquery-migrate-1.2.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="http://localhost/assets/jquery/jquery-ui-1.11.2/jquery-ui.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="http://localhost/assets/flexigrid/js/flexigrid.js"><?php echo '</script'; ?>
>

<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }



	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#flex-body{
		margin: 0px 20px 0 20px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#flex-container{
		margin: 20px;
	
	}
    .panel{
        float: left;
        width: 500px;
        height: 303px;
    }
    
    .ul.column1 {
        
    }
    

</style>

                   
    <!-- Bootstrap core CSS -->
    <link href="<?php echo @constant('HTTP_CSS_PATH');?>
bootstrap.css" rel="stylesheet" />
    <?php echo '<script'; ?>
 src="<?php echo @constant('HTTP_JS_PATH');?>
bootstrap.js"><?php echo '</script'; ?>
>
    
     	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo @constant('HTTP_JS_PATH');?>
ajax-search-suggest.js"><?php echo '</script'; ?>
>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo @constant('HTTP_CSS_PATH');?>
search.css" />
	<link href="http://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet" type="text/css" />   
  </head>
<body>
<?php echo $_smarty_tpl->tpl_vars['navigation']->value;?>

<?php }} ?>
