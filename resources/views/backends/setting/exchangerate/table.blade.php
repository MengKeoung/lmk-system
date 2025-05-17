<div class="card-body p-0 table-wrapper">
    <table class="table table-striped table-hover" id="exchangeRates">
        <thead>
            <tr>
                <th>{{ __('#') }}</th>
                <th>{{ __('Base Currency') }}</th>
                <th>{{ __('Target Currency') }}</th>
                <th>{{ __('Rate') }}</th>
                <th>{{ __('Rate Date') }}</th>
                <th>{{ __('Updated At') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($exchangerates as $rate)
                <tr>
                    <td>{{ $exchangerates->firstItem() + $loop->index }}</td>
                    <td>{{ $rate->baseCurrency->name ?? $rate->base_currency }}</td>
                    <td>{{ $rate->targetCurrency->name ?? $rate->target_currency }}</td>

                    <td>{{ $rate->rate }}</td>
                    <td>{{ $rate->rate_date->format('Y-m-d') }}</td>
                    <td>{{ $rate->updated_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm btn-edit-rate" data-toggle="modal"
                            data-target="#editRateModal" data-id="{{ $rate->id }}"
                            data-base_currency="{{ $rate->base_currency }}"
                            data-target_currency="{{ $rate->target_currency }}" data-rate="{{ $rate->rate }}"
                            data-rate_date="{{ $rate->rate_date->format('Y-m-d') }}">
                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">{{ __('No exchange rates found.') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- @if ($exchangeRates->hasPages())
    <div class="row">
        <div class="col-12 col-sm-6 text-center text-sm-left pt-2">
            {{ __('Showing') }} {{ $exchangeRates->firstItem() }} {{ __('to') }} {{ $exchangeRates->lastItem() }} {{ __('of') }} {{ $exchangeRates->total() }} {{ __('entries') }}
        </div>
        <div class="col-12 col-sm-6 pagination-nav pr-3">
            {{ $exchangeRates->links() }}
        </div>
    </div>
    @endif --}}
</div>
