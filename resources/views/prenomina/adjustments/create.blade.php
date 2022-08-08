<form action="" id="adjustmentForm">
    <div class="form-row">
        <input type="hidden" name="activity_code" id="activity_code" value="{{ $payroll_activity->code }}" required>
        <div class="col-md-6">
            <div class="form-group">
                <label for="adjustment_type">Adjustment Type</label>
                {{  Form::select('adjustment_type', $types, null, ['class' => 'form-control', 'id' => 'adjustment_type', 'placeholder' => 'Select Adjustment Type', 'required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="justification">Justification</label>
                {{ Form::select('justification', [], null, ['class' => 'form-control', 'id' => 'justification', 'placeholder' => 'Select Justification', 'required']) }}
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="observations">Observations</label>
                <textarea class="form-control" name="observations" id="observations" rows="3" required maxlength="255"></textarea>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary float-right" id="sendActivity">Send</button>
        </div>
    </div>
</form>


<script>
    adjustmentTypes = @json($adjustmentTypes);

    $("#adjustment_type").on('change', function () {
        let adjustmentType = $(this).val();
        let justifications = adjustmentTypes[adjustmentType];
        $("#justification").empty();
        $("#justification").append('<option value="" selected>Select Justification</option>');
        justifications.forEach(justification => {
            $("#justification").append('<option value="' + justification + '">' + justification + '</option>');
        });
    });

    $("#adjustmentForm").on("submit", function(e) {
        e.preventDefault();
        let form = $(this);
        let modal = $("#adjustmentModal");
        let activity_code = form.find("#activity_code").val();
        let adjustment_type = form.find("#adjustment_type").val();
        let justification = form.find("#justification").val();
        let observations = form.find("#observations").val();
        if (activity_code && adjustment_type && justification && observations) {
            // before send
            axios.interceptors.request.use(
                function(config) {
                    modal.find("form").hide();
                    modal.find("#loading").show();
                    return config;
                },
                function(error) {
                    return Promise.reject(error);
                }
            );
            axios
                .post("/prenomina/adjustments", {
                    activity_code,
                    adjustment_type,
                    justification,
                    observations
                })
                .then(response => {
                    if (response.status == 200) {
                        const event = new Event('refresh_data');
                        document.dispatchEvent(event);
                        
                        // close modal
                        setTimeout(() => {
                            modal.modal("hide");
                        }, 1000);
                    }
                }).catch(error => {
                    modal.find("#loading").hide();
                    modal.find("#error").show();
                    modal
                        .find("#error")
                        .find("#error_text")
                        .text(error.response.data.message);
                });
        }
    });
</script>