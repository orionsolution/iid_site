		<div class="box profile">
        	<form name="profileform" class="add_patient_form" id="profileform" action="<?=base_url();?>patient/add_patient" method="post">
				<div class="ptop">                            
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="17%" class="prmrd">MRD No. <input type="text" name="mrdno" style="width:65px;" /><span class="valmrdno"></span></td>
						<td width="13%">HIV: 
							<select name="hiv_year" id="hiv">
								<option value="">Select</option>
								<?php foreach($misc_data['hiv_year'] as $curr_hiv_year):          
									echo "<option value='$curr_hiv_year'>$curr_hiv_year</option>";                            
								endforeach; ?>
							</select>
						</td>
						<td width="13%">ART:
							<select name="art_year" id="art">
								<option value="">Select</option>
								<?php foreach($misc_data['art_year'] as $curr_art_year):        
									echo "<option value='$curr_art_year'>$curr_art_year</option>";       
								endforeach; ?>
							</select>
						</td>
						<td width="19%"><span class="spouse">Spouse:</span>
							<select name="spouse" id="husband" disabled="">
								<?php foreach($misc_data['spouse'] as $curr_spouse):
									echo "<option value='$curr_spouse'>$curr_spouse</option>";            
								endforeach; ?>
							</select>
						</td>
						<td width="16%">Children:
							<select name="children" id="children">
								<?php foreach($misc_data['children'] as $curr_children): 
									echo "<option value='$curr_children'>$curr_children</option>";                                     
								endforeach; ?>
							</select>
						</td>
						<td width="22%" class="last">
							<ul>
								<li><input type="checkbox" name="diabetic" value="Yes" style="padding:0;"/>Diabetic</li>
								<li><input type="checkbox" name="hypertension" value="Yes">Hypertension</li>
							</ul>
						</td>
					  </tr>
					</table>
				</div>
				
				<div class="pbottom">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="35%" valign="top">
							<div class="fltleft" style="width:120px;"><label>Patient Name:</label></div> 
							<div class="fltright"><input type="text" name="firstname" id="firstname" style="width:180px;" /><span class="valfname"></span></div>
							<br class="clearfloat" />
						</td>
						<td width="35%" valign="top">
							<div class="fltleft" style="width:135px;"><label>Last Name:</label></div> 
							<div class="fltright"><input type="text" name="lastname" id="lastname" style="width:165px;" /><span class="vallname"></span></div>
							<br class="clearfloat" />
						</td>
						<td width="30%" valign="top" class="last">
							<label>Date of Birth:</label> <input type="text" id="birth_date" name="birth_date" readonly="readonly" style="width:145px;" />
							<span class="valbd"></span>
						</td>
					  </tr>
					  <tr>
						<td valign="top" style="text-align:center;"><label>gender:</label>
							<select name="gender" id="gender" style="width:124px;">
								<option value=""></option>
								<?php foreach($misc_data['gender'] as $curr_gender):                                                                                  
									echo "<option value='$curr_gender'>$curr_gender</option>";        
								endforeach; ?>
							</select>
							<span class="valgender"></span>
						</td>
						<td valign="top">
							<label>Education:</label> <input type="text" name="education" id="education" style="width:165px;" />
						</td>
						<td valign="top" class="last">
							<label>Occupation:</label> <input type="text" name="occupation" id="occupation" style="width:157px;" />
						</td>
					  </tr>
					  <tr>
						<td valign="top">
							<label>Contact No:</label> <input type="text" name="contact_no" id="contact_no" style="width:180px;" /><span class="valcon"></span>
						</td>
						<td valign="top">
							<label>Present city:</label> <input type="text" name="present_city" id="present_city" style="width:165px;" />
						</td>
						<td valign="top" class="last">
							<label>Referred by:</label> <input type="text" name="referredby" id="referredby" style="width:157px;" /><span class="valrb"></span>
						</td>
					  </tr>
					  <tr>
						<td valign="top">
							<label>Emergency No:</label> <input type="text" name="emer_no" id="emer_no" style="width:180px;" />
						</td>
						<td valign="top">
							<label>Permanent place:</label> <input type="text" name="permanent_place" id="permanent_place" style="width:165px;" />
						</td>
						<td valign="top" class="last">&nbsp;</td>
					  </tr>
					  <tr valign="top">
						<td colspan="3" class="last">
							<input type="reset" name="Cancel" value="Cancel"><input type="submit" name="save_hist" value="save">
						</td>
					  </tr>
				  </table>
				</div>
				<? if(isset($_GET['add_error'])):
					echo "<div style='text-align:center; font-size:1em; color:red;'>Mrdno already present</div>";
				endif; ?>
			</form>
		</div> <!-- end of box div -->

<script type="text/javascript">
$(document).ready(function(){    
	$('select[name=gender]').change(function(){
    	var value = $('select[name=gender]').find('option:selected').val();
      	if(value === 'Male'){
			$('span.spouse').text('Wife:');
			$('select[name=spouse]').removeAttr('disabled');
      	} else if (value === 'Female'){
			$('span.spouse').text('Husband:');
			$('select[name=spouse]').removeAttr('disabled');
      	} else {
			$('span.spouse').text("Spouse:");
			$('select[name=spouse]').attr('disabled','disabled');
      	}
    });

    $('.add_patient_form').submit(function(event){
    	var firstname = $('input[name=firstname]').val();
        var lastname = $('input[name=lastname]').val();
        var mrdno = $('input[name=mrdno]').val();
        var vh = false;
		  
        if(firstname === ''){
        	$('span.valfname').html("*required").addClass('error');
            vh = true;
        } else if(!isNaN(firstname)){
            $('span.valfname').html("Please enter valid value").addClass('error');
            vh = true;
        } else {
            $('span.valfname').html("");
        }

        if(lastname === ''){
            $('span.vallname').html("*required").addClass('error');
            vh = true;
        } else if(!isNaN(firstname)){
            $('span.vallname').html("Please enter valid value").addClass('error');
            vh = true;
        } else {
            $('span.vallname').html("");
        }

        if(mrdno === ''){
            $('span.valmrdno').html("* required").addClass('error');
            vh = true;
        } else if(isNaN(mrdno)){
            $('span.valmrdno').html("Please enter valid value").addClass('error');
        } else {
            $('span.valmrdno').html("");
        }

        if(vh){
            event.preventDefault();
        } else {
            console.log('patient added successfully');
        }
	});
});
</script>
