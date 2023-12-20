@if(Session::has('success'))
<div class="alert alert-fill alert-success alert-dismissible alert-icon">
    <em class="icon ni ni-check-circle"></em> <strong>Success</strong>! {{ Session::get('success') }} <button class="close" data-bs-dismiss="alert"></button>
</div>
@endif
@if (isset($_GET['success']))
<div class="alert alert-fill alert-success alert-dismissible alert-icon">
    <em class="icon ni ni-check-circle"></em> <strong>Success</strong>! {{ $_GET['success'] }} <button class="close" data-bs-dismiss="alert"></button>
</div>
@endif

