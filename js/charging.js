loadpayment();
fill_amount();
fill_customers();
fill_payment_method();
btnAction = "Insert";


function fill_customers() {

  let sendingData = {
    "action": "read_all_customer_name"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/charging.php",
    data: sendingData,

    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = '';
      let tr = '';

      if (status) {
        response.forEach(res => {
          html += `<option value="${res['customer_id']}">${res['customer_name']}</option>`;
        //  console.log(`${res['customer_id']}`);

        })

        $("#Customers").append(html);


      } else {
        // displaymssage("error", response);
      }

    },
    error: function (data) {

    }

  })
}


$("#chargingform").on("submit", function (event) {

  event.preventDefault();


  let customer_id = $("#Customers").val();
  let amount = $("#amount").val();
  let description = $("#description").val();
  let user_id = $("#user_id").val();
  let id = $("#update_id").val();

  let sendingData = {}

  if (btnAction == "Insert") {
    sendingData = {
      "customer_id": customer_id,
      "amount": amount,
      "description": description,
      "user_id": user_id,
      "action": "register_charging"
    }

  } else {
    sendingData = {
      "payment_id": id,
      "customer_id": customer_id,
      "amount": amount,
      "description": description,
      "user_id": user_id,
      "action": "update_payment"
    }
  }



  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/charging.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Good job!", response, "success");
        btnAction = "Insert";
        $("#chargingform")[0].reset();
        loadpayment();

      } else {
        swal("Good job!", response, "error");
      }

    },
    error: function (data) {
      // displaymessage("error", data.responseText);

    }

  })

})

function loadpayment() {
  $("#chargeTable tbody").html('');
  $("#chargeTable thead").html('');

  let sendingData = {
    "action": "read_all_payment"
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/charging.php",
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





          tr += "<tr>";
          for (let r in res) {


            tr += `<td>${res[r]}</td>`;


          }

          tr += "</tr>"

        })
        $("#chargeTable thead").append(th);
        $("#chargeTable tbody").append(tr);
      }

    },
    error: function (data) {

    }

  })
}

// $("#customer_id").on("change", function(){
//  if($("#customer_id").val()== 0){
//   $("#amount").val("");
//  }else{
//   console.log("kkkkk");
//  }
//   console.log(customers);

//   fill_amount(customers);
// })


$("#chargingform").on("change", "select.customers", function(){

  let customers=$(this).val();

  fill_amount(customers);
})

 function fill_amount(customer_id){

  let sendingData={
    "action": "fill_amount",
    "customer_id": customer_id
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/charging.php",
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
   
  