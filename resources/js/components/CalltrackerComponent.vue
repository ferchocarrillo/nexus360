<template>
  <div>
    <div class="form-group">
      <label for="site_id">Site ID</label>
      <input type="number" v-model="site_id" class="form-control" v-bind:class="{'is-invalid':validation('site_id')}" required autofocus />
       <span class="invalid-feedback" v-if="validation('site_id')" role="alert">{{ validationErrors.site_id[0] }}</span>
    </div>

    <div class="form-group">
      <label for="lob">Lob</label>
      <select2-component
        name="lob"
        id="lob"
        class="form-control"
        :validation="validation('lob')"
        :options="lobs"
        v-model="lob"
        @input="changeLob"
      ></select2-component>
      <span class="invalid-feedback" v-if="validation('lob')" role="alert">{{ validationErrors.lob[0] }}</span>
    </div>
    <div class="form-group" v-if="lob =='Service'">
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="checkServiceCall" v-model="checkServiceCall" />
        <label class="form-check-label" for="checkServiceCall">Is service call?</label>
      </div>
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select2-component
        name="category"
        id="category"
        class="form-control"
        :validation="validation('category')"
        :options="categories"
        @input="changeCategory"
        v-model="category"
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
        v-model="subcategory"
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
              <option v-for="reason in reasonsNotSale" :key="reason.id" v-bind:value="reason.id">{{reason.text}}</option>
        </select>

      <div class="col-sm-12 pl-0" v-if="checkSale" v-bind:class="{'is-invalid':validation('sales')}">        
        <table class="table table-sm ">
          <thead class="bg-gray">
            <tr>
              <th>Plan</th>
              <th>Contract ID</th>
              <th>Upgrade</th>
              <th>RWH</th>
              <th>BOGO</th>
              <th>Repair Plan</th>
              <th width="2px"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="sale in sales" :key="sale.contract_id">
              <td class="font-weight-bold border-top-0">{{sale.plan}}</td>
              <td class="border-top-0">{{sale.contract_id}}</td>
              <td class="border-top-0 text-center"><i v-if="sale.upgrade" class="fas fa-check"></i></td>
              <td class="border-top-0 text-center"><i v-if="sale.rwh" class="fas fa-check"></i></td>
              <td class="border-top-0 text-center"><i v-if="sale.bogo" class="fas fa-check"></i></td>
              <td class="border-top-0 text-center"><i v-if="sale.repairplan" class="fas fa-check"></i></td>
              <td class="border-top-0"><button class="btn btn-sm btn-danger" v-on:click="deleteSale(sale)"><i class="fas fa-minus"></i></button></td>
            </tr>
          </tbody>
          <tfoot >
              <tr class="table-secondary">
                <td>
                  <select v-model="plan" ref="plan"  class="form-control form-control-sm">
                    <option value="" disabled >Select Plan</option>
                    <option v-for="plan in plans" :key="plan" v-bind:value="plan">{{plan}}</option>
                  </select>
                </td>
                <td>
                   <input type="number" v-model="contract_id" class="form-control form-control-sm" placeholder="Contract ID">
                </td>
                <td class="text-center align-middle">
                    <input type="checkbox" v-model="upgrade">
                </td>
                <td class="text-center align-middle">
                    <input type="checkbox" v-model="rwh">
                </td>
                <td class="text-center align-middle">
                    <input type="checkbox" v-model="bogo">
                </td>
                <td class="text-center align-middle">
                    <input type="checkbox" v-model="repairplan">
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
  props: ["allcategories", "notpitchandsales", "plans"],

  data() {
    return {
      site_id: null,
      lob:null,
      category: null,
      subcategory: null,
      categories:[],
      subcategories: [],
      lobs:[],
      objLob:{
        // "Service":{
        //   "categories":{},
        //   "reasonsNot":{
        //     "Pitch":[],
        //     "Sale":[],
        //   }
        // },
        // "Billing":{
        //   "categories":{},
        //   "reasonsNot":{
        //     "Pitch":[],
        //     "Sale":[],
        //   }
        // },
        // "OBA":{
        //   "categories":{},
        //   "reasonsNot":{
        //     "Pitch":[],
        //     "Sale":[],
        //   }
        // },
      },
      pitch: null,
      checkPitch: false,
      pitchMultiple: false,
      pitchList: [],
      reasonsNotPitch:[],
      checkServiceCall: false,
      checkSale: false,
      reasonNotSale: "",
      reasonsNotSale:[],
      contract_id: null,
      upgrade:false,
      rwh:false,
      bogo:false,
      repairplan:false,
      plan: "",
      sales:[],
      validationErrors:[],
      otherError: null,
    };
  },
  methods: {
    changeLob() {
      if(this.lob){
        this.checkServiceCall = false;
        this.loadCategories();

        this.reasonsNotSale = this.objLob[this.lob].reasonsNot.Sale;
        this.reasonsNotPitch = this.objLob[this.lob].reasonsNot.Pitch;
        this.loadPitch();
      }
    },
    loadCategories(){
      this.category = null;
      this.categories = [];
      this.categories =Object.keys(this.objLob[this.lob].categories).filter(category=>{
        return this.objLob[this.lob].categories[category].subcategories.filter(subcategory => { return (subcategory.service_call && this.checkServiceCall) || (!subcategory.service_call && !this.checkServiceCall) }).length > 0;
      });
    },
    changeCategory() {
      this.subcategory = null;
      this.subcategories = [];
      if(this.lob && this.category){
        Object.entries(this.objLob[this.lob].categories[this.category].subcategories).forEach(([key,subcategory])=>{
          if((subcategory.service_call && this.checkServiceCall) || (!subcategory.service_call && !this.checkServiceCall)){
              this.subcategories.push(subcategory.subcategory);
          }
        });
      }
    },
    loadPitch() {
      this.pitch = null;
      this.pitchList = [];
      if (!this.checkPitch) {
        this.pitchMultiple = false;
        this.pitchList = this.reasonsNotPitch; 
      } else {
        this.reasonNotSale = "";
        this.pitchMultiple = true;
        this.pitchList = this.plans;
      }
    },
    getPitch(e) {
      if (e !== null && e !== "") {
        this.pitch = e;
      }
    },
    addSale(e){
      if(this.plan && this.contract_id && (this.upgrade == true && this.rwh == true) == false ){
        this.sales.push({
          plan: this.plan,
          contract_id: this.contract_id,
          upgrade: this.upgrade,
          rwh: this.rwh,
          bogo: this.bogo,
          repairplan: this.repairplan,
        });
        this.plan = "";      
        this.contract_id = null; 
        this.upgrade = false;
        this.rwh = false;
        this.bogo = false;
        this.repairplan = false;
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
          lob: this.lob,
          service_call: this.checkServiceCall,
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

  watch:{
    checkServiceCall: function(){
      this.loadCategories();
    }
  },
  created() {

    this.allcategories.forEach(category=>{
      if(!(category.lob in this.objLob)){
        this.objLob[category.lob] = {
            "categories":{},
            "reasonsNot":{
              "Pitch":[],
              "Sale":[],
            }
        }
      }
      if(!this.objLob[category.lob].categories[category.category]){
        this.objLob[category.lob].categories[category.category]  = {service_call:0,subcategories:[]};
      }
      if(this.objLob[category.lob].categories[category.category].service_call ===0 && (category.service_call ==="1" )){
        this.objLob[category.lob].categories[category.category].service_call = 1;
      }
      if(category.service_call === null)this.objLob[category.lob].categories[category.category].service_call = 0;

      this.objLob[category.lob].categories[category.category].subcategories.push({
          subcategory: category.subcategory,
          service_call: (category.service_call == null ? null : parseInt(category.service_call)),
      });
    })
    this.notpitchandsales.forEach(reason=>{
      this.objLob[reason.lob].reasonsNot[reason.type].push({
        id:reason.name,
        text:reason.name,
      });
    });

    this.lobs =Object.keys(this.objLob);



    // this.notpitchandsales.forEach(element => {
    //   switch (element.type) {
    //     case 'NotPitch':
    //       this.notpitch.push({id: element.name,text: element.name})
    //       break;
    //     case 'NotSaleBilling':
    //       this.notSaleBilling.push({id: element.name,text: element.name})
    //       break;
    //     case 'NotSaleService':
    //       this.notSaleService.push({id: element.name,text: element.name})
    //       break;      
    //     default:
    //       break;
    //   }
    // });
    // this.loadPitch();
    // this.plans.forEach(element => {
    //   .push({
    //     id: element.name,
    //     text: element.name
    //   });    
    // })
  
  }
};
</script>