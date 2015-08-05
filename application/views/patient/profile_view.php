		<? $this->load->view('common/toplinks'); ?>
		<div class="box profile boxtop">
        	<form name="profileform" id="profileform" action="<?=base_url();?>patient/update_patient_info/<?=$mrd_no;?>" method="post">
				<div class="ptop">
                         <?php foreach($edit_info as $curr_patient): 
                                            $firstname = $curr_patient['firstname'];
                                            $lastname = $curr_patient['surname'];
                                            $referred_by = $curr_patient['refdr'];
                                            $present_city = $curr_patient['present_city'];
                                            $permanent_place = $curr_patient['permanent_place'];
                                            $education = $curr_patient['edu'];
                                            $occupation = $curr_patient['occu'];
                                            $gender = $curr_patient['gender'];
                                            $contact_number = $curr_patient['telno'];
                                            $emergency_number = $curr_patient['emer_no'];
                                            $birth_date = $curr_patient['date_of_birth'];
                                            $per_info = $curr_patient['perinfo'];
                                            $hiv_year = $curr_patient['hiv_year'];
                                            $art_year = $curr_patient['art_year'];
                                            $spouse = $curr_patient['spouse'];
                                            $children = $curr_patient['children'];
                                            $diabetic = $curr_patient['diabetic'];
                                            $hypertension = $curr_patient['hypertension'];
                            endforeach;
                                          $spouse_status = '';
                                          if($gender == 'Male'):
                                            $spouse_status = 'Wife';
                                          elseif($gender == 'Female'):
                                            $spouse_status = 'Husband';
                                          else:
                                            $spouse_status = 'Spouse';
                                            $select_disabled = 'disabled';
                                          endif;?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="15%" class="prmrd">MRD No. <span class="mrd"><?=$mrd_no;?></span></td>
					<td width="13%">HIV:
						<select name="hiv_year" id="hiv">
                        	<option value="">Select</option>
                            <?php foreach($misc_data['hiv_year'] as $curr_hiv_year): 
                            	if($curr_hiv_year == $hiv_year):
                                	echo "<option value='$curr_hiv_year' selected='selected'>$curr_hiv_year</option>";                                               
                                else:
                                    echo "<option value='$curr_hiv_year'>$curr_hiv_year</option>";                                          
                                endif;  
                            endforeach; ?>
						</select>
					</td>
					<td width="13%">ART:
						<select name="art_year" id="art">
                        	<option value="">Select</option>
                            <?php foreach($misc_data['art_year'] as $curr_art_year): 
                            	if($curr_art_year == $art_year):
                                	echo "<option value='$curr_art_year' selected='selected'>$curr_art_year</option>";                                               
                                else:
                                    echo "<option value='$curr_art_year'>$curr_art_year</option>";                                          
                                endif;  
                            endforeach; ?>
						</select>
					</td>
					<td width="20%"><span class="spouse"><?=$spouse_status;?></span>
						<select name="spouse" id="husband" <?=(isset($select_disabled)) ? 'disabled':'';?>>
                        	<?php foreach($misc_data['spouse'] as $curr_spouse): 
                            	if($curr_spouse == $spouse):
                                	echo "<option value='$curr_spouse' selected='selected'>$curr_spouse</option>";                                               
                                else:
                                    echo "<option value='$curr_spouse'>$curr_spouse</option>";                                          
                                endif;  
                            endforeach; ?>
						</select>
					</td>
					<td width="16%">Children:
						<select name="children" id="children">
                        	<?php foreach($misc_data['children'] as $curr_children): 
                           		if($curr_children == $children):
                                	echo "<option value='$curr_children' selected='selected'>$curr_children</option>";                                               
                                else:
                                    echo "<option value='$curr_children'>$curr_children</option>";                                          
                                endif;  
                            endforeach; ?>
						</select>
					</td>
					<td width="23%" class="last">
						<ul>
                        	<li><input type="checkbox" value="Yes" name="diabetic" <?=($diabetic == 'Yes')?'checked':''?>/>Diabetic</li>
                            <li><input type="checkbox" value ="Yes" name="hypertension" <?=($hypertension == 'Yes')?'checked':''?>>Hypertension</li>
						</ul>
					</td>
				  </tr>
				</table>
			</div>
			
				<div class="pbottom">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="35%">
							<div class="fltleft" style="width:120px;"><label>Patient Name:</label></div> 
							<div class="fltright"><input type="text" name="firstname" id="firstname" style="width:180px;" value="<?=$firstname;?>"/><span class="valfname"></span></div>
							<br class="clearfloat" />
						</td>
						<td width="35%">
							<div class="fltleft" style="width:120px;"><label>Last Name:</label></div> 
							<div class="fltright"><input type="text" name="lastname" id="lastname" style="width:165px;" value="<?=$lastname;?>"/><br/><span class="vallname"></span></div>
							<br class="clearfloat" />
						</td>
						<td width="30%" class="last">
							<label>Date of Birth:</label> 
							<input type="text" id="birth_date_modify" name="birth_date" readonly="readonly" style="width:145px;" value="<?php 
							if($birth_date != '1970-01-01' && $birth_date != NULL && $birth_date != '0000-00-00'):
								echo date("d/m/Y", strtotime($birth_date));
							endif;?>" /><span class="valbd"></span>
						</td>
					  </tr>
					  <tr>
						<td style="text-align:center;"><label>gender:</label>
							<select name="gender" id="gender" style="width:124px;">
								<option value=""></option>
								<?php foreach($misc_data['gender'] as $curr_gender): 
									if($curr_gender == $gender):
										echo "<option value='$curr_gender' selected='selected'>$curr_gender</option>";                                               
									else:
										echo "<option value='$curr_gender'>$curr_gender</option>";                                          
									endif;  
								endforeach; ?>
							</select>
						</td>
						<td>
							<label>Education:</label> <input type="text" name="education" id="education" style="width:165px;" value="<?=$education;?>" />
						</td>
						<td class="last">
							<label>Occupation:</label><input type="text" name="occupation" id="occupation" style="width:157px;" value="<?=$occupation;?>"/>
						</td>
					  </tr>
					  <tr>
						<td>
							<label>Contact No:</label> <input type="text" name="contact_no" id="contact_no" style="width:180px;" value="<?=$contact_number;?>" />
							<span class="valcon"></span>
						</td>
						<td>
							<label>Present city:</label> <input type="text" name="present_city" id="present_city" style="width:165px;" value="<?=$present_city;?>" />
						</td>
						<td class="last">
							<label>Referred by:</label><input type="text" name="referredby" id="referredby" style="width:157px;" value="<?=$referred_by; ?>"/>
							<span class="valrb"></span>
						</td>
					  </tr>
					  <tr>
						<td>
							<label>Emergency No:</label> <input type="text" name="emer_no" id="emer_no" style="width:180px;" value="<?=$emergency_number;?>"/>
						</td>
						<td>
							<label>Permanent place:</label> <input type="text" name="permanent_place" id="permanent_place" style="width:165px;" value="<?=$permanent_place;?>" />
						</td>
						<td class="last">&nbsp;</td>
					  </tr>
					  <tr>
						<td colspan="3" class="last"><input type="reset" name="Cancel" value="Cancel"><input type="submit" name="save_hist" value="save"></td>
					  </tr>
					</table>
				</div>
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

    $('form[name=profileform]').submit(function(event){
    	var firstname = $('input[name=firstname]').val();
        var lastname = $('input[name=lastname]').val();
        var vh = false;
		  
        if(firstname === ''){
        	$('span.valfname').html("*required").addClass('error');
            vh = true;
        } else {
            $('span.valfname').html("");
        }

        if(lastname === ''){
            $('span.vallname').html("*required").addClass('error');
            vh = true;
        } else {
            $('span.vallname').html("");
        }

        if(vh){
            event.preventDefault();
        } else {
            console.log('patient added successfully');
        }
	});
});
</script>