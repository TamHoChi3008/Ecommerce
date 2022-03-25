<!-- <div class="adverts">
    <span>15% off your first purchase</span>
  </div> -->

  <header id="home" class="header"  >
    <div class="navbar fixed-top" style="box-shadow: 0 5px #888888; ">
      <div class="top" style="font-size: 15px;">
        <a href="/">Home</a>
        <a href="/">About</a>
        <a href="/order-tracker">Order tracker</a>
        <a href="/">Newletters Signup</a>
        <?php
          $name = Session::get('user_name');
          $id = Session::get('user_id');
          if (isset($name) && isset($id)) {
          ?>
          <a href="/my-account?id={{$id}}">Welcome {{$name}}</a>
          <?php } else {
          ?>
          <a href="/login-account">Login</a>
          <?php } ?>
      </div>
      <div class="bottom">
          <div class="logo">
            <a href="/"><img src="./back-end/img/slide/logo.png" alt="GREEN HOME" width="60px"></a>
          </div>
          <nav id="navbar1" class="navbar1">
            <ul>
              <li class="dropdown"><a href="/Ban"><span>Bàn</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  @foreach($Ban_catalog as $key => $Ban)
                  <li><a href="/{{Str::slug($Ban->catalog_name)}}">{{$Ban->catalog_name}}</a></li>
                  @endforeach
                </ul>
              </li>
              <li class="dropdown"><a href="/Ghe"><span>Ghế</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                @foreach($Ghe_catalog as $key => $Ghe)
                  <li><a href="/{{Str::slug($Ghe->catalog_name)}}">{{$Ghe->catalog_name}}</a></li>
                  @endforeach
                </ul>
              </li>
              <li class="dropdown"><a href="/Tu"><span>Tủ</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                @foreach($Tu_catalog as $key => $Tu)
                  <li><a href="/{{Str::slug($Tu->catalog_name)}}">{{$Tu->catalog_name}}</a></li>
                  @endforeach
                </ul>
              </li>
              <li class="dropdown"><a href="/SOFA"><span>SOFA</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                @foreach($SOFA_catalog as $key => $SOFA)
                  <li><a href="/{{Str::slug($SOFA->catalog_name)}}">{{$SOFA->catalog_name}}</a></li>
                  @endforeach
                </ul>
              </li>
            </ul>
            
          </nav>
          <div class="nav-items">
            <div class="search">
              <form action="/search" method="get">
                <input type="search" name="search" id="" placeholder="Search" required>
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
              </form>
            </div>
            <a href="/view-cart"><i class="fas fa-shopping-cart"></i></a>
          </div>
        </div>
      </div>
      </div>
    </header> 