<?php // echo '<pre>'; print_r($param_arr);exit;?>
<?php //  echo '<pre>'; print_r($patient_lab_data);exit;?>
<style type="text/css" media="screen">			
			#tabs-1, #tabs-2, #tabs-3, #tabs-4, #tabs-5{
				position: relative;
			}
			
			.select_box.hidden{
				display: none;
			}
			
			.select_box{
				width: 348px;
			}
		</style>
		<div class="toplinks">
			<a href="<?=base_url();?>patient/profile/<?=$mrd_no;?>">PATIENT PROFILE</a>   |   <a href="<?=base_url();?>patient/patient_history/<?=$mrd_no;?>">PATIENT HISTORY</a>
		</div>
		<div class="box">
			<div class="visittop">
				<?php foreach($patient_info as $curr_patient):
						$patient_name = $curr_patient['firstname'];
						$patient_surname = $curr_patient['surname'];
						$patient_age = $curr_patient['date_of_birth'];
                                                $patient_hiv_year = $curr_patient['hiv_year'];
                                                $patient_art_year = $curr_patient['art_year'];
                                                $patient_children = $curr_patient['children'];
                                                $patient_spouse = $curr_patient['spouse'];
                                                $patient_diabetic = $curr_patient['diabetic'];
                                                $patient_hypertension = $curr_patient['hypertension'];
                                                $patient_gender = $curr_patient['gender'];
					  endforeach;
                                          $str = '';
                                          if($patient_diabetic == 'Yes' && $patient_hypertension == 'Yes'):
                                            $str = "Diabetic, Hypertension";
                                          elseif($patient_diabetic == 'Yes'):
                                            $str = 'Diabetic';
                                          elseif($patient_hypertension == 'Yes'):
                                            $str = 'Hypertension';
                                          else:
                                            $str = '';
                                          endif;
                                          
                                          $spouse_status = '';
                                          if($patient_gender == 'Male'):
                                            $spouse_status = 'Wife';
                                          elseif($patient_gender == 'Female'):
                                            $spouse_status = 'Husband';
                                          else:
                                            $spouse_status = 'Spouse';
                                            $patient_spouse = 'None';
                                          endif;
                                          
				?>

				<table class="main" width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr class="head">
						<td class="left" width="8%">HIV: <?=$patient_hiv_year;?></td>
						<td class="left" width="8%">ART: <?=$patient_art_year;?></td>
						<td width="14%"><?=$spouse_status;?>: <span class="high"><span style="font-size:14px;"><?=$patient_spouse;?></span></span></td>
						<td class="left" width="13%">CHILDREN: <?=$patient_children;?></td>
						<td width="15%" class="nopad">
							<div class="wrapper-demo">
									<div id="dd" class="wrapper-dropdown">REGIMEN
										<ul class="dropdown">
											<li><a href="#">EFV + ERV + ARC</a></li>
											<li><a href="#">ERV + ARC</a></li>
											<li><a href="#">EFV + ERV</a></li>
											<li><a href="#">ARC</a></li>
											<li><a href="#">ERV</a></li>
										</ul>
									</div>
							</div>
						</td>
						<td width="8%" class="nopad">
							<div class="wrapper-demo">
									<div id="dd5" class="wrapper-dropdown">wgt
										<ul class="dropdown"></ul>
									</div>
							</div>
						</td>
						<td width="8%" class="nopad">
							<div class="wrapper-demo">
									<div id="dd2" class="wrapper-dropdown">cd4
                                                                          <ul class="dropdown" style="width:120px;"></ul>
									</div>
							</div>
						</td>
						<td width="8%" class="nopad">
							<div class="wrapper-demo">
									<div id="dd3" class="wrapper-dropdown">vl
                                                                          <ul class="dropdown"></ul>
									</div>
							</div>
						</td>
						<td width="10%" class="nopad">
							<div class="wrapper-demo">
									<div id="dd4" class="wrapper-dropdown">creatine
										<ul class="dropdown"></ul>
									</div>
							</div>
						</td>
						<td class="last" width="12%">&nbsp;</td>
					  </tr>
					  <tr>
                                              <!-- calculate person age -->
                                              <?php 
                                                $dob = new DateTime("$patient_age");
                                                $now = new DateTime('now');                                            

                                                function year_diff($date1, $date2) {
                                                    list($year1, $dayOfYear1) = explode(' ', $date1->format('Y z'));
                                                    list($year2, $dayOfYear2) = explode(' ', $date2->format('Y z'));
                                                    return $year1 - $year2 - ($dayOfYear1 < $dayOfYear2);
                                                }
                                                
                                                $age = year_diff($now, $dob);
                                              
                                              ?>
                                              <td colspan="4"><a href="#"><span class="name"><?php echo $patient_name . " " . $patient_surname;?> -</span></a> <span class="age"><?php 
                                                if($patient_age != '1970-01-01'  && $patient_age != ''):
                                              echo "$age yrs."; 
                                                endif; ?></span><br />
												<table width="65%" border="0" cellspacing="0" cellpadding="0" style="margin:0; padding:0;">
												  <tr>
													<td class="nop" width="50%" valign="top"><span class="bottomtext" style="color:#fff; font-size:10px;"><?=$str;?></span></td>
													<td class="nop" align="right" width="50%" valign="top"><span class="bottomtext" style="font-size:10px;"><?=($last_visit_date != '') ? date("d M.'y", strtotime($last_visit_date)): '';?></span></td>
												  </tr>
												</table>
												</td>
					
						<td valign="top">EFV + ERV + ARC <br />
					    <span class="bottomtext"><?=($last_visit_date != '') ? date("d M.'y", strtotime($last_visit_date)): '';?></span></td>
						<?if(!empty($patient_weight_details)):
                                                  foreach($patient_weight_details as $row):?>
                                                <td align="center" valign="top"><?=(isset($row->addinfo)) ? $row->addinfo: '&nbsp;';?><br />
                                                <span class="bottomtext"><?=date("d M.'y", strtotime($row->visit_dt));?></span>
                                                </td>
                                                <?endforeach;
                                                else:?>
                                                 <td align="center" valign="top">&nbsp;
                                                <?endif;?>
                                                
                                                
                                                <?if(!empty($patient_cd4_details)): 
                                                  foreach($patient_cd4_details as $row):?>
						<td align="center" valign="top">
                                                  <span class="high"><?=$row->cd4;?></span> <br><span class="bottomtext"><?=date("d M.'y", strtotime($row->visit_dt));?></span>                                                </td>
                                                <?endforeach; 
                                                else:?>
                                                 <td align="center" valign="top">&nbsp;
                                                <?endif;?>
                                                
                                                
                                                <?if(!empty($patient_vl_details)):  
                                                  foreach($patient_vl_details as $row):?>
						<td align="center" valign="top"><?=$row->vldl;?><br />
                                                  <span class="bottomtext"><?=date("d M.'y", strtotime($row->visit_dt));?></span>
                                                </td>
                                                <?endforeach;
                                                else:?>
                                                 <td align="center" valign="top">&nbsp;
                                                <?endif;?>
                                                   
                                                <?if(!empty($patient_creatinine_details)): 
                                                  foreach($patient_creatinine_details as $row):?>
                                                  <td align="center" valign="top">
                                                  <span class="high"><?=$row->creatinine;?></span><br><span class="bottomtext"><?=date("d M.'y", strtotime($row->visit_dt));?></span>
                                                </td>
                                                <?endforeach;
                                                else:?>
                                                <td align="center" valign="top">&nbsp;
                                                <?endif;?>
						<td valign="top" class='last'>&nbsp;</td>				  
				  </tr>
				</table>
				
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1">History</a></li>
						<li><a href="#tabs-2">Examination</a></li>
						<li><a href="#tabs-3">INVESTIGATIONS</a></li>
						<li><a href="#tabs-4">Diagnosis</a></li>
						<li><a href="#tabs-5">Treatment</a></li>
					</ul>
					<div id="tabs-1">	
						<form id="hist_form" name="hist">					
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tbody><tr>
			<td width="24%" valign="top">
				
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="catradio">
                    	<tbody>
        		<?php foreach($param_arr['history'] as $head_arr): ?>
							
					<?php	$curr_head_id =$head_arr["head_id"];
							$curr_head_name =$head_arr["head_name"];
							$curr_parameters =$head_arr["parameters"];   ?>
                    		
							<tr><td><input type="radio" id="<?php echo $curr_head_id;?>" name="history" class="patient styled hist" value="<?php echo $curr_head_id;?>"><label for="<?php echo $curr_head_id;?>"><?php echo $curr_head_name; ?></label></td></tr>
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
							
						<?php foreach($param_arr['history'] as $head_arr): ?>
							
					<?php	$curr_head_id =$head_arr["head_id"];
							$curr_head_name =$head_arr["head_name"];
							$curr_parameters =$head_arr["parameters"];   ?>						
													
							<select id="select_<?php echo $curr_head_id; ?>" size="8" class="select_box hidden">
								
								<?php foreach($curr_parameters as $curr_parameter): ?>
									<?php $curr_param_id = $curr_parameter['parameter_id'];
										  $curr_param = $curr_parameter['parameter']; ?>
								
								<option value="<?php echo $curr_param_id; ?>"><?php echo $curr_param; ?></option>
						
						<?php endforeach; ?> <!-- end of $curr_parameters for loop -->								                          
							</select>
							
						<?php endforeach;?> <!-- end of param_arr for loop -->
                                                <span class="valparam"></span>
							<p>
								<input name="add" type="text" placeholder="Add to the list" /><input type="submit" name="add_list" value="Add" class="add" data-section-name="history" />
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
										<td align="right"><!--<input type="reset" name="Cancel" value="Cancel">--><input type="submit" name="save_hist" value="Save" class="hist">
										<input type="hidden" class="get_value" value="add_hist"/>
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
					<!-- end of tab-1 -->
										
					<div id="tabs-2">
						<form id="exam_form" name="exam">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tbody><tr>
				<td width="24%" valign="top">				
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="catradio">
							<tbody>
					<?php foreach($param_arr['examination'] as $head_arr): ?>
								
						<?php	$curr_head_id =$head_arr["head_id"];
								$curr_head_name =$head_arr["head_name"];
								$curr_parameters =$head_arr["parameters"];   ?>
								
								<tr><td><input type="radio" id="<?php echo $curr_head_id;?>" name="history" class="patient styled exam" value="<?php echo $curr_head_id;?>"><label for="<?php echo $curr_head_id;?>"><?php echo $curr_head_name; ?></label></td></tr>
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
								
							<?php foreach($param_arr['examination'] as $head_arr): ?>
								
						<?php	$curr_head_id =$head_arr["head_id"];
								$curr_head_name =$head_arr["head_name"];
								$curr_parameters =$head_arr["parameters"];   ?>						
														
								<select id="select_<?php echo $curr_head_id; ?>" size="8" class="select_box hidden">
									
									<?php foreach($curr_parameters as $curr_parameter): ?>
										<?php $curr_param_id = $curr_parameter['parameter_id'];
											  $curr_param = $curr_parameter['parameter']; ?>
									
									<option value="<?php echo $curr_param_id; ?>"><?php echo $curr_param; ?></option>
							
							<?php endforeach; ?> <!-- end of $curr_parameters for loop -->								                          
								</select>
								
							<?php endforeach;?> <!-- end of param_arr for loop -->
                                                        <span class="valparam"></span>
								<p>
									<input name="add" type="text" placeholder="Add to the list" /><input type="submit" name="add_list" value="Add" class="add" data-section-name="examination" />
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
											<td align="right"><!--<input type="reset" name="Cancel" value="Cancel">--><input type="submit" name="save_hist" value="Save" class="exam">
											<input type="hidden" class="get_value" value="add_exam"/>
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
					<!-- end of tab-2 -->	
						
