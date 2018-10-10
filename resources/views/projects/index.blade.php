@extends ('layouts.master')

@section ('content')

@include ('layouts.navbar')

<div class="container">
    <div class="title">
        <h1> Projects </h1>
    </div>

    <div style="margin: 20px 5px;">
      <a href="/projects/create" class="btn btn-primary">Create new project</a>
    </div>
    
    <div>
      <div class="list-group">
        @foreach ($projects as $project)
          <a href="/projects/{{ $project->id }}" class="list-group-item">
            <div>
              <strong> {{ $project->name }} </strong>
            </div>
            <div>
              <em> {{ $project->description }} </em>
            </div>
          </a>
        @endforeach
      </div>
    </div>
</div>
@endsection
