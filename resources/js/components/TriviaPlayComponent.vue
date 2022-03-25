<template>
    <div v-if="start && !end">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">
                    {{ question.question }}
                    <span class="float-right" v-if="seconds > 0">{{
                        seconds
                    }}</span>
                </h1>
            </div>
        </div>
        <div class="row">
            <div
                class="col-md-6"
                v-for="option in question.options"
                :key="option.id"
            >
                <button
                    class="btn btn-block btn-primary mb-3 p-3"
                    @click="answerQuestion(option.id)"
                >
                    {{ option.option }}
                </button>
            </div>
        </div>
    </div>
    <div v-else-if="!start && !end">
        <div class="container text-center">
            <button class="btn btn-success" @click="startTrivia()">
                <i class="fas fa-play"></i>  Start
            </button>
        </div>
    </div>
    <div v-else>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Thank you !</h1>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";

export default {
    props: ["trivia"],

    data() {
        return {
            start: false,
            end: false,
            nQuestion: 0,
            question: {},
            seconds: 0,
            timer: null,
            answers: []
        };
    },
    methods: {
        startTrivia() {
            this.seconds = parseInt(this.trivia.time_limit_question);
            this.start = true;
            this.changeQuestion();
        },
        changeQuestion() {
            if (this.nQuestion >= this.trivia.questions.length) {
                this.endTrivia();
            } else {
                this.question = this.trivia.questions[this.nQuestion];
                if (this.trivia.time_limit_question > 0) this.startTimer();
                this.nQuestion++;
            }
        },
        answerQuestion(option = null) {
            this.answers.push({
                question_id: this.question.id,
                option_id: option,
                seconds:
                    parseInt(this.trivia.time_limit_question) - this.seconds
            });
            this.stopTimer();
            this.changeQuestion();
        },
        startTimer() {
            this.timer = setInterval(() => {
                if (this.seconds <= 0) {
                    this.answerQuestion();
                } else {
                    this.seconds--;
                }
            }, 1000);
        },
        stopTimer() {
            clearInterval(this.timer);
            this.seconds = parseInt(this.trivia.time_limit_question);
        },
        endTrivia() {
            this.end = true;
            axios
                .post("/trivias/answer", {
                    trivia_id: this.trivia.id,
                    answers: this.answers
                })
                .then(res => {
                    if(res.data){
                        location.href = '/trivias'
                    }
                });
        }
    },
    created() {}
};
</script>