<div id="tabs-3">
        <form id="invest_form" name="invest">
                <div id="investigations">				
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tbody><tr>
                                                <td width="39%" valign="top">
                                                <div class="investc"><strong>INV.</strong></div>
                                        <?php foreach($param_arr['Investigation'] as $head_arr): ?>
                                        <?php	$curr_head_id =$head_arr["head_id"];
                                                        $curr_head_name =$head_arr["head_name"];
                                                        $curr_parameters =$head_arr["parameters"];   ?>						
        <?php  if($curr_head_id == 272):?>											
                                                <select id="select_<?php echo $curr_head_id; ?>" size="8" class="select_box">
                                                        <?php foreach($curr_parameters as $curr_parameter): ?>
                                                                <?php $curr_param_id = $curr_parameter['parameter_id'];
                                                                          $curr_param = $curr_parameter['parameter']; ?>
                                                        <option value="<?php echo $curr_param_id; ?>"><?php echo $curr_param; ?></option>

                                                <?php endforeach; ?> <!-- end of $curr_parameters for loop -->								                          
                                                </select>
        <?php endif; ?>
                                                <? endforeach;?>
                                                <span class="valparam"></span>
											<p><input name="add" type="text" placeholder="Add to the list" /><input type="submit" name="add_list" value="Add" class="add" data-section-name="investigation" /></p>
											</td>
											<td width="1%">&nbsp;</td>
											<td width="60%">
												<span class="hidden_select"><input type="hidden" name="param_id" class="readonly" readonly /></span>						
											
			<span class="select_value"><input class="sel_subcat readonly invest" type="text" name="param" value="" readonly /></span>
												<div class="investt">VAULE / RESULT</div>
												<div><input id="invest_result" name="invest_result" type="text" /><input type="submit" name="save_invest" value="Save" class="add"></div>
											</td>
										  </tr>
										</tbody></table>
									</div> 
						</form>
					</div>
					<!-- end of tab-3 -->
					
					<div id="tabs-4">
					<form id="diag_form" name="diag">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tbody><tr>
			<td width="24%" valign="top">
				
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="catradio">
                    	<tbody>
        		<?php foreach($param_arr['diagnosis'] as $head_arr): ?>
							
					<?php	$curr_head_id =$head_arr["head_id"];
							$curr_head_name =$head_arr["head_name"];
							$curr_parameters =$head_arr["parameters"];   ?>
                    		
							<tr><td><input type="radio" id="<?php echo $curr_head_id;?>" name="history" class="patient styled diag" value="<?php echo $curr_head_id;?>"><label for="<?php echo $curr_head_id;?>"><?php echo $curr_head_name; ?></label></td></tr>
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
							
						<?php foreach($param_arr['diagnosis'] as $head_arr): ?>
							
					<?php	$curr_head_id =$head_arr["head_id"];
							$curr_head_name =$head_arr["head_name"];
							$curr_parameters =$head_arr["parameters"];   ?>						
													
							<select id="select_<?php echo $curr_head_id; ?>" size="8" class="select_box hidden">
								
								<?php foreach($curr_parameters as $curr_parameter): ?>
									<?php $curr_param_id = $curr_parameter['parameter_id'];
										  $curr_param = $curr_parameter['parameter']; ?>
								
								<option value="<?php echo $curr_param_id; ?>"><?php echo $curr_param; ?></option>
						
						<?php endforeach; ?> <!-- end of $curr_parameters for loop -->								                          
							</select>
							
						<?php endforeach;?> <!-- end of param_arr for loop -->
                                                <span class="valparam"></span>
							<p>
								<input name="add" type="text" placeholder="Add to the list" /><input type="submit" name="add_list" value="Add" class="add" data-section-name="diagnosis" />
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
										<td align="right"><!--<input type="reset" name="Cancel" value="Cancel">--><input type="submit" name="save_hist" value="Save" class="diag">
										<input type="hidden" class="get_value" value="add_diag"/>
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
					<!-- end of tab-4 -->
					
					<div id="tabs-5">
                        <form id="treat_form" name="treat">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tbody><tr>							
							<td>				
								<div id="treatment">				
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tbody><tr>
										<td width="34%" valign="top">
										<div class="treatc"><strong>RX</strong></div>
										<?php foreach($param_arr['treatment'] as $head_arr): ?>
										<?php	$curr_head_id =$head_arr["head_id"];
												$curr_head_name =$head_arr["head_name"];
												$curr_parameters =$head_arr["parameters"];   ?>						
						<?php  if($curr_head_id == 25):?>											
											<select id="select_<?php echo $curr_head_id; ?>" size="8" class="select_box">
												<?php foreach($curr_parameters as $curr_parameter): ?>
													<?php $curr_param_id = $curr_parameter['parameter_id'];
														  $curr_param = $curr_parameter['parameter']; ?>
												<option value="<?php echo $curr_param_id; ?>"><?php echo $curr_param; ?></option>
									
											<?php endforeach; ?> <!-- end of $curr_parameters for loop -->								                          
											</select>
						<?php endif; ?>						
										<?php endforeach;?> <!-- end of param_arr for loop -->
