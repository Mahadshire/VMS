
$("#signinForm").on("submit", function (e) {

    e.preventDefault();
    let email = $("#email").val();
    let password = $("#password").val();
  
  
    let sendingData = {
      "action": "signin",
      "email": email,
      "password": password
    }
  
    $.ajax({
      method: "POST",
      dataType: "JSON",
      url: "Api/signin.php",
      data: sendingData,
  
      success: function (data) {
        let status = data.status;
        let response = data.data;
  
  
        if (status) {
  
          window.location.href = "Website/dashbourd.php";
  
        } else {
          swal("NOW!", response, "error");
        }
  
      },
      error: function (data) {
  
      }
  
    })
  
  })
  
  
  
  
  
  
  
  