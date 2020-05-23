<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function bulan_indo($bulan) {
		switch ($bulan) {
			case '01':
				return 'Januari';
				break;
			case '02':
				return 'Februari';
				break;
			case '03':
				return 'Maret';
				break;
			case '04':
				return 'April';
				break;
			case '05':
				return 'Mei';
				break;
			case '06':
				return 'Juni';
				break;
			case '07':
				return 'Juli';
				break;
			case '08':
				return 'Agustus';
				break;
			case '09':
				return 'September';
				break;
			case '10':
				return 'Oktober';
				break;
			case '11':
				return 'November';
				break;
			case '12':
				return 'Desember';
				break;
			default:
				return 'Nama bulan tidak dikenali';
		}
	}

	function bulan_indo_short($bulan) {
		switch ($bulan) {
			case '01':
				return 'Jan';
				break;
			case '02':
				return 'Feb';
				break;
			case '03':
				return 'Mar';
				break;
			case '04':
				return 'Apr';
				break;
			case '05':
				return 'Mei';
				break;
			case '06':
				return 'Jun';
				break;
			case '07':
				return 'Jul';
				break;
			case '08':
				return 'Agu';
				break;
			case '09':
				return 'Sep';
				break;
			case '10':
				return 'Okt';
				break;
			case '11':
				return 'Nov';
				break;
			case '12':
				return 'Des';
				break;
			default:
				return 'Empty';
		}
	}

	function hari_indo($hari) {
		switch ($hari) {
			case 'Monday':
				return 'Senin';
				break;
			case 'Tuesday':
				return 'Selasa';
				break;
			case 'Wednesday':
				return 'Rabu';
				break;
			case 'Thursday':
				return 'Kamis';
				break;
			case 'Friday':
				return 'Jum`at';
				break;
			case 'Saturday':
				return 'Sabtu';
				break;
			case 'Sunday':
				return 'Minggu';
				break;
			default:
				echo 'Nama hari tidak dikenali';
		}
	}
	
	function tgl_indo($tanggal){
		return substr($tanggal, 8, 2) . ' ' . bulan_indo(substr($tanggal, 5, 2)) . ' ' . substr($tanggal, 0, 4);
	}

	function tgl_indo_r($tanggal){
		return substr($tanggal, 0, 2) . ' ' . bulan_indo(substr($tanggal, 3, 2)) . ' ' . substr($tanggal, 6, 4);
	}

	function bln_indo($bln){
		return bulan_indo(substr($bln, 5, 2)) . ' ' . substr($bln, 0, 4);
	}

	function tgl_indo_short($tanggal){
		return substr($tanggal, 0, 2) . ' ' . bulan_indo_short(substr($tanggal, 3, 2)) . ' ' . substr($tanggal, 6, 4);
	}
	function isWeekend($date) {
		return (date('N', strtotime($date)) >= 6);
	}
	function isWeekendOtherwise($date) {
		$weekDay = date('w', strtotime($date));
		return ($weekDay == 0 || $weekDay == 6);
	}