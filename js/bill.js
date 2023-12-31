// load_bill2();
fillemployee();
// fillebills();
filleuser();
fillaccount();
fill_lacago();
load_bill();
btnAction = "Insert";


function fillemployee() {

  let sendingData = {
    "action": "read_all_employee"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/bill.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['emp_id']}">${res['emp_first_name']}</option>`;

        })

        $("#employees_id").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}

function filleuser() {

  let sendingData = {
    "action": "read_all_user"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/bill.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['id']}">${res['username']}</option>`;

        })

        $("#user_id").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}

// function fillebills() {

//   let sendingData = {
//     "action": "read_all_bill"
//   }

//   $.ajax({
//     method: "POST",
//     dataType: "JSON",
//     url: "Api/bill.php",
//     data: sendingData,

//     success: function (data) {
//       let status = data.status;
//       let response = data.data;
//       let html = '';
//       let tr = '';

//       if (status) {
//         response.forEach(res => {
//           html += `<option value="${res['bill_id']}">${res['bill_name']}</option>`;

//         })

//         $("#bill_id").append(html);


//       } else {
//         displaymessage("error", response);
//       }

//     },
//     error: function (data) {

//     }

//   })
// }

function fillaccount() {

  let sendingData = {
    "action": "read_all_account"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/bill.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['account_id']}">${res['bank_name']}</option>`;

        })

        $("#account_id").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}

function fillmonth() {

  let sendingData = {
    "action": "read_all_month"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/bill.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['month_id']}">${res['month_name']}</option>`;

        })

        $("#month").append(html);


      } else {
        displaymessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}

function get_bill_info(bill_id) {

  let sendingData = {
    "action": "get_bill_info",
    "bill_id": bill_id 
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/bill.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        btnAction = "update";

        $("#update_id").val(response['bill_id ']);
        $("#emp_id").val(response['emp_id']);
        $("#month").val(response['month']);
        $("#amount").val(response['amount']);
        $("#user_id").val(response['user_id']);
        $("#account_id").val(response['account_id']);
        $("#bill_modal").modal('show');




      } else {
        displaymssage("error", response);
      }

    },
    error: function (data) {

    }

  })
}

$("#billform").on("submit", function (event) {

  event.preventDefault();


  let employees_id = $("#employees_id").val();
  let month = $("#month").val();
  let amount = $("#amount").val();
  let user_id = $("#user_id").val();
  let account_id = $("#account_id").val();
  let date = $("#date").val();
  let id = $("#update_id").val();

  let sendingData = {}

  if (btnAction == "Insert") {
    sendingData = {
      "employees_id": employees_id,
      "month": month,
      "amount": amount,
      "user_id": user_id,
      "account_id": account_id,
      "date": date,
      "action": "register_bill"
    }

  } else {
    sendingData = {
      "bill_id": id,
      "emp_id": emp_id,
      "month": month,
      "amount": amount,
      "user_id": user_id,
      "account_id": account_id,
      "date": date,
      "action": "update_bill"
    }
  }



  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/bill.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Good job!", response, "success");
        btnAction = "Insert";
        $("#billform")[0].reset();
        load_bill();





      } else {
        swal("NOW!", response, "error");
      }

    },
    error: function (data) {
      swal("NOW!", response, "error");

    }

  })

})






function load_bill() {
  $("#billTable tbody").html('');
  $("#billTable thead").html('');

  let sendingData = {
    "action": "read_all_bill"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/bill.php",
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

            if (r == "status") {
              if (res[r] == "Top") {
                tr += `<td><span class="badge bg-success">${res[r]}</span></td>`;
              } else {
                tr += `<td><span class="badge bg-danger">${res[r]}</span></td>`;
              }
            } else {
              tr += `<td>${res[r]}</td>`;
            }

          }
          th += "<td>Action</td></tr>";

          tr += `<td> <a class="btn btn-info update_info"  update_id=${res['bill_id']}><i class="bi bi-pencil-square" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id =${res['bill_id']}><i class="bi bi-trash" style="color: #fff"></i></a> </td>`
          tr += "</tr>"

        })

        $("#billTable thead").append(th);
        $("#billTable tbody").append(tr);
      }



    },
    error: function (data) {

    }

  })
}


// function load_bill2() {
//   $("#topbills tbody").html('');
//   $("#topbills thead").html('');

//   let sendingData = {
//     "action": "read_top_bill"
//   }

//   $.ajax({
//     method: "POST",
//     dataType: "JSON",
//     url: "Api/bill.php",
//     data: sendingData,

//     success: function (data) {
//       let status = data.status;
//       let response = data.data;
//       let html = '';
//       let tr = '';
//       let th = '';


//       if (status) {
//         response.forEach(res => {
//           tr += "<tr>";
//           th = "<tr>";
//           for (let r in res) {
//             th += `<th>${r}</th>`;

//             if (r == "status") {
//               if (res[r] == "Top") {
//                 tr += `<td><span class="badge bg-success">${res[r]}</span></td>`;
//               } else {
//                 tr += `<td><span class="badge badge-danger">${res[r]}</span></td>`;
//               }
//             } else {
//               tr += `<td>${res[r]}</td>`;
//             }

//           }

//           tr += "</tr>"

//         })

//         $("#topbills thead").append(th);
//         $("#topbills tbody").append(tr);
//       }



//     },
//     error: function (data) {

//     }

//   })
// }


function Delete_bill(bill_id) {

  let sendingData = {
    "action": "Delete_bill",
    "bill_id": bill_id 
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/bill.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        swal("Good job!", response, "success");
        load_bill();


      } else {
        swal(response);
      }

    },
    error: function (data) {

    }

  })
}



$("#billform").on("change", "select.employees_id", function(){

  let employees_id=$(this).val();


  fill_lacago(employees_id);
})

 function fill_lacago(employees_id){

  let sendingData={
    "action": "fill_lacag",
    "employees_id": employees_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/payment.php",
    data: sendingData,

    success: function(data){
      let status=data.status;
      let response=data.data;

      if(status){
        response.forEach(res =>{
          $("#amount").val(res['Total_amount']);

        })

      }else{
        swal("Now", response,"error");
      }

      
    }

     
  })
}
   
  




$("#billTable").on('click', "a.update_info", function () {
  let id = $(this).attr("update_id");
  get_bill_info(id)
})

$("#billTable").on('click', "a.delete_info", function () {
  let id = $(this).attr("delete_id");
  if (confirm("Are you sure To Delete")) {
    Delete_bill(id)

  }

})
