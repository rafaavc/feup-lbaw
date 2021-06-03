<h5 class="mb-3 step-number">Step {{ $index }}</h5>
<div>
    <div class="form-floating mb-3" data-toggle="tooltip" data-placement="top" title="Enter a name to this step">
        @if($hasErrors)
            <input name="steps[{{ $index - 1 }}][name]" type="text" class="form-control" id="stepName" placeholder="Preparation Time"
                value="{{ $step['name'] }}">
        @else
            <input name="steps[{{ $index - 1 }}][name]" type="text" class="form-control" id="stepName" placeholder="Preparation Time"
                value="{{ isset($step->name) ? $step->name : "" }}">
        @endif
        <label for="stepName">Step Name <span class='form-required'></span></label>
    </div>
    <div class="form-floating mb-4" data-toggle="tooltip" data-placement="top" title="Enter a nice step description">
        @if($hasErrors)
            <textarea name="steps[{{ $index - 1 }}][description]" class="form-control" placeholder="Your awesome description here..." id="floatingTextarea2" style="height: 5rem">{{ $step['description'] }}</textarea>
        @else
            <textarea name="steps[{{ $index - 1 }}][description]" class="form-control" placeholder="Your awesome description here..." id="floatingTextarea2" style="height: 5rem">{{ isset($step->description) ? $step->description : "" }}</textarea>
        @endif
        <label for="floatingTextarea2">Step Description <span class='form-required'></span></label>
    </div>
    <h6 class="mb-3">Step Photos</h6>
    <input name="steps[{{ $index - 1 }}][image]" type="file" class="form-control mb-5">
</div>
