<div id="tabs">
  <ul>
    <li><a id="_Alt_h" href="#tabs-1">History</a></li>
    <li><a id="_Alt_e" href="#tabs-2">Examination</a></li>
    <li><a id="_Alt_i" href="#tabs-3">INVESTIGATIONS</a></li>
    <li><a id="_Alt_d" href="#tabs-4">Diagnosis</a></li>
    <li><a id="_Alt_t" href="#tabs-5">Treatment</a></li>
  </ul>
  <div id="tabs-1">	
    <form id="hist_form" name="hist">	
      <input type="hidden" name="visit_dt" value=""> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
            <td width="24%" valign="top">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="catradio">
                <tbody>
                <?php
                  foreach ($param_arr['history'] as $head_arr):
                    $curr_head_id = $head_arr["head_id"];
                    $curr_head_name = $head_arr["head_name"];
                    $curr_parameters = $head_arr["parameters"];
                    ?>
                    <tr>
						<td><input type="radio" id="<?php echo $curr_head_id; ?>" name="history" class="patient styled hist" value="<?php echo $curr_head_id; ?>"><label for="<?php echo $curr_head_id; ?>"><?php echo $curr_head_name; ?></label></td>
					</tr>
				<?php endforeach; ?>							
                </tbody>						
              </table>					
            </td>			
            <td width="2%">&nbsp;</td>
            <td width="74%">				
              <div id="history">				
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody><tr>
                      <td width="52%" valign="top">
                        <?php foreach ($param_arr['history'] as $head_arr):
                          $curr_head_id = $head_arr["head_id"];
                          $curr_head_name = $head_arr["head_name"];
                          $curr_parameters = $head_arr["parameters"];
                          ?>						
                          <select id="select_<?php echo $curr_head_id; ?>" size="8" class="select_box hidden">
                            <?php foreach ($curr_parameters as $curr_parameter): 
                              $curr_param_id = $curr_parameter['parameter_id'];
                              $curr_param = $curr_parameter['parameter'];
                              ?>
                              <option value="<?php echo $curr_param_id; ?>"><?php echo $curr_param; ?></option>
						  <?php endforeach; ?> <!-- end of $curr_parameters for loop -->								                          
                          </select>
						<?php endforeach; ?> <!-- end of param_arr for loop -->
                        <span class="valparam"></span>
                        <p>
                          <input name="add" type="text" placeholder="Add to the list" />
						  <input type="submit" name="add_list" value="Add" class="add" data-section-name="history" />
                        </p>
                      </td>
                      <td width="1%">&nbsp;</td>
                      <td width="47%" valign="top">
                        <table width="100%" border="0" cellpadding="0" cellspacing="5" class="add_info">
                          <tbody>
                            <tr>
                              <td>
                                <span class="hidden_radio"><input type="hidden" name="head_id" class="readonly" readonly /></span>
                                <span class="catname"></span>
                                <div class="info_details">
                                  <span class="hidden_select"><input type="hidden" name="param_id" class="readonly" readonly /></span>						
                                  <span class="select_value"><input class="sel_subcat readonly" type="text" name="param" readonly /></span>			
                                  <textarea id="hist_info" name="info" cols="" rows="4" placeholder="Write your notes here for additional info."></textarea>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="70%" align="right" >
                                      <div class="saved saved_add_hist"></div>
                                    </td>
                                    <td width="30%" align="right"><input type="submit" name="save_hist" value="Save" class="hist"><input type="hidden" class="get_value" value="add_hist" data-tablename="history" data-title="HIS"/></td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </tbody></table>							
                      </td>
                    </tr>
                  </tbody></table>
              </div> 
            </td>
          </tr>
        </tbody></table>
    </form>						
  </div> 
  <!---------------------------------------------------------------- end of tab-1 ---------------------------------------------------------------->

  <div id="tabs-2">
    <form id="exam_form" name="exam">
      <input type="hidden" name="visit_dt" value=""> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
            <td width="24%" valign="top">				
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="catradio">
                <tbody>
                <?php foreach ($param_arr['examination'] as $head_arr):                     
                    $curr_head_id = $head_arr["head_id"];
                    $curr_head_name = $head_arr["head_name"];
                    $curr_parameters = $head_arr["parameters"];
                    ?>
                    <tr>
						<td><input type="radio" id="<?php echo $curr_head_id; ?>" name="history" class="patient styled exam" value="<?php echo $curr_head_id; ?>"><label for="<?php echo $curr_head_id; ?>"><?php echo $curr_head_name; ?></label></td>
					</tr>
				<?php endforeach; ?>							
                </tbody>						
              </table>					
            </td>			
            <td width="2%">&nbsp;</td>
            <td width="74%">				
              <div id="examination">				
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody><tr>
                      <td width="52%" valign="top">
                        <?php foreach ($param_arr['examination'] as $head_arr): 
                          $curr_head_id = $head_arr["head_id"];
                          $curr_head_name = $head_arr["head_name"];
                          $curr_parameters = $head_arr["parameters"];
                          ?>						
                          <select id="select_<?php echo $curr_head_id; ?>" size="8" class="select_box hidden">
                          <?php foreach ($curr_parameters as $curr_parameter): 
                              $curr_param_id = $curr_parameter['parameter_id'];
                              $curr_param = $curr_parameter['parameter'];
                              ?>
                              <option value="<?php echo $curr_param_id; ?>"><?php echo $curr_param; ?></option>
						  <?php endforeach; ?> <!-- end of $curr_parameters for loop -->								                          
                          </select>
						<?php endforeach; ?> <!-- end of param_arr for loop -->
                        <span class="valparam"></span>
                        <p>
                          <input name="add" type="text" placeholder="Add to the list" />
						  <input type="submit" name="add_list" value="Add" class="add" data-section-name="examination" />
                        </p>
                      </td>
                      <td width="1%">&nbsp;</td>
                      <td width="47%" valign="top">
                        <table width="100%" border="0" cellpadding="0" cellspacing="5" class="add_info">
                          <tbody>
                            <tr>
                              <td>
                                <span class="hidden_radio"><input type="hidden" name="head_id" class="readonly" readonly /></span>
                                <span class="catname"></span>
                                <div class="info_details">
                                  <span class="hidden_select"><input type="hidden" name="param_id" class="readonly" readonly /></span>						
                                  <span class="select_value"><input class="sel_subcat readonly" type="text" name="param" readonly /></span>			
                                  <textarea id="exam_info" name="info" cols="" rows="4" placeholder="Write your notes here for additional info."></textarea>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="70%" align="right" >
                                      <div class="saved saved_add_exam"></div>
                                    </td>
                                    <td width="30%" align="right"><input type="submit" name="save_hist" value="Save" class="exam"><input type="hidden" class="get_value" value="add_exam" data-tablename="examination" data-title="EXA"/></td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </tbody></table>
                      </td>
                    </tr>
                  </tbody></table>
              </div> 
            </td>
          </tr>
        </tbody></table>
    </form>
  </div>
  <!---------------------------------------------------------------- end of tab-2 ---------------------------------------------------------------->	

  <div id="tabs-3">    
	  <input type="hidden" name="visit_dt" value="">
      <div id="investigations">				
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody><tr>
              <td width="39%" valign="top">
				<form id="invest_form" name="invest">
                <div class="investc"><strong>INV.</strong></div>
                <?php foreach ($param_arr['Investigation'] as $head_arr): 
                  $curr_head_id = $head_arr["head_id"];
                  $curr_head_name = $head_arr["head_name"];
                  $curr_parameters = $head_arr["parameters"];
                  ?>						
                    <?php if ($curr_head_id == 272): ?>											
                    <select id="select_<?php echo $curr_head_id; ?>" size="8" class="select_box">
                      <?php foreach ($curr_parameters as $curr_parameter):
                        $curr_param_id = $curr_parameter['parameter_id'];
                        $curr_param = $curr_parameter['parameter'];
                        ?>
                        <option value="<?php echo $curr_param_id; ?>"><?php echo $curr_param; ?></option>
                    <?php endforeach; ?> <!-- end of $curr_parameters for loop -->								                          
                    </select>
                  <?php endif; ?>
