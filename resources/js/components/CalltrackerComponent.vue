<template>
  <div>
    <div class="form-group">
      <label for="site_id">Site ID</label>
      <input type="number" v-model="site_id" class="form-control" v-bind:class="{'is-invalid':validation('site_id')}" required autofocus />
       <span class="invalid-feedback" v-if="validation('site_id')" role="alert">{{ validationErrors.site_id[0] }}</span>
    </div>

    <div class="form-group">
      <label for="category">Category</label>
      <select2-component
        name="category"
        id="category"
        class="form-control"
        :validation="validation('category')"
        :options="categories"
        @input="getCategory"
      ></select2-component>
      <span class="invalid-feedback" v-if="validation('category')" role="alert">{{ validationErrors.category[0] }}</span>
    </div>
    <div class="form-group">
      <label for="category">Subcategory</label>
      <select2-component
        name="subcategory"
        id="subcategory"
        class="form-control"
        :validation="validation('subcategory')"
        :options="subcategories"
        @input="getSubcategory"
      ></select2-component>
      <span class="invalid-feedback" v-if="validation('subcategory')" role="alert">{{ validationErrors.subcategory[0] }}</span>
    </div>
    <div class="form-group">
      <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" id="checkPitch" v-model="checkPitch" v-on:change="loadPitch()" />
        <label class="form-check-label" for="checkPitch">Pitch ?</label>
      </div>
          <select2-component
          :group="true"
          :multiple="pitchMultiple"
          name="pitch"
          id="pitch"
          class="form-control"
          :validation="validation('pitch')"
          :options="pitchList"
          @input="getPitch"
        ></select2-component>
        <span class="invalid-feedback" v-if="validation('pitch')" role="alert">{{ validationErrors.pitch[0] }}</span>
    </div>

    <div class="form-group" v-if="checkPitch">
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="checkSale" v-model="checkSale" />
        <label class="form-check-label" for="checkSale">Was it a sale?</label>
      </div>

       <select v-model="reasonNotSale" v-if="!checkSale" class="form-control" v-bind:class="{'is-invalid':validation('sales')}">
              <option value="" disabled selected>Select Reason Not Sale</option>
              <option v-for="reason in reasonNotSaleList" v-bind:value="reason.id">{{reason.text}}</option>
        </select>

      <div class="col-sm-6 pl-0" v-if="checkSale" v-bind:class="{'is-invalid':validation('sales')}">        
        <table class="table table-sm ">
          <thead class="bg-gray">
            <tr>
              <th>Plan</th>
              <th>Contract ID</th>
              <th>Upgrade?</th>
              <th width="2px"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="sale in sales">
              <td class="font-weight-bold border-top-0">{{sale.plan}}</td>
              <td class="border-top-0">{{sale.contract_id}}</td>
              <td class="border-top-0"><i v-if="sale.upgrade" class="fas fa-check"></i></td>
              <td class="border-top-0"><button class="btn btn-sm btn-danger" v-on:click="deleteSale(sale)"><i class="fas fa-minus"></i></button></td>
            </tr>
          </tbody>
          <tfoot >
              <tr class="table-secondary">
                <td>
                  <select v-model="plan" ref="plan"  class="form-control form-control-sm">
                    <option value="" disabled >Select Plan</option>
                    <option v-for="plan in plansList" v-bind:value="plan.id">{{plan.text}}</option>
                  </select>
                </td>
                <td>
                   <input type="number" v-model="contract_id" class="form-control form-control-sm" placeholder="Contract ID">
                </td>
                <td class="text-center align-middle">
                    <input type="checkbox" v-model="upgrade">
                </td>
                <td><button class="btn btn-sm btn-primary" v-on:click="addSale"><i class="fas fa-plus"></i></button></td>
              </tr>
          </tfoot>
        </table>
      
      </div>
        <span class="invalid-feedback" v-if="validation('sales')" role="alert">{{ validationErrors.sales[0] }}</span>
    </div>

    <div class="alert alert-danger" role="alert" v-if="otherError != null" v-html="otherError"></div>
    <div class="form-group">
            <button class="btn btn-primary" @click="submitData">Submit</button>
    </div>

  </div>