<!--										<select id="select_1" size="8" class="select_box" style="min-width:250px; width:335px;">
											<option value="601">Abdominal Distension</option>
											<option value="426">Abrasion</option>
											<option value="356">Abscess</option>
											<option value="204">Absent Mind</option>
											<option value="66">Acidity</option>
											<option value="158">Active Herpes</option>
											<option value="473">Aeneform Eruption On Forehead</option>
											<option value="477">Agoivation Of Psoriasis</option>
											<option value="593">Alcohol Binge </option>
											<option value="244">Allergic Rashes In Mouth</option>
											<option value="400">Allergy To Dust</option>
											<option value="586">Alopecia</option>
											<option value="621">Altered Sensorium</option>
											<option value="147">Ameferm Eruption</option>
											<option value="582">Amenorrhea</option>
											<option value="678">Amnesia</option>
											<option value="384">Angular Stamatiul ( H S V )</option>
											<option value="46">Anorexia </option>
											<option value="311">Anxiety</option>
											<option value="655">Apathy</option>
											<option value="676">Aphasia</option>
											<option value="71">Appetite Increased</option>
											<option value="514">Apthous</option>
											<option value="160">Apthous Ulcer</option>
										</select> -->
                                                                                <span class="valparam"></span>
										<p><input name="add" type="text" placeholder="Add to the list" /><input type="submit" name="add_list" value="Add" class="add" data-section-name="treatment" /></p>
										</td>
										<td width="1%">&nbsp;</td>
										<td width="65%" valign="top">
                                                                                    <span class="hidden_treat"><input type="hidden" name="head_id" value="25" /></span>
                                                                                    <span class="hidden_select"><input type="hidden" name="param_id" class="readonly" readonly /></span>						
											
			<span class="select_value"><input class="sel_subcat readonly treat" type="text" name="param" value="" readonly /></span>
