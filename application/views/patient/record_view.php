<? //echo '<pre>';print_r($visit_arr);exit; //remove?> 
<table id="table_list2" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="headrow">
    <td width="16%" class="last_visit">last visit</td>
    <td width="3%">title</td>
    <td width="4%">category</td>
    <td width="45%">details</td>
    <td width="27%" class="last">notes</td>
    <td width="5%" class="last">&nbsp;</td>					
  </tr>
  <?php 
	if(!empty($visit_arr)):  
  $cnt = 0;
  foreach ($visit_arr as $curr_visit_arr):
    if ($visit_cnt != 'all'):
      if ($cnt++ >= $visit_cnt)
        break;
    endif; 
	$last_dt = "";
    foreach ($curr_visit_arr as $curr_visit_records):
		foreach($curr_visit_records as $curr_visit): 
      $temp_dt = date("d M. Y", strtotime($curr_visit['visit_dt']));
      if ($curr_visit['title'] == 'TRE'):
        // print html for treatment record ?> 
        <tr class="td_header record_info">
          	<? if ($last_dt != $temp_dt): ?>
            <td class="date" v-align="top" data-visit-date="<?= date("d M. Y", strtotime($curr_visit['visit_dt'])); ?>"><?= date("d M. Y", strtotime($curr_visit['visit_dt'])); ?></td>
          	<? else: ?>
            <td class="date" v-align="top" data-visit-date="<?= date("d M. Y", strtotime($curr_visit['visit_dt'])); ?>">&nbsp;</td>
          	<? endif; ?>
          	<td class="title"><?= $curr_visit['title']; ?></td>
          	<td class="category"><?= $curr_visit['head']; ?></td>
          	<td class="detail"><?= $curr_visit['parameter']; ?>&nbsp;&nbsp;<br/>Period:<?if($curr_visit['Sdate'] != '' & $curr_visit['Sdate'] != '--'): $curr_date = str_replace('/', '-', $curr_visit['Sdate']); $curr_date = date("d M Y", strtotime($curr_date)); echo $curr_date; else: echo ""; endif; ?> &nbsp; - &nbsp;<?if($curr_visit['Stopdate'] != '' & $curr_visit['Stopdate'] != '--'): $curr_date = str_replace('/', '-', $curr_visit['Stopdate']); $curr_date = date("d M Y", strtotime($curr_date)); echo $curr_date; else: echo ""; endif; ?></td>
          	<td class="patient_parameter"><?= $curr_visit['addinfo']; ?></td>
          	<td class="notes last">
				<div class="dnedit">
				<?if($visit_cnt!=1):?>
				  <a class="fancybox_picture edit" href="#dn_treatedit"></a>
				  <a class="fancybox_picture del" href="#dn_delete"></a>						
				  <input type="hidden" data-start-date='<?if($curr_visit['Sdate'] != '' & $curr_visit['Sdate'] != '--'): $curr_date = str_replace('/', '-', $curr_visit['Sdate']); $curr_date = date("d M Y", strtotime($curr_date)); echo $curr_date; else: echo ""; endif; ?>' data-end-date='<?if($curr_visit['Stopdate'] != '' & $curr_visit['Stopdate'] != '--'): $curr_date = str_replace('/', '-', $curr_visit['Stopdate']); $curr_date = date("d M Y", strtotime($curr_date)); echo $curr_date; else: echo ""; endif; ?>' data-treat-info='<?= $curr_visit["addinfo"]; ?>' data-table="treatment" value="<?= $curr_visit['details_id']; ?>" />                                                  
				  <br class="clearfloat" />
				</div>
				<?endif?>
          	</td>
        </tr>

        <? else:
        //print html for other records (like history,diagnosis etc.) ?> 
        <tr class='td_header record_info'> 
          	<? if ($last_dt != $temp_dt): ?>
            <td class="date" v-align="top" data-visit-date="<?= date("d M. Y", strtotime($curr_visit['visit_dt'])); ?>"><?= date("d M. Y", strtotime($curr_visit['visit_dt'])); ?></td>
          	<? else: ?>
            <td class="date" v-align="top" data-visit-date="<?= date("d M. Y", strtotime($curr_visit['visit_dt'])); ?>">&nbsp;</td>
          	<? endif; ?>                   
          	<td class=title><?= $curr_visit['title']; ?></td>
          	<td class="category"><?= $curr_visit['head']; ?></td>
          	<td class="detail"><?= $curr_visit['parameter']; ?></td>
          	<td class="patient_parameter"><?= $curr_visit['addinfo']; ?></td>
          	<td class='notes last'>				
			<?if($visit_cnt!=1):?>
				<div class=dnedit>
				  <a class='fancybox_picture edit' href="#dn_edit"></a>
				  <a class='fancybox_picture del' href="#dn_delete"></a>						
				  <input type='hidden' data-table='<?= substr($curr_visit['tablename'], 3); ?>' value="<?= $curr_visit['details_id']; ?>" />
				  <br class='clearfloat' />
				</div>
			<?endif?>
          	</td>                                 
        </tr>
        <? endif;
      	$last_dt = $temp_dt;
		endforeach; // end of curr visit 
    endforeach;  // end of curr visit records
	endforeach; // end of main for each loop 
	
	else: 
		echo "<tr class='td_header record_info'><td colspan='6'>No past record present</td></tr>";
	endif;
	?>
  <tr class="td_header record_info"><td class="vlast" colspan="6" style="height:0;"></td></tr>
