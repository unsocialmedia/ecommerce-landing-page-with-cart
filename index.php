<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Threaded</title>

    <!-- Main Style Sheet -->
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
    include_once 'navigation.php';
    include_once './components/landing-page/landing-page.php';
    include_once 'footer.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var totalAmount = localStorage.getItem("totalAmount") ?
                localStorage.getItem("totalAmount") : localStorage.setItem("totalAmount", 0);
            var totalQty = localStorage.getItem("totalQty") ?
                localStorage.getItem("totalQty") : localStorage.setItem("totalQty", 0);
            console.log(localStorage.getItem("totalAmount"));
            console.log(localStorage.getItem("totalQty"));
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
                    var html = 
                    `<div class="nav__cart-item" id="${image}">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="nav__item-image" src="./assets/index/${image}.jpg" alt="${image}" >
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
                    $(html).prependTo("#nav__cart-items");
                }

                renderElementReplace({name, description, image, price, qty}) {
                    var html = 
                    `<div class="nav__cart-item" id="${image}">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="nav__item-image" src="./assets/index/${image}.jpg" alt="${image}" >
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
                    $( `div#${image}` ).replaceWith( html );
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
                    var html = `<div class="nav__cart-total"><p>My Bag (${totalQty})</p><p>$ ${totalAmount}</p></div>`;
                    $( 'div.nav__cart-total' ).replaceWith( html );
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
                console.log(id)
                var name = $(`#item-name-${id}`).val();
                var description = $(`#item-description-${id}`).val();
                var image = $(`#item-image-${id}`).val();
                var price = $(`#item-price-${id}`).val();

                var cart = new Cart();
                var newItem = cart.updateLocal(name, description, image, price, 1);
            });
        });
    </script>
</body>

</html>