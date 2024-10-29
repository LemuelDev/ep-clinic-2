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
                <h1 class="text-3xl font-bold pb-4 py-2 tracking-wide max-lg:text-center">Track Reservation</h1>
                
                {{-- profile content --}}
                <div class="grid gap-6 shadow-xl rounded-xl">
                    {{-- name section --}}
                    <div class="shadow-sm rounded-xl p-8">
                        <h4 class="py-4 text-xl font-bold tracking-wide">Personal Information</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 ">
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Name:</label>
                                <input type="text" readonly value="{{$id->userProfile->firstname}} {{$id->userProfile->middlename}} {{$id->userProfile->lastname}} {{$id->userProfile->extensionname}}" class=" bg-transparent rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Phone Number:</label>
                                <input type="text" readonly value="{{$id->userProfile->phone_number}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Age:</label>
                                <input type="text" readonly value="{{$id->userProfile->age}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Sex:</label>
                                <input type="text" readonly value="{{$id->userProfile->sex}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                        </div>  
                    </div>

                    <div class="shadow-sm rounded-xl p-8">
                        {{-- <h4 class="py-4 text-xl font-bold tracking-wide">Other Information</h4> --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 ">
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Treatment Choice:</label>
                                <input type="text" readonly value="{{$id->treatment_choice}}" class=" bg-transparent rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Date:</label>
                                <input type="text" readonly value="{{ \Carbon\Carbon::parse($id->timeSlots->date)->format('F j, Y') }}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Time:</label>
                                <input type="text" readonly value="{{$id->timeSlots->time_range}}" class="bg-transparent  rounded-lg shadow px-4 w-full py-3 text-left text-md">
                            </div>
                          
                        </div>  
                    </div>

                    <div class="shadow-sm rounded-xl p-8">
                        <h4 class="py-4 text-xl font-bold tracking-wide">Emegency Contact Information</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 ">
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Name:</label>
                                <input type="text" readonly value="{{$id->userProfile->emergency_name}}" class=" bg-transparent rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Phone Number:</label>
                                <input type="text" readonly value="{{$id->userProfile->emergency_contact}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Relationship:</label>
                                <input type="text" readonly value="{{$id->userProfile->emergency_relationship}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                           
                        </div>  
                    </div>
                    
                    @if ($id->reservation_status === "approved")
                    <div class="mx-auto px-4 w-full max-[520px]:max-w-[600px]  max-sm:flex-col flex gap-4 items-center justify-center py-8">
                        <a href="{{route('admin.approveReservation', $id->id)}}" class="px-10 py-3 rounded-md text-center border-none text-lg text-white shadow bg-[#624E88] hover:bg-[#58457b]">Complete Reservation</a>
                        <a href="{{route('admin.rejectReservation', $id->id)}}" class="px-10 py-3 rounded-md text-center border-none text-lg text-white shadow bg-red-700 hover:bg-red-800">No-show Reservation</a>
                    </div>
                    @else
                    <div class="mx-auto px-4 w-full max-[520px]:max-w-[600px]  max-sm:flex-col flex gap-4 items-center justify-end py-8">
                        <a href="{{route('admin.patientHistory')}}" class="px-10 py-3 rounded-md text-center border-none text-lg text-white shadow bg-[#624E88] hover:bg-[#58457b]">Back to Patient History</a>
                       
                    </div>
                    @endif

                </div>

            </div>
                       
        </main>
       
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
</script>

@endsection
