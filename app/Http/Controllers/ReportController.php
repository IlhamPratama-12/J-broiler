<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Models\Company;
use App\Models\Partnership;
use App\Models\Product;
use App\Models\Sale;
use App\PDF\PrintProductReport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function getProductReport(Request $request) {
        $keyword = $request->keyword;
        $dateStart = isset($request->date_start) ? DateHelper::stringToDate($request->date_start) : null;
        $dateEnd = isset($request->date_end) ? DateHelper::stringToDate($request->date_end) : null;
        $partnerId = $request->partnership_id;
        $companyId = $request->company_id;
        $report = Sale::select([
                'sd.product_id',
                'sales.date',
                'partner.full_name as partner',
                'p.name as product_name',
                DB::raw('SUM(sd.qty) as qty'),
                'p.unit',
            ])
            ->join('partnerships as partner', 'partner.id', 'sales.partnership_id')
            ->join('sale_details as sd', 'sd.sale_id', 'sales.id')
            ->join('products as p', 'p.id', 'sd.product_id')
            ->where('sales.status','!=', 'CANCEL')
            ->whereNull('sales.deleted_at')
            ->when(isset($keyword), function ($q) use ($keyword) {
                $q->where(function ($q) use ($keyword) {
                    $q->where('sales.code', 'LIKE', "%$keyword%")
                        ->orWhere('p.name', 'LIKE', "%$keyword%")
                        ->orWhere('partner.full_name', 'LIKE', "%$keyword%");
                });
            })
            ->when(isset($dateStart), function ($q) use ($dateStart) {
                $q->whereDate('sales.date', '>=', $dateStart);
            })
            ->when(isset($dateEnd), function ($q) use ($dateEnd) {
                $q->whereDate('sales.date', '<=', $dateEnd);
            })
            ->when(isset($partnerId), function ($q) use ($partnerId) {
                $q->where('sales.partnership_id', $partnerId);
            })
            ->when(isset($companyId), function ($q) use ($companyId) {
                $q->where('sales.company_id', $companyId);
            })
            ->groupBy([
                'sd.product_id',
                'p.name',
                'sales.date',
                'partner.full_name',
                'p.unit',
            ])
            ->orderBy('sales.date', 'DESC');
        return $report;
    }

    public function productReport(Request $request) {
        $partnerships = Partnership::orderBy('full_name', 'ASC')->get();
        $companies = Company::orderBy('id', 'DESC')->get();
        $indexData = $this->getProductReport($request);
        $report = $indexData->paginate(10);

        return view('admin.pages.reports.index', [
            'partnerships' => $partnerships,
            'companies' => $companies,
            'report' => $report,
        ]);
    }

    public function productReportPrint(Request $request){

        DB::beginTransaction();
        try {
            $indexData = $this->getProductReport($request);

            $data['data'] = $indexData->get();
            $data['date_start'] = isset($request->date_start) ? DateHelper::stringToDate($request->date_start) : null;
            $data['date_end'] = isset($request->date_end) ? DateHelper::stringToDate($request->date_end) : null;
            $data['partnership_id'] = $request->partnership_id ?? null;
            $data['company_id'] = $request->company_id ?? null;
            $pdf = new PrintProductReport($data);
            $pdf->body();
            //Path lokasi untuk menyimpan PDF
            $namafile = "Laporan-Penjualan-Barang-" . now()->format('Y-m-d-h-i-s-u');
            $response = response($pdf->Output("S"));
            $response->header("Content-Type", "application/pdf");
            $response->header("Content-Disposition", "inline; filename=" . $namafile . ".pdf");
            $response->header("Cache-Control:", "private, max-age=0, must-revalidate");
            DB::commit();
            return $response;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