<? endforeach; ?>
                <span class="valparam"></span>
                <!--<span class="hidden_select"><input type="hidden" name="param_id" class="readonly" readonly /></span>						
                <span class="select_value"><input class="sel_subcat readonly invest" type="text" name="param" value="" readonly /></span>-->
				<div class="investt">VAULE / RESULT</div>
                <div><input id="invest_result" name="invest_result" type="text" /><input type="submit" name="save_invest" value="Save" class="add"><span class="saved saved_add_invest" style="margin-left:20px;"></span><span class="val_invest_result"></span></div>
				</form>
              </td>
              <td width="1%">&nbsp;</td>
              <td width="60%" valign="top">
				<form id="freq_invest_form" name="freq_invest">
              	<div class="fai">
					<div class="investc" style="position:relative;"><strong>Frequenty Added Investigations</strong></div>
					
					<table width="100%" border="0" cellspacing="10" cellpadding="0">
					  <tr>
						<td width="20%" align="right">CD4</td>
						<td width="25%"><input name="cd4" type="text" class="clear"/></td>
						<td width="1%">&nbsp;</td>
						<td width="20%" align="right">HIV I II</td>
						<td width="34%"><input name="hiv_i_ii" type="text" class="clear" /></td>
					  </tr>
					  <tr>
						<td align="right">VDRL</td>
						<td><input name="vdrl" type="text" class="clear" /></td>
						<td>&nbsp;</td>
						<td align="right">Viral Load</td>
						<td><input name="viral_load" type="text" class="clear" /></td>
					  </tr>
					  <tr>
						<td align="right">Creatinine</td>
						<td><input name="creatinine" type="text" class="clear" /></td>
						<td>&nbsp;</td>
						<td align="right">BSF</td>
						<td><input name="bsf" type="text" class="clear" /></td>
					  </tr>
					  <tr>
						<td align="right">HBSAG</td>
						<td><input name="hbsag" type="text" class="clear" /></td>
						<td>&nbsp;</td>
						<td align="right">CRYPTOCOCCUS ANTIGEN</td>
						<td><input name="cryptococcus" type="text" class="clear" /></td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="center"><input type="submit" name="save_invest" value="Save" class="add"><br /><span class="saved saved_add_freq_invest" style="display: block;position:absolute;top:79%;left:93%;"></span></td>
					  </tr>
				  </table>
				  
				</div>
				</form>
              </td>
            </tr>
          </tbody></table>
      </div> 
    
  </div>
  <!---------------------------------------------------------------- end of tab-3 ---------------------------------------------------------------->

  <div id="tabs-4">
    <form id="diag_form" name="diag">
      <input type="hidden" name="visit_dt" value=""> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
            <td width="24%" valign="top">

              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="catradio">
                <tbody>
                  <?php foreach ($param_arr['diagnosis'] as $head_arr): 
                    $curr_head_id = $head_arr["head_id"];
                    $curr_head_name = $head_arr["head_name"];
                    $curr_parameters = $head_arr["parameters"];
                    ?>
                    <tr>
						<td><input type="radio" id="<?php echo $curr_head_id; ?>" name="history" class="patient styled diag" value="<?php echo $curr_head_id; ?>"><label for="<?php echo $curr_head_id; ?>"><?php echo $curr_head_name; ?></label></td>
					</tr>
