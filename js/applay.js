load_applay();
// filljobs();
fillvolunteers();
fillprogram();
btnAction = "Insert";

function fillprogram() {

  let sendingData = {
    "action": "read_all_programs"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/applay.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['program_id']}">${res['name']}</option>`;

        })

        $("#program_id").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}

function fillvolunteers() {

  let sendingData = {
    "action": "read_all_volunteers"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/applay.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['volunteers_id']}">${res['fullname']}</option>`;

        })

        $("#volunteers_id").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}



$("#applayform").on("submit", function (event) {

  event.preventDefault();


  let program_id = $("#program_id").val();
  let volunteers_id = $("#volunteers_id").val();
  let applay_id = $("#update_id").val();

  let sendingData = {}

  if (btnAction == "Insert") {
    sendingData = {
      "program_id": program_id,
      "volunteers_id": volunteers_id,
  
      "action": "register_applay"
    }

  } else {
    sendingData = {
      "applay_id": applay_id,
      "program_id": program_id,
      "volunteers_id": volunteers_id,

      "action": "update_applay"
    }
  }



  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/applay.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Good job!", response, "success");
        btnAction = "Insert";
        $("#applayform")[0].reset();
        $("applaymodal").modal("hide");
        load_applay();





      } else {
        swal("NOW!", response, "error");
      }

    },
    error: function (data) {
      swal("NOW!", response, "error");

    }

  })

})


function load_applay() {
  $("#applayTable tbody").html('');
  $("#applayTable thead").html('');

  let sendingData = {
    "action": "read_all_applay"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/applay.php",
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

          tr += `<td> <a class="btn btn-info update_info"  update_id=${res['applay_id']}><i class="bi bi-pencil-square" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['applay_id']}><i class="bi bi-trash" style="color: #fff"></i></a> </td>`

          tr += "</tr>"

        })

        $("#applayTable thead").append(th);
        $("#applayTable tbody").append(tr);
      }



    },
    error: function (data) {

    }

  })
}

function get_applayinfo(applay_id) {

  let sendingData = {
    "action": "get_applayinfo",
    "applay_id": applay_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/applay.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        btnAction = "update";

        $("#update_id").val(response['applay_id']);
        $("#program_id").val(response['program_id']);
        $("#volunteers_id").val(response['volunteers_id']);
    
        $("#applaymodal").modal('show');




      } else {
        dispalaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}


function delete_applay(applay_id) {

  let sendingData = {
    "action": "delete_applay",
    "applay_id": applay_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/applay.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        swal("Good job!", response, "success");
        load_applay();


      } else {
        swal(response);
      }

    },
    error: function (data) {

    }

  })
}

$("#applayTable").on('click', "a.update_info", function () {
  let applay_id = $(this).attr("update_id");
  get_applayinfo(applay_id)
})


$("#applayTable").on('click', "a.delete_info", function () {
  let applay_id = $(this).attr("delete_id");
  if (confirm("Are you sure To Delete")) {
    delete_applay(applay_id)

  }

})