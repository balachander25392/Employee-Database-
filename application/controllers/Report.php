<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');  
		$this->load->model('Autoload_model'); 
		$this->load->model('Report_model');
		$this->load->library('Ajax_pagination');
        $this->perPage = 10;  
	}

	public function index()
	{

		
	}

	function userReport()
	{
		if($this->session->userdata('logged_in')){
			$data = array();
        	$data['title']    = "Manage User Results";
			$data['template'] = $this->Autoload_model->getTemplateList();
	        //total rows count
	        $totalRec = @count($this->Report_model->getUsersResults());
	        
	        //pagination configuration
	        $config['target']      = '#resultList';
	        $config['base_url']    = base_url().'report/manageUserReportAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getUserResult';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['user_result']   = $this->Report_model->getUsersResults(array('limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->template('report/manage_user_result', $data);
		} else {
			redirect('welcome/login');
		}
	}

	function manageUserReportAjax()
	{
		if($this->session->userdata('logged_in')){
			
			$page = $this->input->post('page');
	        if(!$page){
	            $offset = 0;
	        }else{
	            $offset = $page;
	        }
	        
	        //total rows count
	        $totalRec = @count($this->Report_model->getUsersResults());
	        
	        //pagination configuration
	        $config['target']      = '#resultList';
	        $config['base_url']    = base_url().'report/manageUserReportAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getUserResult';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['user_result']   = $this->Report_model->getUsersResults(array('start'=>$offset,'limit'=>$this->perPage));
	        //get language
	        $language = MY_Loader::$add_data;
			$data     = array_merge($data,$language);
	        //load the view
	        $this->load->view('report/manage_user_result_ajax', $data, false);
		}
	}

	function getUserAnsers()
	{
		if($this->session->userdata('logged_in')){
			$this->load->model('User_model');
			$templ_enc_id      = $this->input->post('templ_id');
			$templ_id 		   = $this->Autoload_model->encrypt_decrypt('dc',$templ_enc_id);
			$user_id 		   = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('emp_id'));
			$ans_for_usr	   = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('ans_for_usr'));
			$data['templ_id']  = $templ_enc_id;
			$data['questions'] = $this->User_model->getAnswers($templ_id);
			$data['answer']    = $this->Report_model->getUserAnswersReport($templ_id,$user_id,$ans_for_usr);
	        $this->load->view('report/view_user_answers', $data, false);
		}
	}

	function alloweditAnsAcc()
	{
		$language 	= MY_Loader::$add_data['language'];
		$result = $this->Report_model->allowAnsEditAcc();
		$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['report_flash']['1'],1));
		redirect('report/userReport');
	}

	function questionReport()
	{
		if($this->session->userdata('logged_in')){
			$this->load->model('User_model');
			$data['title']     = "Manage Question Results";
			$data['template']  = $this->Autoload_model->getTemplateList();
			$data['questions'] = $this->Report_model->getQuestions();
			$data['answers']   = $this->Report_model->getAnsForTemplate();
			$this->load->template('report/manage_question_count', $data);
		} else {
			redirect('welcome/login');
		}
	}

	function getQuestionReport()
	{
		$this->load->model('User_model');
		$data['questions'] = $this->Report_model->getQuestions();
		$data['answers']   = $this->Report_model->getAnsForTemplate();
		$this->load->view('report/question_report', $data, false);
	}

	function userFeedback()
	{
		if($this->session->userdata('logged_in')){
			$this->load->model('User_model');
			$data['title']     = "Manage Question Results";
			$this->load->template('report/manage_user_feedback', $data);
		} else {
			redirect('welcome/login');
		}
	}

	function getuserFeedback()
	{
		$this->load->model('User_model');
		$data['questions'] = $this->Report_model->getQuestionsFeedbk();
		$data['answers']   = $this->Report_model->getAnsForTemplateFeedbk();
		$this->load->view('report/manage_user_feedback_ajax', $data, false);
	}

	function getAvailFeedTemplt()
	{
		echo $this->Report_model->loadFeedTemplt();
	}

	function loadTxtAnsQstn()
	{
		$data['qstn_id_req'] = $this->input->post('qstn_id');
		$data['answers']     = $this->Report_model->getAnsForTemplate();
		$this->load->view('report/text_ans_qstn', $data, false);
	}

	function loadTxtAnsFeed()
	{
		$data['qstn_id_req'] = $this->input->post('qstn_id');
		$data['answers']     = $this->Report_model->getAnsForTemplateFeedbk();
		$this->load->view('report/text_ans_qstn', $data, false);
	}

	function exportQuestionRprt()
	{
		$language 	= MY_Loader::$add_data['language'];

		$this->load->model('User_model');
        $this->load->library('excel');
        $empInfo = $this->Autoload_model->getTemplateList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $language['report_excel']['ques']);
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $language['report_excel']['answ_type']);
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $language['report_excel']['opti']);
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $language['report_excel']['coun']); 
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $language['report_excel']['text_answ']);    

        $questions = $this->Report_model->getQuestions();
		$answers   = $this->Report_model->getAnsForTemplate();

		$quest_ids = array();
        $quest_id  = array();
        foreach($answers as $answer){

	        $answer_json = json_decode($answer['qa_emp_ans']);
	        foreach($answer_json as $qstn_ID => $qstn_txt){
	          
	          if(!in_array($qstn_ID, $quest_ids)){
	            $quest_id[$qstn_ID] = array();
	            array_push($quest_ids,$qstn_ID);
	          }
	          array_push($quest_id[$qstn_ID],$qstn_txt);
	        }
	    }

	    $i=1; 
	    $rowCount = 3;

	    foreach($questions as $question){

	    	$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i.') '.$question['eq_question']);
	    	$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $question['eq_answer_type']);

			if($question['eq_answer_type']=='text'){

				if (array_key_exists($question['eq_id'],$quest_id)) {

					count($quest_id[$question['eq_id']]);

					foreach($quest_id[$question['eq_id']] as $txt_ans){

						$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $txt_ans);
						$rowCount++;
					}
				}

			} else {

				$options = $this->User_model->getOptionsforAnswer($question['eq_id']);             
                $option_ids = '';
                $option_arr = array();

                if (array_key_exists($question['eq_id'],$quest_id)) {

                    $option_ids = implode(',', $quest_id[$question['eq_id']]);
                }

                $option_arr = explode(',', $option_ids);
                $opti_count = array_count_values($option_arr);
                        
                foreach($options as $option){ 
                  	if($option['eqo_option_st']=='1'){

	                  	$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $option['eqo_option']);
	                  	$opti_ans_count = (@$opti_count[$option['eqo_id']]) ? $opti_count[$option['eqo_id']] : '0';
	                  	$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $opti_ans_count);
						$rowCount++;
					}
              	}
          	}

        	$i++;
        	$rowCount++; 
    	}

 		$fileName = 'Question-Report-'.time().'.xlsx';  
        header('Content-Type: application/vnd.ms-excel'); //mime type 
        header('Content-Disposition: attachment;filename="'.$fileName.'"'); //tell browser what's the file name 
        header('Cache-Control: max-age=0'); //no cache                
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        $objWriter->save('php://output');   
	}


	function exportFeedbkRprt()
	{
		$language 	= MY_Loader::$add_data['language'];

		$this->load->model('User_model');
        $this->load->library('excel');
        $empInfo = $this->Autoload_model->getTemplateList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $language['report_excel']['ques']);
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $language['report_excel']['answ_type']);
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $language['report_excel']['opti']);
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $language['report_excel']['coun']); 
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $language['report_excel']['text_answ']); 

        $questions = $this->Report_model->getQuestionsFeedbk();
		$answers   = $this->Report_model->getAnsForTemplateFeedbk();

		$quest_ids = array();
        $quest_id  = array();
        foreach($answers as $answer){

	        $answer_json = json_decode($answer['qa_emp_ans']);
	        foreach($answer_json as $qstn_ID => $qstn_txt){
	          
	          if(!in_array($qstn_ID, $quest_ids)){
	            $quest_id[$qstn_ID] = array();
	            array_push($quest_ids,$qstn_ID);
	          }
	          array_push($quest_id[$qstn_ID],$qstn_txt);
	        }
	    }

	    $i=1; 
	    $rowCount = 3;

	    foreach($questions as $question){

	    	$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i.') '.$question['eq_question']);
	    	$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $question['eq_answer_type']);

			if($question['eq_answer_type']=='text'){

				if (array_key_exists($question['eq_id'],$quest_id)) {

					count($quest_id[$question['eq_id']]);

					foreach($quest_id[$question['eq_id']] as $txt_ans){

						$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $txt_ans);
						$rowCount++;
					}
				}

			} else {

				$options = $this->User_model->getOptionsforAnswer($question['eq_id']);             
                $option_ids = '';
                $option_arr = array();

                if (array_key_exists($question['eq_id'],$quest_id)) {

                    $option_ids = implode(',', $quest_id[$question['eq_id']]);
                }

                $option_arr = explode(',', $option_ids);
                $opti_count = array_count_values($option_arr);
                        
                foreach($options as $option){ 
                  	if($option['eqo_option_st']=='1'){

	                  	$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $option['eqo_option']);
	                  	$opti_ans_count = (@$opti_count[$option['eqo_id']]) ? $opti_count[$option['eqo_id']] : '0';
	                  	$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $opti_ans_count);
						$rowCount++;
					}
              	}
          	}

        	$i++;
        	$rowCount++; 
		}

		$fileName = 'Feedback-Report-'.time().'.xlsx';  
        header('Content-Type: application/vnd.ms-excel'); //mime type 
        header('Content-Disposition: attachment;filename="'.$fileName.'"'); //tell browser what's the file name 
        header('Cache-Control: max-age=0'); //no cache                
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        $objWriter->save('php://output');
	}	


	function exportUserResult()
	{
		$language 	= MY_Loader::$add_data['language'];

		$this->load->model('User_model');
        $this->load->library('excel');
        $empInfo = $this->Autoload_model->getTemplateList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $language['report_excel']['ques']);
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $language['report_excel']['answ_type']);
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $language['report_excel']['opti']);
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $language['report_excel']['coun']); 
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $language['report_excel']['text_answ']);    

		$templ_id 		= $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('usr_rslt_exprt_templid'));
		$user_id 		= $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('usr_rslt_exprt_empid'));
		$ans_for_usr	= $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('usr_rslt_exprt_ans_usr'));
		$questions 		= $this->User_model->getAnswers($templ_id);
		$answer    		= $this->Report_model->getUserAnswersReport($templ_id,$user_id,$ans_for_usr);

		$answer_json = json_decode($answer['qa_emp_ans'],true);

	    $i=1; 
	    $rowCount = 3;

	    foreach($questions as $question){

	    	$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i.') '.$question['eq_question']);
	    	$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $question['eq_answer_type']);

			if($question['eq_answer_type']=='text'){

				if (array_key_exists($question['eq_id'],$answer_json)) {

					$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $answer_json[$question['eq_id']]);
					$rowCount++;
				}

			} else {

				           
                if (array_key_exists($question['eq_id'],$answer_json)) {

                	$options = $this->User_model->getOptionsforAnswer($question['eq_id']);  

                	foreach($options as $option){

                		$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $option['eqo_option']);

                		if($option['eqo_option_st']=='1'){
                		
                		
	                		if(in_array($option['eqo_id'], explode(',', $answer_json[$question['eq_id']]))) {
	                			
	                			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 1);
	                		} else {

	                			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 0);
	                		}
	                	} else if($option['eqo_option_st']=='0' && in_array($option['eqo_id'], explode(',', $answer_json[$question['eq_id']]))) {

	                		$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '1'.'(This option is deleted)');
	                	}

	                	$rowCount++;
                	}
                    
                }

          	}

        	$i++;
        	$rowCount++; 
		}

		$fileName = 'User-Result-'.time().'.xlsx';  
        header('Content-Type: application/vnd.ms-excel'); //mime type 
        header('Content-Disposition: attachment;filename="'.$fileName.'"'); //tell browser what's the file name 
        header('Cache-Control: max-age=0'); //no cache                
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        $objWriter->save('php://output');
	}


	public function createXLS() {

		$language 	= MY_Loader::$add_data['language'];

		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');
        $empInfo = $this->Autoload_model->getTemplateList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Tempate');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Template to');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Description');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Added On');      
        // set Row
        $rowCount = 2;
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['qt_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['qt_templ_to']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['qt_desc']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['qt_add_on']);
            $rowCount++;
        }
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        //$objWriter->save(ROOT_UPLOAD_IMPORT_PATH.$fileName);
		// download file
        //header("Content-Type: application/vnd.ms-excel");
        //redirect(HTTP_UPLOAD_IMPORT_PATH.$fileName);   

		//$this->excel->getActiveSheet()->fromArray($empInfo);
 
        $filename='just_some_random_name.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$fileName.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as.XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');   
    }

}
