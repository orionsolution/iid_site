<style>
    #maincontent .box .visitbottom #table_list2 span.dt{
        color: #858686;
    }
    #maincontent .box .visitbottom #table_list2 td.date {
            border-left: 2px solid #c2c2c2;
    }
    
    
    #maincontent .box .visitbottom #table_list2 tr.tr_inv td.date {
/*        text-align: center;*/
/*        padding-top: 10px;*/
            border-left: 2px solid #6ab4e5;            
    }
    
    
    
    
    #maincontent .box .visitbottom #table_list2 tr.record_info td{
        padding-left: 10px;
        padding-right: 5px;
        padding-top: 3px;
        padding-bottom: 3px;
        height: 25px;
        vertical-align: top;
    }
    
    
    
    #maincontent .box .visitbottom #table_list2 tr.tr_inv{
/*        border-left: 1px solid #6ab4e5;*/
/*          border-bottom: 2px solid #6ab4e5;*/
    }
    
    #maincontent .box .visitbottom #table_list2 #dvisit tr.record_info{
        border-bottom: 1px solid gray;
        padding-top: 5px;
    }
    
    #maincontent .box .visitbottom #table_list2 td.patient_parameter{
        background:none;
        padding:0;
    }
   
    
    td.title{
        color: #5cb1ea;
    }
</style>

<script>
    $(document).ready(function(){
        $('.fancybox_picture').fancybox({
	  //different options
	  	padding : 0,
		closeBtn : false
	 });
    });
</script>
<?php // echo '<pre>'; print_r($investigation_visit); exit;?>
<?php // echo '<pre>'; print_r($visit_arr); exit;?>
<table id="table_list2" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom: 1px solid #c2c2c2">
				  <tr class='headrow'>
					<td width="15%">date</td>
					<td width="3%">title</td>
					<td width="5%">category</td>
					<td width="46%">details</td>
                                        <td width="26%" class="last">notes</td>
					<td width="5%" class="last">&nbsp;</td>					
				  </tr>
                                  
                                
                                                
                                  
                                <!-- investigation area started -->
                                <?php 
                                            if(isset($investigation_visit)):
                                            foreach($investigation_visit as $curr_invst):?>

                                <? $last_dt=""; 
                                foreach($curr_invst as $key => $value):
                                                    if($key != 'details_id' && $key != 'mrdno' && $key != 'inv_source' && $key != 'report_dt' && $key != 'visit_dt'):
                                                            $temp_dt=date("d M. Y", strtotime($curr_invst['visit_dt']));
                                                            if(!($value == '' || $value == NULL)):?>
                                                            <tr class="td_header tr_inv record_info">
                                                                    <? if ($last_dt!=$temp_dt):?>
                                                                            <td class="date" v-align="top" data-visit-date="<?=date("d M. Y", strtotime($curr_invst['visit_dt']));?>"><?=date("d M. Y", strtotime($curr_invst['visit_dt']));?></td>
                                                                            <td class="title">INV</td>
                                                                            <td class="category" data-inv-category="<? echo ($curr_invst['inv_source'] == 'lab')?"Laboratory":"Clinic"; ?>"><? echo ($curr_invst['inv_source'] == 'lab')?"Laboratory":"Clinic"; ?></td>
                                                                    <? else:?>
                                                                            <td class="date" v-align="top" data-visit-date="<?=date("d M. Y", strtotime($curr_invst['visit_dt']));?>">&nbsp;</td>
                                                                            <td class="title">&nbsp;</td>
                                                                            <td class="category" data-inv-category="<? echo ($curr_invst['inv_source'] == 'lab')?"Laboratory":"Clinic"; ?>">&nbsp;</td>
                                                                    <? endif;?>

                                                                    <td class="detail"><?=$key;?></td>
                                                                    <td class="patient_parameter"><?=$value;?></td>
                                                                    <td class="notes last">
                                                                            <div class="dnedit">
                                                                                    <a class="fancybox_picture edit" href="#dn_edit" data-section="hist"></a>
                                                                                    <a class="fancybox_picture del" href="#dn_delete"></a>						
                                                                                    <input type="hidden" data-table="investigation" value="<?=$curr_invst['details_id'];?>" />                                                  
                                                                                    <br class="clearfloat" />
                                                                            </div>
                                                                    </td>
                                                            </tr>
                                                            <? $last_dt=$temp_dt;  endif; endif; endforeach;?>
            <?php endforeach; endif;?>
  
                                <!-- investigation area ends -->
                                
                                <?
                                      $cnt=0;
                                      foreach($visit_arr as $curr_visit): ?>

                                <? 
				 
				  if($visit_cnt!='all'): 
						if($cnt++>=$visit_cnt) break;
				  endif;
