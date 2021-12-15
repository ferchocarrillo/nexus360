<template>
<div class="container">
  <button v-if="!start && !Object.keys(this.olddata).length" class="btn btn-success" @click="startForm"> <i class="fas fa-play-circle"></i>  Start</button>
  <div class="card" v-if="start">
    <div class="card-body">
        <form action="/americanwater/botracker" method="POST">
          <input type="hidden" name="_token" :value="csrf" />
          <input type="hidden" name="started_at" :value="form.started_at" />
          <div class="form-group">
            <label for="queue">Queue</label>
            <select
              name="queue"
              id="queue"
              class="form-control"
              v-model="form.queue"
              required
            >
              <option value="" selected disabled>Select Queue</option>
              <option
                v-for="(queue, index) in lists.queues"
                :key="index"
                :value="index"
              >
                {{ index }}
              </option>
            </select>
          </div>
          <template v-if="form.queue && !lists.queues[form.queue].endForm">
            <div class="form-group">
              <label for="cus_id">CUS ID</label>
              <input
                type="text"
                name="cus_id"
                id="cus_id"
                class="form-control"
                v-model="form.cus_id"
                required
              />
            </div>
            <template v-if="!lists.queues[form.queue].onlyCusID">
            <div class="form-group">
              <label for="customer_name">Customer Name</label>
              <input
                type="text"
                name="customer_name"
                id="customer_name"
                class="form-control"
                v-model="form.customer_name"
                required
              />
            </div>
            <div class="form-group">
              <label for="spreadsheet">Spreadsheet</label>
              <input
                type="text"
                name="spreadsheet"
                id="spreadsheet"
                class="form-control"
                v-model="form.spreadsheet"
                required
              />
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select
                name="status"
                id="id"
                class="form-control"
                v-model="form.status"
                required
              >
                <option value="" selected disabled>Select Status</option>
                <option
                  v-for="(status, index) in lists.statuses"
                  :key="index"
                  :value="index"
                >
                  {{ index }}
                </option>
              </select>
            </div>
            <template v-if="form.status && lists.statuses[form.status].gotoENR">
              <div class="form-group">
                <label for="enr_number">ENR Number</label>
                <input
                  type="text"
                  name="enr_number"
                  id="enr_number"
                  class="form-control"
                  v-model="form.enr_number"
                  required
                />
              </div>
              <div class="form-group">
                <label for="agreement_classification"
                  >Agreement Classification</label
                >
                <select
                  name="agreement_classification"
                  id="agreement_classification"
                  class="form-control"
                  v-model="form.agreement_classification"
                  required
                >
                  <option value="" selected disabled>
                    Select Agreement Classification
                  </option>
                  <option
                    v-for="(
                      agreement_classification, index
                    ) in lists.agreement_classifications"
                    :key="index"
                    :value="agreement_classification"
                  >
                    {{ agreement_classification }}
                  </option>
                </select>
              </div>
            </template>
            <div class="form-group">
              <label for="additional_notes">Additional Notes</label>
              <textarea
                name="additional_notes"
                id="additional_notes"
                class="form-control"
                v-model="form.additional_notes"
                required
              />
            </div>
            </template>
          </template>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Save
          </button>
        </form>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: ["olddata"],
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      lists: [],
      start: false,
      form: {
        queue: "",
        cus_id: "",
        customer_name: "",
        spreadsheet: "",
        status: "",
        enr_number: "",
        agreement_classification: "",
        additional_notes: "",
        started_at: "",
      },
    };
  },
  methods: {
    getLists() {
      axios.post("/americanwater/botracker/getlists").then((res) => {
        this.lists = res.data;
        this.form = { ...this.form, ...this.olddata };
        if (Object.keys(this.olddata).length) {
            this.start = true;
        }
      });
    },
    getDate(){
        axios.get("/getdatenow").then(res=>{
            this.form.started_at = res.data
        })
    },
    startForm(){
        this.start = true;
        this.getDate();
    }
  },

  watch: {},
  created() {
    this.getLists();
  },
};
</script>