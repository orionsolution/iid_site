	<div id="add">
		<div class="box">
			<div class="top">
				EDIT PATIENT FORM
			</div>
			<div class="bottom">
                            <?php foreach($edit_info as $curr_patient): 
                                            $mrdno = $curr_patient['mrdno'];
                                            $firstname = $curr_patient['firstname'];
                                            $lastname = $curr_patient['surname'];
                                            $referred_by = $curr_patient['refdr'];
                                            $present_city = $curr_patient['present_city'];
                                            $permanent_place = $curr_patient['permanent_place'];
                                            $education = $curr_patient['edu'];
                                            $occupation = $curr_patient['occu'];
                                            $gender = $curr_patient['gender'];
                                            $contact_number = $curr_patient['telno'];
                                            $birth_date = $curr_patient['date_of_birth'];
                                            $per_info = $curr_patient['perinfo'];
                                    endforeach;?>
				<form name="addpatient" id="addpatient" action="<?php echo base_url() . "patient/update_patient_info/" . $mrdno; ?>" method="post">
				<table width="100%" border="0" cellspacing="5" cellpadding="0">                                    
				  <tr>
					<td width="46%" valign="top"><label>MRD Number:</label> <input type="text" name="IdentityNo" id="IdentityNo" style="width:180px;" value="<?php echo $mrdno; ?>" readonly/></td>
					<td width="8%">&nbsp;</td>
					<td width="46%" valign="top"><label>Date of Birth:</label> <input type="text" id="birth_date" name="birth_date" readonly="readonly" placeholder="DD/MM/YYYY" style="width:120px;" value="<?php 
                                        if($birth_date != '0000-00-00'):
                                        echo date("d/m/Y", strtotime($birth_date));
                                        endif;?>"/></td>
				  </tr>
				  <tr>
					<td><div class="brdr"></div></td>
					<td>&nbsp;</td>
					<td><div class="brdr" style="width:245px;"></div></td>
				  </tr>
				  <tr>
					<td valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="35%"><label>Patient Name:</label></td>
                                                        <td width="65%"><input type="text" name="firstname" id="firstname" placeholder="First Name" style="width:180px;" value="<?php echo $firstname; ?>"/><span style="color: red;" class="validate_firstname"></span></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><p style="margin:10px 0 0 0;"><input type="text" name="lastname" id="lastname" placeholder="Last Name" style="width:180px;" value="<?php echo $lastname; ?>"/></p><span style="color: red;" class="validate_lastname"></span></td>
						  </tr>
						</table>					</td>
					<td>&nbsp;</td>
					<td valign="top">
						<label>Gender:</label>
						<select name="gender" id="gender">
							<?php foreach($misc_data['gender'] as $curr_gender): 
                                                        if($curr_gender == $gender):
                                                            echo "<option value='$curr_gender' selected='selected'>$curr_gender</option>";                                               
                                                        else:
                                                            echo "<option value='$curr_gender'>$curr_gender</option>";                                          
                                                        endif;  
                                                        endforeach;
                                                    ?>
						</select>					</td>
				  </tr>
				  <tr>
					<td colspan="3"><div class="brdr"></div></td>
				  </tr>
				  <tr>
					<td valign="top">
						<label>Referred by:</label>
						<input type="text" name="referredby" id="referredby" style="width:180px;" value="<?php echo $referred_by; ?>"/>					</td>
					<td>&nbsp;</td>
					<td valign="top" rowspan="7">
						<label>Notes:</label>
						<div style="margin:5px 0 0 0;"></div>
						<textarea name="perinfo" id="perinfo" cols="" rows=""><?php echo $per_info;?></textarea>
						<p>
						<input type="reset" name="Cancel" value="Cancel"><input type="submit" name="save_hist" value="submit"></p>
					</td>
				  </tr>
				  <tr>
					<td><div class="brdr"></div></td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td valign="top">
						<label>Present city:</label>
						<select name="present_city" id="present_city" style="width:219px;">
                                                        
                                                    <?php foreach($misc_data['cities'] as $curr_city): 
                                                        if($curr_city == $present_city):
                                                            echo "<option value='$curr_city' selected='selected'>$curr_city</option>";                                               
                                                        else:
                                                            echo "<option value='$curr_city'>$curr_city</option>";                                          
                                                        endif;  
                                                        endforeach;
                                                    ?>
                                    
						</select>
						<div style="margin:15px 0 0 0;"></div>
						<label>Permanent place:</label>
						<select name="permanent_place" id="permanent_place" style="width:183px;">
                                                   <?php foreach($misc_data['cities'] as $curr_city): 
                                                        if($curr_city == $permanent_place):
                                                            echo "<option value='$curr_city' selected='selected'>$curr_city</option>";                                               
                                                        else:
                                                            echo "<option value='$curr_city'>$curr_city</option>";                                          
                                                        endif;  
                                                        endforeach;
                                                    ?>
						</select>					</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td><div class="brdr"></div></td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td valign="top">
						<label>Contact Number:</label><input type="text" name="contact_no" id="contact_no" style="width:168px;" value="<?php echo $contact_number;?>" />
						<div style="margin:15px 0 0 0;"></div>
						<label>Alternate Number:</label><input type="text" name="alt_no" id="alt_no" style="width:157px;" />					</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td><div class="brdr"></div></td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td valign="top">
						<label>Education:</label>
						<select name="education" id="education" style="width:230px;">
                                                     <?php foreach($misc_data['education'] as $curr_edu): 
                                                        if($curr_edu == $education):
                                                            echo "<option value='$curr_edu' selected='selected'>$curr_edu</option>";                                               
                                                        else:
                                                            echo "<option value='$curr_edu'>$curr_edu</option>";                                          
                                                        endif;  
                                                        endforeach;
                                                    ?>
                                                </select>
						<div style="margin:15px 0 0 0;"></div>
						<label>Occupation:</label>
						<select name="occupation" id="occupation" style="width:220px;">
						 <?php foreach($misc_data['occupation'] as $curr_occu): 
                                                        if($curr_occu == $occupation):
                                                            echo "<option value='$curr_occu' selected='selected'>$curr_occu</option>";                                               
                                                        else:
                                                            echo "<option value='$curr_occu'>$curr_occu</option>";                                          
                                                        endif;  
                                                        endforeach;
                                                    ?>
						</select>					</td>
					<td>&nbsp;</td>
				  </tr>
				</table>
				</form>
			</div>
                    <?php if(isset($done)): 
                    echo "<p style='text-align: center; color: green; font-weight: bold; font-size: 20px;' class='thankyou_message'>Your Information has been Updated, Thank You</p>";
                    endif;?>
		</div>
	</div>


<script>
    $('form#addpatient').submit(function(event){
        var firstname = $('input#firstname').val();
        var lastname = $('input#lastname').val();
        var validation = true;
        
        if(firstname === ""){
            $('span.validate_firstname').text("Please enter your first name");
            validation = false;            
        }else {
            $('span.validate_firstname').text("");
        }
            
        
        if(lastname === ""){
            $('span.validate_lastname').text("Please enter your last name");
            validation = false;
        }else{
            $('span.validate_lastname').text("");
        }
        
        if(validation){
            console.log('data successfully submitted');
        }else{
            $('p.thankyou_message').text("");
            event.preventDefault();
        }
    
    });
</script>

