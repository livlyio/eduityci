<div class="container">
 
 <div class="panel-default" style="width: auto; height:auto; position: -40px">
        <!-- Default panel contents -->
        <div class="panel-heading"><?php echo $title; ?> <span style='float:right; margin-top: -7px;'></span></div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
            <?php foreach ($thead as $th) {
                //if (isset($th['width'])) { $thw = $th['width']; }
                $thw = ' width: '. $th['width'] ?: '';
                echo "<th". $thw .">". $th['title'] ."</th>";
            }
            ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tbody as $row) {
                echo '<tr>';
                foreach ($row as $col) {
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