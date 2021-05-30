function check()
{
    if (document.getElementById('newPassword').value == document.getElementById('confirmPassword').value)
    {
        document.getElementById('message').style.color = 'white';
        document.getElementById('message').innerHTML = 'Passwords match';
        document.getElementById('changePassword').disabled = false;
        // document.getElementById('create').style.background = '#2d3436';
    }
    else 
    {
        document.getElementById('message').style.color = 'black';
        document.getElementById('message').innerHTML = 'Passwords do not match';
        document.getElementById('changePassword').disabled = true;
    }
}
function enableButton(){
    if(document.getElementById("deleteBox").checked)
    {
        document.getElementById("deleteAcc").disabled = false;
    }
    else
    {
        document.getElementById("deleteAcc").disabled = true;
    }
}
