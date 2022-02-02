<style>
.modal-backdrop.show {
    opacity: 0.8 !important;
    background-color: #231161 !important;
}
.animateButtons button:hover{
    transition: .5s;
    transform: scale(1.5);
}
</style>
<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Employee</label>
                                <select2-component
                                class="form-control"
                                :options="employess"
                                v-model="employee_id"
                                :minimumInput=4
                                @input="findId"
                                /> 
                            </div>
                        </div>
                        <template v-if="employee_id">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">PEP</label>
                                <span class="form-control"> {{employee_data.pep}} </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Fec Ingreso</label>
                                <span class="form-control"> {{employee_data.date_of_hire}} </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Campaña</label>
                                <span class="form-control"> {{employee_data.campaign}} </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Entidad</label>
                                <span class="form-control"> {{employee_data.eps}} </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Supervisor</label>
                                <span class="form-control"> {{employee_data.supervisor}} </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Basico</label>
                                <span class="form-control"> {{ (employee_data.basic_salary_cop ?  parseInt(employee_data.basic_salary_cop).toLocaleString('es-CO'):'' ) }} </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-primary float-right" @click="addNovelty">Agregar Novedad</button>
                        </div>
                        </template>
                    </div>
                    

                    
                    
                   
                                       
                </div>
            </div>
        </div>
        
        <template v-if="employee_id">

        <div class="modal fade" id="modalNovelty" tabindex="-1" role="dialog" aria-labelledby="modalNoveltyLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content shadow ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalNoveltyLabel" v-if="novelty.id">Editar Novedad {{novelty.id}}</h5>
                        <h5 class="modal-title" id="modalNoveltyLabel" v-else-if="novelty.extension_id">Crear <span class="badge badge-danger">Prorroga</span> </h5>
                        <h5 class="modal-title" id="modalNoveltyLabel" v-else>Crear Novedad</h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                        <div class="form-group border-bottom mb-2">
                                <label>Dia Descanso: <span class="badge badge-primary">{{employee_data.mandatory_rest_day}}</span> </label>
                                <span> | </span>
                                <label>Dia Compensatorio: <span class="badge badge-primary">{{employee_data.compensation_day}}</span></label>
                        </div>
                        <div class="form-group">
                            <label for="">Etiqueta</label>
                            <select :class="'custom-select ' + (novelty.tag ? '' : 'is-invalid')" v-model="novelty.tag">
                                <option :value="tag.text" v-for="tag in tags" :key="tag.text">{{tag.text}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Contingencia</label>
                            <select :class="'custom-select ' + (novelty.contingency ? '' : 'is-invalid')" v-model="novelty.contingency" @change="changeContingency">
                                <template v-for="contingency in contingencies" >
                                    <option :key="contingency.cod" :value="contingency.cod"  v-if="(novelty.extension_id && novelty.contingency == contingency.cod) || !novelty.extension_id">
                                        {{contingency.cod}} - {{contingency.name}}
                                    </option>
                                </template>
                                
                            </select>
                        </div>
                        <div class="form-group" v-if="novelty.contingency == 'EG'">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="plansaludmas" v-model="novelty.plansaludmas">
                                <label class="custom-control-label" for="plansaludmas">Plan Salud Mas</label>
                            </div>
                        </div>
                        <div class="form-group" v-if="hideFields">
                            <label for="">Cie10</label>
                            <select-2-component 
                            class="custom-select select2-hidden-accessible"
                            :class="{'is-invalid':!novelty.cie10}"
                            :minimumInput=3
                            :ajax="ajx"
                            :data="datacie10"
                            v-model="novelty.cie10"
                            @input="getCie10"
                            @searchData="listCie10s"
                            /> 
                        </div>
                        <div class="form-group" v-if="novelty.cie10 == 'SDX' && hideFields">
                            <label for="">SDX</label>
                            <input type="text" :class="'form-control ' + (novelty.cie10_description ? '' : 'is-invalid')" v-model="novelty.cie10_description">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha Inicio</label>
                                    <input type="date" id="startdate" :class="'form-control ' + (checkField.start_date ? '' : 'is-invalid')" v-model="novelty.start_date" @change="calcDias">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha Fin</label>
                                    <input type="date" :class="'form-control ' + (checkField.end_date ? '' : 'is-invalid')" v-model="novelty.end_date" @change="calcDias">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Dias/Horas</label>
                                    <input type="number" :class="'form-control ' + (checkField.days_hours ? '' : 'is-invalid')" v-model.number="novelty.days_hours">                                    
                                </div>
                            </div>
                            <div class="col-md-6" v-if="contingencies_extension.includes(novelty.contingency)">
                                <div class="form-group">
                                    <label for="">Prorroga</label>
                                    <span class="form-control">{{(novelty.extension == 1 ? 'SI' : 'NO')}}</span>
                                    <!-- <select :class="'custom-select ' + (novelty.extension === '' ? 'is-invalid' : '')" v-model="novelty.extension">
                                        <option value="">--</option>
                                        <option :value="1">SI</option>
                                        <option :value="0">NO</option>
                                    </select> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <select :class="'custom-select ' + (checkField.status ? '' : 'is-invalid')" v-model="novelty.status">
                                        <option :value="status" v-for="status in statuses" :key="status">{{status}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha Nomina</label>
                                    <input type="date" class="form-control" v-model="novelty.payroll_date">
                                </div>
                            </div>
                            <div class="col-md-6" v-if="hideFields">
                                <div class="form-group">
                                    <label for="">Dias a Recobrar</label>
                                    <input type="number" :class="'form-control ' + (checkField.days_to_recover ? '' : 'is-invalid')" v-model.number="novelty.days_to_recover" @change="daysRecover">
                                </div>
                            </div>
                             <div class="col-md-6" v-if="hideFields">
                                <div class="form-group">
                                    <label for="">Fecha Radicación</label>
                                    <input type="date" :class="'form-control ' + (checkField.date_of_filing ? '' : 'is-invalid')" v-model="novelty.date_of_filing">
                                </div>
                            </div>
                            <div class="col-md-6" v-if="hideFields">
                                <div class="form-group">
                                    <label for="">Valor Reconocido</label>
                                    <input type="number" :class="'form-control ' + (checkField.recognized_value ? '' : 'is-invalid')" v-model="novelty.recognized_value">
                                </div>
                            </div>
                            <div class="col-md-6" v-if="hideFields">
                                <div class="form-group">
                                    <label for="">Fecha Abono</label>
                                    <input type="date" :class="'form-control ' + (checkField.date_of_deposit ? '' : 'is-invalid')" v-model="novelty.date_of_deposit">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Observación</label>
                            <textarea class="form-control" cols="30" rows="10" v-model="novelty.observation"></textarea>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clearNovelty" :disabled="saving">Cancelar</button>
                        <button type="button" class="btn btn-primary" @click="saveNovelty" :disabled="saving">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-if="saving"></span>
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>CON</th>
                                <th>ETIQUETA</th>
                                <th>CONT</th>
                                <th width="800">DX</th>
                                <th>FEC INICIO</th>
                                <th>FEC FIN</th>
                                <th>D/H</th>
                                <th>PROR</th>
                                <th width="800">ESTADO / ENTIDAD</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(n,idx) in novelties" :key="n.id">
                                <td class="text-nowrap">{{n.id}}</td>
                                <td class="text-nowrap">{{n.tag}}</td>
                                <td class="text-nowrap">{{n.contingency}}</td>
                                <td class="">{{n.cie10}} - {{n.cie10_description}}</td>
                                <td class="text-nowrap">{{n.start_date}}</td>
                                <td class="text-nowrap">{{n.end_date}}</td>
                                <td class="text-nowrap">{{n.days_hours}}</td>
                                <td class="text-nowrap">{{(n.extension==0?'NO':(n.extension==1?'SI':''))}} <span v-if="n.extension_id">-{{n.extension_id}} </span> </td>
                                <td class="">{{n.status}} / {{n.eps}}</td>
                                <td>
                                    <div class="btn-group animateButtons" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-info" title="Prorroga" @click="addExtension(idx)" v-if="n.extension == 0"><i class="far fa-newspaper"></i></button>
                                        <button type="button" class="btn btn-outline-primary" title="Editar" @click="editNovelty(idx)"><i class="fas fa-pencil-alt"></i></button>
                                        <button v-if="permission_delete" type="button" class="btn btn-outline-danger" title="Eliminar" @click="deleteNovelty(idx)"> <i class="fas fa-trash"></i> </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        </template>
    </div>
</template>
<script>
    import moment from "moment";
    export default {
        props:[
            'contingencies' ,'statuses','tags','employess','smlvs', 'snovelty'
        ],
        data(){
            return {
                saving:false,
                employee_id:"",
                employee_data:{},
                novelties:[],
                permission_delete:false,
                novelty:{},
                cie10:"",
                cie10s:[],
                searchnovelty: (this.snovelty ? Object.assign({}, this.snovelty) : null),
                ajx:{
                    type:'POST',
                    url:function(params){
                        return '/payrollnovelty/cie10s';
                    },
                    data:function(params){
                        return {
                            term: params.term,
                            page: params.page
                        };
                    }
                },
                hideFieldsArr:["AT","EG","LM","LP"],
                contingencies_extension:["AT","EG"]
            }
        },
        methods:{
            findId(){
                $('#logoLoading').modal('show');
                axios.post("/payrollnovelty/findemployee",{id:this.employee_id})
                .then(res=>{
                    this.employee_data = res.data.employee_data
                    this.novelties = res.data.novelties
                    this.permission_delete = res.data.permission_delete
                    let self = this
                    setTimeout(function() {
                        $('#logoLoading').modal('hide');
                        setTimeout(function(){
                            if(self.searchnovelty){
                                let idx = self.novelties.findIndex(n=> n.id == self.searchnovelty.id)
                                if(idx>=0){
                                    self.editNovelty(idx)
                                }
                            }
                        },1000)
                    }, 1000);
                })
            },
            formatMoney(value){
                if(!value) return value;
                return value.toLocaleString('pt-br',{style: 'currency', currency: 'COP'})
            },
            addNovelty(){
                $('#modalNovelty').modal({
                    keyboard: false
                })
            },
            addExtension(i){
                let novelty_id = this.novelties[i].id;
                let contingency = this.novelties[i].contingency
                this.novelty.extension_id = novelty_id
                this.novelty.extension = 1
                this.novelty.contingency = contingency

                $('#modalNovelty').modal({
                    keyboard: false
                })
            },
            editNovelty(i){
                this.novelty = Object.assign({}, this.novelties[i])
                $('#modalNovelty').modal({
                    keyboard: false
                })
            },
            listCie10s(cie10s){
                this.cie10s = cie10s
            },
            getCie10(cie10){
                this.cie10s.forEach(i=>{
                    if(cie10==i.id){
                        this.novelty.cie10 = i.id;
                        this.novelty.cie10_description = i.text;
                    }
                })
            },
            changeContingency(){
                if(this.novelty.contingency != 'EG'){
                    this.novelty.plansaludmas = false;
                }
                if(this.contingencies_extension.includes(this.novelty.contingency)){
                    this.novelty.extension = 0;
                }else{
                    this.novelty.extension = "";
                }
            },
            clearNovelty(){
                this.novelty = {
                    plansaludmas:false,
                    tag:"PENDIENTE POR GRABAR",
                    contingency:"",
                    cie10:"",
                    cie10_description:"",
                    start_date:"",
                    end_date:"",
                    days_hours:"",
                    extension:"",
                    extension_id:"",
                    status:"NO APLICA",
                    payroll_date:"",
                    days_to_recover:"",
                    date_of_filing:"",
                    recognized_value:"",
                    date_of_deposit:"",
                    observation:""
                }
                if(this.searchnovelty){
                    window.history.pushState({}, null ,'/payrollnovelty');
                    this.searchnovelty = null;
                }
            },
            saveNovelty(){
                if(!Object.values(this.checkField).every(Boolean)){
                    alert('Se deben llenar todos los campos obligatorios')
                    return;
                }else{
                    var checkDates = this.checkDates();
                    if(checkDates.result==true){
                        this.saving= true;

                        if(this.novelty.id){
                            axios.put('/payrollnovelty/' + this.novelty.id,{novelty:this.novelty,employee:this.employee_data})
                            .then(res=>{
                                this.saving= false;
                                $('#modalNovelty').modal('hide')
                                this.clearNovelty();
                                this.findId();
                            })
                        }else{
                            axios.post('/payrollnovelty',{novelty:this.novelty,employee:this.employee_data})
                            .then(res=>{
                                this.saving= false;
                                $('#modalNovelty').modal('hide')
                                this.clearNovelty();
                                this.findId();
                            })
                        }
                        
                    }else{
                        alert(checkDates.message)
                    }

                    /*
                    
                    */
                    
                }
            },
            deleteNovelty(i){
                var id = this.novelties[i].id;
                swal
                .fire({
                    title: "Estas seguro de eliminar esa novedad ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si",
                    cancelButtonText: "Cancelar"
                })
                .then(result => {
                    if (result.value) {
                        $('#logoLoading').modal('show');
                        axios.delete("/payrollnovelty/"+id)
                        .then(response=>{
                            if(response.data.delete){
                                $('#logoLoading').modal('hide');
                                setTimeout(() => {this.findId();},1000)

                            } 
                        });
                    }
                });
                
            },
            checkDates:function(){
                var startDate = new Date(this.novelty.start_date)
                var endDate = new Date(this.novelty.end_date)
                var nId = this.novelty.id;
                if (endDate<startDate) {
                    return {result:false,message:'Fecha Inicio no debe ser mayor a Fecha Fin'}
                }
                var filterNovelties = this.novelties.filter(n=>{
                    var n_startDate = new Date(n.start_date)
                    var n_endDate = new Date(n.end_date)

                    if(nId == n.id)return false;

                    return (
                        (startDate>=n_startDate&&startDate<=n_endDate)||
                        (endDate>=n_startDate&&endDate<=n_endDate)||
                        (n_startDate>=startDate&&n_startDate<=endDate)||
                        (n_endDate>=startDate&&n_endDate<=endDate)
                    )
                })
                if (filterNovelties.length) {
                    return {result:false,message:'Ya existen novedades en ese rango de fechas'};
                }else{
                    return {result:true,message:'Fechas correctas'};
                }
            },
            calcDias(){
                if(this.novelty.start_date && this.novelty.end_date){
                    
                    this.novelty.days_hours= moment(this.novelty.end_date).diff(moment(this.novelty.start_date),'days')+1
                }
            },
            daysRecover(){
                if(this.novelty.days_to_recover && this.novelty.start_date ){
                    var date_of_hire = moment(this.employee_data.date_of_hire)
                    var start_date = moment(this.novelty.start_date)
                    var date_of_hire_NEXT_ENDOF_MONTH = date_of_hire.clone().add(1,'M').endOf('month').format("YYYY-MM-DD")
                    var date_of_hire_ENDOF_MONTH = date_of_hire.clone().endOf('month').format("YYYY-MM-DD")
                    var start_date_ENDOF_MONTH = start_date.clone().endOf('month').format("YYYY-MM-DD")

                    if(
                        (date_of_hire_NEXT_ENDOF_MONTH!=start_date_ENDOF_MONTH || 
                            (date_of_hire_NEXT_ENDOF_MONTH==start_date_ENDOF_MONTH && date_of_hire.date() == 1)
                        ) && date_of_hire_ENDOF_MONTH != start_date_ENDOF_MONTH
                    ){
                        this.novelty.status = "PTE. RECO";
                    }else{
                        this.novelty.status = "NEGADA PERIODO COTIZACION";
                    }
                }
            }

        },
        computed:{
            datacie10(){
                return {
                    value: this.novelty.cie10,
                    text: (this.novelty.cie10 ? this.novelty.cie10 + ' - ' + this.novelty.cie10_description : '')
                }
            },
            hideFields(){
                return this.hideFieldsArr.includes(this.novelty.contingency)
            },
            checkField(){
                
                var validation = {
                    tag:(this.novelty.tag ? true : false),
                    contingency:(this.novelty.contingency ? true : false),
                    cie10:((this.novelty.cie10 || !this.hideFields) ? true : false),
                    cie10_description:((this.novelty.cie10_description || !this.hideFields) ? true : false),
                    start_date:(this.novelty.start_date ? true : false),
                    end_date:(this.novelty.end_date ? true : false),
                    days_hours:(this.novelty.days_hours ? true : false),
                    extension:true,//((this.novelty.extension !=='' || !this.hideFields) ? true : false),
                    extension_id:true,//((this.novelty.extension_id || !this.hideFields || this.novelty.extension != 'SI') ? true : false),
                    status:(this.novelty.status ? true : false),
                    payroll_date:true,//(this.novelty.payroll_date ? true : true),
                    days_to_recover: true,//((this.novelty.days_to_recover || !this.hideFields) ? true : false),
                    date_of_filing: true,//((this.novelty.date_of_filing || !this.hideFields) ? true : false),
                    recognized_value: true,//((this.novelty.recognized_value || !this.hideFields) ? true : false),
                    date_of_deposit: true,//((this.novelty.date_of_deposit || !this.hideFields) ? true : false),
                }

                return validation;
            }

        },
        mounted() {
            if(!this.searchnovelty) this.clearNovelty();
            if(this.searchnovelty) this.findId();
        },
        created(){
            if(this.searchnovelty) this.employee_id = this.searchnovelty.employee_id;
        }
    }
</script>
