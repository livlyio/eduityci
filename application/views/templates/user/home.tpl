{include file="user/header.tpl" title="Eduity" name="$Name" css="$css"}

{literal}
<link href="starter-template.css" rel="stylesheet">
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
    <h1><small>Dashboard</small></h1>
</div>
<div class="container">

   {$page_content|default:''}

</div><!-- /.container -->
<hr />

{include file="user/footer.tpl"}
