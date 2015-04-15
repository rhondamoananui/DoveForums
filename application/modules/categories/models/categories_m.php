<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_m extends CI_Model {

    /**
     * Sidebar Categories
     *
     * This function grabs all the categories
     * from the database.
     *
     * @return object
     * @author Chris Baines
     * @since 0.0.1
     */
    public function sidebar_categories()
    {
        // Query.
        $query = $this->db->select('category_id, discussion_count, comment_count, name, slug, description')
            ->get('categories');

        // Result.
        if( $query->num_rows() > 0 )
        {
            return $query->result();
        } else {
            return FALSE;
        }
    }
}