</table>

<!-- investigation area starts -->
<table id="table_list3" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="headrow">
    <td width="21%" class="last_visit" colspan="2">past investigations</td>
    <td width="4%">category</td>
    <td width="43%">details</td>
    <td width="27%" class="last">notes</td>
    <td width="5%" class="last">&nbsp;</td>				
  </tr>
  <?php
  if (!empty($investigation_visit)):
    foreach ($investigation_visit as $curr_invst):
      $last_dt = "";
      foreach ($curr_invst as $key => $value):
        if ($key != 'details_id' && $key != 'mrdno' && $key != 'inv_source' && $key != 'report_dt' && $key != 'visit_dt' && $key != 'created_dt' && $key != 'transfer_flag'):
          $temp_dt = date("d M. Y", strtotime($curr_invst['visit_dt']));
          if (!($value == '' || $value == NULL)): ?>
            <tr class="td_header tr_inv record_info">
          	<? if ($last_dt != $temp_dt): ?>
                <td class="date" v-align="top" data-visit-date="<?= date("d M. Y", strtotime($curr_invst['visit_dt'])); ?>"><?= date("d M. Y", strtotime($curr_invst['visit_dt'])); ?></td>
                <td class="title">INV</td>
                <td class="category" data-inv-category="<? echo ($curr_invst['inv_source'] == 'lab') ? "Laboratory" : "Clinic"; ?>"><? echo ($curr_invst['inv_source'] == 'lab') ? "Laboratory" : "Clinic"; ?></td>
          	<? else: ?>
                <td class="date" v-align="top" data-visit-date="<?= date("d M. Y", strtotime($curr_invst['visit_dt'])); ?>">&nbsp;</td>
                <td class="title">&nbsp;</td>
                <td class="category" data-inv-category="<? echo ($curr_invst['inv_source'] == 'lab') ? "Laboratory" : "Clinic"; ?>">&nbsp;</td>
          	<? endif; ?>
              <td class="detail"><?= $key; ?></td>
              <td class="patient_parameter"><?= $value; ?></td>
              <td class="notes last">
			  <?if($visit_cnt!=1):?>
			  <div class="dnedit">
                  <a class="fancybox_picture edit" href="#dn_edit" ></a>
                  <a class="fancybox_picture del" href="#dn_delete"></a>						
                  <input type="hidden" data-table="investigation" value="<?= $curr_invst['details_id']; ?>" />                                                  
                  <br class="clearfloat" />
                </div>
			 <?endif;?>
              </td>
            </tr>
            <? $last_dt = $temp_dt; 
				endif; 
			endif;  
		endforeach;      
    endforeach;
	else:
		echo "<tr class='td_header record_info'><td colspan='6'>No past Investigation record present</td></tr>";
  endif;
  ?>
  <tr class="td_header record_info"><td class="vlast" colspan="6"></td></tr>                                                         
