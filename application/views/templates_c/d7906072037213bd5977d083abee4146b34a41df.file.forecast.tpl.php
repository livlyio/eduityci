<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-24 17:42:01
         compiled from "application\views\templates\user\forecast.tpl" */ ?>
<?php /*%%SmartyHeaderCode:109355561d1520f5ee3-84092100%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd7906072037213bd5977d083abee4146b34a41df' => 
    array (
      0 => 'application\\views\\templates\\user\\forecast.tpl',
      1 => 1432482118,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '109355561d1520f5ee3-84092100',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5561d1521a67d1_33448378',
  'variables' => 
  array (
    'org_name' => 0,
    'crumbs' => 0,
    'occ_info_panel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5561d1521a67d1_33448378')) {function content_5561d1521a67d1_33448378($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("user/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"Eduity",'name'=>((string)$_smarty_tpl->tpl_vars['Name']->value)), 0);?>


<div class="page-header container">
    <h1><small><?php echo $_smarty_tpl->tpl_vars['org_name']->value;?>
</small></h1>
    <small><?php echo $_smarty_tpl->tpl_vars['crumbs']->value;?>
</small>
</div>
<div class="container">

    <?php echo $_smarty_tpl->tpl_vars['occ_info_panel']->value;?>


 

</div><!-- /.container -->

<div class="container">

            <h2>Forecasting</h2>   
            <div style="float: right; margin-bottom: 10px">
            <label style="display: inline-block; margin-right: 50px"><input type="checkbox" id="autoopen" style="vertical-align: baseline">&nbsp;auto-open next field</label>
            <button id="enable" class="btn btn-default">enable / disable</button>
            </div>
            <p>Click to edit</p>
            <table id="user" class="table table-bordered table-striped" style="clear: both">
                <tbody> 
                    <tr>         
                        <td width="35%">Simple text field</td>
                        <td width="65%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username">superuser</a></td>
                    </tr>
                    <tr>         
                        <td>Empty text field, required</td>
                        <td><a href="#" id="firstname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter your firstname"></a></td>
                    </tr>  
                    <tr>         
                        <td>Select, local array, custom display</td>
                        <td><a href="#" id="sex" data-type="select" data-pk="1" data-value="" data-title="Select sex"></a></td>
                    </tr>
                    <tr>         
                        <td>Select, remote array, no buttons</td>
                        <td><a href="#" id="group" data-type="select" data-pk="1" data-value="5" data-source="/groups" data-title="Select group">Admin</a></td>
                    </tr> 
                    <tr>         
                        <td>Select, error while loading</td>
                        <td><a href="#" id="status" data-type="select" data-pk="1" data-value="0" data-source="/status" data-title="Select status">Active</a></td>
                    </tr>  
                         
                    <tr>         
                        <td>Datepicker</td>
                        <td>
                        
                        <span class="notready">not implemented for Bootstrap 3 yet</span>
                        
                        </td>
                    </tr>
                    <tr>         
                        <td>Combodate (date)</td>
                        <td><a href="#" id="dob" data-type="combodate" data-value="1984-05-15" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1"  data-title="Select Date of birth"></a></td>
                    </tr> 
                    <tr>         
                        <td>Combodate (datetime)</td>
                        <td><a href="#" id="event" data-type="combodate" data-template="D MMM YYYY  HH:mm" data-format="YYYY-MM-DD HH:mm" data-viewformat="MMM D, YYYY, HH:mm" data-pk="1"  data-title="Setup event date and time"></a></td>
                    </tr> 
                    
                                         
                                        
                    <tr>         
                        <td>Textarea, buttons below. Submit by <i>ctrl+enter</i></td>
                        <td><a href="#" id="comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments">awesome
user!</a></td>
                    </tr> 
                    
                    
                    
                    
                    <tr>         
                        <td>Twitter typeahead.js</td>
                        <td><a href="#" id="state2" data-type="typeaheadjs" data-pk="1" data-placement="right" data-title="Start typing State.."></a></td>
                    </tr>                       
                                         
                                                        
                    <tr>         
                        <td>Checklist</td>
                        <td><a href="#" id="fruits" data-type="checklist" data-value="2,3" data-title="Select fruits"></a></td>
                    </tr>

                    <tr>         
                        <td>Select2 (tags mode)</td>
                        <td><a href="#" id="tags" data-type="select2" data-pk="1" data-title="Enter tags">html, javascript</a></td>
                    </tr>                    

                    <tr>         
                        <td>Select2 (dropdown mode)</td>
                        <td><a href="#" id="country" data-type="select2" data-pk="1" data-value="BS" data-title="Select country"></a></td>
                    </tr>  
                    
                    <tr>         
                        <td>Custom input, several fields</td>
                        <td><a href="#" id="address" data-type="address" data-pk="1" data-title="Please, fill address"></a></td>
                    </tr>                      
                                                                                                                
                    
                </tbody>
            </table>

<br /><br />
</div>

<hr>

<?php echo $_smarty_tpl->getSubTemplate ("user/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