//				  $visit_date = date("d M Y", strtotime($curr_visit['visit_date']));?>
                                <!-- history area start -->
                                <?php 
                                  if(isset($curr_visit['history'])):
                                  $last_dt="";
                                  foreach($curr_visit['history'] as $curr_history):                                  
                                  $temp_dt=date("d M. Y", strtotime($curr_history['visit_dt']));
                                ?>
                                <tr class="td_header record_info">
                                    <? if ($last_dt!=$temp_dt):?>
                                    <td class="date" v-align="top" data-visit-date="<?=date("d M. Y", strtotime($curr_history['visit_dt']));?>"><?=date("d M. Y", strtotime($curr_history['visit_dt']));?></td>
                                    <?else: ?>
                                    <td class="date" v-align="top" data-visit-date="<?=date("d M. Y", strtotime($curr_history['visit_dt']));?>">&nbsp;</td>
                                    <?endif;?>
                                    <td class="title">HIS</td>
                                    <td class="category"><?=$curr_history['head'];?></td>
                                    <td class="detail"><?=$curr_history['parameter'];?></td>
                                    <td class="patient_parameter"><?=$curr_history['addinfo'];?></td>
                                    <td class="notes last">
                                        <div class="dnedit">
                                                <a class="fancybox_picture edit" href="#dn_edit" data-section="hist"></a>
                                                <a class="fancybox_picture del" href="#dn_delete"></a>						
                                                <input type="hidden" data-table="history" value="<?=$curr_history['details_id'];?>" />                                                  
                                                <br class="clearfloat" />
                                        </div>
                                    </td>                                    
                                </tr>
                                <? $last_dt=$temp_dt; endforeach;  endif;?>
                                
                                <!-- history area end -->
                                
                                <!-- examination area start -->
                                <?php 
                                  if(isset($curr_visit['examination'])):
                                  $last_dt="";
                                  foreach($curr_visit['examination'] as $curr_exam):
                                  $temp_dt=date("d M. Y", strtotime($curr_exam['visit_dt']));
                                ?>
                                <tr class="td_header record_info">
                                    <? if ($last_dt!=$temp_dt):?>
                                    <td class="date" v-align="top" data-visit-date="<?=date("d M. Y", strtotime($curr_exam['visit_dt']));?>"><?=date("d M. Y", strtotime($curr_exam['visit_dt']));?></td>
                                    <?else: ?>
                                    <td class="date" v-align="top" data-visit-date="<?=date("d M. Y", strtotime($curr_exam['visit_dt']));?>">&nbsp;</td>
                                    <?endif;?>
                                    <td class="title">EXA</td>
                                    <td class="category"><?=$curr_exam['head'];?></td>
                                    <td class="detail"><?=$curr_exam['parameter'];?></td>
                                    <td class="patient_parameter"><?=$curr_exam['addinfo'];?></td>
                                    <td class="notes last">
                                        <div class="dnedit">
                                                <a class="fancybox_picture edit" href="#dn_edit" data-section="hist"></a>
                                                <a class="fancybox_picture del" href="#dn_delete"></a>						
                                                <input type="hidden" data-table="examination" value="<?=$curr_exam['details_id'];?>" />                                                  
                                                <br class="clearfloat" />
                                        </div>
                                    </td>
                                </tr>
                                <? $last_dt=$temp_dt; endforeach;  endif;?>
                                
                                <!-- examination area ends -->
                                
                                <!-- diagnosis area start -->
                                <?php 
                                  if(isset($curr_visit['diagnosis'])):
                                  $last_dt="";
                                  foreach($curr_visit['diagnosis'] as $curr_diag):
                                  $temp_dt=date("d M. Y", strtotime($curr_diag['visit_dt']));
                                ?>
                                <tr class="td_header record_info">
                                    <? if ($last_dt!=$temp_dt):?>
                                    <td class="date" v-align="top" data-visit-date="<?=date("d M. Y", strtotime($curr_diag['visit_dt']));?>"><?=date("d M. Y", strtotime($curr_diag['visit_dt']));?></td>
                                    <?else: ?>
                                    <td class="date" v-align="top" data-visit-date="<?=date("d M. Y", strtotime($curr_diag['visit_dt']));?>">&nbsp;</td>
                                    <?endif;?>
                                    <td class="title">DIA</td>
                                    <td class="category"><?=$curr_diag['head'];?></td>
                                    <td class="detail"><?=$curr_diag['parameter'];?></td>
                                    <td class="patient_parameter"><?=$curr_diag['addinfo'];?></td>
                                    <td class="notes last">
                                        <div class="dnedit">
                                                <a class="fancybox_picture edit" href="#dn_edit" data-section="hist"></a>
                                                <a class="fancybox_picture del" href="#dn_delete"></a>						
                                                <input type="hidden" data-table="diagnosis" value="<?=$curr_diag['details_id'];?>" />                                                  
                                                <br class="clearfloat" />
                                        </div>
                                    </td>
                                </tr>
                                <? $last_dt=$temp_dt; endforeach;  endif;?>
                                
                                <!-- diagnosis area ends -->
                                
                                
                                <!-- treatment area start -->
                                <?php 
                                  if(isset($curr_visit['treatment'])):
                                  $last_dt="";
                                  foreach($curr_visit['treatment'] as $curr_treat):
                                  $temp_dt=date("d M. Y", strtotime($curr_treat['visit_dt']));
                                ?>
                                <tr class="td_header record_info">
                                    <? if ($last_dt!=$temp_dt):?>
                                    <td class="date" v-align="top" data-visit-date="<?=date("d M. Y", strtotime($curr_treat['visit_dt']));?>"><?=date("d M. Y", strtotime($curr_treat['visit_dt']));?></td>
                                    <?else: ?>
                                    <td class="date" v-align="top" data-visit-date="<?=date("d M. Y", strtotime($curr_treat['visit_dt']));?>">&nbsp;</td>
                                    <?endif;?>
                                    <td class="title">TRE</td>
                                    <td class="category"><?=$curr_treat['head'];?></td>
                                    <td class="detail"><?=$curr_treat['parameter'];?>&nbsp;&nbsp;<br/>Period:<?=date("d M Y", strtotime($curr_treat['Sdate']));?> &nbsp; - &nbsp;<?=date("d M Y", strtotime($curr_treat['Stopdate']));?></td>
                                    <td class="patient_parameter"><?=$curr_treat['addinfo'];?></td>
                                    <td class="notes last">
                                        <div class="dnedit">
                                                <a class="fancybox_picture edit" href="#dn_treatedit" data-section="hist"></a>
                                                <a class="fancybox_picture del" href="#dn_delete"></a>						
                                                <input type="hidden" data-start-date='<?=date("m/d/Y",strtotime($curr_treat['Sdate']));?>' data-end-date='<?=date("m/d/Y",strtotime($curr_treat['Stopdate']));?>' data-treat-info='<?=$curr_treat["addinfo"];?>' data-table="treatment" value="<?=$curr_treat['details_id'];?>" />                                                  
                                                <br class="clearfloat" />
                                        </div>
                                    </td>
                                </tr>
                                <? $last_dt=$temp_dt; endforeach;  endif;?>
                                
                                <!-- treatment area ends -->
                            
                            <? endforeach;?> <!-- end of main for each loop -->                            
                                
