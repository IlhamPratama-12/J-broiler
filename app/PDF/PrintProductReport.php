<?php

namespace App\PDF;

use App\Helpers\DateHelper;
use App\Models\CompanyInfo;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Helpers\NumberHelper;
use App\Models\Company;
use App\Models\Partnership;

class PrintProductReport extends Fpdf
{
    protected $data;
    protected $font = 'Arial';
    protected $leftRightMargin = 10;
    protected $topMargin = 10;
    protected $width = 100;
    protected $height = 100;
    protected $widthcontent;
    protected $pagebreak = 5;
    protected $isFinished = false;

    protected $pageWidth = 201;

    public function __construct($data)
    {
        $this->data = $data;
        parent::__construct('P', 'mm', 'A4');
        $this->SetLeftMargin($this->leftRightMargin);
        $this->SetRightMargin($this->leftRightMargin);
        $this->SetTopMargin($this->topMargin);
        $this->SetAutoPageBreak(true, $this->pagebreak);
        $this->AliasNbPages();
    }

    public function Header()
    {
        $companyId = $this->data['company_id'];
        $partnershipId = $this->data['partnership_id'];
        $company = null;
        $partnership = null;
        if ($companyId) $company = Company::findOrFail($companyId);
        if ($partnershipId) $partnership = Partnership::withTrashed()->where('id', $partnershipId)->first();

        $fontHeader = 11;
        $wHeader = 100;
        $wSubHeader = 30;
        $wSpace = 3;
        $hHeader = 4;
        $this->SetFont($this->font, '', $fontHeader);

        $xStart = $this->GetX();

        // HEADER TENGAH
        $this->SetX(($this->pageWidth - $this->width) / 2);
        if ($company) {
            $this->SetFont($this->font, 'B', $fontHeader + 8);
            $this->Cell($wHeader, $hHeader, $company->name, 0, 1, 'C');
            $this->SetFont($this->font, '', $fontHeader);
            $this->Ln();
            $this->SetX(($this->pageWidth - $this->width) / 2);
            $this->MultiCell($wHeader, $hHeader, $company->address, 0, 'C', 0);
            $this->Ln(2);
            $this->SetX(($this->pageWidth - $this->width) / 2);
            $this->Cell($wHeader, $hHeader, $company->phone, 0, 1, 'C');
            $this->Ln(8);
            $this->SetX(($this->pageWidth - $this->width) / 2);
        }
        $this->SetFont($this->font, 'B', $fontHeader+4);
        $this->Cell($wHeader, $hHeader, 'Laporan Penjualan Produk', 0, 1, 'C');
        // $this->SetLineWidth(0);
        // $this->Line($this->leftMargin, 45, $this->pageWidth+3, 45);
        $this->Ln(10);
        $this->SetFont($this->font, 'B', $fontHeader);
        $this->setX($xStart);
        $this->Cell($wSubHeader, $hHeader,"Tanggal Cetak:", 0, 0, 'L');
        $this->Cell($wSpace, $hHeader,":", 0, 0, 'L');
        $this->SetFont($this->font, '', $fontHeader);
        $this->Cell($wSubHeader, $hHeader,DateHelper::nowString(), 0, 1, 'L');
        $this->Ln(2);
        if ($partnership) {
            $this->SetFont($this->font, 'B', $fontHeader);
            $this->Cell($wSubHeader, $hHeader,"Partner", 0, 0, 'L');
            $this->Cell($wSpace, $hHeader,":", 0, 0, 'L');
            $this->SetFont($this->font, '', $fontHeader);
            $this->Cell($wSubHeader+50, $hHeader,$partnership->full_name, 0, 1, 'L');
            $this->SetFont($this->font, 'B', $fontHeader);
        }
        $this->Ln(2);
        $this->setX($xStart);

        if (isset($this->data['date_start']) && isset($this->data['date_end'])) {
            $this->Cell($wSubHeader, $hHeader, "Tanggal Cari ", 0, 0, 'L');
            $this->Cell($wSpace, $hHeader,":", 0, 0, 'L');
            $this->SetFont($this->font, '', $fontHeader);
            $this->Cell($wSubHeader, $hHeader, DateHelper::dateToString($this->data['date_start']) . " - " . DateHelper::dateToString($this->data['date_end']), 0, 1, 'L');
        }elseif(isset($this->data['date_start'])){
            $this->Cell($wSubHeader, $hHeader, "Tanggal Awal", 0, 0, 'L');
            $this->Cell($wSpace, $hHeader,":", 0, 0, 'L');
            $this->SetFont($this->font, '', $fontHeader);
            $this->Cell($wSubHeader, $hHeader,DateHelper::dateToString($this->data['date_start']), 0, 1, 'L');
        }elseif(isset($this->data['date_end'])){
            $this->Cell($wSubHeader, $hHeader, "Tanggal Akhir", 0, 0, 'L');
            $this->Cell($wSpace, $hHeader,":", 0, 0, 'L');
            $this->SetFont($this->font, '', $fontHeader);
            $this->Cell($wSubHeader, $hHeader, DateHelper::dateToString($this->data['date_end']), 0, 1, 'L');
        }else{
            $this->SetFont($this->font, 'B', $fontHeader);
            $this->Cell($wSubHeader, $hHeader, "Tanggal Cari", 0, 0, 'L');
            $this->Cell($wSpace, $hHeader,": -", 0, 1, 'L');
        }
        $this->Ln(5);
    }

