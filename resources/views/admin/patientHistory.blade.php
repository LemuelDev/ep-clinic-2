@extends('layout.admin')

@section('content')
<div class="flex h-screen" data-theme="light">
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
                    <h1 class="lg:text-3xl text-2xl font-bold ">Appointment History</h1>
                          <!-- Status Filter -->
                          <div class="flex items-center justify-center gap-4 max-sm:flex-col max-sm:pt-3">
                            <form action="{{request()->route()->getName() === 'admin.records' ? route('admin.records') : route('admin.noshowRecords')}}"
                              method="GET">
                              <input type="text" placeholder="Search Name" name="search" class="px-4 py-2 rounded-lg shadow-md border border-gray-500 bg-transparent">
                              <button class="py-3 px-6 rounded-lg bg-blue-500 text-white">Search</button>
                           </form>
                           <select name="" id="filter-appointment" class="py-2 px-4 rounded-lg border border-slate-500">
                                <option value="{{route('admin.records')}}" {{request()->route()->getName() === 'admin.records' ? 'selected' : ''}}>Completed</option>
                                <option value="{{route('admin.noshowRecords')}}" {{request()->route()->getName() === 'admin.noshowRecords' ? 'selected' : ''}}>No-show</option>
                           </select>
                           <script>
                            // Get the select element
                            const filter = document.getElementById('filter-appointment');
                        
                            // Add an event listener for the change event
                            filter.addEventListener('change', function () {
                                // Redirect to the selected option's value (URL)
                                window.location.href = this.value;
                            });
                        </script>
                          </div>
                </div>
            </div>
                 @include('admin.tableAppointments') 
            </div>
                       
        </main>
       
    </div>
</div>

 <!-- Confirmation Modal -->
 <div class="fixed inset-0 z-50 overflow-y-auto hidden" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-xl max-w-lg mx-auto p-6">
            <div class="modal-header flex justify-start items-center py-1">
                <h5 class="text-lg font-medium" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
            </div>
            <div class="modal-body my-4 text-red-500 py-4">
                Are you sure you want to delete this record? 
            </div>
            <div class="modal-footer flex justify-end gap-4">
                <button type="button" class="text-white py-2 px-6 bg-gray-500 hover:bg-gray-600 rounded-md" data-close-modal>Cancel</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('GET')
                    <button type="submit" class="text-white py-2 px-6 bg-red-500 hover:bg-red-600 rounded-md">Delete</button>
                </form>
            </div>
        </div>
    </div>
  </div>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    // Open modal when a button with data-toggle-modal is clicked
    document.querySelectorAll('[data-toggle-modal]').forEach(button => {
        button.addEventListener('click', function() {
            const modalSelector = button.getAttribute('data-toggle-modal');
            const modal = document.querySelector(modalSelector);
            const fileId = button.getAttribute('data-file-id');
  
            // Ensure fileId is available
            if (fileId) {
                // Set the form action URL
                const deleteForm = modal.querySelector('#deleteForm');
                
                // Construct the URL with the file ID parameter
                const deleteUrl = `/admin/records/delete/${fileId}`;
                
                // Set the form action to the constructed URL
                deleteForm.setAttribute('action', deleteUrl);
                
                // Show the modal
                modal.classList.remove('hidden');
            }
        });
    });
  
    // Close modal when a button with data-close-modal is clicked
    document.querySelectorAll('[data-close-modal]').forEach(button => {
        button.addEventListener('click', function() {
            const modal = button.closest('#deleteConfirmationModal');
            // Hide the modal
            modal.classList.add('hidden');
        });
    });
    });
  
  
  </script>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
</script>

@endsection
