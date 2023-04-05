@if (env('APP_ENV') == 'local')
    <div style="" class="col-12 text-center bg-danger text-white">On Development Environtment</div>    
@endif
@if (env('APP_ENV') == 'staging')
    <div style="" class="col-12 text-center bg-danger text-white">On Staging  Environtment</div>    
@endif