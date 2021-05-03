@extends('template/front/main')

@section('title', 'Judul Artikel')

@section('content')
<section>
  <div class="container my-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-1">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/artikel">Artikel</a></li>
        <li class="breadcrumb-item active" aria-current="page">Judul Artikel</li>
      </ol>
    </nav>
    <div class="row">
      <div class="col-lg-2 order-2 order-lg-1">
        <div class="side-artikel sticky-top" style="top: 8em">
          <div class="bg-white rounded-circle mb-2 d-flex align-items-center justify-content-center mx-auto" style="width: 70px; height: 70px"><i class="fa fa-user" style="font-size: 1.7rem"></i></div>
          <div class="text-center mb-3">
            <p class="text-body font-weight-bold m-0">Munarboy</p>
            <p class="m-0"><small><i class="fa fa-bookmark"></i> Content Writer</small></p>
            <p class="m-0"><small> Tak Berkategori</small></p>
            <p class="m-0"><small><i class="fa fa-clock-o"></i> 1 Tahun yang lalu</small></p>
          </div>
          <div class="tag-list py-3 mb-3" style="overflow: auto;">
            <span class="badge badge-primary">#munarboy</span>
            <span class="badge badge-primary">#bocil</span>
            <span class="badge badge-primary">#bocilepep</span>
          </div>
        </div>
      </div>
      <div class="col-lg-7 order-1 order-lg-2"> 
        <article class="mb-3">
          <h2 class="mb-3">Munarman Ditangkap, Mabes Polri Kebanjiran Karangan Bunga</h2>
            <img src="https://photo.jpnn.com/arsip/watermark/2021/04/27/saat-munarman-masuk-ke-ruangan-tahanan-ditresnarkoba-polda-m-53.jpg" class="img-fluid rounded">
            <div class="ql-snow mt-2"><div class="ql-editor">jpnn.com, JAKARTA - Mabes Polri kebanjiran karangan bunga sebagai bentuk apresiasi dan dukungan masyarakat terhadap penangkapan terduga teroris Munarman. Direktur Eksekutif Lemkapi Edi Hasibuan menilai masyarakat Indonesia sangat mendambakan kedamaian dan menolak keras teror dalam segala bentuk. "Kami melihat itu bagian dari derasnya dukungan dan simpati masyarakat kepada Polri yang menginginkan kamtibmas selalu kondusif dan bebas dari aksi teror," ungkap Edi Hasibuan, Minggu (2/5).
            </div></div>
        </article>
      </div>
      <div class="col-lg-3 order-3">
        <div class="kategori mb-3">
          <div class="heading">
            <h5 class="m-0">Kategori</h5>
            <hr>
          </div>
          <div class="card p-0 bg-transparent border-0">
            <div class="card-body">
              <ul class="list-unstyled">
                <li class="mb-2">Artikel</li>
                <li class="mb-2">Tips & Trik</li>
                <li class="mb-2">Tak Berkategori</li>
              </ul>
            </div>  
          </div>
        </div>
        <div class="last-post">
          <div class="heading">
            <h5 class="m-0">Artikel Lainya</h5>
            <hr>
          </div>
          <div class="row">
            <div class="col-6 col-lg-12">
              <div class="card p-0 bg-transparent border-0">
                <img src="https://www.jpnn.com/timthumb.php?src=https://photo.jpnn.com/arsip/watermark/2021/05/03/tpp-asn-pemprov-sulbar-cair-sebelum-lebaran-ilustrasi-foto-15.jpg&w=278&h=147&zc=1&q=80" class="card-img-top rounded"> 
                <div class="card-body">
                  <a href="#">  
                    <p>Alhamdulillah, TPP ASN Cair Sebelum Lebaran</p>
                  </a>
                </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection