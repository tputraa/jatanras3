<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Class
 */
class Dashboard extends MY_Controller {

	public function __construct()
	{
	    parent::__construct();

	    $this->load->model('renmin/summary_model');
	    if($this->usertype != 5){
			redirect('user');
		}
	}

	/**
	 * Default method of dashboard class
	 */
	public function index()
	{				

		if (!$this->auth->loggedin())
		{	
			
			redirect('user','refresh');				
		} 
		else 
		{
			$data['page'] = 'renmin/dashboard';
		}

		$filter['fromdate'] 	= $this->input->get_post('fromdate');
		$filter['todate'] 		= $this->input->get_post('todate');	
		
		$user_id = $this->session->userdata('kon_id');
		$data['record_count_media'] = $this->summary_model->record_count_media($user_id,$filter);   
		$data['record_count_kasubdit'] = $this->summary_model->record_count_kasubdit();   
		$data['record_count_kanit'] = $this->summary_model->record_count_kanit();   
		$data['record_count_penyidik'] = $this->summary_model->record_count_penyidik($user_id,$filter);   
		$data['record_count_pasal'] = $this->summary_model->record_count_pasal();   
		$data['record_count_visit'] = $this->summary_model->record_count_visit();
		
		$sql ="SELECT
				pasal.id,
				media.id,
				media.no_lp,
				pasal.kasus,
				media.nama_pelapor,
				media.tanggal_kejadian,
				media.pelaku,
				media.korban,
				media.tanggal_lapor,
				media.is_status,
				media.created_date
				FROM
				pasal
				INNER JOIN media ON media.pasal_id = pasal.id ORDER BY media.created_date DESC";

		$data['dokumen'] = $this->db->query($sql)->result();

		$this->load->view('renmin/page',$data);
	}

	
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */
