<template>
    <div id="bag" style="padding-top: 20px;">
        <div class="box">
            <div class="card" v-for="bag in bags" :key="bag.id">
                <div class="card-content">
                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-64x64">
                            <img :src="'../images/barang/'+bag.barang.filename">
                            </p>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                            <p>
                                <strong>{{bag.barang.nama}}</strong><br>
                                Jumlah : {{bag.jumlah}} <br>
                                Harga  : Rp. {{bag.harga}} <br>
                                <span v-if="bag.warna != null">Warna : {{bag.warna.nama}}  </span><br>
                                <span v-if="bag.ukuran != null">Ukuran : {{bag.ukuran.nama}} </span>       
                            </p>
                            </div>
                            
                        </div>
                        <div class="media-right">
                            <button class="button is-danger" @click="deleteBag(bag.id)">Hapus</button>
                        </div>
                        </article>
                </div>
            </div>
                <button class="button is-success is-pulled-right" style="margin-top: 50px">Lanjut Ke Pembayaran</button>

        </div>
               
    </div>
</template>
<script>
export default {
    data(){
        return{
           bags : null,
        }
    },
      created: function() {
        this.getBag();
    },
    methods:{
        getBag(){
            this.load = false;
            let uri = '/api/bag';
            axios.get(uri,{
                  headers: {
                      Authorization: 'Bearer ' + localStorage.getItem('token')
                  }
              }).then((response) => {
                this.bags = response.data;
            });
        },
        deleteBag(id){
                 this.$toast.open({
                        duration: 500,
                        message: 'Menghapus',
                        position: 'is-bottom',
                        type: 'is-info',
                        queue: false,
                    })
                let uri = '/api/bag/'+id;
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
                     
                        this.getBag();
                    }).catch(error=>{
                        this.$toast.open({
                            message: 'Silahkan coba lagi',
                            position: 'is-bottom',
                            type: 'is-danger'
                        })
                    });
            },
    }
}
</script>
