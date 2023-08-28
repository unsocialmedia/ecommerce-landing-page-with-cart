<nav class="navbar d-none d-lg-flex d-xl-flex d-xxl-flex">
    <div class="navbar-left">
        <a class="active" href="#women">Women</a>
        <a href="#plus">Plus</a>
        <a href="#men">Men</a>
        <a href="#accessories">Accessories</a>
    </div>
    <div class="navbar-logo">
        <a href="#logo"><img src="./assets/index/Logo.svg" alt="Threaded Logo" /></a>
    </div>
    <div class="navbar-right">
        <a href="#user"><img src="./assets/index/bx_bx-user.svg" alt="User Icon" /></a>
        <a href="#shopping"><img src="./assets/index/bx_bx-shopping-bag.svg" alt="Shopping Bag Icon" /></a>
        <a href="#heart"><img src="./assets/index/bx_bx-heart.svg" alt="Heart Icon" /></a>
        <a href="#support"><img src="./assets/index/bx_bx-support.svg" alt="Support Icon" /></a>
        <a href="#search"><img src="./assets/index/bx_bx-search.svg" alt="Search Icon" /></a>
        <div class="navbar-dropdown">
            <img src="./assets/index/US Flag.svg" alt="Search Icon" />
            <p>USD $</p>
            <a href="#more"><img src="./assets/index/Vector.svg" alt="Search Icon" /></a>
            <div class="dropdown-content">
                <a href="#item1">Item 1</a>
                <a href="#item2">Item 2</a>
                <a href="#item3">Item 3</a>
            </div>
        </div>
    </div>
</nav>

<div class="container d-block d-lg-none d-xl-none d-xxl-none">
    <div class="navbar-right">
        <a href="#user"><img src="./assets/index/bx_bx-user.svg" alt="User Icon" /></a>
        <a href="#shopping"><img src="./assets/index/bx_bx-shopping-bag.svg" alt="Shopping Bag Icon" /></a>
        <a href="#heart"><img src="./assets/index/bx_bx-heart.svg" alt="Heart Icon" /></a>
        <a href="#support"><img src="./assets/index/bx_bx-support.svg" alt="Support Icon" /></a>
        <a href="#search"><img src="./assets/index/bx_bx-search.svg" alt="Search Icon" /></a>
        <div class="navbar-dropdown">
            <img src="./assets/index/US Flag.svg" alt="Search Icon" />
            <p>USD $</p>
            <a href="#more"><img src="./assets/index/Vector.svg" alt="Search Icon" /></a>
            <div class="dropdown-content">
                <a href="#item1">Item 1</a>
                <a href="#item2">Item 2</a>
                <a href="#item3">Item 3</a>
            </div>
        </div>
    </div>
</div>
<nav class="navbar nav-mobile d-block d-lg-none d-xl-none d-xxl-none">
        <a href="#logo"><img src="./assets/index/Logo.svg" alt="Threaded Logo" /></a>
        <div class="mobile-navbar-menus">
            <a class="active" href="#women">Women</a>
            <a href="#plus">Plus</a>
            <a href="#men">Men</a>
            <a href="#accessories">Accessories</a>
        </div>
</nav>

<script>
    $(document).ready(function() {
        $('.navbar-toggler').on('click', function() {
            $('.navbar-collapse').toggleClass('show');
        });
    });
</script>

</body>

</html>