
$("#forgetForm").on("submit", function (e) {

    e.preventDefault();
    let yourusername = $("#yourusername").val();
    let yourPassword = $("#yourPassword").val();
  
  
    let sendingData = {
      "action": "forget",
      "yourusername": yourusername,
      "yourPassword": yourPassword
    }
  
    $.ajax({
      method: "POST",
      dataType: "JSON",
      url: "Api/forget.php",
      data: sendingData,
  
      success: function (data) {
        let status = data.status;
        let response = data.data;
  
  
        if (status) {
            swal("Good job!", response, "success");
            btnAction = "Insert";
            $("#forgetForm")[0].reset();
            window.location.href = "login.php";
  
  
        //  window.location.href = "index.php";
  
        } else {
          swal("NOW!", response, "error");
        }
  
      },
      error: function (data) {
  
      }
  
    })
  
  })
  
  
  
  
  
  
  
  