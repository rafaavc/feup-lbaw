<div class="card m-0 mb-4 shadow-sm text-center p-3 personal-info">
    <h4>Personal Info</h4>
    <div class="text-start m-auto d-inline">
        <span><i class="fas fa-map-marker-alt"></i>
            @if($user->city !== null)
                {{$user->city}},
            @endif
            {{$user->country->name}}
        </span>
        <br>
    </div>
    @if($canEdit)
        <a class="btn btn-primary mt-2" href="{{url('/recipe')}}">Create
            Recipe</a>
        <a class="btn btn-primary mt-2" href="{{url('/group')}}">Create
            Group</a>
    @endif
</div>
