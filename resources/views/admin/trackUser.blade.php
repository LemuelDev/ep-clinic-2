@extends('layout.admin')

@section('content')
<div class="flex h-screen">
    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Main content -->
    <div class="flex-1 flex flex-col w-full">
        <!-- Navbar -->
        @include('admin.navbar')

        <!-- Main content area -->
        <main class="flex-1 p-6 " id="main-content">
            <div class="w-full">
                <!-- Your main content goes here -->
                <h1 class="text-3xl font-bold pb-4 py-2 tracking-wide max-lg:text-center">Track User</h1>
                
                {{-- profile content --}}
                <div class="grid gap-6 shadow-xl rounded-xl">
                    {{-- name section --}}
                    <div class="shadow-sm rounded-xl p-8">
                        <h4 class="py-4 text-xl font-bold tracking-wide">Personal Information</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 ">
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">FirstName:</label>
                                <input type="text" readonly value="{{$id->firstname}}" class=" bg-transparent rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">MiddleName:</label>
                                <input type="text" readonly value="{{$id->middlename}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">LastName:</label>
                                <input type="text" readonly value="{{$id->lastname}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">ExtensionName:</label>
                                <input type="text" readonly value="{{$id->extensionname}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                        </div>  
                    </div>

                    <div class="shadow-sm rounded-xl p-8">
                        {{-- <h4 class="py-4 text-xl font-bold tracking-wide">Other Information</h4> --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 ">
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Birthday:</label>
                                <input type="text" readonly value="{{$id->birthday}}" class=" bg-transparent rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Age:</label>
                                <input type="text" readonly value="{{$id->age}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Address:</label>
                                <input type="text" readonly value="{{$id->address}}" class="bg-transparent  rounded-lg shadow px-4 w-full py-3 text-left text-md">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Sex:</label>
                                <input type="text" readonly value="{{$id->sex}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex justify-start items-center">
                                <label for="" class="min-w-40">Phone Number:</label>
                                <input type="text" readonly value="{{$id->phone_number}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                        </div>  
                    </div>

                    <div class="shadow-sm rounded-xl p-8">
                        <h4 class="py-4 text-xl font-bold tracking-wide">Emergency Contact Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 ">
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Name:</label>
                                <input type="text" readonly value="{{$id->emergency_name}}" class=" bg-transparent rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Contact Number:</label>
                                <input type="text" readonly value="{{$id->emergency_contact}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Relationship:</label>
                                <input type="text" readonly value="{{$id->emergency_relationship}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                           
                        </div>  
                    </div>

                    <div class="shadow-sm rounded-xl p-8">
                        <h4 class="py-4 text-xl font-bold tracking-wide">Additional Information</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 ">
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Email:</label>
                                <input type="text" readonly value="{{$id->email}}" class=" bg-transparent rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Username:</label>
                                <input type="text" readonly value="{{$id->user->username}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                           
                        </div>  
                    </div>

                    <div class="mx-auto px-4 w-full max-[520px]:max-w-[600px]  max-sm:flex-col flex gap-4 items-center justify-center py-8">
                        @if ($id->user_status == "enable")
                         <a href="{{route('admin.disable', $id->id)}}" class="text-white rounded-md px-4 py-3 text-lg bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">Disable</a>
                        @else
                        <a href="{{route('admin.enable', $id->id)}}" class="text-white rounded-md px-4 py-3 text-lg bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">Enable</a>
                     
                        @endif
                        <a href="" class="px-10 py-3 rounded-md text-center border-none text-lg text-white shadow bg-red-700 hover:bg-red-800">Delete</a>
                    </div>
                

                </div>

            </div>
                       
        </main>
       
        @if (session()->has('success'))
        <dialog id="my_modal_37" class="modal">
            <div class="modal-box">
              <h3 class="text-xl font-bold">Success!</h3>
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
            document.getElementById('my_modal_37').showModal();
            });
        </script>
        @endif

    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
</script>

@endsection
