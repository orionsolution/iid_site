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
      <td class="tt ttlast"><span class="select_value"><input class="sel_subcat readonly" type="text" name="param" readonly="" value="Respiratory Rate" size="30"></span></td>
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
<div id="dn_treatedit" class="dn" style="display:none; width:620px;">
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
      <td class="tt ttlast"><span class="select_value"><div class="sel_subcat readonly" type="text" name="param" readonly="" value="Respiratory Rate" /></div></span></td>
    </tr>
    <tr>
      <td class="vlast" colspan="2" style="color:#185e89;" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="treatcaledit">
          <tr class="hed">
            <th width="30%">STARTED</th>
            <th width="30%">STOPPED</th>
            <th width="40%">ADDITIONAL INFORMATION</th>
          </tr>
          <tr class="hed">
            <td align="center" valign="top">
              <div id="edit_startdate" class="edit_startdate"></div>
              <input type="text" id="edit_start_date" name="edit_start_date" readonly="readonly" style="color:#66c071;text-transform:none;" />
            </td>
            <td align="center" valign="top">
              <div id="edit_stopdate" class="edit_stopdate"></div>
              <input type="text" id="edit_stop_date" name="edit_stop_date" style="color:#d95734;text-transform:none;" />
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
          <!--<textarea id="hist_info" class="edit_hist onlydel" name="edit_info" cols="" rows="4" readonly="readonly">Paitent has severe cough and was bleeding.</textarea>-->
        <div id="hist_info" class="edit_hist onlydel" name="edit_info">Paitent has severe cough and was bleeding.</div>
        <input name="delete_patient" type="button" value="Delete" data-detail="detail_box" />
        <input type="hidden" data-table="" value=""/>
        <input type="button" name="cancel" onclick="jQuery.fancybox.close();" value="Cancel"> 
      </td>
    </tr>


  </table>
</div>
<!-- Edit Pop-up Delete div ends -->

<script type="text/javascript">
   $(function() {

     $('.edit_startdate').datepicker({
       changeMonth: true,
	   changeYear: true,
	   dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
       onSelect: function(date, obj) {
         $('#edit_start_date').val(date);  //Updates value of of your input 
         $('.edit_stopdate').datepicker("option", "minDate", date);
         //$('#edit_stop_date').val(date);
       }
     });
     $('.edit_stopdate').datepicker({
       //minDate: 0,
	   changeMonth: true,
	   changeYear: true,
       dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
       onSelect: function(date, obj) {
         $('#edit_stop_date').val(date);  //Updates value of of your input 
       }
     });
   });

  $(".dn table.add_info tr").css({'background-image': 'url(<?= base_url(); ?>images/edit_popupbg.gif)', 'background-repeat': 'repeat-x', 'background-color': '#f1f1f1'});
  $("table.add_info .treatcaledit tr.hed").css({'background': '#f1f1f1'});
  $(function() {
    $('.dn table.add_info tr').hover(function() {
      $(this).css({'background-image': 'none', 'background-repeat': 'no-repeat', 'background-color': '#f1f1f1'});
    }, function() {
      $(this).css({'background-image': 'url(<?= base_url(); ?>images/edit_popupbg.gif)', 'background-repeat': 'repeat-x', 'background-color': '#f1f1f1'});
    });
    $('table.add_info .treatcaledit tr.hed').hover(function() {
      $(this).css({'background': '#f1f1f1'});
    }, function() {
      $(this).css({'background': '#f1f1f1'});
    });

  });
</script>