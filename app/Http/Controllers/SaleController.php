<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Company;
use App\Models\Product;
use App\Models\SaleDetail;
use App\Helpers\DateHelper;
use App\Models\Partnership;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\SaleResource;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $req = $request->validate([
            'keyword' => 'nullable',
            'company_id' => 'required|exists:companies,id',
            'date_start' => 'nullable',
            'date_end' => 'nullable',
        ]);

        $companyId = $req['company_id'] ?? null;
        $keyword = $req['keyword'] ?? null;
        $dateStart = isset($req['date_start']) ? DateHelper::stringToDate($req['date_start']) : null;
        $dateEnd = isset($req['date_end']) ? DateHelper::stringToDate($req['date_end']) : null;

        $sales = Sale::query()
            ->join('partnerships as partner', 'partner.id', 'sales.partnership_id')
            ->where('sales.company_id', $companyId)
            ->when(isset($keyword), function ($q) use ($keyword) {
                $q->where(function ($q) use ($keyword) {
                    $q->where('sales.code', 'LIKE', "%$keyword%")
                        ->orWhere('partner.full_name', 'LIKE', "%$keyword%");
                });
            })
            ->when(isset($dateStart), function ($q) use ($dateStart) {
                $q->whereDate('sales.date', '>=', $dateStart);
            })
            ->when(isset($dateEnd), function ($q) use ($dateEnd) {
                $q->whereDate('sales.date', '<=', $dateEnd);
            })
            ->select('sales.*', 'partner.full_name')
            ->orderBy('date', 'DESC');

        if ($companyId == 1) {
            return view('admin.pages.sales.pt.index', [
                'sales' => $sales->paginate(10),
            ]);
        }
        elseif($companyId == 2){
            return view('admin.pages.sales.cv.index', [
                'sales' => $sales->paginate(10),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $req = $request->validate(['company_id' => 'required|exists:companies,id']);
        $companyId = $req['company_id'];
        $paymentMethods = PaymentMethod::all();
        $partnerships = Partnership::all();
        $products = Product::query();
        $sale = new Sale();

        if ($companyId == 1) {
            return view('admin.pages.sales.pt.create', [
                'paymentMethods' => $paymentMethods,
                'partnerships' => $partnerships,
                'sale' => $sale,
                'products' => $products->where('product_category_id', '!=', 5)->get(),
                'title' => 'PT FL MANDIRI SEJAHTERA - Tambah Penjualan',
            ]);
        }else{
            return view('admin.pages.sales.cv.create', [
                'partnerships' => $partnerships,
                'sale' => $sale,
                'products' => $products->whereNotIn('product_category_id', ['1','2','3','4'])->get(),
                'title' => 'CV Dian Latippa - Tambah Penjualan',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'date' => 'required|date',
            'partnership_id' => 'required|exists:partnerships,id',
            'payment_method' => 'nullable|exists:payment_methods,name',
            'total' => 'nullable',
            'notes' => 'nullable',
            'status' => 'nullable|exists:sale_statuses,name',
            'sale_details' => 'required|array|min:1',
            'sale_details.*.product_id' => 'required|exists:products,id',
            'sale_details.*.qty' => 'required',
            'sale_details.*.price' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $userId = Auth::id();
            $input['code'] = Sale::autogenerateCode('P', Carbon::parse($input['date']));
            $input['total'] = isset($input['total']) ? $input['total'] : null;
            $input['created_by'] = $userId;
            $input['updated_by'] = $userId;
            $sale = Sale::create($input);

            foreach ($input['sale_details'] as $item) {
                $productId = (int)$item['product_id'];
                $qty = (int)$item['qty'] ?? 0;
                $price = isset($item['price']) ? (int)$item['price'] : 0;
                $subtotal = $qty * $price;
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'qty' => $qty,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);
            }
            $sale->update($input);
            DB::commit();
            return response()->json([
                'data' => new SaleResource($sale),
                'message' => 'Data berhasil disimpan.'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'errors' => $e
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view('admin.pages.sales.show', [
            'sale' => $sale,
            'title' => 'Detail Penjualan',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $paymentMethods = PaymentMethod::all();
        $partnerships = Partnership::all();

        if ($sale->company_id == 1) {
            return view('admin.pages.sales.pt.create', [
                'partnerships' => $partnerships,
                'paymentMethods' => $paymentMethods,
                'sale' => $sale,
                'title' => 'PT FL MANDIRI SEJAHTERA - Edit Penjualan',
            ]);
        }else if($sale->company_id == 2){
            return view('admin.pages.sales.cv.create', [
                'partnerships' => $partnerships,
                'sale' => $sale,
                'title' => 'CV Dian Latippa -Edit Penjualan',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $input = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'date' => 'required|date',
            'partnership_id' => 'required|exists:partnerships,id',
            'payment_method' => 'nullable|exists:payment_methods,name',
            'total' => 'nullable',
            'notes' => 'nullable',
            'status' => 'nullable|exists:sale_statuses,name',
            'sale_details' => 'required|array|min:1',
            'sale_details.*.product_id' => 'required|exists:products,id',
            'sale_details.*.qty' => 'required',
            'sale_details.*.price' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $userId = Auth::id();
            $sale->saleDetails()->delete();
            foreach ($input['sale_details'] as $item) {
                $productId = (int)$item['product_id'];
                $qty = (int)$item['qty'] ?? 0;
                $price = isset($item['price']) ? (int)$item['price'] : 0;
                $subtotal = $qty * $price;
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'qty' => $qty,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);
            }
            $input["updated_by"] = $userId;
            $sale->update($input);
            DB::commit();
            return response()->json([
                'data' => new SaleResource($sale),
                'message' => 'Data berhasil disimpan.'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'errors' => $e
            ]);
        }
    }

    public function destroy(Sale $sale)
    {
        $userId = Auth::id();
        $sale->saleDetails()->delete();
        $sale->update([
            'status' => 'CANCEL',
            'updated_by' => $userId,
            'deleted_by' => $userId,
        ]);
        $sale->delete();
        return response()->json([
            'message' => 'Data penjualan berhasil dihapus.'
        ]);
    }

    public function cancel(Sale $sale)
    {
        $userId = Auth::id();
        $sale->saleDetails()->delete();
        $sale->update([
            'status' => 'CANCEL',
            'updated_by' => $userId,
            'deleted_by' => $userId,
        ]);
        return response()->json([
            'message' => 'Data penjualan dibatalkan.'
        ]);
    }

    public function print(Request $request, Sale $sale)
    {
        $req = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'type' => 'required|in:TRAVEL,INVOICE',
        ]);
        $type = $req['type'] == 'TRAVEL' ? 'Surat Jalan' : 'Invoice';
        $company = Company::where('id', $req['company_id'])->first();
        return view('admin.pages.sales.invoice', [
            'company' => $company,
            'type' => $type,
            'sale' => $sale
        ]);
    }

    public function listPending(Request $request){
        $sales = Sale::where('status', 'PENDING')->where('company_id', '2')->paginate(10);
        return view('admin.pages.sales.cv.list-pending', [
            'sales' => $sales,
            'title' => 'PT FL MANDIRI SEJAHTERA - Penjualan Pending',
        ]);
    }

    public function isActive(Sale $sale) {
        $userId = Auth::id();
        $sale->update([
            'status' => 'ACTIVE',
            'updated_by' => $userId,
        ]);
        return response()->json([
            'message' => 'Berhasil, Data penjualan diubah ke Aktif.'
        ]);
    }
}
