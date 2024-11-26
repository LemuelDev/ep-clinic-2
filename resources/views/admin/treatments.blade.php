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
            <div class="w-full ">
                <!-- Your main content goes here -->
                <div class="flex max-sm:flex-col justify-center max-sm:gap-5 sm:justify-between items-center">
                    <h1 class="lg:text-3xl text-2xl font-bold ">Treatments</h1>
                    {{-- route hereee --}}
                    <form action="{{route("admin.treatments")}}"
                        method="GET">
                        <input type="text" placeholder="Search Treatment" name="search" class="px-4 py-2 rounded-lg shadow-md border border-gray-500 bg-transparent">
                        <button class="py-3 px-6 rounded-lg bg-blue-500 text-white">Search</button>
                    </form>
                </div>
                @include('admin.tableTreatments') 
            </div>
                       
        </main>

         @if (session()->has('success'))
        <dialog id="my_modal_20" class="modal">
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
            document.getElementById('my_modal_20').showModal();
            });
        </script>
        @endif

        
        @if (session()->has('failed'))
        <dialog id="my_modal_21" class="modal">
          <div class="modal-box">
            <h3 class="text-xl font-bold">Failed!</h3>
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
            document.getElementById('my_modal_21').showModal();
            });
        </script>
        @endif
       
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
              Are you sure you want to delete this document? 
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
              const deleteUrl = `/admin/appointment/delete/${fileId}`;
              
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
