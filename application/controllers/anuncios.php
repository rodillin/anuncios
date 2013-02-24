<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anuncios extends CI_Controller {

	
	public function index()
	{
		$data['id'] = '';
		$data['view'] = 'home';
		$this->load->view('layout',$data);
	}
	public function lista()
	{
		$data['id'] = 'id="listing" style=""';
		$data['view'] = 'lista';
		$this->load->view('layout',$data);
	}
}

