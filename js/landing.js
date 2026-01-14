$ = jQuery.noConflict();
$(function () {
  $("body")
    // Tabs
    .on("init", ".wc-tabs-wrapper, .woocommerce-tabs", function () {
      $(this)
        .find(".wc-tab, .woocommerce-tabs .panel:not(.panel .panel)")
        .hide();

      var hash = window.location.hash;
      var url = window.location.href;
      var $tabs = $(this).find(".wc-tabs, ul.tabs").first();

      if (
        hash.toLowerCase().indexOf("comment-") >= 0 ||
        hash === "#reviews" ||
        hash === "#tab-reviews"
      ) {
        $tabs.find("li.reviews_tab a").trigger("click");
      } else if (
        url.indexOf("comment-page-") > 0 ||
        url.indexOf("cpage=") > 0
      ) {
        $tabs.find("li.reviews_tab a").trigger("click");
      } else if (hash === "#tab-additional_information") {
        $tabs.find("li.additional_information_tab a").trigger("click");
      } else {
        $tabs.find("li:first a").trigger("click");
      }
    })
    .on("click", ".wc-tabs li a, ul.tabs li a", function (e) {
      e.preventDefault();
      var $tab = $(this);
      var $tabs_wrapper = $tab.closest(".wc-tabs-wrapper, .woocommerce-tabs");
      var $tabs = $tabs_wrapper.find(".wc-tabs, ul.tabs");

      $tabs.find("li").removeClass("active");
      $tabs_wrapper.find(".wc-tab, .panel:not(.panel .panel)").hide();

      $tab.closest("li").addClass("active");
      $tabs_wrapper.find("#" + $tab.attr("href").split("#")[1]).show();
    })
    // Review link
    .on("click", "a.woocommerce-review-link", function () {
      $(".reviews_tab a").trigger("click");
      return true;
    })
    // Star ratings for comments
    .on("init", "#rating", function () {
      $("#rating").hide().before(
        '<p class="stars">\
						<span>\
							<a class="star-1" href="#">1</a>\
							<a class="star-2" href="#">2</a>\
							<a class="star-3" href="#">3</a>\
							<a class="star-4" href="#">4</a>\
							<a class="star-5" href="#">5</a>\
						</span>\
					</p>'
      );
    })
    .on("click", "#respond p.stars a", function () {
      var $star = $(this),
        $rating = $(this).closest("#respond").find("#rating"),
        $container = $(this).closest(".stars");

      $rating.val($star.text());
      $star.siblings("a").removeClass("active");
      $star.addClass("active");
      $container.addClass("selected");

      return false;
    })
    .on("click", "#respond #submit", function () {
      var $rating = $(this).closest("#respond").find("#rating"),
        rating = $rating.val();

      if (
        $rating.length > 0 &&
        !rating &&
        wc_single_product_params.review_rating_required === "yes"
      ) {
        window.alert(wc_single_product_params.i18n_required_rating_text);

        return false;
      }
    });

  // Init Tabs and Star Ratings
  $(".wc-tabs-wrapper, .woocommerce-tabs, #rating").trigger("init");

  $("ul.accordion li span.toggle").click(function (e) {
    $(this).toggleClass("show");
  });
  var swiper = new Swiper(".review-swiper-container-grid", {
    slidesPerView: 1,
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    // Responsive breakpoints
    breakpoints: {
      // when window width is <= 600px
      600: {
        slidesPerView: 2,
        spaceBetween: 10,
      },
      // when window width is <= 767px
      767: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    },
  });

  var infoswiper = new Swiper(".info-swiper-container", {
    slidesPerView: 2,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 2500, // Delay in milliseconds between slides (2500 milliseconds = 2.5 seconds)
      disableOnInteraction: false, // Continue autoplay even after interaction
    },
    // Responsive breakpoints
    breakpoints: {
      // when window width is <= 600px
      600: {
        slidesPerView: 3,
        spaceBetween: 10,
        loop: true,
        autoplay: {
          delay: 2500, // Delay in milliseconds between slides (2500 milliseconds = 2.5 seconds)
          disableOnInteraction: false, // Continue autoplay even after interaction
        },
      },
      // when window width is <= 767px
      767: {
        slidesPerView: 5,
        spaceBetween: 20,
      },
    },
  });

  // $("#upsell-block > div.offer").click(function () {
  //   $("#offer-loader").show();
  //   var container = $(this);
  //   var inputel = $(this).find("input");
  //   var product_id = inputel.data("id");
  //   var quantity = inputel.data("qty");
  //   var custom_price = inputel.data("price");
  //   var gift = inputel.data("gift");
  //   var free_shipping = inputel.data("free-shipping");
  //   var lid = inputel.data("lid");

  //   $.ajax({
  //     url: ajax_params.ajax_url,
  //     type: "POST",
  //     data: {
  //       action: "add_product_to_cart",
  //       product_id: product_id,
  //       quantity: quantity,
  //       custom_price: custom_price,
  //       gift: gift,
  //       free_shipping: free_shipping,
  //       lid: lid,
  //     },
  //     success: function (response) {
  //       if (response.success) {
  //         window.upsell = true;
  //         container.siblings().each(function () {
  //           $(this).removeClass("active");
  //           $(this).find("input").removeAttr("checked");
  //           $(this)
  //             .find(".offer-container > div.text-center")
  //             .removeClass("active");
  //         });
  //         container.addClass("active");
  //         container.find('input[type="checkbox"]').prop("checked", true);
  //         // container.find('input[type="checkbox"]').attr('checked', 'checked');
  //         container
  //           .find(".offer-container > div.text-center")
  //           .addClass("active");
  //         $("#shop_table_holder").hide();
  //         $("#offer-loader").hide();
  //         $("body").trigger("update_checkout");
  //       } else {
  //         alert("Failed to add product to cart.");
  //       }
  //     },
  //   });
  // });

  $(".text-expandable .plus-circle").on("click", function (e) {
    e.preventDefault();
    // toggleExpandableText()
    var holder = $(this).closest(".text-expandable");
    holder.find(".hidden-text").toggleClass("show");
    holder.find(".svg-container").toggleClass("minus");
  });

  if (window.matchMedia("(max-width: 767px)").matches) {
    const swiper = new Swiper(".faqGrid", {
      // Your Swiper options here
      slidesPerView: 1.2,
      spaceBetween: 10,
    });
  }
});

