<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankAccountTypeRequest;
use App\Http\Requests\UpdateBankAccountTypeRequest;
use App\Http\Resources\Admin\BankAccountTypeResource;
use App\Models\BankAccountType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankAccountTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bank_account_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankAccountTypeResource(BankAccountType::all());
    }

    public function store(StoreBankAccountTypeRequest $request)
    {
        $bankAccountType = BankAccountType::create($request->all());

        return (new BankAccountTypeResource($bankAccountType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BankAccountType $bankAccountType)
    {
        abort_if(Gate::denies('bank_account_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankAccountTypeResource($bankAccountType);
    }

    public function update(UpdateBankAccountTypeRequest $request, BankAccountType $bankAccountType)
    {
        $bankAccountType->update($request->all());

        return (new BankAccountTypeResource($bankAccountType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BankAccountType $bankAccountType)
    {
        abort_if(Gate::denies('bank_account_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccountType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
