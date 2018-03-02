@extends ('layouts.app')
@section('content')
<div class='container-fluid'>
    <div id='time-zone-settings' class='mb-5'>

        <form method="POST" action="{{route('timezone-change')}}">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <label for="time-zone-select-group">
                Your time-zone is: {{Auth::user()->timezone}}
            </label>
            <div id="time-zone-select-group" class='input-group col-lg-4'>
                <select name='timezone' class='custom-select'>
                <?php
                $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                    foreach($tzlist as $tz){
                        echo "<option ";
                        if ($tz == Auth::user()->timezone){
                            echo "selected";
                        }
                        echo ">$tz</option>";
                    }
                ?>
                </select>
                <div class='input-group-append'>
                    <input type='submit' class='btn btn-outline-dark' value='Change Time Zone' />
                </div>
            </div>
        </form>
        <div class='row'>
        @if ($errors->get('timezone'))
            @foreach ($errors->get('timezone') as $error)
            <div class='text-danger'>{{ $error }}</div>
            @endforeach
        @endif
        </div>
    </div>
    @if (Auth::user()->public_check_in == 0)
        <div>
            You can check in without logging in just by visiting your personal page and inputting a pin.
        </div><div class='form-group'>
            <label for="public-profile-button-group">Enable public profile:</label>
            <div id='public-profile-button-group' class='btn-group'>
                <input type='button' class='btn btn-outline-dark' value="With pin" data-toggle="collapse" href="#public-profile-with-pin" class='collapse form-inline mt-4' />
                <input id='no-pin' type='button' class='btn btn-outline-dark' value='Without pin' />
            </div>
            @if ($errors->get('pin'))
                @foreach ($errors->get('pin') as $error)
                    <div class='text-danger'>{{ $error }}</div>
                @endforeach
            @endif
        </div>
        <form id="public-profile-with-pin" method="POST" action="{{route('public-profile-change')}}" class='collapse' >
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type='hidden' name='publicCheckIn' value='1' />

            <div class='form-group'>
                <label for="pin-input" class='' >Pin:</label>
                <input type='text' id='pin-input'  name='pin' maxlength='4' size='4' class='ml-2'/ required>
                <input type='submit' class='btn btn-outline-dark ml-2 ' value='Enable' />
            </div>
        </form>
        <form id="public-profile-without-pin" method="POST" action="{{route('public-profile-change')}}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <input type='hidden' name='publicCheckIn' value='2' />
        </form>
    @elseif (Auth::user()->public_check_in == 1)
        <div>You can publicly check in at
            <a href="{{route('public-check-in', ['id'=>Auth::user()->id,
              'check-in-uuid'=>Auth::user()->check_in_uuid])}}">
                {{route('public-check-in', ['id'=>Auth::user()->id,
                  'check-in-uuid'=>Auth::user()->check_in_uuid])}}
            </a>. Your pin is {{Auth::user()->pin}}.
        </div>
    @elseif (Auth::user()->public_check_in == 2)
        <div>You can publicly check in at
            <a href="{{route('public-check-in', ['id'=>Auth::user()->id,
              'check-in-uuid'=>Auth::user()->check_in_uuid])}}">
                {{route('public-check-in', ['id'=>Auth::user()->id,
                  'check-in-uuid'=>Auth::user()->check_in_uuid])}}
            </a>.
        </div> There is no pin to do this and anyone with access to the link can check you in to reset your messages.
    @endif
    @if (Auth::user()->public_check_in != 0)
        <form method="POST" action="{{route('public-profile-change')}}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <input type='hidden' name='publicCheckIn' value='0' />
            <input type='submit' value="Reset" class='btn btn-outline-dark' />
        </form>
    @endif
</div>
@endsection
