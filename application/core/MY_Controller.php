<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller{

    // Set the autoload array.
    public $autoload = array(
        'helper'    => array( 'array', 'html', 'url' ),
        'libraries' => array( 'database', 'session', 'parser', 'messageci', 'ion_auth' ),
        'config'    => array( 'forums', 'messageci' ),
    );

    /**
     * Construct Functions
     *
     * This function is the construct.
     *
     * @author Chris Baines
     * @since 0.0.1
     */
    public function __construct()
    {
        parent::__construct();

        // Load Models.
        $this->load->model('categories/categories_m', 'categories');
        $this->load->model('discussions/discussions_m', 'discussions');

        // Load Language Files.

    }
}

class Front_Controller extends MY_Controller{

    private $theme;
    private $site_name;

    public function __construct()
    {
        parent::__construct();

        $this->theme        = $this->config->item('theme');
        $this->site_name    = $this->config->item('site_name');
    }

    /**
     * Render
     *
     * This function is for the template system,
     * it takes all the templates and renders
     * them to the browser.
     *
     * @author Chris Baines
     * @since 0.0.1
     */
    public function render( $page_data=array(), $page_title, $page_template )
    {
        // Get the categories for the sidebar.
        $categories = $this->categories->sidebar_categories();

        if( !empty($categories) )
        {
            foreach( $categories as $row )
            {
                $data['categories'] = array(
                    array(
                        'name' => anchor( site_url('categories/'.$row->name.'/'.$row->slug.''), $row->name ),
                        'discussion_count' => $row->discussion_count,
                    ),
                );
            }

            array_unshift( $data['categories'], array('name' => anchor( site_url('categories'), 'All Categories'), 'discussion_count' => $this->discussions->count_all() ) );
        } else {
            $data['categories'] = array(
                array(
                    'name' => 'No Categories',
                    'discussion_count' => 0,
                ),
            );
        }
        // Build the template data array.
        $data = array(
            // Navigation.
            'navigation' => array(
                'links' => array(
                    array( 'link' => anchor( site_url(), 'Discussions' ) ),
                ),
                'logo' => anchor( site_url(), $this->site_name, array( 'class' => 'navbar-brand' ) ),
                'username' => ucfirst( $this->session->userdata('username') ),
                'logout_link' => anchor( site_url( 'users/logout' ), 'Logout' ),
                'profile_link' => anchor( site_url( 'users/profile' ), 'Profile' ),
                'settings_link' => anchor( site_url( 'users/settings' ), 'Settings' ),
                'dashboard_link' => anchor( site_url( 'dashboard' ), 'Dashboard' ),
                'login_link' => anchor( site_url( 'users/login' ), 'Login' ),
                'register_link' => anchor( site_url( 'users/register' ), 'Register' ),
            ),
            // Sidebar.
            'sidebar' => array(
                'new_discussion_button' => anchor( site_url('discussions/new_discussion'), 'New Discussion', array( 'class' => 'btn btn-success btn-sm' )),
                'categories' => element( 'categories', $data ),
            ),
            // Footer.
            'footer' => array(
                'copy_text' => 'Powered By '.anchor( 'http://www.doveforums.com', 'Dove Forums').', &copy; 2011 - 2015.',
            ),
        );

        // Define the template regions.
        $data['templates'] = array(
            'doctype' => doctype('html5'),
            'css' => array(
                array( 'link' => '<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">' ),
                array( 'link' => '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">' ),
                array( 'link' => '<link href="'.base_url('application/views/templates/'.$this->theme.'/assets/css/custom.css').'", rel="stylesheet">' ),
                array( 'link' => '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">' ),
            ),
            'meta' => array(
                array( 'meta' => meta('keywords', $this->config->item('keywords')) ),
            ),
            'js' => array(
                array( 'script' => '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>' ),
                array( 'script' => '<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>' ),
            ),
            // Page Title.
            'title' => ''.$this->site_name.' - '.$page_title.'',
            // Navigation.
            'navigation' => $this->parser->parse( 'templates/'.$this->theme.'/regions/navigation', element( 'navigation', $data ), TRUE ),
            // Sidebar.
            'sidebar' => $this->parser->parse( 'templates/'.$this->theme.'/regions/sidebar', element( 'sidebar', $data ), TRUE ),
            // Content.
            'content' => $this->parser->parse( 'templates/'.$this->theme.'/'.$page_template.'', $page_data, TRUE ),
            // Footer.
            'footer' => $this->parser->parse( 'templates/'.$this->theme.'/regions/footer', element( 'footer', $data ), TRUE ),
        );

        // Send all the data to the layout file.
        $this->parser->parse( 'templates/'.$this->theme.'/layout', element( 'templates', $data ) );
    }

}