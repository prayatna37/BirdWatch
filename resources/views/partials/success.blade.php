@if(session('success'))
<div class="container">
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
</div @endif