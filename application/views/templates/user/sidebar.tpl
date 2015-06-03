      <!-- =============================================== -->

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
              <p><a href="{base_url('profile')}/{$user_name}">{$user_full_name}</a></p>

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
            <li class=" {if isset($ngroup) && $ngroup == 'dash'}active{/if} treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="{base_url('user/dashboard')}"><i class="fa fa-home"></i>Home</a></li>
              <li><a href="{base_url('user/dashboard/timeline')}"><i class="fa fa-clock-o"></i>Timeline</a></li>
                <li><a href="{base_url('account/personal-settings')}"><i class="fa fa-cogs"></i>Settings</a></li>
              </ul>
            </li>
            <li class=" {if isset($ngroup) && $ngroup == 'orgn'}active{/if} treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Organization</span>
                <span class="label label-primary pull-right">{count($orgs)}</span>
              </a>
              <ul class="treeview-menu">
              {if $orgs != false}
              {foreach from=$orgs item=org}
              <li><a href="{base_url('user/organization/view')}/{$org.resource}">
              <i class="fa fa-sitemap"></i>{$org.name}</a></li>
              {/foreach}
              {/if}
              <li><a href="{base_url('user/organization/create')}"><i class="fa fa-plus-square"></i>Create Organization</a></li>  
              </ul>
            </li>
            <li class=" {if isset($ngroup) && $ngroup == 'netw'}active{/if} treeview">
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
            <li class=" {if isset($ngroup) && $ngroup == 'reso'}active{/if} treeview">
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
                <a href="{base_url('user/dashboard/calendar')}">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="{base_url('user/dashboard/mailbox')}">
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
      </aside>