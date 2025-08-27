<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo-tooth.png') }}" type="image/x-icon">
    <title>EP-CLINIC  (LOGIN)</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: "Poppins", sans-serif;
        }
        body{
          overflow-x: hidden;
        }
    </style>
</head>
<body>
    
        @if (session()->has('signup-success'))
        <dialog id="my_modal_2" class="modal">
            <div class="modal-box">
              <h3 class="text-xl font-bold">Signup Success!</h3>
              <p class="py-4 pt-8 text-center text-green-600">{{session('signup-success')}}</p>
              <div class="modal-action">
                <form method="dialog">
                  <!-- if there is a button in form, it will close the modal -->
                  <button class="btn">Close</button>
                </form>
              </div>
            </div>
          </dialog>

           <!-- JavaScript to automatically open modal -->
        <script>
            // Automatically open modal on page load
            window.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('my_modal_2').showModal();
            });
        </script>
        @endif

        @if (session()->has('success'))
        <dialog id="my_modal_36" class="modal">
            <div class="modal-box">
              <h3 class="text-xl font-bold">Signup Success!</h3>
              <p class="py-4 pt-8 text-center text-green-600">{{session('success')}}</p>
              <div class="modal-action">
                <form method="dialog">
                  <!-- if there is a button in form, it will close the modal -->
                  <button class="btn">Close</button>
                </form>
              </div>
            </div>
          </dialog>

           <!-- JavaScript to automatically open modal -->
        <script>
            // Automatically open modal on page load
            window.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('my_modal_36').showModal();
            });
        </script>
        @endif

        @if (session()->has('failed'))
        <dialog id="my_modal_3" class="modal">
          <div class="modal-box">
            <h3 class="text-xl font-bold">Login Failed!</h3>
            <p class="py-4 pt-8 text-center text-red-600">{{session('failed')}}</p>
            <div class="modal-action">
              <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn">Close</button>
              </form>
            </div>
          </div>
          </dialog>

           <!-- JavaScript to automatically open modal -->
        <script>
            // Automatically open modal on page load
            window.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('my_modal_3').showModal();
            });
        </script>
        @endif

        
        @if (session()->has('username'))
        <dialog id="my_modal_4" class="modal">
          <div class="modal-box">
            <h3 class="text-xl font-bold">Login Failed!</h3>
            <p class="py-4 pt-8 text-center text-red-600">{{session('username')}}</p>
            <div class="modal-action">
              <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn">Close</button>
              </form>
            </div>
          </div>
          </dialog>

           <!-- JavaScript to automatically open modal -->
        <script>
            // Automatically open modal on page load
            window.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('my_modal_4').showModal();
            });
        </script>
        @endif

        @if (session()->has('password'))
        <dialog id="my_modal_5" class="modal">
            <div class="modal-box">
              <h3 class="text-xl font-bold text-red-600">Login Failed!</h3>
              <p class="py-4 pt-8 text-center">{{session('password')}}</p>
              <div class="modal-action">
                <form method="dialog">
                  <!-- if there is a button in form, it will close the modal -->
                  <button class="btn">Close</button>
                </form>
              </div>
            </div>
          </dialog>

           <!-- JavaScript to automatically open modal -->
        <script>
            // Automatically open modal on page load
            window.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('my_modal_5').showModal();
            });
        </script>
        @endif
      
     

    <section class="flex h-screen max-sm:grid ">
        
            {{-- Clinic logo section --}}
            <div data-theme="light" class="flex justify-center items-center w-1/2 max-sm:w-full border-r-2">
                <div class="flex justify-center items-center gap-6 max-lg:flex-col max-sm:flex-row h-auto py-4">
                    <h4 class="text-4xl max-lg:text-3xl max-sm:text-2xl font-bold text-black text-center">ESPINELI-PARADEZA <br> DENTAL CLINIC</h4>
                    <img src="{{ asset('images/tooth-whitening.png') }}" alt="" class="rounded-md w-40 h-160 max-lg:h-130 max-sm:100 max-sm:w-20 align-middle">
                </div>
            </div>
            
            {{-- Login section --}}
            <div  class="flex justify-center items-center w-1/2 max-sm:w-full bg-slate-900">
                <div class="text-center py-6">
                    <h4 class="text-3xl font-bold text-white mb-4 tracking-widest">LOGIN</h4>
                    <form action="{{route('user.auth')}}" method="POST"  class="grid gap-4 items-center text-left px-3 ">
                        @csrf
                        <div class="grid">
                            <label for="username" class="text-lg text-white tracking-wider">Username:</label>
                            <input type="text" name="username" id="username" placeholder="Username" class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black placeholder:text-black">
                        </div>
                        <div class="grid">
                            <label for="password" class="text-lg text-white tracking-wider">Password:</label>
                            <input type="password" placeholder="Password" name="password" id="password" class="rounded-md px-10 py-3 bg-white text-black placeholder:text-black">
                        </div>
                        <button class="btn btn-primary mt-4 text-lg tracking-wide ">LOGIN</button>

                        <div class="text-center grid">
                            <a href="{{route('password.request')}}" class="text-lg text-white tracking-wide hover:text-blue-500 py-3">Forgot Password?</a>
                            <a href="{{route('signup')}}" class="text-lg text-white tracking-wide hover:text-blue-500 py-1">Don't have an account? Sign Up</a>
                              <a href="/" class="text-lg text-white tracking-wide hover:text-blue-500 py-1">Homepage</a>
                        </div>

                    </form>
                </div>
            </div>

        

    </section>




</body>
</html>