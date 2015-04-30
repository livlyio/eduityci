    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <a class="navbar-brand" href="{#BASE_URL#}">Eduity User Panel</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php if ($pg =='dash') echo 'class="active"'; ?>><a href="<?php echo $base .'user/dashboard'; ?>">Dashboard</a></li>
            <li <?php if ($pg =='users') echo 'class="active"'; ?>><a href="<?php echo $base .'user/dashboard/users'; ?>">Users</a></li>
            <?php echo $org_menu; ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $base .'auth/chgpass'; ?>">Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo $base .'auth/logout'; ?>">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>