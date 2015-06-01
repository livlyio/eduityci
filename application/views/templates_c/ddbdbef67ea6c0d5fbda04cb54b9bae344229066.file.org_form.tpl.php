<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 06:35:38
         compiled from "application\views\templates\user\organization\org_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27347556bb18e9180a4-22060890%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddbdbef67ea6c0d5fbda04cb54b9bae344229066' => 
    array (
      0 => 'application\\views\\templates\\user\\organization\\org_form.tpl',
      1 => 1433133331,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27347556bb18e9180a4-22060890',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556bb18e948455_02029984',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556bb18e948455_02029984')) {function content_556bb18e948455_02029984($_smarty_tpl) {?>
<form class="jotform-form" action="<?php echo base_url('user/organization/create');?>
" method="post" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">

  <div class="form-all">
    <ul class="form-section page-section">
      <li id="cid_10" class="form-input-wide" data-type="control_head">
        <div class="form-header-group">
          <div class="header-text httal htvam">
            <div id="subHeader_10" class="form-subHeader">
              <h4>Please provide all required details to register your business with Eduity</h4>
            </div>
          </div>
        </div>
      </li>
      <li class="form-line jf-required" data-type="control_fullname" id="id_4">
        <label class="form-label form-label-left form-label-auto" id="label_4" for="input_4">
          Business Owner
          <span class="form-required">
            *
          </span>
        </label>
        <div id="cid_4" class="form-input jf-required">
          <span class="form-sub-label-container" style="vertical-align: top">
            <input class="form-textbox validate[required]" type="text" size="10" name="org_owner_first_name" id="first_4" />
            <label class="form-sub-label" for="first_4" id="sublabel_first" style="min-height: 13px;"> First Name </label>
          </span>
          <span class="form-sub-label-container" style="vertical-align: top">
            <input class="form-textbox validate[required]" type="text" size="15" name="org_owner_last_name" id="last_4" />
            <label class="form-sub-label" for="last_4" id="sublabel_last" style="min-height: 13px;"> Last Name </label>
          </span>
        </div>
      </li>
      <li class="form-line jf-required" data-type="control_textbox" id="id_6">
        <label class="form-label form-label-left form-label-auto" id="label_6" for="input_6">
          Business Name
          <span class="form-required">
            *
          </span>
        </label>
        <div id="cid_6" class="form-input jf-required">
          <input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="input_6" name="org_name" size="47" value="" />
        </div>
      </li>
      <li class="form-line jf-required" data-type="control_email" id="id_5">
        <label class="form-label form-label-left form-label-auto" id="label_5" for="input_5">
          E-mail
          <span class="form-required">
            *
          </span>
        </label>
        <div id="cid_5" class="form-input jf-required">
          <input type="email" class=" form-textbox validate[required, Email]" id="input_5" name="org_email" size="32" value="" />
        </div>
      </li>
      <li class="form-line jf-required" data-type="control_phone" id="id_12">
        <label class="form-label form-label-left form-label-auto" id="label_12" for="input_12">
          Contact Number
          <span class="form-required">
            *
          </span>
        </label>
        <div id="cid_12" class="form-input jf-required">
          <span class="form-sub-label-container" style="vertical-align: top">
            <input class="form-textbox validate[required]" type="tel" name="org_phone_acode" id="input_12_area" size="3">
            <span class="phone-separate">
              &nbsp;-
            </span>
            <label class="form-sub-label" for="input_12_area" id="sublabel_area" style="min-height: 13px;"> Area Code </label>
          </span>
          <span class="form-sub-label-container" style="vertical-align: top">
            <input class="form-textbox validate[required]" type="tel" name="org_phone_number" id="input_12_phone" size="8">
            <label class="form-sub-label" for="input_12_phone" id="sublabel_phone" style="min-height: 13px;"> Phone Number </label>
          </span>
        </div>
      </li>
      
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <?php echo '<script'; ?>
 src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// [END region_geolocation]

    <?php echo '</script'; ?>
>

 

     <li class="form-line jf-required" data-type="control_textbox" id="id_6">
        <label class="form-label form-label-left form-label-auto" id="label_6" for="input_6">
          Primary Address:
          <span class="form-required">
            *
          </span>
        </label>
            <div id="locationField" class="form-input jf-required">
      <input id="autocomplete" placeholder="Enter the primary business address"
      data-type="input-textbox" size="47"      onFocus="geolocate()" type="text"></input>
    </div>
      </li>
     <li class="form-line jf-required" data-type="control_textbox" id="id_6">
        <label class="form-label form-label-left form-label-auto" id="label_6" for="input_6">
          Website:
        </label>
            <div id="locationField" class="form-input">
      <input id="website" name="website" placeholder="Enter your web address"
      data-type="input-textbox" size="47" type="text"></input>
    </div>
      </li>

      

         
      <li class="form-line jf-required" data-type="control_dropdown" id="id_11">
        <label class="form-label form-label-left form-label-auto" id="label_11" for="input_11">
          Employees:
          <span class="form-required">
            *
          </span>
        </label>
        <div id="cid_11" class="form-input jf-required">
          <select class="form-dropdown validate[required]" style="width:150px" id="input_11" name="org_count_employees">
            <option value="">Please Select</option>
            <option value="1-10"> 1 to 10 </option>
            <option value="11-30"> 11 to 30 </option>
            <option value="31-50"> 31 to 50 </option>
            <option value="51-99"> 51 to 99 </option>
            <option value="100+"> 100+ </option>
          </select>
        </div>
      </li>
      <li class="form-line" data-type="control_textarea" id="id_8">
        <label class="form-label form-label-left form-label-auto" id="label_8" for="input_8"> Company Description </label>
        <div id="cid_8" class="form-input jf-required">
          <textarea id="input_8" class="form-textarea" name="description" cols="40" rows="6"></textarea>
        </div>
      </li>

      <li class="form-line" data-type="control_button" id="id_2">
        <div id="cid_2" class="form-input-wide">
          <div style="margin-left:156px" class="form-buttons-wrapper">
            <button id="input_2" type="submit" class="btn btn-success">
              Submit Registration
            </button>
          </div>
        </div>
      </li>
    </ul>
  </div>
  
    <body onload="initialize()">
  <div style="display:none;">
    <table id="address">
      <tr>
        <td class="label">Street address</td>
        <td class="slimField"><input class="field" id="street_number" name="street_number"
              disabled="true"></input></td>
        <td class="wideField" colspan="2"><input class="field" id="route" name="street_name"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">City</td>
        <td class="wideField" colspan="3"><input class="field" id="locality" name="city"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">State</td>
        <td class="slimField"><input class="field"
              id="administrative_area_level_1" disabled="true" name="state" ></input></td>
        <td class="label">Zip code</td>
        <td class="wideField"><input class="field" id="postal_code" name="postal_code"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">Country</td>
        <td class="wideField" colspan="3"><input class="field" name="country"
              id="country" disabled="true"></input></td>
      </tr>
    </table>
    </div>
    </body>
</form>
<?php echo '<script'; ?>
 src="http://d2g9qbzl5h49rh.cloudfront.net/static/prototype.forms.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="http://d2g9qbzl5h49rh.cloudfront.net/static/jotform.forms.js?3.2.7293" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
   JotForm.setConditions([{"action":[{"field":"13","visibility":"Show"}],"link":"Any","terms":[{"field":"11","operator":"equals","value":"Others, please specify below."}],"type":"field"}]);
   JotForm.init(function(){
      setTimeout(function() {
          $('input_5').hint('ex: myname@example.com');
       }, 20);
      JotForm.onSubmissionError="jumpToSubmit";
   });
<?php echo '</script'; ?>
>
<link href="http://d2g9qbzl5h49rh.cloudfront.net/static/formCss.css?3.2.7293" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="http://d2g9qbzl5h49rh.cloudfront.net/css/styles/nova.css?3.2.7293" />
<link type="text/css" media="print" rel="stylesheet" href="http://d2g9qbzl5h49rh.cloudfront.net/css/printForm.css?3.2.7293" />
<style type="text/css">
    .form-label-left{
        width:200px !important;
    }
    .form-line{
        padding-top:12px;
        padding-bottom:12px;
    }
    .form-label-right{
        width:150px !important;
    }
    .form-all{
        width:800px;
        color:Black !important;
        font-family:'Verdana', 'Lucida Grande',' Lucida Sans Unicode',' Lucida Sans',' Verdana',' Tahoma',' sans-serif';
        font-size:16px;
    }
</style>


<?php }} ?>
