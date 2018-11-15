<template>
    <div id="profile">
        
                <div class="column">
                    <h1>Profile</h1>
                    <form v-on:submit.prevent ="postDetail(); load = true">
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                <label for="name" class="label">Nama Lengkap <span style="color: red">*</span></label>
                                <p class="control">
                                    <input type="text" class="input" v-model="userDetail.name" name="name" id="name">
                                </p>
                                </div>
                                <div class="field">
                                <label for="name" class="label">Email </label>
                                <p class="control">
                                     <input class="input " :class="{'is-danger': userDetail.status == 0 || userDetail.status == 2}" type="text" v-model="userDetail.email" disabled>
                                </p>
                                <p class="help is-danger" v-if="userDetail.status == 0 || userDetail.status == 2">Email belum di verifikasi</p>
                                </div>
                                <div class="field">
                                <label for="name" class="label">Tanggal Lahir <span style="color: red">*</span></label>
                                <p class="control">
                                    <input type="date" class="input" v-model="userDetail.detail.tanggalLahir" name="tanggalLahir" id="username">
                                </p>
                                </div>
                                <div class="field">
                                    <label for="name" class="label">Nomor Handphone <span style="color: red">*</span></label>
                                    <p class="control">
                                        <input type="tel" class="input" v-model="userDetail.detail.nomorHp" name="nomorHp" id="tanggalLahir" required>
                                    </p>
                                </div>
                                    <label for="jenisKelammin" class="label"> Jenis Kelamin <span style="color: red">*</span></label>

                                <div class="field">
                                <div class="control">
                                    <label class="radio">
                                    <input type="radio" value="pria" name="question" v-model="userDetail.detail.jenisKelamin">
                                    Pria
                                    </label>
                                    <label class="radio">
                                    <input type="radio" value="wanita" name="question" v-model="userDetail.detail.jenisKelamin">
                                    Wanita
                                    </label>
                                </div>
                                </div>
                                
                            </div> <!-- end of .column -->
                            </div> <!-- end of .columns for forms -->       
                        <footer class="modal-card-foot">
                            <button class="button is-success" :class="{'is-loading':load}">Perbaharui Data</button>

                        </footer>
                        </form>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            userDetail:{
                name:'',
                email: '',
                detail: {
                    tanggalLahir: new Date(),
                    nomorHp: '',
                    jenisKelamin: 'Laki-laki',
                }
            },
            load: false
        }
    },
      created: function() {
        this.getUser();
    },
    methods:{
        getUser(){
            this.load = false;
            let uri = '/api/user/detail/';
            axios.get(uri,{
                  headers: {
                      Authorization: 'Bearer ' + localStorage.getItem('token')
                  }
              }).then((response) => {
                this.userDetail = response.data;
                if(this.userDetail.name == '-'){
                    this.userDetail.name = null;
                }
                if(this.userDetail.detail == null){
                    this.userDetail.detail = {
                        tanggalLahir : new Date(),
                        nomorHp : '',
                        jenisKelamin : '',
                    }
                }
            });
        },
        postDetail(){
            let uri = '/api/user/detail';
            axios.post(uri, this.userDetail,{
                  headers: {
                      Authorization: 'Bearer ' + localStorage.getItem('token')
                  }
              }).then((response) => {
                this.getUser();
                 this.$toast.open({
                    duration: 2000,
                    message: 'Detail Berhasil update',
                    position: 'is-bottom',
                    type: 'is-success',
                    queue: false,
                });
              }).catch(error => {
                  this.getUser();
                 this.$toast.open({
                    duration: 2000,
                    message: 'Data tidak lengkap',
                    position: 'is-bottom',
                    type: 'is-danger',
                    queue: false,
                });
                });
        }
    }
}
</script>
