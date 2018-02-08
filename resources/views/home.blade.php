@extends('layouts.app')

@section('content')
<div class="container">
  <div class="panel panel-default">
      <form action="{{ route('save') }}" method="post">
      <div class="panel-heading">
        <submit :fields="{{ json_encode($items) }}"
          url="{{ route('save') }}">
          Save
        </submit>
      </div>

      <div class="panel-body">

        {{ csrf_field() }}
        <form-groups :items="{{ json_encode($items) }}"
          :groups="['camera', 'message', 'chat', 'youtube']">
        </form-groups>

      </div>
      </form>
  </div>
</div>
@endsection
