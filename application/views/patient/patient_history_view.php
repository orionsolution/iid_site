<? $this->load->view('common/toplinks'); ?>
<div class="box boxtop patient">
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
        endif; ?>
        <table class="main tpatient" width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr class="head">
            	<td class="left" width="8%">HIV: <?=$patient_hiv_year;?></td>
				<td class="left" width="8%">ART: <?=$patient_art_year;?></td>
				<? if($patient_spouse == '+ve'): ?><td width="15%"><?=$spouse_status;?>: <span class="high"><span style="font-size:14px;"><?=$patient_spouse;?></span></span></td><? else: ?>
				<td class="left" width="15%"><?=$spouse_status;?>: <?=$patient_spouse;?></td><? endif; ?>
				<td class="left" width="14%">CHILDREN: <?=$patient_children;?></td>
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
                        	<ul class="dropdown"></ul>
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
				<td class="last" width="10%">&nbsp;</td>
            </tr>
            <tr>
                <!-- calculate person age -->
                <?php $dob = new DateTime("$patient_age");
                      $now = new DateTime('now');                                                                                                   
					  function year_diff($date1, $date2) {                                                    
                      list($year1, $dayOfYear1) = explode(' ', $date1->format('Y z'));                                                              
					  list($year2, $dayOfYear2) = explode(' ', $date2->format('Y z'));                                                              
					  return $year1 - $year2 - ($dayOfYear1 < $dayOfYear2);                                                
					  }                        
					  $age = year_diff($now, $dob); ?>
                <td colspan="4">
					<a href="#"><span class="name"><?php echo $patient_name . " " . $patient_surname;?> <?php if($patient_age != '1970-01-01'  && $patient_age != '' && $patient_age != '0000-00-00'): ?>-<?php endif; ?></span></a> 
					<span class="age"><?php if($patient_age != '1970-01-01'  && $patient_age != '' && $patient_age != '0000-00-00'):
                                              echo "$age yrs."; 
                                       endif; ?>
					</span><br />
					<table width="65%" border="0" cellspacing="0" cellpadding="0" style="margin:0; padding:0;">
						<tr>
							<td class="nop" width="50%" valign="top">
								<?php if($str != ''): ?><span class="bottomtext" style="color:#fff; font-size:10px; margin-right:10px;"><?=$str;?></span><?php endif; ?>
								<?php if($last_visit_date != ''): ?>
									<span class="bottomtext" style="font-size:10px; text-transform:uppercase;">last visit <?=($last_visit_date != '') ? date("d M.Y", strtotime($last_visit_date)): '';?></span>
								<?php endif; ?>
							</td>
						</tr>
					</table>
				</td>
                <td valign="top">EFV + ERV + ARC <br />
					<span class="bottomtext"><?=($last_visit_date != '') ? date("d M.'y", strtotime($last_visit_date)): '';?></span>
				</td>
                <? if(!empty($patient_weight_details)):
                foreach($patient_weight_details as $row):?>
                <td align="center" valign="top"><?=(isset($row->addinfo)) ? $row->addinfo: '&nbsp;';?><br />
                	<span class="bottomtext"><?=date("d M.'y", strtotime($row->visit_dt));?></span>
                </td>
                <? endforeach;
                else:?>
                <td align="center" valign="top">&nbsp;
                <? endif; ?>
				
                <? if(!empty($patient_cd4_details)): 
                foreach($patient_cd4_details as $row):?>
				<td align="center" valign="top">
                	<span class="high"><?=$row->cd4;?></span> <br><span class="bottomtext"><?=date("d M.'y", strtotime($row->visit_dt));?></span>                </td>
                <? endforeach; 
                else: ?>
                	<td align="center" valign="top">&nbsp;
                <? endif; ?>
                                                
                <? if(!empty($patient_vl_details)):  
                foreach($patient_vl_details as $row):?>
				<td align="center" valign="top"><?=$row->viral_load;?><br />
                	<span class="bottomtext"><?=date("d M.'y", strtotime($row->visit_dt));?></span>
                </td>
                <? endforeach;
                else:?>
                <td align="center" valign="top">&nbsp;
                <? endif; ?>
                                                   
                <? if(!empty($patient_creatinine_details)): 
                foreach($patient_creatinine_details as $row):?>
                <td align="center" valign="top">
                	<span class="high"><?=$row->creatinine;?></span><br><span class="bottomtext"><?=date("d M.'y", strtotime($row->visit_dt));?></span>
                </td>
                <? endforeach;
                else:?>
                <td align="center" valign="top">&nbsp;
                <? endif; ?>
				<td valign="top" class='last'>&nbsp;</td>
			</tr>
    	</table>
    </div>
	
	<div class="visitbottom" id="patient_record"></div>
</div>
<!-- end of box div -->

<?
   /*if($this->uri->segment(2) == 'visit'):
      $date_cnt = 3;
   else:
      $date_cnt = '';
   endif;*/
   $uri_seg = $this->uri->segment(2);
?>
                
<script type="text/javascript">
$(document).ready(function(){
  var date_count = "<?=$date_cnt;?>";
  //var uri_seg = "<?=$uri_seg;?>";
  console.log("Date count is: " + date_count);
  //console.log("Uri Segment is: " + uri_seg);
});
</script>

<script type="text/javascript">
$(document).ready(function(){
	var url="<?=base_url()?>patient/record/<?=$mrd_no?>/<?=$date_cnt?>";
	$.get( url, function( data ) {
    	if(data === ''){
        	console.log('No Records Found');
            $( "#patient_record" ).html('No Records Found');
        } else {
        	$( "#patient_record" ).html( data );
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