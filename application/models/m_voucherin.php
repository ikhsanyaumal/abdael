<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_voucherin extends CI_Model {

    public function getVoucherin($where=""){
        $query = 'select
            voucher_in.`name`,
            voucher_in.date,
            voucher_in.target_date,
            voucher_in.real_date,
            project_company.`name` as project_company_name,
            department.`name` as department_name,
            partner.`name` as partner_name,
            project.`name` as project_name 
            FROM
            voucher_in
            INNER JOIN project_company ON voucher_in.project_company_id = project_company.project_company_id
            INNER JOIN department ON voucher_in.department_id = department.department_id
            LEFT JOIN partner ON voucher_in.partner_id = partner.partner_id
            LEFT JOIN project ON voucher_in.project_id = project.project_id
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

    public function getCoa($where=""){
        $query = 'select
            *
            FROM
            coa
            '.$where;
        $data = $this->db->query($query);
        return $data;
    }

    public function getDepartment($where=""){
        $query = 'select
            *
            FROM
            department
            '.$where;
        $data = $this->db->query($query);
        return $data;
    }

    public function getPartner($where=""){
        $query = 'select
            *
            FROM
            partner
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