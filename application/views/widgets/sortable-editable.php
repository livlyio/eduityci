 <div class="panel-default" style="width: auto; height:auto; position: -40px">
        <!-- Default panel contents -->
        <div class="panel-heading">Occupation Attributes<span style='float:right; margin-top: -7px;'></span></div>

        <!-- Table -->
        <table class="table table-striped table-hover sorted_table">
          <thead>
            <tr>
            <?php foreach ($headings as $head) {
              echo "<th>". $head ."</th>";               
              }  
            ?>
            </tr>
          </thead>
          <tbody>
<?php
foreach ($items as $item) {
    echo '<tr class>';
    echo '<td><a href="#" id="soc" data-pk="1" data-type="text" data-placement="right" data-title="Liekly">'.$item->element_id.'</a></li></td>';
    echo '<td><a href="#" id="title" data-pk="1" data-type="text" data-placement="right" data-title="Liekly">'.$item->element_name.'</a></li></td>';
    echo '<td><a href="#" id="description" data-pk="1" data-type="text" data-placement="right" data-title="Liekly">'.$item->description.'</a></li></td>';
 
    echo '</tr>';
 }
?>
</tbody>
</table>
</div>
</div>


