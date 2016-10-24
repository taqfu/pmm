$(document.body).ready(function () {
    $(document).on('click', '.cancel-button', function(event){
        var id = event.target.id.substr(7, event.target.id.length-7);
        $("#" + id).addClass('hidden');
        $("#show-" + id).removeClass('hidden');
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
