<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Jelajah Budaya Indonesia</title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{asset('css/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet"> 
    <link href="{{asset('aos-master/dist/aos.css')}}" rel="stylesheet">
	<link href="{{asset('css/app_blade.css')}}" rel="stylesheet"> 
  	<link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}"> 
	<link rel="shortcut icon" href="{{asset('photo/jeluda.png')}}">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark" style="background-color:#22384F;">
  <a href="{{url('/')}}">
    <img src="{{asset('photo/jeludakecil.png')}}" alt="Logo" style="width:150px; margin-left:-10px;">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar" style="margin-top:-30px;">
    @guest
    <ul class="navbar-nav ml-auto">
	  <li class="nav-item" style="margin-top:10px; padding:22px 10px 0 0; font-family: system-ui;">
        <a class="hover_effect nav-link text-white" href="{{url('/')}}">
          <i class="fa fa-home" aria-hidden="true"></i> &nbsp; Beranda</a>
  	  </li>
      <li class="nav-item" style="margin-top:10px; padding:22px 10px 0 0; font-family: system-ui;">
        <a class="hover_effect nav-link text-white" href="{{url('/jelajah')}}">
          <i class="fa fa-list-ul" aria-hidden="true"></i> &nbsp; Jelajah</a>
      </li> 
      <li class="nav-item" style="margin-top:10px; padding:22px 10px 0 0; font-family: system-ui;">
        <a class="hover_effect nav-link text-white" href="{{route('login')}}">
          <i class="fa fa-user" aria-hidden="true"></i> &nbsp; Masuk</a>
      </li>
      <li class="nav-item" style="margin-top:10px; padding:22px 10px 0 0; font-family: system-ui;">
        <a class="hover_effect nav-link text-white" href="{{route('register')}}">
          <i class="fa fa-user-plus" aria-hidden="true"></i> &nbsp; Daftar</a>
      </li> 
      <li class="nav-item btn" style="margin-top:12px; padding:22px 10px 0 0; font-family: system-ui;">
        <a href="#search" style="padding:10px;" data-toggle="modal" data-target="#exampleModalCenter">
          <i class="fa fa-search fa-2x" aria-hidden="true" style="color:white;"></i></a>                
      </li>
    </ul>
    @else
    <ul class="navbar-nav ml-auto">
      <li class="nav-item btn" style="margin-top:26px; padding:22px 10px 0 0; font-family: system-ui;">
        <a href="#search" style="padding:10px;" data-toggle="modal" data-target="#exampleModalCenter">
          <i class="fa fa-search fa-1x" aria-hidden="true" style="color:white;"></i></a>                
      </li> 
      <li class="nav-item" style="margin-top:20px; cursor:pointer; padding:22px 10px 0 0; font-family:system-ui;">
        <a class="hover_effect nav-link text-white" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Tambahkan Budaya</a>
      </li>
      <li class="nav-item" style="margin-top:20px; padding:22px 10px 0 0; font-family: system-ui;">
        <a class="hover_effect nav-link text-white" href="{{url('/')}}">
          <i class="fa fa-home" aria-hidden="true"></i> &nbsp; Beranda</a>
      </li>
      <li class="nav-item" style="margin-top:20px; padding:22px 10px 0 0; font-family: system-ui;">
        <a class="hover_effect nav-link text-white" href="{{url('/jelajah')}}">
          <i class="fa fa-list-ul" aria-hidden="true"></i> &nbsp; Jelajah</a>
      </li>
      @if(!Auth::guest() && Auth::user()->role == 2)
      <li class="nav-item" style="margin-top:20px; padding:22px 10px 0 0; font-family: system-ui;">
        <a class="hover_effect nav-link text-white" href="{{url('/admin')}}">
          <i class="fa fa-user" aria-hidden="true"></i> &nbsp; Admin</a>
      </li>
      @endif
      <li class="nav-item" style="margin-top:20px; padding:22px 10px 0 0; font-family: system-ui;">
        <a class="hover_effect nav-link text-white" href="{{url('/notification')}}"><i class="fa fa-bell" aria-hidden="true"></i> &nbsp; Notifikasi (
          @if(Auth::user()->notif->where('seen','=',0)->count() == 0)
          <span>{{Auth::user()->notif->where('seen', '=', 0)->count()}}</span> )</a>
          @else
          <span class="text-warning">{{Auth::user()->notif->where('seen', '=', 0)->count()}}</span> )</a>
          @endif
      </li>

      <li class="nav-item" style="margin-top:20px; padding:22px 10px 10px 0; font-family: system-ui;">
        @if(Auth::user()->posting->where('status','=','0')->count() == 0)
        <div class="btn-group">
        <a class="hover_effect nav-link text-white dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">{{Auth::user()->name}} 
          <span class="badge badge-light">{{Auth::user()->posting->where('status','=','0')->count()}}</span>
        </a>
        @else
        <a class="hover_effect nav-link text-white dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">{{Auth::user()->name}} <span class="badge badge-danger">{{Auth::user()->posting->where('status','=','0')->count()}}</span></a>   
        @endif
        @if(Auth::user()->posting->where('status','=','0')->count() == 0)
        <div class="dropdown-menu dropdown-menu-right"  style="margin:10px;">
          <a href="{{url('/profile')}}" style="text-decoration:none;">
            <button class="dropdown-item btn" type="button">Profil 
              <span class="badge badge-dark" style="float:right; margin-top:3px;">
                {{Auth::user()->posting->where('status','=','0')->count()}}
              </span>
            </button>
          </a>
        @else
        <div class="dropdown-menu dropdown-menu-right"style="margin:10px;">
          <a href="{{url('/profile')}}" style="text-decoration:none;">
            <button class="dropdown-item btn" type="button">Profil 
              <span class="badge badge-danger" style="float:right; margin-top:3px;">
                {{Auth::user()->posting->where('status','=','0')->count()}}
              </span>
            </button>
          </a>
        @endif  
          <a href="{{url('/ubah-profile')}}/{{Auth::user()->id}}" style="text-decoration:none;">
            <button class="dropdown-item btn" type="button">Ubah Profil</button></a>
          <a href="{{ route('logout')  }}" class="dropdown-item" onclick="event.preventDefault();
		    document.getElementById('logout-form').submit();">
			{{ __('Keluar') }}</a>                                                                      
		  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			{{ csrf_field() }}
		  </form>                                                                                    
        </div>
      </li>
      <li class="nav-item">
        <a href="{{url('/profile')}}" style="text-decoration:none;">
          <img src="{{asset('storage/avatar/')}}/{{Auth::user()->avatar}}" class="rounded-circle" width="50px;" height="50px;" style="margin-top:37px; margin-right:5px; object-fit:cover;">        
        </a>
      </li>
    </ul>
    @endguest
  </div>
