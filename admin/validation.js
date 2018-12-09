function validate_movie_select()
{
	loc1 = document.getElementById('loc1').value;
	mv1 = document.getElementById('mv1').value;
	th1 = document.getElementById('th1').value;
	if(loc1 == '')
	{
		alert('Please select location');
		return false;
	}
	if(mv1 == '')
	{
		alert('Please select movie');
		return false;
	}
	if(th1 == '')
	{
		alert('Please select theater');
		return false;
	}
}