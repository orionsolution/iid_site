<ul class="toplinks">
	<li><a id="_Alt_1" class="<?php echo ($this->uri->segment(2)==='visit')?'active':'' ?>" href="<?=base_url();?>patient/visit/<?=$mrd_no;?>">PATIENT HOME</a></li>
	<li><a id="_Alt_2" class="<?php echo ($this->uri->segment(2)==='profile')?'active':'' ?>" href="<?=base_url();?>patient/profile/<?=$mrd_no;?>">PROFILE</a></li>
	<li><a id="_Alt_3" class="<?php echo ($this->uri->segment(2)==='patient_history')?'active':'' ?>" href="<?=base_url();?>patient/patient_history/<?=$mrd_no;?>">HISTORY</a></li>
	<li class="pastdata"><a id="_Alt_4" class="<?php echo ($this->uri->segment(2)==='add_past_data')?'active':'' ?>" href="<?=base_url();?>patient/add_past_data/<?=$mrd_no;?>">add past data</a></li>
	<br class="clearfloat" />
</ul>