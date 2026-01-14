$ = jQuery.noConflict();
$(function () {
  function cartUpsell() {
    $.ajax({
      url: cwcAjax.ajaxurl,
      type: "POST",
      data: {
        action: "cart_upsell", // This matches the name of the PHP function hooked to wp_ajax_ and wp_ajax_nopriv_
      },
      success: function (response) {
        // Insert the returned content into the #cartOffer element
        $("#cartOffer").html(response);
      },
      error: function (error) {
        console.log("Error:", error);
      },
    });
  }

  function switchTab(selectedTab) {
    // Find the parent .customAddToCart element
    var parent = selectedTab.closest(".customAddToCart");

    // Remove active class from all tabs within the same .customAddToCart block
    parent.find(".tab").removeClass("active");

    // Add active class to the selected tab
    selectedTab.addClass("active");

    // Toggle visibility of content based on selected tab
    if (selectedTab.hasClass("subscr")) {
      parent.find(".subscrContent").show();
      parent.find(".onetimeContent").hide();
      parent.find(".subscriptiolLabel").show();
      parent.find("span.buttonTime").show(); // Show buttonTime for subscription
    } else if (selectedTab.hasClass("onetime")) {
      parent.find(".onetimeContent").show();
      parent.find(".subscrContent").hide();
      parent.find(".subscriptiolLabel").hide();
      parent.find("span.buttonTime").hide(); // Hide buttonTime for one-time purchase
    }

    updatePrices(parent);
    updateButtonSubscriptionValue(parent);
  }

  function updatePrices(parent) {
    // Determine if we are in subscription mode or one-time mode
    var isSubscription = parent.find(".tab.subscr").hasClass("active");

    // Get the selected quantity input
    var selectedInput = parent.find('input[name="quantity"]:checked');

    // Get the price based on the mode
    var price = isSubscription
      ? selectedInput.data("subscribe-price")
      : selectedInput.data("price");

    // Update the main sale price
    parent.find("span.mainsale").html(price);

    // Update the button price
    parent.find("span.buttonPrice").html(price);

    // Update the discount label and its visibility
    parent.find(".label").each(function () {
      var newDiscount = isSubscription
        ? $(this).data("subscription")
        : $(this).data("onetime");
      $(this).text("-" + newDiscount + "%");

      // Toggle visibility based on discount value
      if (newDiscount > 0) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });

    // Update the individual package prices
    parent.find(".price").each(function () {
      var newPrice = isSubscription
        ? $(this).data("subscribe-price")
        : $(this).data("price");
      $(this).html(newPrice);
    });

    // Update the safe span with the data-diff value
    parent.find("span.safe").html(selectedInput.data("diff"));

    // Update the payonly span with the subscription price
    parent.find("span.payonly").html(selectedInput.data("subscribe-price"));

    // Update the prihrana span with the save value
    var saveValue = isSubscription
      ? selectedInput.data("subscribe-save")
      : selectedInput.data("onetime-save");
    parent.find("span.prihrana").html(saveValue);

    // Update the price in .regularcrossed.crosslined based on the selected quantity
    var quantityValue = parseInt(selectedInput.val());
    var regularCrossed = parent.find(".regularcrossed.crosslined");
    var newPrice;

    if (quantityValue === 1) {
      newPrice = regularCrossed.data("one-regular");
    } else if (quantityValue === 2) {
      newPrice = regularCrossed.data("two-regular");
    } else if (quantityValue === 3) {
      newPrice = regularCrossed.data("three-regular");
    }

    regularCrossed.html(newPrice);

    // Toggle visibility of .regularcrossed.crosslined and p.prihranek based on the new criteria
    var prihranek = parent.find("p.prihranek");
    if (
      regularCrossed.data("toggle-visability") &&
      quantityValue === 1 &&
      parent.find(".tab.onetime").hasClass("active")
    ) {
      regularCrossed.hide();
      prihranek.hide();
    } else {
      regularCrossed.show();
      prihranek.show();
    }
  }

  function updateButtonSubscriptionValue(parent) {
    // console.log(parent);
    // parent.find('span.numdays').remove();
    // Determine if we are in subscription mode or one-time mode
    var isSubscription = parent.find(".tab.subscr").hasClass("active");

    // Get the button element
    var button = parent.find(".add-to-cart-icon");

    if (isSubscription) {
      // Get the selected subscription value
      var subscriptionValue = parent.find(".subscription").val();
      // Set the subscription value on the button
      button.attr("data-subscription", subscriptionValue);

      // Update the numdays spans
      parent.find("span.numdays").text(subscriptionValue);
      parent.find("span.buttonTime > span").text(subscriptionValue);
    } else {
      // Set the subscription value to 0 for one-time purchase
      button.attr("data-subscription", 0);

      // Update the numdays spans
      parent.find("span.numdays").text("");
      parent.find("span.buttonTime > span").text("");
    }

    // Also update the visibility of .regularcrossed.crosslined and update its price
    var selectedInput = parent.find('input[name="quantity"]:checked');
    var quantityValue = parseInt(selectedInput.val());
    var regularCrossed = parent.find(".regularcrossed.crosslined");
    var newPrice;

    if (quantityValue === 1) {
      newPrice = regularCrossed.data("one-regular");
    } else if (quantityValue === 2) {
      newPrice = regularCrossed.data("two-regular");
    } else if (quantityValue === 3) {
      newPrice = regularCrossed.data("three-regular");
    }

    regularCrossed.html(newPrice);

    if (
      regularCrossed.data("toggle-visability") &&
      quantityValue === 1 &&
      parent.find(".tab.onetime").hasClass("active")
    ) {
      regularCrossed.hide();
    } else {
      regularCrossed.show();
    }
  }

  // Attach click event to tabs
  $(".tab").on("click", function () {
    switchTab($(this));
  });

  // Attach change event to quantity inputs to update prices
  $(document).on(
    "change",
    '.customAddToCart input[name="quantity"]',
    function () {
      var parent = $(this).closest(".customAddToCart");
      updatePrices(parent);
    }
  );

  // Attach change event to subscription dropdown to update button subscription value and numdays spans
  $(document).on("change", ".customAddToCart .subscription", function () {
    var parent = $(this).closest(".customAddToCart");
    updateButtonSubscriptionValue(parent);
  });

  $(document).on("click", ".gotopregled", function (e) {
    e.preventDefault();
    // $("body").addClass("loading");
    var orderId = $(this).data("oid");

    $.ajax({
      url: cwcAjax.ajaxurl,
      type: "POST",
      data: {
        action: "update_order_state",
        order_id: orderId,
        order_state: "pregled",
      },
      success: function (response) {
        $("body").addClass("order-state-pregled");
        $("body").removeClass("order-state-final");
        $("body").removeClass("order-state-init");
        $("body").removeClass("order-state-complete");
        $("body").removeClass("loading");
      },
      error: function (response) {
        alert("Failed to update order state.");
      },
    });
  });
  $(document).on("click", "#straighttofinal", function (e) {
    e.preventDefault();
    // $("body").addClass("loading");
    var orderId = $(this).data("oid");

    $.ajax({
      url: cwcAjax.ajaxurl,
      type: "POST",
      data: {
        action: "update_order_state",
        order_id: orderId,
        order_state: "final",
      },
      success: function (response) {
        startLastCounter();
        $("body").addClass("order-state-final");
        $("body").removeClass("order-state-init");
        $("body").removeClass("order-state-pregled");
        $("body").removeClass("order-state-complete");
        $("body").removeClass("loading");
      },
      error: function (response) {
        alert("Failed to update order state.");
      },
    });
  });
  $(document).on("click", "#pregled-narucila", function (e) {
    e.preventDefault();
    $("body").addClass("loading");
    var orderId = $(this).data("oid");

    $.ajax({
      url: cwcAjax.ajaxurl,
      type: "POST",
      data: {
        action: "update_order_state",
        order_id: orderId,
        order_state: "pregled",
      },
      success: function (response) {
        $("body").removeClass("order-state-init");
        $("body").addClass("order-state-pregled");
        $("body").removeClass("order-state-final");
        $("body").removeClass("order-state-complete");
        $("body").removeClass("loading");
      },
      error: function (response) {
        alert("Failed to update order state.");
      },
    });
  });
  $(document).on("click", "#show-offer", function (e) {
    e.preventDefault();
    $("body").addClass("loading");
    var orderId = $(this).data("oid");

    $.ajax({
      url: cwcAjax.ajaxurl,
      type: "POST",
      data: {
        action: "update_order_state",
        order_id: orderId,
        order_state: "init",
      },
      success: function (response) {
        $("body").addClass("order-state-init");
        $("body").removeClass("order-state-pregled");
        $("body").removeClass("order-state-final");
        $("body").removeClass("order-state-complete");
        $("body").removeClass("loading");
      },
      error: function (response) {
        alert("Failed to update order state.");
      },
    });
  });
  function updateCartButton() {
    var selectedProducts = [];
    $(".product.selected").each(function () {
      var productId = $(this).find(".org-btn").data("pid");
      var productPrice = $(this).find(".org-btn").data("price");
      selectedProducts.push({ id: productId, price: productPrice });
    });

    var selectedProductsJson = JSON.stringify(selectedProducts);
    $("#to-cart").attr("data-add", selectedProductsJson);
    $("#add-extra-order").attr("data-add", selectedProductsJson);
  }
  $(document).on("click", ".buycatalog button.selectpro", function (e) {
    var $this = $(this);
    var ato = $("#labelHolder").data("ato");
    var rfo = $("#labelHolder").data("rfo");
    var item = $(this).closest("div.product");
    if (item.hasClass("selected")) {
      item.removeClass("selected");
      $this.html(ato);
    } else {
      item.addClass("selected");
      $this.html(rfo);
    }
    updateCartButton();
  });

  $(document).on("click", ".to-cart", function (e) {
    e.preventDefault();

    $("body").addClass("loading");
    var $this = $(this);
    var dataAdd = $this.attr("data-add");
    var oid = $this.data("oid");
    var goto = $this.data("goto");
    var method = $this.data("method");

    var products;
    try {
      products = JSON.parse(dataAdd);
    } catch (error) {
      products = [];
    }

    if (products.length > 0) {
      $.ajax({
        url: cwcAjax.ajaxurl,
        type: "POST",
        data: {
          action: "update_order_with_products",
          order_id: oid, // Pass the order ID
          products: products,
          goto: goto,
          method: method,
        },
        success: function (response) {
          if (response.success) {
            // alert('Order updated successfully!');
            if (goto == "complete") {
              $("body").addClass("order-state-complete");
              $("body").removeClass("order-state-final");
            }
            if (goto == "final") {
              $("body").addClass("order-state-final");
              $("body").removeClass("order-state-complete");
              $(".product.selected").each(function () {
                $(this).removeClass("selected"); // remove selected from added products.
              });
            }
            $("body").addClass("order-state-" + goto);
            updateOrderInfo(oid);
            $("body").removeClass("order-state-init");
            $("body").removeClass("order-state-pregled");
            $("body").removeClass("loading");
          } else {
            alert("Failed to update order.");
          }
        },
        error: function () {
          alert("An error occurred while updating the order.");
        },
      });
    } else {
      $("#straighttofinal").trigger("click");
      $("body").removeClass("loading");
    }
  });

  $(document).on("click", ".to-extra-cart", function (e) {
    e.preventDefault();

    var $this = $(this);
    var dataAdd = $this.attr("data-add");
    var oid = $this.data("oid");
    var goto = $this.data("goto");
    var method = $this.data("method");

    // Check if dataAdd is empty or null/undefined
    if (!dataAdd) {
      return false; // Exit if dataAdd is empty
    }

    $("body").addClass("loading");

    $("body").append(
      '<div style="left:0;" class="modalHolder"><div style="opacity:1;height:100%;padding:0;" class="modalwin subscrModal"><a href="#" class="closeCheckoutMod closeModAll">Close</a><div style="width:100%;height:100%;overflow:hidden;" class="iframe-container"><iframe id="checkout_iframe" class="loading" style="width:100%;height:100%;border: none;"></iframe></div></div></div>'
    );

    var products;
    try {
      products = JSON.parse(dataAdd);
    } catch (error) {
      products = [];
    }

    if (products.length > 0) {
      $.ajax({
        url: cwcAjax.ajaxurl,
        type: "POST",
        data: {
          action: "create_extra_order",
          order_id: oid, // Pass the order ID
          products: products,
          goto: goto,
          method: method,
        },
        success: function (response) {
          if (response.success) {
            // Load the custom checkout page in an iframe
            console.log(response.data.redirect_url);
            // $('#checkout_iframe').removeClass('loading');
            $("#checkout_iframe").attr("src", response.data.redirect_url);
          } else {
            console.log("Error:", response.data);
          }
        },
        error: function (xhr, status, error) {
          console.log("AJAX error:", error);
        },
      });
    } else {
      // $('#straighttofinal').trigger('click');
      // $('body').removeClass('loading');
    }
  });

  $(document).on("click", "#mmMenu", function (e) {
    e.preventDefault();
    $("body").toggleClass("showmm");
  });
  $(document).on("click", "#mmCart", function (e) {
    e.preventDefault();
    updateCartDisplay();
    $(".uwcc-open-cart-546612").click();
  });

  if ($("body").hasClass("is_mobile")) {
    $("#menu-headmenu li.current_cat").each(function () {
      $(this).addClass("expanded");
      $(this).parents("li").addClass("expanded");
    });
    $("#menu-headmenu .carot").on("click", function (event) {
      // Prevent the default link action
      event.preventDefault();
      event.stopPropagation();

      // Find the closest li element and toggle the expanded class
      var $li = $(this).closest("li");
      $li.toggleClass("expanded");
    });
  }

  $(".simple-cart-content").on("click", ".qty-plus, .qty-minus", function (e) {
    e.preventDefault();
    var cartKey = $(this).data("cart-key");
    var qtyInput = $('input[name="cart[' + cartKey + '][qty]"]');
    var currentQty = parseInt(qtyInput.val(), 10);
    var newQty = $(this).hasClass("qty-plus")
      ? currentQty + 1
      : Math.max(currentQty - 1, 1);

    // Update the quantity in the input box
    qtyInput.val(newQty);

    // Disable the minus button if the new quantity is 1
    var minusButton = qtyInput
      .closest(".simple-cart-content-line")
      .find(".qty-minus");
    if (newQty <= 1) {
      minusButton.prop("disabled", true);
    } else {
      minusButton.prop("disabled", false);
    }

    updateCart(cartKey, newQty);
  });

  $(".simple-cart-content").on("change", ".qty.text", function () {
    var cartKey = $(this).closest(".simple-cart-content-line").data("cart-key");
    var newQty = parseInt($(this).val(), 10);
    updateCart(cartKey, newQty);
  });

  $("body").on("click", ".add-to-cart-icon", function (e) {
    e.preventDefault();
    var productId = $(this).attr("data-product-id"); // Use attr to get the latest value
    var subscription = $(this).attr("data-subscription"); // Use attr to get the latest value
    var quantity = $(this).attr("data-quantity") || 1; // Using .attr() to ensure the latest value is fetched
    var offer = $(this).attr("data-offer");
    var price = $(this).attr("data-price");
    // console.log(price);

    // console.log('subscription ->' + subscription);
    if ($(this).closest(".uwcc-cart-popup").length > 0) {
      addToCart(productId, quantity, subscription, false, offer, price);
    } else {
      addToCart(productId, quantity, subscription);
    }
  });
  $("body").on("click", ".add_to_cart_button.ajax_add_to_cart", function (e) {
    e.preventDefault();
    var productId = $(this).attr("data-product_id"); // Use attr to get the latest value
    var subscription = ""; // Use attr to get the latest value
    var quantity = 1; // Using .attr() to ensure the latest value is fetched

    addToCart(productId, quantity, subscription);
  });
  /*
    function updateCart(cartKey, qty) {
        $.ajax({
            url: cwcAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'cwc_update_cart',
                cart_key: cartKey,
                quantity: qty,
                nonce: cwcAjax.nonce
            },
            success: function(response) {
                if (response.success) {
                    // alert('!!!');
                    console.log(response.data);
                    $('.simple-cart-content-line[data-cart-key="' + cartKey + '"] .qty.text').val(response.data.new_quantity);
                    $('.simple-cart-content-line[data-cart-key="' + cartKey + '"] .numHolder').html(response.data.new_quantity);
                    $('.simple-cart-content-line[data-cart-key="' + cartKey + '"] .product-total').html(response.data.new_total_html);
                    // $('.simple-cart-content-line[data-cart-key="' + cartKey + '"]').append('<button class="remove-item" data-cart-key="' + cartKey + '"></button>');
                    $('.shipping-free').html(response.data.free_shipping_message);
                    // Loop through subproducts and update their quantities
                    // console.log(response.data);
                    response.data.subproducts.forEach(function(subproduct) {
                        var subCartKey = subproduct.cart_item_key;
                        // updateCart(subCartKey, qty);  // Recursive call to update each subproduct
                    });                    
                } else {
                    alert('Could not update the cart. Please try again.');
                }
            },
            error: function() {
                alert('Error updating the cart.');
            }
        });
    }
    */
  function addToCart(
    productId,
    quantity,
    subscription = 0,
    openside = true,
    offer = "",
    price = ""
  ) {
    if (!openside) {
      $(".simple-cart-content .cart-content-ajax-wrapper").append(
        '<div id="sideLoader"><img src="/wp-content/plugins/nutrisslim-suite/assets/preloader-greybg.gif"></div>'
      );
    }
    $.ajax({
      url: cwcAjax.ajaxurl,
      type: "POST",
      data: {
        action: "cwc_add_to_cart",
        product_id: productId,
        quantity: quantity,
        subscription: subscription,
        offer: offer,
        price: price,
        nonce: cwcAjax.nonce,
      },
      success: function (response) {
        if (response.success) {
          // This is disabled due to issue with add to cart.
          updateCartDisplay();
          $(".shipping-free").html(response.data.free_shipping_message);
          if (openside) {
            $(".uwcc-open-cart-546612").click();
          } else {
            $("#sideLoader").remove();
          }
        } else {
          alert("Could not add the product to the cart. Please try again.");
        }
      },
      error: function (xhr) {
        alert("AJAX Error: " + xhr.responseText);
      },
    });
  }
  function updateCart(cartKey, qty) {
    $.ajax({
      url: cwcAjax.ajaxurl,
      type: "POST",
      data: {
        action: "cwc_update_cart",
        cart_key: cartKey,
        quantity: qty,
        nonce: cwcAjax.nonce,
      },
      success: function (response) {
        if (response.success) {
          console.log(response.data);
          $(
            '.simple-cart-content-line[data-cart-key="' +
              cartKey +
              '"] > .qtyBox .qty.text'
          ).val(response.data.new_quantity);
          $(
            '.simple-cart-content-line[data-cart-key="' +
              cartKey +
              '"] > .qtyBox .numHolder'
          ).html(response.data.new_quantity);
          $(
            '.simple-cart-content-line[data-cart-key="' +
              cartKey +
              '"] > .product-total'
          ).html(response.data.new_total_html);
          $(
            '.simple-cart-content-line[data-cart-key="' +
              cartKey +
              '"] > .toplevel_product span.bundlecontent'
          ).html(response.data.contentline);
          // $('.simple-cart-content-line[data-cart-key="' + cartKey + '"] > .toplevel_product .bundlecontent').html(response.data.listSubitems);
          // $('.simple-cart-content-line[data-cart-key="' + cartKey + '"]').append('<button class="remove-item" data-cart-key="' + cartKey + '"></button>');
          $(".shipping-free").html(response.data.free_shipping_message);
          // console.log(response.data.subproducts);
          /*
                    response.data.subproducts.forEach(function(subproduct) {
                        var subCartKey = subproduct.cart_item_key;
                        $('.simple-cart-content-line[data-cart-key="' + subCartKey + '"] > .qtyBox span.qtyHolder').html(subproduct.quantity);
                        $('.simple-cart-content-line[data-cart-key="' + subCartKey + '"] > .product-total').html(subproduct.price);
                        // updateCart(subCartKey, qty);  // Recursive call to update each subproduct
                    });
                    */
        } else {
          alert("Could not update the cart. Please try again.");
        }
      },
      error: function () {
        alert("Error updating the cart.");
      },
    });
  }

  function updateCartDisplay() {
    $.ajax({
      url: cwcAjax.ajaxurl,
      type: "POST",
      data: {
        action: "handle_ajax_update_full_cart",
        nonce: cwcAjax.nonce, // Assuming nonce is generated and passed to JS correctly
      },
      success: function (response) {
        // alert('!');
        // console.log(response);
        if (response.success) {
          // console.log(response);
          // Update the cart display
          $(".cart-content-ajax-wrapper").html(response.data); // Assuming server sends HTML to update the cart
          cartUpsell();
        } else {
          alert("Could not update the cart. Please try again.");
        }
      },
      error: function () {
        alert("Error updating the cart.");
      },
    });
  }
  $("body").on("click", "#cartIco a", function (e) {
    e.preventDefault();
    updateCartDisplay();
    // updateCart(cartKey, newQty);
    // $(".uwcc-open-cart-546612").click();
  });
  $("body").on("click", ".simple-cart-content-line .remove-item", function (e) {
    e.preventDefault();
    var line = $(this).closest(".simple-cart-content-line");
    var cartKey = $(this).data("cart-key");

    $.ajax({
      url: wc_cart_params.ajax_url,
      type: "POST",
      data: {
        action: "remove_item_from_cart",
        cart_key: cartKey,
      },
      success: function (response) {
        if (response.success) {
          if (response.data.empty_cart) {
            // If the cart is empty, remove all item lines
            $(".simple-cart-content-line").remove();
          } else {
            // Remove the specific item line
            line.remove();
          }

          // Update the free shipping message
          $(".shipping-free").html(response.data.free_shipping_message);

          // Optionally call other functions, like cartUpsell
          cartUpsell();
        } else {
          alert("Failed to remove item.");
        }
      },
      error: function () {
        alert("Error removing item.");
      },
    });
  });

  $(".media-content-subsection-single").each(function () {
    var $this = $(this);
    var content = $this.find("div.content-holder").text().trim();

    // Function to count the sentence terminators
    function countSentenceTerminators(text) {
      var matches = text.match(/[\.\?\!]/g);
      return matches ? matches.length : 0;
    }

    // Check if the content has exactly one sentence terminator and it ends with it
    var terminatorCount = countSentenceTerminators(content);
    var endsWithTerminator = /[\.\?\!]$/.test(content);

    if (terminatorCount === 1 && endsWithTerminator) {
      $this.addClass("contentTitle");
    }
  });
  // Toggle the visibility on clicking the heading
  $("body").on("click", "#order_review_heading_inner", function (e) {
    e.preventDefault();
    $(this).toggleClass("expanded");
    // var table = $('#shop_table_holder table.shop_table');
    /*
        if ($('#shop_table_holder').is(':visible')) {
            $('#shop_table_holder').animate({ opacity: 0 }, 100, function() {
                $(this).slideUp(300);
            });
        } else {
            $('#shop_table_holder').css('opacity', 0).slideDown(300, function() {
                $(this).animate({ opacity: 1 }, 100);
            });
        }
        */
  });
  $("body").on(
    "click",
    ".bundleproduct-item div.toplevel_product",
    function (e) {
      e.preventDefault();
      $(this).parent().toggleClass("showSubproducts");
    }
  );
  $(".single-post a.add-product-btn").each(function () {
    $(this).on("click", function (event) {
      event.preventDefault();
      var product = $("body").data("product");
      addToCart(product, 1);
    });
  });
  $("body").on("click", ".pomocHead", function (e) {
    e.preventDefault();
    $(this).toggleClass("open");
    $(".pomocList").toggleClass("open");
  });
  $("body").on("click", ".podjetjeHead", function (e) {
    e.preventDefault();
    $(this).toggleClass("open");
    $(".podjetjeList").toggleClass("open");
  });

  $(".mass-reviews .stars .star").on("click", function (e) {
    $(".mass-reviews .stars .star").removeClass("active");
    $(this).addClass("active");
    var rate = $(this).html();
    console.log(rate);

    $("#review_rating").val(rate);
  });

  $("#send_reviews:not(.disabled)").on("click", function () {
    $(this).attr("disabled", "disabled").addClass("disabled");
    $("div.review_fields").css("opacity", "0.5");

    var reviewProductIds     = $("#review_product_ids").val().split(",");
    var reviewRating         = $("#review_rating").val();
    var reviewText           = $("#review_text").val();
    var reviewCustomerEmail  = $("#review_customer_email").val();
    var reviewCustomerName   = $("#review_customer_name").val();
    var reviewNonce          = $("#review_nonce").val(); // ← NEW

    if (!reviewRating || !reviewText) {
      alert("Please provide a rating and a review.");
      return;
    }

    var data = {
      action: "submit_reviews",
      review_product_ids: reviewProductIds,
      review_rating: reviewRating,
      review_review: reviewText,
      review_customer_email: reviewCustomerEmail,
      review_customer_name: reviewCustomerName,
      review_nonce: reviewNonce // ← NEW
    };

    $.post(cwcAjax.ajaxurl, data, function (response) {
      if (response.success) {
        $("div.review_fields").css("opacity", "1");
        alert("Thank you for your review!");
      } else {
        alert("There was an error submitting your review. Please try again.");
      }
    });
  });

  // if (!window.location.href.includes("/landing/")) {
  //   if ($(window).width() > 767) {
  //     loadElementorTemplate("vitamins_subslide");
  //     loadElementorTemplate("sport_subslide");
  //     loadElementorTemplate("hujsanje_subslide");
  //     loadElementorTemplate("lepota_subslide");
  //     loadElementorTemplate("razstrupljanje_subslide");
  //   } else {
  //     loadElementorTemplate("mobileSwiper");
  //   }
  // }

  $("body").on("click", ".closeCheckoutMod", function (event) {
    event.preventDefault();
    $(this).closest(".modalHolder").remove(); // Remove the modal from the DOM
    $("body").removeClass("loading");
  });
});
function loadElementorTemplate(targetElementId) {
  $.ajax({
    url: cwcAjax.ajaxurl, // Using the localized ajaxurl
    method: "POST",
    data: {
      action: "load_elementor_template",
      target: targetElementId, // Pass the target element ID to PHP
    },
    success: function (response) {
      // Insert the content into the specified target element (e.g., #vitamins_subslide)
      $("#" + targetElementId).html(response);

      // Retrieve the widget ID from the newly loaded content
      var widgetId = $("#" + targetElementId + " .product-swiper").data(
        "widget-id"
      );

      // Dynamically call the Swiper initialization function for this specific widget
      if (typeof window[`initializeSwiper${widgetId}`] === "function") {
        window[`initializeSwiper${widgetId}`]();
      }
    },
    error: function (xhr, status, error) {
      console.log("AJAX Error: " + error);
    },
  });
}
// This should be moved to product
document.addEventListener("DOMContentLoaded", function () {
  function setIframeHeight() {
    const subsection = document.querySelector(
      ".elementor-widget-product_video_description .media-content-subsection"
    );
    if (subsection) {
      const iframe = subsection.querySelector("iframe");
      if (iframe) {
        if (window.innerWidth > 766) {
          const subsectionHeight = subsection.clientHeight;
          iframe.style.height = subsectionHeight + "px";
        } else {
          const subsectionWidth = subsection.clientWidth;
          const aspectHeight = (subsectionWidth * 9) / 16;
          iframe.style.height = aspectHeight + "px";
          iframe.style.width = subsectionWidth + "px";
        }
      } else {
        // console.error("No iframe found in subsection");
      }
    } else {
      //  console.error("No subsection found");
    }
  }

  // Set the iframe height initially
  setIframeHeight();

  // Optionally, adjust the iframe height on window resize
  window.addEventListener("resize", setIframeHeight);
});
/*
document.addEventListener('DOMContentLoaded', function() {
    let lastScrollTop = 0;
    const mobileMenu = document.querySelector('.mobileMenu');

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop < lastScrollTop || scrollTop <= 300) {
            // Scrolling up or within the top 100 pixels
            mobileMenu.style.transform = 'translateY(0)';
        } else {
            // Scrolling down
            mobileMenu.style.transform = 'translateY(100%)';
        }
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
    });
});
*/

