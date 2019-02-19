<?php

namespace App\Repositories;

use DB;
use App\Models\User;
use App\Models\Vendor;
use App\Repositories\Contract\VendorContract;

class VendorRepository implements VendorContract
{
    private $model;

    /**
     * Constructor.
     * 
     */
    public function __construct(Vendor $vendor)
    {
        $this->model = $vendor;
    }

    /**
     * Show all vendors.
     * 
     * @param void
     * @return object
     */
    public function findAll()
    {
        return $this->model->select('id', 'vendor_name', 'vendor_price')->orderBy('id', 'desc')->get();
    }

    /**
     * Show detail of vendor.
     * 
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        $vendor = $this->model->find($id);

        return [
            'vendor' => $vendor,
            'soccer_fields' => $vendor->fields()->get()
        ];
    }

    /**
     * Store order.
     * 
     * @param Request $request
     * @return object
     */
    public function storeOrder($request)
    {
        $vendor = $this->model->find($request->vendor_id);

        return $vendor->orders()->create([
            'user_id' => $request->auth->id,
            'soccer_field_id' => $request->field_id,
            'date' => date('Y-m-d'),
            'start_time' => $request->start,
            'end_time' => $request->end,
            'price' => ($request->end - $request->start) * $vendor->vendor_price
        ]);
    }

    /**
     * Update order.
     * 
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function updateOrder($request, $id)
    {
        $vendor = $this->model->where('user_id', $request->auth->id)->first();
        $order = $vendor->orders()->find($id);
        
        if (!$order) return false;
        $order->delete();
        
        return true;
    }

    /**
     * Lists orders current users.
     * 
     */
    public function orders($request)
    {
        // return User::find($request->auth->id)->orders()->with(['user', 'vendor'])->get();
        return DB::table('orders')
            ->join('users', 'orders.user_id', 'users.id')
            ->join('vendors', 'orders.vendor_id', 'vendors.id')
            ->join('soccer_fields', 'orders.soccer_field_id', 'soccer_fields.id')
            ->select('users.id as user_id', 'users.name', 'users.email', 'orders.id as order_id', 'orders.date', 'orders.start_time', 'orders.end_time', 'orders.price', 'vendors.vendor_name', 'soccer_fields.field_name')
            ->where('users.id', $request->auth->id)
            ->where('orders.user_id', $request->auth->id)
            ->get();
    }
}