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
          <script>var base_url = ‘{$smarty.const.BASE_URL}’; </script>
    <!--[if lt IE 9]>
      <script src="{$smarty.const.HTTP_JS_PATH}html5shiv.js"></script>
      <script src="{$smarty.const.HTTP_JS_PATH}respond.min.js"></script>
    <![endif]-->
     <link href="{$smarty.const.HTTP_CSS_PATH}fam-icons.css" rel="stylesheet" />
    {$css|default:''}
    <script type="text/javascript" src="{$smarty.const.HTTP_JS_PATH}jquery.js"></script>
    <script type="text/javascript" src="{$smarty.const.HTTP_JS_PATH}jquery-ui.js"></script>
    <link href="{$smarty.const.HTTP_CSS_PATH}jquery-ui.css" rel="stylesheet" type="text/css" />        
   {literal}
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
});
</script>
{/literal}            
    <!-- Bootstrap core CSS -->
    <link href="{$smarty.const.HTTP_CSS_PATH}bootstrap.css" rel="stylesheet" />
    <script src="{$smarty.const.HTTP_JS_PATH}bootstrap.js"></script>
  </head>
<body>
{$navigation}
