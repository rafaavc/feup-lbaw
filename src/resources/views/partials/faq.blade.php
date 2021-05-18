<div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$id}}" aria-expanded="false" aria-controls="collapse{{$id}}">
            {{$question}}
        </button>
    </h2>
    <div id="collapse{{$id}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            {{$answer}}
        </div>
    </div>
</div>
