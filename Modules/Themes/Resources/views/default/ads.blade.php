<section>
    <div class="row">
        <div class="col-md-6">
            @if (filter_var(config('app.top_bar_ad_left'), FILTER_VALIDATE_URL))
                <img src="{{ config('app.top_bar_ad_left') }}" alt="ads left" width="100%" height="90px">
            @else
                {!! config('app.top_bar_ad_left') !!}
            @endif
        </div>
        <div class="col-md-6">
            @if (filter_var(config('app.top_bar_ad_right'), FILTER_VALIDATE_URL))
                <img src="{{ config('app.top_bar_ad_right') }}" alt="ads left" width="100%" height="90px">
            @else
                {!! config('app.top_bar_ad_right') !!}
            @endif
        </div>
    </div>
</section>
