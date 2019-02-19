<?php

namespace App\Repositories\Contract;

interface VendorContract
{
    /**
     * Show all vendors.
     * 
     * @param void
     * @return object
     */
    public function findAll();

    /**
     * Show detail of vendor.
     * 
     * @param int $id
     * @return object
     */
    public function find($id);

    /**
     * Store order.
     * 
     * @param Request $request
     * @return object
     */
    public function storeOrder($request);
}