$(function () {
    //startup.blade.php
    $(document).on('click', '.pagination a', function(event) {
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      getMoreUsers(page);
    });

    $(document).on('change', 'input[Class="held_check"]', function (e) {
     //tipe = $(this).val();
      getMoreUsers(1);
    });


    $('#reset').on('click', function() {
      $('#search_input').val("");
      getMoreUsers(1);
    });

    
    $('#search_input').on('keyup', function() {
        $value = $(this).val();
        getMoreUsers(1);
    });

});
let draw = false;
//startup.blade.php
function getMoreUsers(page) {
    var search = $('#search_input').val();

    const checkboxes = document.querySelectorAll('input[name="held_check"]:checked');
    let values = [];
    checkboxes.forEach((checkbox) => {
        values.push(checkbox.value);
    });
    console.log(values) ;
  
    $.ajax({
      type: "GET",
      data: {
        'search_query':search,
        'held_query':values,
      },
      url: url_get_more_users + page,
      success:function(data) {
        $('#user_data').html(data);
        
      }
    });
}
