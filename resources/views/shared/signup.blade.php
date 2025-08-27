<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo-tooth.png') }}" type="image/x-icon">
    <title>EP-CLINIC (SIGNUP)</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>
<body class=""> 

    <dialog id="my_modal_6" class="modal">
        <div class="modal-box">
          <h3 class="text-lg font-bold">PASSWORD VALIDATIONS!</h3>
          <p class="py-4">Must be atleast one character, one uppercase, one lowercase and one number.</p>
        </div>
        <form method="dialog" class="modal-backdrop">
          <button>close</button>
        </form>
      </dialog>

    <section class="flex min-h-screen max-lg:grid ">
        
        
            {{-- Clinic logo section --}}
            <div data-theme="light" class="flex justify-center items-center w-1/2 max-lg:w-full border-r-2">
                <div class="flex justify-center items-center gap-6  h-auto py-4 max-sm:py-8">
                    <h4 class="text-4xl max-lg:text-3xl max-sm:text-2xl font-bold text-black text-center">ESPINELI-PARADEZA <br> DENTAL CLINIC</h4>
                    <img src="{{ asset('images/tooth-whitening.png') }}" alt="" class="rounded-md w-40 h-160 max-lg:h-130 max-sm:100 max-sm:w-20 align-middle">
                </div>

               
            </div>
            
            {{-- Login section --}}
            <div class="flex justify-center items-center w-1/2 max-sm:w-full bg-slate-900">
                <div class="text-center py-4">
                    <h4 class="text-3xl font-bold text-white mb-4 tracking-widest">SIGNUP</h4>
                    <form action="{{route('users.store')}}" method="POST"  class="grid gap-4 items-center text-left px-3">
                        @csrf
                        <div class="grid">
                            <label for="username" class="text-lg text-white tracking-wider">Username:</label>
                            <input type="text" name="username" id="username" placeholder="Username here" class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black placeholder:text-slate-500">
                        </div>
                        <div class="grid">
                            <label for="email" class="text-lg text-white tracking-wider">Email:</label>
                            <input type="text" name="email" id="email" placeholder="Email here" class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black placeholder:text-slate-500">
                        </div>
                        <div class="grid">
                            <label for="password" class="text-lg text-white tracking-wider">Password:</label>
                            <input type="password" name="password" id="password" placeholder="Password here" class="rounded-md px-10 py-3 bg-white text-black placeholder:text-slate-500">
                        </div>
                        <button class="btn btn-primary mt-4 text-lg tracking-wide ">SIGNUP</button>

                        <div class="text-center grid">
                            <a href="{{route('login')}}" class="text-lg text-white tracking-wide hover:text-blue-500 py-1">Already have an account? Login</a>
                        </div>
                    </form>
                </div>
                
            </div>

            @if (session()->has('general'))
                <dialog id="my_modal_25" class="modal">
                    <div class="modal-box">
                    <h3 class="text-xl font-bold">Signup Failed!</h3>
                    <p class="py-4 pt-8 text-center text-red-600">{{session('general')}}</p>
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
                    document.getElementById('my_modal_25').showModal();
                    });
                </script>
             @endif

             @if (session()->has('failed'))
             <dialog id="my_modal_26" class="modal">
                 <div class="modal-box">
                 <h3 class="text-xl font-bold">Signup Failed!</h3>
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
                 document.getElementById('my_modal_26').showModal();
                 });
             </script>
          @endif

          @if ($errors->has('email'))
          <dialog id="my_modal_27" class="modal">
              <div class="modal-box">
              <h3 class="text-xl font-bold">Signup Failed!</h3>
              <p class="py-4 pt-8 text-center text-red-600">{{$errors->first('email')}}</p>
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
              document.getElementById('my_modal_27').showModal();
              });
          </script>
       @endif

       
       @if ($errors->has('password'))
       <dialog id="my_modal_28" class="modal">
           <div class="modal-box">
           <h3 class="text-xl font-bold">Signup Failed!</h3>
           <p class="py-4 pt-8 text-center text-red-600">{{$errors->first('password')}}</p>
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
           document.getElementById('my_modal_28').showModal();
           });
       </script>
    @endif

    </section>

   

</body>
</html>