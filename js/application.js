loadapplications();
fillebranch();
btnAction = "Insert";


function fillebranch() {

  let sendingData = {
    "action": "read_all_branch"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/volunteers.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['branch_id']}">${res['branch_name']}</option>`;

        })

        $("#branch_id").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}


function showImage(){
  
let fileimage = document.querySelector("#image");
let showInput = document.querySelector("#show");

const reader = new FileReader();

fileimage.addEventListener("change", (e) => {
  const selectedFile = e.target.files[0];
  reader.readAsDataURL(selectedFile);
})

reader.onload = e => {
  showInput.src = e.target.result;
}

}




$("#applicatinForm").on("submit", function (event) {

  event.preventDefault();


  // let amount= $("#amount").val();
  // let type= $("#type").val();
  // let description= $("#description").val();
  // let id= $("#update_id").val();

  let form_data = new FormData($("#applicatinForm")[0]);
  form_data.append("image", $("input[type=file]")[0].files[0]);

  if (btnAction == "Insert") {

    form_data.append("action", "register_valunteers");
    $("#applicationTable tr").html('');



  } else {
    form_data.append("action", "update_application");

  }



  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/application.php",
    data: form_data,
    processData: false,
    contentType: false,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Good job!", response, "success");
        btnAction = "Insert";
        loadapplications();
        $("#applicatinForm")[0].reset();
        $("#volunteermodal").modal("hide");



      } else {
        swal("Good job!", "success", response);

      }

    },
    error: function (data) {

    }

  })

})



function loadapplications() {
  $("#applicationTable tr").html('');

  let sendingData = {
    "action": "get_application_list"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/application.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';
      let th = '';

      if (status) {
        response.forEach(res => {

          th = "<tr>";
          for (let i in res) {
            th += `<th>${i}</th>`;
          }

          th += "<th>Action</th></tr>";

          tr += "<tr>";
          for (let r in res) {

            if (r == "image") {

              tr += `<td><img style="width:50px; height:50px; border: 1px solid #e3ebe7;
                     border-radius:50%; object-fit:cover;" src="aploads/${res[r]}"></td>`;

            } else if(r== "status"){
                tr += `<td><span class="badge bg-warning text-dark">${res[r]}</span></td>`;
            }
            else {
              tr += `<td>${res[r]}</td>`;
            }

          }

          tr += `<td> <a class="btn btn-info m-1 update_info"  update_id=${res['volunteers_id']}>apprv</a><a class="btn btn-danger delete_info" delete_id=${res['volunteers_id']}>reject</a></td>`
          tr += "</tr>"

        })

        $("#applicationTable thead").append(th);
        $("#applicationTable tbody").append(tr);
      }

    },
    error: function (data) {

    }

  })
}


function fetchapplicationinfo(volunteers_id) {

  let sendingData = {
    "action": "get_application_info",
    "volunteers_id": volunteers_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/application.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        btnAction = "update";
        let statas = $("#statas");
        statas.removeClass("d-none");
        $("#update_id").val(response['volunteers_id']);
        $("#fullname").val(response['fullname']);
        $("#email").val(response['email'])
        $("#password").val(response['password'])
        $("#sex").val(response['sex']);
        $("#phone").val(response['phone']);
        $("#age").val(response['age']);
        $("#education").val(response['education']);
        $("#branch_id").val(response['branch_id']);
        $("#method").val(response['method']);
        $("#status").val(response['status']);
        $("#show").attr('src', `aploads/${response['image']}`);
        $("#volunteermodal").modal("show");
        $("#show").attr('src', `aploads/${response['image']}`);

      } else {
        displaymessagee("error", response);
      }

    },
    error: function (data) {

    }

  })
}


function Delete_volunteers_info(volunteers_id) {

  let sendingData = {
    "action": "Delete_application_info",
    "volunteers_id": volunteers_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/application.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        swal("Good job!", response, "success");
        loadapplications();


      } else {
        swal(response);
      }

    },
    error: function (data) {

    }

  })
}


$("#applicationTable").on('click', "a.update_info", function () {
  let id = $(this).attr("update_id");
  fetchapplicationinfo(id)
})

$("#applicationTable").on('click', "a.delete_info", function () {
  let id = $(this).attr("delete_id");
  if (confirm("Are you sure To Reject")) {
    Delete_volunteers_info(id)

  }

})