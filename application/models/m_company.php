<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_company extends CI_Model {

    public function getCompany($where=""){
        $query = 'select
            * 
            FROM
            project_company
            '.$where;
        $data = $this->db->query($query);
        return $data;
    }

    public function getProject($where=""){
        $query = 'select
            project.project_id,
            project.`name`,
            project.city,
            project.address,
            project.header,
            project.footer,
            project.initial
            FROM
            project
            '.$where;
        $data = $this->db->query($query);
        return $data;
    }

    public function selectData($tablename,$where){
            $res = $this->db->select($tablename,$where);
            return $res;
    }

	public function insertData($tablename,$data){
		$res = $this->db->insert($tablename,$data);
		return $res;
	}

	public function updateData($tablename,$data,$where){
		$res = $this->db->update($tablename,$data,$where);
		return $res;
	}

	public function deleteData($tablename,$where){
		$res = $this->db->delete($tablename,$where);
		return $res;
	}
}