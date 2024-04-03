<!DOCTYPE html>
<link href="{{ public_path('css/app.css') }}"  rel="stylesheet">
<link href="{{ public_path('css/bootstrap.css') }}"  rel="stylesheet">
 {{-- <link href="{{ public_path('css/responsive.css') }}"  rel="stylesheet"> --}}
{{-- <link href="{{ public_path('css/welcome.css') }}"  rel="stylesheet">  --}}

<style>
@font-face{
    font-family:chinise;
    src: url('{{ public_path('font/XiaolaiSC-Regular.ttf') }}');
} 
body {
    font-family:chinise;
    font-size: small;
} 



  @media (min-width: 991px) {
      .google-visualization-orgchart-node {
          border: 2px solid #FF0000 !important;
      }

      .wrapper {
          width: 100%;
          height: 100%;
          margin: 50px auto 0 auto;
          position: relative;
          overflow: auto;
      }

      .google-visualization-orgchart-linebottom {
          border-bottom: 5px solid #3388dd !important;
      }

      .google-visualization-orgchart-lineleft {
          border-left: 5px solid #3388dd;
          height: 50px;
      }

      .google-visualization-orgchart-lineright {
          border-right: 5px solid #3388dd;
          height: 50px;
      }
  }

  @media (max-width: 991px) {
      .google-visualization-orgchart-node {
          border: 2px solid #FF0000 !important;
      }

      .wrapper {
          width: 100%;
          height: 100%;
          margin: 50px auto 0 auto;
          position: relative;
          overflow: auto;
      }

      .google-visualization-orgchart-linebottom {
          border-bottom: 5px solid #3388dd !important;
      }

      .google-visualization-orgchart-lineleft {
          border-left: 5px solid #3388dd;
      }

      .google-visualization-orgchart-lineright {
          border-right: 5px solid #3388dd;
      }
  }

</style>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>

        </title>
        </head>
        <body>
         
                  @if($data)
                       {!! $data !!}
                   @endif
             
        </body>
</html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>