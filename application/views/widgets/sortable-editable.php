




 <div class="panel-default" style="width: auto; height:auto; position: -40px">
        <!-- Default panel contents -->
   
		<div class="dhe-example-section-content">

			<!-- BEGIN: XHTML for example 1.1 -->
			<div id="example-1-1">

				<ul class="sortable-list">

<?php
foreach ($items as $item) {
    echo '<li class="sortable-item" id="'.$item->oujs_id.'"><table class="table table-striped><tr>';
   // echo '<td style="width:100px;"><a href="#" id="soc" data-pk="1" data-type="text" data-placement="right" data-title="Liekly">'.$item->element_id.'</a></td>';
    echo '<td style="width:400px;"><a href="#" id="title" data-pk="1" data-type="text" data-placement="right" data-title="Liekly">'.$item->element_name.'</a></td>';
    echo '<td style="width:500px;"><a href="#" id="description" data-pk="1" data-type="text" data-placement="right" data-title="Liekly">'.$item->description.'</a></td>';
    echo '</tr></table></li>';
 }
?>

</ul>

</div>


			<!-- END: XHTML for example 1.1 -->

</div>

</div>
</div>

</div>