</table>
<!-- investigation area ends -->

	<div class="record_view">
		<?if($visit_cnt!=1):?>
		<?$this->load->view('common/update_delete_fancybox');?>
		<?endif;?>
	</div>



<script type="text/javascript">
  $(document).ready(function() {
    $('tr.tr_inv').find('tr.record_info').last().find('td').css('border-bottom', 'none');
    $('tr.record_info').hover(function() {
      $(this).css('background-color', '#fff');
      $(this).find('td.date').css({
        'background-color': '#fff',
        'color': '#5cb1ea'
      });
      $(this).find('td.category').css('color', '#5cb1ea');
      $(this).find('td.detail').css('color', '#02bac5');
    }, function() {
      $(this).css({'background-color': '#f1f1f1'});
      $(this).find('td.date').css({
        'background-color': '#f1f1f1',
        'color': '#959595'
      });
      $(this).find('td.category').css('color', '#959595');
      $(this).find('td.detail').css('color', '#959595');
    });
  });

  // for table_list2
  $("#table_list2 tr.td_header").css({'background-color': '#f1f1f1'});
  $("#table_list2 tr.td_header").css("color", "#959595");
  $('#table_list2 tr.tr_inv').last().find('td').css('border-bottom', '2px solid #6ab4e5');
  $('#table_list2 tr.tr_inv').last().next('tr.record_info').find('td').css('border-top', '2px solid #c2c2c2');

  // for Visitbottom
  $(".visitbottom #table_list2 tr.td_header, .visitbottom #table_list3 tr.td_header").css({'background-image': 'url(<?= base_url() ?>images/record_bg.gif)', 'background-repeat': 'repeat-x', 'background-color': '#f1f1f1'});
  $(".visitbottom #table_list2 tr.td_header, .visitbottom #table_list3 tr.td_header").css("color", "#aeafaf");
  $(".visitbottom #table_list2 tr.td_header td.title").css("color", "#5cb1ea");
  $(function() {
    $('.visitbottom #table_list2 tr.td_header, .visitbottom #table_list3 tr.td_header').hover(function() {
      /*$(this).css('background-color', '#ffffff');*/
      $(this).css({'background-image': 'none', 'background-repeat': 'no-repeat', 'background-color': '#ffffff'});
      $(this).css("color", "#5cb1ea");
    }, function() {
      $(this).css({'background-image': 'url(<?= base_url() ?>images/record_bg.gif)', 'background-repeat': 'repeat-x', 'background-color': '#f1f1f1'});
      $(this).css("color", "#aeafaf");
    });
  });
</script>



<script type="text/javascript">
  $(".dn table.add_info tr").css({'background-image': 'url(<?= base_url(); ?>images/edit_popupbg.gif)', 'background-repeat': 'repeat-x', 'background-color': '#f1f1f1'});
  $("table.add_info .treatcaledit tr").css({'background': '#f1f1f1'});
  $(function() {
    $('.dn table.add_info tr').hover(function() {
      $(this).css({'background-image': 'none', 'background-repeat': 'no-repeat', 'background-color': '#f1f1f1'});
    }, function() {
      $(this).css({'background-image': 'url(<?= base_url(); ?>images/edit_popupbg.gif)', 'background-repeat': 'repeat-x', 'background-color': '#f1f1f1'});
    });
    $('table.add_info .treatcaledit tr').hover(function() {
      $(this).css({'background': '#f1f1f1'});
    }, function() {
      $(this).css({'background': '#f1f1f1'});
    });

  });
</script>


<?if($visit_cnt!=1):?>


