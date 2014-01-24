<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
$user=$profile->row();
$datauser = $datauser->row(); 
$ms="";
$status = 'ใช้งานได้'; $color = "#00BF00";
if($exp=="exp") { $status = 'หมดอายุ'; $color = "#FF6666"; }  else if($exp == "lock") { $status = 'รอตรวจสอบ..'; $color = "#FFC000"; }
else if($exp == "ok") { $ms="เพื่อผลประโยชน์ของท่าน\\nเนื่องจากเพ็คเก็ตเดิมของท่านยังไม่หมดอายุการใช้งาน\\nเพ็คเก็ตของท่านจะถูกแทนที่ด้วยเพ็คเก็ตใหม่ทันที่หลังจากท่านกดยืนยััน\\n";
$status = 'ใช้งานได้'; $color = "#00BF00";
 }
$profile = $this->session->_unserialize($user->profile);
$n = "&nbsp;";
$noprofile = "ยังไม่มีการใช้งาน";
$this->load->helper('number');
$profile_type = "";
$exp_time = "<em style='color:green;'>ตามวันหมดอายุบัตร</em>";
switch ($datauser->profile) {

	case "timetofinish" : 	
		$profile_type = $this->lang->line('group_dis_timetofinish');
		$unit = $datauser->amount." ".$this->lang->line('date_day');
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.$datauser->amount.' day'), TRUE, 'th');
	break;
	
	case "packets" : 		
		$profile_type = $this->lang->line('group_dis_packets');
		$unit = $datauser->amount." MB";
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;
	
	case "packets_day" : 		
		$profile_type = $this->lang->line('group_dis_packets_day');
		$unit = $datauser->amount." MB";
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;
	
	case "packets_month" : 		
		$profile_type = $this->lang->line('group_dis_packets_month');
		$unit = $datauser->amount." MB";
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;

	case "time" :
		$profile_type = $this->lang->line('group_dis_time');
		$unit = $datauser->amount." ".$this->lang->line('date_hour');
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;
	
	case "timeout" :
		$profile_type = $this->lang->line('group_dis_timeout');
		$unit = $datauser->amount." ".$this->lang->line('date_hour');
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;
	
	case "daily" :
		$profile_type = $this->lang->line('group_dis_daily');
		$unit = $datauser->amount." ".$this->lang->line('date_hour');
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;
	
	case "monthly" :
		$profile_type = $this->lang->line('group_dis_monthly');
		$unit = $datauser->amount." ".$this->lang->line('date_hour');
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;

	default : $profile_type = "-";
	
}
?>
<script>
function lowprice(price)
{
alert("ยอดเงินในระบบ ของท่านมี <?=number_format($user->money,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?>  <?=$this->config->item('currency_symbol_pdf')?>ไม่พอ  กรุณาเติมเงินเข้าระบบให้มากกว่าหรือเท่ากับ "+price+" บาท \n1.");
}
</script>
<script type="text/javascript" src='http://www.tmtopup.com/topup/3rdTopup.php?uid=<?=$true_setting ?>'></script>
<body>
<div class="navbar navbar-inverse navbar-static-top">
      <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="dashboard">
                <strong><?=$logo ?></strong>
            </a>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                 <li><a href="#"><span>Hello : <?=$this->session->userdata('user')?></span></a></li>
                    <li><?=anchor("dashboard/languser/thai","<span>ภาษาไทย</span>");?></li>
                    <li><?=anchor("dashboard/languser/english","<span>English</span>");?></li>
                   <li><a href="dashboard/logoutuser"><span>Logout</span></a></li>
                </ul>
            </div>
        </div>
      </div>
    </div>

    <!-- Sign In Option 1 -->
    <div id="coming_soon">
        <div class="head">
            <div class="container">
                <div class="span4 text">
                 
                        <h2><strong><?=$this->lang->line('user_pages_head') ?></strong> <span><?=$this->lang->line('user_pages_head2') ?></h2><h4></span> <span class="right"><?=$this->lang->line('user_amount'); ?> : <?=number_format($user->money,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?>  <?=$this->lang->line('user_currency')?></span></h4>
                       
                        
                </div>

                <div class="span8 count" id="clock">
                    <div class="box last">
                        <div class="circle">
                            <span><?=time_data($user_h->time_used,'dhm') ?></span>
                        </div>
                        <p><?=$this->lang->line('user_pages_time_usage') ?></p>
                    </div>
                    <div class="box">
                        <div class="circle">
                            <span><?= (byte_format($user_h->packet_used ) ? byte_format($user_h->packet_used)  : $noprofile);?></span>
                        </div>
                        <p><?=$this->lang->line('user_pages_data_usage') ?></p>
                    </div>
                    <div class="box">
                        <div class="circle">
                            <span><?= (isset($user_m->acctstarttime ) ? $user_m->acctstarttime  : $noprofile)?></span>
                        </div>
                        <p><?=$this->lang->line('user_pages_lasted_login') ?></p>
                    </div>
                 
                </div>
            </div>
        </div>
<div class="container">
	<div class="span12">
       <div id="tabbed-nav" data-role="z-tabs" data-theme="white" data-options='{"rounded": false}' >
  <ul>
        <li><a><?=$this->lang->line('user_button_account') ?></a></li>
	<li><a><?=$this->lang->line('user_button_buy') ?></a></li>
	<li><a><?=$this->lang->line('user_button_wifi_card') ?></a></li>                           
	<li><a><?=$this->lang->line('user_button_true_refill') ?></a></li>
    <li><a><?=$this->lang->line('user_button_usage') ?></a></li>
  </ul>
  <div>
	<div><ul>
                                   <li><i class="icon-bar-chart"></i> <?=$this->lang->line('user_details_package') ?> :   <span class="detail"><?=$datauser->billingplan?></span></li>
                                   <li><i class="icon-bar-chart"></i> <?=$this->lang->line('user_details_package_type') ?> :   <span class="detail"><?=$profile_type?> <?=$unit?></span></li>
                                   <li><i class="icon-bar-chart"></i> <?=$this->lang->line('user_details_package_price') ?> : <span class="detail"><?=$datauser->price?></span></li>
                                   <li><i class="icon-bar-chart"></i> <?=$this->lang->line('user_details_start_time') ?>  :<span class="detail"><?=($datauser->start_time==null) ? '-' : $datauser->start_time?></span></li>
                                   <li><i class="icon-bar-chart"></i>  <?=$this->lang->line('user_details_expire') ?>  : <span class="detail"><?=$datauser->valid_until?></span></li>
                                   <li><i class="icon-bar-chart"></i> <?=$this->lang->line('user_details_valid_until') ?>  :<span class="detail"> </span><?=$exp_time?></li>
								   </ul>
                                   
                                   <ul>
                                   <li>Firstname-Lastname  :  <?=(isset($profile['firstname']) ? $profile['firstname'] : "--------").$n.(isset($profile['lastname']) ? $profile['lastname'] : "---------") ?></li>
                                   <li>E-mail  :  <?=(isset($profile['email']) ? $profile['email'] : "-------")?></li>
                                   <li>Phone number  :  <?=(isset($profile['phone']) ? $profile['phone'] : "--------")?></li>
                                   <li>Personal ID  :  <?= (isset($profile['personal_id']) ? $profile['personal_id'] : "-----")?></li>
                                   <li>Address  :  <?=(isset($profile['address1']) ? $profile['address1'] : "-------").(isset($profile['address2']) ? $profile['address2'] : "------"). $n . (isset($profile['district']) ? $profile['district'] : "-------").(isset($profile['amphur']) ? $profile['amphur'] : "------").$n.(isset($profile['province']) ? $profile['province'] : "--------")?></li>
                                   
                                   </ul>
                                   </div>
                                   
                                   
	<div> <table class="container">
<thead>
    <tr style="cursor:pointer;">
		<th>ลำดับ</th>
		<th>ชื่อเพ็คเก็ต</th>
		<th>จำนวน</th>
		<th>จำนวนวัน</th>
		<th>ความเร็ว</th>
		<th>ราคา</th>
		<th>เลือกชื้อ</th>	
	</tr>
</thead>

<tbody>
	<?php $i=1;
		foreach ($plan->result() as $r):
			if($r->profile=='time'||$r->profile=='timeout'||$r->profile=='daily'||$r->profile=='monthly'||$r->profile=='packets'||$r->profile=='packets_day'||$r->profile=='packets_month')
			{ $r->valid_for=$r->valid_for/1000;
			}else{ $r->valid_for=$r->amount;}		
			$amount = " ".$this->lang->line('group_dis_amount_'.$r->profile);?>
		<tr>
		<td><?=$i++;?></td>
		<td><span class="name"><?=$r->name;?></span></td>
		<td><?=$r->amount.' '.$amount;?></td>
		<td><?=$r->valid_for;?> วัน</td>
		<td><?="<a>".$r->bw_download/1000 ."</a>/<a style='color:red;'>".$r->bw_upload/1000 ."</a> Kbs";?></td>
		<td><span class="name"><?=number_format($r->price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?>  <?=$this->config->item('currency_symbol_pdf')?></span></td>
		<td><? if($r->price <= $user->money){?><?=anchor('dashboard/topupplan/'.$r->groupname,'ชื้อเพ็คเก็ตนี้',' onclick="return confirm(\''.$ms.'กรุณายืนยันการชื้อเพ็คเก็ต '.$r->name.'อีกครั้ง !!!\')" class="button style1"  info="รายการประจำปี" id="selectplan"'); } else{?>
		<button  class="button style2" onClick="lowprice(<?=$r->price-$user->money?>);" type="submit">ขาด <?=$r->price-$user->money?> บาท</button><? }?></td>	
	</tr>
	<? endforeach;?>
	
</tbody>

</table></div>
	<div>
    <div class="span4">
                      		<?=form_open('dashboard/topupcard','id="form" class="validate default-form various-content"')?>
							
									<?=form_input(array('name'=>'user_card','type'=>'text','minlength'=>'13'),'',' title="ชื่อผู้ใช้บนบัตร" required="required" id="user_card" autocomplete="off" placeholder='.$this->lang->line('user_refill_card_name').'')?>
								   
									<?=form_input(array('name'=>'pass_card','type'=>'text','minlength'=>'13'),'',' title="ชื่อผู้ใช้บนบัตร" required="required" id="pass_card" autocomplete="off" placeholder='.$this->lang->line('user_refill_card_pass').'')?>
									<?php echo form_submit('topupcard', $this->lang->line('user_refill_gorefill'),'class="button style2"'); ?>
							
                            </div>
                            <div class="span6"><img src="../images/wifi-card.jpg" height="200px" width="350px"></div><?=form_close()?></div>
	<div><div class="span4">
                    <?=form_open('dashboard/topuptrue','class="validate default-form various-content"')?>
									<input name="ref1" value="<?=$this->session->userdata('user')?>" type="hidden" id="ref1" />
									<input name="ref2" type="hidden" id="ref2" value="<?=$this->session->userdata('user')?>" />                                    
								  <?=form_input(array('name'=>'tmn_password','type'=>'text','minlength'=>'13'),'',' title="รหัสบัตรเงินสดทรูมันนี่" required="required" id="tmn_password" autocomplete="off" placeholder='.$this->lang->line('user_refill_true_id').'' )?>
                                  <br/>
							     <a href="#" onClick="submit_tmnc()" class="button style1"><?=$this->lang->line('user_refill_gorefill') ?></a>							
					
                     </div>
                     <div class="span6"><img src="../images/true_money_2.jpg" height="150px" width="250px">&nbsp;<img src="../images/true_money_4.jpg" height="150px" width="100px"> <?=form_close()?></div></div>     
    <div><table class="container">
<thead>
    <tr style="cursor:pointer;">
		<th>ลำดับ</th>
		<th>เริ่มใช้งาน</th>
		<th>สิ้นสุด</th>
		<th>เลขที่เครื่องใช้งาน</th>
		<th>ปิดการใช้งานโดย</th>
		<th>ไอพีของเครื่อง</th>
        <th>ข้อมูล</th>
		
	</tr>
</thead>

<tbody>
	<?php $i=1;
		foreach ($user_r->result() as $m):	?>
			<tr>
		<td><?=$i++;?></td>
		<td><?=$m->acctstarttime;?></td>
		<td><?=$m->acctstoptime;?></td>
		<td><?=$m->callingstationid;?></td>
		<td><? if ($m->acctterminatecause=='') { echo '-----';  }
		else if($m->acctterminatecause=='User-Request') {
			echo str_replace("User-Request","ผู้ใช้งาน",$m->acctterminatecause);   
			}
			else if($m->acctterminatecause=='Idle-timeout') {
			echo str_replace("Idle-timeout","หมดเวลาเชื่อมต่อ",$m->acctterminatecause);   
			}
			else if($m->acctterminatecause=='Force Disconnect') {
			echo str_replace("Force Disconnect","ผู้ดูแลระบบ",$m->acctterminatecause);   
			}
		 ?></td>
		<td><?=$m->framedipaddress ?></td>
		<td><?=byte_format($m->acctinputoctets+$m->acctoutputoctets)?></td>	
	</tr>
	 <? endforeach; ?>
</tbody>

</table></div>    
  </div>
</div>
</div>
 </div>  
       
    </div>

   