$("#alert").hide();
function validar(){
    const userName = document.getElementById("userName");

    if (!userName.checkValidity()) {
      console.log('No');
      $("#alert").show(true);
    } else {
      console.log('hola');
      window.location.assign("users.html");
    }  
}

