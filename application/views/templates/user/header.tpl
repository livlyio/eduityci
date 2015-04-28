<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{$smarty.const.HTTP_CSS_PATH}favicon.png">
    <title>{$title} - {$name}</title>
    {$css|default:''}
        <script type="text/javascript" src="{$smarty.const.HTTP_JS_PATH}jquery.js"></script>
    <script type="text/javascript" src="{$smarty.const.HTTP_JS_PATH}jquery-ui.js"></script>
    <link href="{$smarty.const.HTTP_CSS_PATH}jquery-ui.css" rel="stylesheet" type="text/css" />        
    {literal}
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
    
    <script type="text/javascript">
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
</script>
{/literal}            
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
