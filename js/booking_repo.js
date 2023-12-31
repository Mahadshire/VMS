$("#hall_name").attr("disabled", true);

$("#type").on("change", function () {
  if ($("#type").val() == 0) {
    $("#hall_name").attr("disabled", true);

  } else {
    $("#hall_name").attr("disabled", false);
  }
})


$("#printt_report").on("click", function () {
  let printarea = document.querySelector("#printt_Area");


  let newwindow = window.open("");
  newwindow.document.write(`<html><head><title></title>`);
  newwindow.document.write(`<style media="print">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');
    body{
        font-family: 'Poppins', sans-serif;
    }

    table{
      width:100%;
  }

    th{
        background-color : #40E0D0 !important;
        color: white !important;
       
    }
      
    th , td{
        padding:10px !important;
        text-align: left !important;

    }

    th , td{
        
        border-bottom : 1px solid #ddd !important;
    }
    
    
    </style>`);
  newwindow.document.write(`</head><body>`);
  newwindow.document.write(printarea.innerHTML);
  newwindow.document.write(`</body></html>`);
  newwindow.print();
  newwindow.close();


})



$("#exportt_statement").on("click", function () {
  let file = new Blob([$('#printt_Area').html()], { type: "application/vnd.ms-excel" });
  let url = URL.createObjectURL(file);
  let a = $("<a />", {
    href: url,
    download: "print_report.xls"
  }).appendTo("body").get(0).click();
  e.preventDefault();

});



$("#Booking_form").on("submit", function (event) {

  event.preventDefault();
  $("#booking_Table tr").html("");


  let hall_name = $("#hall_name").val();



  let sendingData = {

    "hall_name": hall_name,

    "action": "get_booking_repo",

  }



  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "Api/volunteers.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      let tr = '';
      let th = '';

      if (status) {
        response.forEach(res => {

          th = "<tr>";
          for (let r in res) {
            th += `<th>${r}</th>`;
          }

          th += "</tr>";


          tr += "<tr>";
          for (let r in res) {

            if (r == "status") {
              if (res[r] == "paid") {
                tr += `<td><span class="badge bg-success">${res[r]}</span></td>`;
              } else {
                tr += `<td><span class="badge bg-danger">${res[r]}</span></td>`;
              }
            } else {
              tr += `<td>${res[r]}</td>`;
            }

          }

          tr += "</tr>"

        })

        $("#booking_Table thead").append(th);
        $("#booking_Table tbody").append(tr);
      }

    },
    error: function (data) {

    }

  })

})




function loadData() {
  $("#booking_Table tbody").html('');

  let sendingData = {
    "action": "get_booking_repo"
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

          th = "<tr>";
          for (let r in res) {
            th += `<th>${r}</th>`;
          }

          th += "</tr>";


          tr += "<tr>";
          for (let r in res) {

            if (r == "status") {
              if (res[r] == "paid") {
                tr += `<td><span class="badge badge-success">${res[r]}</span></td>`;
              } else {
                tr += `<td><span class="badge badge-danger">${res[r]}</span></td>`;
              }
            } else {
              tr += `<td>${res[r]}</td>`;
            }

          }

          tr += "</tr>"

        })

        $("#booking_Table thead").append(th);
        $("#booking_Table tbody").append(tr);
      }

    },
    error: function (data) {

    }

  })
}



