<template>
    <div>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th width="70px">Answers</th>
                    <th width="80px"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="trivia in trivias" :key="trivia.id">
                    <td>{{ trivia.id }}</td>
                    <td>{{ trivia.code }}</td>
                    <td>{{ trivia.name }}</td>
                    <td>{{ trivia.status }}</td>
                    <td>{{ trivia.answers_count }}</td>
                    <td>
                        <a
                            class="btn btn-sm btn-info rounded-circle"
                            title="Show Trivia"
                            @click="showTrivia($event, trivia.id)"
                            href="#"
                        >
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </a>
                        <a
                            class="btn btn-sm btn-secondary rounded-circle"
                            title="Download Answers"
                            @click="downloadAnswers($event, trivia.id)"
                            href="#"
                            v-if="trivia.answers_count>0"
                        >
                            <i class="fas fa-download"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div
            class="modal fade"
            tabindex="-1"
            role="dialog"
            id="showTriviaModal"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" v-if="!isEmpty">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ trivia.name }} - {{ trivia.code }}
                        </h5>
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
                        <trivia-component
                            action="edit"
                            :trivia="trivia"
                        ></trivia-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["trivias"],
    data() {
        return {
            trivia: {}
        };
    },
    methods: {
        showTrivia(e, id) {
            e.preventDefault();
            this.trivia = {};
            axios.get(`/trivias/${id}/edit`).then(res => {
                this.trivia = res.data;
                $("#showTriviaModal").modal("show");
            });
        },
        downloadAnswers(e,id){
            e.preventDefault();
            $('#logoLoading').modal('show')
            let trivia = this.trivias.find(t=>t.id==id);
            axios({
                url: '/trivias/download',
                method: 'PUT',
                responseType: 'blob',
                data: {
                    id: id
                }
            }).then((res)=>{
                var fileURL = window.URL.createObjectURL(new Blob([res.data]));
                var fileLink = document.createElement('a');
                $('#logoLoading').modal('hide')
                fileLink.href = fileURL;
                fileLink.setAttribute('download', trivia.code + '.xlsx');
                document.body.appendChild(fileLink);
                fileLink.click();
                fileLink.remove();
            })
        }
    },
    computed: {
        isEmpty: function() {
            return Object.keys(this.trivia).length === 0;
        }
    }
};
</script>
