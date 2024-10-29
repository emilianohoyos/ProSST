<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Webadmin - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">

    <!-- include head css -->
    @include('layouts.head-css')
</head>

@yield('body')

<!-- Begin page -->
<div id="layout-wrapper">
    <!-- topbar -->
    @include('layouts.topbar')

    <!-- sidebar components -->
    @include('layouts.sidebar')
    @include('layouts.horizontal')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- footer -->
        @include('layouts.footer')

    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- customizer -->
{{-- @include('layouts.right-sidebar') --}}

<!-- vendor-scripts -->
@include('layouts.vendor-scripts')
<!-- Botón flotante para abrir el chatbot -->
<div class="chatbot-toggle-btn" onclick="toggleChatbot()">💬</div>

<!-- Contenedor del chatbot flotante -->
<div class="chatbot-widget bg-light shadow" id="chatbotWidget">
    <div class="chatbot-header">
        <span>Chatbot</span>
        <div>
            <button onclick="minimizeChatbot()">_</button>
            <button onclick="closeChatbot()">✖</button>
        </div>
    </div>
    <div class="chatbot-messages" id="chatMessages">
        <!-- Mensajes del chat aparecerán aquí -->
    </div>

    <div class="chatbot-input">
        <input type="text" id="userInput" class="form-control" placeholder="Escribe un mensaje...">
        <button class="btn btn-primary" onclick="sendMessage()">Enviar</button>
    </div>
</div>

</body>

</html>
