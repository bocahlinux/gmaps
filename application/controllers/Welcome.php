<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * @author 		
	 * @since   	
	 */

	public function index()
	{
		$this->add();
	}

	public function add()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('alumni_model','alumni');
		$data['nama'] = '';
		$data['nim'] = '';
		$this->form_validation->set_rules('nama','Nama','trim|required');
		$this->form_validation->set_rules('nim','NIM','trim|required');
		//$this->form_validation->set_rules('wilayah','Wilayah Tinggal','trim|required');
		if ($this->form_validation->run()===FALSE) {
			$this->load->view('form_add',$data);
		} else {
			$nama = $this->input->post('nama');
			$wilayah = $this->input->post('lat1').','.$this->input->post('lon1');
			$nim = $this->input->post('nim');
			$data = array(
							'nm_alumni'=>$this->input->post('nama'),
							'nim_alumni'=>$this->input->post('nim'),
							'id_wil' => $this->input->post('lat1').','.$this->input->post('lon1'),
							'lokasi_alumni'=>$this->input->post('location')
						);
			$this->alumni->create($data);
			$this->session->set_flashdata('message','Sukses, Data alumni berhasil ditambahkan');
			redirect('welcome','refresh');
		}
	}

	public function ajax()
	{
		$this->load->model('alumni_model','alumni');
		$cari = $this->input->post('cari');
		$limit =$this->input->post('page')==''?1:$this->input->post('page');
		$temp = $this->alumni->get_wil_ajax($cari,$limit)->result_array();
		echo json_encode($temp);
	}

	public function maps()
	{
		$this->load->model('alumni_model','alumni');
		$config = array();
		$config['center'] = 'indonesia';
		$config['zoom'] = '5';
		$this->googlemaps->initialize($config);

		$temp_result = $this->alumni->get_location()->result();
		$marker = array();
		foreach ($temp_result as $value) {
			$marker['position'] = $value->id_wil;
			$kordinat=explode(",", $value->id_wil);
			// parameter onclick digunakan untuk mennampilkan popup windows dalam bentuk modals
			$marker['onclick'] = 'javascript:showModal(\''.implode("_",$kordinat).'\')';
			//$marker['infowindow_content'] = ''.$value->nm_alumni.'<br>Lokasi: '.$value->desa.', '.$value->prop.'';
			$marker['title'] = $value->id_wil;
			$this->googlemaps->add_marker($marker);	
		}

		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('maps_view', $data);
	}

	public function modal($id)
	{
		$this->load->model('alumni_model','alumni');
		$kor_mod=explode("_", $id);
		$kor_ori=implode(",", $kor_mod);
		$temp_result = $this->alumni->get_location_by_id($kor_ori)->result();
		$temp_place = $this->alumni->get_location_by_id($kor_ori)->row();
		$temp_jml = count($temp_result);
		echo "<div class=\"panel panel-primary\">
				<div class=\"panel-heading\">
					<div class=\"row\">
						<div class=\"col-xs-3\">
							<i class=\"fa fa-map-o fa-3x\"></i>
						</div>
						<div class=\"col-xs-9 text-right\">
							<div style=\"font-size: 20px;\">".$temp_jml."</div>
							<div>Data Alumni</div>								
						</div>
						<div class=\"col-xs-12\">
							<hr style=\"margin-top:0px;margin-bottom: 5px;\" />
							<small>".$temp_place->lokasi_alumni."</small>
						</div>
					</div>
				</div>
				<div class=\"panel-footer\">";
					foreach ($temp_result as $value) 
					{
						echo "
							<div style=\"margin-bottom:-10px\">
								<i class=\"fa fa-user\"></i> ".
								"<a href=\"".$value->nm_alumni."\" target=\"_blank\">"
									.$value->nm_alumni.
								"</a>
							</div>
						<hr />";
					}
			echo "</div>
			</div>";
	}
}
