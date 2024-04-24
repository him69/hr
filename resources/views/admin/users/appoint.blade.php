<html lang="en" class="k-webkit k-webkit123">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Appointment Letter</title>
    <style type="text/css">
        p {
            line-height: 1.2;
            font-size: 11px;
            padding: 0.1rem !important;
            text-align: justify;
        }

        ol,
        ul {
            padding-left: 1rem !important;
        }

        th {
            line-height: 1.2;
            font-size: 11px;
            padding: 0.1rem !important;
        }

        td {
            line-height: 1.2;
            font-size: 11px;
            padding: 0.1rem !important;
        }

        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,700;1,400&display=swap');

        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif !important:
        }
    </style>
    <style type="text/css">
        #sidebar {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            padding: 0;
            margin: 0;
            overflow: auto
        }

        #page-container {
            position: absolute;
            top: 0;
            left: 0;
            margin: 0;
            padding: 0;
            border: 0
        }

        @media screen {
            #sidebar.opened+#page-container {
                left: 250px
            }

            #page-container {
                bottom: 0;
                right: 0;
                overflow: auto
            }

            .loading-indicator {
                display: none
            }

            .loading-indicator.active {
                display: block;
                position: absolute;
                width: 64px;
                height: 64px;
                top: 50%;
                left: 50%;
                margin-top: -32px;
                margin-left: -32px
            }

            .loading-indicator img {
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0
            }
        }

        @media print {
            @page {
                margin: 0
            }

            html {
                margin: 0
            }

            body {
                margin: 0;
                -webkit-print-color-adjust: exact
            }

            #sidebar {
                display: none
            }

            #page-container {
                width: auto;
                height: auto;
                overflow: visible;
                background-color: transparent
            }

            .d {
                display: none
            }
        }

        .pf {
            position: relative;
            background-color: white;
            overflow: hidden;
            margin: 0;
            border: 0
        }

        .pc {
            position: absolute;
            border: 0;
            padding: 0;
            margin: 0;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            display: block;
            transform-origin: 0 0;
            -ms-transform-origin: 0 0;
            -webkit-transform-origin: 0 0
        }

        .pc.opened {
            display: block
        }

        .bf {
            position: absolute;
            border: 0;
            margin: 0;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            -ms-user-select: none;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none
        }

        .bi {
            position: absolute;
            border: 0;
            margin: 0;
            -ms-user-select: none;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none
        }

        @media print {
            .pf {
                margin: 0;
                box-shadow: none;
                page-break-after: always;
                page-break-inside: avoid
            }

            @-moz-document url-prefix() {
                .pf {
                    overflow: visible;
                    border: 1px solid #fff
                }

                .pc {
                    overflow: visible
                }
            }
        }

        .c {
            position: absolute;
            border: 0;
            padding: 0;
            margin: 0;
            overflow: hidden;
            display: block
        }

        .t {
            position: absolute;
            white-space: pre;
            font-size: 1px;
            transform-origin: 0 100%;
            -ms-transform-origin: 0 100%;
            -webkit-transform-origin: 0 100%;
            unicode-bidi: bidi-override;
            -moz-font-feature-settings: "liga" 0
        }

        .t:after {
            content: ''
        }

        .t:before {
            content: '';
            display: inline-block
        }

        .t span {
            position: relative;
            unicode-bidi: bidi-override
        }

        ._ {
            display: inline-block;
            color: transparent;
            z-index: -1
        }

        ::selection {
            background: rgba(127, 255, 255, 0.4)
        }

        ::-moz-selection {
            background: rgba(127, 255, 255, 0.4)
        }

        .pi {
            display: none
        }

        .d {
            position: absolute;
            transform-origin: 0 100%;
            -ms-transform-origin: 0 100%;
            -webkit-transform-origin: 0 100%
        }

        .it {
            border: 0;
            background-color: rgba(255, 255, 255, 0.0)
        }

        .ir:hover {
            cursor: pointer
        }
    </style>
    <style type="text/css">
        @keyframes fadein {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        @-webkit-keyframes fadein {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        @keyframes swing {
            0 {
                transform: rotate(0)
            }

            10% {
                transform: rotate(0)
            }

            90% {
                transform: rotate(720deg)
            }

            100% {
                transform: rotate(720deg)
            }
        }

        @-webkit-keyframes swing {
            0 {
                -webkit-transform: rotate(0)
            }

            10% {
                -webkit-transform: rotate(0)
            }

            90% {
                -webkit-transform: rotate(720deg)
            }

            100% {
                -webkit-transform: rotate(720deg)
            }
        }

        @media screen {
            #sidebar {
                background-color: #2f3236;
                background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjNDAzYzNmIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDBMNCA0Wk00IDBMMCA0WiIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2U9IiMxZTI5MmQiPjwvcGF0aD4KPC9zdmc+")
            }

            #outline {
                font-family: Georgia, Times, "Times New Roman", serif;
                font-size: 13px;
                margin: 2em 1em
            }

            #outline ul {
                padding: 0
            }

            #outline li {
                list-style-type: none;
                margin: 1em 0
            }

            #outline li>ul {
                margin-left: 1em
            }

            #outline a,
            #outline a:visited,
            #outline a:hover,
            #outline a:active {
                line-height: 1.2;
                color: #e8e8e8;
                text-overflow: ellipsis;
                white-space: nowrap;
                text-decoration: none;
                display: block;
                overflow: hidden;
                outline: 0
            }

            #outline a:hover {
                color: #0cf
            }

            #page-container {
                background-color: #9e9e9e;
                background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjOWU5ZTllIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDVMNSAwWk02IDRMNCA2Wk0tMSAxTDEgLTFaIiBzdHJva2U9IiM4ODgiIHN0cm9rZS13aWR0aD0iMSI+PC9wYXRoPgo8L3N2Zz4=");
                -webkit-transition: left 500ms;
                transition: left 500ms
            }

            .pf {
                margin: 0px auto;
                box-shadow: 1px 1px 3px 1px #333;
                border-collapse: separate
            }

            .pc.opened {
                -webkit-animation: fadein 100ms;
                animation: fadein 100ms
            }

            .loading-indicator.active {
                -webkit-animation: swing 1.5s ease-in-out .01s infinite alternate none;
                animation: swing 1.5s ease-in-out .01s infinite alternate none
            }

            .checked {
                background: no-repeat url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3goQDSYgDiGofgAAAslJREFUOMvtlM9LFGEYx7/vvOPM6ywuuyPFihWFBUsdNnA6KLIh+QPx4KWExULdHQ/9A9EfUodYmATDYg/iRewQzklFWxcEBcGgEplDkDtI6sw4PzrIbrOuedBb9MALD7zv+3m+z4/3Bf7bZS2bzQIAcrmcMDExcTeXy10DAFVVAQDksgFUVZ1ljD3yfd+0LOuFpmnvVVW9GHhkZAQcxwkNDQ2FSCQyRMgJxnVdy7KstKZpn7nwha6urqqfTqfPBAJAuVymlNLXoigOhfd5nmeiKL5TVTV+lmIKwAOA7u5u6Lped2BsbOwjY6yf4zgQQkAIAcedaPR9H67r3uYBQFEUFItFtLe332lpaVkUBOHK3t5eRtf1DwAwODiIubk5DA8PM8bYW1EU+wEgCIJqsCAIQAiB7/u253k2BQDDMJBKpa4mEon5eDx+UxAESJL0uK2t7XosFlvSdf0QAEmlUnlRFJ9Waho2Qghc1/U9z3uWz+eX+Wr+lL6SZfleEAQIggA8z6OpqSknimIvYyybSCReMsZ6TislhCAIAti2Dc/zejVNWwCAavN8339j27YbTg0AGGM3WltbP4WhlRWq6Q/btrs1TVsYHx+vNgqKoqBUKn2NRqPFxsbGJzzP05puUlpt0ukyOI6z7zjOwNTU1OLo6CgmJyf/gA3DgKIoWF1d/cIY24/FYgOU0pp0z/Ityzo8Pj5OTk9PbwHA+vp6zWghDC+VSiuRSOQgGo32UErJ38CO42wdHR09LBQK3zKZDDY2NupmFmF4R0cHVlZWlmRZ/iVJUn9FeWWcCCE4ODjYtG27Z2Zm5juAOmgdGAB2d3cBADs7O8uSJN2SZfl+WKlpmpumaT6Yn58vn/fs6XmbhmHMNjc3tzDGFI7jYJrm5vb29sDa2trPC/9aiqJUy5pOp4f6+vqeJ5PJBAB0dnZe/t8NBajx/z37Df5OGX8d13xzAAAAAElFTkSuQmCC)
            }
        }
    </style>
    <style type="text/css">
        .m0 {
            transform: matrix(0.250000, 0.000000, 0.000000, 0.250000, 0, 0);
            -ms-transform: matrix(0.250000, 0.000000, 0.000000, 0.250000, 0, 0);
            -webkit-transform: matrix(0.250000, 0.000000, 0.000000, 0.250000, 0, 0);
        }

        .v0 {
            vertical-align: 0.000000px;
        }

        .ls2 {
            letter-spacing: -0.309200px;
        }

        .ls1 {
            letter-spacing: -0.196000px;
        }

        .ls0 {
            letter-spacing: 0.000000px;
        }

        .ls4 {
            letter-spacing: 0.026880px;
        }

        .ls3 {
            letter-spacing: 0.170800px;
        }

        .sc_ {
            text-shadow: none;
        }

        .sc0 {
            text-shadow: -0.015em 0 transparent, 0 0.015em transparent, 0.015em 0 transparent, 0 -0.015em transparent;
        }

        @media screen and (-webkit-min-device-pixel-ratio:0) {
            .sc_ {
                -webkit-text-stroke: 0px transparent;
            }

            .sc0 {
                -webkit-text-stroke: 0.015em transparent;
                text-shadow: none;
            }
        }

        .ws3 {
            word-spacing: -10.150960px;
        }

        .ws4 {
            word-spacing: -10.007040px;
        }

        .ws0 {
            word-spacing: -9.980160px;
        }

        .ws1 {
            word-spacing: -9.784160px;
        }

        .ws2 {
            word-spacing: -9.670960px;
        }

        .ws5 {
            word-spacing: 0.000000px;
        }

        ._0 {
            margin-left: -1.236480px;
        }

        .fc1 {
            color: rgb(63, 63, 63);
        }

        .fc0 {
            color: rgb(0, 0, 0);
        }

        .fs0 {
            font-size: 44.160000px;
        }

        .y0 {
            bottom: -0.500000px;
        }

        .y1 {
            bottom: 0.000000px;
        }

        .ye {
            bottom: 3.000000px;
        }

        .y9 {
            bottom: 3.720000px;
        }

        .y1c {
            bottom: 4.440000px;
        }

        .y7 {
            bottom: 24.000000px;
        }

        .yc {
            bottom: 34.470000px;
        }

        .y6 {
            bottom: 37.320000px;
        }

        .y5 {
            bottom: 50.760000px;
        }

        .y1e {
            bottom: 358.970000px;
        }

        .y1d {
            bottom: 374.330000px;
        }

        .y1b {
            bottom: 389.690000px;
        }

        .y1a {
            bottom: 405.070000px;
        }

        .y19 {
            bottom: 420.430000px;
        }

        .y18 {
            bottom: 435.790000px;
        }

        .y17 {
            bottom: 451.150000px;
        }

        .y16 {
            bottom: 466.510000px;
        }

        .y15 {
            bottom: 481.870000px;
        }

        .y14 {
            bottom: 497.110000px;
        }

        .y13 {
            bottom: 512.470000px;
        }

        .y12 {
            bottom: 527.830000px;
        }

        .y11 {
            bottom: 543.190000px;
        }

        .yb {
            bottom: 558.550000px;
        }

        .y10 {
            bottom: 573.910000px;
        }

        .yf {
            bottom: 589.300000px;
        }

        .yd {
            bottom: 604.660000px;
        }

        .ya {
            bottom: 620.020000px;
        }

        .y8 {
            bottom: 635.380000px;
        }

        .y4 {
            bottom: 650.740000px;
        }

        .y3 {
            bottom: 737.980000px;
        }

        .y2 {
            bottom: 750.220000px;
        }

        .h7 {
            height: 14.760000px;
        }

        .h8 {
            height: 14.880000px;
        }

        .ha {
            height: 14.904000px;
        }

        .h2 {
            height: 34.047187px;
        }

        .h6 {
            height: 43.922812px;
        }

        .h5 {
            height: 45.216562px;
        }

        .h3 {
            height: 45.906562px;
        }

        .h4 {
            height: 73.440000px;
        }

        .h9 {
            height: 76.344000px;
        }

        .h0 {
            height: 841.920000px;
        }

        .h1 {
            height: 842.500000px;
        }

        .wd {
            width: 45.120000px;
        }

        .wc {
            width: 45.144000px;
        }

        .we {
            width: 45.240000px;
        }

        .w4 {
            width: 89.784000px;
        }

        .w6 {
            width: 89.904000px;
        }

        .w7 {
            width: 90.120000px;
        }

        .wb {
            width: 135.020000px;
        }

        .w5 {
            width: 135.260000px;
        }

        .w8 {
            width: 135.290000px;
        }

        .w9 {
            width: 180.260000px;
        }

        .wa {
            width: 180.500000px;
        }

        .w3 {
            width: 541.560000px;
        }

        .w2 {
            width: 595.319991px;
        }

        .w0 {
            width: 595.320000px;
        }

        .w1 {
            width: 596.000000px;
        }

        .x0 {
            left: 0.000000px;
        }

        .x5 {
            left: 5.040000px;
        }

        .x1c {
            left: 7.440000px;
        }

        .x17 {
            left: 9.360000px;
        }

        .x14 {
            left: 11.280000px;
        }

        .x16 {
            left: 13.440000px;
        }

        .x11 {
            left: 17.520000px;
        }

        .x10 {
            left: 18.960000px;
        }

        .x18 {
            left: 21.000000px;
        }

        .x13 {
            left: 23.190000px;
        }

        .x3 {
            left: 24.600000px;
        }

        .x25 {
            left: 26.280000px;
        }

        .x12 {
            left: 30.000000px;
        }

        .x7 {
            left: 31.200000px;
        }

        .x19 {
            left: 32.310000px;
        }

        .x9 {
            left: 35.160000px;
        }

        .xe {
            left: 37.590000px;
        }

        .x20 {
            left: 41.190000px;
        }

        .xb {
            left: 43.680000px;
        }

        .xf {
            left: 45.840000px;
        }

        .x1d {
            left: 47.640000px;
        }

        .x22 {
            left: 49.590000px;
        }

        .x23 {
            left: 57.504000px;
        }

        .x24 {
            left: 58.940000px;
        }

        .x15 {
            left: 62.160000px;
        }

        .x1b {
            left: 64.920000px;
        }

        .x26 {
            left: 69.504000px;
        }

        .x2 {
            left: 72.023991px;
        }

        .x1 {
            left: 78.023991px;
        }

        .x1a {
            left: 87.620000px;
        }

        .x8 {
            left: 114.620000px;
        }

        .x1f {
            left: 159.860000px;
        }

        .x6 {
            left: 191.810000px;
        }

        .x27 {
            left: 205.010000px;
        }

        .xa {
            left: 250.370000px;
        }

        .x1e {
            left: 269.450000px;
        }

        .x4 {
            left: 270.650000px;
        }

        .x21 {
            left: 295.370000px;
        }

        .xc {
            left: 340.510000px;
        }

        .x28 {
            left: 385.630000px;
        }

        .xd {
            left: 430.870000px;
        }

        .x29 {
            left: 476.020000px;
        }

        .x2a {
            left: 521.260000px;
        }

        @media print {
            .v0 {
                vertical-align: 0.000000pt;
            }

            .ls2 {
                letter-spacing: -0.412267pt;
            }

            .ls1 {
                letter-spacing: -0.261333pt;
            }

            .ls0 {
                letter-spacing: 0.000000pt;
            }

            .ls4 {
                letter-spacing: 0.035840pt;
            }

            .ls3 {
                letter-spacing: 0.227733pt;
            }

            .ws3 {
                word-spacing: -13.534613pt;
            }

            .ws4 {
                word-spacing: -13.342720pt;
            }

            .ws0 {
                word-spacing: -13.306880pt;
            }

            .ws1 {
                word-spacing: -13.045547pt;
            }

            .ws2 {
                word-spacing: -12.894613pt;
            }

            .ws5 {
                word-spacing: 0.000000pt;
            }

            ._0 {
                margin-left: -1.648640pt;
            }

            .fs0 {
                font-size: 58.880000pt;
            }

            .y0 {
                bottom: -0.666667pt;
            }

            .y1 {
                bottom: 0.000000pt;
            }

            .ye {
                bottom: 4.000000pt;
            }

            .y9 {
                bottom: 4.960000pt;
            }

            .y1c {
                bottom: 5.920000pt;
            }

            .y7 {
                bottom: 32.000000pt;
            }

            .yc {
                bottom: 45.960000pt;
            }

            .y6 {
                bottom: 49.760000pt;
            }

            .y5 {
                bottom: 67.680000pt;
            }

            .y1e {
                bottom: 478.626667pt;
            }

            .y1d {
                bottom: 499.106667pt;
            }

            .y1b {
                bottom: 519.586667pt;
            }

            .y1a {
                bottom: 540.093333pt;
            }

            .y19 {
                bottom: 560.573333pt;
            }

            .y18 {
                bottom: 581.053333pt;
            }

            .y17 {
                bottom: 601.533333pt;
            }

            .y16 {
                bottom: 622.013333pt;
            }

            .y15 {
                bottom: 642.493333pt;
            }

            .y14 {
                bottom: 662.813333pt;
            }

            .y13 {
                bottom: 683.293333pt;
            }

            .y12 {
                bottom: 703.773333pt;
            }

            .y11 {
                bottom: 724.253333pt;
            }

            .yb {
                bottom: 744.733333pt;
            }

            .y10 {
                bottom: 765.213333pt;
            }

            .yf {
                bottom: 785.733333pt;
            }

            .yd {
                bottom: 806.213333pt;
            }

            .ya {
                bottom: 826.693333pt;
            }

            .y8 {
                bottom: 847.173333pt;
            }

            .y4 {
                bottom: 867.653333pt;
            }

            .y3 {
                bottom: 983.973333pt;
            }

            .y2 {
                bottom: 1000.293333pt;
            }

            .h7 {
                height: 19.680000pt;
            }

            .h8 {
                height: 19.840000pt;
            }

            .ha {
                height: 19.872000pt;
            }

            .h2 {
                height: 45.396250pt;
            }

            .h6 {
                height: 58.563750pt;
            }

            .h5 {
                height: 60.288750pt;
            }

            .h3 {
                height: 61.208750pt;
            }

            .h4 {
                height: 97.920000pt;
            }

            .h9 {
                height: 101.792000pt;
            }

            .h0 {
                height: 1122.560000pt;
            }

            .h1 {
                height: 1123.333333pt;
            }

            .wd {
                width: 60.160000pt;
            }

            .wc {
                width: 60.192000pt;
            }

            .we {
                width: 60.320000pt;
            }

            .w4 {
                width: 119.712000pt;
            }

            .w6 {
                width: 119.872000pt;
            }

            .w7 {
                width: 120.160000pt;
            }

            .wb {
                width: 180.026667pt;
            }

            .w5 {
                width: 180.346667pt;
            }

            .w8 {
                width: 180.386667pt;
            }

            .w9 {
                width: 240.346667pt;
            }

            .wa {
                width: 240.666667pt;
            }

            .w3 {
                width: 722.080000pt;
            }

            .w2 {
                width: 793.759988pt;
            }

            .w0 {
                width: 793.760000pt;
            }

            .w1 {
                width: 794.666667pt;
            }

            .x0 {
                left: 0.000000pt;
            }

            .x5 {
                left: 6.720000pt;
            }

            .x1c {
                left: 9.920000pt;
            }

            .x17 {
                left: 12.480000pt;
            }

            .x14 {
                left: 15.040000pt;
            }

            .x16 {
                left: 17.920000pt;
            }

            .x11 {
                left: 23.360000pt;
            }

            .x10 {
                left: 25.280000pt;
            }

            .x18 {
                left: 28.000000pt;
            }

            .x13 {
                left: 30.920000pt;
            }

            .x3 {
                left: 32.800000pt;
            }

            .x25 {
                left: 35.040000pt;
            }

            .x12 {
                left: 40.000000pt;
            }

            .x7 {
                left: 41.600000pt;
            }

            .x19 {
                left: 43.080000pt;
            }

            .x9 {
                left: 46.880000pt;
            }

            .xe {
                left: 50.120000pt;
            }

            .x20 {
                left: 54.920000pt;
            }

            .xb {
                left: 58.240000pt;
            }

            .xf {
                left: 61.120000pt;
            }

            .x1d {
                left: 63.520000pt;
            }

            .x22 {
                left: 66.120000pt;
            }

            .x23 {
                left: 76.672000pt;
            }

            .x24 {
                left: 78.586667pt;
            }

            .x15 {
                left: 82.880000pt;
            }

            .x1b {
                left: 86.560000pt;
            }

            .x26 {
                left: 92.672000pt;
            }

            .x2 {
                left: 96.031988pt;
            }

            .x1 {
                left: 104.031988pt;
            }

            .x1a {
                left: 116.826667pt;
            }

            .x8 {
                left: 152.826667pt;
            }

            .x1f {
                left: 213.146667pt;
            }

            .x6 {
                left: 255.746667pt;
            }

            .x27 {
                left: 273.346667pt;
            }

            .xa {
                left: 333.826667pt;
            }

            .x1e {
                left: 359.266667pt;
            }

            .x4 {
                left: 360.866667pt;
            }

            .x21 {
                left: 393.826667pt;
            }

            .xc {
                left: 454.013333pt;
            }

            .x28 {
                left: 514.173333pt;
            }

            .xd {
                left: 574.493333pt;
            }

            .x29 {
                left: 634.693333pt;
            }

            .x2a {
                left: 695.013333pt;
            }
        }
    </style>
    <style>
        td {

            font-size: 11px;
            margin-bottom: 0;
        }

        .small {
            font-size: 10px;
        }


        .sheet1 {
            position: absolute;
            padding: 120px 50px;
            top: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .sign {
            font-size: 13px;
        }

        td,
        th {
            /* border: 1px solid; */
            text-align: center;
            padding: 8px 0px !important;
        }


        tr:nth-child(odd) {
            /* background-color: #d9e2f3; */
        }

        @font-face {
            font-family: 'Dancing Script';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(/hr/public/DancingScript-Bold.ttf) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        #sign {
            font-family: 'Dancing Script', cursive !important;
            font-size: 25px;
        }



        /* li::before {
            content: '•';
            position: absolute;
            left: -21px;
            top: -5px; 

        } */
        .bullet {
            background: black;
    height: 5px;
    position: absolute;
    left: -21px;
    top: 5px;
    width: 5px;
    border-radius: 50%;
}
        li {
            position: relative;
            list-style:none ;
        }

        li.none::before {
            content: '' !important;
        }
    </style>
</head>

<body>
    <div id="page-container">
        <div id="pf1" class="pf w0 h0" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/pd.webp" alt="" style="width:100%;">
            <div class="position-absolute top-0 sheet1">

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="my-0">Mr {{$ext['fname']}}</p>
                        <p class="my-0 fw-bold">{{$ext['address']}} <br> {{$ext['city']}}, {{$ext['state']}}, {{$ext['pin']}}</p>
                    </div>
                    <div>
                        <p class="fw-bold my-0"> <span>Date</span>:{{$ext['date']}}</p>
                    </div>
                </div>
                <p class="fs-6 my-3  fw-normal text-center">Appointment Letter</p>
                <p class="fw-bold">Dear {{$ext['fname']}}, </p>
                <p>We are pleased to offer you the position of {{$ext['position']}}, {{$ext['department']}}, It with ‘Pantheon
                    Digital
                    Private Limited’. Your employment
                    shall
                    commence with effect from your actual date of joining which is {{$ext['jdate']}}, for{{$ext['place']}}.</p>

                <p>You shall be on probation for a period of Three (3) months (the 'Probation Period') from your
                    actual date of
                    joining, which may be extended by the Company at its discretion. During the Probation Period, your
                    Compensation and Other Entitlements, if any, shall be in accordance with the Company's Policy. At
                    the end of
                    the Probation Period, the Company may confirm your services, subject to your performance meeting the
                    requisite standard, Key Responsibility Areas (the ‘KRA(s)’) and Key Performance Indicators (the
                    ‘KPI(s)’),
                    by issuing a confirmation letter. Until such a Confirmation Letter is
                    issued,
                    you are deemed to be on probation.</p>
                <p>The terms and conditions of your employment with the Company shall be as follows:</p>
                <p class="fw-bold">Compensation and Benefits</p>
                <ul>
                    <li><span class="bullet"></span>
                        <p><span class="fw-bold">Salary</span>: Your consolidated remuneration is listed in Annexure I.</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p><span class="fw-bold">Increments and Promotions </span>:
                            Your next revision shall be in accordance with the Annual Performance Review cycle and
                            at the
                            sole
                            discretion of the Management.</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p><span class="fw-bold">Leave </span>:
                            You will be eligible to the leaves as per the Leave Management Policy of the Company
                            upon
                            confirmation of your service.</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p><span class="fw-bold">Unauthorized Absence</span>:
                            Your unauthorized absence (or overstay after sanctioned leave) for a continuous period
                            of three
                            working days shall be deemed to be voluntary abandonment of service at the option of the
                            Management
                            with no full and final settlement including salary</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p><span class="fw-bold">Travel Expenses</span>:
                            You may be required to travel on Company business as and when required. In such cases,
                            you will
                            be
                            entitled to such travel expenses/allowances as per Company policies that are in force
                            from time
                            to
                            time.</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="page-break pf w0 h0" style="position: relative; border: 1px solid;">

            <img src="{{env('APP_URL')}}public/pd.webp" alt="" style="width:100%;">
            <div class="position-absolute top-0 sheet1">
                <ul>


                    <li><span class="bullet"></span>
                        <p><span class="fw-bold">Other Compensation</span> : The Company may decide to award employees for either
                            their
                            performance or the Company’s overall performance, as judged by the management from time
                            to time.
                            Decisions of the management on such an award shall be at its sole discretion and
                            non-negotiable.
                            Further, you shall remain ineligible for any such award until you are on probation.</p>
                    </li>
                </ul>

                <p class="fw-bold"><span>Miscellaneous</span></p>
                <ul>
                    <li><span class="bullet"></span>
                        <p><span class="fw-bold">Working Hours</span> : You will be required to work 8 hours a day excluding one
                            hour (1:00 hrs) break for lunch. The Company practices a 48 hours work week. Subject to the
                            applicable law, work timings, schedules and shifts may vary from time to time based on
                            your job
                            and depending upon exigencies of business, as specified by the Company from time to
                            time. You
                            may be required to work additional hours as appropriate to fulfill the responsibilities
                            of your
                            role.</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p><span class="fw-bold">Taxation</span> : Any amount payable by the Company to you towards Compensation,
                            Other
                            Entitlements and, or, any other payment shall be subject to deduction of withholding
                            taxes and,
                            or, any other taxes under applicable law. All requirements under Indian tax laws,
                            including tax
                            compliance and filing of tax returns, assessment etc. of your personal income, shall be
                            fulfilled by you.</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p><span class="fw-bold">No Other Employment or Vocation</span> : During your employment with the Company
                            and till
                            the Company issues a relieving certificate to you upon termination, you shall not take
                            up or
                            continue any other employment or vocation, paid or unpaid.</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p>
                            <span class="fw-bold">Disclosure and Verification</span> : The position in which you are appointed is
                            one of
                            utmost confidence, trust and requires a high degree of integrity. Your appointment,
                            therefore,
                            is subject to verification and continuation of such confidence. In addition, it is
                            expected that
                            before accepting this offer, you shall voluntarily disclose to the Company any relevant
                            information in full.
                        </p>
                    </li>
                    <li><span class="bullet"></span>
                        <p><span class="fw-bold">Confidential Information</span> :
                            For the purposes of this Agreement, 'Confidential Information' in relation to the
                            includes but
                            is not restricted to the following:</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p>Trade Secrets; or</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p>Lists or details of the Company’s suppliers, vendor, affiliated corporates, placement
                            partners,
                            government contacts; or</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p>Marketing Plan, Revenue Forecasts, Lists of Assets, including land banks, machinery
                            etc.; or</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="page-break pf w0 h0" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/pd.webp" alt="" style="width:100%;">
            <div class="position-absolute top-0 sheet1">
                <ul>

                    <li><span class="bullet"></span>
                        <p>Any proposals relating to the future of Company or any of its business or any part
                            thereof.; or</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p>Details of its employees and officers and of the remuneration and other benefits paid to
                            them;
                            or</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p>Information relating to business matters, corporate plans, management systems,
                            investments,
                            finances, accounts, marketing or sales of any past, present or future products or
                            service,
                            processes, inventions, designs, knowhow, discoveries, technical/financial specifications
                            and
                            other technical or financial information relating to the creation, production or supply
                            of any
                            past, present or future products or service of the Company, any information given to the
                            Company
                            in confidence by clients/customers, suppliers or other persons and any other information
                            (whether or not recorded in documentary form, or a computer file) which is confidential
                            or
                            commercially sensitive and is not in the public domain; or</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p>
                            Any other information which is notified to you as confidential. <br>
                            You shall not, either during your employment or at any time thereafter, except as
                            required by
                            law, use, divulge or disclose to any person any Confidential Information, which may have
                            come to
                            your knowledge at any time during the course of your employment with the Company. This
                            clause
                            will continue to apply to information which you may believe has entered the public
                            domain other
                            than (directly or indirectly) through your act, omission, negligence or fault.</p>
                    </li>
                    <p class="fw-bold"><span>Intellectual Property</span></p>

                    <li><span class="bullet"></span>
                        <p class="">You acknowledge that the Company is the absolute, unrestricted and exclusive owner of
                            the
                            Confidential Information or other proprietary technical, financial, marketing,
                            manufacturing,
                            construction, distribution or other business related information or trade secrets of the
                            Company, including without limitation, concepts, techniques, processes, methods,
                            systems,
                            designs, clients, cost data, computer programs, formulae, machinery, equipment and other
                            information used by you in course of your employment with the Company. You shall not in
                            any
                            manner whatsoever, represent and/or claim that you have any interest by way of
                            ownership,
                            assignment, rights or otherwise in the same.</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p>You acknowledge that the Company shall own all rights, title and interest in any work
                            done by
                            you in course of your employment with the Company. You agree to irrevocably and
                            unconditionally
                            assign to the Company all your rights, title and interest in such works for adequate
                            consideration, receipt whereof you hereby acknowledge. You agree to execute such other
                            documents, as may be required by the Company, for recording the Company as the owner of
                            such
                            works at the Company's cost and expense.</p>

                    </li>
                    <li><span class="bullet"></span>
                        <p>All intellectual property shall always be considered as ‘Confidential’ as per above
                            clause.</p>
                    </li>
                </ul>

            </div>
        </div>
        <div class="page-break pf w0 h0" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/pd.webp" alt="" style="width:100%;">
            <div class="position-absolute top-0 sheet1">

                <p class="fw-bold"><span>Termination</span></p>
                <ul>
                    <li><span class="bullet"></span>
                        <p class="fw-bold">Without Cause</p>
                        <ul>
                            <li><span class="bullet"></span>
                                <p>During the Probation Period Company may terminate this Agreement without
                                    assigning any
                                    reasons upon seven (7) days prior notice in writing or payment by you to the
                                    Company of
                                    the salary in lieu thereof. In such an event and in addition to the seven (7)
                                    days
                                    written notice or salary in lieu thereof, you shall also be liable to reimburse
                                    to the
                                    Company any joining bonus, rent, training costs etc. paid to/for you by the
                                    Company.</p>
                            </li>
                            <li><span class="bullet"></span>
                                <p>Upon your confirmation as an employee, Company may terminate this Agreement
                                    without
                                    assigning any reasons upon thirty (30) days prior notice in writing by Company
                                    to you of
                                    the salary in lieu thereof. In such an event and in addition to the thirty (30)
                                    days
                                    written notice or salary in lieu thereof, you shall also be liable to reimburse
                                    to the
                                    Company any joining bonus, rent, Training costs etc. paid to/for you by the
                                    Company.</p>
                            </li>
                            <li><span class="bullet"></span>
                                <p> In case of termination of employment, you may be required to go on a paid/unpaid
                                    leave
                                    until the end of your notice period at the Company's discretion, which may be
                                    adjusted
                                    against your leave entitlement, if any, that has accrued and not been taken.</p>
                            </li>
                            <li><span class="bullet"></span>
                                <p>You shall not be entitled to any leave while serving your notice period under
                                    this
                                    Agreement.</p>
                            </li>
                            <li><span class="bullet"></span>
                                <p> The organisation can do background verification anytime during the working tenure, if, during a background check, the organisation discovers any unethical behaviour or a significant discrepancy in the documents submitted by the candidate, it may have grounds to terminate the employment contract.</p>
                            </li>
                        </ul>
                    </li>
                    <li><span class="bullet"></span>
                        <p class="fw-bold"><span>Breach or Misconduct</span></p>
                        <p>Notwithstanding anything herein, the Company shall be entitled
                            to
                            terminate this Agreement, without notice and with immediate effect, in the event you
                            are:</p>
                        <ul>
                            <li><span class="bullet"></span>
                                <p>found to have engaged in any act of misconduct or negligence in the discharge of
                                    your
                                    duties or in the conduct of the Company's business; or</p>
                            </li>
                            <li><span class="bullet"></span>
                                <p>During probation, the Company may terminate this Agreement without assigning any
                                    reasons
                                    upon seven (7) days prior notice in writing or payment by you to the Company of
                                    the
                                    salary in lieu thereof, at the discretion of the Company.</p>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="page-break pf w0 h0" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/pd.webp" alt="" style="width:100%;">
            <div class="position-absolute top-0 sheet1">
                <ul>

                    <ul>

                        <li><span class="bullet"></span>
                            <p>found to have engaged in any other act or omission, inconsistent with your
                                duties,
                                KRA(s) and KPI(s); or found to have engaged in corrupt practices; or found to
                                have
                                misbehaved with someone or represent the Company in poor light to either vendors
                                /
                                affiliates / people / officials; or found to have engaged in any breach of this
                                Agreement, or the Company Policy or lawful orders given to you by the Company;
                                or
                                convicted or charged of any criminal offense; or failed to disclose any relevant
                                information pertaining to your background; or found to have engaged in
                                unauthorized
                                absence from work.
                                The Company may decide to forfeit any dues towards you, including salary, v
                                entitled
                                payments, bonus, other benefits like telephone &amp; rent payments etc. if you are
                                terminated under the abovementioned clause. The Company may also claim damages
                                from you
                                that you shall pay to the Company depending upon the nature of your act.</p>
                        </li>
                        <li><span class="bullet"></span>
                            <p>Post confirmation, the Company may terminate this Agreement without assigning
                                any
                                reasons upon thirty (30) days prior notice in writing or payment by you to the
                                Company
                                of the salary in lieu thereof, at the discretion of the Company.</p>
                        </li>
                        <li><span class="bullet"></span>
                            <p>
                                Employees are responsible for properly handling the employer's property
                                entrusted to
                                them. Employees can be held liable to pay for any damage caused to the Company
                                property.</p>
                        </li>
                        <li><span class="bullet"></span>
                            <p>You shall promptly, whenever requested by the Company or upon receipt of notice
                                of
                                termination or termination of employment, deliver to the Company all Property
                                and you
                                shall not retain any copies thereof. Title and copyright in the Property shall
                                vest in
                                the Company. Failure to do so may invite civil / criminal proceedings against
                                you by the
                                Company.</p>
                        </li>
                        <li><span class="bullet"></span>
                            <p>During employment, as also after leaving the company, you undertake not to
                                solicit, in
                                any way directly or indirectly in the behavior inducing, any affiliates or
                                employees of
                                the Company to discontinue or adversely change their relationship/employment
                                with the
                                Company.</p>
                        </li>
                    </ul>
                    <li><span class="bullet"></span>
                        <p class="fw-bold"><span>Governing Law</span></p>
                        <p>This Agreement shall be governed and construed in
                            accordance
                            with the
                            laws of India. The invalidity or unenforceability of any part of this Agreement shall
                            not affect
                            the binding effect of the rest of the Agreement. Any dispute arising out of this
                            agreement shall
                            be subject to jurisdiction of courts at Delhi alone.</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p class="fw-bold"><span>Conduct</span></p>
                        <p>Your appointment requires from you supervisory responsibilities and representation externally
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="page-break pf w0 h0" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/pd.webp" alt="" style="width:100%;">
            <div class="position-absolute top-0 sheet1">
                <ul>
                    <ul>

                    </ul>
                    <li class="none" style="list-style-type: none;">
                        <p>during the
                            course of your employment. You should be aware of these responsibilities and will conduct
                            yourself
                            accordingly including with professionalism.Your appointment shall be concluded and effective on your delivering a signed copy of this</p>
                    </li>
                    <li><span class="bullet"></span>

                        <p>Your appointment requires from you supervisory responsibilities and representation externally
                            during the
                            course of your employment. You should be aware of these responsibilities and will conduct
                            yourself
                            accordingly including with professionalism.Your appointment shall be concluded and effective on your delivering a signed copy of this
                            letter to
                            us,
                            provided that your Compensation and Other Entitlements shall not begin to accrue until you commence
                            work for
                            the Company.For the purpose of preventing the unauthorized disclosure of Confidential Information, you agree
                            to
                            enter
                            into a confidential relationship with the Company. Please find enclosed the copy of the Non
                            Disclosure
                            Agreement. You are requested to sign the same and return it to the HR at the time of joining.
                            If the terms and conditions of this offer letter are acceptable to you, please signify your
                            acceptance by
                            signing and returning a copy of this letter to the Company within 3 days from the date on the top of
                            this
                            letter, failing which, this offer stands automatically withdrawn by the Company without any further
                            notice
                            to you.
                            We are pleased to welcome you to Pantheon Digital Private Limited. We look forward to a mutually
                            benefitting
                            association.</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p class="fw-bold"><span>Leave</span></p>
                        <ul>
                            <li><span class="bullet"></span>
                                <p>If upon termination you have taken more leaves than your entitlement, you will be
                                    required to
                                    reimburse the Company in respect of the excess days taken and the Company is authorized
                                    to make
                                    deductions in respect of the same from your final salary payment. In the event such
                                    deductions
                                    exceed the final salary payment to you, you shall pay such outstanding amount to the
                                    Company.</p>
                            </li>
                        </ul>
                    </li>
                    <li><span class="bullet"></span>
                        <p class="fw-bold"><span>Company Property</span></p>
                        <ul>
                            <li><span class="bullet"></span>
                                <p>For the purposes of this Paragraph, Property means keys, vehicles, any mobile
                                    phone,
                                    computer equipment, any other electronic equipment, registers, pens, stamps, any
                                    material issued in your name by the store, all lists of clients or customers,
                                    correspondence and all other documents, files, papers and records (including,
                                    without
                                    limitation, any records stored or maintained in any form including by electronic
                                    means,
                                    together with any codes or passwords or implements necessary to give full access
                                    to such
                                    records), system designs, software designs, software programs (in whatever
                                    media),
                                    presentations, proposals, specifications, intellectual property or Confidential
                                    Information which may have been prepared by you or have come into or passed from
                                    your
                                    possession, custody or control in the course of your employment.</p>
                            </li>

                        </ul>
                    </li>
                </ul>

            </div>
        </div>
        <div class="page-break pf w0 h0" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/pd.webp" alt="" style="width:100%;">
            <div class="position-absolute top-0 sheet1">
                <ul>


                </ul>
                <p class="text-center fw-bold"><span>ACCEPTED</span></p>
                <p class="text-center">I have read, understood and agree to the terms and conditions as set out in this Appointment letter.</p>
                <p class="my-4"> Employee Signature:</p>
                <p class="my-4">Employee Name:</p>

            </div>
        </div>
        <div class="page-break pf w0 h0" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/pd.webp" alt="" style="width:100%;">
            <div class="position-absolute top-0 sheet1">

                <p class="text-center my-3 fw-bold"><span>Employee Non-Disclosure Agreement</span></p>

                <p>This Agreement (the "Agreement") is executed between M/s Pantheon Digital Private Limited (hereafter
                    referred to as "Company") {{$ext['fname']}} {{$ext['lname']}}, (Here after referred to as "Employee") on {{$ext['jdate']}}. In consideration of the employee’s continued employment with the company, the parties agree on
                    the following points: -</p>
                <ul>
                    <li><span class="bullet"></span>
                        <p class="fw-bold"><span>Intellectual Property</span></p>
                        <p> Any resources obtained by you from the Company, or
                            any work created by the
                            you during your tenure at the Company using any of the Company’s resources in any quantum, or any
                            work that he / she might have contributed to or recorded or reviewed or heard about, or any reward /
                            award / affiliation / position obtained on account of the ongoing relationship with the Company, are
                            solely and undeniably the intellectual property of the Company in perpetuity. You will have no right
                            to use it, reproduce it, recite it or repeat it outside of the Company or after termination of the
                            relationship / employment with the Company. Any use must be authorized only by the Company and any
                            violation of this will amount to penalties, not less than the quantifiable past &amp; projected value of
                            loss incurred by the Company on account of the action or five years of cost to the company of your
                            employment, whichever is higher.</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p class="fw-bold"><span>Non-Disclosure Agreement</span></p>
                        <p>You agree that during your employment or after
                            the
                            termination of the employment till perpetuity, you will have no right to disclose any information
                            regarding any Intellectual Property of the Company, any strategies of the Company, any tie-ups /
                            affiliations of the Company, contact information of key people at Company or its partners, its
                            pedagogy, its technology or any information concerning company's business, including cost
                            information, profits, sales information, accounting and unpublished financial information, business
                            plans, markets and marketing methods, customer lists and customer information, purchasing
                            techniques, supplier lists and supplier information or advertising strategies, to anyone not
                            specifically authorized by Company to be informed of the same. Any disclosure must be authorized and
                            any violation of this will amount to penalties, not less than the quantifiable past &amp; projected
                            value of loss incurred by the Company on account of the action or five years of cost to the company
                            of the employment, whichever is higher.</p>
                    </li>
                    <li><span class="bullet"></span>
                        <p class="fw-bold"><span>Non-Compete Agreement</span></p>
                        <p>You agree and fully understand that you will be
                            working in
                            an environment where you will have access to lots of proprietary &amp; confidential information &amp;
                            data as well as some intellectual property of the Company. You, out of your own volition, is</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="page-break pf w0 h0" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/pd.webp" alt="" style="width:100%;">
            <div class="position-absolute top-0 sheet1">

                <ul>
                    <li class="none">
                        <p>
                            agreeing to work with the Company while giving an undertaking that you will not, under any
                            circumstances, join &amp; / or collaborate with &amp; / or partner with &amp; / or contribute to &amp; / or be
                            affiliated with in any capacity any organization that competes with the Company, or compete
                            directly him/herself in any of its business verticals for at least 12 months from the date of
                            termination of employment at Pantheon Digital Private Limited. Any such act must be authorized
                            and any violation of this will amount to penalties, not less than the quantifiable past and
                            projected value of loss incurred by the Company on account of the action or five years of cost
                            to company of the employee, whichever is higher</p>
                    </li>
                </ul>
                <p class="text-center fw-bold"><span>ACCEPTED</span></p>
                <p class="text-center">I have read, understood and agreed to the terms and conditions as set out in this Agreement.</p>
                <p class="my-4"> Employee Signature:</p>
                <p class="my-4">Employee Name:</p>
            </div>
        </div>
        <div class="page-break pf w0 h0" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/pd.webp" alt="" style="width:100%;">
            <div class="position-absolute top-0 sheet1" style="width:100%;">
                <p class="text-center fw-bold"><span>ANNEXURE I</span></p>
                <p class="text-center">Your consolidated remuneration will be {{$ext['salary']}} which is inclusive of {{$sal}} per annum of fixed Company's Pay tenure .The fixed remuneration amount can be bifurcated as under:</p>


                <p class="fw-bold text-center m-0">SALARY STRUCTURE</p>


                <div class="col-12">
                    <div class="col-12 py-1">
                        <div class="col-12 py-1 my-3" style="border-bottom: 1px solid black; border-top:1px solid black;">

                            <div class="mb-0 d-flex" style="font-size:12px;">
                                <p class="fw-bold my-0" style="width:65px;">Name</p>
                                <p class="my-0">: {{ucwords(strtolower($ext['fname']))}} {{ucwords(strtolower($ext['lname']))}}</p>
                            </div>
                            <div class="mb-0 d-flex">
                                <p class="fw-bold my-0">Designation </p>
                                <p class="my-0">: {{ucwords(strtolower($ext['position']))}}</p>
                            </div>

                        </div>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="fw-bold" style="border-top:1px solid black; border-bottom:1px solid black;">Description</th>
                                    <th class="fw-bold" style="border-top:1px solid black; border-bottom:1px solid black;">Breakup: Gross Salary Per month</th>
                                    <th class="fw-bold" style="border-top:1px solid black; border-bottom:1px solid black;">Breakup: Gross Salary Per Year</th>
                                </tr>
                                <tr>
                                    <th class="" style="border-right: 1px solid black; border-bottom:0;">A. Basic</th>
                                    <td style=" border-bottom:0; background:#eee;">{{($ext['salary'] / 100) * 40}}</td>
                                    <td style=" border-bottom:0;  background:#eee;">{{(($ext['salary'] * 12) / 100) * 40}}</td>
                                </tr>
                                <tr>
                                    <th class="" style="border-right: 1px solid black; border-bottom:0;">B. HRA</th>
                                    <td style=" border-bottom:0; ">{{(($ext['salary'] / 100) * 40) / 2}}</td>
                                    <td style=" border-bottom:0;">{{((($ext['salary'] * 12) / 100) * 40) / 2}}</td>
                                </tr>
                                <tr>
                                    <th class="" style="border-right: 1px solid black; border-bottom:0;">C. Special Allowance</th>
                                    <td style=" border-bottom:0;  background:#eee;">{{($ext['salary'] / 100) * 40}}</td>
                                    <td style=" border-bottom:0;  background:#eee;">{{(($ext['salary'] * 12) / 100) * 40}}</td>
                                </tr>
                                <tr>
                                    <th class="" style="border-right: 1px solid black; border-bottom:0; background:#1c75bc6b;">Net salary(A+B+C) </th>
                                    <td style=" border-bottom:0;background:#1c75bc6b;">{{$ext['salary']}}</td>
                                    <td style=" border-bottom:0;background:#1c75bc6b;">{{($ext['salary'] * 12)}}</td>
                                </tr>
                                @if($ext['pf'])
                                @php($upf = ((($ext['salary'] * 0.40) * 0.12) > 1800 ? 3600 : (($ext['salary'] * 0.40) * 0.12) + (($ext['salary'] * 0.40) * 0.13)))
                                @php($tupf = $upf)
                                <tr>
                                    <th class="" style="border-right: 1px solid black; border-bottom:0;">PF deduction</th>
                                    <td style=" border-bottom:0;  background:#eee; ">{{$tupf}}</td>
                                    <td style=" border-bottom:0;  background:#eee;">{{$tupf*12}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th class="" style="border-right: 1px solid black; border-bottom:0;">Cost To Company</th>
                                    <td style=" border-bottom:0;">{{$ext['salary']}}</td>
                                    <td style=" border-bottom:0;">{{$ext['salary']*12}}</td>
                                </tr>
                                <tr>
                                    <th class="" style="border-right: 1px solid black; border-top :1px solid black; border-bottom:1px solid black;">In Hand</th>
                                    <td style="border-top :1px solid black; border-bottom:1px solid black;">@if($ext['pf']){{$ext['salary'] - $tupf}}@else{{$ext['salary']}}@endif</td>
                                    <td style="border-top :1px solid black; border-bottom:1px solid black;">@if($ext['pf']){{($ext['salary'] - $tupf )*12}}@else{{$ext['salary']*12}}@endif</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p><span style="font-weight:700">{{$ext['fname']}},</span> we are very excited about the opportunity to work together. As we have discussed,
                                this is an important point in our formative process. We are expanding our India-based
                                operations and feel you can make a significant contribution to this effort.
                            </p>
                        </div>
                        <!--<div class="col-12">-->
                        <!--    <p>Based on your performance and on an opportunity, we believe that we will be able to offer-->
                        <!--        you very attractive financial and professional development during the tenure.-->
                        <!--    </p>-->
                        <!--</div>-->
                        <div class="col-12">
                            <p>We have every hope that this will be the beginning of a long and successful career for you
                                with Pantheon Digital.
                            </p>
                        </div>
                        <div class="col-12">
                            <span style="font-weight:700;font-size: 13px;">Pantheon Digital Pvt. Ltd.</span>
                        </div>
                        <div class="col-8">
                            <p id="sign" class="sing" style="margin-bottom:0px;">{{$ext['sign']}}</p>
                            <p style="margin-bottom:0px;">{{$ext['sign_deg']}}</p>
                        </div>
                        <div class="col-4 d-flex flex-column justify-content-between">
                            <p style="margin-bottom:0px;">Signature:</p>
                            <p style="margin-bottom:0px;">Date:</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <center style="
    z-index: 999999999999999999;
    position: absolute;
    right: 5%;
    top:0px;
        ">
            <button onclick="demoFromHTML()" id="send">Send</button>
        </center>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="http://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
        <script>
        function demoFromHTML() {
            $('#send').html('Downloading');
            kendo.drawing
                .drawDOM("#page-container", {
                    forcePageBreak: ".page-break", // add this class to each element where you want manual page break
                    paperSize: "A4",
                    margin: {
                        top: "0cm",
                        bottom: "0cm",
                        right: "0cm",
                        left: "0cm"
                    },
                    scale: 1,
                    height: 500,
                    template: $("#page-template").html(),
                    keepTogether: "#descTab01"
                })
                .then(function(group) {

                    kendo.drawing.pdf.toBlob(group, function(blob) {
                        // You can now upload it to a server.
                        // This form simulates an <input type="file" name="pdfFile" />.
                        @if (isset($ext['id']))
                            var form = new FormData();
                            form.append("pdfFile", blob, "{{ $ext['fname'] }}.pdf");
                            form.append("id", "{{ $ext['id'] }}");
                            form.append("file_type", "appoint letter");
                            form.append("name", '{{ $ext['fname'] }}');
                            form.append("email", '{{ $ext['email'] }}');

                            var xhr = new XMLHttpRequest();
                            xhr.onload = function() {
                                console.log(this.responseText);
                                $('#send').html('sent');
                            }
                            xhr.open("POST", "{{ env('APP_URL') }}api/offup", true);
                            xhr.send(form)
                        @endif
                    });
                    kendo.drawing.pdf.saveAs(group, "{{ $ext['fname'] }}.pdf");
                });

        }
    </script>
    </script>


</body>

</html>