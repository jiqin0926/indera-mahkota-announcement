   @extends('layouts.app')
   @section('title', 'Documentation')

   @section('content')
   <h2 class="mb-3">System Documentation</h2>
   <iframe src="{{ url('/scribe') }}" style="width:100%; height:80vh; border:1px solid #ddd;"></iframe>
   @endsection