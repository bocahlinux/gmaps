<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Alumni_model extends CI_Model
{
	/**
	 * @author 		Yusuf Ayuba
	 * @since   	2016
	 */
	
	public function __construct()
	{
		parent::__construct();
	}

	public function create($data)
	{
		return $this->db->insert('modul_alumni',$data);
	}

	public function get_wil_ajax($cari,$limit)
	{
		$this->db->select('rp.id AS id_prop,rk.id AS id_kab,rc.id AS id_kec,rd.id AS id_desa,
							rp.name AS prop,rk.name AS kab,rc.name AS kec,
							rd.name AS desa')
					->from('provinces AS rp')
					->join('regencies AS rk','rk.province_id=rp.id')
					->join('districts AS rc','rc.regency_id=rk.id')
					->join('villages AS rd','rd.district_id=rc.id')
					->like('rd.name',$cari)
					->order_by('rp.name','ASC')
					->limit($limit,0);
		return $this->db->get();
	}

	public function get_location()
	{
		$this->db->select('al.nm_alumni,al.id_wil')
					->from('modul_alumni AS al');
		return $this->db->get();
	}

	/*public function get_location()
	{
		$this->db->select('al.nm_alumni,al.id_wil,rd.name AS desa,
							rk.name AS kec, rb.name AS kab,
							rp.name AS prop')
					->from('modul_alumni AS al')
					->join('villages AS rd','al.id_wil=rd.id')
					->join('districts AS rk','rd.district_id=rk.id')
					->join('regencies AS rb','rk.regency_id=rb.id')
					->join('provinces AS rp','rb.province_id=rp.id');
		return $this->db->get();
	}

	public function get_location_by_id($id)
	{
		$this->db->select('al.*,CONCAT(rd.name, \', \', rp.name) AS lokasi')
					->from('modul_alumni AS al')
					->join('villages AS rd','al.id_wil=rd.id')
					->join('districts AS rk','rd.district_id=rk.id')
					->join('regencies AS rb','rk.regency_id=rb.id')
					->join('provinces AS rp','rb.province_id=rp.id')
					->where('al.id_wil',$id)
					->order_by('al.nm_alumni','asc');
		return $this->db->get();
	}
	*/
	public function get_location_by_id($id)
	{
		$this->db->select('al.*')
					->from('modul_alumni AS al')
					
					->where('al.id_wil',$id)
					->order_by('al.nm_alumni','asc');
		return $this->db->get();
	}
}