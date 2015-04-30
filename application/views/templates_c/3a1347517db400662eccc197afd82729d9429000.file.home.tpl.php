<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-30 20:38:29
         compiled from "application\views\templates\user\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14922553a93ec200ea8-90473859%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a1347517db400662eccc197afd82729d9429000' => 
    array (
      0 => 'application\\views\\templates\\user\\home.tpl',
      1 => 1430419108,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14922553a93ec200ea8-90473859',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_553a93ec2463b7_87336924',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553a93ec2463b7_87336924')) {function content_553a93ec2463b7_87336924($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>



<link href="<?php echo '<?php'; ?>
 echo HTTP_CSS_PATH; <?php echo '?>'; ?>
starter-template.css" rel="stylesheet">
<style>
    .panel{
        margin-left: 55px;
        float: left;
        width: 500px;
        height: 303px;
    }

</style>

<?php echo '<script'; ?>
 type="text/javascript" src="https://www.google.com/jsapi"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
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
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
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
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
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
<?php echo '</script'; ?>
>


<div class="page-header container">
    <h1><small>Dashboard</small></h1>
</div>
<div class="container">

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Links</div>
        <div class="panel-body">

            <ul style="max-width: 260px;" class="nav nav-pills nav-stacked">
                <li class="active">
                    <a href="#">
                        <span class="badge pull-right"></span>
                        Item 1
                    </a>
                </li>
                <li><a href="#">Item 2
                        <span class="badge pull-right"></span></a>
                </li>
                <li>
                    <a href="#">
                        <span class="badge pull-right"></span>
                        Item 3
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="badge pull-right"></span>
                        Item 4
                    </a>
                </li>
            </ul>
        </div>
   </div>


    <div class="panel panel-success">
        <!-- Default panel contents -->
        <div class="panel-heading">Panel heading</div>
        <div class="panel-body">
            <div id="chart_div" style="width: 300px; height: 200px;"></div>

        </div>
    </div>

  

</div><!-- /.container -->
<hr>

<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