<!--											<input class="sel_subcat readonly treat" type="text" name="param" value="Albendazole" readonly />	-->
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
																	<input type="text" id="start_date" name="start_date" readonly="readonly" style="color:#66c071;" />
																</td>
																<td align="center">
																	<div id="stopdate"></div>
																	<input type="text" id="stop_date" name="stop_date" readonly="readonly" style="color:#d95734;" />
																</td>
																<td>
																	<input name="add_treat_info[]" type="checkbox" value="Treatment failure" /> Treatment failure<br />
																	<input name="add_treat_info[]" type="checkbox" value="Clinical Progression / Hosp." /> Clinical Progression / Hosp.<br />
																	<input name="add_treat_info[]" type="checkbox" value="Patient decision / Request" /> Patient decision / Request<br />
																	<input name="add_treat_info[]" type="checkbox" value="Compliance difficulties" /> Compliance difficulties <br />
																	<input name="add_treat_info[]" type="checkbox" value="Drug Allergy" /> Drug Allergy<br />
																	<input name="add_treat_info[]" type="checkbox" value="Family History" /> Family History<br />
																	<input name="add_treat_info[]" type="checkbox" value="Social Psycho Aspects" /> Social Psycho Aspects
																	<div><input type="hidden" class="get_value" value="add_treat"/> <input type="submit" name="save_treat" value="Save" class="treat"></div>
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
					<!-- end of tab-5 -->
				</div>
			</div>
		
		
		<div class="visitbottom" id="patient_record">
				
		</div>
		
		</div> <!-- end of box div -->

                
                
                
