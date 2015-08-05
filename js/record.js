  $(document).ready(function() {
    $('a.search_close_btn').click(function(event) {
      event.preventDefault();
      jQuery.fancybox.close();
    });
	
	/* Fancybox functionality */
	
    //$('a.fancybox_picture').click(function(){
    $('#patient_record').on('click', 'a.fancybox_picture', function() {
      var parent_row = $(this).parents('tr.record_info');
      var category;
      var pi_table_name = $(this).siblings('input[type=hidden]').attr('data-table');
      if ($(parent_row).hasClass('tr_inv')) {
        category = $(parent_row).find('td.category').attr('data-inv-category');
      } else {
        category = $(parent_row).find('.category').text();
      }

      if (pi_table_name === 'treatment') {
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
        for (var i = 0; i < info.length; i++) {
          $('#dn_treatedit').find('input[type=checkbox]').each(function() {
            if ($(this).val() === info[i]) {
              $(this).attr('checked', 'checked');
            }
          });
        }

      }

      var date = $(parent_row).find('td.date').attr('data-visit-date');
      var detail = $(parent_row).find('.detail').text();
      var info = $(parent_row).find('.patient_parameter').text();

      //console.log('date: ' + date ' detail: ' + detail + 'info: ' + info);


      console.log('table name: ' + pi_table_name);

      console.log(info);
      console.log(detail);
      console.log(category);


      var parent_div = $('.dn');

      $(parent_div).find('td.edit_catname').text(category);
      $(parent_div).find('input.sel_subcat').val(detail);
      $(parent_div).find('textarea[name="edit_info"]').text(info);
      $(parent_div).find('.onlydel').text(info);
      $(parent_div).find('td.ttdate').text(date);



      var detail_id = $(this).siblings('input[type=hidden]').val();

      $('input[data-detail=detail_box]').next().attr('data-table', pi_table_name);
      $('td.tabname').text(pi_table_name);
      $('input[data-detail=detail_box]').next().val(detail_id);




    });


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


$('input[name=delete_patient]').click(function() {
	console.log('will trigger');

	var pi_table_name = $(this).next('input[type=hidden]').attr('data-table');
	var detail_id = $(this).next('input[type=hidden]').val();

	console.log(pi_table_name + " " + detail_id);

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
	$.post(delete_url, function() {
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

