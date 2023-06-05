<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "Binus University", "display_name" => "Binus University"], //1
            //himpunan
            ["name" => "Himpunan Mahasiswa Teknik Informasi", "display_name" => "HIMTI"], //2
            ["name" => "Himpunan Mahasiswa Teknik Komputer", "display_name" => "HIMTEK"], //3
            ["name" => "Himpunan Mahasiswa Teknik Sipil", "display_name" => "HIMTES"], //4
            ["name" => "Himpunan Mahasiswa Teknik Industri", "display_name" => "HIMTRI"], //5
            ["name" => "Himpunan Mahasiswa Sistem Informasi", "display_name" => "HIMSISFO"], //6
            ["name" => "Himpunan Mahasiswa Statistika", "display_name" => "HIMSTAT"], //7
            ["name" => "Himpunan Mahasiswa Sastra Jepang", "display_name" => "HIMJA"], //8
            ["name" => "Himpunan Mahasiswa Sastra Inggris", "display_name" => "HIMSI"], //9
            ["name" => "Himpunan Mahasiswa Sastra China", "display_name" => "HIMANDA"], //10
            ["name" => "Himpunan Mahasiswa Psikologi", "display_name" => "HIMPSIKO"], //11
            ["name" => "Himpunan Mahasiswa Pendidikan Guru Sekolah Dasar", "display_name" => "HIMPGSD"], //12
            ["name" => "Himpunan Mahasiswa Pariwisata", "display_name" => "HIMPAR"], //13
            ["name" => "Himpunan Mahasiswa Matematika", "display_name" => "HIMMAT"], //14
            ["name" => "Himpunan Mahasiswa Hubungan Internasional", "display_name" => "HIMHI"], //15
            ["name" => "Himpunan Mahasiswa Hotel Management", "display_name" => "HOME"], //16
            ["name" => "Himpunan Mahasiswa Food Technology", "display_name" => "HIMFOODTECH"], //17
            ["name" => "Himpunan Mahasiswa Film", "display_name" => "HIMFILM"], //18
            ["name" => "Himpunan Mahasiswa Entrepreneurship", "display_name" => "HIMPRENEUR"], //19
            ["name" => "Himpunan Mahasiswa Communication Department", "display_name" => "HIMMCOMM"], //20
            ["name" => "Himpunan Mahasiswa Business Law", "display_name" => "HIMSLAW"], //21
            ["name" => "Himpunan Mahasiswa Bisnis Manajemen", "display_name" => "HIMME"], //22
            ["name" => "Himpunan Mahasiswa Arsitektur", "display_name" => "HIMARS"], //23
            ["name" => "Himpunan Mahasiswa Akuntansi", "display_name" => "HIMA"], //24
            ["name" => "Himpunan Mahasiswa Desain Interior", "display_name" => "HIMDI"], //25
            ["name" => "Himpunan Mahasiswa DKV", "display_name" => "HIMDKV"], //26
            ["name" => "United Student of Public Relations", "display_name" => "USPR"], //27

            //ukm
            ["name" => "Band", "display_name" => "Band"], //28
            ["name" => "Bersama Dalam Musik", "display_name" => "BDM"], //29
            ["name" => "Binus TV Club", "display_name" => "Binus TV Club"], //30
            ["name" => "BVoice Radio", "display_name" => "BVoice"], //31
            ["name" => "Klub Seni Fotografi Bina Nusantara", "display_name" => "KLIFONARA"], //32
            ["name" => "Modelling Club of Binus", "display_name" => "MCB"], //33
            ["name" => "Paduan Suara Mahasiswa Bina Nusantara", "display_name" => "PARAMABIRA"], //34
            ["name" => "Pojok Aksi dan Informasi Bina Nusantara Malang", "display_name" => "PANORAMA"], //35
            ["name" => "Seni Tari Mahasiswa Bina Nusantara", "display_name" => "STAMANARA"], //36
            ["name" => "Seni Teater Mahasiswa Bina Nusantara", "display_name" => "STMANIS"], //37

            ["name" => "AIESEC in BINUS", "display_name" => "AIESEC"], //38
            ["name" => "BINUS Square Student Committee", "display_name" => "BSSC"], //39
            ["name" => "Keluarga Besar Mahasiswa Khonghuchu", "display_name" => "KBMK"], //40
            ["name" => "Keluarga Mahasiswa Buddhis Dhammavaddhana", "display_name" => "KMBD"], //41
            ["name" => "Keluarga Mahasiswa Hindu", "display_name" => "KMH"], //42
            ["name" => "Keluarga Mahasiswa Katolik", "display_name" => "KMK"], //43
            ["name" => "Majelis Ta'lim Al-Khawarizmi", "display_name" => "MT Al-Khawarizmi"], //44
            ["name" => "Persekutuan Oikumene", "display_name" => "PO"], //45
            ["name" => "Teach for Indonesia Student Community", "display_name" => "TFISC"], //46

            ["name" => "Aikido", "display_name" => "UKM Aikido"], //47
            ["name" => "Basket", "display_name" => "UKM Basket"], //48
            ["name" => "Bina Nusantara Swimming Club", "display_name" => "BASIC (Swimming)"], //49
            ["name" => "Badminton", "display_name" => "UKM Badminton"], //50
            ["name" => "Binusian Gaming", "display_name" => "Binusian Gaming"], //51
            ["name" => "Hapkido", "display_name" => "UKM Hapkido"], //52
            ["name" => "Mahasiswa Bina Nusantara Pencinta Alam", "display_name" => "SWANARAPALA"], //53
            ["name" => "Merpati Putih", "display_name" => "Merpati Putih"], //54
            ["name" => "Sepak Bola", "display_name" => "UKM Sepak Bola"], //55
            ["name" => "Volley", "display_name" => "UKM Volley"], //56
            ["name" => "Wushu", "display_name" => "UKM Wushu"], //57

            ["name" => "Bina Nusantara Computer Club", "display_name" => "BNCC"], //58
            ["name" => "Bina Nusantara Finance Club", "display_name" => "BNFC"], //59
            ["name" => "Binus Business International Club", "display_name" => "BIC"], //60
            ["name" => "Binus English Club", "display_name" => "BNEC"], //61
            ["name" => "Binus Entrepreneur", "display_name" => "B-Preneur"], //62
            ["name" => "Binus Game Development Club", "display_name" => "BGDC"], //63
            ["name" => "Binus Mandarin Club", "display_name" => "BNMC"], //64
            ["name" => "Binus Student Learning Community", "display_name" => "BSLC"], //65
            ["name" => "Cyber Security Community", "display_name" => "CSC"], //66
            ["name" => "International Marketing Community of Binus", "display_name" => "IMCB"], //67
            ["name" => "ISACA Student Group Binus University", "display_name" => "ISACA Student Group"], //68
            ["name" => "Nippon Club", "display_name" => "Nippon Club"], //69
        ];
        DB::table("communities")->insert($data);
    }
}
