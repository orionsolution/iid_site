<script type="text/javascript">
$(function() {
    $("#past_date").datepicker({
      showOn: "button",
	  //maxDate: 0,
	  yearRange: "1960:+4",
	  changeMonth: true,
	  changeYear: true,
      buttonImage: "<?= base_url() ?>images/caledit.png",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: "dd MM, yy"
      //dateFormat: "yy-mm-dd"
    });
    $('#past_date').insertAfter($('#past_date').next('img'));

<? if (isset($past_date)): ?>
    $('#past_date').datepicker("setDate", new Date("<?= $past_date ?>"));
    // update the start date datepicker and end date datepicker in treatment tab as per the date selected in past date datepicker

    $('#startdate').datepicker("setDate", new Date("<?= $past_date ?>"));
<? else: ?>
    $('#past_date').datepicker("setDate", new Date());
<? endif; ?>
    //$('#past_date').datepicker("setDate", new Date());
});
</script>
<? $this->load->view('common/toplinks'); ?>
<div class="box boxtop addpast">
  <div class="visittop">
    <?php foreach ($patient_info as $curr_patient):
      $patient_name = $curr_patient['firstname'];
      $patient_surname = $curr_patient['surname'];
    endforeach;
    ?>

    <table class="main tadddata" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" class='last' width="50%">
			<a><span class="name"><?php echo $patient_name . " " . $patient_surname; ?></span></a>
			<table width="65%" border="0" cellspacing="0" cellpadding="0" style="margin:0; padding:0;">
				<tr>
					<td class="nop" width="50%" valign="top">
						<?php if ($last_visit_date != ''): ?>
						  <span class="bottomtext" style="font-size:10px; text-transform:uppercase;">last visit <?= ($last_visit_date != '') ? date("d M.Y", strtotime($last_visit_date)) : ''; ?></span>
						<?php endif; ?>
					</td>
				</tr>
			</table>
        </td>                                           
        <td width="50%" align="right" valign="top" class='last'>
          <form action="<?= base_url() ?>patient/add_past_data/<?= $mrd_no ?>" method="post" id="past_date_form">
            <input type="text" id="past_date" name="past_date" readonly="readonly" value="" />
          </form>
		</td>				  
      </tr>
    </table>

    <?php $this->load->view('common/tabs'); ?>
	
	<div id="tabbottom">
    </div>
  </div>

</div> <!-- end of box div -->

<? $this->load->view('common/update_delete_fancybox'); ?>

<script>
  $(document).ready(function() {
    $('tr.tr_inv').find('tr.record_info').last().find('td').css('border-bottom', 'none');
    $('tr.record_info').hover(function() {
      $(this).css('background-color', '#fff');
      $(this).find('td.date').css({
        'background-color': '#fff',
        'color': '#999'
      });
      /*$(this).find('td.category').css('color','#5cb1ea');
       $(this).find('td.detail').css('color','#02bac5');*/
    }, function() {
      $(this).css({'background-color': '#f1f1f1'});
      $(this).find('td.date').css({
        'background-color': '#f1f1f1',
        'color': '#999'
      });
    });
  });
</script>            


<? if ($this->uri->segment(2) == 'visit'):
	  $date_cnt = 1;
	else:
	  $date_cnt = '';
	endif;
	$uri_seg = $this->uri->segment(2); ?>

<script type="text/javascript">
  $(document).ready(function() {

    var date_count = "<?= $date_cnt; ?>";
    var uri_seg = "<?= $uri_seg; ?>";
    console.log("Date count is: " + date_count);
    console.log("Uri Segment is: " + uri_seg);


    



    /********************** Change Date Functionality *********************/

    $('input#past_date').on('change', function() {
      console.log('redirecting......');
      $('#past_date_form').submit();
    });

    /********************** End of Change Date Functionality *********************/

  });
</script>


