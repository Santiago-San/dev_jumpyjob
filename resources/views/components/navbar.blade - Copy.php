<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto&display=swap" rel="stylesheet">


        <style>
            ::placeholder{
                text-align: center;
            }
        </style>
        
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
		
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


        <title>JumpyJob </title>
    </head>

    <body class="font-['Montserrat'] bg-[#FFB800]">
	<!-- navbar -->
		<div class="container-fluid fixed-top">
			<div class="row">
				<div class="col-sm-4"><a href="/"><img style="padding:5px;" src="{{asset('/images/logo.png')}}" alt="logo" class="logo w-18 "></a></div>
				<div class="col-sm-8 float-end text-right">
					<ul class="flex space-x-6 mr-6 text-lg float-end text-right" style="margin-top:30px;">
                @auth

                    <li>
                        <span class="font-bold uppercase">
                            Wilkommen {{auth()->user()->name}}
                        </span>
                    </li>
                    <li>
                        <a class="font-bold uppercase" href="/account">
                            Mein Konto
                        </a>
                    </li>
                    <li>
                        <form class="inline" method="POST" action="/logout">
                        @csrf
                            <button type="submit">
                                <i class="fa-solid fa-door-closed"></i> Abmelden
                            </button>
                        </form>
                    </li>

                @else
                <li>
					<a href="/register" class="font-bold"><i class="fa-solid fa-user-plus"></i> Registrieren</a>
				</li>
				<li>
					<a href="/login" class="font-bold"><i class="fa-solid fa-arrow-right-to-bracket"></i> Anmelden</a>
				</li>
            @endauth
			<li>
					<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
			  <i class="fa-solid fa-bars"></i>
			</button>
				</li>
            </ul>
				</div>
			</div>
		</div>
		<div style="height:75px;"></div>
		<nav class="navbar navbar-light bg-light- fixed-top-">
		  <div class="container-fluid">
			<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
			  <div class="offcanvas-header">
				<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
				<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
			  </div>
			  <div class="offcanvas-body">
				<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
				  <li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#">Home</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="#">Link</a>
				  </li>
				  
				</ul>
				
			  </div>
			</div>
		  </div>
		</nav>
<!-- navbar -->

        <nav class="flex justify-between items-center bg-[#FFB800] text-[#424242] pt-9 pl-9">
                <a href="/"><img src="{{asset('/images/logo.png')}}" alt="logo" class="logo w-18 "></a> 
                
            
        </nav>
       

        <main>
            {{$slot}}
        </main>
  
        <x-flash-message/>
        <script src="{{asset('/js/dynamic_forms.js')}}"></script>
    </body>
</html>
