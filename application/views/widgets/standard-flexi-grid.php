<?php
echo $js_grid;
?>
<script type="text/javascript">

function test(com,grid){
    if (com=='Select All'){
		$('.bDiv tbody tr',grid).addClass('trSelected');
    }
    
    if (com=='DeSelect All'){
		$('.bDiv tbody tr',grid).removeClass('trSelected');
    }
    
    if (com=='Delete'){
	   if($('.trSelected',grid).length>0){
		   if(confirm('Delete ' + $('.trSelected',grid).length + ' items?')){
				var items = $('.trSelected',grid);
				var itemlist ='';
				for(i=0;i<items.length;i++){
					itemlist+= items[i].id.substr(3)+",";
				}
				$.ajax({
				   type: "POST",
				   url: "<?php echo site_url("/countries_feed/deletec");?>",
				   data: "items="+itemlist,
				   success: function(data){
					$('#flex1').flexReload();
					alert(data);
				   }
				});
			}
		} else {
			return false;
		} 
	}          
} 

///Filter for Alphabet Buttons
function filter_alpha(alpha,grid){ 
	//check if letter selected is # for all
	alpha = (alpha == '#')?'%%':alpha;
	var filters = {"groupOp":"AND","rules":[{"field":"name","op":"bw","data":alpha}]};
	filters_value = JSON.stringify(filters);
	$('#flex1').flexOptions({
		newp:1,
		params:[
			{name:'filters', value: filters_value},
			{name:'qtype', value: $('select[name=qtype]').val()}
		]
	});
	
	$('#flex1').flexReload();
} 

///Filter for Alphabet Buttons
function exportTo(format,grid){ 
	var groupOp = $(grid.sDiv).find("select[name=groupOp]").val();
	var squery = '{"groupOp":"' + groupOp + '","rules":[';
	$('.sDiv2').each( function(idx) {
		field = $("select[name=qtype]", this).val();
		op = $("select[name=op]", this).val();
		data = ''
		
		var i = $("select[name=qtype]", this).get(0).selectedIndex;
		
		if (($(".qsbox.q"+i, this).css("display") == "inline") || ($(".qsbox.q"+i, this).css("display") == "inline-block")) {
			data = $(".qsbox.q"+i, this).val();
		}else{
			data = $(".qsbox.default", this).val();
		}

		squery += '{"field":"'+field+'","op":"'+op+'","data":"'+data+'"},';
	});

	squery = squery.substring(squery.length-1,0) + ']}';
	console.dir(squery);
	
	window.location.href = "<?php echo site_url("/countries_feed/export");?>"+"?filters="+squery+"&format="+format;
} 

</script>

<div id="flex-container">

	<div id="flex-body">
	    <table id="flex1" style="display:none"></table>
	</div>
    
</div>