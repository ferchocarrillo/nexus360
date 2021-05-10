<style>
p {
  margin: 0 0 1em;
}

.comment {
  overflow: hidden;
  padding: 0 2em 1em;
  border-bottom: 1px solid #ddd;
  margin: 0 0 1em;
  *zoom: 1;
}

.comment-body {
  overflow: hidden;
}

.comment .text {
  padding: 10px;
  border: 1px solid #e5e5e5;
  border-radius: 5px;
  background: #fff;
}

.comment .text p:last-child {
  margin: 0;
  white-space: pre-wrap;
}

.comment .attribution {
  margin: 0.5em 0 0;
  font-size: 12px;
  color: #666;
}

/* Decoration */

.comments,
.comment {
  position: relative;
}

.comments:before,
.comment:before,
.comment .text:before {
  content: "";
  position: absolute;
  top: 0;
  left: 10px;
}

.comments:before {
  width: 3px;
  top: -20px;
  bottom: -20px;
  background: rgba(0, 0, 0, 0.1);
}

.comment:before {
  width: 9px;
  height: 9px;
  border: 3px solid #fff;
  border-radius: 100px;
  margin: 16px 0 0 -3px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2), inset 0 1px 1px rgba(0, 0, 0, 0.1);
  background: #ccc;
}

.comment:hover:before {
  background: orange;
}

.comment .text:before {
  top: 18px;
  left: 25px;
  width: 9px;
  height: 9px;
  border-width: 0 0 1px 1px;
  border-style: solid;
  border-color: #dae0e5;
  background: #fff;
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
}

.comment:last-child .text,
.comment:last-child .text:before {
  border-color: #17a2b8;
}

