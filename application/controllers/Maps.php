<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @author Yusuf Ayuba
	 * @header    
	 */
	public function index()
	{
		$this->peta();
	}

	public function peta()
	{
		$this->load->model('maps_model','maps');
		$config = array();
		$config['center'] = '-0.8231771, 131.233152';
		$config['zoom'] = '5';
		$config['cluster'] = TRUE;
		//$config['onclick'] = 'Hello world';
		$this->googlemaps->initialize($config);

		$temp_result = $this->maps->get_location()->result();
		$marker = array();
		foreach ($temp_result as $value) {
			//$marker = array();
			$marker['position'] = ''.$value->kab.', '.$value->prop.'';
			$marker['infowindow_content'] = ''.$value->nm_alumni.'<br>Email: '.$value->email.'<br />Telpon / HP.: '.$value->telpon.'';
			$marker['title'] = ''.$value->nm_alumni.'\nEmail: '.$value->email.'\nTelpon / HP.: '.$value->telpon.'';
			$this->googlemaps->add_marker($marker);	
		}

		$data['map'] = $this->googlemaps->create_map();
		$data['jml_alumni'] = $this->maps->count_alumni_prodi();
		$data['jml_alumni_kerja'] = $this->maps->count_alumni_kerja();
		$data['alumni_last'] = $this->maps->alumni_last();
		$this->load->view('maps_view', $data);
	}
}
