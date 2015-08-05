$(document).ready(function() {

 $('.fancybox_picture').fancybox({
      //different options
      padding: 0,
      closeBtn: false
});


function close_record_box(){
	$('a.search_close_btn').click(function(event) {
      event.preventDefault();
	  $('textarea[name=edit_info]').val("");
      jQuery.fancybox.close();
    });
}


$('#tabbottom,#patient_record').on('click', 'a.fancybox_picture', function() {
  close_record_box();
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
	
	$(parent_div).find('div.sel_subcat').html(detail);
	console.log(info);
	console.log("start date: " + start_date);
	
	$('.edit_startdate').datepicker( "setDate", start_date);
	$('.edit_stopdate').datepicker("setDate", end_date);
	
	$('#dn_treatedit').find('input[name=edit_start_date]').val(start_date);
	$('#dn_treatedit').find('input[name=edit_stop_date]').val(end_date);


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
  
  $(parent_div).find('textarea[name="edit_info"]').val(info);
  $(parent_div).find('div.sel_subcat').text(detail);
  $(parent_div).find('input.sel_subcat').val(detail);
  $(parent_div).find('.onlydel').text(info);
  $(parent_div).find('td.ttdate').text(date);



  var detail_id = $(this).siblings('input[type=hidden]').val();

  $('input[data-detail=detail_box]').next().attr('data-table', pi_table_name);
  $('td.tabname').text(pi_table_name);
  $('input[data-detail=detail_box]').next().val(detail_id);
});

});
