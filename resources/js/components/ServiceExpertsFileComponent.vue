<template>

    <div class="row">
        


    <div class="col-sm-12 row" v-if="permissions.filesupload">
        <div class="col-sm-6">
            <input type="file" id="file-input" class="d-none" ref="fileUpload" accept=".doc,.docx,.xls,.xlsx,.xlsm,.xlsb,.pptx,.pdf" v-on:change="onChangeFileUpload">
            <label for="file-input" class="input-group mb-0" >
                <span class="form-control border-danger">{{ fileName }} </span>
                <div class="input-group-prepend">
                    <span class="btn btn-danger"> <i class="fa fa-upload"></i> </span>
                </div>
            </label>
        </div>
        <div class="col-sm-6">
            <div class="input-group mb-0" >
                <input type="text" class="form-control border-danger" v-model="new_directory" placeholder="New directory">
                <div class="input-group-prepend">
                     <button class="btn btn-danger" type="button" @click="createDirectory">
                         <i class="fas fa-folder-plus"></i>
                     </button>
                </div>
            </div>
        </div>
        <div class="col-sm-12" v-if="progress">
            <div class="progress" style="height: 5px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="'width: '+ progress + '%;'" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-right bg-transparent mb-0" >
                <template v-for="(folder, index) in arrPath" >
                    <li :key="index"  v-if="(index>0)" :class="'breadcrumb-item ' + (arrPath.slice(0,index+1).join('/') == dirpath ? 'active' : '')" >
                        <a href="#" @click="openDirectory(arrPath.slice(0,index+1).join('/'))">{{folder}} </a>
                    </li>
                </template>
            </ol>
        </nav>
    </div>

    <div class="col-sm-12">
            <div class="row align-items-center mb-1" v-for="xFile in files" v-bind:key="xFile.id">
                <div class="col">
                    <div class="card border-0 mb-0">
                        <div class="card-body p-2 row align-items-center">
                            <div class="col-1 text-right">
                                <i :class="getIcon(xFile)"></i>
                            </div>
                            <div class="col">
                                <div class="title-project">
                                    <!-- {{ xFile.name }} -->
                                    <a href="#" class="text-primary"  v-if="xFile.folder == 1" @click="openFolder(xFile.name)">{{xFile.name}}</a>
                                    <a :href="'serviceexperts/files/' + xFile.id" v-if="xFile.folder == 0">{{xFile.name}}</a>
                                    <!-- <a href="{{ route('serviceexperts.filesdownload', $file->id) }}">{{ pathinfo($file->name)['filename'] }}</a>  -->
                                </div>
                                <div>
                                    <small>{{xFile.created_at}}</small>
                                </div>
                            </div>

                            <div class="col-1" v-if="permissions.filesdelete">
                                <a href="#" @click="deleteFile(xFile)" class="text-danger"><i class="far fa-trash-alt"></i></a> 
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
        props:["path_init","permissions"],
        data(){
            return{
                fileUpload:null,
                dirpath: null,
                arrPath:[],
                new_directory: null,
                files: [],
                progress:null
            }
        },
        methods:{
            deleteFile(file){

                  swal
                    .fire({
                        title: "Are you sure ?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes"
                    })
                    .then(result => {
                        if (result.value) {

                            axios
                            .post("/serviceexperts/files/delete", file)
                            .then(response => {
                                if(response.data == 'success'){
                                    this.loadDirectory();
                                }else{
                                    console.log(response);
                                }
                            });
                            // console.log(file);
                        }
                    });
            },
            onChangeFileUpload(){
                this.fileUpload = this.$refs.fileUpload.files[0];
                if(this.fileUpload) this.uploadFile()
            },
            createDirectory(){
                if (this.new_directory) {
                    axios.post("/serviceexperts/createdirectory",{
                        name:this.new_directory,
                        dir: this.dirpath
                    })
                    .then(res =>{
                        if(res.data.result == 'created'){
                            this.loadDirectory();
                        }else{
                            swal.fire({
                                icon: 'error',
                                title: res.data.message,
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    })

                    this.new_directory = null;
                }
            },
            openFolder(nameFolder){
                this.dirpath+=('/'+ nameFolder);
                this.loadDirectory();
            },
            openDirectory(nameDir){
                this.dirpath = nameDir;
                this.loadDirectory();
            },
            uploadFile(){
                const self = this;

                const config = {
                    headers: {
                            'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: function(progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)
                    self.progress = percentCompleted;
                    }
                }

                let formData = new FormData();
                formData.append('file', this.fileUpload);
                formData.append('dir', this.dirpath);

                axios.post("/serviceexperts/uploadFiles",formData,config)
                .then(res => {
                    this.progress = null;
                    this.fileUpload = null;
                    this.loadDirectory();
                })
                .catch(err => console.log(err.response))
            },
            loadDirectory(){

                this.arrPath = this.dirpath.split("/");
                console.log(this.dirpath);
                axios.get("/serviceexperts/getdirectory", {
                    params:{
                        dirpath:this.dirpath 
                    }
                    })
                .then( res => {
                    this.files = res.data ;
                    })
            },
            getIcon(file){
                let ext = (file.folder ==1 ? 'folder' : file.name.split('.').pop());
                

                switch (ext) {
                    case 'docx':
                        return "far fa-file-word text-muted fa-2x align-middle mr-2"
                        break;        
                    case 'pptx':
                        return "far fa-file-powerpoint text-muted fa-2x align-middle mr-2"
                        break;
                    case 'pdf':
                        return "far fa-file-pdf text-muted fa-2x align-middle mr-2"
                        break;
                    case 'xlsx':
                        return "far fa-file-excel text-muted fa-2x align-middle mr-2"
                        break;
                    case 'folder':
                        return "fas fa-folder-open text-primary fa-2x align-middle mr-2"
                        break;
                    default:
                        return "far fa-file text-muted fa-2x align-middle mr-2"
                        break;
                }
            }
        },
        computed:{
            fileName(){
                if(this.fileUpload){
                    return this.fileUpload.name
                }else{
                    return 'Select File'
                }
            },
        },
        mounted() {
            this.dirpath = this.path_init;
            this.loadDirectory();
            console.log(this.permissions);
        }
    }
</script>
