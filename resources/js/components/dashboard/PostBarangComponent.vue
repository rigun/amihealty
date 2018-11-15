<template id="admin-list">
<div id="dashboarComponent" class="contentlist">
<div class="flex-container">
      <div class="columns m-t-10">
        <div class="column">
          <h1 class="title">Post Barang</h1>
        </div>
        
      </div>
      <div class="columns is-multiline">
          <div class="column is-one-third" >
                <div class="box-upload">
                    <div class="uploadSubject">
                   <p class="plus">+</p>
                    <p class="deskripsi">Upload Barang</p>
                    </div>

                </div>
                <div class="box-upload is-button-upload" @click="isComponentModalActive = true;">

                </div>
               
          </div>
          <div class="column is-one-third">
              <div class="field">
                    <label class="label">Ajukan Warna</label>
                    <div class="control">
                        <chrome-picker v-model="color"></chrome-picker>
                    </div>
                    <br/>
                     <b-field label="Nama Warna">
                            <b-input
                                type="text"
                                v-model="colorName" expanded
                                >
                            </b-input>
                        </b-field>
                    <a class="button is-info" @click="addWarna">Tambahkan</a>
                    <label class="label">Warna Tesedia</label>
                    <div class="columns is-multiline">
                        <div class="column is-3" v-for="color in colors" :key="color.id">
                            <div class="box" :style="'background-color :'+color.kodeWarna" style="max-width: 40px;"></div>
                        </div>
                    </div>
                </div>
          </div>
          <div class="column is-one-third">
              <div class="field">
                    <label class="label">Ajukan Ukuran</label>
                     <b-field label="Ukuran">
                            <b-input
                                type="text"
                                v-model="sizeName" expanded
                                >
                            </b-input>
                        </b-field>
                       <div class="field">
                           <label >Type</label>
                            <div class="control">
                                <div class="select is-small">
                                <select v-model="typeUkuran">
                                    <option>Sepatu</option>
                                    <option>Baju</option>
                                    <option>Celana</option>
                                </select>
                                </div>
                            </div>
                            </div>
                    <a class="button is-info" @click="addUkuran">Tambahkan</a>
                    <label class="label">Ukuran Tesedia</label>
                    <div class="columns is-multiline">
                        <div class="column is-3" v-for="ukuran in ukurans" :key="ukuran.id">
                            <div class="box" style="max-width: 40px;padding: 5px;text-align: center">{{ukuran.nama}}</div>
                        </div>
                    </div>
                </div>
          </div>
          <div class="column is-one-third" v-for="barang in Relations" :key="barang.id" >
              <div class="box">
                <div class="info">
                    <span class="tag is-primary is-medium">{{barang.kategori[0].name}}</span>
                    <span class="tag is-primary" v-for="sub in barang.subkategori" :key="sub.id" >{{sub.name}}</span>
                    <img :src="'../images/barang/'+barang.filename" alt="">
                    <p class="namaBarang"> {{barang.nama}}</p>
                    <p class="hargaBarang"> Rp. {{barang.harga}}</p>
                    
                    <br>
                    <div class="columns">
                        <div class="column">
                        <button class="button button-primary is-danger" @click="deleteBarang(barang.id)">Hapus Barang </button>
                            
                        </div>
                        <div class="column">
                        <button class="button button-primary is-info" @click="copyToClipboard(barang.slug,'http://127.0.0.1:8000/detaillist/')">Copy Url</button>

                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div><!-- end of Barang -->

      
</div> <!-- end of container-->
 <b-modal :active.sync="isComponentModalActive" has-modal-card>
            <modal-form :warnas="colors" :ukurans="ukurans" :kategoris="kategoris" v-on:get-barang="getBarang"></modal-form>
        </b-modal>
