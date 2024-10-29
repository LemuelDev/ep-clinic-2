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
            <div class=" ">
                <!-- Your main content goes here -->
                <div class="flex max-sm:flex-col justify-center max-sm:gap-5 sm:justify-between items-center">
                    <h1 class="lg:text-3xl text-2xl font-bold ">Patient Records</h1>
                          <!-- Status Filter -->
                    <div class="flex gap-4 items-center justify-center ">
                        <form action="{{route("admin.records")}}" method="GET">
                            <input type="text" placeholder="Search Name" name="search" class="px-4 py-2 rounded-lg shadow-md border border-gray-500 bg-transparent">
                            <button class="py-3 px-6 rounded-lg bg-blue-500 text-white">Search</button>
                        </form>
                        {{-- <select name="filter-status" id="filter-status-history" class="py-2 px-5  bg-transparent shadow rounded-lg">
                            <option  class="text-black" value="{{route('admin.patientHistory')}}" {{request()->route()->getName() === 'admin.patientHistory' ? 'selected' : ''}}>Completed</option>
                            <option  class="text-black" value="{{route('admin.noShow')}}"  {{request()->route()->getName() === 'admin.noShow' ? 'selected' : ''}}>No-show</option>
                        </select> --}}
                    </div>
      
                          <script>
                              const filterStatusHistory = document.getElementById('filter-status-history');
                              // Event listener for status filter
                              filterStatusHistory.addEventListener('change', function() {
                                  const selectedStatusValue = filterStatusHistory.value;
                                  // Redirect with both filter and status as query parameters
                                  window.location.href = selectedStatusValue ;
                              });
      
                          </script>
                </div>
            </div>
                 {{-- @include('admin.tableHistory')   --}}
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
