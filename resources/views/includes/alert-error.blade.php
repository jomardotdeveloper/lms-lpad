
@if (Session::has('custom-errors'))
<div class="alert alert-fill alert-danger alert-dismissible alert-icon">
    <em class="icon ni ni-cross-circle"></em> <strong>Failed</strong>!
    <ul>
        @foreach (Session::get('custom-errors') as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button class="close" data-bs-dismiss="alert"></button>
</div>
@endif
@if($errors->any())
<div class="alert alert-fill alert-danger alert-dismissible alert-icon">
    <em class="icon ni ni-cross-circle"></em> <strong>Failed</strong>!
    <ul>
        @foreach ($errors->all()  as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button class="close" data-bs-dismiss="alert"></button>
</div>
@endif
