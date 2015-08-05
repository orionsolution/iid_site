<script>
  $(document).ready(function() {
    $('.fancybox_picture').fancybox({
      //different options
      padding: 0,
      closeBtn: false
    });
  });
</script>

<table id="past_table_list" class="new_record" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px; border-bottom: 2px solid #ccc">
	<tr class='headrow'>
		<td width="16%">visit</td>
		<td width="3%">title</td>
		<td width="5%">category</td>
		<td width="45%">details</td>
		<td width="26%" class="last">notes</td>
		<td width="5%" class="last">&nbsp;</td>								
	</tr>

  	<? if (empty($curr_visit_arr)): ?>
    <tr class="td_header record_info empty_row">
      	<td class="date" v-align="top">&nbsp;</td>
      	<td class="title">&nbsp;</td>
      	<td class="category">&nbsp;</td>
      	<td class="detail">&nbsp;</td>
      	<td class="patient_parameter last">&nbsp;</td>
      	<td class="notes last">&nbsp;</td>
    </tr>
  	<? else: ?>

    <!-- new table area start -->
    <? $last_dt = "";
    foreach ($curr_visit_arr as $curr_visit):
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
          	<td class="detail"><?= $curr_visit['parameter']; ?>&nbsp;&nbsp;<br/>Period:<?= ($curr_visit['Sdate'] != '') ? date("d M Y", strtotime($curr_visit['Sdate'])) : ''; ?> &nbsp; - &nbsp;<?= ($curr_visit['Stopdate'] != '') ? date("d M Y", strtotime($curr_visit['Stopdate'])) : ''; ?></td>
          	<td class="patient_parameter last"><?= $curr_visit['addinfo']; ?></td>
          	<td class="notes last">
				<div class="dnedit">
				  <a class="fancybox_picture edit" href="#dn_treatedit"></a>
				  <a class="fancybox_picture del" href="#dn_delete"></a>						
				  <input type="hidden" data-start-date='<?= ($curr_visit['Sdate'] != '') ? date("d M Y", strtotime($curr_visit['Sdate'])) : ''; ?>' data-end-date='<?= ($curr_visit['Stopdate'] != '') ? date("d M Y", strtotime($curr_visit['Stopdate'])) : ''; ?>' data-treat-info='<?= $curr_visit["addinfo"]; ?>' data-table="treatment" value="<?= $curr_visit['details_id']; ?>" />                                                  
				  <br class="clearfloat" />
				</div>
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
          	<td class="patient_parameter last"><?= $curr_visit['addinfo']; ?></td>
          	<td class='notes last'>
				<div class=dnedit>
				  <a class='fancybox_picture edit' href="#dn_edit"></a>
				  <a class='fancybox_picture del' href="#dn_delete"></a>						
				  <input type='hidden' data-table='<?= substr($curr_visit['tablename'], 3); ?>' value="<?= $curr_visit['details_id']; ?>" />
				  <br class='clearfloat' />
				</div>
          	</td>                                 
        </tr>
        <? endif;
      	$last_dt = $temp_dt;
    endforeach;
endif; ?>
</table>

<!-- investigation area starts -->
<table id="past_table_list_invest" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="headrow">
	<td width="18%"  colspan="2">investigation</td>
	<!-- <td width="3%">title</td> -->
	<td width="5%">category</td>
	<td width="46%">details</td>
	<td width="26%" class="last">notes</td>
	<td width="5%" class="last">&nbsp;</td>								
  </tr>
  
  <? if (empty($curr_inv_arr)): ?>
	<tr class="td_header record_info empty_row">
	  <td class="date" v-align="top">&nbsp;</td>
	  <td class="title">&nbsp;</td>
	  <td class="category" data-inv-category="Clinic">&nbsp;</td>
	  <td class="detail">&nbsp;</td>
	  <td class="patient_parameter last">&nbsp;</td>
	  <td class="notes last">&nbsp;</td>
	</tr>

  <? else:
  
    foreach ($curr_inv_arr as $curr_invst):
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
              <td class="patient_parameter last"><?= $value; ?></td>
              <td class="notes last">

			  <div class="dnedit">
                  <a class="fancybox_picture edit" href="#dn_edit" ></a>
                  <a class="fancybox_picture del" href="#dn_delete"></a>						
                  <input type="hidden" data-table="investigation" value="<?= $curr_invst['details_id']; ?>" />                                                  
                  <br class="clearfloat" />
                </div>

              </td>
            </tr>
            <? $last_dt = $temp_dt; endif; endif;  endforeach;      
    endforeach;
  endif;
  ?>                                                         
