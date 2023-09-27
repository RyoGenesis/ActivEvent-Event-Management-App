@extends('layouts.app')
@section('style')
<style>
    @media(max-width:767px){
        .col-md-4.col-12 {
            margin-bottom: 15pt;
        }
        .col-md-4.col-12 .custom-allign{
            text-align: center;
        }
    }
</style>

<style>
    @media(min-width:768px){
        .col-md-4.col-12 .custom-allign {
            text-align: start;
        }
    }
</style>
@endsection

@section('title','ActivEvent | Contact Us')

@section('content')
<div class="container text-center pt-3 mt-3 border border-3">
    <h3 class="pb-4">Contact Us</h3>
    <div class="row">
        <div class="col-md-4 col-12">
            <i class="fa-solid fa-2xl fa-location-dot mb-4" style="color: #000000;"></i>
            <h4>Address</h4>
            <div class="custom-allign  my-3">
                <div class="fs-5">Kampus Angrek</div>
                <small>Jl. Kebon Jeruk Raya No.27, Kebon Jeruk Jakarta Barat 11530. Indonesia</small>
            </div>

            <div class="custom-allign my-3">
                <div class="fs-5">Kampus @Alam Sutera</div>
                <small>JL.Jalur Sutera Barat Kav. 21, Alam Sutera Serpong Tanggerang 15143, Indonesia</small>
            </div>

            <div class="custom-allign my-3">
                <div class="fs-5">Kampus @Malang</div>
                <small>Araya Mansion No. 8 -22 Araya – Malang Kabupaten Malang, Jawa Timur, 65154, Indonesia</small>
            </div>

            <div class="custom-allign my-3">
                <div class="fs-5">Kampus @Bekasi</div>
                <small>Jalan Lingkar Boulevar Blok WA No.1 Summarecon Bekasi, Kelurahan Marga Mulya, Kecamatan Medan Satria, Bekasi, 17142</small>
            </div>
        </div>

        <div class="col-md-4 col-12">
            <i class="fa-solid fa-clock fa-2xl mb-4" style="color: #000000;"></i>
            <h4>Operational</h4>
            <div class="custom-allign my-3">
                <div class="fs-5">Admission</div>
                <div>
                    <small>0804 169 69 69</small>
                </div>
                <div>
                       <small>+62852 08 696969</small>
                </div>
                <div>
                     <small>Jam Operational:</small>
                     <ul>
                        <li>
                            <small class="fw-bold">Senin-Sabtu: 08.00-22.00</small>
                        </li>
                        <li>
                            <small class="fw-bold">Minggu: 08.00-15.00</small>
                        </li>
                     </ul>
                </div>
            </div>

            <div class="custom-allign my-3">
                <div class="fs-5 my-3">Mahasiswa</div>
                <div>
                    <small>0804 169 69 69</small>
                </div>
                <div>
                       <small>+62878 0172 4687</small>
                </div>
                <div>
                     <small>Jam Operational:</small>
                     <ul>
                        <li>
                            <small class="fw-bold">Senin-Sabtu: 08.00-22.00</small>
                        </li>
                        <li>
                            <small class="fw-bold">Minggu: 08.00-15.00</small>
                        </li>
                     </ul>
                </div>
            </div>
         
        </div>

        <div class="col-md-4 col-12">
            <i class="fa-solid fa-hashtag fa-2xl mb-4" style="color: #000000;"></i>
            <h4>Social Media</h4>
            <div class="custom-allign my-3">
                <i class="fa-brands fa-facebook fa-2xl" style="color: #000000;"></i>
                <small>XYZ University</small>
            </div>
            <div class="custom-allign my-3">
                <i class="fa-brands fa-twitter fa-2xl" style="color: #000000;"></i>
                <small>@XYZ University</small>
            </div>
            <div class="custom-allign my-3">
                <i class="fa-brands fa-instagram fa-2xl" style="color: #000000;"></i>
                <small>@xyz_university_official</small>
            </div>
            <div class="custom-allign my-3">
                <i class="fa-brands fa-youtube fa-2xl" style="color: #000000;"></i>
                <small>XYZ University</small>
            </div>
        </div>
    </div>
</div>
@endsection