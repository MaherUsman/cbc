<?php

namespace App\Services;

use App\DataTables\ContactUsDataTable;
use App\Http\Requests\ContactUsCreateRequest;
use App\Http\Resources\ContactUsCollection;
use App\Models\ContactUs;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ContactUsService
{
    public function index(ContactUsDataTable $dataTable)
    {
        return $dataTable->render('admin.contactUs.index');
    }

    public function getContactUss()
    {
        $contactUsList = ContactUs::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new ContactUsCollection($contactUsList));
        } else {
            return view('admin.contactUs.index', compact('contactUsList'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.contactUs.create');
        }
    }

    public function store(ContactUsCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $contactUs = ContactUs::create(collect($request->validated())->all());
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $contactUs);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(ContactUs $contactUs)
    {
        $contactUs->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
