<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-03 04:01:06
         compiled from "application\views\templates\user\sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16408556c78eba415a2-84078415%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1198ca3438919eb47039c61a87442994636fd601' => 
    array (
      0 => 'application\\views\\templates\\user\\sidebar.tpl',
      1 => 1433296864,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16408556c78eba415a2-84078415',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556c78ebae0512_96324869',
  'variables' => 
  array (
    'user_name' => 0,
    'user_full_name' => 0,
    'ngroup' => 0,
    'orgs' => 0,
    'org' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556c78ebae0512_96324869')) {function content_556c78ebae0512_96324869($_smarty_tpl) {?>      <!-- =============================================== -->

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
              <p><a href="<?php echo base_url('profile');?>
/<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['user_full_name']->value;?>
</a></p>

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
"><i class="fa fa-home"></i>Home</a></li>
              <li><a href="<?php echo base_url('user/dashboard/timeline');?>
"><i class="fa fa-clock-o"></i>Timeline</a></li>
                <li><a href="<?php echo base_url('account/personal-settings');?>
"><i class="fa fa-cogs"></i>Settings</a></li>
              </ul>
            </li>
            <li class=" <?php if (isset($_smarty_tpl->tpl_vars['ngroup']->value)&&$_smarty_tpl->tpl_vars['ngroup']->value=='orgn') {?>active<?php }?> treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Organization</span>
                <span class="label label-primary pull-right"><?php echo count($_smarty_tpl->tpl_vars['orgs']->value);?>
</span>
              </a>
              <ul class="treeview-menu">
              <?php if ($_smarty_tpl->tpl_vars['orgs']->value!=false) {?>
              <?php  $_smarty_tpl->tpl_vars['org'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['org']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['orgs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['org']->key => $_smarty_tpl->tpl_vars['org']->value) {
$_smarty_tpl->tpl_vars['org']->_loop = true;
?>
              <li><a href="<?php echo base_url('user/organization/view');?>
/<?php echo $_smarty_tpl->tpl_vars['org']->value['resource'];?>
">
              <i class="fa fa-sitemap"></i><?php echo $_smarty_tpl->tpl_vars['org']->value['name'];?>
</a></li>
              <?php } ?>
              <?php }?>
              <li><a href="<?php echo base_url('user/organization/create');?>
"><i class="fa fa-plus-square"></i>Create Organization</a></li>  
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
                <a href="<?php echo base_url('user/dashboard/calendar');?>
">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('user/dashboard/mailbox');?>
">
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
