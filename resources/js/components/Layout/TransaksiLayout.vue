<template>
    <div id="homeLayout" class="transaksi">
        <nav class="navbar" role="navigation" aria-label="main navigation">
         <div class="container">
            <div class="navbar-brand">
                            <router-link :to="{name: 'Landing'}" class="navbar-item" style="color: white">
                            <img src="/images/logo.png" height="40" style="margin-right: 20px;">
                            AMiHealthy
                            </router-link>
            </div>
         </div>
                        
    </nav>

<div class = "container" style="padding-top: 70px;">
    <div class = "notification is-light">
        <div class="columns">
            <div class="column is-four-fifths">
                <div class="field box">
                    <p class = "subtitle is-2"><strong>Formulir</strong></p>
                    <label class="label">Nama Lengkap</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="">
                    </div>
    
                    <label class="label">Tanggal Lahir</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="">
                    </div><br>
                    
                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <div class="level-item"><label class="label">Provinsi</label></div>
                                <div class="control cek">
                                    <input class="input" type="text" placeholder="">
                                </div>
                            </div>
                            <div class="level-item">
                                <div class="level-item"><label class="label">Kota</label></div>
                                <div class="control cek1">
                                    <input class="input" type="text" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <div class="level-item"><label class="label">Kecamatan</label></div>
                                <div class="control">
                                    <input class="input" type="text" placeholder="">
                                </div>
                            </div>
                            <div class="level-item">
                                <div class="level-item"><label class="label">Kelurahan</label></div>
                                <div class="control">
                                    <input class="input" type="text" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                      <div class="field">
                    <label class="label">Alamat</label>
                    <div class="control">
                        <textarea class="textarea" placeholder=""></textarea>
                    </div>
                </div>
                 <div class="field">
                    <label class="label">Jenis Kelamin</label>
                    <div class="control">
                        <label class="radio">
                        <input type="radio" name="question">
                        Pria
                        </label>
                        <label class="radio">
                        <input type="radio" name="question">
                        Wanita
                        </label>
                    </div>
                    <label class="label">Nomor Handphone</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="">
                    </div>
                </div>
                
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">Simpan Perubahan</button>
                    </div>
                </div>
                </div>
                    
              
                    
               
                <div class="box">
                        <article class="media">
                            <div class="media-left">
                            <figure class="image is-64x64">
                                <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                            </figure>
                            </div>
                            <div class="media-content">
                            <div class="content">
                                <p><strong>Barang yang Anda Pesan</strong></p>
                                <p>Nama </p>
                                <p>Warna : </p>
                                <p>Ukuran :</p>
                                <p>Jumlah :</p>
                            </div>
                            </div>
                        </article>
                        </div>    
            </div> 
            <div class="column">
                <div class="box">
 <p><strong>Ringkasan Pemesanan</strong></p>
                <p>Total Pembayaran: Rp. xxxx</p>
                </div>
               
            </div> 
            </div>
        </div>

          
                  
                
    </div>
    </div>
</template>
