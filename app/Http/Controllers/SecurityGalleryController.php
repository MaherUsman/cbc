<?php

namespace App\Http\Controllers;

use App\Http\Requests\SecurityGalleryRequest;
use App\Models\Security;
use App\Models\SecurityGallery;
use App\Services\SecurityGalleryService;
use Illuminate\Http\Request;

class SecurityGalleryController extends Controller
{
    public $securityGalleryService;

    public function __construct(SecurityGalleryService $securityGalleryService)
    {
        $this->securityGalleryService = $securityGalleryService;
    }

    public function index(Request $request, Security $security)
    {
        return $this->securityGalleryService->index($request, $security);
    }

    public function gridView(Security $security)
    {
        return $this->securityGalleryService->getImageObjects($security);
    }

    public function create(Security $security)
    {
        return $this->securityGalleryService->create($security);
    }

    public function store(SecurityGalleryRequest $request, Security $security)
    {
        return $this->securityGalleryService->store($request, $security);
    }

    public function show(SecurityGallery $securityGallery)
    {
        //
    }

    public function edit(SecurityGallery $securityGallery)
    {
        return $this->securityGalleryService->edit($securityGallery);
    }

    public function update(Request $request, SecurityGallery $securityGallery)
    {
        return $this->securityGalleryService->update($request, $securityGallery);
    }

    public function updateOrder(Request $request)
    {
        return $this->securityGalleryService->updateOrder($request);
    }

    public function destroy(SecurityGallery $securityGallery)
    {
        return $this->securityGalleryService->destroy($securityGallery);
    }
}
