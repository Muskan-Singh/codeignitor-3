<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {


    public function AddProductView() 
    {
        if (count($this->input->post())>0) {
            $this->form_validation->set_rules('pname', 'Product Name', 'required|is_unique[prod_details.pname]');
            $this->form_validation->set_rules('price', 'Price', 'required');
            $this->form_validation->set_rules('prod_desc', 'Prodct Desc', 'required');
            if ($this->form_validation->run() == FALSE) {
				
				$this->session->set_flashdata("error",validation_errors());
				redirect(base_url()."AddProductView");
				
            }
            $data = $this->input->post();
            $newdata = array();
            $newdata['user_id'] = $this->session->userdata('user_id');
            $newdata['pname'] = $data['pname'];
            $newdata['price'] = $data['price'];
            $newdata['prod_desc'] = $data['prod_desc'];
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] =TRUE;
            
            $this->load->library('upload', $config);
            
            
            if ( ! $this->upload->do_upload('m_img'))
            {
                $error = array('error' => $this->upload->display_errors());
                
                $this->load->view('addProductsView', $error);
                // die(dd($error));
            }
            else
            {
                $img_data = $this->upload->data();
                $newdata['m_img'] = $img_data['file_name'];
                $this->load->view('addProductsView');
                $this->UserModel->InsertProductDetails($newdata);
                $this->session->set_flashdata('success','Product Uploaded Succcessfully');
                redirect(base_url()."AddProductView");
            }

            
        }
        $this->load->view('addProductsView');
    }

    public function GalleryView()
    {
        $this->load->view('galleryView');
    }

    public function dataTable()
    {
        $user = $this->UserModel->getUsers();
        $data= array();
        $data['users'] = $user;
        $this->load->view('dataTable',$data);
    }



}



?>