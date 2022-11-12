<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('./public/libraries/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Crud extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('m_data');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('pdf');
        $this->load->library('dompdf_gen');
    }

    function index(){
        $data['user'] = $this->m_data->tampil_data()->result();
        $this->load->view('v_tampil', $data);
    }

    function tambah(){
        $this->load->view('v_input');
    }

    function tambah_aksi(){
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $pekerjaan = $this->input->post('pekerjaan');
        
        $data = array(
            'nama' => $nama,
            'alamat' => $alamat,
            'pekerjaan' => $pekerjaan
        );
        $this->m_data->input_data($data, 'user');
        redirect('crud');
    }
    
    function edit($id){
        $where = array('id' => $id);
        $data['user'] = $this->m_data->edit_data($where,'user')->result();
        $this->load->view('v_edit',$data);
    }
    
    function update(){
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $pekerjaan = $this->input->post('pekerjaan');

        $data = array(
            'nama' => $nama,
            'alamat' => $alamat,
            'pekerjaan' => $pekerjaan
        );

        $where = array(
            'id' => $id
        );

        $this->m_data->update_data($where,$data,'user');
        redirect('crud');
    }

    function hapus($id){
        $where = array('id' => $id);
        $this->m_data->hapus_data($where,'user');
        redirect('crud');
    }

    function export_excel(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $sheet->setCellValue('A1', "DATA USER"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:D1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "ALAMAT"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "PEKERJAAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $user = $this->m_data->tampil_data()->result();

        $no = 1;
        $numrow = 4;
        foreach($user as $u){
            $sheet->setCellValue('A'.$numrow, $no);
            $sheet->setCellValue('B'.$numrow, $u->nama);
            $sheet->setCellValue('C'.$numrow, $u->alamat);
            $sheet->setCellValue('D'.$numrow, $u->pekerjaan);
      
            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
            
            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan User");
        $fileName = 'dataUser.xlsx';

        // Proses file excel
        // $writer->save('public/exported_excel/'.$fileName);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="dataUser.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        // redirect('crud');
    }

    function import(){
        $data['user'] = $this->m_data->tampil_data()->result();
        $this->load->view('v_import', $data);
    }

    function import_excel(){
        $upload_file = $_FILES['upload_file']['name'];
        $extension = pathinfo($upload_file,PATHINFO_EXTENSION);
        if($extension == 'csv'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        }else if($extension == 'xls'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }else{
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
        $sheetdata   = $spreadsheet->getActiveSheet()->toArray();
        $sheetcount  = count($sheetdata);
        if($sheetcount>1){
            $data = array();
            for($i=1; $i < $sheetcount; $i++){
                $nama_user = $sheetdata[$i][0];
                $alamat_user = $sheetdata[$i][1];
                $pekerjaan_user = $sheetdata[$i][2];
                $data[] = array(
                    'nama'=>$nama_user,
                    'alamat'=>$alamat_user,
                    'pekerjaan'=>$pekerjaan_user
                );
            }
            $insertdata = $this->m_data->insert_batch($data);
            if($insertdata){
                $this->session->set_flashdata('message','<div class="alert alert-success">
                    Import Berhasil </div>');
                redirect('crud/import');
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger">
                    Import Gagal </div>');
                redirect('crud/import');
            }
        }
    }

    function export_pdf(){
        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('L', 'mm','Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,7,'DAFTAR PENGGUNA UMARA',0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(90,6,'Nama',1,0,'C');
        $pdf->Cell(120,6,'Alamat',1,0,'C');
        $pdf->Cell(40,6,'Pekerjaan',1,1,'C');
        $pdf->SetFont('Arial','',10);
        $user = $this->db->get('user')->result();
        $no=0;
        foreach ($user as $u){
            $no++;
            $pdf->Cell(10,6,$no,1,0, 'C');
            $pdf->Cell(90,6,$u->nama,1,0);
            $pdf->Cell(120,6,$u->alamat,1,0);
            $pdf->Cell(40,6,$u->pekerjaan,1,1);
        }
        $pdf->Output();
	
    }

    function chart(){
        $data['user'] = $this->m_data->tampil_data()->result();
        $this->load->view('v_chart', $data);
    }

}