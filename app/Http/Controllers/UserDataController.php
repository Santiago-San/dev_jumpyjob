<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserData;

class UserDataController extends Controller
{
    public function create() {
        return view('users.dashboard');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'DoB' => 'required',
            'handynummer' => 'required',
        ]);
        $formFields['user_id'] = auth()->id();
        $user_data = UserData::create($formFields);
        
        return redirect('/')->with('message', 'Daten wurden erfolgreich gespeichert');
    }
}






/*

// Pipedrive Field token
	$api_person_id = 'person_id';// DEAL-Feld in PD
	$api_massnahme_nr ='f5306929ee03ae8a563039a532fb53f945677ad8'; // DEAL-Feld in PD - TYPE: Single option
	$api_lt_email ='86a627eabf648c7b8d6ac97892fa7ac8551b4b5e'; // DEAL-Feld in PD - TYPE: Text
	$api_kurszeitraum ='6ed1cb903708942df3da3bc5ff60843a4305b9ba'; // // DEAL-Feld in PD - TYPE: single option
	$api_lt_anschrift ='cbe56a8393a109cb16d6c1c7b670ff741bfb54eb'; //DEAL-FELD in PD - TYPE: address
	$api_standort_massnahme = 'a8ac2a8bcef6b3047619884a77acfa7534b34c10'; //DEAL-FELD in PD - TYPE: single option
	$api_lt_sb = '2f5021987af3bdfa88a104ee7c334730ba0aaa50'; //DEAL-FELD in PD - TYPE: Text
	$api_abw_kursantritt = 'e07b8ff94b2bc5c3425059b1198a485fe4a155f5'; //DEAL-FELD
	$api_berufswunsch = 'a7c811eb84eb6a021ced4cfc7769c5074cfe86c4';	//DEAL-FELD
	$api_tn_anrede = '47bc3d3a8ed17808ddcbab257cfb1f5982a9084a'; //KONTAKT-FELD in PD - TYPE: single option
	$api_tn_geb_datum = '299b1def38a0696470c3fc37116ae23ff8eafee3'; //KONTAKT-FELD in PD - TYPE: Date
	$api_tn_geb_ort	= 'f96f00b4d9d271f577534b8c066d2af8c446cedc';//KONTAKT-FELD in PD - TYPE: Text
	$api_tn_geb_land = '9dbdeff3ed5464af373190059d361ccf18d0439f';//KONTAKT-FELD in PD - TYPE: text
	$api_tn_anschrift = 'dc8a994b9d91c554278980a8b49c803129d09033';//KONTAKT-FELD in PD - TYPE: address
	$api_tn_telefon = 'phone';//KONTAKT-FELD in PD - TYPE: phone 
	$api_tn_vorname = 'first_name';//KONTAKT-FELD in PD - TYPE: text
	$api_tn_nachname ='last_name';//KONTAKT-FELD in PD - TYPE: text
	$api_tn_email = 'email';//KONTAKT-FELD in PD - TYPE: text
	$api_tn_knr ='8c53a27a0d8a1c0ca7358d62065d382cf72f530a'; // KONTAKT-Feld in PD - TYPE: text
	$api_brandschutz = 'b3d31959eafe0f09f1d434ff269c43ac406553c9';//DEAL-FELD
	$api_sachkunde = 'e0ee4b000c9b2c2da8bda0463165168695edd4bc';//DEAL-FELD
	$api_erste_hilfe = '621f4cfdfef9a91dd1194883fef62456685eea22';//DEAL-FELD
	$api_intervention = '9339084418fc4c6959d4843c89b9fb6c3f479544'; //DEAL-FELD
	$api_waffe = 'a23caea6f5a1f0d1baa013f5993481a229c6890f';//DEAL-FELD
	$api_feld_id = '7462f9b6f8af1d997eea6609839ff01fce585792';//DEAL-FELD
	$api_berufserfahrung = 'b1897736f81c91f9734558b8f581cad798cf85c4';//DEAL Feld
	$api_unterrichtung ='600544feba56188f0418493b5fae370b4613d27f';//DEAL Feld
	$api_schulabschluss ='6de14d737f9aa58991a860f60259cf3070737823';	
	$api_berufsabschluss ='e7b3b07ed04643f96500bc5321bb678bbbe7538c';
	$api_sprachniveau = '45664be207b27f406ba682d51793823df7bbea94';
	$api_fz_vorhanden = '4196ec4cd564d0b7a7b526a84f1c244017d40753';
	$api_fz_eintrag_bekannt ='366ae07136a411bfc0d3ea31beb63873f637319a';//DEAL Feld
	$api_schichtarbeit ='1863246000071987a6dd281a788ebf2d0d118679';//DEAL Feld 
	$api_pc_kenntnisse ='6a9d6770130cda616b0bd20bfb7bf6fda710b008';//DEAL Feld 
	$api_tel_bearbeiter = 'c29dd419a38859010ef90fe9f025c5c785cca36c';//DEAL Feld 
	$api_lebenslauf = '038f608c10d30a7968fd1486781d9a3c8a66f0a1';
	$api_ausbildungsgrad = '6abf4d30076d56664b8956c9dde515ec36869caf';
	$api_tn_nation = '61dbcf12fe2861f3d21b675d530dc1c9c71b7985';  // KONTAKT-Feld in PD Type: Text
	$api_muttersprache = '6fada16038c6d37b149637615b1a2ce670b09491'; // KONTAKT-Feld in PD Type: Text
	$api_weitere_sprachen = '06ef8a3ce9fc70fa98717d78ce85ab3d676d5141'; // KONTAKT-Feld in PD Type: Text
	$api_fs = '3c33053c1703c298057f1a9804105af637c5cd02';	
	$api_wohnsitz_5j = '51deb376071860dad37acb3fbd640acb27ab0256'; // DEAL-Feld TYPE: single option
	$api_auto_vorhanden = '0a95cb9ac12368796eb86fc3a436c4b0b8265125';	//DEAL-Feld TYPE: single option
	$api_modul = 'c21c33bd76da18d45fa967d811a8f6a008cb61ea';	//DEAL-Feld TYPE: single option
	$api_abw_kursende = '69fda269a4df6c207ab6f1bb5b5ed0cacadedfa7';

*/




