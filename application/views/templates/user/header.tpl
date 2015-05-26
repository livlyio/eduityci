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

    <script type="text/javascript" src="http://johnny.github.io/jquery-sortable/js/jquery-sortable.js"></script>
    
    
    

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
          <script>var base_url = ‘{$smarty.const.BASE_URL}’; 
          var base_url = ‘{$smarty.const.BASE_URL}’;</script>
    <!--[if lt IE 9]>
      <script src="{$smarty.const.HTTP_JS_PATH}html5shiv.js"></script>
      <script src="{$smarty.const.HTTP_JS_PATH}respond.min.js"></script>
    <![endif]-->

    <link href="http://vitalets.github.io/x-editable/assets/bootstrap300/css/bootstrap.css" rel="stylesheet">
 
    <!-- bootstrap -->
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>  

    <!-- x-editable (bootstrap version) -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>

<link href="{$smarty.const.HTTP_CSS_PATH}starter-template.css" rel="stylesheet" />
    
{literal}
<style type="text/css">
body {
    font-size:18px;
}
body.dragging, body.dragging * {
  cursor: move !important;
}

.dragged {
  position: absolute;
  opacity: 0.5;
  z-index: 2000;
}

ol.example li.placeholder {
  position: relative;
  /** More li styles **/
}
ol.example li.placeholder:before {
  position: absolute;
  /** Define arrowhead **/
}

</style>
<script type="text/javascript">
$(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'popup';     
    
    //make username editable
    $('#username').editable( {
        type: 'text'
        ,send: 'always'
        ,pk: 1
        ,url: {/literal}{$update|default:''}{literal}
    });
    
    $('#least').editable( {
        type: 'text'
        ,send: 'always'
        ,url: {/literal}{$update|default:''}{literal}
    });
    
    $('#likely').editable( {
        type: 'text'
        ,send: 'always'
        ,url: {/literal}{$update|default:''}{literal}
    }); 
    
    $('#most').editable( {
        type: 'text'
        ,send: 'always'
        ,url: {/literal}{$update|default:''}{literal}
    });   
    
    $('#title').editable( {
        type: 'text'
        ,send: 'title'
        ,url: {/literal}{$update|default:''}{literal}
    });     
    
    $('#projected').editable({
        format: 'yyyy-mm-dd'
        ,viewformat: 'mm/dd/yyyy'
        ,send: 'always'
        ,url: {/literal}{$update|default:''}{literal}   
        ,datepicker: {
                weekStart: 1
           }
        });      

// Sortable rows
$('.sorted_table').sortable({
  containerSelector: 'table',
  itemPath: '> tbody',
  itemSelector: 'tr',
  placeholder: '<tr class="placeholder"/>'
})

// Sortable column heads
var oldIndex
$('.sorted_head tr').sortable({
  containerSelector: 'tr',
  itemSelector: 'th',
  placeholder: '<th class="placeholder"/>',
  vertical: false,
  onDragStart: function (item, group, _super) {
    oldIndex = item.index()
    item.appendTo(item.parent())
    _super(item)
  },
  onDrop: function  (item, container, _super) {
    var field,
    newIndex = item.index()
    
    if(newIndex != oldIndex)
      item.closest('table').find('tbody tr').each(function (i, row) {
        row = $(row)
        field = row.children().eq(oldIndex)
        if(newIndex)
          field.before(row.children()[newIndex])
        else
          row.prepend(field)
      })

    _super(item)
  }
})
    
 } );

</script>  
{/literal}
       
       
 
     	<script type="text/javascript" src="{$smarty.const.HTTP_JS_PATH}ajax-search-suggest.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="{$smarty.const.HTTP_CSS_PATH}search.css" />
	<link href="http://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet" type="text/css" />   
  </head>
<body>
{$navigation}