<?php endforeach; ?>							
                </tbody>						
              </table>					
            </td>			
            <td width="2%">&nbsp;</td>
            <td width="74%">				
              <div id="diagnosis">				
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody><tr>
                      <td width="52%" valign="top">
                        <?php foreach ($param_arr['diagnosis'] as $head_arr):
                          $curr_head_id = $head_arr["head_id"];
                          $curr_head_name = $head_arr["head_name"];
                          $curr_parameters = $head_arr["parameters"];
                          ?>						
                          <select id="select_<?php echo $curr_head_id; ?>" size="8" class="select_box hidden">
                          <?php foreach ($curr_parameters as $curr_parameter): ?>
                              <?php
                              $curr_param_id = $curr_parameter['parameter_id'];
                              $curr_param = $curr_parameter['parameter'];
                              ?>
                              <option value="<?php echo $curr_param_id; ?>"><?php echo $curr_param; ?></option>
						  <?php endforeach; ?> <!-- end of $curr_parameters for loop -->								                          
                          </select>
						<?php endforeach; ?> <!-- end of param_arr for loop -->
                        <span class="valparam"></span>
                        <p>
                          <input name="add" type="text" placeholder="Add to the list" />
						  <input type="submit" name="add_list" value="Add" class="add" data-section-name="diagnosis" />
                        </p>
                      </td>
                      <td width="1%">&nbsp;</td>
                      <td width="47%" valign="top">
                        <table width="100%" border="0" cellpadding="0" cellspacing="5" class="add_info">
                          <tbody>
                            <tr>
                              <td>
                                <span class="hidden_radio"><input type="hidden" name="head_id" class="readonly" readonly /></span>
                                <span class="catname"></span>
                                <div class="info_details">
                                  <span class="hidden_select"><input type="hidden" name="param_id" class="readonly" readonly /></span>						
                                  <span class="select_value"><input class="sel_subcat readonly" type="text" name="param" readonly /></span>			
                                  <textarea id="diag_info" name="info" cols="" rows="4" placeholder="Write your notes here for additional info."></textarea>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="70%" align="right" >
                                      <div class="saved saved_add_diag"></div>
                                    </td>
                                    <td width="30%" align="right"><input type="submit" name="save_hist" value="Save" class="diag"><input type="hidden" class="get_value" value="add_diag" data-tablename="diagnosis" data-title="DIA"/></td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </tbody></table>
                      </td>
                    </tr>
                  </tbody></table>
              </div> 
            </td>
          </tr>
        </tbody></table>
    </form>
  </div>
  <!---------------------------------------------------------------- end of tab-4 ---------------------------------------------------------------->

  <div id="tabs-5">
    <form id="treat_form" name="treat">
      <input type="hidden" name="visit_dt" value=""> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>							
            <td>				
              <div id="treatment">				
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody><tr>
                      <td width="34%" valign="top">
                        <div class="treatc"><strong>RX</strong></div>
                        <?php foreach ($param_arr['treatment'] as $head_arr):
                          $curr_head_id = $head_arr["head_id"];
                          $curr_head_name = $head_arr["head_name"];
                          $curr_parameters = $head_arr["parameters"];
                          ?>						
                          <?php if ($curr_head_id == 25): ?>											
                            <select id="select_<?php echo $curr_head_id; ?>" size="8" class="select_box">
                              <?php foreach ($curr_parameters as $curr_parameter):
                                $curr_param_id = $curr_parameter['parameter_id'];
                                $curr_param = $curr_parameter['parameter'];
                                if(!empty($curr_parameter['short_form'])):
                                  $short_form = $curr_parameter['short_form'];
                                  $temp_string = $curr_param;
                                  $curr_param = $short_form . " - ";
                                  $string_pos = strpos($temp_string, '-');
                                  if($string_pos):
                                  $curr_param .= substr($temp_string, 0, $string_pos);
                                  else:
                                    $curr_param .= $temp_string;
                                  endif;

                                  $curr_param = rtrim($curr_param," ");
                                  //echo "curr_param: " . $curr_param;
                                  //exit;
                                endif;
                                

                                // if short form is set then trim the curr_param till - , concatenate short form and curr_param.

                                ?>
                                <option value="<?php echo $curr_param_id; ?>"><?php echo $curr_param; ?></option>
                              <?php endforeach; ?> <!-- end of $curr_parameters for loop -->								                          
                            </select>
                          <?php endif; ?>						
                        <?php endforeach; ?>
                        <span class="valparam"></span>
                        <p><input name="add" type="text" placeholder="Add to the list" /><input type="submit" name="add_list" value="Add" class="add" data-section-name="treatment" /></p>
                      </td>
                      <td width="1%">&nbsp;</td>
                      <td width="65%" valign="top">
                        <span class="hidden_treat"><input type="hidden" name="head_id" value="25" /></span>
                        <span class="hidden_select"><input type="hidden" name="param_id" class="readonly" readonly /></span>						
                        <span class="select_value"><input class="sel_subcat readonly treat" type="text" name="param" value="" readonly /></span>
                        <table width="100%" border="0" cellpadding="0" cellspacing="5" class="add_info" style="padding:5px;">
                          <tbody>
                            <tr>
                              <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="treatcal">
                                  <tr>
                                    <th width="30%">STARTED</th>
                                    <th width="30%">STOPPED</th>
                                    <th width="40%">ADDITIONAL INFORMATION</th>
                                  </tr>
                                  <tr>
                                    <td align="center">
                                      <div id="startdate"></div>
                                      <input type="text" id="start_date" name="start_date" readonly="readonly" value="<? echo date('d M Y'); ?>" style="color:#66c071;" />
                                    </td>
                                    <td align="center">
                                      <div id="stopdate"></div>
                                      <input type="text" id="stop_date" name="stop_date" style="color:#d95734;" />
                                    </td>
                                    <td>
                                      <input name="add_treat_info[]" type="checkbox" value="Treatment failure" /> Treatment failure<br />
                                      <input name="add_treat_info[]" type="checkbox" value="Clinical Progression / Hosp." /> Clinical Progression / Hosp.<br />
                                      <input name="add_treat_info[]" type="checkbox" value="Patient decision / Request" /> Patient decision / Request<br />
                                      <input name="add_treat_info[]" type="checkbox" value="Compliance difficulties" /> Compliance difficulties <br />
                                      <input name="add_treat_info[]" type="checkbox" value="Drug Allergy" /> Drug Allergy<br />
                                      <input name="add_treat_info[]" type="checkbox" value="Family History" /> Family History<br />
                                      <input name="add_treat_info[]" type="checkbox" value="Social Psycho Aspects" /> Social Psycho Aspects
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="70%" align="right" style="padding-top:12px;">
                                            <div class="saved saved_add_treat"></div>
                                          </td>
                                          <td width="30%" align="right"><input type="hidden" class="get_value" value="add_treat" data-tablename="treatment" data-title="TRE"/> <input type="submit" name="save_treat" value="Save" class="treat"></td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody></table>
              </div> 

            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
  <!---------------------------------------------------------------- end of tab-5 ---------------------------------------------------------------->
