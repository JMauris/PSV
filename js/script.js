function redirect(url) {
  window.location = url;
}

function test() {
  alert("I am an alert box!");
}

$(function(){
  $(".postcode").autocomplete({
    source: "../address/get_cities_by_postcode",
    select: function(e, ui) {
      $(this).closest('div').find(".city").val(ui.item.name);
      $(this).closest('div').find(".city_id").val(ui.item.id);
    },
    change: function (event, ui) {
      if(!ui.item){
        $(this).closest('div').find(".city").val("");
      }

    }
  });
});

$(function() {
  $(".date").datepicker({ dateFormat: 'dd-mm-yy' });
});
