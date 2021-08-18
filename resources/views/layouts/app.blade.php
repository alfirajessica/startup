@extends('head')
<link rel = "icon" href="/../images/icon-startupinow.png" type="image/png">
<style>
    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
    }
  </style>
<body>
    <div id="app">

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
