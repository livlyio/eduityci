<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{$smarty.const.HTTP_CSS_PATH}favicon.png">
    <title>{$title} - {$name}</title>
    <!-- Bootstrap core CSS -->
    <link href="{$smarty.const.HTTP_CSS_PATH}bootstrap.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
          <script>var base_url = ‘{$smarty.const.BASE_URL}’; </script>
    <!--[if lt IE 9]>
      <script src="{$smarty.const.HTTP_JS_PATH}html5shiv.js"></script>
      <script src="{$smarty.const.HTTP_JSS_PATH}respond.min.js"></script>
    <![endif]-->
     <link href="{$smarty.const.HTTP_CSS_PATH}fam-icons.css" rel="stylesheet">
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
          
          <a class="navbar-brand" href="{$smarty.const.BASE_URL}">Eduity User Panel</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li {if $pg=='dash'}class="active"{/if}><a href="{$smarty.const.BASE_URL}dashboard">Dashboard</a></li>
            <li {if $pg=='users'}class="active"{/if}><a href="{$smarty.const.BASE_URL}users">Users</a></li>
            <li {if $pg=='org'}class="active"{/if}><a href="{$smarty.const.BASE_URL}organization">Organization</a></li>
            <li {if $pg=='other'}class="active"{/if}><a href="{$smarty.const.BASE_URL}other">Other</a></li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Change Password</a></li>
                <li class="divider"></li>
                <li><a href="{$smarty.const.BASE_URL}home/logout">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
