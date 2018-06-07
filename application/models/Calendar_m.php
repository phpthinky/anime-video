<?php

class Calendar_m extends CI_Model
{

public function create2($value='')
{
	# code...
	$sql = "TRUNCATE pageview";
	return $this->db->query($sql);

}

	public function create()
	{
		# code...
		$sql = "CREATE TABLE `calendar_events` (
 `ID` int(11) NOT NULL,
 `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
 `start` datetime NOT NULL,
 `end` datetime NOT NULL,
 `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

	$query = $this->db->query($sql);
	return $query->result();
	}
	public function insert()
	{
		# code...
		$sql = "INSERT INTO `calendar_events` (`ID`, `title`, `start`, `end`, `description`) VALUES
(7, 'Test Event 1', '2017-12-13 00:00:00', '2017-12-14 00:00:00', ''),
(8, 'New Event 1', '2017-12-25 00:00:00', '2017-12-27 00:00:00', '');";

	$query = $this->db->query($sql);
	return $query;


	}public function truncate()
	{
		# code...
		$sql = "TRUNCATE calendar_events";

	$query = $this->db->query($sql);
	return $query;


	}

	
			public function get_events($start, $end)
			{
			    return $this->db->where("start >=", $start)->where("end <=", $end)->get("calendar_events");
			}

			public function add_event($data)
			{
			    $this->db->insert("calendar_events", $data);
			}

			public function get_event($id)
			{
			    return $this->db->where("ID", $id)->get("calendar_events");
			}

			public function update_event($id, $data)
			{
			    $this->db->where("ID", $id)->update("calendar_events", $data);
			}

			public function delete_event($id)
			{
			    $this->db->where("ID", $id)->delete("calendar_events");
			}



}

?>