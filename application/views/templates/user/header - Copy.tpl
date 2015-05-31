<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{$smarty.const.HTTP_CSS_PATH}favicon.png" />
    <title>{$title} - {$name}</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/reset.css" type="text/css" />
 

    <!-- start -->
    {$css|default:''}
    <!-- end -->
    
   <!-- 
    <script type="text/javascript" src="{$smarty.const.HTTP_JS_PATH}jquery.js"></script>
    <script type="text/javascript" src="{$smarty.const.HTTP_JS_PATH}jquery-ui.js"></script>
    <link href="{$smarty.const.HTTP_CSS_PATH}jquery-ui.css" rel="stylesheet" type="text/css" />    

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
          <script>var base_url = ‘{$smarty.const.BASE_URL}’; 
          var base_url = ‘{$smarty.const.BASE_URL}’;</script>
    <!--[if lt IE 9]>
      <script src="{$smarty.const.HTTP_JS_PATH}html5shiv.js"></script>
      <script src="{$smarty.const.HTTP_JS_PATH}respond.min.js"></script>
    <![endif]-->

   <link href="{$smarty.const.HTTP_CSS_PATH}bs3/bootstrap.css" rel="stylesheet" /> 
 
    <!-- bootstrap -->
   <!-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>  
-->

<link href="{$smarty.const.HTTP_CSS_PATH}starter-template.css" rel="stylesheet" /> 
    
{literal}
<style type="text/css">
body {
    font-size:16px;
}
ol, ul {
	list-style: none;
}

.sortable-item {
    list-style-type:none;
    
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $.fn.editable.defaults.mode = 'inline';     
    
    $('.fc6mo').editable( {
        type: 'text'
        ,send: 'always'
        ,url: {/literal}{$update|default:''}{literal}
    });
    
    $('.fc12mo').editable( {
        type: 'text'
        ,send: 'always'
        ,url: {/literal}{$update|default:''}{literal}
    }); 
    
    $('.fc18mo').editable( {
        type: 'text'
        ,send: 'always'
        ,url: {/literal}{$update|default:''}{literal}
    });   
    
    $('.fc24mo').editable( {
        type: 'text'
        ,send: 'always'
        ,url: {/literal}{$update|default:''}{literal}
    });  
    
    $('.fc36mo').editable( {
        type: 'text'
        ,send: 'always'
        ,url: {/literal}{$update|default:''}{literal}
    }); 
    
    $('.fc48mo').editable( {
        type: 'text'
        ,send: 'always'
        ,url: {/literal}{$update|default:''}{literal}
    });   
    
    $('.fc60mo').editable( {
        type: 'text'
        ,send: 'always'
        ,url: {/literal}{$update|default:''}{literal}
    });      
      
    
 } );

</script>  
{/literal}
       
       
 
     	<script type="text/javascript" src="{$smarty.const.HTTP_JS_PATH}ajax-search-suggest.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="{$smarty.const.HTTP_CSS_PATH}search.css" />
	<link href="http://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet" type="text/css" />   
  </head>
<body>
{$navigation}


<script type="text/javascript">
	$('.out img').mouseover
	(
		function()
		{
			$(this).attr('src','{$smarty.const.HTTP_CSS_PATH}../../images/out.gif');
		}
	);
	$('.out img').mouseout
	(
		function()
		{
			$(this).attr('src','{$smarty.const.HTTP_CSS_PATH}../../images/out-normal.png');
			//$(this).attr('width','28');
		}
	);
</script>