<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{$smarty.const.HTTP_CSS_PATH}favicon.png">
    <title>{$title} - {$name}</title>

    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
          <script>var base_url = ‘{$smarty.const.BASE_URL}’; 
          var base_url = ‘{$smarty.const.BASE_URL}’;</script>
    <!--[if lt IE 9]>
      <script src="{$smarty.const.HTTP_JS_PATH}html5shiv.js"></script>
      <script src="{$smarty.const.HTTP_JS_PATH}respond.min.js"></script>
    <![endif]-->
     <link href="{$smarty.const.HTTP_CSS_PATH}fam-icons.css" rel="stylesheet" />
    {$css|default:''}
    <script type="text/javascript" src="{$smarty.const.HTTP_JS_PATH}jquery.js"></script>
    <script type="text/javascript" src="{$smarty.const.HTTP_JS_PATH}jquery-ui.js"></script>
    <link href="{$smarty.const.HTTP_CSS_PATH}jquery-ui.css" rel="stylesheet" type="text/css" />

<link href="http://localhost/assets/jquery/jquery-ui-1.11.2/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="http://localhost/assets/flexigrid/css/flexigrid.css" rel="stylesheet" type="text/css" />
{literal}
<script type="text/javascript" src="http://localhost/assets/jquery/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="http://localhost/assets/jquery/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://localhost/assets/jquery/jquery-ui-1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://localhost/assets/flexigrid/js/flexigrid.js"></script>

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

</style>
{/literal}
                   
    <!-- Bootstrap core CSS -->
    <link href="{$smarty.const.HTTP_CSS_PATH}bootstrap.css" rel="stylesheet" />
    <script src="{$smarty.const.HTTP_JS_PATH}bootstrap.js"></script>
    
     	<script type="text/javascript" src="{$smarty.const.HTTP_JS_PATH}ajax-search-suggest.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="{$smarty.const.HTTP_CSS_PATH}search.css" />
	<link href="http://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet" type="text/css" />   
  </head>
<body>
{$navigation}
