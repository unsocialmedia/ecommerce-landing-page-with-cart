$(document).ready(function() {
    $(".cart").hide();
    $(".landing-page").show();

    localStorage.getItem("totalAmount") ?
        localStorage.getItem("totalAmount") : localStorage.setItem("totalAmount", 0);
    localStorage.getItem("totalQty") ?
        localStorage.getItem("totalQty") : localStorage.setItem("totalQty", 0);

    class Cart {
        constructor(name, desc, image, price) {
            this.name = name;
            this.desc = desc;
            this.image = image;
            this.price = price;
        }

        initialProcess(item) {
            if (item) {
                var totalAmount = localStorage.getItem("totalAmount");
                var totalQty = localStorage.getItem("totalQty");

                this.renderElementPrepend(item);
                this.replaceTotal(totalQty, totalAmount);
            }
        }

        renderElementPrepend({name, description, image, price, qty}) {
            var miniCartHtml = 
            `<div class="nav__cart-item" id="${image}">
                <div class="row">
                    <div class="col-md-4">
                        <img class="nav__item-image" src="./assets/images/index/${image}.jpg" alt="${image}" >
                    </div>
                    <div class="col-md-8 nav__cart-details">
                        <p>${name}</p>
                        <span>${description}</span><br><br>
                        <span>Size: S</span><br>
                        <span>Color: Multicolor</span><br>
                        <span>Qty: ${qty}</span><br><br>
                        <span>Price: $${price}</span>
                    </div>
                </div>
            </div>`;
            var cartHtml = 
            `<tr id="${image}">
                <th scope="row">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="cart__item-image" src="././assets/images/index/${image}.jpg" alt="${image}" />
                        </div>
                        <div class="col-md-8 cart__list-content">
                            <p>${name}</p>
                            <span>${description}</span>
                            <span>Size: S, Color, Multicolor, Qty: ${qty}</span><br><br><br>
                            <div class="cart__item-actions">
                                <a href="#">save for later</a>
                                <a href="#">move to favorites</a>
                                <a href="#" id="remove-btn" data-datac="${image}">remove</a>
                                <a href="#">edit</a>
                            </div>
                        </div>
                    </div>
                </th>
                <td>$ ${price}</td>
            </tr>`;
            $(miniCartHtml).prependTo("#nav__cart-items");
            $(cartHtml).prependTo("#cart__items");
        }

        renderElementReplace({name, description, image, price, qty}) {
            var miniCartHtml = 
            `<div class="nav__cart-item" id="${image}">
                <div class="row">
                    <div class="col-md-4">
                        <img class="nav__item-image" src="./assets/images/index/${image}.jpg" alt="${image}" >
                    </div>
                    <div class="col-md-8 nav__cart-details">
                        <p>${name}</p>
                        <span>${description}</span><br><br>
                        <span>Size: S</span><br>
                        <span>Color: Multicolor</span><br>
                        <span>Qty: ${qty}</span><br><br>
                        <span>Price: $${price}</span>
                    </div>
                </div>
            </div>`;
            var cartHtml = 
            `<tr id="${image}">
                <th scope="row">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="cart__item-image" src="././assets/images/index/${image}.jpg" alt="${image}" />
                        </div>
                        <div class="col-md-8 cart__list-content">
                            <p>${name}</p>
                            <span>${description}</span>
                            <span>Size: S, Color, Multicolor, Qty: ${qty}</span><br><br><br>
                            <div class="cart__item-actions">
                                <a href="#">save for later</a>
                                <a href="#">move to favorites</a>
                                <a href="#" id="remove-btn" data-datac="${image}">remove</a>
                                <a href="#">edit</a>
                            </div>
                        </div>
                    </div>
                </th>
                <td>$ ${price}</td>
            </tr>`;
            $( `div#${image}` ).replaceWith( miniCartHtml );
            $( `tr#${image}` ).replaceWith( cartHtml );
        }

        removeItem(id) {
            var item = JSON.parse(localStorage.getItem(id));
            var totalAmount = localStorage.getItem("totalAmount");
            var totalQty = localStorage.getItem("totalQty");

            var price = Number(totalAmount) - Number(item.price);
            var qty = Number(totalQty) - Number(item.qty);
            
            localStorage.removeItem(id);
            
            $( `div#${id}` ).remove();
            $( `tr#${id}` ).remove();

            this.replaceTotal(qty, price);
        }

        updateLocal(name, desc, image, price, qty) {
            var item = JSON.parse(localStorage.getItem(image));
            var totalAmount = localStorage.getItem("totalAmount");
            var totalQty = localStorage.getItem("totalQty");

            // Total
            totalAmount = Number(totalAmount) + Number(price);
            localStorage.setItem("totalAmount", totalAmount);
            totalQty = Number(totalQty) + Number(qty);
            localStorage.setItem("totalQty", totalQty);

            // Per Item
            var price = item ? Number(price) + Number(item.price) : price;
            var qty = item ? Number(qty) + Number(item.qty) : qty;
            localStorage.setItem(image, JSON.stringify({
                name: name,
                description: desc,
                image: image,
                price: price,
                qty: qty
            }));

            var newData = JSON.parse(localStorage.getItem(image));

            if($(`div#${image}`).length){
                this.renderElementReplace(newData);
            }else{
                this.renderElementPrepend(newData);
            }
            this.replaceTotal(totalQty, totalAmount);
        }

        replaceTotal(totalQty, totalAmount){
            var miniCartHtml = `<div class="nav__cart-total"><p>My Bag (${totalQty})</p><p>$ ${totalAmount}</p></div>`;
            var cartHtml = 
            `<div class="container cart__summary">
                <div class="flexbox">
                    <span>Subtotal (${totalQty})</span><span>$ ${totalAmount}</span>
                </div><br>
                <div class="flexbox">
                    <span>Free Shipping! <a href="">details</a></span><span>$ 0.00</span>
                </div><br><br>
                <div class="cart__total">
                    <div class="flexbox">
                        <span>Estimated Total</span><span>$ ${totalAmount}</span>
                    </div>
                </div>
            </div>`;
            var cartHtml2 = `<h4 class="cart__bag-total">Shopping Bag (${totalQty})</h4>`;
            $( 'div.nav__cart-total' ).replaceWith( miniCartHtml );
            $( 'div.cart__summary' ).replaceWith( cartHtml );
            $( 'h4.cart__bag-total' ).replaceWith( cartHtml2 );
        }
    }

    var items = ['recent1', 'recent2', 'recent3', 'recent4', 'recent5'];

    items.map((item) => {
        var theItem = JSON.parse(localStorage.getItem(item))
        var cart = new Cart();
        cart.initialProcess(theItem);
    });

    $("form").submit(function(){
        event.preventDefault();

        var form = $(this);
        var id = form.attr('id');
        var name = $(`#item-name-${id}`).val();
        var description = $(`#item-description-${id}`).val();
        var image = $(`#item-image-${id}`).val();
        var price = $(`#item-price-${id}`).val();

        var cart = new Cart();
        var newItem = cart.updateLocal(name, description, image, price, 1);
    });

    $('#remove-btn').click(function() {
        var id = $(this).data('datac');
        var cart = new Cart();
        cart.removeItem(id);
    });

    $('.open-cart').click(function() {
        $(".cart").show();
        $(".landing-page").hide();
    });

    $('.close-cart').click(function() {
        $(".cart").hide();
        $(".landing-page").show();
    });
});