</template>

<script>
export default {
  props: ["allcategories", "categories", "notpitchandsales", "plans"],

  data() {
    return {
      site_id: null,
      category: null,
      subcategory: null,
      subcategories: [],
      pitch: null,
      checkPitch: false,
      pitchMultiple: false,
      pitchList: [],
      plansList:[],
      checkSale: false,
      contract_id: null,
      upgrade:false,
      plan: "",
      sales:[],
      validationErrors:[],
      otherError: null,
      notpitch: Array(),
      notSaleBilling: [],
      notSaleService: [],
      reasonNotSale: "",
      reasonNotSaleList:[]
    };
  },
  methods: {
    getCategory(e) {
      if (e !== null && e !== "") {
        this.category = e;
        this.loadSubcategories();
        if(this.category == 'Billing'){
          this.reasonNotSaleList = this.notSaleBilling
        }else{
          this.reasonNotSaleList = this.notSaleService
        }
        this.reasonNotSale = "";
      }
    },
    loadSubcategories() {
      this.subcategory = null;
      this.subcategories = [];

      Object.entries(this.allcategories).forEach(([key, value]) => {
        if (this.category == value) {
          this.subcategories.push({
            id: key,
            text: key
          });
        }
      });
    },
    getSubcategory(e) {
      if (e !== null && e !== "") {
        this.subcategory = e;
      }
    },
    loadPitch() {
      this.pitch = null;
      this.pitchList = [];
      if (!this.checkPitch) {
        this.pitchMultiple = false;
        this.pitchList = this.notpitch; 
      } else {
        this.reasonNotSale = "";
        this.pitchMultiple = true;
        this.pitchList = this.plansList;
      }
    },
    getPitch(e) {
      if (e !== null && e !== "") {
        this.pitch = e;
      }
    },
    addSale(e){
      if(this.plan && this.contract_id){
        this.sales.push({
          plan: this.plan,
          contract_id: this.contract_id,
          upgrade: this.upgrade
        });
        this.plan = "";      
        this.contract_id = null; 
        this.upgrade = false;
        this.$refs.plan.focus();
      }
    },
    deleteSale(sale){
       this.sales.splice(this.sales.indexOf(sale),1);
    },
    submitData(){
      $('#logoLoading').modal('toggle');
      this.validationErrors =[]
      this.otherError = null
      var data = {
          site_id: this.site_id,
          category: this.category,
          subcategory: this.subcategory,
          checkPitch:this.checkPitch,
          pitch: this.pitch,
          checkSale: this.checkSale,
          sales: (this.checkSale ? this.sales : this.reasonNotSale)
        };
      axios
        .post("/enercare/calltracker",data)
        .then(response => {
          setTimeout(function() {
                $('#logoLoading').modal('toggle');   
          }, 1000);
          // console.log(response);
          
          location.reload();
        }).catch(error=>{
           setTimeout(function() {
                $('#logoLoading').modal('toggle');
            }, 1000);
          if (error.response.status == 422){
           this.validationErrors =  error.response.data.errors;
          }else{
           this.otherError = `Error ${error.response.status}: ${error.response.statusText} <br> <b>Please report it to your supervisor </b>`; 
          }
        })        
      
    },
    validation(name){
      return (name in this.validationErrors);
    }

  },
  created() {
    this.notpitchandsales.forEach(element => {
      switch (element.type) {
        case 'NotPitch':
          this.notpitch.push({id: element.name,text: element.name})
          break;
        case 'NotSaleBilling':
          this.notSaleBilling.push({id: element.name,text: element.name})
          break;
        case 'NotSaleService':
          this.notSaleService.push({id: element.name,text: element.name})
          break;      
        default:
          break;
      }
    });
    this.loadPitch();
    this.plans.forEach(element => {
      this.plansList.push({
        id: element.name,
        text: element.name
      });    
    })
  
  }
};
</script>