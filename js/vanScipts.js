	$('#start').daterangepicker({
  singleDatePicker: true,
  autoApply: true,

  minDate : moment(),
  startDate: moment(),
  locale: {
    format: 'DD-MM-YYYY',
    firstDay: 1
  }
});

$('#end').daterangepicker({
  singleDatePicker: true,
  autoApply: true,

  minDate: moment(),
  startDate: moment().add(1, 'days'),
  locale: {
    format: 'DD-MM-YYYY',
    firstDay: 1
  }
});

$('#start').on('apply.daterangepicker', function(ev, picker) {

    var new_start =  picker.startDate.clone().add(1, 'days');

    $('#end').daterangepicker({
      singleDatePicker: true,
      autoApply: true,

      minDate: new_start,
      startDate: new_start,
      locale: {
        format: 'DD-MM-YYYY',
        firstDay: 1
      }
    });

});

$('#searchModal').on('shown.bs.modal', function() {
  $("#searchResults").html("Loading...");
  var form = $('#searchForm').serializeJSON();
  var jdata = JSON.stringify(form);
  $.ajax({
    url: 'searchBox.php',
    method: 'post',
    dataType: 'json',
    data: jdata,
    success: function(data) {
      $("#searchResults").html(data);
    }
  });
});

  $('#searchModal').on('click', '.vanSelect', function() {
    var $el = $(this);
    var $id = $el.data('van-id');
    var $start = $el.data('van-start');
    var $end = $el.data('van-end');
    var $period = $el.data('van-period');
    var $store = $el.data('van-store');
    var $name = $el.data('van-name');
    var $price = $el.data('van-price');

	$('#type_id').attr('name', $id);
	$('#type_id').val($name);
	$('#startDate').val($start);
	$('#endDate').val($end);
	$('#store').val($store);
	$('#product').val($id);
	$('#days').val($period);
	$('#price').val($price);
	$('#prod_type').val($name);
});



   $("#searchForm").submit(function(e){
          e.preventDefault(e);
            });

    $('#searchForm').validate({
      rules: {
        artistName: {
          required: true,
          minlength: 2,
          maxlength: 40,
        },
      },
      messages: {
        artistName: {
                required: "Please enter a the Artists Name",
                minlength: "Artist Name must be at least {0} characters long"
            },
    },
      highlight: function(element, errorClass, validClass) { 
          $(element).nextAll('.form-control-feedback').show().removeClass('glyphicon-ok').addClass('glyphicon-remove');
          $(element).addClass(errorClass).removeClass(validClass);
          $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
      success: function(element) {
          $(element).nextAll('.form-control-feedback').show().removeClass('glyphicon-remove').addClass('glyphicon-ok');
          element.closest('.form-group').removeClass('has-error').addClass('has-success');
          $(element).remove();
        },
      onkeyup: false, //turn off auto validate whilst typing
      submitHandler: function (form) {
      	$('#searchModal').modal('show');
      }
  });
