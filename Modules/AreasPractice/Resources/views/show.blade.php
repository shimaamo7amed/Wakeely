@extends(ucfirst(activeGuard()).'.layout')
@section('pagetitle',  __('trans.clients'))
@section('content')
    
        <div class="col-md-6">
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">@lang('trans.name')</th>
                        <td>
                            <div>
                                <p>
                                    {{ $Model->first_name . ' ' . $Model->last_name }}
                                </p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">@lang('trans.phone')</th>
                        <td>
                            <div>
                                <p>{{ $Model->phone_code . $Model->phone }}</p>
                            </div>
                        </td>
                    </tr>
                    @if($Model->email)
                    <tr>
                        <th scope="row">@lang('trans.email')</th>
                        <td>
                            <div>
                                <p>{{ $Model->email }}</p>
                            </div>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <th scope="row">@lang('trans.country')</th>
                        <td>
                            <div>
                                <img src="{{ asset($Model->Country->flag) }}" width="50px">
                                <p>
                                    {{ $Model->Country->title() }}
                                </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    

    
@endsection
