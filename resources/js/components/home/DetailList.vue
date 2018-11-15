<template>
    <div style="margin-top:80px">
       <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
            <ul>
                <li style="margin-top: 4px;"><router-link :to="{name:'Landing'}">Home</router-link></li>
                <li><router-link :to="{ name: 'Subkategori', params: { kategori: barang.kategori[0].name }}" >{{barang.kategori[0].name}}</router-link></li>
                <li><router-link :to="{ name: 'List', params: { subkategori: $route.params.subkategori, kategori: barang.kategori[0].name }}" >{{$route.params.subkategori}}</router-link></li>
                <li class="is-active"><a href="#" aria-current="page">{{barang.nama}}</a></li>
            </ul>
            </nav>
        <div class="container">
          <div class="columns">
            <div class="column is-three-quarters">
              <div class="box">
                  <div class="columns">
                    <div class="column is-half">
                      <img :src="'../../images/barang/'+barang.filename" alt="">
                    </div>
                    <div class="column is-half">
                      <h1>{{barang.nama}}</h1>
                      <hr>
                      <h2>Rp. {{barang.harga}}</h2>
                      <hr>
                      <div class="field is-horizontal">
                        <div class="field-label is-normal">
                          <label class="label">Jumlah</label>
                        </div>
                        <div class="field-body">
                          <div class="field">
                            <div class="control">
                              <input type="number" v-model="jumlah" value="1">
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="field" v-if="barang.ukuran.length > 0">
                          <label class="label">Ukuran</label>
                          <div class="field is-grouped">

                            <div class="control warnaRadioCustom" >
                              <label class="radio" v-for="uk in barang.ukuran" :key="uk.id">
                                <input type="radio" v-model="ukuran" name="ukuran" :value="uk.id">
                                <span class="checkmark" :style="'background-color: white;'">{{uk.nama}}</span>
                              </label>
                            </div>
                            </div>
                      </div>
                      <br>
                      <div class="field" v-if="barang.warna.length > 0">
                          <label class="label">Warna</label>
                          <div class="field is-grouped">
                            <div class="control warnaRadioCustom" >
                              <label class="radio" v-for="war in barang.warna" :key="war.id">
                                <input type="radio" v-model="warna" name="warna" :value="war.id">
                                <span class="checkmark" :style="'background-color: '+war.kodeWarna"></span>
                              </label>
                            </div>
                             
                              
                            </div>
                      </div>
                      <hr>
                      <div class="field">
                          <label class="label">Deskripsi</label>
                          <div class="field ">
                              <p class="control">
                              {{barang.deskripsi}}
                              </p>
                            </div>
                      </div>
                      
                    </div>
                  </div>

              </div>
            </div>
            <div class="column">
              

              <div class="box">
                <a class="button is-fullwidth is-warning" :class="{'is-loading' : load2}" @click="buy()">Beli Sekarang</a> <br>
                <a class="button is-fullwidth is-info" :class="{'is-loading' : load1}" @click="addtobag()">Tambah ke bag</a>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
      return{
        barang:{},
        jumlah: 1,
        warna: null,
        ukuran: null,
        token : localStorage.getItem('token'),
        load1: false,
        load2: false,
      }
    },
    mounted(){
      this.getBarang();
    },
    methods:{
      getBarang(){
         let url = '/api/barangdetail/'+this.$route.params.slug
            axios.get(url).then((response) => {
                this.barang = response.data;
            })
            .catch(error =>{
                console.log(error);
            });
      },
      addtobag(){
        this.load1 = true;
        if(this.token == null){
          this.$toast.open({
                    duration: 2000,
                    message: 'Anda Harus Login Terlebih Dahulu',
                    position: 'is-bottom',
                    type: 'is-danger',
                    queue: false,
                });
        this.load1 = false;

        }else{
            let formData = new FormData();
            formData.append('barang_id',  this.barang.id);
            formData.append('warna_id',  this.warna);
            formData.append('ukuran_id',  this.ukuran);
            formData.append('jumlah',  this.jumlah);
            var harga = this.jumlah * this.barang.harga;
            formData.append('harga',  harga);
            axios.post( '/api/bag',
                formData,
              {
              headers: {
                      Authorization: 'Bearer ' + localStorage.getItem('token')
              }
              }
          ).then((response) => {
              this.$router.push({ name: 'Bag' });
        this.load1 = false;

          })
          .catch(error =>{
              console.log(error);
               this.load1 = false;
          });
        }
      },
      buy(){
         this.load2 = true;
        if(this.token == null){
          this.$toast.open({
                    duration: 2000,
                    message: 'Anda Harus Login Terlebih Dahulu',
                    position: 'is-bottom',
                    type: 'is-danger',
                    queue: false,
                });
         this.load2 = false;

        }else{
         this.load2 = false;

        }
      }
    }
}
</script>
