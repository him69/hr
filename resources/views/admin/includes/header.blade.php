<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Language" content="en">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>HR Admin Pannel</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
  <meta name="description" content="This is an example dashboard created using build-in elements and components.">
  <meta name="msapplication-tap-highlight" content="no">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <link href="{{env('APP_URL')}}public/main.css?v=4.6.7" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}resources/css/app.css?v=2.3.0" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <style>
    /* body {font-family: Arial, Helvetica, sans-serif;} */
    /* form {border: 3px solid #f1f1f1;} */
    .blinking {
      -webkit-animation: 1s blink ease infinite;
      -moz-animation: 1s blink ease infinite;
      -ms-animation: 1s blink ease infinite;
      -o-animation: 1s blink ease infinite;
      animation: 1s blink ease infinite;
    }

    @keyframes "blink" {

      from,
      to {
        opacity: 0;
      }

      50% {
        opacity: 1;
      }
    }

    @-moz-keyframes blink {

      from,
      to {
        opacity: 0;
      }

      50% {
        opacity: 1;
      }
    }

    @-webkit-keyframes "blink" {

      from,
      to {
        opacity: 0;
      }

      50% {
        opacity: 1;
      }
    }

    @-ms-keyframes "blink" {

      from,
      to {
        opacity: 0;
      }

      50% {
        opacity: 1;
      }
    }

    @-o-keyframes "blink" {

      from,
      to {
        opacity: 0;
      }

      50% {
        opacity: 1;
      }
    }
  </style>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100;0,8..144,200;0,8..144,300;0,8..144,400;0,8..144,500;0,8..144,600;0,8..144,700;0,8..144,800;0,8..144,900;1,8..144,100;1,8..144,200;1,8..144,300;1,8..144,400;1,8..144,500;1,8..144,600;1,8..144,700;1,8..144,800;1,8..144,900&display=swap');

    body {
      /* font-family: 'Roboto Serif', serif !important */
    }
  </style>
</head>

<body>