function updateOrderInfo(orderID) {
  $.ajax({
    url: cwcAjax.ajaxurl,
    type: "POST",
    data: {
      action: "get_order_info",
      order_id: orderID,
    },
    success: function (response) {
      if (response.success) {
        $("#orderInfo").html(response.data.html);
      } else {
        alert("Failed to retrieve order information.");
      }
    },
    error: function () {
      alert("An error occurred while retrieving the order information.");
    },
  });
}

// JavaScript code to handle the countdown timer
// function startTimer(duration, display) {
//   var timer = duration,
//     minutes,
//     seconds;
//   var interval = setInterval(function () {
//     minutes = parseInt(timer / 60, 10);
//     seconds = parseInt(timer % 60, 10);
//
//     minutes = minutes < 10 ? "0" + minutes : minutes;
//     seconds = seconds < 10 ? "0" + seconds : seconds;
//
//     display.innerHTML =
//       '<div class="minutes timer-circle">' +
//       minutes +
//       '</div><div class="separator">:</div><div class="seconds timer-circle">' +
//       seconds +
//       "</div>";
//
//     if (--timer < 0) {
//       clearInterval(interval);
//       display.innerHTML =
//         '<div class="minutes timer-circle">00</div><div class="separator">:</div><div class="seconds timer-circle">00</div>';
//     }
//   }, 1000);
// }
//
// function startFirstCounter() {
//   var fiveMinutes = 60 * 5,
//     display = document.querySelector(".timer");
//   if (display) {
//     startTimer(fiveMinutes, display);
//   }
// }
//
// function startLastCounter() {
//   var sevenMinutes = 60 * 7,
//     display = document.querySelector(".lastoffer-timer");
//   if (display) {
//     startTimer(sevenMinutes, display);
//   }
// }
//
// window.onload = function () {
//   startFirstCounter();
// };