</table>

<script>
$(document).ready(function(){                                  
    $('tr.tr_inv').find('tr.record_info').last().find('td').css('border-bottom','none');
    $('tr.record_info').hover(function(){
        $(this).css('background-color', '#fff');
        $(this).find('td.date').css({
			'background-color': '#fff',
            'color': '#5cb1ea' 
        });
        $(this).find('td.category').css('color','#5cb1ea');
        $(this).find('td.detail').css('color','#02bac5');
    }, function(){
        $(this).css({'background-color':'#f1f1f1'});
         $(this).find('td.date').css({
            'background-color': '#f1f1f1',
            'color': '#959595' 
        });
        $(this).find('td.category').css('color','#959595');
        $(this).find('td.detail').css('color','#959595');
    });
});
</script>


<script type="text/javascript">
    $("#table_list2 tr.td_header").css({'background-color':'#f1f1f1'});
    $("#table_list2 tr.td_header").css("color", "#959595");
    $('#table_list2 tr.tr_inv').last().find('td').css('border-bottom','2px solid #6ab4e5');
    $('#table_list2 tr.tr_inv').last().next('tr.record_info').find('td').css('border-top','2px solid #c2c2c2');
//    $(function() {
//        $('#table_list2 tr.td_header').hover(function() {
//            $(this).css('background-color', '#ffffff');
//			$(this).css('color', '#3daaf3');
//        }, function() {
//            $(this).css('background-color', '#f1f1f1');
//			$(this).css('color', '#959595');
//        });
//    });	
</script>




