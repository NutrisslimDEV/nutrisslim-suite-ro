$ = jQuery.noConflict();
$(function () {
  window.firstLoad = true; // this is for updateCustomBlock below.

  function loadCheckoutOffers() {
    $.ajax({
      type: "POST",
      url: cwcAjax.ajaxurl, // Make sure cwcAjax.ajaxurl is defined in your script localization
      data: {
        action: "get_checkout_offer",
      },
      success: function (response) {
        if (response.success) {
          // Place the HTML in the div#checkoutOfferHolder
          $("#checkoutOfferHolder").html(response.data.html);

          // Initialize Swiper after loading the offer HTML
          var swiper = new Swiper(".checkoutOffer", {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
          });
        } else {
          // console.log("Failed to load checkout offers.");
        }
      },
      error: function () {
        console.log("Error loading checkout offers.");
      },
    });
  }
  // Call the function to load offers on page load or when needed
  // loadCheckoutOffers();

  // Execute on initial load
  updateCustomBlock();

  // Trigger update when order review is updated
  $(document.body).on("updated_checkout", function () {
    updateShippingPrice();
    updateCustomBlock();
    loadCheckoutOffers();

    var freeShippingInput = $('input.shipping_method[value^="free_shipping"]');
    if (freeShippingInput.length > 0 && window.upsell == true) {
      // If such an input exists, select it
      $("input.shipping_method").prop("checked", false);
      freeShippingInput.prop("checked", true);
      $("body").trigger("update_checkout");
      window.upsell = false;
    }

    $(
      ".page-id-2075 span.woocommerce-terms-and-conditions-checkbox-text"
    ).prepend("Am citit și sunt de acord cu site-ul ");
    $(
      ".page-id-2075 span.woocommerce-terms-and-conditions-checkbox-text a"
    ).append(" termeni și condiții");
    $("input#terms").prop("checked", true);
    $("#order_review_heading_inner").addClass("expanded");
  });

  $(document).on("change", 'input[name="rf_nacin_dostave"]', function () {
    var parentContainer = $(this).closest(".rf-option-container");
    var siblings = parentContainer.siblings(".rf-option-container");

    var selectedMethod = $(this).val();
    var fee = $(this).data("fee-value");
    var feelabel = $(this).data("fee-label");
    // var shippingLabel = $(this).data('label');

    if ($(this).is(":checked")) {
      parentContainer.css("background-color", "#B0E4C5"); // Set to green when checked
    } else {
      parentContainer.css("background-color", "transparent"); // Reset to transparent when unchecked
    }

    siblings.css("background-color", "transparent");

    updateShippingMethod(selectedMethod, fee, feelabel);
  });

  $(document).on("click", ".rf-checkout-upsell-btn", function (e) {
    e.preventDefault();
    updateCustomBlock();
    container;
    var $button = $(this);

    // Check if the button is already disabled
    if ($button.hasClass("disabled")) {
      return; // Exit if already disabled
    }

    // Disable the button by adding a class
    $button
      .addClass("disabled")
      .css("pointer-events", "none")
      .css("opacity", "0.5");

    var container = $button.closest(".swiper-container");
    var productId = $button.data("pid");
    var productPrice = $button.data("price");
    container.css("opacity", "0.5");

    $.ajax({
      url: cwcAjax.ajaxurl,
      type: "POST",
      data: {
        action: "rf_add_to_cart_custom_price",
        product_id: productId,
        product_price: productPrice,
      },
      success: function (response) {
        if (response.success) {
          // Optionally update cart UI here
          // this triggers recalculation of shipping
          window.upsell = true;
          var selectedMethod = $("#shipping_method li input:checked").val();
          var fee = $(".select-shipping input:checked").data("fee-value") || 0;
          var feelabel =
            $(".select-shipping input:checked").data("fee-label") || "";
          updateShippingMethod(selectedMethod, fee, feelabel);
          $("body").trigger("update_checkout");
          container.css("opacity", "1");
        } else {
          alert("Failed to add product to cart.");
          // Re-enable the button if adding to cart fails
          $button
            .removeClass("disabled")
            .css("pointer-events", "auto")
            .css("opacity", "1");
        }
      },
      error: function () {
        alert("Error adding product to cart.");
        // Re-enable the button if there is an error
        $button
          .removeClass("disabled")
          .css("pointer-events", "auto")
          .css("opacity", "1");
      },
    });
  });

  $("form.checkout").on("change", ".rf-custom-checkbox.packing", function () {
    var data = {
      action: "toggle_custom_fees",
      checkbox_states: {
        rf_ekoloska_embalaza: $("#rf_ekoloska_embalaza").is(":checked")
          ? "on"
          : "off",
        rf_zavarovanje_narocila: $("#rf_zavarovanje_narocila").is(":checked")
          ? "on"
          : "off",
        rf_izdelek_presenecenja: $("#rf_izdelek_presenecenja").is(":checked")
          ? "on"
          : "off",
        rf_priority_delivery: $("#rf_priority_delivery").is(":checked")
          ? "on"
          : "off",
      },
    };

    // Add or remove background color based on checkbox state
    $(this)
      .closest(".delivery-option")
      .css(
        "background-color",
        $(this).is(":checked") ? "rgb(176, 228, 197)" : ""
      );

    $.ajax({
      type: "POST",
      url: cwcAjax.ajaxurl,
      data: data,
      success: function (response) {
        $("body").trigger("update_checkout");
      },
    });
  });

  $("form.checkout").on("change", 'input[name="payment_method"]', function () {
    $("body").trigger("update_checkout");
  });

  // Select all text, email, phone, and textarea fields in the form with class 'checkout'
  var $inputFields = $(
    '.checkout input[type="text"], .checkout input[type="email"], .checkout input[type="tel"], .checkout textarea'
  );

  $inputFields.each(function () {
    var $inputField = $(this);
    var $label = $inputField.closest("p").find("label");

    // Function to toggle the 'show' class
    function toggleLabel() {
      if ($inputField.val()) {
        $label.addClass("show");
      } else {
        $label.removeClass("show");
      }
    }

    // Initial check in case the field is pre-filled
    toggleLabel();

    // Add event listeners for each field
    $inputField.on("input blur", toggleLabel);
  });

  // $("body").on("keydown", "input#billing_postcode", function (e) {
  //   var maxLength = 8;
  //   var value = $(this).val();

  //   // Ensure this only works when the 'country_GB' class is applied to the body
  //   if ($("body").hasClass("country_GB")) {
  //     // Allow special keys like backspace, delete, arrow keys, etc.
  //     var specialKeys = [8, 9, 13, 27, 46, 37, 38, 39, 40];

  //     // If the current length is greater than or equal to maxLength, prevent further input
  //     if (value.length >= maxLength && specialKeys.indexOf(e.keyCode) === -1) {
  //       e.preventDefault();
  //     }
  //   }
  // });
});

