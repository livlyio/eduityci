
 
 <div class="panel-default" style="width: auto; height:auto; position: -40px">
        <!-- Default panel contents -->
        <div class="panel-heading">Occupation Forecast <span style='float:right; margin-top: -7px;'></span>
        <div style="float: right; margin-right:300px;">
        <a href="" class="btn btn-success" role="button">New Forecast</a>
        </div>
        </div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Title</th>
              <th>Created</th>
              <th>Projected</th>
              <th>At Least</th>
              <th>Likely</th>
              <th>At Most</th>
            </tr>
          </thead>
          <tbody>
<?php
foreach ($list as $cast) {
    echo '<tr>';
    echo '<td><a href="#" id="title" data-pk="'.$cast->fc_id.'" data-type="text" data-placement="right" data-title="Enter title">'. $cast->title .'</a></td>';
    echo '<td><a href="#" id="created" data-pk="'.$cast->fc_id.'" data-type="date" data-placement="right" data-title="Select Date">'. $cast->created .'</a></td>';
    echo '<td><a href="#" id="projected" data-pk="'.$cast->fc_id.'" data-type="date" data-placement="right" data-title="Select Date">'. $cast->projected .'</a></td>';
    echo '<td><a href="#" id="least" data-pk="'.$cast->fc_id.'" data-type="text" data-placement="right" data-title="At Least">'. $cast->least .'</a></td>';
    echo '<td><a href="#" id="likely" data-pk="'.$cast->fc_id.'" data-type="text" data-placement="right" data-title="Liekly">'. $cast->likely .'</a></td>';
    echo '<td><a href="#" id="most" data-pk="'.$cast->fc_id.'" data-type="text" data-placement="right" data-title="At Most">'. $cast->most .'</a></td>';
    echo '</tr>';   
}
?>
</table>
</div>
</div>