<!-- Edit Pop-up div starts -->
<div id="dn_edit" class="dn" style="display:none;">
    <div class="close_search_box"><a href="#" class="search_close_btn"></a></div>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="add_info">
	  <tr>
		<td width="30%">date</td>
		<td width="70%" class="tt ttlast ttdate">23 Jan 2014 </td>
	  </tr>
	  <tr>
		<td>title</td>
		<td class="ttlast tabname">EXAMINATION</td>
	  </tr>
	  <tr>
		<td>category</td>
		<td class="ttlast edit_catname">GENERAL</td>
	  </tr>
	  <tr>
		<td>details</td>
		<td class="tt ttlast"><span class="select_value"><input class="sel_subcat readonly" type="text" name="param" readonly="" value="Respiratory Rate"></span></td>
	  </tr>
	  <tr>
		<td class="vlast" style="color:#185e89;" valign="top">notes</td>
		<td class="vlast ttlast">
			<textarea id="hist_info" class="edit_hist" name="edit_info" cols="" rows="4">Paitent has severe cough and was bleeding.</textarea>
			<input type="submit" name="update_patient" value="Save changes" class="save" data-detail="detail_box">
                        <input type="hidden" data-table="" value=""/>
		</td>
	  </tr>			
	</table>
</div>
<!-- Edit Pop-up div ends -->

<!-- Edit Pop-up div for treatment starts -->
<div id="dn_treatedit" class="dn" style="display:none; width:600px;">
    <div class="close_search_box"><a href="#" class="search_close_btn"></a></div>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="add_info">
	  <tr>
		<td width="30%">date</td>
		<td width="70%" class="tt ttlast ttdate">23 Jan 2014 </td>
	  </tr>
	  <tr>
		<td>title</td>
		<td class="ttlast tabname">EXAMINATION</td>
	  </tr>
	  <tr>
		<td>category</td>
		<td class="ttlast edit_catname">GENERAL</td>
	  </tr>
	  <tr>
		<td>details</td>
                <td class="tt ttlast"><span class="select_value"><input class="sel_subcat readonly" type="text" name="param" readonly="" value="Respiratory Rate" style="width:300px;"/></span></td>
	  </tr>
	  <tr>
		<td class="vlast" colspan="2" style="color:#185e89;" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="treatcaledit">
				<tr>
					<th width="30%">STARTED</th>
					<th width="30%">STOPPED</th>
					<th width="40%">ADDITIONAL INFORMATION</th>
				</tr>
				<tr>
					<td align="center" valign="top">
						<div id="edit_startdate"></div>
						<input type="text" id="edit_start_date" name="edit_start_date" readonly="readonly" style="color:#66c071;" />
					</td>
					<td align="center" valign="top">
						<div id="edit_stopdate"></div>
						<input type="text" id="edit_stop_date" name="edit_stop_date" readonly="readonly" style="color:#d95734;" />
					</td>
					<td valign="top" class="check">
						<input name="add_treat_info" type="checkbox" value="Treatment failure" /> Treatment failure<br />
						<input name="add_treat_info" type="checkbox" value="Clinical Progression / Hosp." /> Clinical Progression / Hosp.<br />
						<input name="add_treat_info" type="checkbox" value="Patient decision / Request" /> Patient decision / Request<br />
						<input name="add_treat_info" type="checkbox" value="Compliance difficulties" /> Compliance difficulties <br />
						<input name="add_treat_info" type="checkbox" value="Drug Allergy" /> Drug Allergy<br />
						<input name="add_treat_info" type="checkbox" value="Family History" /> Family History<br />
						<input name="add_treat_info" type="checkbox" value="Social Psycho Aspects" /> Social Psycho Aspects
					</td>
				</tr>
			</table>
			<div style="text-align:right; padding:5px 5px 5px 0;"><input type="submit" name="edit_patient_treat" value="Save changes" class="save" data-detail="detail_box"><input type="hidden" data-table="" value=""/></div>
            
		</td>
	  </tr>			
	</table>
