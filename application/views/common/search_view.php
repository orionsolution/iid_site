<? if(!empty($search_result)): ?>
<div id="searchby">
    <div class="close_search_box"><a href="#" class="search_close_btn"></a></div>
    <table id="table_popup" width="100%" border="0" cellspacing="0" cellpadding="0">
        <? foreach($search_result as $search):
            $mrdno=$search->mrdno;
            $firstname=$search->firstname;
            $surname=$search->surname;
        ?>
        <tr class="td_data">            
            <td width="20%" align="middle" class="mrdno"><?=$mrdno?></td>
            <td width="45%"><?=$firstname . " " .$surname?></td>
            <td width="35%" valign="bottom">
            	<div class="fltleft">    
				 <? if(in_array($search->mrdno, $this->session->userdata('mrd_queue'))):
                        echo "<a class='button no_hover'>Pending</a>";
                    elseif(in_array($search->mrdno, $this->session->userdata('mrd_close'))):
                        echo "<a class='button no_hover'>Completed</a>";
                    else:
                        echo "<a id='_Alt_a' href='".base_url()."search/queue/$mrdno' class=button>Add</a>";
                  	endif;?>
               	</div>
				<div class="fltright">
                  <a id="_Alt_o" href="<?=base_url();?>patient/visit/<?=$mrdno;?>" class="button">Open</a>
				</div>
				<br class="clearfloat" />  
            </td>
        </tr>
        <? endforeach; ?>
    </table>
</div>
<? else: ?>
<div id="search_error" style="display: block; background-position: 30% 63%">
	<div class="close_search_box"><a href="#" class="search_close_btn">Close button goes here</a></div>
	No Patient Found!!
</div>
<? endif; ?>
<script type="text/javascript">
$(document).ready(function(){
    $('a.search_close_btn').click(function(){
        jQuery.fancybox.close();        
    });
});
</script>