document.addEventListener("DOMContentLoaded", function () {
  const productsList = document.querySelectorAll(".products .product");

  productsList.forEach((product) => {
    const onSaleSpan = product.querySelector(".onsale");
    const imgWrapper = product.querySelector("img");

    if (imgWrapper && onSaleSpan) {
      const adjustFontSize = () => {
        const wrapperWidth = imgWrapper.offsetWidth;
        const fontSize = wrapperWidth * 0.08; // Adjust 0.08 to control scaling factor
        onSaleSpan.style.fontSize = fontSize + "px";
        onSaleSpan.style.width = fontSize * 4 + "px"; // Adjust 4 to control the width scaling factor
        onSaleSpan.style.height = fontSize * 4 + "px"; // Make the height equal to the width
        onSaleSpan.style.lineHeight = fontSize * 4 + "px"; // Center the text vertically
      };

      // Initial call to set the font size
      adjustFontSize();

      // Adjust font size on window resize
      window.addEventListener("resize", adjustFontSize);
    }
  });

  const swiperContainer = document.querySelector(".elementor-grid");

  swiperContainer.addEventListener("wheel", function (e) {
    if (Math.abs(e.deltaX) > Math.abs(e.deltaY)) {
      e.preventDefault();
      e.stopPropagation(); // Prevent native scroll behavior
      const deltaX = e.deltaX;
      const newScrollLeft = swiperContainer.scrollLeft + deltaX;

      swiperContainer.scrollLeft = newScrollLeft;
    }
  });
});


