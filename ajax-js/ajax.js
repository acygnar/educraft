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
  let cat = ["finanse"];
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
  ////Filter initial/////
  sendFilterRequest();

  //   ////Filter checkbox/////
  //   const filterCheckboxes = document.querySelectorAll(
  //     ".m-list-categories__checkbox input",
  //   );
  //   filterCheckboxes.forEach((checkbox) => {
  //     checkbox.addEventListener("change", function () {
  //       if (checkbox.checked) {
  //         $('.m-list-categories__checkbox input[type="checkbox"]')
  //           .not(this)
  //           .prop("checked", false);
  //         cat = [];
  //         cat.push(checkbox.value);
  //       }
  //       if (!checkbox.checked) {
  //         const index = cat.indexOf(checkbox.value);
  //         let subcatInputs = document.querySelectorAll(
  //           ".m-list-categories__checkbox--sub input",
  //         );
  //         subcat = [];
  //         subcatInputs.forEach((input) => {
  //           input.checked = false;
  //         });
  //         if (index > -1) {
  //           cat.splice(index, 1);
  //         }
  //         if (cat.length === 0) {
  //           const clearAll = document.getElementById("clearAll");
  //           clearAll.classList.remove("active");
  //         }
  //       }
  //       const button = checkbox;
  //       sendFilterRequest();
  //     });
  //   });

  //   ////Clear All

  //   const clearAll = document.getElementById("clearAll");
  //   const sortBtn = document.querySelector(".js-sort-open");
  //   const filterTitle = document.querySelector(".js-filter-title");

  //   clearAll.addEventListener("click", function () {
  //     ((cat = []), ((subcat = []), (sectors = []), (subsectors = [])));
  //     const inputs = document.getElementsByTagName("input");
  //     const filterCheckboxes = document.querySelectorAll(
  //       ".m-list-categories__sub",
  //     );
  //     filterCheckboxes.forEach((checkbox) => {
  //       checkbox.classList.remove("is-active");
  //     });
  //     const accs = document.querySelectorAll(".accordion");
  //     accs.forEach((acc) => {
  //       acc.classList.remove("active");
  //       let panel = acc.nextElementSibling;
  //       if (panel.style.maxHeight) {
  //         panel.style.maxHeight = null;
  //       }
  //     });

  //     for (let i = 0; i < inputs.length; i++) {
  //       if (inputs[i].type == "checkbox") {
  //         inputs[i].checked = false;
  //       }
  //     }

  //     if (cat.length === 0) {
  //       clearAll.classList.remove("active");
  //     }

  //     sortBtn.classList.remove("active");
  //     filterTitle.classList.remove("active");

  //     const button = clearAll;
  //     sendFilterRequest();
  //   });
});
