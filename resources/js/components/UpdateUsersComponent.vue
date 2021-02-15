
<template>
    <div class="card row">
        <div class="card-body col-12">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>NATIONAL ID</th>
                        <th>EMAIL</th>
                        <th>FULL_NAME</th>
                        <th>POSITION</th>
                        <th>CAMPAIGN</th>
                        <th>USERNAME</th>
                        <th>ROLE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.national_id">
                        <td><i :class="'fas fa-circle text-' + (user.masterfile && user.masterfile.status  == 'Active'? 'success' : 'danger')"></i></td>
                        <td>{{user.national_id}}</td>
                        <td>{{user.email}}</td>
                        <td>{{(user.masterfile? user.masterfile.full_name : '-')}}</td>
                        <td>{{(user.masterfile? user.masterfile.position : '-')}}</td>
                        <td>{{(user.masterfile? user.masterfile.campaign : '-')}}</td>
                        <td>{{user.username}}</td>
                        <td>
                            <select class="custom-select" v-model="user.role">
                                <option v-for="role in roles" :key="role.id" :value="role.id">{{role.id}} - {{role.name}}</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <button class="btn btn-primary" @click="importUsers">Import Users</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['users','roles'],
    data(){
        return {

        }
    },
    methods:{
        importUsers(){
            if(this.checkroles()){
                axios.post("/users/uploadstore", this.users)
                .then(response => {
                    window.open('/users/upload/downloadusers','_blank')
                    location.replace('/users');
                });
            }
        },
        checkroles(){
            let check = true;
            this.users.forEach(element => {
                if(!element.role){
                    check = false;
                }
            });
            return check;
        }
    },
    created(){

    }
}
</script>