document.addEventListener("DOMContentLoaded", function () {
  if (document.body.classList.contains("is_not_mobile")) {
    const tabGroups = document.querySelectorAll(".e-n-tabs-wrapper");

    tabGroups.forEach((group) => {
      const tabs = group.querySelectorAll(".e-n-tab-title");
      const tabContents = group.querySelectorAll(".e-n-tabs-content > div");

      tabs.forEach((tab, index) => {
        tab.addEventListener("mouseover", function () {
          // Remove active from this group's tabs
          tabs.forEach((t) => t.setAttribute("aria-selected", "false"));
          tabContents.forEach((content) => content.classList.remove("e-active"));

          // Activate current tab and content
          this.setAttribute("aria-selected", "true");
          if (tabContents[index]) {
            tabContents[index].classList.add("e-active");
          }
        });
      });
    });
  }
});



document.addEventListener("DOMContentLoaded", function () {
  // Function to handle the checkout initiation event
  function pushInitiateCheckoutEvent(buttonSelector) {
    // Use event delegation to catch clicks on dynamically loaded elements
    document.addEventListener("click", function (e) {
      var element = e.target.closest(buttonSelector); // Check if the clicked element matches the selector

      if (element) {
        // e.preventDefault(); // Prevent default behavior of the link or button

        // Ensure dataLayer_content exists
        if (
          typeof dataLayer_content !== "undefined" &&
          dataLayer_content.cartContent
        ) {
          // Prepare the data for the event
          var eventData = {
            event: "initiate_checkout-2023",
            pagePostType: dataLayer_content.pagePostType,
            visitor_type: "unregistered-customer", // Update if necessary
            ecommerce: {
              payment_type: "stripe", // Modify if needed, or dynamically detect
              currency: dataLayer_content.cartContent.totals.currency || "EUR",
              value: dataLayer_content.cartContent.totals.total || 0,
              items: dataLayer_content.cartContent.items.map(function (item) {
                return {
                  item_id: item.item_id,
                  item_name: item.item_name,
                  price: item.price,
                  item_variant: item.sku,
                  quantity: item.quantity,
                  item_category: item.item_category,
                };
              }),
            },
          };

          // Push the event data to the dataLayer
          window.dataLayer = window.dataLayer || [];
          window.dataLayer.push(eventData);
          // console.log("Event pushed to dataLayer:", eventData);

          /*
                    // Perform the correct action after the event is pushed
                    setTimeout(function () {
                        if (element.tagName === 'A') {
                            // For links (A tag), redirect to the href URL
                            var href = element.getAttribute('href');
                            if (href && href !== '#') {
                                window.location.href = href; // Redirect to the link's href
                            }
                        } else if (element.tagName === 'BUTTON') {
                            // For buttons, submit the form if it's inside one
                            var form = element.closest('form');
                            if (form) {
                                form.submit(); // Submit the form after the event is pushed
                            }
                        }
                    }, 200); // Optional delay to let dataLayer push complete
                    */
        }
      }
    });
  }

  // Set up the event listeners for each button and link
  pushInitiateCheckoutEvent(".single-landing-page button#place_order"); // One-page checkout button
  pushInitiateCheckoutEvent(".gotoCheckout a.org-btn"); // Regular page button
});

