 <?php
 /**
  * $Options
  * Array ( 'title' => panel title
  *         'color' => blue/yellow/green/red/grey (grey is default)
  *         'width' => 'auto' or size in px '200px'
  *         'height' => 'auto' or size in px '200px'
  *         'data' => you may specify the $data variable here also)
  * $Data
  * Multidimensional array containing field names and values
  * Array ('0' => array('name' => 'Your Name', 'value' => 'John Smith'))
  * 
  * */  
 $css = '';
 
  if (in_array('data',$options)) { $data = $options['data']; }
  
    if (in_array('color',$options)) {
        switch ($options['color']) {
        case 'blue':
        $color = 'panel-info';
        $color = 'panel-primary';
        break;
        case 'yellow':
        $color = 'panel-warning';
        break;
        case 'green':
        $color = 'panel-success';
        break;
        case 'red':
        $color = 'panel-danger';
        break;
        default:
        $color = 'panel-default';
        break;
        }
    } else { $color = 'panel-info'; }
    if (in_array('width',$options)) { $css .= 'width: '. $options['width'] .' '; } 
    if (in_array('height',$options)) { $css .= 'height: '. $options['height'] .' '; }     
 ?>
 
 <div class="panel <?php echo $color; ?>" style="<?php echo $css; ?>">
        <!-- Begin Panel contents -->
        <div class="panel-heading"><?php echo $options['title']; ?></div>
        <div class="panel-body">
        <?php echo $data; ?>
        </div>
 </div>