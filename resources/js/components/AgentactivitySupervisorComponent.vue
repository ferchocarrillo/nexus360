<template>
  <div>
    <table class="table table-sm">
      <thead>
        <tr class="bg-primary">
          <th width="30"></th>
          <th>Agent Name</th>
          <th>Status</th>
          <th>Time</th>
          <th width="20px"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id" :id="user.id">
          <td :class="(user.latestactivity.length ? user.latestactivity[0].name : '' )">
            <i class="fas"></i>
          </td>
          <td>{{ user.name }}</td>
          <td>{{(user.latestactivity.length ? user.latestactivity[0].name : 'N/A')}}</td>
          <td>
            <timer-component
              v-if="user.latestactivity.length && user.latestactivity[0].id != 2"
              :useractivity="user.latestactivity[0]"
              :timeserver="timeserver"
            ></timer-component>
          </td>
          <td
            @click="logoutUser(user.id)"
            v-if="user.latestactivity.length && user.latestactivity[0].name != 'Logout'"
            class="Logout"
          >
          <a href="#" class="text-white">
            <i class="fas"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props: {
    pusers: {
      type: Array,
      required: true
    },
    timeserver:{
      type: String
    }
  },
  data() {
    return {
      users: this.pusers
    };
  },
  methods: {
    logoutUser(id) {
      axios
        .post("/agentactivity/supervisor/logout", {
          idUser: id
        })
        .then(response => {
          if(response.data == 'success'){
           location.reload();
          }
        });
    },

    receiveMessage(event) {
      var localurl = window.location.href.split("/");
      if (localurl[0] + "//" + localurl[2] == event.origin) return;

      for (var i = 0; i < this.users.length; i++) {
        if (this.users[i].id == Number(event.data.userID)) {
          axios
            .get(`/agentactivity/supervisor/getActivities`)
            .then(response => {
              this.users = response.data;
              return;
            });
        }
      }
    }
  },
  mounted() {
    window.addEventListener("message", this.receiveMessage, false);
  }
};
</script>