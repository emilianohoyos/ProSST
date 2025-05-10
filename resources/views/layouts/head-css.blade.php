@yield('css')
<!-- Bootstrap Css -->
<link href="{{ URL::asset('build/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/datatable/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/select2/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet"
    type="text/css" />



<!-- App Css-->
<link href="{{ URL::asset('build/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

<style>
    /* Estilos personalizados para el chatbot flotante */
    .chatbot-widget {
        position: fixed;
        bottom: 20px;
        right: 20px;
        max-width: 535px;
        border-radius: 8px;
        overflow: hidden;
        display: none;
        flex-direction: column;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    .chatbot-header {
        background-color: #007bff;
        color: white;
        padding: 10px;
        font-weight: bold;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .chatbot-header button {
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }

    .chatbot-messages {
        flex-grow: 1;
        overflow-y: auto;
        padding: 10px;
        background-color: #f8f9fa;
        height: 300px;
    }

    .chatbot-input {
        border-top: 1px solid #ccc;
        padding: 10px;
        display: flex;
        gap: 10px;
        background-color: white;
    }

    .message {
        margin-bottom: 10px;
        padding: 8px;
        border-radius: 10px;
    }

    .user-message {
        background-color: #d1e7dd;
        text-align: right;
        align-self: flex-end;
    }

    .bot-message {
        background-color: #e2e3e5;
    }

    /* Botón flotante para abrir el chatbot */
    .chatbot-toggle-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        cursor: pointer;
        z-index: 1000;
    }
</style>
