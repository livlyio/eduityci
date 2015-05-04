{include file="user/header.tpl" title="Eduity" name="$Name"}
{literal}
<link href="<?php echo HTTP_CSS_PATH; ?>starter-template.css" rel="stylesheet">
<style>
    .panel{
        margin-left: 55px;
        float: left;
        width: 500px;
        height: 303px;
    }

</style>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Language', 'Speakers (in millions)'],
            ['Assamese', 13], ['Bengali', 83], ['Bodo', 1.4],
            ['Dogri', 2.3], ['Gujarati', 46], ['Hindi', 300],
            ['Kannada', 38], ['Kashmiri', 5.5], ['Konkani', 5],
            ['Maithili', 20], ['Malayalam', 33], ['Manipuri', 1.5],
            ['Marathi', 72], ['Nepali', 2.9], ['Oriya', 33],
            ['Punjabi', 29], ['Sanskrit', 0.01], ['Santhali', 6.5],
            ['Sindhi', 2.5], ['Tamil', 61], ['Telugu', 74], ['Urdu', 52],
        ]);

        var options = {
            title: 'Indian Language Use',
            legend: 'none',
            pieSliceText: 'label',
            slices: {4: {offset: 0.2},
                12: {offset: 0.3},
                14: {offset: 0.4},
                15: {offset: 0.5},
            },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 11],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 7]
        ]);

        var options = {
            title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart12'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses'],
            ['2004', 1000, 400],
            ['2005', 1170, 460],
            ['2006', 660, 1120],
            ['2007', 1030, 540]
        ]);

        var options = {
            title: 'Company Performance'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
{/literal}

<div class="page-header container">
    <h1><small>{$org_name} </small></h1>
</div>
<div class="container">

    <div class="panel panel-info">
        <!-- Default panel contents -->
        <div class="panel-heading">Organizaiton Profile</div>
        <div class="panel-body">
        <table class="table table-striped table-hover">
        <tr><td>Name:</td><td>{$org_name} </td></tr>
        <tr><td>Description:</td><td>{$org_desc} </td></tr>
        <tr><td>Location:</td><td>{$org_location} </td></tr>
        <tr><td>Website:</td><td>{$website} </td></tr>
        </table>
        
        </div>
    </div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Panel heading</div>
        <div class="panel-body">
            <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien.</p>
        </div>
    </div>

</div><!-- /.container -->

<div class="container">

	<div class="smap">
		
		<h1>Organizational Map</h1>
	
		<ul id="utilityNav">
			<li><a href="{$smarty.const.BASE_URL}/user/organization/add_unit/{$query_str}">Add Unit</a></li>
			<li><a href="/login">Reorder Units</a></li>
		</ul>

		<ul id="primaryNav" class="col4">
			<li id="home"><a href="#">{$org_name}</a></li>
		{$map}	
		</ul>

	</div>

</div>

<hr>

{include file="user/footer.tpl"}
