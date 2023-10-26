load_feedback();
// filljobs();
fillvolunteer();
fillprograms();
fillCoordinators();
btnAction = "Insert";

function fillprograms() {

  let sendingData = {
    "action": "read_all_program"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/feedback.php",
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

        $("#program_id2").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}

function fillvolunteer() {

  let sendingData = {
    "action": "read_all_volunteers"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/feedback.php",
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

        $("#volunteers_id2").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}

function fillCoordinators() {

  let sendingData = {
    "action": "read_all_coordinators"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/feedback.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['Coordinators_id']}">${res['fullname']}</option>`;

        })

        $("#Coordinators_id2").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}



$("#feedbackform").on("submit", function (event) {

  event.preventDefault();


  let program_id = $("#program_id2").val();
  let volunteers_id = $("#volunteers_id2").val();
  let Coordinators_id = $("#Coordinators_id2").val();
  let comments = $("#comments").val();
  let feedback_id = $("#update_id").val();

  let sendingData = {}

  if (btnAction == "Insert") {
    sendingData = {
      "program_id": program_id,
      "volunteers_id": volunteers_id,
        "Coordinators_id": Coordinators_id,
        "comments": comments,
      "action": "register_feedback"
    }

  } else {
    sendingData = {
      "feedback_id": feedback_id,
      "program_id": program_id,
      "volunteers_id": volunteers_id,
        "Coordinators_id": Coordinators_id,
        "comments": comments,

      "action": "update_feedback"
    }
  }



  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/feedback.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Good job!", response, "success");
        btnAction = "Insert";
        $("#feedbackform")[0].reset();
        $("feedbackmodal").modal("hide");
        load_feedback();





      } else {
        swal("NOW!", response, "error");
      }

    },
    error: function (data) {
      swal("NOW!", response, "error");

    }

  })

})


function load_feedback() {
  $("#feedbackTable tbody").html('');
  $("#feedbackTable thead").html('');

  let sendingData = {
    "action": "read_all_feedback"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/feedback.php",
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

          tr += `<td> <a class="btn btn-info update_info"  update_id=${res['feedback_id']}><i class="bi bi-pencil-square" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['feedback_id']}><i class="bi bi-trash" style="color: #fff"></i></a> </td>`

          tr += "</tr>"

        })

        $("#feedbackTable thead").append(th);
        $("#feedbackTable tbody").append(tr);
      }



    },
    error: function (data) {

    }

  })
}

function get_feedbackinfo(feedback_id) {

  let sendingData = {
    "action": "get_feedbackinfo",
    "feedback_id": feedback_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/feedback.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        btnAction = "update";

        $("#update_id").val(response['feedback_id']);
        $("#program_id2").val(response['program_id']);
        $("#volunteers_id2").val(response['volunteers_id']);
        $("#Coordinators_id2").val(response['Coordinators_id']);
        $("#comments").val(response['comments']);
    
        $("#feedbackmodal").modal('show');




      } else {
        dispalaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}


function delete_feedback(feedback_id) {

  let sendingData = {
    "action": "delete_feedback",
    "feedback_id": feedback_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/feedback.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        swal("Good job!", response, "success");
        load_feedback();


      } else {
        swal(response);
      }

    },
    error: function (data) {

    }

  })
}

$("#feedbackTable").on('click', "a.update_info", function () {
  let feedback_id = $(this).attr("update_id");
  get_feedbackinfo(feedback_id)
})


$("#feedbackTable").on('click', "a.delete_info", function () {
  let feedback_id = $(this).attr("delete_id");
  if (confirm("Are you sure To Delete")) {
    delete_feedback(feedback_id)

  }

})