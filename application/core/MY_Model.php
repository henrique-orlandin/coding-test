<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Classe de modelagem de dados MY_Model
 * @author      Gabriel Heming <gabriel_heming@hotmail.com>
 * @package     CI
 * @author		Gabriel heming  <gabriel_heming@hotmail.com>
 * @copyright 	Ezoom
 */

class MY_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->db->query('SET lc_time_names = "en_CA"');
        $this->db->query("SET time_zone = '-08:00'");
    }


    /**
     * Realiza a iteração pelo objeto CI_DB_result
     * @param CI_DB_mysql_result $query Objeto retornado por uma consulta sql
     * @return ArrayObject Uma lista conforme o sql utilizado na consulta de $query. Cada linha da lista é um ArrayIterator
     */
    public function query_to_array( CI_DB_result $query ) {
        $array = new ArrayObject();
        foreach( $query->result() AS $key => $row ) {
            $array->append( new ArrayIterator( get_object_vars( $row ) ) );
        }
        return $array;
    }


}
// END MY_Model Class

/* End of file MY_Model.php */
/* Location: ./system/application/core/MY_Model.php */