
 
 <div class="panel-default" style="width: auto; height:auto; position: -40px">
        <!-- Default panel contents -->
        <div class="panel-heading"><?=$table_title;?></a> <span style='float:right; margin-top: -7px;'></span>
        <div style="float: right; margin-right:300px;">
        <a href="<?php echo site_url('/user/organization/new_forecast/'. $query_str) ?>" class="btn btn-success" role="button">New Forecast</a>
        </div>
        </div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Created</th>
              <th>At Least</th>
              <th>Likely</th>
              <th>At Most</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
<?php
foreach ($list as $cast) {
    echo '<tr>';
   // echo '<td><a href="#" class="title" id="title" data-pk="'.$cast->fcast_id.'" data-type="text" data-placement="right" data-title="Enter title">'. $cast->title .'</a></td>';
    echo '<td><a href="#" class="created" id="created" data-pk="'.$cast->fset_id.'" data-type="date" data-placement="right" data-title="Select Date">'. $cast->created .'</a></td>';
   // echo '<td><a href="#" class="projected" id="projected" data-pk="'.$cast->fcast_id.'" data-type="date" data-placement="right" data-title="Select Date">'. $cast->projected .'</a></td>';
    echo '<td><a href="#" class="least" id="least" data-pk="'.$cast->fset_id.'" data-type="text" data-placement="right" data-title="At Least">'. $cast->least .'</a></td>';
    echo '<td><a href="#" class="likely" id="likely" data-pk="'.$cast->fset_id.'" data-type="text" data-placement="right" data-title="Liekly">'. $cast->likely .'</a></td>';
    echo '<td><a href="#" class="most" id="most" data-pk="'.$cast->fset_id.'" data-type="text" data-placement="right" data-title="At Most">'. $cast->most .'</a></td>';
    echo '<td><a href="'.site_url('/user/organization/del_forecast/fcast/'.$cast->fset_id.'/'.$query_str).'" onclick="javascript:return confirm(\'Are you sure you want to delete this forecast?\')"><i class="fa fa-times"></i></a></td>';
    echo '</tr>';   
}
?>
</table>
</div>
</div>
