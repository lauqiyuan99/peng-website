@inject('theme', 'App\Http\Controllers\User\ThemeController')
<style>
  .nav-link:hover ,.dropdown-item:hover, .btn_hover:hover{
    color: #ffffff;
    background-color: {{ $theme->secondColor()->value }};
  }
  .dropdown-menu{
    margin-top: -5px;
  }
  .navbar{
    padding: 0  !important;
    height: 50px;
  }
  .nav-link {
    padding: 13px;
    padding-left :20px !important;
    padding-right :20px !important;
  }
  .navbar-brand{
    padding-left: 20px;
  }
  @media (min-width: 992px)  {
    /**Menu**/
    .mobile-main-nav .navbar-togglers {  position: absolute;  left: 240px;  z-index: 10; visibility: hidden;}
}
  @media (max-width: 991px)  {
    .dropdown-menu{
      margin-top: 10px !important;
      margin-left: 50px;
    }
    /**Menu**/
    .mobile-main-nav{ min-height: 0 }
    /* .mobile-main-nav .navbar-toggler{  position: absolute;  left: 240px;  z-index: 10;} */
    .mobile-main-nav .navbar-togglers { z-index: 10; visibility: visible; margin-top: 200px;}
    .mobile-main-nav #navbar{position: fixed;left: 0;  top: 0px; bottom: 0;  z-index: 9;  margin: 0px; padding: 0 0px; height: auto !important; width: 200px !important; -webkit-transform: translateX(-300px);  -webkit-transition: transform 280ms cubic-bezier(0.25,.8,0.25,1); transform: translateX(-300px);  transition: transform 280ms cubic-bezier(0.25,.8,0.25,1); background: {{ $theme->primaryColor()->value }}; }
    .mobile-main-nav #navbar.collapsing{   }
    .mobile-main-nav #navbar:before{ opacity: 0;}
  
    .mobile-main-nav #navbar.show {  width: 100% !important; -webkit-transform: translateX(0px);  -webkit-transition: transform 280ms cubic-bezier(0.25,.8,0.25,1); transform: translateX(0px);  transition: transform 280ms cubic-bezier(0.25,.8,0.25,1); overflow-y:visible;   }
  
    /* .mobile-main-nav #navbar.show:before,.mobile-main-nav #navbar.collapsing:before{position: fixed; display: block; background: rgba(0,0,0,0.2); left: 0; top: 0; width: 100vw; bottom: 0;   animation: show 2000ms cubic-bezier(0.175, 0.885, 0.32, 1.275) 560ms forwards; z-index:-999;} */

    .mobile-main-nav .nav{margin-top: 50px}
    .mobile-main-nav .nav li {  display: block;  float: none; }
    .mobile-main-nav .navbar-nav>li>a:hover{color:#FFF}
  }

  .animate-show {
      animation: show 800ms cubic-bezier(0.175, 0.885, 0.32, 1.275) .6s forwards;
      /*opacity: 0;*/
  }

  @keyframes hide{
      0%{ opacity: 1; z-index: 9;  }
      99% { opacity: 0; top:-100px;  }
      100% {  opacity: 0; top:-100px; z-index: 0;   }
  }

  @keyframes show{
      0%{ opacity: 0 ;  }
      100% { opacity: 1;transform: none; }
  }

  .navbar-togglers{
    border: 2px solid #ffffff;
  }

</style>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark navbar-inverse navbar-default mobile-main-nav vw-100" style="background-color:{{ $theme->primaryColor()->value }}; height:52px;">
  <a class="navbar-brand" href="{{ route('user.home') }}">主页</a>
  <button class="navbar-toggler text-white bg-transparent border-0" data-bs-toggle="collapse" data-bs-target="#navbar"  aria-expanded="true" aria-controls="navbar" >
    <span class="navbar-toggler-icon text-white"></span>
  </button>

  <div id="navbar" class="collapse navbar-collapse justify-content-end" aria-expanded="true">
    <form action="{{ route('search.index') }}" method="GET" class="m-0">
      {{ csrf_field() }}
      <div class="d-flex flex-row gap-3 justify-content-center align-items-center p-3">
        <div>
          <input type="text" id="search_text" name="search_text"
              class="form-control search-slt border border-dark" value="{{ request('search_text') }}"
              style="border-radius: 20px" placeholder="輸入名字">
        </div>
        <div>
          <button type="submit" class="btn border border-dark text-black bg-white"
              style="border-radius: 20px">搜索</button>
        </div>
      </div>
    </form>
    <ul class="nav navbar-nav" style="background-color:{{ $theme->primaryColor()->value }};">
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('family_origin.index') }}">彭姓渊源</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('event.index') }}">活动</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('notice.index') }}">通告</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('businessList.index') }}">商业</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('job.index') }}">就业机会</a>
      </li>
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="{{ route('businessList.index') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">商业与就业机会</a>
        <div class="dropdown-menu border-0 w-100" aria-labelledby="navbarDropdown" style="background-color:{{ $theme->primaryColor()->value }}; border-radius: 0px;">
          <a class="dropdown-item text-white w-100" href="{{ route('businessList.index') }}">商业</a>
          <a class="dropdown-item text-white w-100" href="{{ route('job.index') }}">就业机会</a>
        </div>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link text-white btn_hover" href="" >        
          <button class="btn text-white btn_hover pb-0" type="button" style="background:none; border-radius: 0px; border:none; display:block;">
            <i class="fa fa-search btn_hover pb-0" style="background:none; border-radius: 0px; border:none;"></i>
          </button>
        </a> 
      </li> -->
      <div class="col-12 col-sm-12 col-xs-12 d-flex justify-content-center">
        <button onclick="test()" class="navbar-togglers bg-transparent text-white border-white" style="border-radius:30px; width:30px !important;"  >
          <span class="text-center">X</span>
        </button>
      </div>
    </ul>
  </div>  
</nav>

<script>
  function test() {
    var myCollapse = document.getElementById('navbar')
    var bsCollapse = new bootstrap.Collapse(myCollapse, {
      toggle: true
    })
  }
</script>