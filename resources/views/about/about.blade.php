@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="wow fadeInLeft">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">About</li>
            </ol>
        </div>
        <!--/.row-->


    </div>
    <!--/.main-->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="jumbotron jumbotron-fluid">
            <div class="container info-jumbutron center-v">
                <div class="row center" style="width: 100%">
                    <div class="col-md-12 text-center">
                        <a class="btn btn-warning btn-lg mb-4" target="_blank" href="https://api.whatsapp.com/send?phone=62895396326432&text=Halo saya mau tanya tentang aplikasi SPK BLT-DD">
                            <img class="mr-1" width="35" src="{{asset ('gambar/wa.svg')}}"> Hubungi Kami
                        </a>
                    </div>
                </div>
                <br>
                <p style="text-align:center; font-family:'poppins'">Klik tombol diatas untuk menghubungi kami via Whatsapp</p>
                <br>
                <br>
                <div class="alert bg-info kontak">
                    <div class="container">
                        <div class="col-md-6 mb-6">
                            <h3 class="mb-3 about">
                                <i class="fa fa-building"></i> Alamat
                            </h3>
                            <p style="font-size: 16px; color:white; font-family:'poppins'">Dsn.Mlanggeng RT/RW 09/05 Ds.Gedongboyountung Kec.Turi Kabupaten Lamongan</p>
                        </div>
                        <div class="col-md-6 mb-6">
                            <h3 class="mb-3 about">
                                <i class="fa fa-phone"></i> Contact
                            </h3>
                            <p style="font-size: 16px; color:white; font-family:'poppins'">+62 895 396 326 432<br>alfa.ozora89@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>