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
            
            
            if ( ! $this->upload->do_upload('m_img')) {
                $error = array('error' => $this->upload->display_errors());
                
                $this->load->view('addProductsView', $error,$active);
            } else {
                $img_data = $this->upload->data();
                $newdata['m_img'] = $img_data['file_name'];
                $this->load->view('addProductsView');
                $this->UserModel->InsertProductDetails($newdata,$active);
                
            }
            
            
            
            if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0) { 
                $filesCount = count($_FILES['files']['name']); 
                for($i=0;$i<$filesCount;$i++) {
                    $_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
                    $_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
                    $_FILES['file']['error']     = $_FILES['files']['error'][$i]; 
                    $_FILES['file']['size']     = $_FILES['files']['size'][$i]; 


                    

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
        $total_records = $this->UserModel->getProdsMultiImg($user_id);
        $start_index = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config['base_url'] = base_url() . 'galleryview';
        $config['total_rows'] = $total_records;
        $config['per_page'] = 3;
        $config["uri_segment"] = 2;
        $config['page_query_string'] = true;
        // $result_per_page =3;
        $total_products= $total_records ;
    //   dd($total_products);
    //   exit;
        $this->pagination->initialize($config);
        $data['links'] =$this->pagination->create_links();

        //$total_pages = ceil(count($total_records)/$result_per_page);
        if($total_products==0){
        echo "Please add some products";
            redirect(base_url()."AddProductView");
        }
        $total_pages = ceil($total_products/ $config['per_page'] );
        //die(dd( $total_pages));
        if(empty($this->input->get('page'))){
            $page = 1;
           // die(dd($page));
        }
        else{
           
            $page = $this->input->get('page');
            if($page>   $total_pages){
                $page=   $total_pages;
            }
            if($page<1){
                $page=1;
            }
        }

        // $first = ($page-1) *  $config['per_page'] ;
       //die(dd( $first));
        $data['result'] = $this->UserModel->get_products($user_id,$start_index, $config['per_page'] );
// dd($result);
// exit;
        $data['number_of_pages'] =   $total_pages;
        $data['page'] = $page;
        // dd($data);
        // exit;
        //$this->load->view("ProductGallery",$data);  
        //die(dd($data));
        $this->load->view('galleryView',$data);
    }

   
   
    public function mainProdCont()
    {
        $id = $this->input->get();
        $prod_id = $id['id'];  
        $q = $this->db->query("select * from prod_details where prod_id = '$prod_id'")->result_array();
        $q1 = $this->db->query("Select * from multi_img where multi_id='$prod_id'")->result_array();
        $data1['data1'] = $q1;
        $f['f']= $data1['data1'];
       
        $this->load->view('SingleProductView',$f);
    } 

    public function ProductType() {

        $this->load->view('prodtype_view');
    }


}



?>