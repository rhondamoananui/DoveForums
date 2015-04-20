<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crumbs
{
    private $include_home;
    private $breadcrumb = array();
    private $divider;
    private $container_open;
    private $container_close;
    private $crumb_open;
    private $crumb_close;

    public function __construct()
    {
        $CI =& get_instance();
        $CI->load->helper('url');
        $CI->load->config('crumbs', TRUE);

        $this->include_home = $CI->config->item('include_home', 'crumbs');
        $this->divider = $CI->config->item('divider', 'crumbs');
        $this->container_open = $CI->config->item('container_open', 'crumbs');
        $this->container_close = $CI->config->item('container_close', 'crumbs');
        $this->crumb_open = $CI->config->item('crumb_open', 'crumbs');
        $this->crumb_close = $CI->config->item('crumb_close', 'crumbs');

        if( isset( $this->include_home ) && ( sizeof( $this->include_home ) > 0 ) )
        {
            $this->breadcrumb[] = array( 'title' => $this->include_home, 'href' => site_url() );
        }
    }

    public function add( $title = NULL, $href = '', $segment = FALSE )
    {

        // If $title is empty, return.
        if ( is_null( $title ) ) return;

        // Find out if we have a href.
        if( isset( $href ) && strlen( $href ) > 0 )
        {
            // If $segment is not false, we will build the URL from the previous crumb.
            if ( $segment )
            {
                $previous = $this->breadcrumb[ sizeof( $this->breadcrumb ) - 1 ]['href'];
                $href = $previous . '/' . $href;
            }

            elseif (!filter_var( $href, FILTER_VALIDATE_URL ) )
            {
                $href = site_url($href);
            }
        }

        // Add crumb to the end of the breadcrumbs.
        $this->breadcrumb[] = array(
            'title' => $title,
            'href' => $href,
        );

    }

    public function output()
    {
        // Set the container tag.
        $output = $this->container_open;

        if( sizeof( $this->breadcrumb ) > 0 )
        {
            foreach( $this->breadcrumb as $key=>$crumb )
            {
                $output .= $this->crumb_open;

                if( strlen( $crumb['href'] ) > 0 )
                {
                    $output .= anchor($crumb['href'], ucwords( $crumb['title'] ) );
                }
                else
                {
                    $output .= ucwords( $crumb['title'] );
                }

                $output .= $this->crumb_close;

                if( $key < ( sizeof( $this->breadcrumb ) - 1 ) )
                {
                    $output .= $this->divider;
                }
            }
        }

        // Set the container closing tag.
        $output .= $this->container_close;

        return $output;
    }
}