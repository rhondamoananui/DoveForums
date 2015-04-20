<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forums extends Front_Controller
{
    public function index()
    {
        // Define the page title.
        $data['title'] = 'Recent Discussions';

        // Define the template.
        $data['template'] = 'pages/home/home';

        // Get the discussions from the database.
        $discussions = $this->discussions->get_discussions();

        // Loop through the discussions.
        if( !empty($discussions) )
        {
            foreach($discussions as $row)
            {
                $data['discussions'] = array(
                    array(
                        'name' => anchor( site_url('discussions/'.$row->category_slug.'/'.$row->discussion_slug.''), $row->discussion_name),
                        'comment_count' => $row->comment_count,
                        'view_count' => $row->view_count,
                        'last_comment_date' => date("jS M Y - h:i:s A", strtotime( $row->last_comment_date) ),
                        'last_comment_username' => anchor( site_url('users/profile/'.$row->user_id), $row->username ),
                        'category_name' => anchor( site_url('categories/'.$row->category_slug.''), $row->category_name ),
                    ),
                );
            }

            // Checking variable for view file.
            $has_discussions = 1;

        } else {

            // Fill with blank data to prevent errors.
            $data['discussions'] = '';

            // Checking variable for view file.
            $has_discussions = 0;
        }

        // Build the page breadcrumbs.
        $this->crumbs->add('recent discussions');

        // Define the page data.
        $data['page'] = array(
            'discussions' => element('discussions', $data),
            'has_discussions' => $has_discussions,
            'breadcrumbs' => $this->crumbs->output(),
        );

        $this->render( element('page', $data), element('title', $data), element('template', $data) );
    }
}