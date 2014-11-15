<?php

/**
 * class used to extend base model
 * 
 * @author Andy
 *
 */
class  MY_Model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    
//     public function save()
//     {
//         if (!isset($this->_table_name)) {
//             throw  new  Exception('The table name is not empty!', 0000);
//         }
            
//         $save_data = array();
// //         $fields    = array();
// //         $instance  = new ReflectionClass(get_class($this));
// //         $props     = $instance->getProperties();
// //         foreach ($props as $prop)
// //         {
// //            $fields[] = $prop->getName();
// //         }
//         $fields  = array_keys(get_class_vars(get_class($this)));
//         $fields  = array_flip($fields);
//         if (array_key_exists('_table_name', $fields)) {
//             unset($fields['_table_name']);
//         }
        
//         foreach ($fields as $key => $value)
//         {
//             if (NULL !== $this->$key) {
//                 $save_data[$key] = $this->$key;
//             }
//         }
        
//         return $this->db->insert($this->_table_name, $save_data);
//     }

    
    public function save()
    {
        $_table_name = $this->_getTableName();
        
        return $this->db->insert($_table_name, $this);
    }
    
    
    public function update(MY_Model $model, array $where = array())
    {
        $_table_name = $this->_getTableName();
        return $this->db->update($_table_name, $model, $where);
    }
    
    
    public function delete(array $where = array())
    {
        $_table_name = $this->_getTableName();
        return $this->db->delete($where);
    }
    
    public function selectOne(array $where = array())
    {
        $_table_name = $this->_getTableName();
        $query = $this->db->get_where($_table_name, $where, 1);
        
        return $query->row();
    }
    
    /**
     * according to the table name selects all items
     * 
     * @return array --  the selected result
     */
    public function selectAll()
    {
        $query = $this->db->get($this->_getTableName());
        return $query->result();
    }
    
    
    /**
     * method used to query data from  db according to sql
     * 
     * @param string $sql -- sql 
     * @return array -- the selected data from database
     */
    public function queryBySQL($sql = '')
    {
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        
        return array();
    }
    

    /**
     * method used to insert data into db
     *
     * @param string $sql -- sql
     * @return integer -- affected rows
     */
    public function insertBySQL($sql = '')
    {
        $query = $this->db->query($sql);
        return $query->affected_rows();
    }
    
    
    private function _getTableName()
    {
        $table_name;
        if (!isset($this->_table_name)) {
            throw  new  Exception('The table name is not empty!', 0000);
        }else {
            $table_name = $this->_table_name;
            unset($this->_table_name);
        }
        return $table_name;
    }
    
}