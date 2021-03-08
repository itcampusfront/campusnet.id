<div class="bg-white rounded-3 shadow-sm py-3 px-4 mb-4">
        <div class="media">
            <img width="150" class="mr-4" src="{{asset('assets/images/ilustrasi/undraw_social_friends_nsbv.svg')}}">
            <div class="media-body">
                <h5 class="">Selamat datang {{ Auth::user()->nama_user }}</h5>
                <p>Sudah banyak guru dan siswa menggunakan LMS ini! Kami siap menjadi mitra Anda dalam memajukan dunia pembelajaran.</p>
                <a href="/member/website/create" class="btn btn-theme-2 rounded-3 px-3">Order Sekarang</a>
            </div>
        </div>
    </div>