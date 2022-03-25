<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-row form-custom">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input
                                type="text"
                                v-model="name"
                                class="form-control form-control-sm"
                                ref="name"
                                required
                                :disabled="action != 'create'"
                            />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="started_at">Started At</label>
                            <input
                                type="date"
                                class="form-control form-control-sm"
                                v-model="started_at"
                                ref="started_at"
                                required
                                :disabled="action != 'create'"
                            />
                        </div>

                        <div class="form-group col-md-3">
                            <label for="end_date">End Date</label>
                            <input
                                type="date"
                                class="form-control form-control-sm"
                                v-model="end_date"
                                ref="end_date"
                                required
                                :disabled="action != 'create'"
                            />
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label
                                    for="time_limit_question"
                                    class="col-sm-9 col-form-label"
                                >
                                    Time Limit by Question (seconds)
                                </label>
                                <div class="col-sm-3">
                                    <input
                                        type="number"
                                        class="form-control form-control-sm"
                                        min="7"
                                        v-model.number="time_limit_question"
                                        ref="time_limit_question"
                                        required
                                        :disabled="action != 'create'"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Questions</h1>
                    <button
                        class="btn btn-outline-primary btn-sm rounded-circle float-right"
                        @click="showModalQuestion()"
                        ref="btnAddQuestion"
                        v-if="action == 'create'"
                    >
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="card-body" v-if="questions.length">
                    <table class="table table-sm mb-2">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Options</th>
                                <th width="40px" v-if="action == 'create'"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(q, q_idx) in questions" :key="q_idx">
                                <td>{{ q.question }}</td>
                                <td>
                                    <ul class="list-unstyled list-questions">
                                        <li
                                            v-for="(o, o_idx) in q.options"
                                            :key="o_idx"
                                            :class="{
                                                correct: o.is_correct,
                                                incorrect: !o.is_correct
                                            }"
                                        >
                                            {{ o.option }}
                                        </li>
                                    </ul>
                                </td>
                                <td v-if="action == 'create'">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-danger rounded-circle"
                                        @click="deleteQuestion(q_idx)"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <form
                        :action="href"
                        method="POST"
                        @submit="saveTrivia($event)"
                        v-if="action == 'create'"
                    >
                        <input type="hidden" name="_token" :value="csrf" />
                        <input
                            type="hidden"
                            name="data"
                            :value="JSON.stringify(dataTrivia)"
                        />
                        <button class="btn btn-outline-primary float-right">
                            <i class="fas fa-save"></i> Save Trivia
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal " tabindex="-1" role="dialog" id="newQuestionModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content" v-if="action == 'create'">
                    <div class="modal-header">
                        <h5 class="modal-title">New Question</h5>
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
                        <form action="" @submit="addQuestion($event)">
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Question?"
                                    v-model="question.question"
                                    maxlength="145"
                                    ref="question_name"
                                    required
                                />
                            </div>
                            <div
                                class="input-group mb-2"
                                v-for="(option, idx) in question.options"
                                :key="idx"
                            >
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input
                                            type="radio"
                                            name="option"
                                            :checked="option.is_correct"
                                            :value="idx"
                                            v-model="question.optionCorrect"
                                            required
                                        />
                                    </div>
                                </div>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="option.option"
                                    :placeholder="'Option ' + (idx + 1)"
                                    maxlength="95"
                                    required
                                />
                            </div>
                            <button
                                type="subbmit"
                                class="btn btn-primary float-right"
                            >
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.btn:focus {
    box-shadow: 0px 0px 0px 5px rgb(0 0 0 / 20%);
}
.list-questions {
    padding-left: 20px;
}
.list-questions li:before {
    content: "";
    width: 8px;
    height: 8px;
    position: absolute;
    border-radius: 50%;
    transform: translate(-18px, 7px);
}
.list-questions li.correct:before {
    background: var(--success);
}
.list-questions li.incorrect:before {
    background: var(--secondary);
}
</style>
<script>
export default {
    props: {
        action: String,
        trivia: Object,
        minQuestions: {
            type: Number,
            default: 4
        }
    },
    data() {
        return {
            name: null,
            started_at: null,
            end_date: null,
            time_limit_question: 0,
            question: this.defaultQuestionData(),
            questions: [],
            dataTrivia: {},
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            href: '/trivias'
        };
    },
    methods: {
        defaultQuestionData() {
            return {
                question: null,
                optionCorrect: null,
                options: [
                    { option: null, is_correct: false },
                    { option: null, is_correct: false },
                    { option: null, is_correct: false },
                    { option: null, is_correct: false }
                ]
            };
        },
        showModalQuestion() {
            this.question = this.defaultQuestionData();
            $("#newQuestionModal").modal("show");
            this.$refs.question_name.focus();
        },
        addQuestion(e) {
            e.preventDefault();
            this.questions.push(this.question);
            $("#newQuestionModal").modal("hide");
            this.$refs.btnAddQuestion.focus();
        },
        deleteQuestion(idx) {
            this.questions.splice(idx, 1);
        },
        getOptionCorrect() {
            let idx = this.question.options.findIndex(
                option => option.is_correct
            );
            if (idx >= 0) {
                this.question.optionCorrect = idx;
            }
        },
        saveTrivia(e) {
            // e.preventDefault();
            if (this.questions.length < this.minQuestions) {
                alert('You must add minimum ' + this.minQuestions + ' questions')
                e.preventDefault();
                return false;
            }

            this.dataTrivia = {
                name: this.name,
                started_at: this.started_at,
                end_date: this.end_date,
                time_limit_question: this.time_limit_question,
                questions: this.questions
            };
            let ValidateForm =  ['name','started_at','end_date','time_limit_question']
            for (let i = 0; i < ValidateForm.length; i++) {
                if(!this.dataTrivia[ValidateForm[i]] && this.dataTrivia[ValidateForm[i]] !== 0){
                    alert('The field: ' + ValidateForm[i] + ' is required')
                    this.$refs[ValidateForm[i]].focus();
                    e.preventDefault();
                    return false;
                }
            }
            return true;
        }
    },
    watch: {
        "question.optionCorrect": function(newVal, oldVal) {
            this.question.options.forEach((option, idx) => {
                option.is_correct = idx == newVal;
            });
        }
    },
    mounted() {
        this.$refs.name.focus();
        if(this.trivia){
            this.name = this.trivia.name
            this.started_at = this.trivia.started_at
            this.end_date = this.trivia.end_date
            this.time_limit_question = this.trivia.time_limit_question
            this.questions = this.trivia.questions
        }
    }
};
</script>
