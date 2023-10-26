
btnAction = "Insert";
loadhall();
get_hall();
Delete_hall();

$("#hallform").on("submit", function (event) {

  event.preventDefault();


  let hallname = $("#hallname").val();
  let price = $("#price").val();
  let address = $("#address").val();
  let id = $("#update_id").val();

  let sendingData = {}

  if (btnAction == "Insert") {
    sendingData = {
      "hallname": hallname,
      "price": price,
      "address": address,
      "action": "register_hall"
    }

  } else {
    sendingData = {
      "update_id": id,
      "hallname": hallname,
      "price": price,
      "address": address,
      "action": "update_hall"
    }
  }



  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/hall.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Good job!", response, "success");
        btnAction = "Insert";
        $("#hallform")[0].reset();
        loadhall();



      } else {
        swal("NOW!", response, "error");
      }

    },
    error: function (data) {
      swal("NOW!", response, "error");

    }

  })

})



function loadhall() {
  $("#hallTable tbody").html('');
  $("#hallTable thead").html('');

  let sendingData = {
    "action": "read_all_hall"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/hall.php",
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

          tr += `<td> <a class="btn btn-info update_info"  update_id=${res['hall_id']}><i class="bi bi-pencil-square" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['hall_id']}><i class="bi bi-trash" style="color: #fff"></i></a> </td>`
          tr += "</tr>"

        })
        $("#hallTable thead").append(th);
        $("#hallTable tbody").append(tr);
      }



    },
    error: function (data) {

    }

  })
}


function get_hall(hall_id) {

  let sendingData = {
    "action": "get_hall",
    "hall_id": hall_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/hall.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        btnAction = "update";

        $("#update_id").val(response['hall_id']);
        $("#hallname").val(response['hall_name']);
        $("#price").val(response['price']);
        $("#address").val(response['address']);
  
        $("#hallmodal").modal("show");



      } else {
        resultmessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}


function Delete_hall(hall_id) {

  let sendingData = {
    "action": "Delete_hall",
    "hall_id": hall_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/hall.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        swal("Good job!", response, "success");
        loadhall();


      } else {
        swal(response);
      }

    },
    error: function (data) {

    }

  })
}



$("#hallTable").on('click', "a.update_info", function () {
  let id = $(this).attr("update_id");
  get_hall(id)
})


$("#hallTable").on('click', "a.delete_info", function () {
  let id = $(this).attr("delete_id");
  if (confirm("Are you sure To Delete")) {
    Delete_hall(id)

  }

})