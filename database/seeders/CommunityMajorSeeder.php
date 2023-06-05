<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunityMajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["community_id" => '2', "major_id" => '1'], //HIMTI CompSci
            ["community_id" => '2', "major_id" => '2'], //HIMTI Cyber
            ["community_id" => '2', "major_id" => '3'], //HIMTI Data Science
            ["community_id" => '2', "major_id" => '4'], //HIMTI Mobile
            ["community_id" => '2', "major_id" => '5'], //HIMTI Game
            ["community_id" => '2', "major_id" => '6'], //HIMTI CompSci Mat
            ["community_id" => '2', "major_id" => '7'], //HIMTI CompSci Stat

            ["community_id" => '3', "major_id" => '44'], //HIMTEK TekKom

            ["community_id" => '4', "major_id" => '43'], //HIMTES Sipil

            ["community_id" => '5', "major_id" => '42'], //HIMTRI TekIndustri
            // ["community_id" => '5', "major_id" => '49'], //HIMTRI TekIndustri & InfoSys

            ["community_id" => '6', "major_id" => '8'], //HIMSISFO InfoSys
            ["community_id" => '6', "major_id" => '9'], //HIMSISFO InfoSys Global
            ["community_id" => '6', "major_id" => '10'], //HIMSISFO InfoSys Accounting
            ["community_id" => '6', "major_id" => '11'], //HIMSISFO InfoSys Accounting Auditing
            ["community_id" => '6', "major_id" => '12'], //HIMSISFO Business IT
            ["community_id" => '6', "major_id" => '13'], //HIMSISFO CompuAudit
            ["community_id" => '6', "major_id" => '14'], //HIMSISFO InfoSys Audit
            ["community_id" => '6', "major_id" => '15'], //HIMSISFO InfoSys Management
            ["community_id" => '6', "major_id" => '16'], //HIMSISFO Business Analytics

            ["community_id" => '7', "major_id" => '7'], //HIMSTAT CompSci Stat

            ["community_id" => '8', "major_id" => '35'], //HIMJA Sastra Jepang

            ["community_id" => '9', "major_id" => '34'], //HIMSI Sastra Inggris

            ["community_id" => '10', "major_id" => '36'], //HIMANDA Sastra China

            ["community_id" => '11', "major_id" => '39'], //HIMPSIKO Psikologi

            ["community_id" => '12', "major_id" => '41'], //HIMPGSD PGSD

            ["community_id" => '13', "major_id" => '50'], //HIMPAR Pariwisata

            ["community_id" => '14', "major_id" => '6'], //HIMMAT CompSci Mat

            ["community_id" => '15', "major_id" => '37'], //HIMHI HubInter
            ["community_id" => '15', "major_id" => '38'], //HIMHI HubInter Global

            ["community_id" => '16', "major_id" => '51'], //HOME Hotel
            ["community_id" => '16', "major_id" => '54'], //HOME Business HotelManage
            
            ["community_id" => '17', "major_id" => '46'], //HIMFOODTECH FoodTech

            ["community_id" => '18', "major_id" => '19'], //HIMFILM Film 
            
            ["community_id" => '19', "major_id" => '29'], //HIMPRENEUR BusinessCreation
            ["community_id" => '19', "major_id" => '30'], //HIMPRENEUR CreativePreneur

            ["community_id" => '20', "major_id" => '52'], //HIMMCOMM MassComm
            ["community_id" => '20', "major_id" => '53'], //HIMMCOMM MarComm
            ["community_id" => '20', "major_id" => '55'], //HIMMCOMM CreativComm
            ["community_id" => '20', "major_id" => '56'], //HIMMCOMM Communication

            ["community_id" => '21', "major_id" => '40'], //HIMSLAW BussinessLaw

            ["community_id" => '22', "major_id" => '23'], //HIMME BisnisManejemen
            ["community_id" => '22', "major_id" => '24'], //HIMME Manejemen
            ["community_id" => '22', "major_id" => '25'], //HIMME Global BisnisMarket
            ["community_id" => '22', "major_id" => '26'], //HIMME Business Creation
            ["community_id" => '22', "major_id" => '27'], //HIMME Internal BisnisManejemen
            ["community_id" => '22', "major_id" => '28'], //HIMME Digital Business

            ["community_id" => '23', "major_id" => '45'], //HIMARS Arsitek

            ["community_id" => '24', "major_id" => '31'], //HIMA Akuntansi
            ["community_id" => '24', "major_id" => '32'], //HIMA Akuntansi Global
            ["community_id" => '24', "major_id" => '33'], //HIMA Finance
            ["community_id" => '24', "major_id" => '10'], //HIMA InfoSys & Akuntansi
            ["community_id" => '24', "major_id" => '66'], //HIMA Tax
            ["community_id" => '24', "major_id" => '67'], //HIMA TeknologiAkuntansi
            ["community_id" => '24', "major_id" => '68'], //HIMA Finance Inter

            ["community_id" => '25', "major_id" => '18'], //HIMDI Desain Interior

            ["community_id" => '26', "major_id" => '17'], //HIMDKV DKV
            ["community_id" => '26', "major_id" => '20'], //HIMDKV DKV new media
            ["community_id" => '26', "major_id" => '21'], //HIMDKV DKV anim
            ["community_id" => '26', "major_id" => '22'], //HIMDKV DKV creative ads

            ["community_id" => '27', "major_id" => '57'], //USPR PR
        ];
        DB::table("community_major")->insert($data);
    }
}
