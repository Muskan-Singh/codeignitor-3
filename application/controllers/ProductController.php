<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {


    public function AddProductView() 
    {
        $active['active'] = 'active';
        if (count($this->input->post())>0) {
            $this->form_validation->set_rules('pname', 'Product Name', 'required|is_unique[prod_details.pname]');
            $this->form_validation->set_rules('price', 'Price', 'required');
            $this->form_validation->set_rules('prod_desc', 'Prodct Desc', 'required');
            if ($this->form_validation->run() == FALSE) {
				
				$this->session->set_flashdata("error",validation_errors());
				redirect(base_url()."AddProductView",$active);
				
            }
            $data = $this->input->post();
            $newdata = array();
            $newdata['user_id'] = $this->session->userdata('user_id');
            $newdata['pname'] = $data['pname'];
            $newdata['price'] = $data['price'];
            $newdata['prod_desc'] = $data['prod_desc'];
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['encrypt_name'] =TRUE;
            
            $this->load->library('upload', $config);
            
            // MAIN IMG UPLOAD WITH DETAILS
            
            if ( ! $this->upload->do_upload('m_img')) {
                $error = array('error' => $this->upload->display_errors());
                
                $this->load->view('addProductsView', $error,$active);
            } else {
                $img_data = $this->upload->data();
                $newdata['m_img'] = $img_data['file_name'];
                $this->load->view('addProductsView');
                $this->UserModel->InsertProductDetails($newdata,$active);
                
            }
            
            // MULTIPLE IMG UPLOAD
            
            if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0) { 
                $filesCount = count($_FILES['files']['name']); 
                for($i=0;$i<$filesCount;$i++) {
                    $_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
                    $_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
                    $_FILES['file']['error']     = $_FILES['files']['error'][$i]; 
                    $_FILES['file']['size']     = $_FILES['files']['size'][$i]; 


                    // $uploadPath = './uploads/'; 
                    // $config['upload_path'] = $uploadPath; 
                    // $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                    // $this->load->library('upload', $config); 
                    // $this->upload->initialize($config); 

                    if($this->upload->do_upload('file')) { 
                        $fileData = $this->upload->data(); 
                        $uploadData[$i]['file_name'] = $fileData['file_name']; 
                        $multi_id = $this->UserModel->getProdId($newdata['pname']);
                        $data1 = array();
                        $data1['multi_id'] = $multi_id;
                        $data1['img_add'] = $uploadData[$i]['file_name'];
                        $this->UserModel->InsertMultiImgData($data1);
                        $this->session->set_flashdata('success','Product Uploaded Succcessfully');
                    } else {  
                        $this->session->set_flashdata('error','Product Not Uploaded ');
                    }
                    
                }
                redirect(base_url()."AddProductView",$active);
            }
            

            
        }
        $this->load->view('addProductsView');
    }

    public function GalleryView()
    {
        $user_id = $this->session->userdata('user_id');
        $main_data = $this->UserModel->getProdsMultiImg($user_id);
        $data = array();
        $data['main_data'] = $main_data;
        $config['base_url'] = 'galleryView';
        // die(dd(count($main_data)));
        $config['total_rows'] = count($main_data);
        // die(dd($config['total_rows'));
        $config['per_page'] = 1;
        $this->pagination->initialize($config);
        $q =$this->pagination->create_links();
        $this->load->view('galleryView',$data);
    }
// DATA TABLE
    public function dataTable()
    {
        if($this->input->is_ajax_request()){
            $start = $this->input->get('start');
            $legnth = $this->input->get('length');
            $coulmn = $this->input->get('order')[0]['column'];
            $ascc = $this->input->get('order')[0]['dir'];;
            $search =  $this->input->get('search')['value'];
            $users = $this->db->select('ci_register.*');
            $counts = $this->db->query("select * from ci_register")->num_rows();
            if(!empty($search)){
                $where = "( full_name LIKE '%".$search."%' or email  LIKE '%".$search."%')";
                $users->where($where);
            }
            $count = $users->get('ci_register')->num_rows();
            if ($coulmn == 1) {
               $users->order_by('user_id',$ascc);
            } elseif($coulmn == 2) {
               $users->orderBy('full_name',$ascc);
            } elseif($coulmn == 3) {
               $users->orderBy('email',$ascc);
            } 
            

            $list = $users->limit($legnth, $start)->get('ci_register')->result();
            if(count($list) > 0){
                // assigned.edit
                foreach ($list as $key => $value) {
                   
                    $nestedData[0] = $start+$key+1;                    
                    $nestedData[1] = $value->full_name;
                    $nestedData[2] =$value->email;                 
                    
                    $data[] = $nestedData;
                }

        
                $json_data = array(
                    "recordsTotal"    => $counts,
                    "recordsFiltered" => $count,
                    "data"            => $data
                );
        
        
            }else{
                $json_data = array(
                    "recordsTotal"    => 0,
                    "recordsFiltered" => 0,
                    "data"            => []
                );
            }
            echo json_encode($json_data);
            exit;
        }
        $this->load->view("dataTable");
    
    }
    public function Mailer()
    {
        if(count($this->input->post())>0) {
            $email  = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $data = array();
            $data['email'] = $email;
            $data['subject'] = $subject;
            $data['message'] = $message;
            // $config = array();
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.mailtrap.io',
                'smtp_port' => 2525,
                'smtp_user' => '6eb304dfb3b33d',
                'smtp_pass' => '72c2859a95d955',
                'crlf' => "\r\n",
                'newline' => "\r\n"
            );
            // $config['protocol'] = 'smtp';
            // $config['smtp_host'] = 'smtp.mailtrap.io';
            // $config['smtp_user'] = '6eb304dfb3b33d';
            // $config['smtp_pass'] = '72c2859a95d955';
            // $config['smtp_port'] = 2525;
            $this->email->initialize($config);
            // die(dd($data));
            $this->email->from('phpmailer.1902@gmail.com','Ritik@1234');
            $this->email->to($email);
            $this->email->subject('Send Email Codeigniter');
            $this->email->message('The email send using codeigniter library');
            if($this->email->send()) {
                $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
                // $this->load->view('mailerview');
                die(dd("if"));
            } else { 
                $this->session->set_flashdata("email_sent","You have encountered an error");
                // $this->load->view('mailerView');
                die(dd("ELSE !"));
            }
    
            

        } else {

            $this->load->view('mailerView');
        }
        

    }

}



?>