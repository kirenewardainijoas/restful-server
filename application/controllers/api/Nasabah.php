<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Nasabah extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Nasabah_model');
	}

	public function index_get()
	{
		$id = $this->get('id');

		if ($id === null) {
			$data_nasabah = $this->Nasabah_model->getNasabah();
		} else {
			$data_nasabah = $this->Nasabah_model->getNasabah($id);
		}

		if ($data_nasabah) {
			$this->response([
				'status' => true,
				'data' => $data_nasabah
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'id not found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_delete()
	{
		$id	= $this->delete('id');

		if ($id === null) {
			$this->response([
				'status' => false,
				'message' => 'provide an id!'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if ($this->Nasabah_model->deleteNasabah($id) > 0) {
				$this->response([
					'status' => true,
					'id' => $id,
					'message' => 'deleted.'
				], REST_Controller::HTTP_NO_CONTENT);
			} else {
				$this->response([
					'status' => false,
					'message' => 'id not found'
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

	public function index_post()
	{
		$data = [
			'first_name' => $this->post('first_name'),
			'last_name' => $this->post('last_name'),
			'email' => $this->post('email'),
			'gender' => $this->post('gender')
		];

		if ($this->Nasabah_model->createNasabah($data) > 0) {
			$this->response([
				'status' => true,
				'message' => 'new data nasabah has been created.'
			], REST_Controller::HTTP_CREATED);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed to created new data'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put()
	{
		$id  = $this->put('id');
		$data = [
			'first_name' => $this->post('first_name'),
			'last_name' => $this->post('last_name'),
			'email' => $this->post('email'),
			'gender' => $this->post('gender')
		];

		if ($this->Nasabah_model->updateNasabah($data, $id) > 0) {
			$this->response([
				'status' => true,
				'message' => 'new data nasabah has been update.'
			], REST_Controller::HTTP_NO_CONTENT);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed to update  data'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}
