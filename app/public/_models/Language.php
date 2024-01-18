<?php

class Language extends Database
{
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * get_all
     *
     * @param  string $order_by  column "language" or "language_type"
     * @param  string $order "ASC" or "DESC" (DESC default)
     * @return array
     */
    public function get_all($order_by, $order)
    {
        // order_by - known column name
        $columns = array("language", "language_type");
        if (in_array($order_by, $columns)) {
            $sql_order_by = "ORDER BY $order_by";
        } else {
            $sql_order_by = "ORDER BY language";
        }

        $orders = array("ASC", "DESC");
        if (in_array($order, $orders)) {
            $sql_order = " " . $order;
        } else {
            $sql_order = "";
        }

        // ternary operator - if-else oneliner...
        $order = $order === "DESC" ? " DESC" : " ASC";


        $sql = "SELECT * FROM languages ";
        $sql .= $sql_order_by;
        $sql .= $order;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}






?>