<?php


use App\Http\Resources\AppointmentCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

function makeResponse($result, $message, $code = 200, $data = null, $token = null)
{
    if ($token) {
        return response()->json([
            'result' => $result,
            'message' => $message,
            'data' => $data,
            'token' => $token
        ], $code);
    } else {
        return response()->json([
            'result' => $result,
            'message' => $message,
            'data' => $data
        ], $code);
    }

}

function makeWebResponse($result, $message, $url = null, $html = null)
{
    return [
        'result' => $result,
        'message' => $message,
        'html' => $html,
        'url' => $url
    ];
}

function paginateResponse($data)
{
    $finalArray = [
        'last_page' => $data->lastPage(),
        'current_page' => $data->currentPage(),
        'total_matching_record' => $data->total(),
        'item_per_page' => $data->perPage()
    ];
    return $finalArray;
}

function paginateDateResponse($request, $model, $key, $searchKey = 'name')
{
    if ($request->has('search') && $request->search != '') {
        $model->where($searchKey, 'like', '%' . $request->search . '%');
    }

    if ($request->has('category_id') && $request->category_id != '') {
        $model->where('category_id', $request->category_id);
    }

    if (isset($request->no_pagination) && ($request->no_pagination)) {
        $modelPagination = [
            'last_page' => 0,
            'current_page' => 0,
            'total_matching_record' => 0,
            'item_per_page' => 0
        ];
        $model = $model->get();
    } else {
        if ($request->length) {
            $model = $model->paginate($request->length);
        } else {
            $model = $model->paginate('10');
        }
        $modelPagination = paginateResponse($model);
        $model = $model->items();
    }

//    $modelArray = $this->trackListingResponse($model);
    return [
        $key => $model, //$modelArray,
        'pagination' => $modelPagination
    ];
}

function paginateCollectionResponse($request, $model)
{
    if ($request->length) {
        $model = $model->paginate($request->length);
    } else {
        $model = $model->paginate('10');
    }
    $modelPagination = paginateResponse($model);
    return [
        'appointments' => new AppointmentCollection($model),
        'pagination' => $modelPagination
    ];
}

