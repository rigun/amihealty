<template>

    <div id="subkategori">

        <div class="box">
            <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
            <ul>
                <li style="margin-top: 4px;"><router-link :to="{name:'Landing'}">Home</router-link></li>
                <li class="is-active"><a href="#" aria-current="page">{{$route.params.kategori}}</a></li>
            </ul>
            </nav>
            <h1 style="text-align: center">{{$route.params.kategori}}</h1>
            <hr>
            <div class="container">
            <div class="columns is-multiline">
                <div class="column is-one-third" v-for="subkategori in subkategoris" :key="subkategori.id">
                    
                <router-link :to="{ name: 'List', params: { subkategori: subkategori.name, kategori: $route.params.kategori }}" class="slideHover" >
                    <div style="padding: 5px 40px;">
                                <img :src="'../../images/kategori/subkategori/' + subkategori.filename">
                    </div>
                </router-link>
                <p class="kategoriName"> {{subkategori.name}}</p>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted(){
        this.getSubkategori();
    },
    data(){
        return{
            subkategoris: [],
        }
    },
    methods:{
        getSubkategori(){
            let url = '/api/subkategori/'+this.$route.params.kategori;
            axios.get(url).then((response) => {
                    this.subkategoris = response.data;
                    this.$nextTick(()=>{
                        this.jssor_1_slider_init();
                    })
                })
                .catch(error =>{
                    console.log(error);
                });
        }
    }
}
</script>
