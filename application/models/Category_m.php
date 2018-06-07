<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Category_m extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	public function get_Categories($value='')
	{

		return $this->db->order_by('cat_name','ASC')->get('category')->result();
	}

	public function optionCategory($category_id=0){

			$cat = '<select class="form-control" name="s_category" id="s_category"><option value="0">No category</option></select>';
		if($category = $this->get_Categories()){
			foreach ($category as $key) {
				# code...

				$cat = '<select class="form-control" name="s_category" id="s_category">';
				foreach ($category as $key) {
					# code...
					$cat .= "<option value='$key->cat_id'>$key->cat_name</option>";
				}

				$cat .= '</select>';

			}

		}
		return $cat;
	}
}