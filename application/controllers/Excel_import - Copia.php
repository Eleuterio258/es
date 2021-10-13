<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_import extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->helper('url');
	}

	 public function index() {
		$data['num_rows'] = $this->db->get('student')->num_rows();

		$this->load->view('excel_import', $data);
	}
   public function import_data() {
        $config = array(
            'upload_path' => FCPATH . 'upload/',
            'allowed_types' => 'xls|csv'
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $data = $this->upload->data();
            @chmod($data['full_path'], 0777);

            $this->load->library('Spreadsheet_Excel_Reader');
            $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

            $this->spreadsheet_excel_reader->read($data['full_path']);
            $sheets = $this->spreadsheet_excel_reader->sheets[0];
            error_reporting(0);

            $data_excel = array();
            for ($i = 2; $i <= $sheets['numRows']; $i++) {
                if ($sheets['cells'][$i][1] == '')
                    break;

                $data_excel[$i - 1]['name'] = $sheets['cells'][$i][1];
                $data_excel[$i - 1]['birthday'] = $sheets['cells'][$i][2];
                $data_excel[$i - 1]['sex'] = $sheets['cells'][$i][3];
                $data_excel[$i - 1]['address'] = $sheets['cells'][$i][4];
                $data_excel[$i - 1]['phone'] = $sheets['cells'][$i][5];
                $data_excel[$i - 1]['email'] = $sheets['cells'][$i][6];
                $data_excel[$i - 1]['password'] = $sheets['cells'][$i][7];
                $data_excel[$i - 1]['student_session'] = $sheets['cells'][$i][8];
                $data_excel[$i - 1]['username'] = $sheets['cells'][$i][9];
                $data_excel[$i - 1]['bi_number'] = $sheets['cells'][$i][10];
                $data_excel[$i - 1]['father_name'] = $sheets['cells'][$i][11];
                $data_excel[$i - 1]['father_profession'] = $sheets['cells'][$i][12];
                $data_excel[$i - 1]['mother_name'] = $sheets['cells'][$i][13];
                $data_excel[$i - 1]['mother_profession'] = $sheets['cells'][$i][14];
                $data_excel[$i - 1]['nationality'] = $sheets['cells'][$i][15];
                $data_excel[$i - 1]['family'] = $sheets['cells'][$i][16];
                $data_excel[$i - 1]['neighborhood'] = $sheets['cells'][$i][17];
                $data_excel[$i - 1]['avenue'] = $sheets['cells'][$i][18];
                $data_excel[$i - 1]['street'] = $sheets['cells'][$i][19];
                $data_excel[$i - 1]['house_number'] = $sheets['cells'][$i][20];
                $data_excel[$i - 1]['block'] = $sheets['cells'][$i][21];
                $data_excel[$i - 1]['any_disease'] = $sheets['cells'][$i][22];
                $data_excel[$i - 1]['any_medication'] = $sheets['cells'][$i][23];
                $data_excel[$i - 1]['any_disability'] = $sheets['cells'][$i][24];
                $data_excel[$i - 1]['any_allergy'] = $sheets['cells'][$i][25];
                $data_excel[$i - 1]['file_name'] = $sheets['cells'][$i][26];
                $data_excel[$i - 1]['person_name_emergency'] = $sheets['cells'][$i][27];
                $data_excel[$i - 1]['person_phone_emergency'] = $sheets['cells'][$i][28];
             
            }

            $this->db->insert_batch('pending_users', $data_excel);
    
            redirect('excel-import');
        }
    }


}

/* End of file Excel_import.php */
/* Location: ./application/controllers/Excel_import.php */