</div>
<!-- Edit Pop-up div ends -->


<!-- Edit Pop-up Delete div starts -->
<div id="dn_delete" class="dn" style="display:none;">
    <div class="close_search_box"><a href="#" class="search_close_btn"></a></div>
      <div><p class="del_msg">Are you sure you want to delete?</p></div>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="add_info">
	  <tr>
		<td width="30%">date</td>
		<td width="70%" class="tt ttlast ttdate">23 Jan 2014 </td>
	  </tr>
	  <tr>
		<td>title</td>
		<td class="ttlast tabname">EXAMINATION</td>
	  </tr>
	  <tr>
		<td>category</td>
		<td class="ttlast edit_catname">GENERAL</td>
	  </tr>
	  <tr>
		<td>details</td>
		<td class="tt ttlast"><span class="select_value"><input class="sel_subcat readonly" type="text" name="param" readonly="" value="Respiratory Rate"></span></td>
	  </tr>
          
	  <tr>
		<td class="vlast" style="color:#185e89;" valign="top">notes</td>
		<td class="vlast ttlast">
			<textarea id="hist_info" class="edit_hist" name="edit_info" cols="" rows="4" readonly="readonly">Paitent has severe cough and was bleeding.</textarea>
			<input name="delete_patient" type="button" value="Delete" data-detail="detail_box" />
                        <input type="hidden" data-table="" value=""/>
                        <input type="button" name="cancel" onclick="jQuery.fancybox.close();" value="Cancel"> 
		</td>
	  </tr>
                          
                          
                          
                          
                          
                          
<!--				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="95%"><div class="tabname">history</div></td>
							<td align="right" width="5%"><a href="javascript:jQuery.fancybox.close();"><img src="<?php echo base_url(); ?>fancybox/fancy_close.gif" /></a></td>
						  </tr>
						</table>
						<span class="edit_catname">Opportunistic Infection</span>
						<div class="info_details">
							<span class="select_value"><input class="sel_subcat readonly" type="text" name="param" readonly="" value="Candidiasis Of The Bronchi Treachea Or Lungs:"></span>			
							<textarea id="hist_info" class="edit_hist" name="edit_info" cols="" rows="4" readonly="readonly">Paitent has severe cough and was bleeding.</textarea>
						</div>
					</td>
				</tr>
				<tr>
					<td style="color:#FF0033; font-size:14px;">Are you sure you want to delete?</td>
				</tr>
				<tr>
					<td align="right">
                        <input name="delete_patient" type="button" value="Delete" data-detail="detail_box" />
                        <input type="hidden" data-table="" value=""/>
                        <input type="button" name="cancel" onclick="jQuery.fancybox.close();" value="Cancel">                        
					</td>
				</tr>-->
			</table>
</div>
<!-- Edit Pop-up Delete div ends -->
<?
//   if($this->uri->segment(2) == 'visit'):
//      $date_cnt = 3;
//   else:
//     $date_cnt = '';
//   endif;
//   $uri_seg = $this->uri->segment(2);
?>
    
<!--<script>
$(document).ready(function(){
  
  var date_count = "<?=$date_cnt;?>";
  var uri_seg = "<?=$uri_seg;?>";
  console.log("Date count is: " + date_count);
  console.log("Uri Segment is: " + uri_seg);
});
</script>-->

