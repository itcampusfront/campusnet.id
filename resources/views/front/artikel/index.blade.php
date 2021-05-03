@extends('template/front/main')

@section('title', 'Artikel')

@section('content')
<section>
    <div class="container my-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb rounded-1">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Artikel</li>
          </ol>
        </nav>
        <div class="content">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card border-0 shadow-sm rounded-2">
                        <a href="artikel/detail">
                        <img src="https://www.w3schools.com/w3css/img_forest.jpg" alt="thumbnail" class="card-img-top rounded-1"></a>
                        <div class="card-body">
                            <a href="artikel/detail"><p class="m-0 font-weight-bold">Judul Artikel</p></a>
                            <p class="m-0 text-muted">Lorem ipsum dolor sit, amet consectetur, adipisicing elit. Inventore sunt, quisquam necessitatibus quod animi iusto.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card border-0 shadow-sm rounded-2">
                        <a href="artikel/detail">
                        <img src="https://www.w3schools.com/w3css/img_forest.jpg" alt="thumbnail" class="card-img-top rounded-1"></a>
                        <div class="card-body">
                            <a href="artikel/detail"><p class="m-0 font-weight-bold">Judul Artikel</p></a>
                            <p class="m-0 text-muted">Lorem ipsum dolor sit, amet consectetur, adipisicing elit. Inventore sunt, quisquam necessitatibus quod animi iusto.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card border-0 shadow-sm rounded-2">
                        <a href="artikel/detail">
                        <img src="https://www.w3schools.com/w3css/img_forest.jpg" alt="thumbnail" class="card-img-top rounded-1"></a>
                        <div class="card-body">
                            <a href="artikel/detail"><p class="m-0 font-weight-bold">Judul Artikel</p></a>
                            <p class="m-0 text-muted">Lorem ipsum dolor sit, amet consectetur, adipisicing elit. Inventore sunt, quisquam necessitatibus quod animi iusto.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card border-0 shadow-sm rounded-2">
                        <a href="artikel/detail">
                        <img src="https://www.w3schools.com/w3css/img_forest.jpg" alt="thumbnail" class="card-img-top rounded-1"></a>
                        <div class="card-body">
                            <a href="artikel/detail"><p class="m-0 font-weight-bold">Judul Artikel</p></a>
                            <p class="m-0 text-muted">Lorem ipsum dolor sit, amet consectetur, adipisicing elit. Inventore sunt, quisquam necessitatibus quod animi iusto.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection