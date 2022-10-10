<template>
    <div class="modal fade" id="popupWFH" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Update Work location</h1>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="workLocation">Where are you working from today?</label>
                        <select name="workLocation" class="form-control" v-model="location">
                            <option value="" selected disabled>Select Option</option>
                            <option value="home">Home</option>
                            <option value="site">Site</option>
                        </select>
                    </div>
                    <div class="alert alert-danger text-center" v-if="errorMsg">
                        <i class="fas fa-exclamation-triangle"></i> {{errorMsg}}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <div class="text-center text-info"  v-if="saving">
                            <i class="fas fa-spinner fa-pulse fa-2x"></i>
                        </div>
                        <button class="btn btn-outline-primary" id="popupWFHSave" type="submit" @click="saveWFH" v-else>
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from "moment";
export default {
    data() {
        return {
            enable: true,
            saving:false,
            location: '',
            errorMsg: '',
        }
    },
    methods: {
        checkWFH(){
            let lastUpdateWFH = localStorage.getItem('wfh')
            if(lastUpdateWFH){
                if(moment().diff(moment(Date.parse(lastUpdateWFH)),'days')){
                    $('#popupWFH').modal('show')
                }
            }else{
                $('#popupWFH').modal('show')
            }
        },
        saveWFH(){
            if(this.location && !this.saving){
                this.saving = true;
                this.errorMsg = '';
                axios.post("/masterfile/wfh/update", {location: this.location})
                .then(response => {
                    $('#popupWFH').modal('hide')
                    this.saving = false;
                    localStorage.setItem("wfh",new Date())
                }).catch(error=> {
                    console.log(error.response);
                    this.errorMsg = `Error ${error.response.status} ${error.response.data.message}`
                    this.saving = false;
                });
            }
        }
    },
    mounted(){
        this.checkWFH();
    }
}
</script>