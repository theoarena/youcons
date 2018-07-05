@if ($errors->any())	
    <div class="alert alert-danger" id="home-alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>    
@endif