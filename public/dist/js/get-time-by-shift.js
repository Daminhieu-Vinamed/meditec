function getTime(valueSelect, idNumberSelect, idStringSelect) {
  if (sessionStorage.getItem('string-all-shift') === null) {
      $.ajax({
          url: "/get-time",
          type:'GET',
          success: function(data) {
              var objectShift =data.shiftAll.find(element => element.Code === valueSelect);
              $('#'+idStringSelect+'-'+idNumberSelect+'').val(objectShift.WorkDay);
              const myJSON = JSON.stringify(data.shiftAll);
              sessionStorage.setItem('string-all-shift', myJSON)
          }
      });
  } else {
      const MyJSON = JSON.parse(sessionStorage.getItem('string-all-shift'));
      var objectShift = MyJSON.find(element => element.Code  === valueSelect);
      $('#'+idStringSelect+'-'+idNumberSelect+'').val(objectShift.WorkDay);
  }
}