<?php

namespace App\Services;
use App\Models\Store;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StoreService
{
    private $storeModel;

    public function __construct(Store $storeModel)
    {
        $this->storeModel = $storeModel;
    }

    public function create(array $data)
    {
        try{
            // generate unique $storeCode
            $storeCode = '';
            do {
                $storeCode = Str::random(8);
            } while (Store::where('store_code', $storeCode)->exists());

            // Logic to create a store
            $data['latitude']       = $data['latitude']??'';
            $data['longitude']      = $data['longitude']??'';
            $data['created_by']     = $data['user_id']??'';
            $data['contact_number'] = $data['contact_number']??'';
            $data['store_name']     = $data['store_name']??'';
            $data['email_id']       = $data['email_id']??'';
            $data['address']        = $data['address']??'';
            $data['gst_number']     = $data['gst_number']??'';
            $data['store_code']     = $storeCode??'';
            $data['status']         = 0;
            return $this->storeModel->create($data);

        }catch(Exception $e) {
            dd($e->getMessage());
        }
    }

    public function list(array $aWhere) :array
    {
        try{        
            DB::enableQueryLog();
            return Store::where( $aWhere )->get()->toArray();
            // $queries = DB::getQueryLog();
        }catch(Exception $e) {
            dd($e->getMessage());
        }
    }

    public function update(int $id, array $data)
    {
        // Logic to update a store
    }

    public function delete(int $id, int $strUserId)
    {
        // Find the store by ID
        $store = Store::find($id);
        if (!$store) {
            // Store not found, return a response indicating it's not found
            return false;
        }

        // Delete the store
        $store->delete();

        // Return a success response
        return $store;

    }

    // Add more methods as needed for your business logic
}
