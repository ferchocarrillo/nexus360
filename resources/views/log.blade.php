@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | log')

@section('content_header')
    <h1>log</h1>
@stop

@section('content')


<iframe src="http://localhost:3000/" frameborder="0" id="chat"></iframe>
{{-- {{  auth()->user()->manager }}
<hr>
{{  auth()->user()->employess }} --}}
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}
@stop

@push('js')
    <script>
        $(document).ready(function () {
            
            
                $('.btn-test').click(function (e) { 
                    e.preventDefault();
                    
                    var domain = 'http://localhost:3000/';
                    var iframe = document.getElementById('chat').contentWindow;

                    var message = 'Hello!'
                    console.log('blog.local: sending message: ' + message);
                    iframe.postMessage(message,domain);
                    
                });
            
        });
    
    </script>
@endpush
