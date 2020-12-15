<?php

class Nasabah_model extends CI_Model
{
	public function getNasabah($id = null)
	{
		if ($id === null) {
			return $this->db->get('data_nasabah')->result_array();
		} else {
			return $this->db->get_where('data_nasabah', ['id' => $id])->result_array();
		}
	}

	public function deleteNasabah($id)
	{
		$this->db->delete('data_nasabah', ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function createNasabah($data)
	{
		$this->db->insert('data_nasabah', $data);
		return $this->db->affected_rows();
	}

	public function updateNasabah($data, $id)
	{
		$this->db->update('data_nasabah', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}
}
