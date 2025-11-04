<?php

namespace App\Http\Controllers;

use App\Http\Requests\SecurityStoreRequest;
use App\Http\Requests\SecurityUpdateRequest;
use App\Models\Security;
use App\Services\SecurityService;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public $securityService;

    public function __construct(SecurityService $securityService)
    {
        $this->securityService= $securityService;
    }

    public function index()
    {
        return $this->securityService->createOrEdit();
    }

    public function create()
    {
        return view('admin.security.create');
    }

    public function store(SecurityStoreRequest $request)
    {
        return $this->securityService->store($request);
    }

    public function edit(Security $security)
    {
        return view('admin.security.edit', compact('security'));
    }

    public function update(SecurityUpdateRequest $request, Security $security)
    {
        return $this->securityService->update($request , $security);
    }

    public function destroy(Security $security)
    {
        return $this->securityService->destroy($security);
    }


    public function frontShow(Security $security)
    {
        return view('frontend.securityDetail', compact('security'));
    }
}