    public function body()
    {
        //HEAD
        $productReport = $this->data['data'];
        $fontBody = 10;
        $height = 8;
        $this->AddPage();

        $wNo = 10;
        $wTgl = 30;
        $wPartner = 35;
        $wProduk = 81;
        $wQty = 20;
        $wSatuan = 15;
        $hColumn = 8;

        $this->SetFont($this->font, 'B', $fontBody);
        $this->Cell($wNo , $height, "No", 'LBT', 0, 'L', 0);
        $this->Cell($wTgl , $height, "Tgl" , 'LBT', 0, 'L', 0);
        $this->Cell($wPartner , $height, "Partner" , 'LBT', 0, 'L', 0);
        $this->Cell($wProduk, $height, "Produk", 'LBT', 0, 'L', 0);
        $this->Cell($wQty , $height, "Qty" , 'LBT', 0, 'L', 0);
        $this->Cell($wSatuan , $height, "Satuan" , 'LRBT', 1, 'L', 0);
        //DETAIL
        $this->SetFont($this->font, '', $fontBody);
        foreach ($productReport as $key => $item) {
            $this->Cell($wNo, $hColumn, $key+1, 'L', 0, 'L', 0);
            $this->Cell($wTgl, $hColumn, DateHelper::dateToString($item['date']), 'L', 0, 'L', 0);
            $this->Cell($wPartner , $hColumn, $item['partner'] , 'L', 0, 'L', 0);
            $this->Cell($wProduk, $hColumn, $item['product_name'], 'L', 0, 'L', 0);
            $this->Cell($wQty, $hColumn, NumberHelper::numberFormat($item['qty']), 'L', 0, 'L', 0);
            $this->Cell($wSatuan, $hColumn, $item['unit'], 'LR', 1, 'L', 0);
            if ($this->data['company_id']) {
                if ($this->getY() >= 260) {
                    $this->Cell($this->pageWidth - $this->leftRightMargin, $hColumn,  '', 'T', 1, 'L', 0);
                    $this->AddPage();
                    $this->Cell($this->pageWidth - $this->leftRightMargin, 1,  '', 'B', 1, 'L', 0);
                }
            }else{
                if ($this->getY() >= 275) {
                    $this->Cell($this->pageWidth - $this->leftRightMargin, $hColumn,  '', 'T', 1, 'L', 0);
                    $this->AddPage();
                    $this->Cell($this->pageWidth - $this->leftRightMargin, 1,  '', 'B', 1, 'L', 0);
                }
            }
        }
        $this->Cell($this->pageWidth - $this->leftRightMargin, $hColumn,  '', 'T', 1, 'L', 0);
        $this->Ln(1);
        $this->isFinished == true;
    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
