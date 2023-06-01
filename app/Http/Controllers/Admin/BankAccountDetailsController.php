<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBankAccountDetailRequest;
use App\Http\Requests\StoreBankAccountDetailRequest;
use App\Http\Requests\UpdateBankAccountDetailRequest;
use App\Models\BankAccountDetail;
use App\Models\BankAccountType;
use App\Models\Currency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BankAccountDetailsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bank_account_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BankAccountDetail::with(['account_type', 'currency'])->select(sprintf('%s.*', (new BankAccountDetail())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bank_account_detail_show';
                $editGate = 'bank_account_detail_edit';
                $deleteGate = 'bank_account_detail_delete';
                $crudRoutePart = 'bank-account-details';

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
            $table->editColumn('account_name', function ($row) {
                return $row->account_name ? $row->account_name : '';
            });
            $table->addColumn('account_type_account_type', function ($row) {
                return $row->account_type ? $row->account_type->account_type : '';
            });

            $table->addColumn('currency_currency', function ($row) {
                return $row->currency ? $row->currency->currency : '';
            });

            $table->editColumn('account_number', function ($row) {
                return $row->account_number ? $row->account_number : '';
            });
            $table->editColumn('sort_code', function ($row) {
                return $row->sort_code ? $row->sort_code : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'account_type', 'currency']);

            return $table->make(true);
        }

        return view('admin.bankAccountDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bank_account_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account_types = BankAccountType::pluck('account_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('currency', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bankAccountDetails.create', compact('account_types', 'currencies'));
    }

    public function store(StoreBankAccountDetailRequest $request)
    {
        $bankAccountDetail = BankAccountDetail::create($request->all());

        return redirect()->route('admin.bank-account-details.index');
    }

    public function edit(BankAccountDetail $bankAccountDetail)
    {
        abort_if(Gate::denies('bank_account_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account_types = BankAccountType::pluck('account_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('currency', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bankAccountDetail->load('account_type', 'currency');

        return view('admin.bankAccountDetails.edit', compact('account_types', 'bankAccountDetail', 'currencies'));
    }

    public function update(UpdateBankAccountDetailRequest $request, BankAccountDetail $bankAccountDetail)
    {
        $bankAccountDetail->update($request->all());

        return redirect()->route('admin.bank-account-details.index');
    }

    public function show(BankAccountDetail $bankAccountDetail)
    {
        abort_if(Gate::denies('bank_account_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccountDetail->load('account_type', 'currency');

        return view('admin.bankAccountDetails.show', compact('bankAccountDetail'));
    }

    public function destroy(BankAccountDetail $bankAccountDetail)
    {
        abort_if(Gate::denies('bank_account_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccountDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankAccountDetailRequest $request)
    {
        BankAccountDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
