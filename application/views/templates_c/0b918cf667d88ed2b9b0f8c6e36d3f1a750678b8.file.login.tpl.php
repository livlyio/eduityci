<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-30 16:28:46
         compiled from "application\views\templates\home\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2348855411ef30e82c5-84409918%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b918cf667d88ed2b9b0f8c6e36d3f1a750678b8' => 
    array (
      0 => 'application\\views\\templates\\home\\login.tpl',
      1 => 1430404123,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2348855411ef30e82c5-84409918',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55411ef31aacd0_37327324',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55411ef31aacd0_37327324')) {function content_55411ef31aacd0_37327324($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("home/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


    <div id="hero" class="static-header clearfix">
    <div class="container">
    <div class="row">
        <div class="text-heading col-sm-6" style="margin-top:100px;">
        <form class="form-signin panel" method="post" action="<?php echo $_smarty_tpl->getConfigVariable('base_url');?>
/auth/login">	
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="form-control" placeholder="Username" name="login_identity" id="identity" autofocus />
        <input type="password" class="form-control" placeholder="Password" name="login_password" id="password" />
        <label class="checkbox">
        <input type="checkbox" id="remember_me" name="remember_me" value="1" />Remember Me
        </label>
        <button class="btn btn-lg btn-primary btn-block" name="login_user" id="submit" value="Submit" type="submit">Sign in</button>
      </form>
         
            	<ul class="list-inline">
                	<li><a href="<?php echo '<?php'; ?>
 echo base_url('user/register'); <?php echo '?>'; ?>
" class="btn btn-primary animated hiding" data-animation="bounceIn" data-delay="700">Get started</a></li>
				</ul>
        </div>
        <div class="main-image">
            
                <img src="assets/img/features/lady.png" alt="video" class="img-responsive animated hiding" data-animation="fadeInRight" data-delay="1000" />

        </div>
    </div>
    </div>
    </div>
  
<?php echo $_smarty_tpl->getSubTemplate ("home/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