</div>
<script type="text/javascript">
$(document).ready(function(){

/* To select first radio button of each tab when page loads */

$('#hist_form').find('input[type=radio]').first().attr('checked', 'checked');
$('#exam_form').find('input[type=radio]').first().attr('checked', 'checked');
$('#diag_form').find('input[type=radio]').first().attr('checked', 'checked');
$('#treat_form').find('input[type=radio]').first().attr('checked', 'checked');

/* To display only the first select box of each tab */

$('#tabs-1 .select_box').first().removeClass('hidden');
$('#tabs-2 .select_box').first().removeClass('hidden');
$('#tabs-3 .select_box').first().removeClass('hidden');
$('#tabs-4 .select_box').first().removeClass('hidden');

/* To select the first radion button and select box of each tab and display on the form */

var href = $('li.ui-tabs-active').find('a').attr('href');
var curr_tab_div = $('div#' + href);

var curr_radio_text = $(curr_tab_div).find('input[type=radio]:checked').siblings('label').text();
var curr_radio_value = $(curr_tab_div).find('input[type=radio]:checked').val();

$('span.catname').text(curr_radio_text);
$('span.hidden_radio input[name=head_id]').val(curr_radio_value);

// tabs selection

$('li.ui-state-default').click(function() {

  var anchor_href = $(this).find('a').attr('href');

  var div = $('div' + anchor_href);



  var curr_radio = $(div).find('input[type=radio]:checked');
  var curr_option = $(div).find('select option:selected');
  console.log("curr option elem: " + $(curr_option).val());

  var curr_text = $(curr_radio).siblings('label').text();



  $('span.catname').text(curr_text);
  $('span.hidden_radio input[name=head_id]').val(curr_radio.val());



  if (curr_option) {
	var curr_option_value = curr_option.text();
	curr_option_value = curr_option_value.replace('Jan2015Jan2015','');
	 $('span.select_value input[name=param]').val(curr_option_value);
	 $('span.hidden_select input[name=param_id]').val(curr_option.val());
	 console.log("curr option: " + curr_option.text());
	console.log('inside if');
  } else {
	$('span.select_value input[name=param]').val("");
	$('span.hidden_select input[name=param_id]').val("");
	console.log('inside else');
  }

});


/* Radio button click functionality */

$('input[type=radio].patient, span.radio').click(function() {
  /* get the radio value */

  var radio_value = $(this).val();
  $('span.hidden_radio > input.readonly').val(radio_value);




  /* get the radio text */

  var radio_text = $(this).siblings('label').text();

  $('span.catname').text(radio_text);


  /* display the select list for current radio element */

  var href = $('li.ui-tabs-active').find('a').attr('href');
  var curr_tab_div = $('div#' + href);


  $(curr_tab_div).find('select.select_box').addClass('hidden');


  $('#select_' + radio_value).removeClass('hidden');


});

/* function to display the current selected option in the form */

function select_click() {
  $('.select_box option').click(function() {
	var select_text = $(this).text();
	var select_value = $(this).val();


	$('span.hidden_select input[name=param_id]').val(select_value);
	$('span.select_value input[name=param]').val(select_text);
  });
}

select_click();

/* Add list functionality */



function select_click() {
	  $('.select_box option').click(function() {
		var select_text = $(this).text();
		var select_value = $(this).val();


		$('span.hidden_select input[name=param_id]').val(select_value);
		$('span.select_value input[name=param]').val(select_text);
	  });
}




$('input[name=add_list]').click(function(event) {
  if ($(this).prev('input[name=add]').val() === '') {
	//console.log($(this).attr('data-section-name'));
	event.preventDefault();
	$('span.valparam').html("");
	$('span.val_invest_result').html('');
	if ($(this).next('span.add_value').html()) {

	} else {
	  $(this).after('<span class="error add_value">* required</span>');
	}

  } else {
	event.preventDefault();
	$(this).next('span.error').text("");
	$('span.valparam').html("");
	var add_list_value = $(this).prev('input[name=add]').val();
	var section_name = $(this).attr('data-section-name');
	console.log(add_list_value);
	console.log(section_name);
	if (section_name !== 'treatment' && section_name !== 'investigation') {
	  var href = $('li.ui-tabs-active').find('a').attr('href');
	  var curr_tab_div = $('div#' + href);

	  var curr_radio_value = $(curr_tab_div).find('input[type=radio]:checked').val();
	} else if (section_name === 'treatment') {
	  var curr_radio_value = 25;
	} else if (section_name === 'investigation') {
	  var curr_radio_value = 272;
	}
	console.log(curr_radio_value);


	var url = "<?= base_url(); ?>patient/add_list_value";
	var data_sent = {'sec_name': section_name, 'list_value': add_list_value, 'head_id': curr_radio_value};
	$.post(url, data_sent, function(data) {
	  $('input[name=add]').val("");
	  console.log(data);
	  var select_ele = $('select[id=select_' + curr_radio_value + ']').html(data);
	  var optn_text = $(select_ele).find('option:selected').text();
	  var optn_value = $(select_ele).find('option:selected').val();
	  $('span.hidden_select input[name=param_id]').val(optn_value);
	  $('span.select_value input[name=param]').val(optn_text);
	  var textarea_id = section_name.substr(0, 4);
	  console.log('textarea id is ' + textarea_id);
	  $('textarea#' + textarea_id + '_info').focus();
	  select_click();

	});
  }
});

}); // document ready function
</script>


