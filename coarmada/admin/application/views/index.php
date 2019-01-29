<?php $this->load->view('header');?>
<div class="container">

      <div class="row">

        <div class="col-md-9">

          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $i=1;
                foreach ($images as $img) {
                    $player = $img->image;
                    $item = ($i == 1) ? 'item active' : 'item';
                    ?>
              <div class="carousel-<?php echo $item; ?>">
                  <img src="<?php echo base_url('assets/images/banner/').$player?>" class="d-block w-100">
                    <!-- <h3 class="figcapt img-responsive"><?php //echo $banner->title;?></h3> -->
              </div>
           
               <?php $i++;}?>
          </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

        </div>

        <div class="col-md-3">
          <div class="running-text">
                <marquee direction="up" height="320">
                  <?php foreach($running as $text) {?>
                    <?php echo $text->isi;?>
                  <?php }?>
                </marquee>
          </div>
        </div>
      </div>
    </div>
    
    <div class="container main-content">

      <div class="row">

        <div class="col-sm-2">
          <div class="dropdown">
            <button class="btn btn-primary btn-md btn-block dropdown-toggle secondary-menu" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SINTEL</button>
            
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN LID</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">LID KAMLA</a></li>
                  <li class="dropdown-item"><a href="#">LID LAKA LAUT</a></li>
                  <li class="dropdown-item"><a href="#">LID PEROMPAKAN</a></li>
                  <li class="dropdown-item"><a href="#">LID GARWIL</a></li>
                  <li class="dropdown-item"><a href="#">LID PENCURIAN</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN PAMGAL</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">PAMATDOK</a></li>
                  <li class="dropdown-item"><a href="#">SC</a></li>
                  <li class="dropdown-item"><a href="#">SURAT IJIN KERJA</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN PRODIN</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">RECORD KAMLA</a></li>
                  <li class="dropdown-item"><a href="#">LAKA LAUT</a></li>
                  <li class="dropdown-item"><a href="#">PEROMPAKAN</a></li>
                  <li class="dropdown-item"><a href="#">GARWIL</a></li>
                  <li class="dropdown-item"><a href="#">PENCURIAN</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN REN</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">PROGRAM KERJA</a></li>
                  <li class="dropdown-item"><a href="#">RENCANA OPERASI</a></li>
                  <li class="dropdown-item"><a href="#">ANGGARAN</a></li>
                </ul>
              </li>

            </ul>
          </div>
        </div>


        <div class="col-sm-2">
          <div class="dropdown">
            <button class="btn btn-primary btn-md btn-block dropdown-toggle secondary-menu" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SOPS</button>
            
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN OPS</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">JENIS OPERASI</a></li>
                  <li class="dropdown-item"><a href="#">LAP SIAP KAPAL</a></li>
                  <li class="dropdown-item"><a href="#">DISLOKASI UNSUR KRL</a></li>
                  <li class="dropdown-item"><a href="#">KAMLA</a></li>
                  <li class="dropdown-item"><a href="#">UPDATE CUACA</a></li>
                  <li class="dropdown-item"><a href="#">JENIS UNSUR</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN TIK</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">HASIL LAKS KAMLA</a></li>
                  <li class="dropdown-item"><a href="#">JARKAPLID</a></li>
                  <li class="dropdown-item"><a href="#">PENGEMBANGAN OPS</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN LAT</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">LATIHAN TNI</a></li>
                  <li class="dropdown-item"><a href="#">LATIHAN TNI AL</a></li>
                  <li class="dropdown-item"><a href="#">LATIHAN NON TNI</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN REN</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">PROGRAM KERJA</a></li>
                  <li class="dropdown-item"><a href="#">RENCANA OPERASI</a></li>
                  <li class="dropdown-item"><a href="#">ANGGARAN</a></li>
                </ul>
              </li>

            </ul>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="dropdown">
            <button class="btn btn-primary btn-md btn-block dropdown-toggle secondary-menu" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SLOG</button>
            
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN HAR</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">PERBAIKAN</a></li>
                  <li class="dropdown-item"><a href="#">FLATFORM</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN BEK</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">LOGCA</a></li>
                  <li class="dropdown-item"><a href="#">ADMINISTRASI</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN FASJAS</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">GEDUNG ASET</a></li>
                  <li class="dropdown-item"><a href="#">RUMDIS</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN BMN</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">SIMAK BMN</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN REN</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">PROGRAM KERJA</a></li>
                  <li class="dropdown-item"><a tabindex="-1" href="#">ANGGARAN</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN FASLAN</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">DERMAGA</a></li>
                  <li class="dropdown-item"><a tabindex="-1" href="#">PEMELIHARAAN</a></li>
                </ul>
              </li>

            </ul>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="dropdown">
            <button class="btn btn-primary btn-md btn-block dropdown-toggle secondary-menu" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SPERS</button>
            
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN DIK</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">PENDIDIKAN</a></li>
                  <li class="dropdown-item"><a href="#">KURSUS</a></li>
                  <li class="dropdown-item"><a href="#">LDD</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN DALPERS</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">MUTASI</a></li>
                  <li class="dropdown-item"><a href="#">SURAT PERINTAH</a></li>
                  <li class="dropdown-item"><a href="#">PENUGASAN</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BAN REN</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">ANGGARAN</a></li>
                  <li class="dropdown-item"><a href="#">PROGRAM KERJA</a></li>
                </ul>
              </li>

            </ul>
          </div>
        </div>

        <div class="col-sm-2">
            <button class="btn btn-primary btn-md btn-block dropdown-toggle secondary-menu" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SRENA</button>
        </div>

        <div class="col-sm-2">
          <div class="dropdown">
            <button class="btn btn-primary btn-md btn-block dropdown-toggle secondary-menu" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SPOTMAR</button>
            
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">KOMSOS</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">BAKSOS</a></li>
                  <li class="dropdown-item"><a href="#">KAMTIBNAS</a></li>
                  <li class="dropdown-item"><a href="#">SOSIALISASI</a></li>
                  <li class="dropdown-item"><a href="#">PENYULUHAN</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">BIN TAHWIL</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">HANWIL</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">PERENCANAAN</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">PROGRAM KERJA</a></li>
                  <li class="dropdown-item"><a href="#">ANGGARAN</a></li>
                </ul>
              </li>

            </ul>
          </div>
        </div>

      </div><!-- end row -->

      <div class="row" style="margin-top:13px;">

        <div class="col-sm-2">
          <div class="dropdown">
            <button class="btn btn-primary btn-md btn-block dropdown-toggle secondary-menu" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PUSKODAL</button>
            
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">OPERASI</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="http://develsync.com/coarmada/files/lapbul_bulan_Januari_2018.pdf" download>IMSS</a></li>
                  <li class="dropdown-item"><a href="#">PIO</a></li>
                  <li class="dropdown-item"><a href="#">C2MS</a></li>
                  <li class="dropdown-item"><a href="http://develsync.com/coarmada/files/Lapkonis_April_2018.pdf" download>LAPBULOPS</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">KOMLEK</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">VSAT</a></li>
                  <li class="dropdown-item"><a tabindex="-1" href="#">HF</a></li>
                </ul>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">SIAP LAHTA</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">VICON</a></li>
                  <li class="dropdown-item"><a href="#">SIMAK BMN</a></li>
                </ul>
              </li>

            </ul>
          </div>
        </div>

        <div class="col-sm-2"><button type="button" class="btn btn-primary btn-md btn-block dropdown-toggle secondary-menu" data-toggle="dropdown">DISINFOLA HTA</button></div>
        <div class="col-sm-2"><button type="button" class="btn btn-primary btn-md btn-block dropdown-toggle secondary-menu" data-toggle="dropdown">DISKOMLEK</button></div>
        <div class="col-sm-2"><button type="button" class="btn btn-primary btn-md btn-block dropdown-toggle secondary-menu" data-toggle="dropdown">DENMA</button></div>
        <div class="col-sm-2"><button type="button" class="btn btn-primary btn-md btn-block dropdown-toggle secondary-menu" data-toggle="dropdown">DISKU</button></div>
        <div class="col-sm-2"><button type="button" class="btn btn-primary btn-md btn-block dropdown-toggle secondary-menu" data-toggle="dropdown">SETUM</button></div>
      </div>

    </div>
    <br>
<?php $this->load->view('footer');?>