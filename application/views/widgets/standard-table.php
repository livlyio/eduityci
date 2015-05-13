<?php
/**
 * $Title = 'This is a title';
 * 
 * Table headings
 * $THead['0']['width'] = '100px';
 * $THead['0']['title'] = 'Name';
 * $THead['0']['key'] = 'first_name';
 * 
 * Array of MySQL data to display
 * $TBody = Data Array 
 *  
 * Select specific columns to only be displayed on the table
 * $TCols = Array('name', 'address', 'ph_number');
 * 
 * */
 
 
?>



<div class="container">
 
 <div class="panel-default" style="width: auto; height:auto; position: -40px">
        <!-- Default panel contents -->
        <div class="panel-heading"><?php echo $title; ?> <span style='float:right; margin-top: -7px;'></span></div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
            <?php foreach ($thead as $th) {
                $cols = count($thead);
                //if (isset($th['width'])) { $thw = $th['width']; }
                $thw = ' width: '. $th['width'] ?: '';
                echo "<th". $thw .">". $th['title'] ."</th>";
            }
            ?>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 0;
            foreach ($tbody as $row) {
                echo '<tr>';
                foreach ($row as $col) {
                    if ($thead[$i]['key']) [ ]
                   echo '<td>'. $col .'</td>'; 
                }
                echo '</tr>';
            }
            ?>
            </tbody>
            </table>
            </div>
            </div>


<br /><br />
</div>