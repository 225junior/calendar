<!doctype html>
<html lang="fr">
<head>
    <meta name="cref-token" content="{{csrf_token()}}" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href='{{asset("lib/main.css")}}' rel='stylesheet' />
    <script src='{{asset("lib/main.js")}}'></script>
    <script src='{{asset("lib/locales-all.min.js")}}'></script>
</head>
<body>
    <div id="calendar"></div>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });


    </script>
</body>
</html>
