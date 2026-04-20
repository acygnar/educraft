const success = function (data_filter) {
  if (data_filter) {
    $(".js-loader").fadeOut(200);
    $(".o-grid__results").html("");
    $(data_filter).appendTo(".o-grid__results").hide().slideDown(300);
  } else {
    $(".js-loader").fadeOut(200);
    $(".o-grid__results").html("<p>No results</p>");
  }
};
const error = function (xhr, status, error) {
  var err = eval("(" + xhr.responseText + ")");
  console.log(err.Message);
};
const beforeSend = function (xhr) {
  $(".js-loader").fadeIn(200);
  console.log("Loading...");
};
////DOM Load/////
document.addEventListener("DOMContentLoaded", (event) => {
  console.log("DOM fully loaded and parsed");
  let cat = [];
  let order = "ASC";
  let orderby = {
    meta_value_num: "ASC",
    title: "ASC",
  };

  function sendFilterRequest() {
    console.log("Sending filter request...");
    const data_filter = {
      action: "filter_cs",
      page: 1,
      cat: cat,
      order: order,
      orderby: orderby,
      type: "csFilter",
    };

    $.ajax({
      url: params_filter.ajaxurl,
      data: data_filter,
      type: "POST",
      beforeSend: beforeSend,
      success: success,
      error: error,
    });
  }
  //Filter initial//
  sendFilterRequest();

  //Filter checkbox//
  const filterCheckboxes = document.querySelectorAll(
    ".o-grid__filter-checkbox input",
  );
  filterCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      if (checkbox.checked) {
        $('.o-grid__filter-checkbox input[type="checkbox"]').not(this);
        cat.push(checkbox.value);
      }
      if (!checkbox.checked) {
        const index = cat.indexOf(checkbox.value);
        if (index > -1) {
          cat.splice(index, 1);
        }
      }
      const button = checkbox;
      sendFilterRequest();
    });
  });

  ///Clear filter//

  const clearAll = document.getElementById("clearAll");
  clearAll.addEventListener("click", function () {
    cat = [];
    const inputs = document.getElementsByTagName("input");
    for (let i = 0; i < inputs.length; i++) {
      if (inputs[i].type == "checkbox") {
        inputs[i].checked = false;
      }
    }
    const button = clearAll;
    sendFilterRequest();
  });
});
