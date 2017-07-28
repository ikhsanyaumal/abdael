<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mymodel extends CI_Model {
	public function getUser($where=""){
		$data = $this->db->query('select * from user '.$where);
		return $data;
	}

        // public function getProject($where=""){
        //         $data = $this->db->get('project');
        //         return $data;
        // }
	
	public function getCustomer($where=""){
		$data = $this->db->query('select * from customer '.$where);
		return $data;
	}

	public function getKavling($where=""){
		$column="kavling.kavling_id,
                                kavling.name,
				kavling.status_kavling,
				type.name as type
				";

		$table = "kavling
				INNER JOIN type ON kavling.type_id = type.type_id
				";

		$query = 'select '.$column.' from '.$table.' '.$where;
		$data = $this->db->query($query);
		return $data;
	}

	public function getAgent($where=""){
		$column="agent.agent_id,
				agent.name,
				company.name as company
				";

		$table = "agent
				INNER JOIN company ON agent.company_id = company.company_id
				";

		$query = 'select '.$column.' from '.$table.' '.$where;
		$data = $this->db->query($query);
		return $data;
	}

        public function getPayment($where=""){
                $query = 'select * from payment '.$where;
                $data = $this->db->query($query);
                return $data;
        }

        public function getPeriodTransaksi($where=""){
                $query = "select
                payment.spr_id,
                period_transaksi.period_id,
                period_transaksi.payment_id,
                period_transaksi.period,
                period_transaksi.payment,
                period_transaksi.period_to,
                ((period_transaksi.period_to-(period_transaksi.period-1))*period_transaksi.payment) as total,
                period_transaksi.status_tj
                FROM
                period_transaksi
                INNER JOIN payment ON period_transaksi.payment_id = payment.payment_id".$where;
                $data = $this->db->query($query);
                return $data;
        }

        public function getPeriodInhouse($where=""){
                $query = "select
                payment.spr_id,
                period_inhouse.period_id,
                period_inhouse.payment_id,
                period_inhouse.period,
                period_inhouse.payment,
                period_inhouse.period_to,
                ((period_inhouse.period_to-(period_inhouse.period-1))*period_inhouse.payment) as total,
                period_inhouse.status_tj
                FROM
                period_inhouse
                INNER JOIN payment ON period_inhouse.payment_id = payment.payment_id".$where;
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
                project.initial,
                project_company.`name` as project_company_name,
                project_company.project_company_id,
                project_company.initial as project_company_initial,
                project_company.address as project_company_address,
                project_company.city as project_company_city,
                project_company.header as project_company_header,
                project_company.manager
                FROM
                project
                INNER JOIN project_company ON project.project_company_id = project_company.project_company_id'.$where;
                $data = $this->db->query($query);
                return $data;
        }

        public function getHistoryTransaksi($where=""){
                $query = '
                select * from (
                        (
                                select
                                        history_transaksi.history_id,
                                        history_transaksi.period,
                                        history_transaksi.payment,
                                        history_transaksi.payment_date,
                                        history_transaksi.status,
                                        kwitansi.`name`,
                                        kwitansi.payment as kwitansi_payment,
                                        kwitansi.date,
                                        kwitansi.periode,
                                        kwitansi.note,
                                        order.spr_id,
                                        kwitansi.kwitansi_id,
                                        "" as child_id,
                                        kwitansi.kwitansi_id as urutan
                                        FROM
                                        history_transaksi
                                        LEFT JOIN kwitansi ON history_transaksi.kwitansi_id = kwitansi.kwitansi_id  
                                        INNER JOIN payment ON history_transaksi.payment_id = payment.payment_id
                                        INNER JOIN `order` ON payment.spr_id = `order`.spr_id
                                        '.$where.'
                        )

                        union 

                        (
                                select
                                        CONCAT(history_transaksi.history_id,"-",kwitansi.kwitansi_id),
                                        history_transaksi.period,
                                        "",
                                        history_transaksi.payment_date,
                                        "",
                                        kwitansi.`name`,
                                        kwitansi.payment as kwitansi_payment,
                                        kwitansi.date,
                                        kwitansi.periode,
                                        kwitansi.note,
                                        order.spr_id,
                                        kwitansi.parent_id,
                                        kwitansi.kwitansi_id,
                                        kwitansi.parent_id as urutan
                                        FROM
                                        history_transaksi
                                        LEFT JOIN kwitansi ON history_transaksi.kwitansi_id = kwitansi.parent_id  
                                        INNER JOIN payment ON history_transaksi.payment_id = payment.payment_id
                                        INNER JOIN `order` ON payment.spr_id = `order`.spr_id
                                        '.$where.' and kwitansi.payment != "") ) as xx

                order by (xx.period*1) ASC,xx.history_id ASC,xx.note ASC
                ';
                $data = $this->db->query($query);
                return $data;
        }

        public function getLastKwitansi($where=""){
                $query = 'select
                kwitansi.kwitansi_id,
                kwitansi.name,
                kwitansi.payment,
                kwitansi.date,
                kwitansi.periode
                FROM
                kwitansi '.$where.' 
                ORDER BY
                kwitansi.kwitansi_id DESC LIMIT 1';
                $data = $this->db->query($query);
                return $data;
        }

        public function getHistoryInhouse($where=""){
                $query = '
                select * from (
                        (
                                select
                                        history_inhouse.history_id,
                                        history_inhouse.period,
                                        history_inhouse.payment,
                                        history_inhouse.payment_date,
                                        history_inhouse.status,
                                        kwitansi.`name`,
                                        kwitansi.payment as kwitansi_payment,
                                        kwitansi.date,
                                        kwitansi.periode,
                                        kwitansi.note,
                                        order.spr_id,
                                        kwitansi.kwitansi_id,
                                        "" as child_id,
                                        kwitansi.kwitansi_id as urutan
                                        FROM
                                        history_inhouse
                                        LEFT JOIN kwitansi ON history_inhouse.kwitansi_id = kwitansi.kwitansi_id  
                                        INNER JOIN payment ON history_inhouse.payment_id = payment.payment_id
                                        INNER JOIN `order` ON payment.spr_id = `order`.spr_id'
                                        .$where.'
                        )

                        union 

                        (
                                select
                                        CONCAT(history_inhouse.history_id,"-",kwitansi.kwitansi_id),
                                        history_inhouse.period,
                                        "",
                                        history_inhouse.payment_date,
                                        "",
                                        kwitansi.`name`,
                                        kwitansi.payment as kwitansi_payment,
                                        kwitansi.date,
                                        kwitansi.periode,
                                        kwitansi.note,
                                        order.spr_id,
                                        kwitansi.parent_id,
                                        kwitansi.kwitansi_id,
                                        kwitansi.parent_id as urutan
                                        FROM
                                        history_inhouse
                                        LEFT JOIN kwitansi ON history_inhouse.kwitansi_id = kwitansi.parent_id  
                                        INNER JOIN payment ON history_inhouse.payment_id = payment.payment_id
                                        INNER JOIN `order` ON payment.spr_id = `order`.spr_id
                                        '.$where.' and kwitansi.payment != "") ) as xx

                order by (xx.period*1) ASC,xx.history_id ASC,xx.note ASC
                ';
                $data = $this->db->query($query);
                return $data;
        }

	public function getOrder($where=""){
		// $data = $this->db->get('customer',$where);
	$table="`order`
                INNER JOIN project ON `order`.project_id = project.project_id
                INNER JOIN project_company ON `project`.project_company_id = project_company.project_company_id
                INNER JOIN customer ON `order`.customer_id = customer.customer_id
                INNER JOIN kavling ON `order`.kavling_id = kavling.kavling_id
                INNER JOIN type ON kavling.type_id = type.type_id
                LEFT JOIN cluster ON kavling.cluster_id= cluster.cluster_id
                ";

        $column="`order`.spr_id,
                `order`.customer_id,
                `order`.marketing,
                `order`.kavling_id,
                `order`.sales,
                `order`.`status`,
                `order`.project_id,
                `order`.keterangan,
                `order`.dialihkan,
                `order`.id_customer_dialihkan,
                (select `name` from customer where customer_id=id_customer_dialihkan) as customer_dialihkan,
                `order`.agent_id,
                `order`.approved_by,
                `order`.created_at,
                `order`.updated_at,
                `order`.tanggal_serah_terima,
                `order`.tanggal_spr,
                `order`.status_type,
                customer.`name`,
                customer.ktp,
                customer.address,
                customer.mail_address,
                customer.phone,
                customer.email,
                customer.npwp,
                customer.photo, 
                customer.scan_ktp,
                kavling.`name` AS kavling_name,
                kavling.`type_id`,
                type.`name` AS type_name,
                kavling.lt,
                type.lb,
                project.name as project_name,
                project.city as project_city, 
                project.address as project_address,
                project_company.name as project_company_name,
                cluster.cluster_id
                ";
        $query = 'select '.$column.' from '.$table.' '.$where;
		$data = $this->db->query($query);
		return $data;
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