</div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
import { Chrome } from 'vue-color';
const ModalForm = {
    props: ['kategoris','warnas','ukurans'],
        data(){
            return{
                load: false,
                barangImage: null,
                nama: '',
                deskripsi: '',
                berat: 0,
                harga: 0,
                stok : 0,
                kat_id: null,
                sub: [],
                ukuran: [],
                warna: [],
                slug: '',
                url: 'http://127.0.0.1:8000',
            }
        },
        template: `
            <form @submit.prevent="senddata();load = true">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title" >Tambahkan Barang</p>
                    </header>
                    <section class="modal-card-body">
                    <div v-if="barangImage == null">
                        <b-field style="text-align:center">
                            <b-upload v-model="barangImage"
                                drag-drop >
                                <section class="section">
                                    <div class="content has-text-centered">
                                        <p>
                                            <b-icon
                                                icon="upload"
                                                size="is-large">
                                            </b-icon>
                                        </p>
                                        <p>Drop your files here or click to upload</p>
                                    </div>
                                </section>
                            </b-upload>
                        </b-field>
                        </div>
                        <div style="text-align:center;" v-else>
                            <img style="width: 150px" :src="previewBarang" alt="img">
                            <a @click="barangImage = null" class="button is-danger">Ganti</a>
                        </div>
                        <p class="control">
                                <slug-widget :url="url+'/'" subdirectory="detaillist" :title="nama" @copied="slugCopied" @slug-changed="updateSlug"></slug-widget>
                                <input type="hidden" v-model="slug" name="slug" />
                            </p>
                        <b-field label="Nama">
                            <b-input
                                type="text"
                                v-model="nama" expanded
                                required>
                            </b-input>
                        </b-field>
                        <b-field label="Harga">
                            <b-field>
                                <p class="control">
                                    <button class="button" disabled>
                                        Rp
                                    </button>
                                </p>
                                <b-input type="number" v-model="harga" expanded required></b-input>
                            </b-field>
                        </b-field>
                    <b-field grouped >
                        <b-field label="Berat">
                            <b-field >
                                <b-input type="number" v-model="berat"  required></b-input>
                                <p class="control">
                                    <span class="button is-static">gram</span>
                                </p>
                            </b-field>
                        </b-field>
                       
                            
                        
                        <b-field label="Stok">
                                <b-input type="number" v-model="stok"  required></b-input>
                        </b-field>
                        
                    </b-field>
                    <div class="field is-horizontal">
                        
                            <div class="field-body">
                                <div class="field">
                                        <label for="name" class="label">Kategori</label>
                                    <p class="control is-expanded has-icons-right">
                                        <span class="select">
                                        <select v-model="kat_id" v-if="sub.length ==0 ">
                                            <option v-for="cat in kategoris" :key="cat.id" :value="cat.id">{{cat.name}}</option>
                                        </select>
                                        <select v-model="kat_id" disabled v-if="sub.length !=0 ">
                                            <option v-for="cat in kategoris" :key="cat.id" :value="cat.id">{{cat.name}}</option>
                                        </select>
                                        </span>
                                        
                                    </p>
                                </div>
                                <div class="field" v-if="kat_id != null">
                                        <label for="name" class="label">Subkategori</label>

                                    <p class="control is-expanded has-icons-right">
                                         <b-dropdown hoverable>
                                            <a class="button" slot="trigger">
                                                <span>Subkategori</span>
                                                <b-icon icon="menu-down"></b-icon>
                                            </a>
                                            <div v-for="cat in filterSubcategory" :key="cat.id">
                                                <b-dropdown-item v-for="subkat in cat.subkategori" :key="subkat.id" >
                                                    <div class="field" >
                                                            <b-checkbox v-model="sub" :native-value="subkat.id" >{{subkat.name}}</b-checkbox>
                                                    </div>  
                                                </b-dropdown-item>
                                            </div>
                                        </b-dropdown>
                                
                                        
                                    </p>
                                </div>
                            </div>
                        </div>
                    <div class="field is-horizontal">
                        
                            <div class="field-body">
                                <div class="field" >
                                        <label for="name" class="label">Warna</label>

                                    <p class="control is-expanded has-icons-right">
                                         <b-dropdown hoverable>
                                            <a class="button" slot="trigger">
                                                <span>Warna</span>
                                                <b-icon icon="menu-down"></b-icon>
                                            </a>
                                                <b-dropdown-item v-for="war in warnas" :key="war.id" >
                                                    <div class="field" >
                                                            <b-checkbox v-model="warna" :native-value="war.id" :style="'color:'+war.kodeWarna">{{war.nama}}</b-checkbox>
                                                    </div>  
                                                </b-dropdown-item>
                                        </b-dropdown>
                                
                                        
                                    </p>
                                </div>
                                <div class="field" >
                                        <label for="name" class="label">Ukuran</label>

                                    <p class="control is-expanded has-icons-right">
                                         <b-dropdown hoverable>
                                            <a class="button" slot="trigger">
                                                <span>Ukuran</span>
                                                <b-icon icon="menu-down"></b-icon>
                                            </a>
                                                <b-dropdown-item v-for="size in ukurans" :key="size.id" >
                                                    <div class="field" >
                                                            <b-checkbox v-model="ukuran" :native-value="size.id" >{{size.nama}}</b-checkbox>
                                                    </div>  
                                                </b-dropdown-item>
                                        </b-dropdown>
                                
                                        
                                    </p>
                                </div>
                            </div>
                        </div>
                        <b-field label="Deskripsi">
                            <b-input maxlength="200" type="textarea" v-model="deskripsi"></b-input>
                        </b-field>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-fullwidth" type="button" @click="$parent.close()">Close</button>
                        <button class="button is-primary is-fullwidth" :class="{'is-loading' : load}" >Tambahkan</button>
                    </footer>
                </div>
            </form>
        `,
        methods:{
            updateSlug: function(val) {
             this.slug = val;
            },
            slugCopied: function(type, msg, val) {
                notifications.toast(msg, {type: `is-${type}`});
            },
            senddata(){
                 let formData = new FormData();
                 formData.append('file',  this.barangImage);
                 formData.append('nama',  this.nama);
                 formData.append('deskripsi',  this.deskripsi);
                 formData.append('berat',  this.berat);
                 formData.append('harga',  this.harga);
                 formData.append('stok',  this.stok);
                 formData.append('kat_id',  this.kat_id);
                 formData.append('slug',  this.slug);
                 formData.append('sub',  JSON.stringify(this.sub));
                 formData.append('warna',  JSON.stringify(this.warna));
                 formData.append('ukuran',  JSON.stringify(this.ukuran));
                    let uri = '/api/barang';
                    axios.post(uri,formData,{
                headers: {
                    'Content-Type': 'multipart/form-data',
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                }
                }).then((response) => {
                        this.load = false;
                        this.$parent.close();
                         this.$emit('get-barang')
                    }).catch(error => {
                        this.load = false;
                        this.$parent.close()
                        this.$toast.open({
                        duration: 2000,
                        message: error,
                        position: 'is-bottom',
                        type: 'is-danger',
                        queue: false,
                    })
                    });
            }
        },
        computed: {
              filterSubcategory: function(){
                if(this.kat_id != '') {
                    return this.kategoris.filter((row, index) => {
                        
                            if(row.id == this.kat_id) return true;                       
                    });
                }
            },
            previewBarang(){
                return URL.createObjectURL(this.barangImage);
            }
        }
    }
    export default {
        components:{
            Carousel,
            Slide,
            ModalForm,
            'chrome-picker': Chrome,
        },
        data(){
            return{
                roles: localStorage.getItem('roles'),
                header: localStorage.getItem('token'),
                Relations: [],
                isComponentModalActive: false,
                kategoris: null,
                color: '#333',
                colors: [],
                colorName: null,
                sizeName: null,
                typeUkuran: 'Baju',
                ukurans:[],
            }
        },
        mounted(){
            this.getBarang();
            this.getKategori();
            this.getWarna();
            this.getUkuran();
        },
        methods:{
            getKategori(){
               let url = '/api/kategori'
               axios.get(url,{
                   headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                }).then((response) => {
                    this.kategoris = response.data;
                })
                .catch(error =>{
                    console.log(error);
                });
           },
            getWarna(){
               let url = '/api/warna'
               axios.get(url,{
                   headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                }).then((response) => {
                    this.colors = response.data;
                })
                .catch(error =>{
                    console.log(error);
                });
           },
            getUkuran(){
               let url = '/api/ukuran'
               axios.get(url,{
                   headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                }).then((response) => {
                    this.ukurans = response.data;
                })
                .catch(error =>{
                    console.log(error);
                });
           },
           getBarang(){
               let url = '/api/barang'
               axios.get(url,{
                   headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                }).then((response) => {
                    this.Relations = response.data;
                    
                })
                .catch(error =>{
                    console.log(error);
                });
           },
           deleteBarang(id){
                 this.$toast.open({
                        duration: 500,
                        message: 'Menghapus',
                        position: 'is-bottom',
                        type: 'is-info',
                        queue: false,
                    })
                let uri = '/api/barang/'+id;
                    axios.delete(uri,{
                        headers: {
                            Authorization: 'Bearer ' + localStorage.getItem('token')
                        }
                    }).then((response) => {
                         this.$toast.open({
                            message: 'Berhasil di hapus',
                            position: 'is-bottom',
                            type: 'is-success'
                        })
                        this.getBarang();
                    }).catch(error=>{
                        this.$toast.open({
                            message: 'Silahkan coba lagi',
                            position: 'is-bottom',
                            type: 'is-danger'
                        })
                    });
            },
            addWarna(){
              axios.post( '/api/warna',
                  {nama: this.colorName, kodeWarna: this.color.hex},
                {
                    headers: {
                            Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                }
            ).then((response) => {
                this.colorName = null;
                this.getWarna();
            })
            .catch(error =>{
                this.colorName = null;
                console.log(error);
            });
           },
            addUkuran(){
              axios.post( '/api/ukuran',
                  {nama: this.sizeName, type: this.typeUkuran},
                {
                    headers: {
                            Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                }
            ).then((response) => {
                this.sizeName = null;
                this.getUkuran();
            })
            .catch(error =>{
                this.sizeName = null;
                console.log(error);
            });
           },
           copyToClipboard: function(val,path) {
                let temp = document.createElement('textarea');
                temp.value = path+val;
                document.body.appendChild(temp);
                temp.select();
                try {
                    let success = document.execCommand('copy');
                    let type = (success ? 'success' : 'warning');
                    let msg = (success ? `Copied to Clipboard: ${val}` : "Copy failed, your browser may not support this feature");
                    this.$emit('copied', type, msg, val);
                    this.$toast.open({
                        duration: 5000,
                        message: 'Berhasil di copy',
                        position: 'is-bottom',
                        type: 'is-success'
                    })
                    
                } catch (err) {
                    this.$emit('copy-failed', val);
                    this.$toast.open({
                        duration: 5000,
                        message: 'Coba lagi',
                        position: 'is-bottom',
                        type: 'is-danger'
                    })
                }
               
                document.body.removeChild(temp);
            },
             
        },
        computed:{
            preview(){
                return URL.createObjectURL(this.BarangImage);
            },
            previewKategori(){
                return URL.createObjectURL(this.kategoriImage);
            },
            previewSubkategori(){
                return URL.createObjectURL(this.subkategoriImage);
            }
        }
    }
</script>
