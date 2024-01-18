<?php

class Language extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $sql = "SELECT * FROM languages";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}






?>