</nav>                                                                                                                                                 
<!-- Tambah Budaya -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Budaya</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah budaya anda belum terdaftar di situs kami? <br>Jika belum, anda dapat menambahkan budaya didaerah anda ke situs kami dengan cara mengklik tombol tambah dibawah ini.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="{{url('/jelajah/create')}}"><button type="button" class="btn btn-primary">Tambah</button></a>
      </div>
    </div>
  </div>
</div>

<div id="search" aria-hidden:"true" style="overflow:hidden;"> 
	<form role="search" id="searchform" action="{{url('/jelajah')}}" method="get" style="overflow:hidden;">
		<input type="search" style="overflow:hidden;" name="search" placeholder="cari budaya"/>
	</form>
</div>

<script src="{{ asset('js/jquery.js') }}"></script>       
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{asset('js/sweetalert2.min.js')}}"></script>  
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@include('sweet::alert') 
<script>
  $(document).ready(function(){
	$('a[href="#search"]').on('click', function(event) {                    
		$('#search').addClass('open');
		$('#search > form > input[type="search"]').focus();
	});            
	$('#search, #search button.close').on('click keyup', function(event) {
		if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
			$(this).removeClass('open');
		}
	});            
});
</script>
<script>
    function notif(){
            alert('lol');
    }
</script>
<main class="py-4">   
    @yield('content') 
</main>
<script src="{{asset('aos-master/dist/aos.js')}}"></script>
<script>
  AOS.init();
</script>

   <footer style="background-color:#304D6D; color:white; padding-top:25px; font-family: system-ui; margin-top:40px;">                                     
     <div class="container">                                                                                                                             
       <div class="row">                                                                                                                                 
         <div class="col-lg-5 offset-1 col-sm-12" style="color:#E0E1D4;">                                                                                
           <h3 class="text-left">Jelajah Budaya Indonesia</h3>                                                                                           
           <p class="text-left">Jeluda adalah sebuah website yang dapat memudahkan anda dalam menelusuri kebudayaan yang dimiliki oleh indonesia.</p>    
         </div>                                                                                                                                          
         <div class="col-lg-5 offset-1 col-sm-12" style="color:#E0E1D4;">                                                                                
           <h4 class="text-left">Kontak Kami</h4>                                                                                                         
             <p class="text-left"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; Jl. Raya Kampus Udayana No.20, Jimbaran, Badung, Bali 80361.
             <br><i class="fa fa-phone" aria-hidden="true"></i> &nbsp; 087862265363                                                                      
             <br><i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp; info.jeluda@gmail.com</p>                                                    
         </div>                                                                                                                                          
       </div>                                                                                                                                            
     </div>                                                                                                                                              
     <div class="footer-copyright" style="background-color:#22384F;">                                                                                    
       <div class="container text-center" style="padding:15px;">                                                                                         
       © 2018 Jelajah Budaya Indonesia                                                                                                                   
       </div>                                                                                                                                            
     </div>                                                                                                                                              
     </footer>                                                                                                                                           
</body>
</html>
