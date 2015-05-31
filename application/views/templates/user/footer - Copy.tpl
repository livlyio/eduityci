     <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    
    <!-- Demo -->
    <script src="../../dist/js/demo.js" type="text/javascript"></script>

    <!-- Dynamically Loaded Scipts -->
    {$script|default:''}
{literal}

<!-- Example jQuery code (JavaScript)  -->
<script type="text/javascript">

$(document).ready(function(){

	function getItems(exampleNr)
	{
		var columns = [];

		$(exampleNr + ' ul.sortable-list').each(function(){
			columns.push($(this).sortable('toArray').join(','));				
		});

		return columns.join('|');
	}

    var update = {/literal}{$update|default:"'post'"}{literal} ;

	// Example 1.1: A single sortable list
	$('#example-1-1 .sortable-list').sortable({
		update: function(){
        $.post(update, {order: getItems('#example-1-1'), dofunction: 'reorder', subset: 'skills'}, function(result){
            //alert(getItems('#example-1-1'));
        });
            
      

		}
	});


});

</script>
{/literal}

  </body>
</html>
