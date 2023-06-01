<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBankAccountTypeRequest;
use App\Http\Requests\StoreBankAccountTypeRequest;
use App\Http\Requests\UpdateBankAccountTypeRequest;
use App\Models\BankAccountType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BankAccountTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bank_account_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BankAccountType::query()->select(sprintf('%s.*', (new BankAccountType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bank_account_type_show';
                $editGate = 'bank_account_type_edit';
                $deleteGate = 'bank_account_type_delete';
                $crudRoutePart = 'bank-account-types';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('account_type', function ($row) {
                return $row->account_type ? $row->account_type : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.bankAccountTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bank_account_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankAccountTypes.create');
    }

    public function store(StoreBankAccountTypeRequest $request)
    {
        $bankAccountType = BankAccountType::create($request->all());

        return redirect()->route('admin.bank-account-types.index');
    }

    public function edit(BankAccountType $bankAccountType)
    {
        abort_if(Gate::denies('bank_account_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankAccountTypes.edit', compact('bankAccountType'));
    }

    public function update(UpdateBankAccountTypeRequest $request, BankAccountType $bankAccountType)
    {
        $bankAccountType->update($request->all());

        return redirect()->route('admin.bank-account-types.index');
    }

    public function show(BankAccountType $bankAccountType)
    {
        abort_if(Gate::denies('bank_account_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankAccountTypes.show', compact('bankAccountType'));
    }

    public function destroy(BankAccountType $bankAccountType)
    {
        abort_if(Gate::denies('bank_account_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccountType->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankAccountTypeRequest $request)
    {
        BankAccountType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
