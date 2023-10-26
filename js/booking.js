load_booking();
fillcustomer();
fillhall();
fillwedding();
btnAction = "Insert";

function fillcustomer() {

  let sendingData = {
    "action": "read_all_customers"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/booking.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['customer_id']}">${res['fristname']}</option>`;

        })

        $("#customers_id").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}

function fillhall() {

  let sendingData = {
    "action": "read_all_hall"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/booking.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['hall_id']}">${res['hall_name']}</option>`;

        })

        $("#hall_id").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}

function fillwedding() {

  let sendingData = {
    "action": "read_all_wedding"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/booking.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['w_id']}">${res['Wedding_names']}</option>`;

        })

        $("#wedding_id").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}



$("#bookingform").on("submit", function (event) {

  event.preventDefault();


  let customers_id = $("#customers_id").val();
  let hall_id = $("#hall_id").val();
  let wedding_id = $("#wedding_id").val();
  let start_time = $("#start_time").val();
  let End_time = $("#End_time").val();
  let Total_Guests = $("#Total_Guests").val();
  let Total_price = $("#Total_price").val();
  let id = $("#update_id").val();

  let sendingData = {}

  if (btnAction == "Insert") {
    sendingData = {
      "customers_id": customers_id,
      "hall_id": hall_id,
      "wedding_id": wedding_id,
      "start_time": start_time,
      "End_time": End_time,
      "Total_Guests": Total_Guests,
      "Total_price": Total_price,
      "action": "register_booking"
    }

  } else {
    sendingData = {
      "b_id": id,
      "customers_id": customers_id,
      "hall_id": hall_id,
      "wedding_id": wedding_id,
      "start_time": start_time,
      "End_time": End_time,
      "Total_Guests": Total_Guests,
      "Total_price": Total_price,
      "action": "update_booking"
    }
  }



  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/booking.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Good job!", response, "success");
        btnAction = "Insert";
        $("#bookingform")[0].reset();
        $("bookingmodal").modal("hide");
        load_booking();





      } else {
        swal("NOW!", response, "error");
      }

    },
    error: function (data) {
      swal("NOW!", response, "error");

    }

  })

})


function load_booking() {
  $("#bookingTable tbody").html('');
  $("#bookingTable thead").html('');

  let sendingData = {
    "action": "read_all_booking"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/booking.php",
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

          tr += `<td> <a class="btn btn-info update_info"  update_id=${res['b_id']}><i class="bi bi-pencil-square" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['b_id']}><i class="bi bi-trash" style="color: #fff"></i></a> </td>`

          tr += "</tr>"

        })

        $("#bookingTable thead").append(th);
        $("#bookingTable tbody").append(tr);
      }



    },
    error: function (data) {

    }

  })
}

function get_booking(b_id) {

  let sendingData = {
    "action": "get_booking",
    "b_id": b_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/booking.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        btnAction = "update";

        $("#update_id").val(response['b_id']);
        $("#customers_id").val(response['customer_id']);
        $("#hall_id").val(response['hall_id']);
        $("#wedding_id").val(response['w_id']);
        $("#start_time").val(response['start_time']);
        $("#End_time").val(response['End_time']);
        $("#Total_Guests").val(response['Total_Guests']);
        $("#Total_price").val(response['Total_price']);
        $("#bookingmodal").modal('show');




      } else {
        dispalaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}






function Delete_booking(b_id) {

  let sendingData = {
    "action": "Delete_booking",
    "b_id": b_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/booking.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        swal("Good job!", response, "success");
        load_booking();


      } else {
        swal(response);
      }

    },
    error: function (data) {

    }

  })
}

$("#bookingTable").on('click', "a.update_info", function () {
  let id = $(this).attr("update_id");
  get_booking(id)
})


$("#bookingTable").on('click', "a.delete_info", function () {
  let id = $(this).attr("delete_id");
  if (confirm("Are you sure To Delete")) {
    Delete_booking(id)

  }

})