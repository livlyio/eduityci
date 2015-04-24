<?php
$this->load->view('admin/vwHeader');
?>
<link href="<?php echo HTTP_CSS_PATH; ?>starter-template.css" rel="stylesheet">
<style>
    .panel{
        margin-left: 55px;
        float: left;
        width: 500px;
        height: 303px;
    }
    .wide-panel{
        margin-left: 55px;
        float: left;
        width: 1050px;
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
            ['Week', 'Followers', 'Clicks', 'Tweets'],
        <?php 
        foreach ($month as $st) {    
        $week = date( "m/d", strtotime($st['date']) );
        $array[] = "['". $week ."', ". $st['followers'] .", ". $st['clicks'] .", ". $st['tweets'] ."]";
        }
        echo implode (", ", $array);
        ?>    
        ]);

        var options = {
            title: 'Account Performance',
            curveType: 'function',
            legend: { position: 'bottom' },
            width: '480',
            height: '200'
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_graph'));
        chart.draw(data, options);
    }
</script>


<div class="page-header container">
    <h1><small>Account Dashboard</small></h1>
</div>
<div class="container">

    <div class="panel panel-success">
        <!-- Default panel contents -->
        <div class="panel-heading">Account Information</div>
        <div class="panel-body">
        <table class="table table-striped table-hover">
        <tr><td>Name:</td><td><?php echo $acct['name']; ?></td></tr>
        <tr><td>Username:</td><td><a href="http://www.twitter.com/<?php echo $acct['username']; ?>" target="_blank">@<?php echo $acct['username']; ?></a></td></tr>
        <tr><td>Sex:</td><td><?php echo $acct['sex']; ?></td></tr>
        <tr><td>Niche:</td><td><?php echo $acct['niche']; ?></td></tr>
        </table>    
        </div>
        </div>

        <div class="panel panel-info">
        <!-- Default panel contents -->
        <div class="panel-heading">Current Week Statistics</div>
        <div class="panel-body">
            <ul style="max-width: 260px;" class="nav nav-pills nav-stacked">
                <li class="active">
                    <a href="#">
                        <span class="badge pull-right"><?php echo $stat['followers']; ?></span>
                        Followers
                    </a>
                </li>
                <li><a href="#">Follows
                        <span class="badge pull-right"><?php echo $stat['follows']; ?></span></a>
                </li>
                <li>
                    <a href="#">
                        <span class="badge pull-right"><?php echo $stat['tweets']; ?></span>
                        Tweets
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="badge pull-right"><?php echo $stat['clicks']; ?></span>
                        Clicks
                    </a>
                </li>                
            </ul>
    </div>
    </div>

    <div class="panel panel-warning">
        <!-- Default panel contents -->
        <div class="panel-heading">Account Operations</div>
        <div class="panel-body">        
            
        </div>
    </div>

    <div class="panel panel-danger">
        <!-- Default panel contents -->
        <div class="panel-heading">30-Day Statistics</div>
        <div class="panel-body">
            <div id="line_graph" style="width: 300px; height: 200px;"></div>

        </div>    
    </div>

 <div class="wide-panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">Scheduled Tweets <span style='float:right; margin-top: -7px;'><a href="<?php echo base_url('admin/twitter/add_acct'); ?>" class="btn btn-info">Add Task</a></span></div>

        <!-- Table -->
        <table class="table table-striped table-hover">
        <thead>
        <tr>
        <th>Interval</th>
        <th>Description</th>
        <th>Type</th>
        <th>Count</th>
        <th>Hash Tags</th>
        <th>User Tags</th>
        <th>Last Trigger</th>
        </tr>
        </thead>
        <?php
        foreach ($sched as $sc) {
            echo "<tr>";
            echo "<td>". secs_to_h($sc['interval']) ."</td>";
            echo "<td>". $sc['title'] ."</td>";
            echo "<td>". $sc['tweet_type'] ."</td>";
            echo "<td>". $sc['count'] ."</td>";
            echo "<td>". $sc['hashtags'] ."</td>";
            echo "<td>". $sc['usertags'] ."</td>";
            echo "<td>". $sc['last_trigger'] ."</td>";
            echo "</tr>";
        }
        ?>
        </table>
        </div>
</div>

<hr>
<?php
$this->load->view('admin/vwFooter');
?>