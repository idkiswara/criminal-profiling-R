<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class textmining extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('array');
		$this->load->helper('directory');
		$this->load->library('session');
		//$this->load->library('datatables');
		
		$this->load->model('textmining_model');
		$this->load->database();
	}
	public function index()
	{
		//ambil data
		$data['berita'] = $this->textmining_model->selectdashboard();
		$alamak = "tes";
		
		//menampilkan halaman index
		$this->load->view("navbar1");
		$this->load->view('grafik',$data);
		$this->load->view('footer');
	}
	
	public function tambah()
	{
		//tambah berita
		$this->load->view("navbar1");
		$this->load->view("input");
		$this->load->view("footer");
	}
	
	public function prosesinput()
	{
		//input berita
		$tampung = $this->input->post('berita');
		$this->textmining_model->insert($tampung);
		//$this->session->set_userdata('berita', $berita);
		
		$data['berita'] = $this->textmining_model->hasilanalisis($tampung);
		
		$this->load->view("navbar1");
		$this->load->view("hasil",$data);
		$this->load->view("footer");
	}
	
	public function lihatberita()
	{
		$data['berita'] = $this->textmining_model->selectberita();
		
		//menampilkan berita yang ada di database
		$this->load->view("navbar1");
		$this->load->view("daftarberita",$data);
		$this->load->view("footer");
	}
	public function lihatdetail($id)
	{
		//input berita
		$berita= $id;
		$data['berita'] = $this->textmining_model->detailberita($berita);
		
		$this->load->view("navbar1");
		$this->load->view("detailberita",$data);
		$this->load->view("footer");
	}
}