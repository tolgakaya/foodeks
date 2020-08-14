(function () {
	// Add to Cart Interaction - by CodyHouse.co
	var cart = document.getElementsByClassName('js-cd-cart');
	if (cart.length > 0) {
		var cartAddBtns = document.getElementsByClassName('js-cd-add-to-cart'),
			cartBody = cart[0].getElementsByClassName('cd-cart__body')[0],

			cartTimeoutId = false,
			animatingQuantity = false;
		initCartEvents();


		function initCartEvents() {
			// add products to cart
			for (var i = 0; i < cartAddBtns.length; i++) {
				(function (i) {
					cartAddBtns[i].addEventListener('click', addToCart);
				})(i);
			}

			// open/close cart
			cart[0].getElementsByClassName('cd-cart__trigger')[0].addEventListener('click', function (event) {
				event.preventDefault();
				toggleCart();
			});

			cart[0].addEventListener('click', function (event) {
				if (event.target == cart[0]) { // close cart when clicking on bg layer
					toggleCart(true);
				} else if (event.target.closest('.cd-cart__delete-item')) { // remove product from cart
					event.preventDefault();
					removeProduct(event.target.closest('.cd-cart__product'));
				}
			});

		};

		function addToCart(event) {
			event.preventDefault();

		};

		function toggleCart(bool) { // toggle cart visibility
			var cartIsOpen = (typeof bool === 'undefined') ? Util.hasClass(cart[0], 'cd-cart--open') : bool;

			if (cartIsOpen) {
				Util.removeClass(cart[0], 'cd-cart--open');
				//reset undo
				if (cartTimeoutId) clearInterval(cartTimeoutId);
				// Util.removeClass(cartUndo, 'cd-cart__undo--visible');
				// removePreviousProduct(); // if a product was deleted, remove it definitively from the cart

				setTimeout(function () {
					cartBody.scrollTop = 0;
					//check if cart empty to hide it
					// if (Number(cartCountItems[0].innerText) == 0) Util.addClass(cart[0], 'cd-cart--empty');
				}, 500);
			} else {
				Util.addClass(cart[0], 'cd-cart--open');
			}
		};


	}
})();