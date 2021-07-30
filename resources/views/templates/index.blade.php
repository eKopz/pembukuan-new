<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/ekopz-icon.png') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/pickadate/themes/default.date.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header" style="background-color:#f3f6f9">
            <div class="brand-logo"><a href="#"><img src="{{ Session::get('foto') }}" alt="" style="width: 60px; border-radius:60px"></a>
            </div>
            <div class="nav-control" >
                <div class="hamburger"><span class="line"></span>  <span class="line"></span>  <span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            @include('templates.header')
        </div>
        <!--**********************************
            Header end
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            @include('templates.sidebar')
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles" style="background:#00AD92;">
                    @yield('content-title')
                </div>
                @yield('content')
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            @include('templates.footer')
        </div>
        <!--**********************************
            Footer end
        ***********************************-->


        <!--**********************************
            Right sidebar start
        ***********************************-->
        {{-- <div class="sidebar-right">
            <a class="sidebar-right-trigger" href="javascript:void(0)">
                <span><i class="mdi mdi-tune"></i></span>
            </a>
            @include('templates.right_sidebar')
        </div> --}}
        <!--**********************************
            Right sidebar end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        js assets start
    ***********************************-->
    
    @include('templates.js')

    <!--**********************************
        js assets End 
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script>
    <script src="{{ asset('assets/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }} "></script>
    <script src="{{ asset('assets/js/gleek.js') }}"></script>
    <script src="{{ asset('assets/js/styleSwitcher.js') }}"></script>

    <script src="{{ asset('assets/plugins/pickadate/picker.js') }}"></script>
    <script src="{{ asset('assets/plugins/pickadate/picker.time.js')}}"></script>
    <script src="{{ asset('assets/plugins/pickadate/picker.date.js') }}"></script>

    <script src="{{ asset('assets/js/plugins-init/pickadate-init.js') }}"></script>

    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/editor-ck-init.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('.js-example-placeholder-multiple').select2({
            placeholder: "Select a state"
        });
    </script>

    {{-- get pajak --}}

    <script>
        $(document).ready(function(){
            $('select[name="id_pajak"]').on('change', function(){
                // kita buat variable id_pajak untk menampung data id select pajak
                let id_pajak = $(this).val();
                //kita cek jika id di dpatkan maka apa yg akan kita eksekusi
                if(id_pajak){
                // jika di temukan id nya kita buat eksekusi ajax GET
                    jQuery.ajax({
                        // url yg di root yang kita buat tadi
                        url:"/pajak/"+id_pajak,
                        // aksion GET, karena kita mau mengambil data
                        type:'GET',
                        // type data json
                        dataType:'json',
                        // jika data berhasil di dapat maka kita mau apain nih
                        success:function(data){
                            var getData = data.total_gaji;
	
                            var	number_string = getData.toString(),
                                sisa 	= number_string.length % 3,
                                rupiah 	= number_string.substr(0, sisa),
                                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                                    
                            if (ribuan) {
                                separator = sisa ? '.' : '';
                                rupiah += separator + ribuan.join('.');
                            }

                            $("#jumlah_pajak").html("<label class='text-label'>PTKP (s.d)</label><input type='text' class='form-control' value='Rp. "+rupiah+"' readonly>");
                        }
                    });
                } else {
                    // $('select[name="kota_id"]').empty();
                }
            });
        });
    </script>

    <script>
        $('#potong_gaji').change(function(){
            if($(this).val() == 1){
                $('#form_potong_gaji').show();
            } else {
                $('#form_potong_gaji').hide();
            }
        });
    </script>

    {{-- get gaji pokok --}}

    <script>

        $(document).ready(function(){

            $('select[name="id_karyawan_koperasi"]').on('change', function(){
                // kita buat variable id_karyawan_koperasi untk menampung data id select pajak
                let id_karyawan_koperasi = $(this).val();
                //kita cek jika id di dpatkan maka apa yg akan kita eksekusi
                if(id_karyawan_koperasi){
                // jika di temukan id nya kita buat eksekusi ajax GET
                    jQuery.ajax({
                        // url yg di root yang kita buat tadi
                        url:"/pengurus/karyawan/get/"+id_karyawan_koperasi,
                        // aksion GET, karena kita mau mengambil data
                        type:'GET',
                        // type data json
                        dataType:'json',
                        // jika data berhasil di dapat maka kita mau apain nih
                        success:function(data){
                            var getData = data.gaji_pokok;
	
                            var	number_string = getData.toString(),
                                sisa 	= number_string.length % 3,
                                rupiah 	= number_string.substr(0, sisa),
                                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                                    
                            if (ribuan) {
                                separator = sisa ? '.' : '';
                                rupiah += separator + ribuan.join('.');
                            }

                            $("#gaji_pokok").html("<label class='text-label'>Gaji Pokok</label><div class='row'><div class='col-10'><input type='text' class='form-control' value='Rp. "+rupiah+"' readonly></div><div class='col-2 mt-4'><a href='https://pengurus.ekopz.id/pengurus/karyawan/edit/"+id_karyawan_koperasi+"' class='text-success'>Ubah Gaji Pokok</a></div></div>");
                        }
                    });
                } else {
                    
                }
            });
        });
    </script>

    {{-- get total gaji --}}

    <script>
        $(document).ready(function() {
            var potongan_simpanan = parseInt($('.potongan_simpanan').val());
            var potongan_simpanan_pokok = parseInt($('.potongan_simpanan_pokok').val());
            var potongan_simpanan_wajib = parseInt($('.potongan_simpanan_wajib').val());
            var potongan_pinjaman = parseInt($('.potongan_pinjaman').val());
            var mangkir = parseInt($('.mangkir').val());
            var jamsostek_2 = parseInt($('.jamsostek_2').val());
            var pph = parseInt($('.pph').val());
            var sub_total = parseInt($('.sub_total').val());

            var jumlah_potongan = potongan_simpanan + potongan_simpanan_pokok + potongan_simpanan_wajib + potongan_pinjaman + mangkir + jamsostek_2 + pph;

            var total = sub_total;

            $('#total_gaji').html("<label class='text-label'>Total</label><input type='number' class='form-control' name='total' value='"+total+"' readonly>");

            console.log(potongan_simpanan);
        });
    </script>

</body>

</html>
