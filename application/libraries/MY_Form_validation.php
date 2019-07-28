<?php

class MY_Form_validation extends CI_Form_validation
{

    public function edit_unique($str, $field)
    {
        sscanf($field, '%[^.].%[^.].%[^.].%[^.]', $table, $field,  $column_id, $id);

        return   isset($this->CI->db)
            ? ($this->CI->db->limit(1)->get_where($table, array($field => $str, $column_id . ' !=' => $id))->num_rows() === 0)
            : FALSE;
    }

    public function max_stok($str, $field)
    {
        sscanf($field, '%[^.].%[^.].%[^.].%[^.]', $table, $field,  $column_id, $id);

        return   isset($this->CI->db)
            ? ($this->CI->db->limit(1)->get_where($table, array("$field <= " => $str, $column_id . ' !=' => $id))->num_rows() !== 0)
            : FALSE;
    }
}