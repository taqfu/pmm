@extends ("layouts.app")
@section ('content')
    <form method="POST" action="" class='text-center middle-container'>
        {{ csrf_field() }}

        <div class='form-group'>
            <label for="pin-input" class='' >Pin:</label>
            <input type='text' id='pin-input'  name='pin' maxlength='4' size='4' class='ml-2'/ required>
            <input type='submit' class='btn btn-outline-dark ml-2 ' value='Check In' />
        </div>
    </form>

@endsection