function updateShippingPrice() {
  // Select the checked shipping method input
  var checkedInput = $("#shipping_method input.shipping_method:checked");
  var selectedShippingMethod = $('input[name="rf_nacin_dostave"]:checked');

  // Get the corresponding price span
  var newPrice = checkedInput
    .siblings("label")
    .find(".woocommerce-Price-amount")
    .clone();

  // If newPrice is empty, use the freelabel data attribute
  if (newPrice.length === 0) {
    var datafreeLabel = selectedShippingMethod.data("freelabel");
    newPrice = $(
      '<span class="woocommerce-Price-amount amount">' +
        datafreeLabel +
        "</span>"
    );
  }

  // Select the shipping td element
  var shippingTd = $('td[data-title="Shipping"]');

  // Remove any existing price span
  // shippingTd.find('> .woocommerce-Price-amount').remove();

  // Prepend the new price span
  // shippingTd.prepend(newPrice);

  // Get the data-label from the selected radio button and update the th element
  var dataLabel = selectedShippingMethod.data("label");
  $("tr.woocommerce-shipping-totals.shipping > th:first-child").html(dataLabel);

  // Select the small element within the td of the .order-total row
  var taxInfo = $(".order-total td .includes_tax");
  if (taxInfo.length) {
    // Translate only the text content outside of spans
    taxInfo
      .contents()
      .filter(function () {
        return this.nodeType === Node.TEXT_NODE;
      })
      .each(function () {
        this.nodeValue = this.nodeValue
          .replace("(includes", "(includes ")
          .replace("VAT)", "VAT)");
      });

    // Remove from td and append to th
    $(".order-total th").append(taxInfo.clone());
    taxInfo.remove();
  }

  // Add <tr class="custom-hr-row top"> only if it does not already exist before cart subtotal
  if ($("tr.cart-subtotal").prev("tr.custom-hr-row.top").length === 0) {
    $("tr.cart-subtotal").before(
      '<tr class="custom-hr-row top"><td colspan="2"><hr /></td></tr>'
    );
  }

  // Add <tr class="custom-hr-row top"> only if it does not already exist before order total
  if ($("tr.order-total").prev("tr.custom-hr-row.top").length === 0) {
    $("tr.order-total").before(
      '<tr class="custom-hr-row top"><td colspan="2"><hr /></td></tr>'
    );
  }

  // Add <tr class="custom-hr-row top"> only if it does not already exist after order total
  if ($("tr.order-total").next("tr.custom-hr-row.top").length === 0) {
    $("tr.order-total").after(
      '<tr class="custom-hr-row top"><td colspan="2"><hr /></td></tr>'
    );
  }
}

