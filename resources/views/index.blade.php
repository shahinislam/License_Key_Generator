@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: #9BC06C">
                <div class="pt-2 pb-4 text-center text-white text-uppercase font-weight-bold">Create License</div>

                <div class="card-body">
                    <table id="userTable" class="table table-bordered bg-white col-md-8 offset-2">
                        <tbody></tbody>
                    </table>
                        
                    <form action="/{{0}}" method="post" id="form">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="client_id" class="text-white col-md-4 col-form-label text-md-right">{{ __('Client ID') }}</label>

                            <div class="col-md-6">
                                <input id="client_id" type="text" class="form-control @error('client_id') is-invalid @enderror" name="client_id" value="{{ old('client_id') }}" placeholder="Client ID (press enter)" autocomplete="client_id" autofocus>

                                @error('client_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="license_key" class="text-white col-md-4 col-form-label text-md-right">{{ __('License Key') }}</label>

                            <div class="col-md-6">
                                <input id="license_key" type="text" class="form-control @error('license_key') is-invalid @enderror" name="license_key" value="{{ old('license_key') }}" autocomplete="license_key" autofocus>

                                @error('license_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4 text-right">
                                <button id="create_key" type="submit" class="btn btn-primary">
                                    {{ __('Create Key') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="license_for" class="text-white col-md-4 col-form-label text-md-right">{{ __('License For') }}</label>

                            <div class="col-md-6">
                                <select id="license_for" class="text-muted form-control @error('license_for') is-invalid @enderror shadow-none" name="license_for" value="{{ old('license_for') }}">
                                    <option {{ old('license_for') == 'Select' ? 'selected': ''}}>Select</option>
                                    <option {{ old('license_for') == '3' ? 'selected' : '' }}>3</option>
                                    <option {{ old('license_for') == '6' ? 'selected' : ''}}>6</option>
                                    <option {{ old('license_for') == '12' ? 'selected' : ''}}>12</option>
                                </select>
                                @error('license_for')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-white col-form-label">Months</div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-block font-weight-bold" style="background-color: #00FFAA">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6 offset-md-4 text-right text-white">Return to <a href="/login" class="text-warning">Login</a> Page.</div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function(){
    $('#client_id').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){ 
            $("#form").submit(function(e){
                e.preventDefault();
                $(this).unbind('submit');
            });
            var userid = Number($('#client_id').val().trim());
            fetchRecords(userid);
        }
    });

    $('#create_key').mousedown(function() {
        $("#form").submit(function(e){
                e.preventDefault();
                $(this).unbind('submit');
        });
        let key = Math.random().toString(36).substring(7);
        $('#license_key').val(key);
    });

    $("#client_id").blur(function(){
        var val = $(this).val().trim();
        console.log(val);
        if(val != "")
        {
            $("form").attr("action", "/" + val);
        }
    });

});

function fetchRecords(id){
  $.ajax({
    url: '/' + id,
    type: 'get',
    dataType: 'json',
    success: function(response){
      
      $('#userTable tbody').empty(); // Empty <tbody>

      if(response['data'] != null){
            var id = response['data'].id;
            var firstname = response['data'].firstname;
            var lastname = response['data'].lastname;
            var organization = response['data'].organization;
            var street = response['data'].street;
            var city = response['data'].city;
            var phone = response['data'].number;
            var email = response['data'].email;
            var license_key = response['data'].license_key;

            var tr_str = "<tr>" +
              "<td>Firstname</td>" +
              "<td>" + firstname + "</td>" +
            "</tr>" + 
            "<tr>" +
              "<td>Lastname</td>" +
              "<td>" + lastname + "</td>" +
            "</tr>" + 
            "<tr>" +
              "<td>Name of Organization</td>" +
              "<td>" + organization + "</td>" +
            "</tr>" + 
            "<tr>" +
              "<td>Street</td>" +
              "<td>" + street + "</td>" +
            "</tr>" + 
            "<tr>" +
              "<td>City</td>" +
              "<td>" + city + "</td>" +
            "</tr>" + 
            "<tr>" +
              "<td>Phone</td>" +
              "<td>" + phone + "</td>" +
            "</tr>" + 
            "<tr>" +
              "<td>Email</td>" +
              "<td>" + email + "</td>" +
            "</tr>" + 
            "<tr>" +
              "<td>License key</td>" +
              "<td>" + license_key + "</td>" +
            "</tr>";

            $("#userTable tbody").append(tr_str);
      }
    },
    error: function (XMLHttpRequest, textstatus, error) {
        $('#userTable tbody').empty();
        var tr_str = "<tr class='bg-danger text-white'>" +
            "<td>No records found.</td>" +
            "</tr>";

            $("#userTable tbody").append(tr_str);
    }

  })
}

</script>

@endsection
