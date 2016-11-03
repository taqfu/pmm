$(document.body).ready(function () {
    $(document).on('change', '[name=confirmPeriod]', function(event){
        if($("[name=confirmPeriod]:checked").val()=='immediately'){
            $("#confirm-iterations").addClass('hidden');
        } else {
            $("#confirm-iterations").removeClass('hidden');
        }

    });
    $(document).on('change', '[name=checkInEvery]', function(event){
        if($("[name=checkInEvery]").val()==1){
            $(".plural").addClass('hidden');
        } else {
            $(".plural").removeClass('hidden');
        }

    });
    $(document).on('click', '.cancel-button', function(event){
        var id = event.target.id.substr(7, event.target.id.length-7);
        $("#" + id).addClass('hidden');
        $("#show-" + id).removeClass('hidden');
    });
    $(document).on('click', '.cover-button', function(event){
        var id = event.target.id.substr(6, event.target.id.length-6);
        $("#cover-" + id).addClass('hidden');
        $("#expose-" + id).removeClass('hidden');
        $("#" + id).addClass('hidden');
        $("#" + id + "-cover").removeClass('hidden');
    });
    $(document).on('click', '.expose-button', function(event){
        var id = event.target.id.substr(7, event.target.id.length-7);
        $("#cover-" + id).removeClass('hidden');
        $("#expose-" + id).addClass('hidden');
        $("#" + id).removeClass('hidden');
        $("#" + id + "-cover").addClass('hidden');
    });
    $(document).on('mouseleave', '#hide-toggle-activation-button', function(event){
      $('#hide-toggle-activation-button').addClass("hidden");
      $('#show-toggle-activation-button').removeClass("hidden");
    });
    $(document).on('mouseover', '#show-toggle-activation-button', function(event){
      $('#show-toggle-activation-button').addClass("hidden");
      $('#hide-toggle-activation-button').removeClass("hidden");
    });
    $(document).on('click', '.replace-primary-button', function(event){
        var id = event.target.id.substr(16, event.target.id.length-16);
        $("#" + id + "-primary").addClass('hidden');
        $("#" + id + "-secondary").removeClass('hidden');
    });
    $(document).on('click', '.replace-secondary-button', function(event){
        var id = event.target.id.substr(18, event.target.id.length-18);
        $("#" + id + "-primary").removeClass('hidden');
        $("#" + id + "-secondary").addClass('hidden');
    });
    $(document).on('click', '.show-button', function(event){
        var id = event.target.id.substr(5, event.target.id.length-5);
        $("#" + id).removeClass('hidden');
        $("#show-" + id).addClass('hidden');
    });
    $(document).on('click', '.delete-message-button', function(event){
        var id = event.target.id.substr(14, event.target.id.length-14);
        if (confirm("Are you sure you want to delete this message?")) {
                $("form#delete-message" + id).submit();
        }
    });
});