function updateCustomBlock() {
  selectedOption = $('input[name="rf_nacin_dostave"]:checked').val();
  $.ajax({
    type: "POST",
    url: ajax_params.ajax_url,
    data: {
      action: "update_custom_checkout_block",
      selected: selectedOption,
    },
    success: function (response) {
      if (response.success) {
        $("#methodsPicker").html(response.data.custom_block_html);
        // window.firstLoad = false;

        $('#shipping_method input[value="' + response.data.method + '"]')
          .next("label")
          .html(response.data.price);
      } else {
        console.error("Failed to update custom block:", response);
      }
    },
  });
}

function updateShippingMethod(selectedMethod, fee, feelabel) {
  // Check if there is an input with a value that starts with free_shipping
  var freeShippingInput = $('input.shipping_method[value^="free_shipping"]');
  if (freeShippingInput.length > 0) {
    // If such an input exists, select it
    $("input.shipping_method").prop("checked", false);
    freeShippingInput.prop("checked", true);
  } else {
    // Otherwise, select the specified shipping method
    $("input.shipping_method").prop("checked", false);
    $('input.shipping_method[value="' + selectedMethod + '"]').prop(
      "checked",
      true
    );
  }

  $.ajax({
    type: "POST",
    url: wc_cart_params.ajax_url,
    data: {
      action: "custom_update_shipping_cost",
      shipping_method: selectedMethod,
      fee: fee,
      feelabel: feelabel,
    },
    success: function (response) {
      console.log("AJAX request successful");

      $("body").trigger("update_checkout");
    },
    error: function (xhr, status, error) {
      console.log("AJAX request failed: ", error);
    },
  });
}

document.addEventListener("DOMContentLoaded", function () {
  var shopTable = document.querySelector(
    ".woocommerce-checkout-review-order-table"
  );
  if (shopTable) {
    var wrapper = document.createElement("div");
    wrapper.id = "shop_table_holder";
    shopTable.parentNode.insertBefore(wrapper, shopTable);
    wrapper.appendChild(shopTable);
  }
});
document.addEventListener("DOMContentLoaded", function () {
  // Function to check and update the shipping method visibility
  function updateShippingMethodVisibility() {
    // Select the ul element
    var shippingMethodUl = document.querySelector(
      "div#payment div.place-order .shop_table tfoot tr.woocommerce-shipping-totals ul#shipping_method"
    );

    // Check if the ul element exists
    if (shippingMethodUl) {
      // Check if there are any li elements inside the ul
      var listItems = shippingMethodUl.querySelectorAll("li");

      // If there are no li elements or they are empty, hide the ul
      if (Array.from(listItems).every((li) => li.textContent.trim() === "")) {
        shippingMethodUl.classList.add("hidden-important");
      } else {
        shippingMethodUl.classList.remove("hidden-important");
      }

      // Remove :after content if free shipping
      listItems.forEach(function (li) {
        var shippingInput = li.querySelector("input.shipping_method");
        if (shippingInput && shippingInput.value.includes("free_shipping")) {
          shippingMethodUl.style.setProperty("content", "none", "important");
        }
      });
    }
  }

  // Initial check after a delay
  setTimeout(updateShippingMethodVisibility, 5000); // Timeout set to 5000ms (5 seconds)
});

jQuery(document).ready(function ($) {
  // Attach a click event to the apply coupon button
  $(document).on(
    "click",
    "button.woocommerce-button.button.e-apply-coupon",
    function (event) {
      // Wait a moment for WooCommerce to render the error message
      setTimeout(function () {
        var errorElement = $("ul.woocommerce-error"); // Select the error element
        if (errorElement.length) {
          $("html, body").animate(
            {
              scrollTop: errorElement.offset().top - 100, // Adjust offset as needed
            },
            1000
          ); // Scroll with animation
        }
      }, 600); // Delay to ensure error is added to DOM
    }
  );
});
