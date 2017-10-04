//Display Error Messages
function displayErrorMsg(msg){
    $("#msg").show();
    $("#msg").html(msg);
    $("#msg").fadeOut(5000);
}

function successModal(header, url){
    swal({
          title: header,
          type: "success",
          showCancelButton: false,
          closeOnConfirm: true
        },
        function(isConfirm){
          if (isConfirm) {
            window.location.href = url;
          }
        });
}