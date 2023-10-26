btnAction = "Insert";
get_program_info();
loadcustomer();
loadcustomertop();
Delete_program();


$("#programform").on("submit", function (event) {

  event.preventDefault();


  // let program_id = $("#program_id").val();
  let name = $("#name").val();
  let ptype = $("#ptype").val();
  let description = $("#description").val();
  let durations = $("#durations").val();
  let from_date = $("#from_date").val();
  let to_date = $("#to_date").val();
  let program_id = $("#update_id").val();

  let sendingData = {}

  if (btnAction == "Insert") {
    sendingData = {
      "program_id": program_id,
      "name": name,
      "ptype": ptype,
      "description": description,
      "durations": durations,
      "from_date": from_date,
      "to_date": to_date,
      "action": "register_program"
    }

  } else {
    sendingData = {
      "program_id": program_id,
      "name": name,
      "ptype": ptype,
      "description": description,
      "durations": durations,
      "from_date": from_date,
      "to_date": to_date,
      "action": "update_program"
    }
  }



  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/programs.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Good job!", response, "success");
        btnAction = "Insert";
        $("#programform")[0].reset();
        loadcustomer();


      } else {
        employemessage("error", response);
      }

    },
    error: function (data) {
      employemessage("error", data.responseText);

    }

  })

})


function loadcustomer() {
  $("#programTable tbody").html('');
  $("#programTable thead").html('');

  let sendingData = {
    "action": "read_all_program"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/programs.php",
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
          for (let r in res) {
            th += `<th>${r}</th>`;
          }

          th += "<td>Action</td></tr>";




          tr += "<tr>";
          for (let r in res) {


            tr += `<td>${res[r]}</td>`;


          }

          tr += `<td> <a class="btn btn-info update_info"  update_id=${res['program_id']}><i class="bi bi-pencil-square" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['program_id']}><i class="bi bi-trash" style="color: #fff"></i></a> </td>`
          tr += "</tr>"

        })
        $("#programTable thead").append(th);
        $("#programTable tbody").append(tr);
      }

    },
    error: function (data) {

    }

  })
}

function loadcustomertop() {
  $("#custtop tbody").html('');
  $("#custtop thead").html('');

  let sendingData = {
    "action": "read_all_customers"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/customer.php",
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
          for (let r in res) {
            th += `<th>${r}</th>`;
          }

       ///   th += "<td>Action</td></tr>";




          tr += "<tr>";
          for (let r in res) {


            tr += `<td>${res[r]}</td>`;


          }

          // tr += `<td> <a class="btn btn-info update_info"  update_id=${res['program_id']}><i class="bi bi-pencil-square" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['program_id']}><i class="bi bi-trash" style="color: #fff"></i></a> </td>`
          // tr += "</tr>"

        })
        $("#custtop thead").append(th);
        $("#custtop tbody").append(tr);
      }

    },
    error: function (data) {

    }

  })
}


function get_program_info(program_id) {

  let sendingData = {
    "action": "get_program_info",
    "program_id": program_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/programs.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        btnAction = "update";

        $("#update_id").val(response['program_id']);
        $("#name").val(response['name']);
        $("#ptype").val(response['ptype']);
        $("#description").val(response['description']);
        $("#durations").val(response['durations']);
        $("#from_date").val(response['from_date']);
        
        $("#programmodal").modal('show');




      } else {
        customermessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}


function Delete_program(program_id) {

  let sendingData = {
    "action": "Delete_program",
    "program_id": program_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/programs.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        swal("Good job!", response, "success");
        loadcustomer();


      } else {
        swal(response);
      }

    },
    error: function (data) {

    }

  })
}



$("#programTable").on('click', "a.update_info", function () {
  let program_id = $(this).attr("update_id");
  get_program_info(program_id)
})


$("#programTable").on('click', "a.delete_info", function () {
  let program_id = $(this).attr("delete_id");
  if (confirm("Are you sure To Delete")) {
    Delete_program(program_id)

  }

})


