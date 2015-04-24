<?php
$this->load->view('admin/vwHeader');
?>

<link href="<?php echo HTTP_CSS_PATH; ?>starter-template.css" rel="stylesheet">

<?php
if ($page == 'add') {
?> 
<div class="page-header container">
  <h1><small>Add Link</small></h1>
</div>
    <div class="container">
        
<form name="addlink" id="ajax_form" method="post" action="<?php echo base_url('admin/redirects/doadd'); ?>">
<table>
<tr>
<td>Name:</td><td><?php echo form_input(array('name' => 'name','id' => 'name','value' => '','size' => '50','style' => '')); ?></td></tr>
<td>Category:</td><td><?php echo form_input(array('name' => 'cat','id' => 'cat','value' => '','size' => '50','style' => '')); ?></td></tr>
<td>URL:</td><td><?php echo form_input(array('name' => 'url','id' => 'url','value' => '','size' => '100', 'style' => '')); ?></td></tr>
<td></td><td><input type="submit" /></td></tr>
</table>
</div><!-- /.container -->
<?php 
echo form_close(); 
} else {
?> 
<div class="page-header container">
  <h1><small>Add Link Results</small></h1>
</div>
    <div class="container">
        
<form name="addlink" id="ajax_form" method="post" action="<?php echo base_url('admin/redirects/doadd'); ?>">
<table>
<tr>
<td>Name:</td><td><?php echo $name; ?></td></tr>
<td>Category:</td><td><?php echo $cat; ?></td></tr>
<td>URL:</td><td><a href="<?php echo $url; ?>"><?php echo $url; ?></a></td></tr>
<td>Alias:</td><td><a href="<?php echo $alias; ?>" target="_blank"><?php echo $alias; ?></a></td></tr>
</table>
</div><!-- /.container -->
<?php } ?>


<hr />
<?php
$this->load->view('admin/vwFooter');
?>