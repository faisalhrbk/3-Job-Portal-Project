   <div class="card mb-4 border-0 p-3 shadow">
       <div class="s-body mt-3 text-center">
           @if (Auth::user()->image != '')
               <img src="{{ asset('profile_pic/thumb/' . Auth::user()->image) }}" alt="maljar" class="rounded-circle img-fluid"
                   style="width: 150px;">
           @else
               <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar" class="rounded-circle img-fluid"
                   style="width: 150px;">
           @endif

           <h5 class="mt-3 pb-0">{{ ucfirst(Auth::user()->name) }}</h5>
           <p class="text-muted fs-6 mb-1">{{ ucfirst(Auth::user()->designation) }}</p>
           <div class="d-flex justify-content-center mb-2">
               <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
                   class="btn btn-primary">Change Profile Picture</button>
           </div>
       </div>
   </div>
   <div class="card account-nav mb-lg-0 mb-4 border-0 shadow">
       <div class="card-body p-0">
           <ul class="list-group list-group-flush">
               <li class="list-group-item d-flex justify-content-between p-3">
                   <a href="{{ route('account.profile') }}">Account Settings</a>
               </li>
               <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                   <a href="{{ route('account.createJob') }}">Post a Job</a>
               </li>
               <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                   <a href="{{ route('account.myJobs') }}">My Jobs</a>
               </li>
               <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                   <a href="{{ route('account.myJobApplications') }}">Jobs Applied</a>
               </li>
               <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                   <a href="{{ route('account.savedJobs') }}">Saved Jobs</a>
               </li>
               <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                   <a href="{{ route('account.logout') }}">Logout</a>
               </li>
           </ul>
       </div>
   </div>
