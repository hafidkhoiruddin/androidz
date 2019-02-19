<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contract\VendorContract;

class VendorController extends Controller
{
    private $vendorRepo;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VendorContract $vendor)
    {
        $this->vendorRepo = $vendor;

        $this->middleware('auth', ['only' => ['order', 'updateOrder', 'getOrders']]);
    }

    /**
     * Show all vendors.
     * 
     * @param void
     * @return json
     */
    public function index()
    {
        return response()->json([
            'status_code' => 200,
            'vendors' => $this->vendorRepo->findAll()
        ], 200);
    }

    /**
     * Show detail of vendor.
     * 
     * @param void
     * @return json
     */
    public function show($id)
    {
        return response()->json([
            'status_code' => 200,
            'data' => $this->vendorRepo->find($id)
        ], 200);
    }

    /**
     * Store order.
     * 
     * @param Request $request
     * @return json
     */
    public function order(Request $request)
    {
        return response()->json([
            'status_code' => 201,
            'order' => $this->vendorRepo->storeOrder($request)
        ], 201);
    }

    /**
     * Update status orders is done.
     * 
     * @param Request $request
     * @param int $id
     * @return json
     */
    public function updateOrder(Request $request, $id)
    {
        $res = $this->vendorRepo->updateOrder($request, $id);

        if (!$res) {
            return response()->json([
                'status_code' => 404,
                'message' => 'order tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'status order telah selesai.'
        ], 200);
    }

    /**
     * Lists order current user.
     * 
     */
    public function getOrders(Request $request)
    {
        $res = $this->vendorRepo->orders($request);

        return response()->json([
            'status_code' => 200,
            'orders' => $res
        ], 200);
    }
}
