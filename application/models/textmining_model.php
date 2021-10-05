<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class textmining_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->helper('array');
		$this->load->database();
	}
	
	function cekduplikat($berita){
		$query = $this->db->query("")->result_array();
		
		
	}
	
	function insert($berita)
	{
		//setup max running time
		ini_set('max_execution_time', 300);
		//query untuk memasukkan data berita ke dalam database
		$sql = "INSERT INTO berita VALUES('',0,".$this->db->escape($berita).")";
		$this->db->query($sql);
		exec('"C:\Program Files\R\R-3.3.3\bin\Rscript.exe" "F:\\xampp\\htdocs\\textmininga\\rscript\\core.R" 2>&1');
		
	}
	
	function hasilanalisis($berita){
		//ambil data berdasarkan hasil analisa
		$tampung = $berita;
		$query = $this->db->query("SELECT
			ke.`NAMAORANG`,
			ke.`UMURORANG`,
			ke.`JENISKELAMIN`,
			db.`TANGGALBERITA`,
			bu.`NAMABULAN`,
			k.`JENISKEJAHATAN`,
			tb.`KABUPATEN`,
			h.`NAMAHARI`
			FROM berita b
			JOIN detailberita db ON (b.`IDBERITA` = db.`IDBERITA`)
			JOIN bulan bu ON (bu.`IDBULAN` = db.`IDBULAN`)
			JOIN hari h ON (h.`IDHARI` = db.`IDHARI`)
			JOIN kejahatan k ON (k.idjenis = db.`IDJENIS`)
			JOIN keterlibatan ke ON (ke.iddetail = db.`IDDETAIL`)
			JOIN tbl_kodepos tb ON (tb.`IDKELURAHAN` = db.`IDKELURAHAN`)
			WHERE b.`ISIBERITA`= '$tampung'")->result_array();
		
		$i=1;
		if(!empty($query)){
			foreach($query as $row){
				$data['namaorang'][$i] = $row['NAMAORANG'];
				$data['umur'][$i] = $row['UMURORANG'];
				$data['kelamin'][$i] = $row['JENISKELAMIN'];
				$data['tanggal'] = $row['TANGGALBERITA'];
				$data['bulan'] = $row['NAMABULAN'];
				$data['jenis'] = $row['JENISKEJAHATAN'];
				$data['tempat'] = $row['KABUPATEN'];
				$data['hari'] = $row['NAMAHARI'];
				$i++;
			}
		} else {
			$data['namaorang'][$i] = "N/A";
			$data['umur'][$i] = "N/A";
			$data['kelamin'][$i] = "N/A";
			$data['tanggal'] = "N/A";
			$data['bulan'] = "N/A";
			$data['jenis'] = "N/A";
			$data['tempat'] = "N/A";
			$data['hari'] = "N/A";
		}
		
		return $data;
	}
	
	function selectdashboard()
	{
		//ambil jumlah berita
		$query = $this->db->query("select count(*) a from berita")->result_array();
		
		foreach($query as $row){
			$data['berita']	= $row['a'];
		}
		
		//ambil jumlah nama
		
		$query = $this->db->query("SELECT COUNT(*) a FROM keterlibatan k JOIN detailberita db ON (k.iddetail = db.iddetail) WHERE db.idjenis NOT IN ('K0')")->result_array();
		
		foreach($query as $row){
			$data['nama']	= $row['a'];
		}
		
		//ambil jumlah kejahatan
		$query = $this->db->query("SELECT COUNT(*) a FROM detailberita WHERE idjenis NOT IN ('K0')")->result_array();
		
		foreach($query as $row){
			$data['kejahatan']	= $row['a'];
		}
		
		//ambil nama kota (buat grafik chart kiri atas)
		$query = $this->db->query("SELECT 
			tb.`KABUPATEN`,
			SUM(IF(db.`IDJENIS`='K1',1,0)) 'narkoba',
			SUM(IF(db.`IDJENIS`='K2',1,0)) 'pencurian',
			SUM(IF(db.`IDJENIS`='K3',1,0)) 'pembunuhan',
			SUM(IF(db.`IDJENIS`='K4',1,0)) 'pemerkosaan',
			SUM(IF(db.`IDJENIS`='K5',1,0)) 'penipuan',
			SUM(IF(db.`IDJENIS`='K6',1,0)) 'penganiayaan',
			SUM(IF(db.`IDJENIS`='K7',1,0)) 'pemerasan'
			FROM detailberita db
			JOIN tbl_kodepos tb ON (db.`IDKELURAHAN` = tb.`IDKELURAHAN`)
			WHERE db.idjenis NOT LIKE('K0') AND tb.`KABUPATEN` NOT LIKE ('N/A')
			GROUP BY tb.`IDKELURAHAN`
			LIMIT 10")->result_array();
		$i=1;
		foreach($query as $row){
			$data['kota']['kabupaten'][$i] = $row['KABUPATEN'];
			$data['kota']['narkoba'][$i] = $row['narkoba'];
			$data['kota']['pencurian'][$i] = $row['pencurian'];
			$data['kota']['pembunuhan'][$i] = $row['pembunuhan'];
			$data['kota']['pemerkosaan'][$i] = $row['pemerkosaan'];
			$data['kota']['penipuan'][$i] = $row['penipuan'];
			$data['kota']['penganiayaan'][$i] = $row['penganiayaan'];
			$data['kota']['pemerasan'][$i] = $row['pemerasan'];
			$i++;
		}
		
		//ambil detail umur (grafik kanan atas)
		$query = $this->db->query("SELECT
					tb.`KABUPATEN`,
					SUM(IF(k.JENISKELAMIN='Laki-laki',1,0)) 'L',
					SUM(IF(k.JENISKELAMIN='Perempuan',1,0)) 'P'
					FROM detailberita db
					JOIN tbl_kodepos tb ON (tb.idkelurahan = db.`IDKELURAHAN`)
					JOIN keterlibatan k ON (k.iddetail = db.`IDDETAIL`)
					WHERE tb.`KABUPATEN` NOT LIKE ('N/A')
					GROUP BY tb.kabupaten 
					ORDER BY COUNT(db.`IDKELURAHAN`) DESC LIMIT 10")->result_array();
		
		$i=1;
		foreach($query as $row){
			$data['umur']['kota'][$i] = $row['KABUPATEN'];
			$data['umur']['L'][$i] = $row['L'];
			$data['umur']['P'][$i] = $row['P'];
			$i++;
		}
		
		//ambil data kejahatan (grafik kiri bawah)
		$query = $this->db->query("SELECT k.jeniskejahatan,
			COUNT(db.`IDJENIS`) a
			FROM kejahatan k
			JOIN detailberita db ON (k.idjenis = db.`IDJENIS`)
			WHERE k.jeniskejahatan NOT IN ('N/A')
			GROUP BY k.jeniskejahatan")->result_array();
		$i=1;
		foreach($query as $row){
			$data['diagramkejahatan']['jenis'][$i] = $row['jeniskejahatan'];
			$data['diagramkejahatan']['jumlah'][$i] = $row['a'];
			$i++;
		}
		
		//ambil umur
		$query = $this->db->query("SELECT 
			tb.`KABUPATEN`,
			SUM(IF(k.`UMURORANG` IN (1,2,3,4,5,6,7,8,9,10),1,0)) 'a',
			SUM(IF(k.`UMURORANG` IN (11,12,13,14,15,16,17,18,19,20),1,0)) 'b',
			SUM(IF(k.`UMURORANG` IN (21,22,23,24,25,26,27,28,29,30),1,0)) 'c',
			SUM(IF(k.`UMURORANG` IN (31,32,33,34,35,36,37,38,39,40),1,0)) 'd',
			SUM(IF(k.`UMURORANG` IN (41,42,43,44,45,46,47,48,49,50),1,0)) 'e',
			SUM(IF(k.`UMURORANG` IN (51,52,53,54,55,56,57,58,59,60),1,0)) 'f',
			SUM(IF(k.`UMURORANG` IN (61,62,63,64,65,66,67,68,69,70),1,0)) 'g',
			SUM(IF(k.`UMURORANG` IN (71,72,73,74,75,76,77,78,79,80),1,0)) 'h'
			FROM detailberita db
			JOIN tbl_kodepos tb ON (db.`IDKELURAHAN` = tb.`IDKELURAHAN`)
			JOIN keterlibatan k ON (db.`IDDETAIL` = k.`IDDETAIL`)
			WHERE db.idjenis NOT LIKE('K0') AND tb.`KABUPATEN` NOT LIKE ('N/A')
			GROUP BY tb.`IDKELURAHAN`
			LIMIT 10")->result_array();
		$i=1;
		foreach($query as $row){
			$data['umur']['kota'][$i] = $row['KABUPATEN'];
			$data['umur']['a'][$i] = $row['a'];
			$data['umur']['b'][$i] = $row['b'];
			$data['umur']['c'][$i] = $row['c'];
			$data['umur']['d'][$i] = $row['d'];
			$data['umur']['e'][$i] = $row['e'];
			$data['umur']['f'][$i] = $row['f'];
			$data['umur']['g'][$i] = $row['g'];
			$data['umur']['h'][$i] = $row['h'];
			$i++;
		}
		
		return $data;
	}
	function selectberita()
	{
		$query = $this->db->query("select * from berita")->result_array();
		//$this->datatables->from("select * from berita");
		
		$i=1;
		foreach($query as $row){
			$data['id'][$i] = $row['IDBERITA'];
			$data['berita'][$i] = substr($row['ISIBERITA'],0,100);
			$i++;
		}
		
		return $data;
	}
	
	function detailberita($id)
	{
		$query = $this->db->query("SELECT
			k.`NAMAORANG`,
			k.`UMURORANG`,
			k.`JENISKELAMIN`,
			db.`TANGGALBERITA`,
			bu.`NAMABULAN`,
			ke.`JENISKEJAHATAN`,
			tb.`KABUPATEN`,
			h.`NAMAHARI`
			FROM keterlibatan k
			JOIN detailberita db ON (k.`IDDETAIL` = db.`IDDETAIL`)
			JOIN kejahatan ke ON (db.`IDJENIS` = ke.`IDJENIS`)
			JOIN tbl_kodepos tb ON (db.`IDKELURAHAN` = tb.`IDKELURAHAN`)
			JOIN berita b ON (db.`IDBERITA` = b.`IDBERITA`)
			JOIN bulan bu ON (db.`IDBULAN` = bu.`IDBULAN`)
			JOIN hari h ON (db.`IDHARI` = h.`IDHARI`)
			WHERE db.`IDBERITA` = '$id'
			GROUP BY k.`NAMAORANG`")->result_array();
				
		$i=1;
		if(!empty($query)){
			foreach($query as $row){
				$data['namaorang'][$i] = $row['NAMAORANG'];
				$data['umur'][$i] = $row['UMURORANG'];
				$data['kelamin'][$i] = $row['JENISKELAMIN'];
				$data['tanggal'] = $row['TANGGALBERITA'];
				$data['bulan'] = $row['NAMABULAN'];
				$data['jenis'] = $row['JENISKEJAHATAN'];
				$data['tempat'] = $row['KABUPATEN'];
				$data['hari'] = $row['NAMAHARI'];
				$i++;
			}
		} else {
			$data['namaorang'][$i] = "N/A";
			$data['umur'][$i] = "N/A";
			$data['kelamin'][$i] = "N/A";
			$data['tanggal'] = "N/A";
			$data['bulan'] = "N/A";
			$data['jenis'] = "N/A";
			$data['tempat'] = "N/A";
			$data['hari'] = "N/A";
		}
		return $data;
	}
}
?>