</table>
<!-- investigation area ends -->


<script type="text/javascript">
$("#tabbottom #past_table_list tr.td_header, #tabbottom #past_table_list_invest tr.td_header").css("background-color", "#eaeaea");
$("#tabbottom #past_table_list tr.td_header, #tabbottom #past_table_list_invest tr.td_header").css("color", "#959595");
$(function() {
  $('#tabbottom #past_table_list tr.td_header, #tabbottom #past_table_list_invest tr.td_header').hover(function() {
	$(this).css('background-color', '#ffffff');
	$(this).css("color", "#5cb1ea");
	$(this).find('td.detail').css("color", "#02bac5");
  }, function() {
	$(this).css('background-color', '#eaeaea');
	$(this).css("color", "#959595");
	$(this).find('td.detail').css("color", "#959595");
  });
});
</script>

<script>
  $(document).ready(function() {
    /*********************** Update Functionality **************************/

    $('input[name=update_patient]').click(function() {
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

      if (pi_table_name !== 'investigation') {
        var update_url = "<?= base_url(); ?>patient/update_patient_pi/" + pi_table_name + "/" + detail_id;
        $.post(update_url, {'info': add_info}, function() {
          console.log('data updated successfully');
          var past_date = $('#past_date').val();
          console.log("Update Past date: " + past_date);
          var data = {
            "past_date": past_date
          };
          var url = "<?= base_url() ?>patient/past_record/<?= $mrd_no ?>/";
          $.get(url, data, function(data) {
            $("#tabbottom").html(data);
          });
          jQuery.fancybox.close();
        });
      }
      else {
        var update_url = "<?= base_url(); ?>patient/update_patient_pi_investigation/" + detail_id;
        $.post(update_url, {'info': add_info, 'column_name': column_name}, function() {
          console.log('data updated successfully');
		  var past_date = $('#past_date').val();
          console.log("Update Past date: " + past_date);
          var data = {
            "past_date": past_date
          };
          var url = "<?= base_url() ?>patient/past_record/<?= $mrd_no ?>/";
          $.get(url, data, function(data) {
            $("#tabbottom").html(data);
          });
          jQuery.fancybox.close();
        });

      }
    });


    /****************** Treatment Update Functionality ***********************/

    $('input[name=edit_patient_treat]').click(function() {
      console.log('update treatment');

      var pi_table_name = $(this).next('input[type=hidden]').attr('data-table');
      var detail_id = $(this).next('input[type=hidden]').val();
      var column_name = $(this).parents('.dn').find('input.sel_subcat').val();
      var parent = $(this).parents('.dn');
      var add_info = [];
      $('input[name="add_treat_info"]:checked').each(function() {
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
        var past_date = $('#past_date').val();
        console.log("Past date: " + past_date);
        var data = {
          "past_date": past_date
        };
        var url = "<?= base_url() ?>patient/past_record/<?= $mrd_no ?>/";
        $.get(url, data, function(data) {
          $("#tabbottom").html(data);
        });
        jQuery.fancybox.close();
      });
        
    });



    /********************** End of Update Functionality *********************/

    /********************** Delete Functionality *********************/

    $('input[name=delete_patient]').click(function() {
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
          var past_date = $('#past_date').val();
          console.log("Past date: " + past_date);
          var data = {
            "past_date": past_date
          };
          var url = "<?= base_url() ?>patient/past_record/<?= $mrd_no ?>/";
          $.get(url, data, function(data) {
            $("#tabbottom").html(data);
          });
          jQuery.fancybox.close();
        });
      } else {
        var delete_url = "<?= base_url(); ?>patient/delete_patient_pi_investigation/" + detail_id;
        $.post(delete_url, {"column_name": column_name},function() {
          console.log('data successfully sent');
		  var past_date = $('#past_date').val();
          console.log("Past date: " + past_date);
          var data = {
            "past_date": past_date
          };
          var url = "<?= base_url() ?>patient/past_record/<?= $mrd_no ?>/";
          $.get(url, data,function(data) {
            $("#tabbottom").html(data);
          });
          jQuery.fancybox.close();
        });

      }
    });

    /********************** End of Delete Functionality *********************/


  });
</script>