<script>
    $(document).ready(function(){
        $('a.search_close_btn').click(function(event){
          event.preventDefault();
          jQuery.fancybox.close();
          //
        });
        $('a.fancybox_picture').click(function(){
            var parent_row = $(this).parents('tr.record_info');
            var category;
            var pi_table_name = $(this).siblings('input[type=hidden]').attr('data-table');
            if($(parent_row).hasClass('tr_inv')){
              category = $(parent_row).find('td.category').attr('data-inv-category');
            }else{
              category = $(parent_row).find('.category').text();
            }
            
            if(pi_table_name === 'treatment'){
              console.log('treatment table update clicked');
              var start_date = $(this).siblings('input[type=hidden]').attr('data-start-date');
              var end_date = $(this).siblings('input[type=hidden]').attr('data-end-date');
              var treat_info = $(this).siblings('input[type=hidden]').attr('data-treat-info');
              var info = treat_info.split(",");
              console.log(info);
              console.log("start date: " + start_date);
              $('#dn_treatedit').find('input[name=edit_start_date]').val(start_date);
              $('#dn_treatedit').find('input[name=edit_stop_date]').val(end_date);
//              $('#dn_treatedit').find('input[type=checkbox]').each(function(){
//                  var curr_value = $(this).val();
//                  if(curr_value == )
//              });
//            
              $('#dn_treatedit').find('input[type=checkbox]:checked').removeAttr('checked');
              for(var i = 0; i < info.length; i++){
                $('#dn_treatedit').find('input[type=checkbox]').each(function(){
                if($(this).val() === info[i]){
                      $(this).attr('checked', 'checked');
                  }
                  });
                }
              
            }
           
            var date = $(parent_row).find('td.date').attr('data-visit-date');
            var detail = $(parent_row).find('.detail').text();
            var info = $(parent_row).find('.patient_parameter').text();
            
            
            console.log('table name: ' + pi_table_name);
            
            console.log(info);
            console.log(detail);
            console.log(category);
            
            
           var parent_div = $('.dn');

           $(parent_div).find('td.edit_catname').text(category);
           $(parent_div).find('input.sel_subcat').val(detail);
           $(parent_div).find('textarea[name="edit_info"]').text(info);
           $(parent_div).find('td.ttdate').text(date);
           
           
            
            var detail_id = $(this).siblings('input[type=hidden]').val();
            
            $('input[data-detail=detail_box]').next().attr('data-table',pi_table_name);
            $('td.tabname').text(pi_table_name);
            $('input[data-detail=detail_box]').next().val(detail_id);
            
            
            

        });
        
        
        $('input[name=edit_patient_treat]').click(function(){
          console.log('update treatment');
          
        var pi_table_name = $(this).next('input[type=hidden]').attr('data-table');
        var detail_id = $(this).next('input[type=hidden]').val();
        var column_name = $(this).parents('.dn').find('input.sel_subcat').val();
        var parent = $(this).parents('.dn');
        var add_info = [];
        $('input[name="add_treat_info"]:checked').each(function(){
          add_info.push($(this).val());
        });
        var start_date = $(parent).find('input[name=edit_start_date]').val();
        var end_date = $(parent).find('input[name=edit_stop_date]').val();
        var update_data = {
          'start_date': start_date,
          'end_date' : end_date,
          'info': add_info
        };
        console.log(add_info);
//        console.log(start_date);
//        console.log(end_date);
        
        
        console.log(pi_table_name);
        console.log('column name is ' + column_name);
        var update_url = "<?=base_url(); ?>patient/update_patient_pi_treatment/" + detail_id;
        $.post(update_url, update_data,function(data){
              console.log(data);
              console.log('data updated successfully');
              var url="<?=base_url()?>patient/record/<?=$mrd_no?>/<?=$date_cnt;?>";			
                      $.get( url, function( data ) {
                              $( "#patient_record" ).html( data );				
                      });
              jQuery.fancybox.close();
        });
//        
//          
 });
        
        
        
        $('input[name=update_patient]').click(function(){
            console.log('save buton clicked');
            
            var pi_table_name = $(this).next('input[type=hidden]').attr('data-table');
            var detail_id = $(this).next('input[type=hidden]').val();
            var add_info = $(this).parents('.dn').find('textarea').val();
            var column_name = $(this).parents('.dn').find('input.sel_subcat').val();
            
            console.log('add info is ' + add_info);
            console.log(pi_table_name);
            console.log(detail_id);
            console.log('column name is ' + column_name);
            
            // test to see if table name is not investigation
            
            if(pi_table_name !== 'investigation'){
                var update_url = "<?=base_url(); ?>patient/update_patient_pi/" + pi_table_name + "/" + detail_id;
                $.post(update_url, {'info': add_info},function(){
                    console.log('data updated successfully');
                    var url="<?=base_url()?>patient/record/<?=$mrd_no?>/<?=$date_cnt;?>";			
                            $.get( url, function( data ) {
                                    $( "#patient_record" ).html( data );				
                            });
                    jQuery.fancybox.close();
                });
            } else{
                var update_url = "<?=base_url(); ?>patient/update_patient_pi_investigation/" + detail_id;
                $.post(update_url, {'info': add_info, 'column_name': column_name},function(){
                    console.log('data updated successfully');
                    var url="<?=base_url()?>patient/record/<?=$mrd_no?>/<?=$date_cnt;?>";
                    console.log("Url : " + url);
                            $.get( url, function( data ) {
                                    $( "#patient_record" ).html( data );				
                            });
                    jQuery.fancybox.close();
                });
            
            }
            
            
        });
        
        
        $('input[name=delete_patient]').click(function(){
            console.log('will trigger');
            
            var pi_table_name = $(this).next('input[type=hidden]').attr('data-table');
            var detail_id = $(this).next('input[type=hidden]').val();
            
            console.log(pi_table_name + " " + detail_id);
            
            if(pi_table_name !== 'investigation'){
                var delete_url = "<?=base_url(); ?>patient/delete_patient_pi/" + pi_table_name + "/" + detail_id;
                $.post(delete_url,function(){
                    console.log('data successfully sent');
                    var url="<?=base_url()?>patient/record/<?=$mrd_no?>/<?=$date_cnt;?>";			
                            $.get( url, function( data ) {
                                    $( "#patient_record" ).html( data );				
                            });
                    jQuery.fancybox.close();
                });
            } else{
                var delete_url = "<?=base_url(); ?>patient/delete_patient_pi_investigation/" + detail_id;
                $.post(delete_url,function(){
                    console.log('data successfully sent');
                    var url="<?=base_url()?>patient/record/<?=$mrd_no?>/<?=$date_cnt;?>";			
                            $.get( url, function( data ) {
                                    $( "#patient_record" ).html( data );				
                            });
                    jQuery.fancybox.close();
                });
            
            }
            
            
            
        });
        
        
        
    });