/*
document.addEventListener('DOMContentLoaded', function () {
    
    // Function to push dataLayer event for checkout initiation
    function pushInitiateCheckoutEvent(buttonSelector) {
        var button = document.querySelector(buttonSelector);

        if (!button) return; // Button doesn't exist on this page


        button.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default behavior of the button

            // Ensure dataLayer_content exists
            if (typeof dataLayer_content !== 'undefined' && dataLayer_content.cartContent) {
                // Prepare the data for the event
                var eventData = {
                    event: 'initiate_checkout-2023',
                    pagePostType: dataLayer_content.pagePostType,
                    visitor_type: 'unregistered-customer', // Update if necessary
                    ecommerce: {
                        payment_type: 'stripe', // Modify if needed, or dynamically detect
                        currency: dataLayer_content.cartContent.totals.currency || 'GBP',
                        value: dataLayer_content.cartContent.totals.total || 0,
                        items: dataLayer_content.cartContent.items.map(function (item) {
                            return {
                                item_id: item.item_id,
                                item_name: item.item_name,
                                price: item.price,
                                item_variant: item.sku,
                                quantity: item.quantity,
                                item_category: item.item_category
                            };
                        })
                    }
                };
                
                // Push the event data to the dataLayer
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push(eventData);
                console.log('Event pushed to dataLayer:', eventData);

                // Trigger default button action after event has been pushed
                setTimeout(function () {
                    window.location.href = button.getAttribute('href') || '#';
                }, 200); // Optional delay to let dataLayer push complete
            }
        });
    }

    // Set up the event listeners for each button
    pushInitiateCheckoutEvent('.single-landing-page button#place_order');  // One-page checkout button
    pushInitiateCheckoutEvent('.gotoCheckout a.org-btn');  // Regular page button

}); 
*/

