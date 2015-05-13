<?php

/**
 * $Fields
 * Form field elements
 * Array => title, size, value, name
 * 
 * $Post
 * Post URL
 * 
 * $Title 
 * Form Title
 * 
 * 
 * */
?>


<div class="container">

        <form method="post" action="<?php echo $post; ?>">
        <div class="panel-heading"><?php echo $title; ?></div>
        <div class="panel-body">
        <table class="table table-striped table-hover">
        <?php
        foreach ($fields as $field) {
            $size = $field['size'] ?: '50';
            if (isset($field['type'])) { $type = $field['type']; } else { $type = 'text'; }
            
            switch ($type) {
            case 'textbox':
            echo '<tr><td>'. $field['title'] .'</td><td><textarea name="'. $field['name'] .'" cols="50" rows="'. $size .'">'. $field['value'] .'</textarea></td></tr>';            
            break;    
                
            default:
            echo '<tr><td>'. $field['title'] .'</td><td><input type="text" size="'. $size .'" value="'. $field['value'] .'" name="'. $field['name'] .'" /> </td></tr>';      
            break;    
            }
        }
        ?>
        <tr><td><input type="submit" class="btn btn-success" value="Save Edits" name="save_edits" /></td><td></td></tr>
        </table>
        </form>
        </div>
  


<br /><br /><br /><br />
</div>