load_reward();
fillvolunteer();
fillprograms();
btnAction = "Insert";

function fillprograms() {

  let sendingData = {
    "action": "read_all_program"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/volnteers.php",
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
    url: "Api/volunteers.php",
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


$("#rewardform").on("submit", function (event) {

  event.preventDefault();

  let reward_type = $("#reward_type").val();
  let volunteers_id = $("#volunteers_id2").val();
  let program_id = $("#program_id2").val();
  let reward_id = $("#update_id").val();

  let sendingData = {}

  if (btnAction == "Insert") {
    sendingData = {
      "reward_type": reward_type,
      "program_id": program_id,
      "volunteers_id": volunteers_id,
      "action": "register_reward"
    }

  } else {
    sendingData = {
      "reward_id": reward_id,
      "reward_type": reward_type,
      "program_id": program_id,
      "volunteers_id": volunteers_id,

      "action": "update_reward"
    }
  }



  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/reward.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Good job!", response, "success");
        btnAction = "Insert";
        $("#rewardform")[0].reset();
        $("rewardmodal").modal("hide");
        load_reward();





      } else {
        swal("NOW!", response, "error");
      }

    },
    error: function (data) {
      swal("NOW!", response, "error");

    }

  })

})


function load_reward() {
  $("#rewardTable tbody").html('');
  $("#rewardTable thead").html('');

  let sendingData = {
    "action": "read_all_reward"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/reward.php",
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

          tr += `<td> <a class="btn btn-info update_info"  update_id=${res['reward_id']}><i class="bi bi-pencil-square" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['reward_id']}><i class="bi bi-trash" style="color: #fff"></i></a> </td>`

          tr += "</tr>"

        })

        $("#rewardTable thead").append(th);
        $("#rewardTable tbody").append(tr);
      }



    },
    error: function (data) {

    }

  })
}

function get_rewardinfo(reward_id) {

  let sendingData = {
    "action": "get_rewardinfo",
    "reward_id": reward_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/reward.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        btnAction = "update";

        $("#update_id").val(response['reward_id']);
        $("#program_id2").val(response['program_id']);
        $("#volunteers_id2").val(response['volunteers_id']);
        $("#reward_type").val(response['reward_type']);
    
        $("#rewardmodal").modal('show');




      } else {
        dispalaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}


function delete_reward(reward_id) {

  let sendingData = {
    "action": "delete_reward",
    "reward_id": reward_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/reward.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        swal("Good job!", response, "success");
        load_reward();


      } else {
        swal(response);
      }

    },
    error: function (data) {

    }

  })
}

$("#rewardTable").on('click', "a.update_info", function () {
  let reward_id = $(this).attr("update_id");
  get_rewardinfo(reward_id)
})


$("#rewardTable").on('click', "a.delete_info", function () {
  let reward_id = $(this).attr("delete_id");
  if (confirm("Are you sure To Delete")) {
    delete_reward(reward_id)

  }

})