<script type="text/javascript">
  $(document).ready(function() {
    $('.record_view input[name=edit_patient_treat]').click(function() {
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
        'end_date': end_date,
        'info': add_info
      };
      console.log(add_info);
//        console.log(start_date);
//        console.log(end_date);


      console.log(pi_table_name);
      console.log('column name is ' + column_name);
      var update_url = "<?= base_url(); ?>patient/update_patient_pi_treatment/" + detail_id;
	  
      $.post(update_url, update_data, function(data) {
        console.log(data);
        console.log('data updated successfully');
		<? if ($visit_cnt == 3): ?>
		  url = "<?= base_url() ?>patient/record/<?= $mrd_no ?>/<?= $visit_cnt; ?>";
		<? else: ?>
		  url = "<?= base_url() ?>patient/record/<?= $mrd_no ?>/<?= $visit_cnt; ?>";
		<? endif; ?>
		
		$.get(url, function(data) {
		  $("#patient_record").html(data);
		});
		jQuery.fancybox.close();
	  });
       
	});



	$('.record_view input[name=update_patient]').click(function() {
	console.log('save buton clicked');

	var pi_table_name = $(this).next('input[type=hidden]').attr('data-table');
	var detail_id = $(this).next('input[type=hidden]').val();
	var add_info = $(this).parents('.dn').find('textarea').val();
	var column_name = $(this).parents('.dn').find('input.sel_subcat').val();

	console.log('add info is ' + add_info);
	console.log(pi_table_name);
	console.log(detail_id);
	console.log('column name is ' + column_name);
	console.log('Visit Cnt is  = <?= $visit_cnt ?>');
	// test to see if table name is not investigation

	if (pi_table_name !== 'investigation') {
	var update_url = "<?= base_url(); ?>patient/update_patient_pi/" + pi_table_name + "/" + detail_id;
	var url;
	$.post(update_url, {'info': add_info}, function() {
	console.log('data updated successfully');
	<? if ($visit_cnt == 3): ?>
	url = "<?= base_url() ?>patient/record/<?= $mrd_no ?>/<?= $visit_cnt; ?>";
	<? else: ?>
	url = "<?= base_url() ?>patient/record/<?= $mrd_no ?>/<?= $visit_cnt; ?>";
	<? endif; ?>
	
	console.log('Url is ' + url);
	$.get(url, function(data) {
	$("#patient_record").html(data);
	});
	jQuery.fancybox.close();
	});
	} 
	
	else {
	var update_url = "<?= base_url(); ?>patient/update_patient_pi_investigation/" + detail_id;
	$.post(update_url, {'info': add_info, 'column_name': column_name}, function() {
	console.log('data updated successfully');
	var url = "<?= base_url() ?>patient/record/<?= $mrd_no ?>/<?= $visit_cnt; ?>";
		console.log("Url : " + url);
		$.get(url, function(data) {
		  $("#patient_record").html(data);
		});
		jQuery.fancybox.close();
		});

	}
});


$('.record_view input[name=delete_patient]').click(function() {
	console.log('will trigger');

	var pi_table_name = $(this).next('input[type=hidden]').attr('data-table');
	var detail_id = $(this).next('input[type=hidden]').val();
	
	var column_name = $(this).parents('.dn').find('input.sel_subcat').val();

      console.log(pi_table_name + " " + detail_id);
	  console.log('column name is ' + column_name);

	if (pi_table_name !== 'investigation') {

	var delete_url = "<?= base_url(); ?>patient/delete_patient_pi/" + pi_table_name + "/" + detail_id;
	$.post(delete_url, function() {
	var url;
	console.log('data successfully sent');

	<? if ($visit_cnt == 3): ?>
	url = "<?= base_url() ?>patient/record/<?= $mrd_no ?>/<?= $visit_cnt; ?>";
	<? else: ?>
	url = "<?= base_url() ?>patient/record/<?= $mrd_no ?>/<?= $visit_cnt; ?>";
	<? endif; ?>
	$.get(url, function(data) {
	$("#patient_record").html(data);
	});
	jQuery.fancybox.close();
	});
	} else {
	var delete_url = "<?= base_url(); ?>patient/delete_patient_pi_investigation/" + detail_id;
	$.post(delete_url, {"column_name": column_name},function() {
	console.log('data successfully sent');
	var url = "<?= base_url() ?>patient/record/<?= $mrd_no ?>/<?= $date_cnt; ?>";
		  $.get(url, function(data) {
			$("#patient_record").html(data);
		  });
		  jQuery.fancybox.close();
		});

	  }
});

});
</script>

<?endif;?>



