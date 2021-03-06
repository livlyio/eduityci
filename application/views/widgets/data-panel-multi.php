 <?php
 /**
  * $Options
  * Array ( 'title' => panel title
  *         'color' => blue/yellow/green/red/grey (grey is default)
  *         'width' => size in px, default is auto
  *         'height' => size in px, default is auto
  *         'data' => you may specify the $data variable here also)
  * $Data
  * Multidimensional array containing field names and values
  * Array ('0' => array('name' => 'Your Name', 'value' => 'John Smith'))
  * 
  * */  
 $css = '';
 
  if (in_array('data',$options)) { $data = $options['data']; }
  
    if (isset($options['color'])) {
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

 if (isset($options['width'])) { $css .= 'width: '. $options['width'] .'; height: auto;'; }
 else { $css .= 'width: 800; height: auto;'; }
 ?>
 
 <div class="panel <?php echo $color; ?>" style="<?php echo $css; ?>">
        <!-- Begin Panel contents -->
        <div class="panel-heading"><?php echo $options['title']; ?></div>
        <div class="panel-body">
        <table class="table table-striped table-hover">
        <?php
        foreach ($data as $value) {
            echo "<tr><td style='width: 180px;'>". $value['name'] ."</td><td>". $value['value'] ."</td></tr>";
        }
        if (isset($buttons)) { echo $buttons; }
        ?>
        </table>
        </div>
        <!-- End Panel Contents -->
        </div>
        
