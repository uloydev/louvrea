<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @section('title')
            Website Ecommerce
        @show
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link href="{{ asset("vendor/animate.css/animate.min.css") }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900"
        rel="stylesheet">
    <link href="{{ asset("vendor/icofont/icofont.min.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-XX4+o1gjy2A/TTgEF1kLQzft5TNjK8x8qO9yM1h3+5m1sVxu3Aop7sTj3hF9J+Pz" crossorigin="anonymous">
    <link href="{{ asset("vendor/owl.carousel/assets/owl.carousel.min.css") }}" rel="stylesheet">
    @stack('css')

</head>

<body>
    @include('fragments.navbar')

    @yield('content')

    <section id="About Us">
        @include('fragments.footer')
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script>
        // Scroll to target section
        $('[data-toggle="scroll"]').on('click', function(e) {
            e.preventDefault();
            var target = $(this).attr('data-target');
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 800);
        });
    </script>
    @stack('script')

    <script>
window.addEventListener('mouseover', initLandbot, { once: true });
window.addEventListener('touchstart', initLandbot, { once: true });
var myLandbot;
function initLandbot() {
  if (!myLandbot) {
    var s = document.createElement('script');s.type = 'text/javascript';s.async = true;
    s.addEventListener('load', function() {
      myLandbot = new Landbot.Popup({
        configUrl: 'https://storage.googleapis.com/landbot.online/v3/H-1666353-NBKNB078UTLHKQXB/index.json',
      });
    });
    s.src = 'https://cdn.landbot.io/landbot-3/landbot-3.0.0.js';
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
  }
}
</script>
</body>

</html>
