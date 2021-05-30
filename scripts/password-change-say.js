function check()
{
    if (document.getElementById('newPassword').value == document.getElementById('confirmPassword').value)
    {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Passwords match';
        document.getElementById('changePassword').disabled = false;
        // document.getElementById('create').style.background = '#2d3436';
    }
    else 
    {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Passwords do not match';
        document.getElementById('changePassword').disabled = true;
    }
}