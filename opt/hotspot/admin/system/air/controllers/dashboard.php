<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Dashboard For User 
 *
 * Dashboard Controller
 *
 * @package		Dashboard
 * @author		Sarto
 * @version		1.0
 * @based on	Airlink WiFi
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

Class dashboard extends User_Controller
{
	function __construct()
	{
		parent::__construct();		
		$this->load->library('user_agent'); 
		$this->load->model(array('billingplanmodel','usermodel','topupmodel','statisticmodel','onlineusermodel'));
		$this->load->library(array('form_validation','globals','session'));
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		
		if($this->agent->browser()=='Internet Explorer' && $this->agent->version()<7) $this->ie6 = TRUE;
		
		$langselect = $conf_data['language'];
		$lang = $this->session->userdata("lang")==null?"$langselect":$this->session->userdata("lang");
		$this->lang->load($lang,$lang);
		$this->load->model('Tracker_model');
		$this->Tracker_model->add_visit();
		
	}
	
	function index()
	{	
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		if($this->agent->browser()=='Internet Explorer' && $this->agent->version()<7) $ie6 = TRUE;
		if($this->agent->is_mobile() || isset($this->ie6))
		{
			
			redirect ("mobileview","refresh");
		}
		
		if(!$this->session->userdata('user')){
			$this->loginuser();
			
		}else{
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		$langselect = $conf_data['language'];
		$lang = $this->session->userdata("lang")==null?"$langselect":$this->session->userdata("lang");
		$this->lang->load($lang,$lang);
		$this->load->helper('date');
		$this->load->helper('number');
		$data['exp']=$this->usermodel->expUser($this->session->userdata('user'));
        $data['profile']=$this->usermodel->getdataVoucher(null, array('username'=>$this->session->userdata('user')));	
		$data['datauser'] = $this->usermodel->getVoucher(null,array('username'=>$this->session->userdata('user')));
		$data['user_h']=$this->usermodel->getVoucher(null,array('username'=>$this->session->userdata('user')))->row();
		$data['user_m']=$this->usermodel->getAccountUsage('',array('username'=>$this->session->userdata('user')))->row();
		$data['user_r']=$this->usermodel->getAccountUsage(null,array('username'=>$this->session->userdata('user')));
		$data['plan'] = $this->billingplanmodel->getBillingPlan(NULL,NULL,array('no >'=>0));
		$data['true_setting'] = $conf_data['tmtopup_id'];	
	
		
		$this->db->order_by('no','asc');
		$data['plan'] = $this->billingplanmodel->getBillingPlan(NULL,NULL,array('no >'=>0));		
		$this->template	->add_css('validation/validationEngine.jquery.css?'._DATETIME)
						->add_js('validation/jquery.validationEngine-en.js?'._DATETIME)
						->add_js('validation/jquery.validationEngine.js?'._DATETIME)
						->write_view('content', 'dashboard/'.$conf_data['usertheme'].'/usertopups_view', $data)
						->render();
		}
	}
	function languser($type)
	{
		$this->session->set_userdata('lang',$type);
		redirect ("dashboard","refresh");
		}
	function topupcard()
	
	{
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		if($this->session->userdata('user')&&$this->input->post('user_card', TRUE)){
		$data=$this->topupmodel->topupcard($this->input->post('user_card', TRUE),$this->input->post('pass_card', TRUE),$this->session->userdata('user'));
		$this->template	->add_css('validation/validationEngine.jquery.css?'._DATETIME)
						->add_js('validation/jquery.validationEngine-en.js?'._DATETIME)
						->add_js('validation/jquery.validationEngine.js?'._DATETIME)
						->write_view('content', 'dashboard/'.$conf_data['usertheme'].'/usertopup_view', $data)
						->render();
		//redirect('topups/index/'.$data,'location');
	}
	}
	function topuptrue()
	{
		redirect('dashboard','location');
	}
	function topupplan()
	{
		//redirect('topups','location');
		if( $this->uri->segment(3) and  $this->session->userdata('user'))
		{		
		$plan = $this->billingplanmodel->getBillingPlan(NULL,NULL,array('groupname'=>$this->uri->segment(3)))->row();
        $user =$this->usermodel->getdataVoucher(null, array('username'=>$this->session->userdata('user')))->row();
		
		if($plan->price <= $user->money)
		{		//เติมเงิน 
				$this->billingplanmodel->changeGroup($this->session->userdata('user'),$this->uri->segment(3));
				//ตัดยอดเงินออกตามราคาเพ็คเก็ต
				$user_money = array('money'=>($user->money-$plan->price));
				$this->db->where('username',$this->session->userdata('user'))
						 ->delete('radacct');
				$this->db->where('username',$this->session->userdata('user'))
						 ->update('voucher',$user_money);
				//บันทึกการชื้อเพ็คเก็ต 
				$datetime=date("Y-m-d H:i:s");
				$topup = array(
								'username'=>$this->session->userdata('user'),
								'cashcard'=>'true',
								'billingplan'=>$plan->name,
								'date'=> $datetime,
								'price' =>$plan->price,
								'detail'=>'user'
								);
				$this->db->insert('topup_queue',$topup);
					//Message to admin
					$datetime=date("Y-m-d H:i:s");
					$data = array(
							'username'=>$this->session->userdata('user'),
							'subject'=>$this->lang->line('user_message_subject'),
							'message'=>sprintf($this->lang->line('user_message_detail'),
											$this->session->userdata('user'),
											$plan->name,
											$plan->price,
											$datetime),
							'date'=>date('Y-m-d H:i:s')
							);
					$this->db->insert('message',$data);
				redirect('dashboard','location');
		}else
		{ $this->template	
						->write_view('content', 'dashboard/'.$conf_data['usertheme'].'/userplan_view')
						->render();
		}

		}
	}
 function loginuser()
	{		
			$config = $this->siteconfigmodel->getConfig('global_config');
			$conf_data = $this->session->_unserialize($config->value);
			$data['user'] = $this->input->post('user', TRUE);
			$data['pass'] = $this->input->post('pass', TRUE);
			$data['error'] = 'ชื่อผู้ไช้รหัสผ่านไม่ถูกต้อง';
		if($this->input->post('login', TRUE)){
		if ($this->topupmodel->UserAndPassExist($data['user'],$data['pass'])) 
		{
					$this->session->set_userdata(array(	'user'	=> $data['user']));
					redirect('dashboard','location');	
		}}
		
		$this->template	->write_view('content', 'dashboard/'.$conf_data['usertheme'].'/userlogin_view', $data)
							->render();
	}
 function logoutuser()
	{
		$this->session->set_userdata(array( 'user' => ''));
		$this->session->sess_destroy();
		redirect('dashboard','location');	
	}
function progress_bar()
	{
		$uid = $this->usermodel->getdataVoucher('id');
		$progress['num'] = count($uid->result());
		$progress['rep'] = TRUE;
		print json_encode($progress);
	}
}
/* End of file database.php */
/* Location: ./system/nostradius/controllers/admin/database.php */