<script type="text/javascript">
  $(function() {
    <?if (!empty($past_date)): ?>    
    // update the start date datepicker and end date datepicker in treatment tab as per the date selected in past date datepicker

    var past_date = "<?= $past_date ?>";
    past_date = past_date.replace(",","");

    $('#startdate').datepicker({
    changeMonth: true,
    changeYear: true,
      dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      onSelect: function(date, obj) {
        $('#start_date').val(date);  //Updates value of of your input 
        $('#stopdate').datepicker("option", "minDate", date);
        $('#stop_date').val(date);
      }
    }).datepicker("setDate", new Date(past_date));

    $('#stopdate').datepicker({
      changeMonth: true,
      changeYear: true,
      dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      onSelect: function(date, obj) {
        $('#stop_date').val(date);  //Updates value of of your input 
      }
    }).datepicker("setDate", new Date(past_date));

    
    $('#start_date').val(past_date);
    $('#stop_date').val(past_date);

  <? else: ?>
      $('#startdate').datepicker({
      changeMonth: true,
      changeYear: true,
      dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      onSelect: function(date, obj) {
          $('#start_date').val(date);  //Updates value of of your input 
          $('#stopdate').datepicker("option", "minDate", date);
          //$('#stop_date').val(date);
        }
    });


    $('#stopdate').datepicker({
      changeMonth: true,
      changeYear: true,
      dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      onSelect: function(date, obj) {
        $('#stop_date').val(date);  //Updates value of of your input 
      }
    });
  <? endif; ?>

  });
</script>