<template>
  <div >
    <table class="table table-sm" id="table-users" style="width:100%">
      <thead>
        <tr class="bg-primary">
          <th width="30px"></th>
          <th>Agent Name</th>
          <th>Campaign</th>
          <th>Status</th>
          <th>Time</th>
          <th width="20px"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id" :id="user.id">
          <td class="align-middle">
              <span  v-if="user.latestactivity.length" class="btn btn-sm text-white" :style="'background-color:'+user.latestactivity[0].color + ';'">
                <i :class="(user.latestactivity.length ? user.latestactivity[0].icon : '')"></i>
              </span>
          </td>
          <td class="align-middle">{{ user.name }}</td>
          <td class="align-middle">{{ user.masterfile2[0].campaign }}</td>
          <td class="align-middle">{{(user.latestactivity.length ? user.latestactivity[0].name : '')}}</td>
          <td class="align-middle">
            <timer-component
              v-if="user.latestactivity.length && user.latestactivity[0].id != 2"
              :useractivity="user.latestactivity[0]"
              :timeserver="timeserver"
            ></timer-component>
          </td>
          <td class="align-middle">
            <a href="#" class="btn btn-sm btn-dark" @click="logoutUser(user.id)" v-if="user.latestactivity.length && user.latestactivity[0].name != 'Logout'">
              <i class="fas fa-sign-out-alt"></i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>

import datatables from 'datatables'

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
    loadTable(){
      $(function(){
        $('#table-users').DataTable({
          columnDefs: [
            {targets: [0,5], orderable: false, searchable:false}
          ],
          order: [[3,"desc"],[4, "desc"]],
          pageLength: 50
        });
      });
    },

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
  },
  created(){
    this.loadTable();
  }
};
</script>