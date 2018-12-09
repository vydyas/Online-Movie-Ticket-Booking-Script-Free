<?php
class admin
{
	public function login($username,$password)
	{
		$query=mysql_query("select * from admin where id=1");
		while($row=mysql_fetch_array($query))
		{
			if($username==$row['username'])
			{
				if($password==$row['password'])
				{
					$_SESSION['id'] = $row['id'];
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}

		}
	}

	public function loginagent($username,$password)
	{
		$query=mysql_query("select * from agent where username='$username' and password='$password'");
		while($row=mysql_fetch_array($query))
		{
			if($username==$row['username'])
			{
				if($password==$row['password'])
				{
					$_SESSION['agent_id'] = $row['id'];
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}

		}
	}

	public function theaterlogin($username,$password)

	{
		$query=mysql_query("select * from theatre_login where username='$username' and password='$password'");
		while($row=mysql_fetch_array($query))
		{
			if($username==$row['username'])
			{
				if($password==$row['password'])
				{
					$_SESSION['theater_id'] = $row['theater_fk'];
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}

		}
	}


	public function menu()
	{
           
       $html='<header>
       <ul>
       <li><a href="location.php" id="location">Location</a></li>
       <li><a href="#" id="movies">Movies Menu<b style="color:#333">></b> </a>
       <ul class="sub-menu">
            <li><a href="movies.php" id="trailers">Movies List</a></li>
            <li><a href="songs.php" id="trailers">Songs</a></li>
            <li><a href="reviews.php" id="trailers">Reviews</a></li>
            <li><a href="trailer.php" id="trailers">Trailer</a></li>
        </ul>
       </li>
       <li><a href="theatre.php" id="theater">Theater</a></li>
       <li><a href="#" id="theater">Agent Menu <b style="color:#333">></b> </a>
       <ul class="sub-menu">
            <li><a href="agent-recharge.php" id="theater">Recharge</a></li>
            <li><a href="agent.php">Agents</a></li>
        </ul>
       </li>
       <li><a href="#" id="theater">Bking Menu <b style="color:#333">></b> </a>
       <ul class="sub-menu">
       <li><a href="assign-show.php" id="slider">Assign Show</a></li>
	   <li><a href="add-booking.php" id="slider">Add Booking</a></li>
	   <li><a href="edittodate.php" id="slider">Edit ToDate</a></li>
       </ul>
       </li>
      
	   
	   <li><a href="booking.php" id="slider">Booking</a> </li>
	   <li style=\'width:140px\'><a href="customer-booking.php" id="slider">Customer Booking</a></li>';
       return $html;
	}

	public function theatermenu()
	{
           
       $html='<header><ul>
       <li><a href="movies.php" id="movies">Home</a></li>
       <li><a href="movies.php" id="movies">Plays</a></li>
	   <li><a href="booking.php" id="slider">Booking Counter</a></li>
	   <li><a href="booking.php" id="slider">Find Ticket</a></li>
	   <li style=\'width:140px\'><a href="customer-booking.php" id="slider">Booking History</a></li>';
       return $html;
	}

	public function agentmenu()
	{
           
       $html='<header><ul>
       <li><a href="agent-check.php" id="slider">Check Ticket</a></li>
	   <li><a href="booking.php" id="slider">Booking</a></li>
	   <li><a href="customer-booking.php" id="slider">Customer Booking</a></li>
	  ';
       return $html;
	}

	public function location()
	{
		$query=mysql_query("SELECT * FROM location ORDER BY id");

		$location= array();
		while($row=mysql_fetch_array($query))
		{
			$testing=array();

            $testing=array('id' => $row['id'],'name'=>$row['location'] );

            array_push($location, $testing);


		}
		return $location;
	}

	public function movies()
	{
		$query=mysql_query("SELECT * FROM movies ORDER BY id desc");

		$movies= array();

		while($row=mysql_fetch_array($query))
		{
			$testing=array();

            $testing=array('id' => $row['id'],'name'=>$row['name'],'image'=>$row['image'],'rating'=>$row['rating'] ,'cast'=>$row['cast']);

            array_push($movies, $testing);


		}
		return $movies;
	}

	public function songs()
	{
		$query=mysql_query("SELECT m.name,s.name as song,s.downloadlink,s.id  FROM songs s left join movies m on m.id=s.fk_movieid ORDER BY s.id desc");

		$songs= array();

		while($row=mysql_fetch_array($query))
		{
			$testing=array();

            $testing=array('id' => $row['id'],'name'=>$row['name'],'song'=>$row['song'] ,'link'=>$row['downloadlink']);

            array_push($songs, $testing);


		}
		return $songs;
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




		public function theatre()
	{
		$query=mysql_query("SELECT * FROM theatres ORDER BY id");

		$movies= array();
		while($row=mysql_fetch_array($query))
		{
			$testing=array();

            $testing=array('id' => $row['id'],'name' => $row['name'],'address'=>$row['address']);

            array_push($movies, $testing);


		}
		return $movies;
	}

		public function agent()
	{
		$query=mysql_query("SELECT a.*,l.location FROM agent a left join location l on l.id=a.fk_location_id ORDER BY a.id");
		$moviess= array();
		if(mysql_num_rows($query)>0)
		{
			while($row=mysql_fetch_array($query))
		{
			$testing=array();

            $testing=array('id' => $row['id'],'name' => $row['username'],'loation'=>$row['location'],'mobile'=>$row['mobile']);

            array_push($moviess, $testing);
		}
		return $moviess;
		}
		return $moviess;
		
	}

	public function trailer()
	{
		$query=mysql_query("SELECT t.*,m.name FROM trailers t LEFT JOIN movies m on m.id=t.movie_id ORDER BY id");

		$movies= array();
		while($row=mysql_fetch_array($query))
		{
			$testing=array();

            $testing=array('name' => $row['name'],'id' => $row['id'],'youtubeid'=>$row['youtube']);

            array_push($movies, $testing);


		}
		return $movies;
	}

	public function getmovies($theater_id)
	{
		$query=mysql_query("SELECT m.id,m.name,a.fk_location_id FROM assign_show a left join movies m on m.id=a.fk_movie_id WHERE a.fk_theater_id='$theater_id' AND a.todate>=CURDATE()");

		$movies= array();
		while($row=mysql_fetch_array($query))
		{
			$testing=array();

            $testing=array('name' => $row['name'],'id' => $row['id'],'location'=>$row['fk_location_id']);

            array_push($movies, $testing);
		}
		return $movies;
	}
}
?>

