<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertNewCustomer($params_table, $params_columns, $params_conditions)
    {
        $columns = '';
        $values = '';

        for ($i=0; $i < count($params_columns) ; $i++) {
            $columns = ($i == count($params_columns)-1) ? $columns . strtoupper($params_columns[$i][0]).'' : $columns . strtoupper($params_columns[$i][0]).', ';
            $values = ($i == count($params_columns)-1) ? $values . '"'.$params_columns[$i][1].'"' : $values . '"'.$params_columns[$i][1].'", ';
        }
        
        $query = "INSERT INTO ".$params_table."(" .$columns. ") VALUES(".$values.")";

        return $this->db->query("".$query."");
    }

    public function updateCustomer($params_table, $params_columns, $params_conditions)
    {
        $query = "UPDATE ".$params_table." SET ";

        for ($i=0; $i < count($params_columns) ; $i++) {
            $query = ($i == count($params_columns)-1) ? $query . strtoupper($params_columns[$i][0]).'="'.$params_columns[$i][1].'" ' : $query . strtoupper($params_columns[$i][0]).'="'.$params_columns[$i][1].'", ';
		}
		
		$query = $query . "WHERE ";

		for ($i=0; $i < count($params_conditions) ; $i++) {
            $query = ($i == count($params_conditions)-1) ? $query . strtoupper($params_conditions[$i][0]).'="'.$params_conditions[$i][1].'" ' : $query . strtoupper($params_conditions[$i][0]).'="'.$params_conditions[$i][1].'", ';
		}

		return $this->db->query("".$query."");
    }

    public function getCustomerByColumn($params_table, $params_columns, $params_conditions)
    {
        $query = "SELECT ";

        for ($i=0; $i < count($params_columns) ; $i++) {
            $query = ($i == count($params_columns)-1) ? $query . strtoupper($params_columns[$i]).' ' : $query . strtoupper($params_columns[$i]).', ';
        }

        $query = $query . 'FROM ' . $params_table;

        if($params_conditions != null){
            $query = $query . " WHERE ";

            for ($i=0; $i < count($params_conditions) ; $i++) {
                if(isset($params_conditions[$i][2]) && $params_conditions[$i][2] == 'LIKE'){
                    $query = ($i == count($params_conditions)-1) ? $query . strtoupper($params_conditions[$i][0]).' LIKE "'.$params_conditions[$i][1].'" ' : $query . strtoupper($params_conditions[$i][0]).' LIKE "'.$params_conditions[$i][1].'", ';
                } else {
                    $query = ($i == count($params_conditions)-1) ? $query . strtoupper($params_conditions[$i][0]).'="'.$params_conditions[$i][1].'" ' : $query . strtoupper($params_conditions[$i][0]).'="'.$params_conditions[$i][1].'", ';
                }
            }
        }

        $result = $this->db->query("".$query."")->result_array();
        return $result;
    }

    public function getCustomerById($params_table, $params_columns, $params_conditions)
    {
        $query = "SELECT ";

        for ($i=0; $i < count($params_columns) ; $i++) {
            $query = ($i == count($params_columns)-1) ? $query . strtoupper($params_columns[$i]).' ' : $query . strtoupper($params_columns[$i]).', ';
        }

        $query = $query . 'FROM ' . $params_table;

        if($params_conditions != null){
            $query = $query . " WHERE ";

            for ($i=0; $i < count($params_conditions) ; $i++) {
                $query = ($i == count($params_conditions)-1) ? $query . strtoupper($params_conditions[$i][0]).'="'.$params_conditions[$i][1].'" ' : $query . strtoupper($params_conditions[$i][0]).'="'.$params_conditions[$i][1].'", ';
            }
        }

        $result = $this->db->query("".$query."")->result_array();
        return $result;
    }
}