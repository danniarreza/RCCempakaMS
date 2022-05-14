<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertNewTransaction($params_table, $params_columns, $params_conditions)
    {
        $columns = '';
        $values = '';

        for ($i=0; $i < count($params_columns) ; $i++) {
            $columns = ($i == count($params_columns)-1) ? $columns . strtoupper($params_columns[$i][0]).'' : $columns . strtoupper($params_columns[$i][0]).', ';
            $values = ($i == count($params_columns)-1) ? $values . '"'.$params_columns[$i][1].'"' : $values . '"'.$params_columns[$i][1].'", ';
        }
        
        $query = "INSERT INTO ".$params_table."(" .$columns. ") VALUES(".$values.")";

        $result = $this->db->query("".$query."");

        return ($result == 1) ? $this->db->insert_id() : 0;
    }

    public function updateTransaction($params_table, $params_columns, $params_conditions)
    {
        $query = "UPDATE ".$params_table." SET ";

        for ($i=0; $i < count($params_columns) ; $i++) {
            $query = ($i == count($params_columns)-1) ? $query . strtoupper($params_columns[$i][0]).'="'.$params_columns[$i][1].'" ' : $query . strtoupper($params_columns[$i][0]).'="'.$params_columns[$i][1].'", ';
        }
        
        $query = $query . "WHERE ";

        for ($i=0; $i < count($params_conditions) ; $i++) {
            $query = ($i == count($params_conditions)-1) ? $query . strtoupper($params_conditions[$i][0]).'="'.$params_conditions[$i][1].'" ' : $query . strtoupper($params_conditions[$i][0]).'="'.$params_conditions[$i][1].'" AND ';
        }

        // return $query;

        return $this->db->query("".$query."");
    }

    public function getTransactionByColumn($params_table, $params_columns, $params_conditions)
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
        return $query;
    }

    public function getTransactionByColumnJoin($params_table, $params_columns, $params_conditions, $params_join)
    {
        $select = '';
        for ($i=0; $i < count($params_columns) ; $i++) {
            $select = ($i == count($params_columns)-1) ? $select . strtoupper($params_columns[$i]).' ' : $select . strtoupper($params_columns[$i]).', ';
        }
        $this->db->select($select);
        $this->db->from($params_table);
        
        for ($i=0; $i < count($params_conditions); $i++) { 
            if(isset($params_conditions[$i][2]) && $params_conditions[$i][2] == 'OR'){
                if(isset($params_conditions[$i][3]) && $params_conditions[$i][3] == 'LIKE'){
                    $this->db->or_like($params_conditions[$i][0], $params_conditions[$i][1]);
                } else {
                    $this->db->or_where($params_conditions[$i][0], $params_conditions[$i][1]);
                }
            } else {
                if(isset($params_conditions[$i][3]) && $params_conditions[$i][3] == 'LIKE'){
                    $this->db->or_like($params_conditions[$i][0], $params_conditions[$i][1]);
                } else {
                    $this->db->where($params_conditions[$i][0], $params_conditions[$i][1]);
                }
                
            } 
        }
        
        for ($j=0; $j < count($params_join) ; $j++) {
            $join_condition = '';

            // for ($i=1; $i < count($params_join[$j]); $i++) { 
                // $join_condition = ($i == count($params_join[$j]) - 1) ? $join_condition . $params_join[$j][$i] . ' ' : $join_condition . $params_join[$j][$i] . ' AND ' ;
            // }

            $join_condition = $params_join[$j][1] . ' ';

            if(isset($params_join[$j][2])){
                $this->db->join($params_join[$j][0], $join_condition, $params_join[$j][2]);
            } else {
                $this->db->join($params_join[$j][0], $join_condition);
            }

            
        }

        $query = $this->db->get();
        return $query->result_array();

       
    }

    public function getTransactionById($params_table, $params_columns, $params_conditions)
    {
        $query = "SELECT ";

        for ($i=0; $i < count($params_columns) ; $i++) {
            $query = ($i == count($params_columns)-1) ? $query . strtoupper($params_columns[$i]).' ' : $query . strtoupper($params_columns[$i]).', ';
        }

        $query = $query . 'FROM ' . $params_table;

        if ($params_conditions != null) {
            $query = $query . " WHERE ";

            for ($i=0; $i < count($params_conditions) ; $i++) {
                $query = ($i == count($params_conditions)-1) ? $query . strtoupper($params_conditions[$i][0]).'="'.$params_conditions[$i][1].'" ' : $query . strtoupper($params_conditions[$i][0]).'="'.$params_conditions[$i][1].'" AND ';
            }
        }
        
        $result = $this->db->query("".$query."")->result_array();
        return $result;
    }

    public function getTransactionByIdOrderByLimit($params_table, $params_columns, $params_conditions, $params_orderby, $params_limit)
    {
        $select = '';
        for ($i=0; $i < count($params_columns) ; $i++) {
            $select = ($i == count($params_columns)-1) ? $select . strtoupper($params_columns[$i]).' ' : $select . strtoupper($params_columns[$i]).', ';
        }
        $this->db->select($select);
        $this->db->from($params_table);
        
        for ($i=0; $i < count($params_conditions); $i++) { 
            $this->db->where($params_conditions[$i][0], $params_conditions[$i][1]);
        }
        
        for ($j=0; $j < count($params_orderby) ; $j++) {
            $this->db->order_by($params_orderby[$j][0], $params_orderby[$j][1]);
        }

        $this->db->limit($params_limit);

        $query = $this->db->get();
        return $query->result_array();
    }
}
