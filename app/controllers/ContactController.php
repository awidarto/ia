<?php

class ContactController extends TableController {

    public function __construct()
    {
        parent::__construct();

        $this->controller_name = str_replace('Controller', '', get_class());

        //$this->crumb = new Breadcrumb();
        $this->crumb->append('Home','left',true);
        $this->crumb->append(strtolower($this->controller_name));

        $this->model = new Message();
        //$this->model = DB::collection('documents');

    }

    public function getAdd()
    {
        $this->title = 'Contact Us';

        return parent::getAdd();
    }

    public function postAdd($data = null)
    {

        $this->validator = array(
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'message' => 'required'
        );

        $this->backlink = 'contact/landing';

        return parent::postAdd($data);
    }

    public function getLanding()
    {
        return View::make('contact.landing');
    }

}