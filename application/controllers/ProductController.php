<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {


    public function AddProductView() 
    {
        if (count($this->input->post())>0) {
            
            $data = $this->input->post();
            $newdata = array();
            $newdata['pname'] = $data['pname'];
            $newdata['price'] = $data['price'];
            $newdata['prod_desc'] = $data['prod_desc'];
            
            die(dd($newdata));
            
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