function toggleExpandableText() {
  (function ($) {
    if ($(".text-expandable .hidden-text").hasClass("show")) {
      $(".text-expandable .hidden-text").removeClass("show");
      $(".text-expandable .svg-container").removeClass("minus");
    } else {
      $(".text-expandable .hidden-text").addClass("show");
      $(".text-expandable .svg-container").addClass("minus");
    }
  })(jQuery);
}

document.addEventListener("DOMContentLoaded", function () {
  if (window.innerWidth <= 992) {
    var multirow = new Swiper(".grid-swiper-container", {
      direction: "horizontal",
      slidesPerView: 1,
      slidesOffsetBefore: 0,
      slidesOffsetAfter: 0,
      spaceBetween: 30,
      freeMode: false,
      speed: 200,
      mousewheel: {
        forceToAxis: true,
        invert: true,
      },
      updateOnWindowResize: true,
      resistanceRatio: 0,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        690: {
          slidesPerView: 3,
          /*
                slidesPerColumn: 2,
                slidesPerColumnFill: 'row',
                spaceBetween: 20,
                slidesOffsetBefore: 0,
                slidesOffsetAfter: 0,
                freeMode: false,
                resistanceRatio: 0
                */
        },
      },
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  var paragraphs = document.querySelectorAll("p");
  paragraphs.forEach(function (p) {
    // Check if the paragraph's text contains only non-breaking spaces
    if (p.textContent.trim().length === 0 && p.innerHTML.includes("&nbsp;")) {
      p.classList.add("only-nbsp"); // Add a class if it contains only &nbsp;
    }
  });
});

$(document).ready(function () {
  // Function to add product to cart
  function addProductToCart(element) {
    var inputel = element.find("input");
    var product_id = inputel.data("id");
    var quantity = inputel.data("qty");
    var custom_price = inputel.data("price");
    var gift = inputel.data("gift");
    var free_shipping = inputel.data("free-shipping");
    var lid = inputel.data("lid");

    $.ajax({
      url: ajax_params.ajax_url,
      type: "POST",
      data: {
        action: "add_product_to_cart",
        product_id: product_id,
        quantity: quantity,
        custom_price: custom_price,
        gift: gift,
        free_shipping: free_shipping,
        lid: lid,
      },
      success: function (response) {
        if (response.success) {
          window.upsell = true;
          element.siblings().each(function () {
            $(this).removeClass("active");
            $(this).find("input").removeAttr("checked");
            $(this)
              .find(".offer-container > div.text-center")
              .removeClass("active");
          });
          element.addClass("active");
          element.find('input[type="checkbox"]').prop("checked", true);
          element.find(".offer-container > div.text-center").addClass("active");
          $("#shop_table_holder").hide();
          $("#offer-loader").hide();
          $("body").trigger("update_checkout");
          console.log("added to cart");
        } else {
          alert("Failed to add product to cart.");
          console.log("Failed");
        }
      },
    });
  }

  // Call function when an offer is clicked
  $("#upsell-block > div.offer").click(function () {
    $("#offer-loader").show();
    addProductToCart($(this));
  });

  // Call function on page load for the first offer
  var firstOffer = $("#upsell-block > div.offer").first();
  if (firstOffer.length) {
    addProductToCart(firstOffer);
  }
});
