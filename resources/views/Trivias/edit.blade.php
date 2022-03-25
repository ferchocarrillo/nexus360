
<div class="modal-header">
    <h5 class="modal-title">{{$trivia->name}}</h5>
    <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
    >
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <trivia-component action="edit" :min-questions="2" ></trivia-component>
</div>