function startTimer(
    duration,
    display,
    hideElements,
    startTimeKey,
    expiredKey,
    orderKey,
    currentOrderId,
    callback
) {
  var storedOrderId = localStorage.getItem(orderKey);
  var storedStartTime = localStorage.getItem(startTimeKey);
  var isExpired = localStorage.getItem(expiredKey);

  //If the order ID has changed, reset timer
  if (!storedOrderId || storedOrderId !== currentOrderId) {
    console.log(
        "🔄 New order or no order found. Resetting timer. Old:",
        storedOrderId,
        "New:",
        currentOrderId
    );
    localStorage.setItem(orderKey, currentOrderId);
    localStorage.setItem(startTimeKey, Date.now());
    localStorage.removeItem(expiredKey);

    storedStartTime = Date.now();
    isExpired = null;
  } else {
    console.log("✅ Continuing existing order:", storedOrderId);
  }

  //Use stored time if available, otherwise set new start time
  var startTime = storedStartTime ? parseInt(storedStartTime, 10) : Date.now();
  if (!storedStartTime) {
    localStorage.setItem(startTimeKey, startTime);
  }

  // ⏳ If the timer already expired, move to next step immediately
  if (isExpired) {
    hideElements.forEach((selector) => {
      let element = document.querySelector(selector);
      if (element) element.style.display = "none";
    });
    if (typeof callback === "function") callback();
    return;
  }

  function updateTimer() {
    var elapsedTime = Math.floor((Date.now() - startTime) / 1000);
    var remainingTime = duration - elapsedTime;

    // If time runs out, hide elements and move to next step
    if (remainingTime <= 0) {
      clearInterval(interval);
      hideElements.forEach((selector) => {
        let element = document.querySelector(selector);
        if (element) element.style.display = "none";
      });

      // Set timer display to 00:00
      display.innerHTML =
          '<div class="minutes timer-circle">00</div><div class="separator">:</div><div class="seconds timer-circle">00</div>';

      //Mark timer as expired
      localStorage.setItem(expiredKey, "true");

      // Move to next step
      if (typeof callback === "function") callback();
      return;
    }

    var minutes = Math.floor(remainingTime / 60);
    var seconds = remainingTime % 60;

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display.innerHTML =
        '<div class="minutes timer-circle">' +
        minutes +
        '</div><div class="separator">:</div><div class="seconds timer-circle">' +
        seconds +
        "</div>";
  }

  var interval = setInterval(updateTimer, 1000);
  updateTimer();
}