<script type="text/javascript">
  var count = 0;
  function style_row() {
    $("#table_list2 tr.td_header").css({'background-color': '#f1f1f1'});
    $("#table_list2 tr.td_header").css("color", "#959595");
    $('#table_list2 tr.tr_inv').last().find('td').css('border-bottom', '2px solid #6ab4e5');
    $('#table_list2 tr.tr_inv').last().next('tr.record_info').find('td').css('border-top', '2px solid #c2c2c2');
  }
  $(document).ready(function() {
    var past_date = $('#past_date').val();
	past_date = past_date.replace(',','');

    var data = {
      "past_date": past_date
    };
    console.log("Past date: " + past_date);
    var url = "<?= base_url() ?>patient/past_record/<?= $mrd_no ?>/";
    $.get(url, data, function(data) {
      $("#tabbottom").html(data);
    });
	
	style_row();


    function clear_save() {
      setTimeout(function() {
        $('.saved').html("");
      }, 3000);
    }



    function get_url(value) {
      var add_url = "<?= base_url(); ?>patient/" + value + "/<?= $mrd_no ?>";
      console.log(add_url);
      return add_url;
    }


    $.ajaxSetup({cache: false});

    $('#hist_form, #exam_form, #diag_form').submit(function(event) {
      event.preventDefault();
      var cat_val = $(this).find('input.sel_subcat').val();
      console.log("Cat val " + cat_val);
      if (cat_val === '') {
        $('span.add_value').html("");
        $('span.valparam').addClass('error').html("* required");
      } else {
        $('span.valparam').html("");
		$('span.add_value').html("");
        var img_html = '<img src="<?php echo base_url(); ?>images/snake_transparent.gif" width="16" height="16" alt="" />';
		
        var date = $('#past_date').val();
		date = date.replace(',','');
		console.log('date: ' + date);
		var visit_dt = $('input[name=visit_dt]');		
		console.log("Input value is: " + $('input[name=visit_dt').val());
		$('input[name=visit_dt]').val(date);
        var value = $(this).find('input.get_value').val();
        var table_name = $(this).find('input.get_value').attr('data-tablename');
        $('.saved_' + value).html(img_html);
        var add_url = get_url(value);

        var info = $(this).serialize();
        console.log("Info: " + info);

        $.post(add_url, info, function() {
          console.log('insert successful');
          $('.saved_' + value).html('Saved');
          clear_save();
		  
		console.log("Past date: " + past_date);
		var url = "<?= base_url() ?>patient/past_record/<?= $mrd_no ?>/";
		$.get(url, data, function(data) {
		  $("#tabbottom").html(data);
		  $('#past_table_list').find('tr.record_info')
		  .first()
		  .css('background-color', '#ffffff')
		  .css("color", "#5cb1ea")
		  .find('td.detail').css("color", "#02bac5");
		});
          $('textarea[name=info]').val("");
        });
      }

    });

    // treatment form submission

    $('#treat_form').submit(function(event) {
      event.preventDefault();
      var cat_val = $(this).find('input.sel_subcat').val();
      console.log("Cat val " + cat_val);
      if (cat_val === '') {
        $('span.add_value').html("");
        $('span.valparam').addClass('error').html("* required");
      } else {
        var img_html = '<img src="<?php echo base_url(); ?>images/snake_transparent.gif" width="16" height="16" alt="" />';
		$('span.add_value').html("");

        var value = $(this).find('input.get_value').val();
        var past_date = $('#past_date').val();
		past_date = past_date.replace(',','');
		var visit_dt = $('input[name=visit_dt]');		
		console.log("Input value is: " + $('input[name=visit_dt').val());
		$('input[name=visit_dt]').val(past_date);		
        

        $('.saved_' + value).html(img_html);
        var add_url = get_url(value);

        console.log("Value is " + value + " url is " + add_url);

        var info = $(this).serialize();
        console.log(info);

        $.post(add_url, info, function() {
          console.log('insert successful');
          $('.saved_' + value).html('Saved');
          clear_save();
		  
		console.log("Past date: " + past_date);
		var url = "<?= base_url() ?>patient/past_record/<?= $mrd_no ?>/";
		$.get(url, data, function(data){
		  $("#tabbottom").html(data);
		  $('#past_table_list').find('tr.record_info')
		  .first()
		  .css('background-color', '#ffffff')
		  .css("color", "#5cb1ea")
		  .find('td.detail').css("color", "#02bac5");
		});
          $('textarea[name=info]').val("");  
        });

      }

    });


    function select_click() {
      $('.select_box option').click(function() {
        var select_text = $(this).text();
        var select_value = $(this).val();


        $('span.hidden_select input[name=param_id]').val(select_value);
        $('span.select_value input[name=param]').val(select_text);
      });
    }

    select_click();
    

// Investigation Form Submit
    function clear_save() {
      setTimeout(function() {
        $('.saved').html("");
      }, 3000);
    }


$('#invest_form').submit(function(event) {
event.preventDefault();
console.log('investigation form started');

if ($('input[name=invest_result]').val() === '') {
$('span.add_value').html("");
$('span.val_invest_result').addClass('error').html('* required');
} else {
$('span.val_invest_result').html("");
var img_html = '<img src="<?php echo base_url(); ?>images/snake_transparent.gif" width="16" height="16" alt="" />';
var value = 'add_invest';
var cat_val = $(this).find('input.sel_subcat').val();
var date = $('#past_date').val();
date = date.replace(',','');
$('input[name=visit_dt]').val(date);
var visit_dt = $('input[name=visit_dt]').val();



$('.saved_' + value).html(img_html);
var column_name = $(this).find('select#select_272').find('option:selected').text();
var column_value = $(this).find('input[name=invest_result]').val();

console.log(column_name);
console.log(column_value);

var info = {
  'column_name': column_name,
  'column_value': column_value,
  'visit_dt'		: visit_dt
};

var add_url = "<?= base_url(); ?>patient/add_inv/<?= $mrd_no; ?>";

	$.post(add_url, info, function() {
	  $('#invest_form').find('input[name=invest_result]').val("");
	  console.log('insert successful');
	  $('.saved_' + value).html('Saved');
	  clear_save();	  
	var url = "<?= base_url() ?>patient/past_record/<?= $mrd_no ?>/";
	var past_date = $('#past_date').val();
	past_date = past_date.replace(',','');
	 var data = {
      "past_date": past_date
		};
	$.get(url, data, function(data){	 
	
	  $("#tabbottom").html(data);
	  $('#past_table_list_invest').find('td.detail').each(function(){
				var curr_text = $(this).text();
				if(curr_text === column_name){
					$(this).parent('tr.record_info')
					.css('background-color', '#ffffff')
					.css("color", "#5cb1ea")
					.find('td.detail').css("color", "#02bac5");
				}
			});	// end each function 
	});
	  $('textarea[name=info]').val("");  
	  
});

	  }
}); // invest form submit function

$('#freq_invest_form').submit(function(event) {
event.preventDefault();
console.log('frequent investigation form started');

var validate = 0;
$('input.clear').each(function(){
	curr_input = $(this).val();
	if( curr_input !== ''){
		validate++
	}
});

if (validate == 0) {
console.log("No input field selected");
} else {

var img_html = '<img src="<?php echo base_url(); ?>images/snake_transparent.gif" width="16" height="16" alt="" />';
var value = 'add_freq_invest';

var date = $('#past_date').val();
date = date.replace(',','');
$('input[name=visit_dt]').val(date);
var visit_dt = $('input[name=visit_dt]').val();


$('.saved_' + value).html(img_html);

var cd4 = $('input[name="cd4"]').val();
var hiv_i_ii = $('input[name="hiv_i_ii"]').val();
var vdrl = $('input[name="vdrl"]').val();
var viral_load = $('input[name="viral_load"]').val();
var creatinine = $('input[name="creatinine"]').val();
var bsf = $('input[name="bsf"]').val();
var hbsag = $('input[name="hbsag"]').val();
var cryptococcus = $('input[name="cryptococcus"]').val();

var info = {
  'cd4': cd4,
  'hiv_i_ii': hiv_i_ii,
  'viral_load': viral_load,
  'vdrl': vdrl,
  'creatinine': creatinine,
  'bsf': bsf,
  'hbsag': hbsag,
  'cryptococcus': cryptococcus,
  'visit_dt' : visit_dt
};

console.log(info);


var add_url = "<?= base_url(); ?>patient/add_freq_inv/<?= $mrd_no; ?>";

		$.post(add_url, info, function() {
		  $('input.clear').val("");
		  console.log('insert successful');
		  $('.saved_' + value).html('Saved');
		  clear_save();
		  
	var url = "<?= base_url() ?>patient/past_record/<?= $mrd_no ?>/";
	var past_date = $('#past_date').val();
	past_date = past_date.replace(',','');
	 var data = {
      "past_date": past_date
		};
	$.get(url, data, function(data){	 
	
	  $("#tabbottom").html(data);
	  // $('#past_table_list_invest').find('td.detail').each(function(){
				// var curr_text = $(this).text();
				// if(curr_text === column_name){
					// $(this).parent('tr.record_info')
					// .css('background-color', '#ffffff')
					// .css("color", "#5cb1ea")
					// .find('td.detail').css("color", "#02bac5");
				// }
			// });	// end each function 
		}); //end get ajax
		  
	}); // end post ajax
	
	} // end else

}); // end of invest submit













}); // ready function

</script>



