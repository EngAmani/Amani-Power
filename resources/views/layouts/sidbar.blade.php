
@extends('layouts.app')

@section('content')

<div id="mySidenav" class="sidenav">
                <a href="#">معلوماتي</a>
                <a href="#">طلب إجازة</a>
                <a href="{{ route('excuses_form') }}">طلب إستئذان</a>
             
            </div>

            @endsection
           
          <main class="py-4">
            @yield('content1')
        </main>