.description{
  white-space: pre-wrap;
}
</style>
<template>
  <div class="row">
    <div class="col-md-7" v-if="method == 'show'">
      <section class="comments mt-4">
        <article
          class="comment"
          v-for="comment in kaizen.comments"
          :key="comment.id"
        >
          <div class="comment-body">
            <div class="text">
              <p>{{ comment.comment }}</p>
            </div>
            <p class="attribution">
              {{ comment.created_at.substring(0, 16) }} <strong>{{comment.user.name}}</strong>
              <span class="badge float-right" 
              :class="{
                'badge-secondary':comment.status=='Pending',
                'badge-success':comment.status=='In Progress',
                'badge-info':comment.status=='Pending Review',
                'badge-warning':comment.status=='On Hold',
                'badge-danger':comment.status=='Closed',
                }"
              >{{comment.status}}</span>
            </p>
          </div>
        </article>
        <article class="comment">
          <div class="comment-body">
              <div class="text p-0">
                <textarea
                  class="form-control border-0"
                  placeholder="New Comment"
                  rows="3"
                  v-model="comment"
                ></textarea>
              </div>
              <div class="input-group mt-2">   
                <select class="custom-select custom-select-sm" v-model="kaizen.status" v-if="permission!='kaizen.operations'">
                  <option :value="stat" v-for="stat in status" :key="stat">{{stat}}</option>
                </select>
                <div :class="{'input-group-append':permission!='kaizen.operations'}">
                  <button class="btn btn-sm btn-outline-primary" @click="addComment"><i class="fas fa-plus"></i></button>
                </div>
              </div>
          </div>
        </article>
      </section>
    </div>
    <div :class="{ 'col-md-5': method == 'show', 'col-12': method != 'show' }">
      <div class="card">
        <!-- <div class="card-header">
      <h1 class="card-title">Create</h1>
    </div> -->
        <div class="card-body">
          <template v-if="method == 'show'">
            <div class="form-group">
              <label for="">Required By:</label>
              <span class="form-control form-control-sm">{{kaizen.required.name}}</span>
            </div>
            <div class="form-group" v-if="permission!='kaizen.admin'">
              <div class="form-group" v-if="kaizen.assigned">
                <label for="">Assigned To</label>
                <span class="form-control form-control-sm">{{kaizen.assigned.name}}</span>
              </div>
              <div class="form-group" v-if="kaizen.deadline">
                <label for="">Deadline</label>
                <span class="form-control form-control-sm">{{kaizen.deadline}}</span>
              </div>
            </div>
            <div class="form-group" v-if="permission=='kaizen.admin'">
              <div class="form-group">
                <label for="">Assigned To</label>
                <select name="assigned_to" class="custom-select custom-select-sm" v-model="kaizen.assigned_to">
                    <option value="" selected disabled>Select Member</option>
                    <option v-for="member in members" :key="member.id" :value="member.id">{{member.name}}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Deadline</label>
                <input type="date" class="form-control form-control-sm" v-model="kaizen.deadline">
              </div>
              <button class="btn btn-primary btn-sm btn-block" @click="assignMember"><i class="fas fa-user-check"></i></button>
              <hr>
            </div>
              <div class="form-group" v-if="kaizen.file_path">
                <a :href="'/kaizen/'+kaizen.id+'/downloadfile'" class="btn btn-block shadow btn-secondary">
                <i class="far fa-file fa-2x align-middle mr-2"></i><span>{{kaizen.file_path.name_file}}</span>
                </a>
              </div>
              <div class="form-group">
                <label for="">Title</label>
                <span class="form-control form-control-sm">{{kaizen.title}}</span>
              </div>
              <div class="form-group">
                <label for="">Group</label>
                <span class="form-control form-control-sm">{{kaizen.group}}</span>
              </div>
              <div class="form-group">
                <label for="">Campaign</label>
                <span class="form-control form-control-sm">{{kaizen.campaign}}</span>
              </div>
              <div class="form-group">
                <label for="">Type</label>
                <span class="form-control form-control-sm">{{kaizen.type}}</span>
              </div>
              <div class="form-group">
                <label for="">Status</label>
                <span class="form-control form-control-sm">{{kaizen.status}}</span>
              </div>
              <div class="form-group">
                <label for="">Description</label>
                <p class="description">{{kaizen.description}}</p>
              </div>
              <template v-if="isSchedule">
                <div class="table-responsive">
                  <table class="table table-sm">
                    <thead class="thead-dark">
                      <tr>
                        <th>#</th>
                        <template v-if="isScheduleChange">
                          <th>Date</th>
                          <th>In</th>
                          <th>Out</th>
                        </template>
                        <template v-else>
                          <th>Start Date</th>
                          <th>End Date</th>
                        </template>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(s, index) in kaizen.schedules.sc" :key="index">
                        <td>{{kaizen.schedules.national_id}}</td>
                        <template v-if="isScheduleChange">
                          <td>{{ s.date }}</td>
                          <td>{{ s.in }}</td>
                          <td>{{ s.out }}</td>
                        </template>
                        <template v-else>
                          <td>{{ s.dateIn }}</td>
                          <td>{{ s.dateOut }}</td>
                        </template>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </template>
          </template>
          <form @submit="submitKaizen" v-if="method!='show'">
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                v-model="kaizen.title"
                placeholder="Title"
                required
              />
            </div>
            <div class="form-group">
              <select
                class="custom-select"
                v-model="kaizen.group"
                @change="loadTypes"
                required
              >
                <option value="" selected disabled>Select Group</option>
                <option v-for="group in groups" :key="group" :value="group">
                  {{ group }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <select
                class="custom-select"
                v-model="kaizen.campaign"
                required
              >
                <option value="" selected disabled>Select Campaign</option>
                <option
                  v-for="campaign in campaigns"
                  :key="campaign"
                  :value="campaign"
                >
                  {{ campaign }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <select
                class="custom-select"
                v-model="kaizen.type"
                @change="changeType"
                required
              >
                <option value="" selected disabled>Select Type</option>
                <option v-for="type in typesList" :key="type" :value="type">
                  {{ type }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <div class="custom-file">
                <input
                  type="file"
                  class="custom-file-input"
                  id="customFile"
                  ref="file"
                  @change="uploadFile"
                />
                <label class="custom-file-label" for="customFile">{{
                  filename
                }}</label>
              </div>
            </div>
            <div class="form-group">
              <textarea
                class="form-control"
                maxlength="500"
                placeholder="Description"
                v-model="kaizen.description"
                required
                rows="3"
              ></textarea>
            </div>
            <template v-if="isSchedule">
              <div class="form-group">
                <select2-component
                  class="form-control"
                  required
                  :options="employessList"
                  v-model="kaizen.schedules.national_id"
                  :disabled="method == 'show'"
                ></select2-component>
              </div>
                <div class="table-responsive">
                  <table class="table table-sm">
                    <thead class="thead-dark">
                      <tr>
                        <template v-if="isScheduleChange">
                          <th>Date</th>
                          <th>In</th>
                          <th>Out</th>
                        </template>
                        <template v-else>
                          <th>Start Date</th>
                          <th>End Date</th>
                        </template>
                        <th width="30px"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="table-secondary" v-if="method != 'show'">
                        <td v-if="isScheduleChange">
                          <input
                            type="date"
                            v-model="sc.date"
                            class="form-control form-control-sm"
                          />
                        </td>
                        <td>
                          <input
                            :type="typeSC"
                            v-model="sc.in"
                            class="form-control form-control-sm"
                          />
                        </td>
                        <td>
                          <input
                            :type="typeSC"
                            v-model="sc.out"
                            class="form-control form-control-sm"
                          />
                        </td>
                        <td>
                          <button
                            class="btn btn-sm btn-success"
                            @click="addSC"
                            type="button"
                          >
                            <i class="fas fa-plus"></i>
                          </button>
                        </td>
                      </tr>
                      <tr
                        v-for="(s, index) in kaizen.schedules.sc"
                        :key="index"
                      >
                        <template v-if="isScheduleChange">
                          <td>{{ s.date }}</td>
                          <td>{{ s.in }}</td>
                          <td>{{ s.out }}</td>
                        </template>
                        <template v-else>
                          <td>{{ s.dateIn }}</td>
                          <td>{{ s.dateOut }}</td>
                        </template>
                        <td>
                          <button
                            class="btn btn-sm btn-danger"
                            @click="deleteSC(index)"
                            type="button"
                          >
                            <i class="fas fa-minus"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </template>
            <input
              type="submit"
              value="Create"
              class="btn btn-primary"
              v-if="method != 'show'"
            />
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "groups",
    "campaigns",
    "types",
    "schedules",
    "employess",
    "objkaizen",
    "status",
    "permission",
    "members",
  ],
  data() {
    return {
      kaizen: {
        title: "",
        group: "",
        campaign: "",
        type: "",
        file: null,
        schedules: {
          national_id: "",
          sc: [],
        },
        description: "",
      },
      sc: {
        date: "",
        in: "",
        out: "",
      },
      typesList: [],
      employessList: [],
      method: "create",
      comment:"",
    };
  },
  methods: {
    loadTypes(clearType = true) {
      if (this.kaizen.group != "") {
        if (clearType) this.kaizen.type = "";
        if (this.kaizen.group == "Schedules") {
          this.typesList = this.schedules;
        } else {
          this.typesList = this.types;
        }
      }
    },
    addSC() {
      if (
        (!this.isScheduleChange ||
          (this.isScheduleChange && this.sc.date != "")) &&
        this.sc.in != "" &&
        this.sc.out != ""
      ) {
        if (this.isScheduleChange) {
          this.kaizen.schedules.sc.push({
            date: this.sc.date,
            in: this.sc.in,
            out: this.sc.out,
          });
        } else {
          this.kaizen.schedules.sc.push({
            dateIn: this.sc.in,
            dateOut: this.sc.out,
          });
        }

        this.sc = {
          date: "",
          in: "",
          out: "",
        };
      }
    },
    deleteSC(i) {
      this.kaizen.schedules.sc.splice(i, 1);
    },
    changeType() {
      this.sc = {
        date: "",
        in: "",
        out: "",
      };
      this.kaizen.schedules.national_id = "";
      this.kaizen.schedules.sc = [];
    },
    uploadFile() {
      this.kaizen.file = this.$refs.file.files[0];
    },
    submitKaizen(e) {
      e.preventDefault();
      if (this.isSchedule && this.kaizen.schedules.sc.length < 1) {
        alert("Schedule changes are required");
        return;
      }

      let formData = new FormData();
      formData.append("title", this.kaizen.title);
      formData.append("group", this.kaizen.group);
      formData.append("campaign", this.kaizen.campaign);
      formData.append("type", this.kaizen.type);
      formData.append("description", this.kaizen.description);
      formData.append(
        "schedules",
        this.isSchedule ? JSON.stringify(this.kaizen.schedules) : ""
      );
      if (this.kaizen.file) {
        formData.append("file", this.kaizen.file);
      }
      $("#logoLoading").modal("toggle");
      axios
        .post("/kaizen", formData, {
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then((res) => {
          if (res.data.result == "success") {
            location.replace("/kaizen");
          } else {
            console.log(res.data);
          }
        });
    },
    addComment(){
      if(this.comment !=''){
        $("#logoLoading").modal("toggle");
        axios
          .post("/kaizen/comment",{kaizen_id:this.kaizen.id ,comment:this.comment, status:this.kaizen.status})
          .then((res)=>{
            location.reload()
          })
      }
    },
    assignMember(){
      if(this.kaizen.assigned_to!=''&&this.kaizen.deadline!=''){
        $("#logoLoading").modal("toggle");
        axios
          .post("/kaizen/assign",{kaizen_id:this.kaizen.id ,assigned_to:this.kaizen.assigned_to, deadline:this.kaizen.deadline})
          .then((res)=>{
            location.reload()
          })
      }
    }
  },

  computed: {
    isSchedule() {
      if (this.schedules.includes(this.kaizen.type)) return true;
      return false;
    },
    isScheduleChange() {
      if (this.kaizen.type == "Schedule change") return true;
      return false;
    },

    filename() {
      if (this.kaizen.file) {
        return this.kaizen.file.name;
      } else {
        return "Choose file";
      }
    },
    typeSC() {
      if (this.isScheduleChange) return "time";
      return "date";
    },
  },
  created() {
    this.employessList.push({
      id: "",
      text: "Select National ID",
      disabled: true,
    });
    this.employess.forEach((employee) => {
      this.employessList.push({
        id: employee.national_id,
        text: employee.national_id + " " + employee.name,
      });
    });

    if (this.objkaizen) {
      this.method = "show";
      this.kaizen = this.objkaizen;
      this.loadTypes(false);
    }
  },
};
</script>
