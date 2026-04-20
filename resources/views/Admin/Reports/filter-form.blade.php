<form action="{{ url()->current() }}" method="GET" class="mb-4">
    <div class="row align-items-end">

        <div class="col-md-3">
            <label>@lang('trans.range')</label>
            <select name="range" class="form-control">
                <option value="">@lang('trans.select_range')</option>
                <option value="day" {{ request('range') == 'day' ? 'selected' : '' }}>@lang('trans.today')</option>
                <option value="week" {{ request('range') == 'week' ? 'selected' : '' }}>@lang('trans.this_week')</option>
                <option value="month" {{ request('range') == 'month' ? 'selected' : '' }}>@lang('trans.this_month')</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>@lang('trans.from')</label>
            <input type="date" name="from" class="form-control" value="{{ request('from') }}">
        </div>

        <div class="col-md-3">
            <label>@lang('trans.to')</label>
            <input type="date" name="to" class="form-control" value="{{ request('to') }}">
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-dark">@lang('trans.filter')</button>
            <a href="{{ url()->current() }}" class="btn btn-secondary">@lang('trans.reset')</a>
        </div>

    </div>
</form>