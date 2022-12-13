<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity .5s
}

.fade-enter,
.fade-leave-to {
    opacity: 0
}
</style>
<template>
  <div class="card">
    <div class="card-body">
      <!-- <div class="jumbotron {{ ($userActivity ? $userActivity->name : '')}}"> -->
      <div class="jumbotron text-light mb-0"   :style="(useractivity ? 'background-color:'+useractivity.color+';' : '')  ">
        <div class="row align-items-center">
          <div class="col-sm-4 col-md-3 d-none d-sm-block">
            <i :class="(useractivity ? useractivity.icon : '') + ' fa-4x'"></i>
          </div>
          <div class="col-sm-8 col-md-6">
            <span>Activity:</span>
            <h1 class="display-4">{{ (useractivity ? useractivity.name : 'N/A')}}</h1>
          </div>

          <div class="col-md-3 display-4 text-nowrap text-center">
            <hr class="d-md-none" />
            <small v-if="useractivity && useractivity.id != 2" class="font-weight-light">
              <timer-component :timeserver="timeserver" :useractivity="useractivity" @time="changeTime"></timer-component>
            </small>
          </div>
        </div>
      </div>
      <div class="row mt-4" v-if="showButtons && !savingActivity">
        <div
          v-for="activity in activities"
          :key="activity.id"
          class="col-xl-3 col-md-6 mb-1 btn-activity"
          @click="changeActivity(activity.id)"
        >
          <div :class="'card  h-100 py-2'" :style="'background-color:'+activity.color+';'">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="h5 mb-0 font-weight-bold title-activity">{{ activity.name }}</div>
                </div>
                <div class="col-auto">
                  <i :class="activity.icon + ' fa-2x'"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    activities: {
      type: Array,
      required: true
    },
    useractivity:{
        type: Object
    },
    timeserver:{
      type: String
    }
  },
  data(){
    return {
      showButtons: true,
      savingActivity: false,
    }
  },
  methods: {
    changeTime(time) {
      if(this.useractivity.time_limit){
        if(((time.hours *60)+time.minutes) < this.useractivity.time_limit){
          this.showButtons = false;
        }else{
          this.showButtons = true;
        }
      }
    },
    changeActivity(id) {
        swal
          .fire({
            title: "Are you sure ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            showLoaderOnConfirm: true,
            preConfirm: ()=>{
              return axios
                .post("/agentactivity", {
                  idActivity: id
                })
                .then(response => {
                  this.savingActivity = true;
                  this.sendEventActivity({
                    userID: my_userID,
                    idActivity: id
                  });
                });
            }
          })
          .then(result => {
            if (result.value) {
              console.log('OK');
            }
          });
          let activity = this.activities.find(a=>a.id==id)
          if(activity.time_limit) swal.showValidationMessage(`You will not be able to change this activity before ${activity.time_limit} minutes`)
    },
    sendEventActivity(data) {
      let iframe = document.getElementById("ifm_activity");
      console.log("send");
      var domain = "http://" + window.location.hostname + ':3000/';
      iframe.contentWindow.postMessage(JSON.stringify(data), domain);
      window.location.reload();
    }
  },
  created(){
    //   console.log(this.useractivity);
  }
};
</script>