load_Coordinators();
// filljobs();
fillemploye();
fillebranch();
btnAction = "Insert";

function fillebranch() {

  let sendingData = {
    "action": "read_all_branch"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/Coordinators.php",
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
        displaymessemail("error", response);
      }

    },
    error: function (data) {

    }

  })
}

function fillemploye() {

  let sendingData = {
    "action": "read_all_employe_name"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/user.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['Coordinators_id']}">${res['employe_name']}</option>`;

        })

        $("#Coordinators_id").append(html);


      } else {
        displaymessemail("error", response);
      }

    },
    error: function (data) {

    }

  })
}


function filljobs() {

  let sendingData = {
    "action": "read_all_jop_title"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/Coordinators.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['title_id']}">${res['position']}</option>`;

        })

        $("#title_id").append(html);


      } else {
        displaymessemail("error", response);
      }

    },
    error: function (data) {

    }

  })
}



$("#Coordinatorsform").on("submit", function (event) {

  event.preventDefault();


  let fullname = $("#fullname").val();
  let sex = $("#sex").val();
  let tell = $("#tell").val();
  let email = $("#email").val();

  let Coordinators_id = $("#update_id").val();

  let sendingData = {}

  if (btnAction == "Insert") {
    sendingData = {
      "fullname": fullname,
      "sex": sex,
      "tell": tell,
      "email": email,

      "action": "register_Coordinators"
    }

  } else {
    sendingData = {
      "Coordinators_id": Coordinators_id,
      "fullname": fullname,
      "sex": sex,
      "tell": tell,
      "email": email,

      "action": "update_Coordinators"
    }
  }



  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/Coordinators.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Good job!", response, "success");
        btnAction = "Insert";
        $("#Coordinatorsform")[0].reset();
        $("Coordinatorsmodal").modal("hide");
        load_Coordinators();





      } else {
        swal("NOW!", response, "error");
      }

    },
    error: function (data) {
      swal("NOW!", response, "error");

    }

  })

})


function load_Coordinators() {
  $("#CoordinatorsTable tbody").html('');
  $("#CoordinatorsTable thead").html('');

  let sendingData = {
    "action": "read_all_Coordinators"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/Coordinators.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';
      let th = '';


      if (status) {
        response.forEach(res => {
          tr += "<tr>";
          th = "<tr>";
          for (let r in res) {
            th += `<th>${r}</th>`;

           
            tr += `<td>${res[r]}</td>`;

          }
          th += "<td>Action</td></tr>";

          tr += `<td> <a class="btn btn-info update_info"  update_id=${res['Coordinators_id']}><i class="bi bi-pencil-square" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['Coordinators_id']}><i class="bi bi-trash" style="color: #fff"></i></a> </td>`

          tr += "</tr>"

        })

        $("#CoordinatorsTable thead").append(th);
        $("#CoordinatorsTable tbody").append(tr);
      }



    },
    error: function (data) {

    }

  })
}

function get_Coordinators_info(Coordinators_id) {

  let sendingData = {
    "action": "get_Coordinators_info",
    "Coordinators_id": Coordinators_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/Coordinators.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        btnAction = "update";

        $("#update_id").val(response['Coordinators_id']);
        $("#fullname").val(response['fullname']);
        $("#sex").val(response['sex']);
        $("#tell").val(response['tell']);
        $("#email").val(response['email']);
     
        $("#Coordinatorsmodal").modal('show');




      } else {
        dispalaymessemail("error", response);
      }

    },
    error: function (data) {

    }

  })
}






function Delete_Coordinators(Coordinators_id) {

  let sendingData = {
    "action": "Delete_Coordinators",
    "Coordinators_id": Coordinators_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/Coordinators.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        swal("Good job!", response, "success");
        load_Coordinators();


      } else {
        swal(response);
      }

    },
    error: function (data) {

    }

  })
}

$("#CoordinatorsTable").on('click', "a.update_info", function () {
  let Coordinators_id = $(this).attr("update_id");
  get_Coordinators_info(Coordinators_id)
})


$("#CoordinatorsTable").on('click', "a.delete_info", function () {
  let Coordinators_id = $(this).attr("delete_id");
  if (confirm("Are you sure To Delete")) {
    Delete_Coordinators(Coordinators_id)

  }

})