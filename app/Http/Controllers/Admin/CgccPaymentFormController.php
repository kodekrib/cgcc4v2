<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCgccPaymentFormRequest;
use App\Http\Requests\StoreCgccPaymentFormRequest;
use App\Http\Requests\UpdateCgccPaymentFormRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CgccPaymentFormController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cgcc_payment_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cgccPaymentForms.index');
    }

    public function create()
    {
        abort_if(Gate::denies('cgcc_payment_form_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cgccPaymentForms.create');
    }

    public function store(StoreCgccPaymentFormRequest $request)
    {
        $cgccPaymentForm = CgccPaymentForm::create($request->all());

        return redirect()->route('admin.cgcc-payment-forms.index');
    }

    public function edit(CgccPaymentForm $cgccPaymentForm)
    {
        abort_if(Gate::denies('cgcc_payment_form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cgccPaymentForms.edit', compact('cgccPaymentForm'));
    }

    public function update(UpdateCgccPaymentFormRequest $request, CgccPaymentForm $cgccPaymentForm)
    {
        $cgccPaymentForm->update($request->all());

        return redirect()->route('admin.cgcc-payment-forms.index');
    }

    public function show(CgccPaymentForm $cgccPaymentForm)
    {
        abort_if(Gate::denies('cgcc_payment_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cgccPaymentForms.show', compact('cgccPaymentForm'));
    }

    public function destroy(CgccPaymentForm $cgccPaymentForm)
    {
        abort_if(Gate::denies('cgcc_payment_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cgccPaymentForm->delete();

        return back();
    }

    public function massDestroy(MassDestroyCgccPaymentFormRequest $request)
    {
        CgccPaymentForm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
