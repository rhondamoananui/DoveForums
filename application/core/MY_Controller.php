<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller{

    public $autoload = array();

    public function __construct()
    {
        parent::__construct();
    }
}

class Front_Controller extends MY_Controller{


}