</script>

<!--<script>
    
    
    
    $('input[name=delete]').click(function(){
        var row_count = $(this).parents('tr.section').siblings().length;
        var text_present = $(this).parents('tr.section').children('td').first().text();
        
        var pi_table_name = $(this).next().attr('data-table');
        var detail_id = $(this).next().val();
        
        console.log("Row count is :" + row_count);
        console.log("Text is: " + text_present);
        
        if(row_count){
            if(text_present){
                if($(this).parents('tr.section').next().children('td.title').text()){                    
                    $(this).parents('tr.section').remove();
                }else{
                    $(this).parents('tr.section').next().children('td.title').text(text_present);
                    $(this).parents('tr.section').remove();
                }
            }else{
                $(this).parents('tr.section').remove();
            }
        }else{
              $(this).parents('tr.td_header').remove();
        }
        
//        var  delete_url = "<?=base_url(); ?>patient/delete_patient_pi/" + pi_table_name + "/" + detail_id;
//        $.post(delete_url,function(){
//            console.log('data successfully sent');
//        });
        
        jQuery.fancybox.close();
    });
</script>-->

<script type="text/javascript">
    $(".dn table.add_info tr").css({'background-image':'url(<?=base_url(); ?>images/edit_popupbg.gif)','background-repeat':'repeat-x','background-color':'#f1f1f1'});
	$("table.add_info .treatcaledit tr").css({'background':'#f1f1f1'});
	$(function() {
        $('.dn table.add_info tr').hover(function() {
            $(this).css({'background-image':'none','background-repeat':'no-repeat','background-color':'#f1f1f1'});
        }, function() {
            $(this).css({'background-image':'url(<?=base_url(); ?>images/edit_popupbg.gif)','background-repeat':'repeat-x','background-color':'#f1f1f1'});
        });
		$('table.add_info .treatcaledit tr').hover(function() {
            $(this).css({'background':'#f1f1f1'});
        }, function() {
            $(this).css({'background':'#f1f1f1'});
        });
		
    });
</script>

<script>
$(function() {
		var currenttime = new Date();
		var month = currenttime.getMonth() + 1;
		var day = currenttime.getDate();
		var year = currenttime.getFullYear();
		document.getElementById("edit_start_date").value = month + "/" + day + "/" + year;
		document.getElementById("edit_stop_date").value = month + "/" + day + "/" + year;
		   
		$('#edit_startdate').datepicker({
			dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
			onSelect: function(date, obj){
				$('#edit_start_date').val(date);  //Updates value of of your input 
				$('#edit_stopdate').datepicker( "option", "minDate", date );
				$('#edit_stop_date').val(date);
			}
		});
		$('#edit_stopdate').datepicker({
			dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
			onSelect: function(date, obj){
				$('#edit_stop_date').val(date);  //Updates value of of your input 
			}
		});
	});
</script>