function startPurchaseFlow() {
  var firstOfferDuration = 60 * 10;
  var lastOfferDuration = 60 * 5;

  var firstOfferDisplay = document.querySelector(
      ".timer-after-purchase .timer"
  );
  var lastOfferDisplay = document.querySelector(".lastoffer-timer");

  var orderElement = document.querySelector(".note");
  if (!orderElement) {
    console.error("Order element '.note' not found!");
    return;
  }
  var currentOrderId = orderElement.getAttribute("data-order-id");

  /**
   * --------------------------------------------------------------------
   * A) If the last-offer localStorage belongs to a DIFFERENT order ID,
   *    clear it so we do NOT skip directly to the last offer on a new order.
   * --------------------------------------------------------------------
   */
  const storedLastOfferOrderId = localStorage.getItem("lastOfferOrderId");
  if (storedLastOfferOrderId && storedLastOfferOrderId !== currentOrderId) {
    localStorage.removeItem("lastOfferTimerStart");
    localStorage.removeItem("lastOfferTimerExpired");
    localStorage.removeItem("lastOfferOrderId");
  }

  /**
   * --------------------------------------------------------------------
   * B) Now check if the LAST offer timer is already running & not expired.
   *    If so, SKIP the first-offer timer (so it won't re-run on refresh).
   * --------------------------------------------------------------------
   */
  const lastOfferStarted = localStorage.getItem("lastOfferTimerStart");
  const lastOfferExpired = localStorage.getItem("lastOfferTimerExpired");

  if (lastOfferStarted && !lastOfferExpired) {
    console.log("Last-offer timer is in progress. Skipping the first offer…");
    showLastOffer();
    return; // Skip all first-offer logic
  }

  // -----------------------------------------------------------------
  // Start the FIRST offer timer if not already in last-offer step
  // -----------------------------------------------------------------
  if (firstOfferDisplay && currentOrderId) {
    console.log("first timer");
    startTimer(
        firstOfferDuration,
        firstOfferDisplay,
        [".timer-after-purchase", ".initial-offer"],
        "purchaseTimerStart",
        "purchaseTimerExpired",
        "purchaseOrderId",
        currentOrderId,
        showLastOffer // Called when the first timer runs out
    );
  } else {
    console.error("First offer timer display not found!");
  }

  // ================================================================
  // showLastOffer()
  // ================================================================
  function showLastOffer() {
    document.querySelector(".initial-offer").style.display = "none";
    document.querySelector(".timer-after-purchase").style.display = "none";

    // If you want to ALWAYS restart the timer each time this runs, uncomment:
    // localStorage.removeItem("lastOfferTimerExpired");

    let lastOfferSection = document.querySelector(".last-offer");
    let lastOfferTimerContainer = document.querySelector(
        ".col.timer-after-purchase"
    );
    let lastOfferTimerDisplay = document.querySelector(".lastoffer-timer");

    let orderElement = document.querySelector(".note");
    let currentOrderId = orderElement
        ? orderElement.getAttribute("data-order-id")
        : null;

    if (lastOfferSection) {
      lastOfferSection.style.display = "block"; // Ensure last offer is visible
      lastOfferSection.classList.add("force-show");
    } else {
      console.error("last-offer section not found!");
    }

    if (lastOfferTimerContainer) {
      lastOfferTimerContainer.style.display = "block"; // Ensure timer container is visible
      lastOfferTimerContainer.classList.add("force-show");
    } else {
      console.error("timer-after-purchase not found!");
    }

    if (lastOfferTimerDisplay) {
      // Only set "05:00" if you want a default each time.
      // The timer script updates within a second anyway.
      lastOfferTimerDisplay.innerHTML = `
          <div class="minutes timer-circle">05</div>
          <div class="separator">:</div>
          <div class="seconds timer-circle">00</div>
      `;
    }

    // Start the last-offer timer properly
    if (lastOfferDisplay && currentOrderId) {
      console.log("Last timer");
      startTimer(
          lastOfferDuration,
          lastOfferTimerDisplay,
          [".last-offer", ".timer-after-purchase"],
          "lastOfferTimerStart",
          "lastOfferTimerExpired",
          "lastOfferOrderId",
          currentOrderId,
          showOrderDetails
      );
    }
  }

  // ================================================================
  // showOrderDetails()
  // ================================================================
  function showOrderDetails() {
    document.querySelector(".last-offer").style.display = "none";
    let lastOffer = document.querySelector(".last-offer");
    lastOffer.classList.remove("force-show");
    let orderDetails = document.querySelector(".finalNote");
    let lastOfferOrderDeatails = document.querySelector(
        "section.order-details"
    );
    let note = document.querySelector(".mobitelbabes");
    document.querySelector(".last-offer").style.display = "none !important";

    if (lastOffer) lastOffer.style.display = "none";
    if (note) note.style.display = "none";

    if (orderDetails) {
      orderDetails.style.removeProperty("display"); // Ensure it's visible
      orderDetails.classList.add("force-show"); // Add force-show
      if (lastOffer) lastOffer.classList.remove("force-show");
      if (lastOffer) lastOffer.style.removeProperty("display");
      if (lastOfferOrderDeatails)
        lastOfferOrderDeatails.classList.add("force-show");
    } else {
      console.error("Order details section not found!");
    }
  }

  // ================================================================
  // CLICK HANDLERS
  // ================================================================

  // "Skip to last offer"
  document.querySelectorAll(".gotopregled.init").forEach(function (button) {
    button.addEventListener("click", function () {
      showLastOffer();
    });
  });

  // "Decline": show order details
  document
      .querySelectorAll("#straighttofinal, .gotopregled.init")
      .forEach((button) => {
        button.addEventListener("click", function () {
          localStorage.setItem("purchaseTimerExpired", "true");
          localStorage.setItem("lastOfferTimerExpired", "true");
          showLastOffer();
        });
      });

  // Close the last offer manually
  document
      .querySelectorAll(".last-offer .close, .gotopregled.final")
      .forEach((button) => {
        button.addEventListener("click", function () {
          localStorage.setItem("lastOfferTimerExpired", "true");
          document.querySelector(".last-offer").style.display = "none !important";
          showOrderDetails();
        });
      });

  // Add product from the initial offer
  document.querySelectorAll(".getDone .to-cart").forEach((button) => {
    button.addEventListener("click", function () {
      // Hide first-offer elements
      document
          .querySelectorAll(".timer-after-purchase, .initial-offer")
          .forEach((el) => {
            el.style.display = "none";
          });
      showLastOffer();
    });
  });

  // Add product from the last offer
  document.querySelectorAll(".final-offer-cart").forEach((button) => {
    button.addEventListener("click", function () {
      document.querySelectorAll(".last-offer").forEach((el) => {
        el.style.display = "none !important";
      });
      showOrderDetails();
    });
  });
}

// Finally, run it on DOMContentLoaded
document.addEventListener("DOMContentLoaded", function () {
  if (document.body.classList.contains('woocommerce-order-received')) {
    startPurchaseFlow();
  }
});

