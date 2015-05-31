
 
 <div class="panel-default" style="width: auto; height:auto; position: -40px">
        <!-- Default panel contents -->
        <div class="panel-heading"><?=$table_title;?></a> <span style='float:right; margin-top: -7px;'></span>
        </div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Set</th>
              <th>6 Months</th>
              <th>12 Months</th>
              <th>18 Months</th>
              <th>24 Months</th>
              <th>36 Months</th>
              <th>48 Months</th>
              <th>60 Months</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
<?php
foreach ($list as $cast) {
    echo '<tr>';
    
    switch ($cast->fcast_set) {
        case 'least': $fct = 'At Least'; break;
        case 'likely': $fct = 'Likely'; break;
        case 'most': $fct = 'At Most'; break;
    }
    
    echo '<td>'.$fct.'</td>';
    echo '<td><a href="#" class="fc6mo" id="6mo" data-pk="'.$cast->fset_id.'" data-type="text" data-placement="right" data-title="Enter title">'. $cast->fcast_6mo .'</a></td>';
    echo '<td><a href="#" class="fc12mo" id="12mo" data-pk="'.$cast->fset_id.'" data-type="text" data-placement="right" data-title="Select Date">'. $cast->fcast_12mo .'</a></td>';
    echo '<td><a href="#" class="fc18mo" id="18mo" data-pk="'.$cast->fset_id.'" data-type="text" data-placement="right" data-title="Select Date">'. $cast->fcast_18mo .'</a></td>';
    echo '<td><a href="#" class="fc24mo" id="24mo" data-pk="'.$cast->fset_id.'" data-type="text" data-placement="right" data-title="At Least">'. $cast->fcast_24mo .'</a></td>';
    echo '<td><a href="#" class="fc36mo" id="36mo" data-pk="'.$cast->fset_id.'" data-type="text" data-placement="right" data-title="Liekly">'. $cast->fcast_36mo .'</a></td>';
    echo '<td><a href="#" class="fc48mo" id="48mo" data-pk="'.$cast->fset_id.'" data-type="text" data-placement="right" data-title="At Most">'. $cast->fcast_48mo .'</a></td>';
    echo '<td><a href="#" class="fc60mo" id="60mo" data-pk="'.$cast->fset_id.'" data-type="text" data-placement="right" data-title="At Most">'. $cast->fcast_60mo .'</a></td>';
    echo '<td><a href="'.site_url('/user/organization/del_forecast/fcast/'.$cast->fset_id.'/'.$query_str).'" onclick="javascript:return confirm(\'Are you sure you want to delete this forecast?\')"><i class="fa fa-times"></i></a></td>';
    echo '</tr>';   
}
?>
</table>
</div>
</div>
