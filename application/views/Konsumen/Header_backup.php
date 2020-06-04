<body>
  <div class="container_12">
    <div id="top">
      <div class="grid_3">
        <div class="phone_top">
          <span>Call Us +777 (100) 1234</span>
        </div><!-- .phone_top -->
      </div><!-- .grid_3 -->

      <div class="grid_6">
        <div class="welcome">
          Welcome visitor you can <a href="<?=base_url()?>Konsumen/index">login</a> or <a href="<?=base_url()?>Konsumen/Register">create an account</a>.
        </div><!-- .welcome -->
      </div><!-- .grid_6 -->

      <div class="grid_3">
        <div class="valuta">
          <ul>
            <li class="curent"><a href="#">$</a></li>
            <li><a href="#">&#8364;</a></li>
            <li><a href="#">&#163;</a></li>
          </ul>
        </div><!-- .valuta -->

        <div class="lang">
          <ul>
            <li class="curent"><a href="#">EN</a></li>
            <li><a href="#">FR</a></li>
            <li><a href="#">GM</a></li>
          </ul>
        </div><!-- .lang -->
      </div><!-- .grid_3 -->
    </div><!-- #top -->

    <div class="clear"></div>

    <header id="branding">
      <div class="grid_3">
        <hgroup>
          <h1 id="site_logo"><a href="/" title=""><img src="<?=base_url()?>assets/konsumen/images/logo.png" alt="Online Store Theme Logo"/></a></h1>
          <h2 id="site_description">Online Store Theme</h2>
        </hgroup>
      </div><!-- .grid_3 -->
      
      <div class="grid_3">
        <form class="search">
          <input type="text" name="search" class="entry_form" value="" placeholder="Search entire store here..."/>
        </form>
      </div><!-- .grid_3 -->
      
      <div class="grid_6">
        <ul id="cart_nav">
          <li>
            <a class="cart_li" href="/shopping_cart.html">Cart <span>$0.00</span></a>
            <ul class="cart_cont">
              <li class="no_border"><p>Recently added item(s)</p></li>
              <li>
                <a href="/product_page.html" class="prev_cart"><div class="cart_vert"><img src="<?=base_url()?>assets/konsumen/images/cart_img.png" alt="" title="" /></div></a>
                <div class="cont_cart">
                  <h4>Caldrea Linen and Room Spray</h4>
                  <div class="price">1 x $399.00</div>
                </div>
                <a title="close" class="close" href="#"></a>
                <div class="clear"></div>
              </li>
              
              <li>
                <a href="/product_page.html" class="prev_cart"><div class="cart_vert"><img src="<?=base_url()?>assets/konsumen/images/produkt_slid1.png" alt="" title="" /></div></a>
                <div class="cont_cart">
                  <h4>Caldrea Linen and Room Spray</h4>
                  <div class="price">1 x $399.00</div>
                </div>
                <a title="close" class="close" href="#"></a>
                <div class="clear"></div>
              </li>
              <li class="no_border">
                <a href="/shopping_cart.html" class="view_cart">View shopping cart</a>
                <a href="/checkout.html" class="checkout">Procced to Checkout</a>
              </li>
            </ul>
          </li>
        </ul>
        
        <nav class="private">
          <ul>
            <li><a href="#">My Account</a></li>
            <li class="separator">|</li>
            <li><a href="#">My Wishlist</a></li>
            <li class="separator">|</li>
            <li><a href="<?=base_url()?>Konsumen/index">Log In</a></li>
            <li class="separator">|</li>
            <li><a href="<?=base_url()?>Konsumen/Register">Sign Up</a></li>
          </ul>
        </nav><!-- .private -->        
      </div><!-- .grid_6 -->
    </header><!-- #branding -->
  </div><!-- .container_12 -->
  
  <div class="clear"></div>
  
  <div id="block_nav_primary">
    <div class="container_12">
      <div class="grid_12">
        <nav class="primary">
          <ul>
            <li><a href="<?=base_url()?>Konsumen/Home">Home</a></li>
            <li><a href="<?=base_url()?>Konsumen/Umkm/semua">UMKM</a></li>
            <li><a href="<?=base_url()?>Konsumen/Produk/semua">Produk</a></li>
            <li><a href="<?=base_url()?>Konsumen/Informasi">Informasi UMKM</a></li>
            <li><a href="<?=base_url()?>Konsumen/About">Tentang Kami</a></li>
          </ul>
        </nav><!-- .primary -->
      </div><!-- .grid_12 -->
    </div><!-- .container_12 -->
  </div><!-- .block_nav_primary -->
