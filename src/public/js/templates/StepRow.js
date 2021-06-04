
export const getStepRow = (stepId) => {
    const index = stepId + 1;
    return `<div>
    <div class="form-floating mb-3" data-toggle="tooltip" data-placement="top" title="Enter a name for this step">
        <input name="steps[${stepId}][name]" type="text" class="form-control" id="stepName" placeholder="Preparation Time">
        <label for="stepName">Step Name <span class='form-required'></span></label>
    </div>
    <div class="form-floating mb-4" data-toggle="tooltip" data-placement="top" title="Enter a nice step description">
        <textarea name="steps[${stepId}][description]" class="form-control" placeholder="Your awesome description here..." id="floatingTextarea2" style="height: 5rem"></textarea>
        <label for="floatingTextarea2">Step Description <span class='form-required'></span></label>
    </div>
    <h6 class="mb-3">Step Photos</h6>
    <div class="step-photo-input" data-index="${index}">
    </div>
</div>`
}

