@if (Session::has('success'))
  <div class="alert alert-success alert-dismissible face show">
        {{ Session::get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> 
    </button>
</div>  
@endif

@if (Session::has('error'))
  <div class="alert alert-danger alert-dismissible face show">
      {{ Session::get('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>  
@endif
