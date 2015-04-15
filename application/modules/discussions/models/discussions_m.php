<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discussions_m extends CI_Model {

    /**
     * Count All
     *
     * This function counts all the discussions
     * in the database.
     *
     * @return int
     * @author Chris Baines
     * @since 0.0.1
     */
    public function count_all()
    {
        // Query.
        $query = $this->db->select('*')
            ->get('discussions');

        // Result.
        if( $query->num_rows() > 0 )
        {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
}