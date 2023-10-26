btnAction = "Insert";
get_wedding_info();
loadwedding();
Delete_wedding();


// function fillrating() {

//   let sendingData = {
//     "action": "read_all_rating"
//   }

//   $.ajax({
//     method: "POST",
//     dataType: "JSON",
//     url: "Api/wedding.php",
//     data: sendingData,

//     success: function (data) {
//       let status = data.status;
//       let response = data.data;
//       let html = '';
//       let tr = '';

//       if (status) {
//         response.forEach(res => {
//           html += `<option value="${res['rating_id']}">${res['rating_name']}</option>`;

//         })

//         $("#rating_id").append(html);


//       } else {
//         displaymessage("error", response);
//       }

//     },
//     error: function (data) {

//     }

//   })
// }

$("#weddingform").on("submit", function (event) {

  event.preventDefault();


  let w_id = $("#w_id").val();
  let male_name = $("#male_name").val();
  let female_name = $("#female_name").val();
  
  let id = $("#update_id").val();

  let sendingData = {}

  if (btnAction == "Insert") {
    sendingData = {
      "w_id": w_id,
      "male_name": male_name,
      "female_name": female_name,
      
      "action": "register_wedding"
    }

  } else {
    sendingData = {
      "w_id": w_id,
      "male_name": male_name,
      "female_name": female_name,
      
      "action": "update_wedding"
    }
  }



  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/wedding.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Good job!", response, "success");
        btnAction = "Insert";
        $("#weddingform")[0].reset();
        loadwedding();


      } else {
        employemessage("error", response);
      }

    },
    error: function (data) {
      employemessage("error", data.responseText);

    }

  })

})


// function loadwedding() {
//   $("#weddingTable tbody").html('');
//   $("#weddingTable thead").html('');

//   let sendingData = {
//     "action": "read_all_wedding"
//   }

//   $.ajax({
//     method: "POST",
//     dataType: "JSON",
//     url: "Api/wedding.php",
//     data: sendingData,

//     success: function (data) {
//       let status = data.status;
//       let response = data.data;
//       let html = '';
//       let tr = '';
//       let th = '';

//       if (status) {
//         response.forEach(res=>{
//           tr += "<tr>";
//           th = "<tr>";
//           for(let r in res){
//             th += `<th>${r}</th>`;

//          if(r == "rating_name"){
//           if(res[r] == "Excellent"){
//             tr += `<td><span class="badge bg-success text-white">${res[r]}</span></td>`;
//           }else if (res[r] == "Good"){
//             tr += `<td><span class="badge bg-primary text-white">${res[r]}</span></td>`;
//           }

//           else if (res[r] == "Fair"){
//             tr += `<td><span class="badge bg-warning text-white">${res[r]}</span></td>`;
//           }
//           else if (res[r] == "Very Poor"){
//             tr += `<td><span class="badge bg-danger text-white">${res[r]}</span></td>`;
//           }

//           else{
//             tr += `<td><span class="badge bg-dark text-white">${res[r]}</span></td>`;
//           }



          
//          }else{
//           tr += `<td>${res[r]}</td>`;
//          }

//           }

 
        
//       })
//         $("#weddingTable thead").append(th);
//         $("#weddingTable tbody").append(tr);
//       }

//     },
//     error: function (data) {

//     }

//   })
// }

function loadwedding() {
  $("#weddingTable tbody").html('');
  $("#weddingTable thead").html('');

  let sendingData = {
    "action": "read_all_wedding"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/wedding.php",
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

          tr += `<td> <a class="btn btn-info update_info"  update_id=${res['w_id']}><i class="bi bi-pencil-square" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['w_id']}><i class="bi bi-trash" style="color: #fff"></i></a> </td>`
          tr += "</tr>"

        })
        $("#weddingTable thead").append(th);
        $("#weddingTable tbody").append(tr);
      }

    },
    error: function (data) {

    }

  })
}


function get_wedding_info(id) {

  let sendingData = {
    "action": "get_wedding",
    "w_id": id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/wedding.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        btnAction = "update";

        $("#update_id").val(response['w_id']);
        $("#male_name").val(response['male_name']);
        $("#weddingmodal").modal('show');




      } else {
        weddingmessage("error", response);
      }

    },
    error: function (data) {

    }

  })
}


function Delete_wedding(w_id) {

  let sendingData = {
    "action": "Delete_wedding",
    "w_id": w_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/wedding.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;


      if (status) {

        swal("Good job!", response, "success");
        loadwedding();


      } else {
        swal(response);
      }

    },
    error: function (data) {

    }

  })
}



$("#weddingTable").on('click', "a.update_info", function () {
  let id = $(this).attr("update_id");
  get_wedding_info(id);
})


$("#weddingTable").on('click', "a.delete_info", function () {
  let id = $(this).attr("delete_id");
  if (confirm("Are you sure To Delete")) {
    Delete_wedding(id)

  }

})