<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWalletRequest;
use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use App\Models\Wallet;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WalletsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('wallet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wallets = Wallet::all();

        return view('frontend.wallets.index', compact('wallets'));
    }

    public function create()
    {
        abort_if(Gate::denies('wallet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.wallets.create');
    }

    public function store(StoreWalletRequest $request)
    {
        $wallet = Wallet::create($request->all());

        return redirect()->route('frontend.wallets.index');
    }

    public function edit(Wallet $wallet)
    {
        abort_if(Gate::denies('wallet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.wallets.edit', compact('wallet'));
    }

    public function update(UpdateWalletRequest $request, Wallet $wallet)
    {
        $wallet->update($request->all());

        return redirect()->route('frontend.wallets.index');
    }

    public function show(Wallet $wallet)
    {
        abort_if(Gate::denies('wallet_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.wallets.show', compact('wallet'));
    }

    public function destroy(Wallet $wallet)
    {
        abort_if(Gate::denies('wallet_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wallet->delete();

        return back();
    }

    public function massDestroy(MassDestroyWalletRequest $request)
    {
        $wallets = Wallet::find(request('ids'));

        foreach ($wallets as $wallet) {
            $wallet->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
