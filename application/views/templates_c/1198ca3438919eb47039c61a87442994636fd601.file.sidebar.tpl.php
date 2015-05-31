<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-31 15:46:23
         compiled from "application\views\templates\user\sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14449556a36093c31b9-84594909%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1198ca3438919eb47039c61a87442994636fd601' => 
    array (
      0 => 'application\\views\\templates\\user\\sidebar.tpl',
      1 => 1433079877,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14449556a36093c31b9-84594909',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556a36093cc538_71260904',
  'variables' => 
  array (
    'user_full_name' => 0,
    'ngroup' => 0,
    'org_menu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556a36093cc538_71260904')) {function content_556a36093cc538_71260904($_smarty_tpl) {?>      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="font-size:18px;">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="http://localhost/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $_smarty_tpl->tpl_vars['user_full_name']->value;?>
</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" style="font-size:18px;">
            <li class="header">MAIN NAVIGATION</li>
            <li class=" <?php if (isset($_smarty_tpl->tpl_vars['ngroup']->value)&&$_smarty_tpl->tpl_vars['ngroup']->value=='dash') {?>active<?php }?> treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="<?php echo base_url('user/dashboard');?>
"><i class="fa fa-clock-o"></i>Home</a></li>
              <li><a href="<?php echo base_url('user/dashboard/timeline');?>
"><i class="fa fa-clock-o"></i>Timeline</a></li>
                <li><a href="<?php echo base_url('account/personal-settings/upload');?>
"><i class="fa fa-circle-o"></i>Edit Profile</a></li>
              </ul>
            </li>
            <li class=" <?php if (isset($_smarty_tpl->tpl_vars['ngroup']->value)&&$_smarty_tpl->tpl_vars['ngroup']->value=='orgn') {?>active<?php }?> treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Organization</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
              
              <?php echo $_smarty_tpl->tpl_vars['org_menu']->value;?>

              
              <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i>Create Organization</a></li>  
              </ul>
            </li>
            <li class=" <?php if (isset($_smarty_tpl->tpl_vars['ngroup']->value)&&$_smarty_tpl->tpl_vars['ngroup']->value=='netw') {?>active<?php }?> treeview">
              <a href="#">
                <i class="fa fa-puzzle-piece"></i>
                <span>Network</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="../UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class=" <?php if (isset($_smarty_tpl->tpl_vars['ngroup']->value)&&$_smarty_tpl->tpl_vars['ngroup']->value=='reso') {?>active<?php }?> treeview">
              <a href="#">
                <i class="fa fa-graduation-cap"></i>
                <span>Resources</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="../UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li>
                <a href="../calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="../mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li>
              <a href="../widgets.html">
                <i class="fa fa-life-ring"></i> <span>Support</span> <small class="label pull-right bg-green">Hot</small>
              </a>
            </li>            

      
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside><?php }} ?>
