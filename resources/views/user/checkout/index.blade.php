@extends('layouts.user')

@section('content')
<div class="container py-5">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <a href="{{ route('user.cart.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back to Cart</a>
        <h3 class="fw-bold mb-0 order-first">Checkout</h3>
    </div>

    <div class="row g-4">

        {{-- LEFT : SHIPPING + PAYMENT --}}
        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">
                    📦 Shipping Information
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.checkout.place') }}">
                        @csrf

                        {{-- SHIPPING --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">First Name</label>
                                <input type="text" name="first_name"
                                       value="{{ old('first_name') }}"
                                       class="form-control"
                                       placeholder="Juan"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Last Name</label>
                                <input type="text" name="last_name"
                                       value="{{ old('last_name') }}"
                                       class="form-control"
                                       placeholder="Dela Cruz"
                                       required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted">Complete Address</label>
                            <textarea name="address"
                                      rows="3"
                                      class="form-control"
                                      placeholder="House No., Street, Barangay, City"
                                      required>{{ old('address') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small text-muted">Contact Number</label>
                            <input type="text" name="contact_number"
                                   value="{{ old('contact_number') }}"
                                   class="form-control"
                                   placeholder="09XXXXXXXXX"
                                   required>
                        </div>

                        {{-- Payment select removed in favor of radio card style below --}}

                        {{-- PAYMENT METHOD --}}
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white fw-semibold">
                                💳 Mode of Payment
                            </div>

                            <div class="card-body">

                                {{-- COD --}}
                                <div class="form-check border rounded p-3 mb-2">
                                    <input class="form-check-input"
                                               type="radio"
                                               name="payment_method"
                                               id="cod"
                                               value="cash_on_delivery"
                                               @if(old('payment_method', 'cash_on_delivery') == 'cash_on_delivery') checked @endif>
                                    <label class="form-check-label fw-semibold" for="cod">
                                        Cash on Delivery (COD)
                                    </label>
                                    <div class="small text-muted">
                                        Pay when your order arrives
                                    </div>
                                </div>

                                {{-- E-WALLET --}}
                                <div class="form-check border rounded p-3 mb-2">
                                    <input class="form-check-input"
                                               type="radio"
                                               name="payment_method"
                                               id="ewallet"
                                               value="e_wallet"
                                               @if(old('payment_method') == 'e_wallet') checked @endif>
                                    <label class="form-check-label fw-semibold" for="ewallet">
                                        E-Wallet (GCash / Maya)
                                    </label>
                                    <div class="small text-muted">
                                        Secure digital payment
                                    </div>
                                </div>

                                {{-- CARD --}}
                                <div class="form-check border rounded p-3">
                                    <input class="form-check-input"
                                               type="radio"
                                               name="payment_method"
                                               id="card"
                                               value="card"
                                               @if(old('payment_method') == 'card') checked @endif>
                                    <label class="form-check-label fw-semibold" for="card">
                                        Credit / Debit Card
                                    </label>
                                    <div class="small text-muted">
                                        Visa, Mastercard supported
                                    </div>
                                </div>

                            </div>
                        </div>

                        <button class="btn btn-success w-100 py-2 fw-semibold">
                            🛒 Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- RIGHT : ORDER SUMMARY --}}
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 sticky-top" style="top: 90px;">
                <div class="card-header bg-white fw-semibold">
                    🧾 Order Summary
                </div>

                <div class="card-body">

                    @if(count($items))
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($items as $it)
                                <li class="list-group-item px-0 d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-start gap-2">
                                        <img src="{{ $it->image }}"
                                             style="width:56px;height:56px;object-fit:cover;"
                                             class="rounded">
                                        <div>
                                            <div class="fw-semibold">{{ $it->name }}</div>
                                            <small class="text-muted">Qty: {{ $it->quantity }}</small>
                                        </div>
                                    </div>

                                    <div class="fw-semibold text-end">
                                        ₱{{ number_format($it->subtotal, 2) }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-semibold">Total Payment</span>
                            <span class="fs-5 fw-bold text-success">
                                ₱{{ number_format($grandTotal, 2) }}
                            </span>
                        </div>

                        <small class="text-muted">
                            By placing your order, you agree to our terms & conditions.
                        </small>
                    @else
                        <div class="text-muted text-center py-4">
                            No items in your cart.
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
