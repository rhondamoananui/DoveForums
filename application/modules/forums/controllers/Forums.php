<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Forums extends Front_Controller
{
    public function index()
    {
        // Define the page title.
        $data['title'] = 'Home';

        // Define the template.
        $data['template'] = 'pages/home/home';

        // Define the page data.
        $data['page'] = array(

        );

        $this->render( element('page', $data), element('title', $data), element('template', $data) );
    }
}