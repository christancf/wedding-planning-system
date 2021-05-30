function check()
{
    if (document.getElementById('upassword').value == document.getElementById('cupassword').value)
    {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Passwords match';
        document.getElementById('create').disabled = false;
        // document.getElementById('create').style.background = '#2d3436';
    }
    else 
    {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Passwords do not match';
        document.getElementById('create').disabled = true;
    }
}