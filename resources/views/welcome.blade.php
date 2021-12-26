<!doctype html>
<html lang="fr">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src='{{asset("jquery.js")}}'></script>
    <link rel="stylesheet" href='{{asset("fullcalendar.css")}}'>
    <script src='{{asset("moment.js")}}'></script>
    <script src='{{asset("fullcalendar.js")}}'></script>

</head>
<style>
    #calendar{
        width:70%;
        height: 90Vh;
        margin: auto
    }
</style>
<body>
    <div id="calendar"></div>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable : true,
                selectable: true, // le fait qu'au clic sur une case elle change de couleur pour montrer qu'elle est selectionnée.
                selectHelper: true,
                locale: 'fr',
                header : {
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                // liste des evenements
                events:'/',

                /**
                 * Creation : ce qui se deroule au clique d'une case
                */
                select:function(start, end, allDay) {
                    var title = prompt("Titre de l'évènement");
                    if(title){
                        var start = $.fullCalendar.formatDate(start,'Y-MM-DD HH:mm:ss');

                        var end = $.fullCalendar.formatDate(end,'Y-MM-DD HH:mm:ss');

                        $.ajax({
                            type :"POST",
                            url:"action",
                            data:{
                                title: title,
                                start: start,
                                end: end,
                                type:'add'
                            },
                            success: function(data){
                                calendar.fullCalendar('refetchEvents');
                                alert("Evenement Créé avec Success!");
                            }
                        })
                    }
                },

                /**
                 * Resizing
                */
                eventResize:function(event, delta, revertFunc) {
                    alert(event.title + " end is now " + event.end.format());
                    if (!confirm("is this okay?")) {
                    revertFunc();
                    }
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url:"/calendar",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            type:'update'
                        },
                        success: function(response){
                            calendar.fullCalendar('refetchEvents');
                            alert("Evenement Modifié avec Success!");
                        }
                    })
                },
                eventDrop: function(event, delta, revertFunc) {
                    alert(event.title + " was dropped on " + event.start.format());

                    // if (!confirm("Are you sure about this change?")) {
                    // revertFunc();

                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url:"/calendar",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            type:'update'
                        },
                        success: function(response){
                            calendar.fullCalendar('refetchEvents');
                            alert("Evenement Modifié avec Success!");
                        },
                    });
                },

                eventClick: function(event) {
                    // if(confirm("Suprimer ?")){

                    var id = event.id;
                    $.ajax({
                        url:"/calendar/delete",
                        type:"POST",
                        data:{
                            id: id,
                            type:"delete"
                        },
                        success: function(response){
                            calendar.fullCalendar('refetchEvents');
                            alert("Evenement supprimé avec Success!");
                        },
                    });

                    // }

                    // if (!confirm("Are you sure about this change?")) {
                    // revertFunc();
                },

            });
        });
    </script>
</body>
</html>
