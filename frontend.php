<?php

class frontend
{
	public function getlocation()
	{
		$query="SELECT * FROM location ORDER BY location";
		$result=mysql_query($query);
		$testing=array();
		while ($row=mysql_fetch_array($result))
		{
			$location=array();
			$location=array('id' => $row['id'],'name'=>$row['location'] );

			array_push($testing, $location);
		}
		return $testing;
	}

		public function movies()
	{
		$query="SELECT * FROM movies ORDER BY id";
		$result=mysql_query($query);
		$testing=array();
		while ($row=mysql_fetch_array($result))
		{
			$location=array();
			$location=array('id' => $row['id'],'name'=>$row['name'] );

			array_push($testing, $location);
		}
		return $testing;
	}

	public function slider()
	{
		$query=mysql_query("SELECT * FROM slider");

		$slider= array();
		while($row=mysql_fetch_array($query))
		{
			$testing=array();

            $testing=array('id' => $row['id'],'image'=>$row['image']);

            array_push($slider, $testing);


		}
		return $slider;
	}

	public function recent()
	{
		$query=mysql_query("SELECT * FROM movies order by id desc limit 20");

		$slider= array();
		while($row=mysql_fetch_array($query))
		{
			$testing=array();

            $testing=array('id' => $row['id'],'image'=>$row['image']);

            array_push($slider, $testing);


		}
		return $slider;
	}
}


?>