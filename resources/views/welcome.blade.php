<!doctype html>
<html lang="fr">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css"></link>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
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
                header : {
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events:'/calendar',
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
                }
            });
        })
    </script>
</body>
</html>