<?
   if($this->uri->segment(2) == 'visit'):
      $date_cnt = 3;
   else:
     $date_cnt = '';
   endif;
   $uri_seg = $this->uri->segment(2);
?>
                
<script>
$(document).ready(function(){
  
  var date_count = "<?=$date_cnt;?>";
  var uri_seg = "<?=$uri_seg;?>";
  console.log("Date count is: " + date_count);
  console.log("Uri Segment is: " + uri_seg);
});
</script>
                
                
<script type="text/javascript">
		$(document).ready(function(){
			var url="<?=base_url()?>patient/record/<?=$mrd_no?>/3";			
			$.get( url, function( data ) {
                              if(data === ''){
                                console.log('No Records Found');
                                $( "#patient_record" ).html('No Records Found');
                              }else{
                                $( "#patient_record" ).html( data );
                              }
                              				 
			});
			
			
			
			
			
			$('#hist_form').find('input[type=radio]').first().attr('checked','checked');			
			$('#exam_form').find('input[type=radio]').first().attr('checked','checked');
			$('#diag_form').find('input[type=radio]').first().attr('checked','checked');
			$('#treat_form').find('input[type=radio]').first().attr('checked','checked');
	
			
				
			
			$('#tabs-1 .select_box').first().removeClass('hidden');
			$('#tabs-2 .select_box').first().removeClass('hidden');
			$('#tabs-3 .select_box').first().removeClass('hidden');
			$('#tabs-4 .select_box').first().removeClass('hidden');
			
			
			var href = $('li.ui-tabs-active').find('a').attr('href');
			var curr_tab_div = $('div#' + href);
			
			var curr_radio_text = $(curr_tab_div).find('input[type=radio]:checked').siblings('label').text();
			var curr_radio_value = $(curr_tab_div).find('input[type=radio]:checked').val();
			
			$('span.catname').text(curr_radio_text);
			$('span.hidden_radio input[name=head_id]').val(curr_radio_value);
			
			
			
			
			
			// tabs selection
			
			$('li.ui-state-default').click(function(){
				
				var anchor_href = $(this).find('a').attr('href');
                                
                                var div = $('div'+anchor_href);	
                                
                                   
				
				var curr_radio = $(div).find('input[type=radio]:checked');
				var curr_option = $(div).find('select option:selected');			
				
				var curr_text = $(curr_radio).siblings('label').text();
                                
                             
				
				$('span.catname').text(curr_text);
				$('span.hidden_radio input[name=head_id]').val(curr_radio.val());
				
                                
				
				if(curr_option){					
					$('span.select_value input[name=param]').val(curr_option.text());
					$('span.hidden_select input[name=param_id]').val(curr_option.val());
                                        console.log('inside if');
				}else{
					$('span.select_value input[name=param]').val("");
					$('span.hidden_select input[name=param_id]').val("");
                                        console.log('inside else');
				}
						
			});
					
			
			
			function get_url(value){
				var add_url = "<?=base_url(); ?>patient/" + value + "/<?=$mrd_no?>";
				console.log(add_url);
				return add_url;				
					
			}
			
			$.ajaxSetup({ cache: false });
                        
			$('#hist_form, #exam_form, #diag_form').submit(function(event){                                
                                var cat_val = $(this).find('input.sel_subcat').val();
                                console.log("Cat val " + cat_val);
                                if(cat_val === ''){
                                  event.preventDefault();
                                  $('span.valparam').addClass('error').html("* required");
                                }else{
				event.preventDefault();
                                $('span.valparam').html("");
				var value = $(this).find('input.get_value').val();
				var add_url = get_url(value);
				
				var info = $(this).serialize();
								
				$.post(add_url, info, function(){
					console.log('insert successful');
				});
				
				var url = "<?=base_url(); ?>patient/record/<?=$mrd_no?>/3/";
				$.get(url,function(data) {
                                        console.log('data loading');
					$("#patient_record").html("loading");
					//alert("new");
					$("#patient_record").html(data);
				});
                              }
						
			});
                        
                        // treatment form submission
                        
                        $('#treat_form').submit(function(event){
                            event.preventDefault();
                            var value = $(this).find('input.get_value').val();
                            var add_url = get_url(value);
                            
                            console.log("Value is " + value + " url is " + add_url);
                            
                            var info = $(this).serialize();
								
				$.post(add_url, info, function(){
					console.log('insert successful');
				});
				
				var url = "<?=base_url(); ?>patient/record/<?=$mrd_no?>/3/";
				$.get(url,function(data) {
                                        console.log('data loading');
					$("#patient_record").html(data);
				});
                            
                            
                            
                        });
				
			
			function select_click(){
                            $('.select_box option').click(function(){
				var select_text= $(this).text();
				var select_value = $(this).val();
				
				
				$('span.hidden_select input[name=param_id]').val(select_value);
				$('span.select_value input[name=param]').val(select_text);				
                            });
                        }
			
                        select_click();
			
			
			
		$('input[type=radio].patient, span.radio').click(function(){			

			
			
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
		});
	</script>
        
	
        <script>
                $(document).ready(function(){
                    $('input[name=add_list]').click(function(event){
                        if($('input[name=add]').val() === ''){
                          $(this).after('<span class="error">Please provide some value</span>');
                          event.preventDefault();
                        }else{
                          event.preventDefault();
                          $(this).next('span.error').text("");
                        var add_list_value = $(this).prev('input[name=add]').val();
                        var section_name = $(this).attr('data-section-name');
                        console.log(add_list_value);
                        console.log(section_name);
                        if(section_name !== 'treatment' && section_name !== 'investigation'){
                            var href = $('li.ui-tabs-active').find('a').attr('href');
                            var curr_tab_div = $('div#' + href);

                            var curr_radio_value = $(curr_tab_div).find('input[type=radio]:checked').val();
                        } else if(section_name === 'treatment'){
                            var curr_radio_value = 25;
                        } else if(section_name === 'investigation'){
                            var curr_radio_value = 272;
                        }
                        

                        console.log(curr_radio_value);
                        
                        
			function select_click(){
                            $('.select_box option').click(function(){
				var select_text= $(this).text();
				var select_value = $(this).val();
				
				
				$('span.hidden_select input[name=param_id]').val(select_value);
				$('span.select_value input[name=param]').val(select_text);				
                            });
                        }

                        var url = "<?=base_url();?>patient/add_list_value";
                        var data_sent = {'sec_name': section_name, 'list_value': add_list_value, 'head_id': curr_radio_value};
                        $.post(url,data_sent,function(data){
                            $('input[name=add]').val("");                           
                            console.log(data);
                            var select_ele = $('select[id=select_' + curr_radio_value+']').html(data);
                            var optn_text = $(select_ele).find('option:selected').text();
                            var optn_value = $(select_ele).find('option:selected').val();
                            $('span.hidden_select input[name=param_id]').val(optn_value);
                            $('span.select_value input[name=param]').val(optn_text);
                            var textarea_id = section_name.substr(0,4);
                            console.log('textarea id is ' + textarea_id);
                            $('textarea#' + textarea_id + '_info').focus();
                            select_click();

                        });
                      }
                });
                
                

        // Investigation Form Submit
        
$('#invest_form').submit(function(event){
    event.preventDefault();
    console.log('investigation form submit');    
    
    var column_name = $(this).find('input.sel_subcat').val();
    var column_value = $(this).find('input[name=invest_result]').val();
    
    console.log(column_name);
    console.log(column_value);
    
    var info = {
        'column_name': column_name,
        'column_value': column_value
    };
    
    var add_url = "<?=base_url();?>patient/add_inv/<?=$mrd_no;?>";
    
    $.post(add_url, info, function(){
        $('#invest_form').find('input[name=invest_result]').val("");        
    });
    var url = "<?=base_url(); ?>patient/record/<?=$mrd_no?>/3/";
				$.get(url,function(data) {                                        
					$("#patient_record").html(data);
        });
    
    
});


});
                                                            
</script>

<script>
$(function() {
		//$("#startdate").datepicker();
		//$("#stopdate").datepicker();		
		var currenttime = new Date();
		var month = currenttime.getMonth() + 1;
		var day = currenttime.getDate();
		var year = currenttime.getFullYear();
		document.getElementById("start_date").value = month + "/" + day + "/" + year;
		document.getElementById("stop_date").value = month + "/" + day + "/" + year;
		   
		$('#startdate').datepicker({
			dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
			onSelect: function(date, obj){
				$('#start_date').val(date);  //Updates value of of your input 
				$('#stopdate').datepicker( "option", "minDate", date );
				$('#stop_date').val(date);
			}
		});
		$('#stopdate').datepicker({
			dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
			onSelect: function(date, obj){
				$('#stop_date').val(date);  //Updates value of of your input 
			}
		});
	});
</script>
        
        
        
	<!-- jQuery if needed -->
		<script type="text/javascript">
			/*function DropDown(el) {
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;
					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						if($('#dd').hasClass('active')){
							$('#dd2').removeClass('active');
						} else if($('#dd2').hasClass('active')){
							$('#dd').removeClass('active');
						}
						event.stopPropagation();
					});	
				}
			}*/
			$('#dd').on('click', function(event){
				$(this).toggleClass('active');
				if($('#dd').hasClass('active')){
					$('#dd2').removeClass('active');
					$('#dd3').removeClass('active');
					$('#dd4').removeClass('active');
					$('#dd5').removeClass('active');
				}
                               
				event.stopPropagation();
			});	
			$('#dd2').on('click', function(event){
				$(this).toggleClass('active');
				if($('#dd2').hasClass('active')){
					$('#dd').removeClass('active');
					$('#dd3').removeClass('active');
					$('#dd4').removeClass('active');
					$('#dd5').removeClass('active');
				}				
                                var url = "<?=base_url();?>patient/get_cd4/<?=$mrd_no?>";
                                $.get(url,function(data){                                    
                                    $('#dd2 ul.dropdown').html(data);
                                });
                                event.stopPropagation();
                                
			});
			$('#dd3').on('click', function(event){
				$(this).toggleClass('active');
				if($('#dd3').hasClass('active')){
					$('#dd').removeClass('active');
					$('#dd2').removeClass('active');
					$('#dd4').removeClass('active');
					$('#dd5').removeClass('active');
				}
                                var url = "<?=base_url();?>patient/get_vl/<?=$mrd_no?>";
                                $.get(url,function(data){
                                    $('#dd3 ul.dropdown').html(data);
                                });
				event.stopPropagation();
			});
			$('#dd4').on('click', function(event){
				$(this).toggleClass('active');
				if($('#dd4').hasClass('active')){
					$('#dd').removeClass('active');
					$('#dd2').removeClass('active');
					$('#dd3').removeClass('active');
					$('#dd5').removeClass('active');
				}
                                
                                var url = "<?=base_url();?>patient/get_creatinine/<?=$mrd_no?>";
                                $.get(url,function(data){
                                    $('#dd4 ul.dropdown').html(data);
                                });
                                
				event.stopPropagation();
			});  
			$('#dd5').on('click', function(event){
				$(this).toggleClass('active');
				if($('#dd5').hasClass('active')){
					$('#dd').removeClass('active');
					$('#dd2').removeClass('active');
					$('#dd3').removeClass('active');
					$('#dd4').removeClass('active');
				}
                                 var url = "<?=base_url();?>patient/get_patient_weight/<?=$mrd_no?>";
                                $.get(url,function(data){
                                    $('#dd5 ul.dropdown').html(data);
                                });
				event.stopPropagation();
			});                          

                        
                        $(document).click(function(){
                            $('#dd,#dd2,#dd3,#dd4,#dd5').removeClass('active');
                        });
                        
                        
                        
                        
                        
                        
			/*$(function() {
				var dd = new DropDown( $('#dd') );
				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown').removeClass('active');
				});
				
				var dd2 = new DropDown( $('#dd2') );
				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown').removeClass('active');
				});
			});*/
		</script>
