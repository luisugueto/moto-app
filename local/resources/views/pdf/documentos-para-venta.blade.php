<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        html,
        body,
        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-top: 5px;
            margin-right: auto;
            margin-left: auto;
        }

        .saltoDePagina {
            page-break-after: always;
        }

        .s1 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
        }

        .s2 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 8.4pt;
        }

        .s3 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 11pt;
        }

        .s4 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 5pt;
            vertical-align: 3pt;
        }

        .s5 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 8pt;
        }

        .s6 {
            color: #F00;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 8pt;
        }

        .s7 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 8pt;
        }

        .s8 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 9pt;
        }

        .s9 {
            color: #00F;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 6pt;
        }

        .s10 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 5pt;
            vertical-align: 3pt;
        }

        .s11 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 8pt;
        }

        .s12 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 8pt;
        }

        .s13 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 8pt;
        }

        .s14 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 6pt;
        }

        .s15 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 6pt;
            vertical-align: 3pt;
        }

        .s16 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }

        .s17 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 14pt;
        }

        .s18 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 12pt;
        }

        .s19 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
        }

        .s20 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 14pt;
        }

        .s21 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 13pt;
        }

        .s21-1 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 11pt;
        }

        .s22 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }

        .s23 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }

        h3 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
        }

        .s24 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 12pt;
        }

        .s25 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 11pt;
        }

        .s26 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        .s27 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7pt;
        }

        .s28 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 16pt;
        }

        .s29 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: italic;
            font-weight: normal;
            text-decoration: none;
            font-size: 14pt;
        }

        .s30 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 12pt;
        }

        .s31 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 20pt;
        }

        .s32 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 20pt;
            vertical-align: -2pt;
        }

        .s33 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: underline;
            font-size: 12pt;
        }

        .s34 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: italic;
            font-weight: normal;
            text-decoration: none;
            font-size: 12pt;
        }

        h2 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 14pt;
        }

        .s35 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
        }

        .s36 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        h1 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 18pt;
        }

        .s37 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 10pt;
        }

        .p,
        p {
            color: black;
            font-family: "Arial Narrow", sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
            margin: 0pt;
        }

        .s38 {
            color: black;
            font-family: "Arial Narrow", sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: underline;
            font-size: 10pt;
        }

        .s40 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: underline;
            font-size: 10pt;
        }

        .s41 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 16pt;
        }

        .s42 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7.5pt;
            vertical-align: 3pt;
        }

        .h4,
        h4 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 10pt;
        }

        .s43 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 8pt;
        }

        .s44 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        .s45 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        .s46 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7pt;
        }

        .s47 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7pt;
        }

        .s48 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7pt;
        }

        .s49 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        .s50 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 4pt;
            vertical-align: 2pt;
        }

        .s51 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 4pt;
            vertical-align: 2pt;
        }

        .s52 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7.5pt;
        }

        .s54 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        .s55 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7.5pt;
        }

        .s56 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7pt;
        }

        .s57 {
            color: #00F;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: underline;
            font-size: 7pt;
        }

        .s58 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7pt;
        }

        .s59 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 13pt;
        }

        .a,
        a {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        .s60 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        .s61 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
        }

        li {
            display: block;
        }

        #l1 {
            padding-left: 0pt;
            counter-reset: c1 1;
        }

        #l1>li>*:first-child:before {
            counter-increment: c1;
            content: counter(c1, decimal)" ";
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }

        #l1>li:first-child>*:first-child:before {
            counter-increment: c1 0;
        }

        li {
            display: block;
        }

        #l2 {
            padding-left: 0pt;
            counter-reset: d1 1;
        }

        #l2>li>*:first-child:before {
            counter-increment: d1;
            content: counter(d1, decimal)" ";
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }

        #l2>li:first-child>*:first-child:before {
            counter-increment: d1 0;
        }

        li {
            display: block;
        }

        #l3 {
            padding-left: 0pt;
        }

        #l3>li>*:first-child:before {
            content: " ";
            color: black;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
        }

        li {
            display: block;
        }

        #l4 {
            padding-left: 0pt;
        }

        #l4>li>*:first-child:before {
            content: "• ";
            color: black;
            font-family: "Arial Narrow", sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }

        li {
            display: block;
        }

        #l5 {
            padding-left: 0pt;
        }

        #l5>li>*:first-child:before {
            content: " ";
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        li {
            display: block;
        }

        #l6 {
            padding-left: 0pt;
        }

        #l6>li>*:first-child:before {
            content: " ";
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7pt;
        }

        li {
            display: block;
        }

        #l7 {
            padding-left: 0pt;
        }

        #l7>li>*:first-child:before {
            content: "■ ";
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 8.5pt;
        }

        li {
            display: block;
        }

        #l8 {
            padding-left: 0pt;
        }

        #l8>li>*:first-child:before {
            content: " ";
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        li {
            display: block;
        }

        #l9 {
            padding-left: 0pt;
        }

        #l9>li>*:first-child:before {
            content: " ";
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        li {
            display: block;
        }

        #l10 {
            padding-left: 0pt;
        }

        #l10>li>*:first-child:before {
            content: " ";
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7pt;
        }

        li {
            display: block;
        }

        #l11 {
            padding-left: 0pt;
        }

        #l11>li>*:first-child:before {
            content: "■ ";
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 8.5pt;
        }

        li {
            display: block;
        }

        #l12 {
            padding-left: 0pt;
        }

        #l12>li>*:first-child:before {
            content: " ";
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        li {
            display: block;
        }

        #l13 {
            padding-left: 0pt;
        }

        #l13>li>*:first-child:before {
            content: "- ";
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7.5pt;
        }

        li {
            display: block;
        }

        #l14 {
            padding-left: 0pt;
        }

        #l14>li>*:first-child:before {
            content: "";
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        
        table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }

        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {
            background-color: #008CBA;
        }

        /* Blue */
        @media print {
            .noprint {
                visibility: hidden;
            }
        }
        .underline-a { 
            border-bottom: 1px solid currentColor;
            width:150px;
            display: inline-block;
            line-height: 1.3;
            margin-top: 2px;
            margin-left: 10px;
        }
    </style>
    <?php
        $fieldsArray = json_decode(utf8_encode($purchase->data_serialize));
        foreach ($fieldsArray as $key => $value) {
            if ($value->name == 'dLQrpaV2') {
            $precio = $value->value;
            }
        }
    ?>
</head>
<body>
    {{-- Hoja 8 --}}
    <div class="container-fluid">        
        <p style="text-indent: 0pt;text-align: left;"><br></p>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:22pt">
                <td colspan="4">
                    <p class="s28" style="padding-top: 40pt; text-indent: 0pt;line-height: 11pt;text-align: center;">
                        <b>CONTRATO DE COMPRA-VENTA</b></p>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <p class="s28" style="padding-top: 11pt;text-indent: 0pt; padding-left: 10pt; text-align: left;"><b>  
                        <?php $current_year = date_create($purchase_management->current_year);?>
                        En Madrid a {{ date_format($current_year,"d/m/Y") }} , a las 10:00 reunidos:</b></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:42pt">
                <td>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s21" style="text-indent: 10pt;line-height: 16pt;text-align: justify;"> <b>DE UNA PARTE,</b> <span class="s24">{{ $purchase_management->name }} {{ $purchase_management->firts_surname }}
                            {{ $purchase_management->second_surtname }}</span> <b>con D.N.I.:</b>
                            <span class="s24">{{ $purchase_management->dni }}</span> <b>y domiciliado en:</b>
                            <span class="s24">{{ $purchase_management->municipality}}</span> de <span class="s24">{{ $purchase_management->province}}</span>, calle  <span class="s24">{{ $purchase_management->street }} {{ $purchase_management->nro_street }} {{ $purchase_management->stairs }} {{ $purchase_management->floor }} {{ $purchase_management->letter }}</span>, de código postal
                            <span class="s24">{{ $purchase_management->postal_code }}</span>, tlf <span class="s24">{{ $purchase_management->phone }}</span>, mail
                            <span class="s24">{{ $purchase_management->email }}</span> <b> en calidad de <u>VENDEDOR.</u></b></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr>
                <td>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s21" style="text-indent: 10pt;line-height: 16pt;text-align: justify;"><b>DE
                        OTRA PARTE MOTOSTION S.L. con C.I.F. B-80804156 domiciliado en MADRID calle Matilde Hernández
                        nº10, en calidad de <u>COMPRADOR</u>.</b></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr>
                <td>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <h2 class="s21" style="padding-left: 4pt;text-indent: 0pt;line-height: 16pt;text-align: center;">
                        MANIFIESTAN</h2>
                    <p class="s36" style="text-indent: 10pt;line-height: 13pt;text-align: justify;"><span>1º- Que no
                            pesa sobre el vehículo ningún gravamen, arbitrio, impuesto ni débito de clase alguna
                            pendiente de liquidación a la fecha de extensión de este contrato, obligándose a estar de
                            entera indemnidad a favor del comprador de cualquier reclamación.</span></p>
                    <p class="s36" style="text-indent: 10pt;line-height: 13pt;text-align: justify;"><span>2º- Que han
                            convenido, como por el presente documento lo llevan a efecto, formalizar contrato de
                            compra-venta con ello el propietario vendedorda su conformidad para que a su vez pueda ser
                            vendido o desguazado por el comprador desde la fecha de dicho contrato, según convenga al
                            comprador.</span></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px; margin-top: 15pt;" cellspacing="0">
            <tr>
                <td colspan="4">
                    <h2 style="padding-left: 4pt;text-indent: 0pt;line-height: 16pt;text-align: center;">CARACTERÍSTICAS
                        DEL VEHICULO</h2>
                    <p class="s35" style="padding-left: 4pt;text-indent: 0pt;text-align: left;">Nº DE BASTIDOR</p>
                    <p class="s24" style="padding-left: 4pt;text-decoration: none;">{{ $purchase_management->frame_no }}</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px;" cellspacing="0">
            <tr>
                <td colspan="1">
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <h2 style="padding-left: 4pt;text-indent: 0pt;line-height: 16pt;text-align: left;">MARCA Y MODELO</h2>
                            <p class="s24" style="padding-left: 4pt;text-decoration: none;">{{ $purchase->brand }}
                                {{ $purchase->model }}</p>
                </td>
                <td colspan="1">
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <h2 style="padding-left: 4pt;text-indent: 0pt;line-height: 16pt;text-align: left;">MATRICULA</h2>
                    <p class="s24" style="padding-left: 4pt;text-decoration: none;">{{ $purchase_management->registration_number }}
                    </p>
                </td>
                <td colspan="2" style="margin-top: 5pt;border: 1px solid #000; width: 250px">
                    <h2 style="padding-left: 4pt;text-indent: 0pt;line-height: 16pt;text-align: center;">VALOR DE VENTA
                        IVA INCL.</h2>
                    <h1 style="padding-top: 9pt;text-indent: 0pt;text-align: center;">€</h1>
                    <p class="s35" style="padding-top: 5pt;text-indent: 0pt;text-align: center;text-decoration: none">
                        {{ round($precio, 2) }}</p>
                </td>
            </tr>
        </table>

        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px; margin-top: -5pt;" cellspacing="0">
            <tr>
                <td>
                    <p class="s35" style="padding-top: 0pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">
                        Especificaciones del vehículo:</p>
                    <p style="text-indent: 0pt;text-align: left;">
                   <table>
                       <tr>
                            @if ($purchase_management->vehicle_state_trafic == 'Alta')
                            <td>
                                <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Dado de alta en DGT </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" checked>
                            
                             </td>
                            @else
                            <td>
                                <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Dado de alta en DGT </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" >
                            
                             </td>
                            @endif
                       </tr>
                       <tr>
                            @if ($purchase_management->vehicle_state_trafic == 'Baja temporal')
                            <td>
                                <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Dado de baja en DGT </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" checked>
                            
                            </td>
                            @else
                            <td>
                                <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Dado de baja en DGT </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" >
                            
                            </td>
                            @endif
                        </tr>
                        <tr>
                            @if ($purchase_management->vehicle_state == 'Siniestrado')
                            <td>
                                <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Siniestrado </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" checked>
                            
                            </td>
                            @else
                            <td>
                                <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                    Siniestrado </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" >
                            
                            </td>
                            @endif
                        </tr>
                        <tr>
                            @if ($purchase_management->vehicle_state == 'Averiado' || $purchase_management->vehicle_state == 'Avería Mecánica')
                            <td>
                                <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Averiado </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" checked>
                            
                            </td>
                            @else
                            <td>
                                <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                    Averiado </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" >
                            
                            </td>
                            @endif
                        </tr>
                        <tr>
                            @if ($purchase_management->vehicle_state == 'Abandonado' || $purchase_management->vehicle_state == 'Vieja o Abandonada')
                            <td>
                                <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Abandonado </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" checked>
                            
                            </td>
                            @else
                            <td>
                                <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                    Abandonado </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" >
                            
                            </td>
                            @endif
                        </tr>
                        <tr>
                             @if ($purchase_management->vehicle_state == 'Completo')
                            <td>
                                <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Completo </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" checked>
                            
                            </td>
                            @else
                            <td>
                                <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                    Completo </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" >
                            
                            </td>
                            @endif
                        </tr>
                        <tr>
                           @if ($purchase_management->vehicle_state == 'Parcialmente desmontado')
                           <td>
                               <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                               Parcialmente desmontado </h3>
                           </td>
                           <td>   
                               <input type="checkbox" name="" id="" checked>
                           
                           </td>
                           @else
                           <td>
                               <h3 style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Parcialmente desmontado </h3>
                           </td>
                           <td>   
                               <input type="checkbox" name="" id="" >
                           
                           </td>
                           @endif
                       </tr>
                       <tr>
                           <td><h3 style="padding-left: 22pt;text-indent: -18pt;text-align: left;">Color:
                            </h3></td>
                           <td><span class="s24">{{ $purchase_management->color }}</span></td>
                       </tr>
                       <tr>
                            <td>
                                <h3 style="padding-left: 22pt;text-indent: -18pt;text-align: left;">Kilómetros:</h3>
                            </td>
                            <td><span class="s24">{{ $purchase->km }}</span></td>
                        </tr>
                        <tr>
                            <td>
                                <h3 style="padding-left: 22pt;text-indent: -18pt;text-align: left;">Más datos:</h3>
                            </td>
                            <td></td>
                        </tr>
                   </table>
                    <br>
                    <p class="s37" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">Táchese lo que proceda
                        con (x)</p>
                </td>
            </tr>
        </table>

        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px; margin-top: 10pt;" cellspacing="0">
            <tr>
                <td colspan="3">
                    <p class="s36" style="padding-top: 8pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"><span>Y
                            para que conste, firman la presente en el lugar y fecha arriba indicados. El vendedor recibe
                            copia de este contrato en el momento de la firma de este<br />documento, así como el dinero
                            acordado por ambas partes.</span></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </td>
            </tr>
            <tr>
                <td>
                    <h2 style="padding-left: 41pt;text-indent: 0pt;text-align: left;">EL VENDEDOR</h2>
                </td>
                <td></td>
                <td>
                    <h2 style="padding-left: 41pt;text-indent: 0pt;text-align: left;">EL COMPRADOR</h2>
                </td>
            </tr>
        </table>
        <div class="saltoDePagina"></div>
    </div>
     {{-- Hoja 14 --}}
     <div class="container-fluid">        
        <p style="text-indent: 0pt;text-align: left;"><br></p>
        <p style="text-indent: 0pt;text-align: left;"><br></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td style="width:150px;; padding-right: 40px">
                    <img width="103" height="46" alt="image" src="{{ asset('index_files/Image_022.jpg') }}" />
                </td>

                <td
                    style="width:350px;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s16" style="text-indent: 1pt;text-align: center;"><b>CAMBIO DE TITULARIDAD Y
                            <br>NOTIFICACIÓN DE VENTA DE VEHÍCULOS</b></p>

                </td>
                <td style="width:200px;padding-left: 110px;">
                    <img width="88" height="44" alt="image" src="{{ asset('index_files/Image_023.jpg') }}" />
                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td
                    style="padding-left: 30px;padding-right: 50px;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;">
                    <p class="s16" style="padding-left: 7pt;text-indent: 0pt;line-height: 16pt;text-align: left;">CAMBIO
                        DE TITULARIDAD <span class="s26"><input type="radio" name="" id=""></span></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s16" style="padding-top: 2pt;padding-left: 3pt;text-indent: 0pt;text-align: left;">
                        NOTIFICACIÓN DE VENTA <span class="s26"><input type="radio" name="" id="" checked></span></p>
                </td>
            </tr>
        </table>
        <p class="s14" style="padding-left: 1pt;text-indent: 0pt;text-align: left;">MOD 02/2016-01-ES</p>

        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:15pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt; background-color:#D9D9D9">
                    <p class="s16" style="padding-top: 2pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">DATOS
                        DEL VEHÍCULO</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    rowspan="3">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Matrícula: </p>
                    <p style="padding-left: 5px; text-indent: 0pt;line-height: 20px; text-align: left;">
                       
                        {{ $purchase_management->registration_number }}</p>
                </td>
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    rowspan="3">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Fecha
                        matriculación (dd/mm/aaaa):</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;">
                        <?php $registration_date = date_create($purchase_management->registration_date);?>
                        {{ date_format($registration_date,"d/m/Y") }}</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    rowspan="3">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;text-align: left;">Servicio al que destina el vehículo:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 0px; text-align: left;"></p>
                </td>
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    rowspan="3">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;text-align: left;">Código CET (Código
                        Electrónico de Transferencia): </p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td style="width:195pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    rowspan="3">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;text-align: left;">Código CEMA (Código
                        Electrónico de Maquinaria Agrícola):</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:17pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt; background-color:#D9D9D9">
                    <p class="s16" style="padding-top: 4pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">NUEVO
                        DOMICILIO DEL VEHÍCULO (domicilio de empadronamiento del comprador del vehículo)</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Tipo vía:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Nombre de la vía:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Número:
                    </p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Bloque:
                    </p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Portal:
                    </p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Escalera:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Planta:
                    </p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Puerta:
                    </p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">KM:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Código postal:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Provincia:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Municipio:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Localidad:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:15pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;background-color: #D9D9D9;">
                    <p class="s16" style="padding-top: 2pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">DATOS
                        DEL COMPRADOR</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:23pt">
                <td
                    style="padding-left: 70px;padding-right: 10px;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;">
                    <p class="s16" style="padding-left: 7pt;text-indent: 0pt;line-height: 16pt;text-align: left;"><span
                            class="s26"><input type="radio" name="" id=""></span> Interesado </p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s16" style="padding-top: 2pt;padding-left: 3pt;text-indent: 0pt;text-align: left;"><span
                            class="s26"><input type="radio" name="" id="" checked></span> Compraventa </p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;text-align: left;">NIF/NIE/CIF:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;text-align: left;">Fecha nacimiento
                        (dd/mm/aaaa):</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;text-align: left;">Nombre/Razón social:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Apellido 1:</p>
                        <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Apellido 2:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"></p>
                </td>
            </tr>
            <tr style="height:30pt">
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Tutela:
                    </p>
                     
                    <ul >
                        <li>
                            <p class="s46" style="padding-left: 102pt;text-indent: -8pt;text-align: left;">
                                <span class="s26"><input type="radio" name="" id=""></span> Menor de edad 
                                &nbsp;&nbsp;&nbsp;
                                <span class="s26"><input type="radio" name="" id=""></span>Otras causas</p>
                        </li>
                    </ul>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">NIF/NIE del tutor:</p>
                    <p style="text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Código
                        IAE (Impuesto de Actividades Económicas):</p>
                    <p style="text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Descripción IAE:</p>
                    <p style="text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:15pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;background-color:#D9D9D9 ">
                    <p class="s16" style="padding-top: 2pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">DATOS
                        DEL VENDEDOR</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td
                    style="padding-right: 50px border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;">
                    <p class="s16" style="padding-left: 7pt;text-indent: 0pt;line-height: 16pt;text-align: left;"><span
                            class="s26"><input type="radio" name="" id="" checked></span> Titular </p>
                </td>
                <td
                    style="padding-left: 50px; border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s16" style="padding-top: 2pt;padding-left: 3pt;text-indent: 0pt;text-align: left;"><span
                            class="s26"><input type="radio" name="" id=""></span> Compraventa/Poseedor/Arrendatario </p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        NIF/NIE/CIF:</p>
                    <p style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 20px; text-align: left;">{{ $purchase_management->dni }}
                        </p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Nombre/Razón social:</p>
                    <p style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 20px; text-align: left;">{{ $purchase_management->name }}
                    </p>

                </td>
            </tr>
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Apellido 1:</p>
                    <p style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 20px; text-align: left;">
                        {{ $purchase_management->firts_surname }}</p>

                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s43" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Apellido 2:</p>
                    <p style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 20px; text-align: left;">
                        {{ $purchase_management->second_surtname }}</p>

                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:15pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;background-color:#D9D9D9 ">
                    <p class="s16" style="padding-top: 2pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">DATOS
                        DEL OTROS</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td style="padding-right: 50px;border: 1px solid #000;">
                    <p class="s16" style="padding-left: 7pt;text-indent: 0pt;line-height: 20px;text-align: left;">
                        <br><br></p>
                </td>

            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td style="padding-right: 50px;border: 1px solid #000">
                    <p class="s56"
                        style="text-indent: 0pt;line-height: 7pt;text-align: left;padding-left: 5px;padding-top: 3px;">
                        Doy mi consentimiento para que la DGT consulte a otros organismos públicos los siguientes datos
                        relativos a:</p>

                    <table>
                        <td style="width: 200px">
                            <p class="s43"
                                style="padding-left: 50px;text-indent: 0pt;line-height: 9pt;text-align: left;"><span
                                    style=" color: black; font-family: Arial, Helvetica, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 8pt;"><input
                                        type="checkbox" name="" id=""></span> Verificación de residencia</p>
                        </td>
                        <td style="width: 200px">
                            <p class="s43"
                                style="padding-left: 50px;text-indent: 0pt;line-height: 9pt;text-align: left;"><span
                                    style=" color: black; font-family: Arial, Helvetica, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 8pt;"><input
                                        type="checkbox" name="" id=""></span> Verificación de identidad</p>
                        </td>
                        <td style="width: 270px">
                            <p class="s43"
                                style="padding-left: 20px;text-indent: 0pt;line-height: 9pt;text-align: left;"><span
                                    style=" color: black; font-family: Arial, Helvetica, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 8pt;"><input
                                        type="checkbox" name="" id=""></span> Verificación del Impuesto de Actividades
                                Económicas (IAE)</p>
                        </td>
                    </table>
                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td>
                    <p class="s52" style="padding-top: 3pt;text-indent: 0pt;text-align: center;">En <u>España </u>, a
                        <u> <?php echo date('d'); ?> </u>de<u><?php echo
                            date('M'); ?> </u>de <u><?php echo date('Y'); ?></u></p>
                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="width: 755px">
            <tr>
                <td style="width: 200px;padding-left: 80px">
                    <p class="s52" style="padding-top: 3pt;text-indent: -155pt;text-align: center;"><span>Firma del
                            vendedor</span></p>
                </td>
                <td style="width: 200px;padding-right: 50px">
                    <p class="s52" style="padding-top: 3pt;text-align: center;"><span>Firma del comprador <br />(Sólo
                            necesario para cambio de titularidad)</span></p>
                </td>
                <td style="width: 200px;padding-left: 120px">
                    <p class="s52" style="padding-top: 3pt;text-indent: -155pt;text-align: center;"><span>Firma del
                            empleado público</span></p>
                </td>
            </tr>
        </table>
        <div class="saltoDePagina"></div>
    </div>
    {{-- Hoja 11 --}}
    <div class="container-fluid">
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="text-indent: 0pt;text-align: center;">
            <span><img width="222" height="60" alt="image" src="{{ asset('index_files/Image_007.jpg') }}" /></span>
        </p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="padding-top: 4pt;padding-left: 12pt;text-indent: 0pt;text-align: justify;">D. <u>
                {{ $purchase_management->name }}
                {{ $purchase_management->firts_surname }} {{ $purchase_management->second_surtname }} </u> con DNI
            <u>{{ $purchase_management->dni }}</u> y D. <u>{{ $purchase_management->name_representantive }}
                {{ $purchase_management->firts_surname_representative }}
                {{ $purchase_management->second_surtname_representantive }}</u><span class="p">con DNI</span> <span
                class="p">{{ $purchase_management->dni_representative }}, que declara/declaran tener poder suficiente
                para actuar en su propio nombre y/o en representación de la entidad</span>
            {{ $purchase_management->province }} <span class="p"> con CIF nº y domicilio a</span> efectos de
            notificaciones en<u> {{ $purchase_management->municipality }} </u>, calle
            <u>{{ $purchase_management->street }} </u> nº <u>{{ $purchase_management->nro_street }} </u>C.P.
            <u>{{ $purchase_management->postal_code }} </u>, en concepto de <b>MANDANTE, </b>dice y otorga<b>:</b>
        </p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="padding-left: 12pt;text-indent: 0pt;text-align: justify;">Que por el presente documento confiere, con
            <b>carácter específico</b>, <b>MANDATO CON REPRESENTACIÓN </b><span>a favor
                de<br />D.</span><u>{{ $purchase_management->name_representantive }}
                {{ $purchase_management->firts_surname_representative }}
                {{ $purchase_management->second_surtname_representantive }} </u>, con
            DNI<u>{{ $purchase_management->dni_representative }} </u>, Gestor Administrativo en ejercicio, colegiado
            número &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<span class="p">, perteneciente al
                Colegio Oficial de Gestores Administrativos de</span> <span class="p">, con domicilio en
                 , calle</span><u> &nbsp;&nbsp;  </u>
            nº <u>&nbsp; &nbsp;   </u> C.P.<u> &nbsp; &nbsp; 
            </u>,en concepto de <b>MANDATARIO,</b><span>para su actuación ante todos los órganos y entidades de la
                Administración del Estado, Autonómica, Provincial y Local que resulten competentes, y específicamente
                ante la Dirección General de Tráfico del Ministerio del Interior del Gobierno de España, para que
                promueva, solicite y realice todos los trámites necesarios en relación con el siguiente
            </span><b>ASUNTO:</b></p>
        <ul  >
            <li>
                <p style="margin-left:40px;text-indent: 0pt;text-align: center;"><br /></p>
                <p class="s40"
                    style="margin-left:40px;text-indent: -5pt;line-height: 11pt;text-align: center;border-bottom: 1px solid currentColor; display: inline-block;width: 650px">
                </p>
            </li>
            <li>
                <p style="margin-left:40px;text-indent: 0pt;text-align: center;"><br /></p>
                <p class="s40"
                    style="margin-left:40px;text-indent: -5pt;line-height: 11pt;text-align: center;border-bottom: 1px solid currentColor; display: inline-block;width: 650px">
                </p>
            </li>
        </ul>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="padding-top: 4pt;padding-left: 12pt;text-indent: 0pt;text-align: justify;"><span>El presente mandato,
                que se regirá por los artículos 1709 a 1739 del Código Civil, se confiere al amparo del artículo 5 de la
                Ley 39/2015, de 1 de octubre, del Procedimiento Administrativo Común de las Administraciones Públicas, y
                del artículo 1 del Estatuto Orgánico de la Profesión de Gestor Administrativo, aprobado por Decreto
                424/1963.</span></p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="padding-left: 12pt;text-indent: 0pt;text-align: justify;"><span>El mandante autoriza al mandatario
                para que nombre sustituto, en caso de necesidad justificada, a favor de un Gestor Administrativo
                colegiado ejerciente. El presente mandato mantendrá su vigencia, como máximo, hasta la finalización del
                encargo aquí encomendado, siempre y cuando no sea expresamente revocado por el mandante con
                anterioridad, y comunicada fehacientemente su revocación al mandatario.</span></p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="padding-left: 12pt;text-indent: 0pt;text-align: justify;"><span>El mandante declara bajo su
                responsabilidad de conformidad con el artículo 69 de la Ley 39/2015, de 1 de octubre, del Procedimiento
                Administrativo Común de las Administraciones Públicas, que cumple con los requisitos establecidos en la
                normativa vigente para obtener el reconocimiento de un derecho o facultad o para su ejercicio, que
                dispone de la documentación que así lo acredita, que es auténtica y su contenido enteramente correcto, y
                que entrega al gestor Administrativo, el cual se responsabiliza de su custodia, se compromete a ponerla
                a disposición de la Administración cuando le sea requerida, y a mantener el cumplimiento de las
                anteriores obligaciones durante el período de tiempo inherente al trámite conferido.</span></p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="padding-left: 12pt;text-indent: 0pt;text-align: justify;"><span>El mandante declara, que conoce y
                consiente que los datos que suministra pueden incorporarse a ficheros automatizados de los que serán
                responsables el Gestor Administrativo al que se le otorga el mandato, el Colegio Oficial de Gestores
                Administrativos citado, y el Consejo General de Colegios de Gestores Administrativos de España, con el
                único objeto y plazo de posibilitar la prestación de los servicios profesionales objeto del presente
                mandato y el cumplimiento por estos de las obligaciones derivadas del trámite encomendado. No obstante
                lo anterior, el mandatario se reserva el derecho de custodia y conservación de los datos personales
                recabados con fines de cumplimiento de obligaciones legales exigidas por la normativa tributaria,
                laboral, civil o mercantil, así como para la atención o emprendimiento de reclamaciones y/o acciones
                judiciales. El mandante tendrá derecho a la portabilidad de sus datos, a su acceso, rectificación,
                supresión, limitación, y oposición, así como a interponer las reclamaciones que estime oportunas ante la
                Agencia Española de Protección de Datos, o su equivalente en su país de residencia como Autoridad de
                Control, en los términos previstos en la Ley de Protección de Datos de Carácter personal, y el
                Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo de 27 de abril de 2016.</span></p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <?php 
            $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $fecha = date_create($purchase_management->current_year);
            $mes = date_format($fecha ,"n");
            //Salida: Miercoles 05 de Septiembre del 2016
        
        ?>
        <p style="text-indent: 0pt;text-align: center;">En Madrid {{ date_format($fecha ,"d") }} {{ $meses[date($mes)-1] }} de {{ date_format($fecha ,"Y") }}</p>
        <p style="text-indent: 0pt;text-align: center;"><b>EL MANDANTE</b></p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="padding-top: 9pt;padding-left: 12pt;text-indent: 0pt;text-align: justify;"><span>El mandatario acepta
                el mandato conferido y se obliga a cumplirlo de conformidad con las instrucciones del mandante, y
                declara bajo su responsabilidad que los documentos recibidos del mandante han sido verificados en cuanto
                a la corrección formal de los datos contenidos en los mismos.</span></p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="text-indent: 0pt;text-align: center;">En<u> </u>a _<u> </u>de<u> </u></p>
        <p style="padding-top: 4pt;text-indent: 0pt;text-align: center;"><b>EL MANDATARIO</b></p>
        <div class="saltoDePagina"></div>
    </div>
    {{-- Hoja 12 --}}
    <div class="container-fluid">
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:8.04pt;width: 755px" cellspacing="0">
            <tr style="height:35pt">
                <td style="width:489pt">
                    <p class="s1" style="padding-top: 40pt; text-indent: 0pt;line-height: 11pt;text-align: center;font-size: 14pt">
                        DECLARACIÓN</p>
                </td>
            </tr>
            <tr style="height:97pt">
                <td style="width:489pt">
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p class="s18" style="padding-left: 10pt;text-indent: 0pt;line-height: 14pt;text-align: left;">D./Dª.
                        {{ $purchase_management->name }} {{ $purchase_management->firts_surname }}
                        {{ $purchase_management->second_surtname }} con D.N.I. núm. {{ $purchase_management->dni }}
                        <span>domicilio de provincia de {{ $purchase_management->province }} con dirección {{ $purchase_management->street }},  nro
                            {{ $purchase_management->nro_street }},  
                            @if(!!$purchase_management->stairs) escalera, {{ $purchase_management->stairs }} @endif
                            @if(!!$purchase_management->floor) piso {{ $purchase_management->floor }}, @endif   
                             @if(!!$purchase_management->letter) letra {{ $purchase_management->letter }} @endif  declara haber
                            extraviado la documentación del vehículo matrícula
                            {{ $purchase_management->registration_number }}, marca
                            {{ $purchase_management->brand }}</span> y se compromete a entregarla a motOstion en caso de
                        que aparezca.</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.04pt;margin-top:50px;width: 755px;" cellspacing="0">
            <tr style="height:45pt">
                <td style="">
                    <p class="s18"
                        style="padding-top: 3pt;padding-left: 10pt;text-indent: 0pt;line-height: 13pt;text-align: left;">
                        Firma del titular:</p>
                </td>
                <td style="">
                    <?php
 
                        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        $fecha = date_create($purchase_management->current_year);
                        $mes = date_format($fecha ,"n");
                        //Salida: Miercoles 05 de Septiembre del 2016
                    
                    ?>
                    <p class="s18" style="padding-top: 3pt;padding-left: 10pt;text-indent: 0pt;line-height: 13pt;text-align: right;">
                        <span class="s30"> A {{ date_format($fecha ,"d") }} {{ $meses[date($mes)-1] }}</span><span class="s30" style="text-decoration: none;" > de {{ date_format($fecha ,"Y") }}</span></p>
                </td>
            </tr>
        </table>

        <div class="saltoDePagina"></div>
    </div>
    {{-- Hoja 13 --}}
    <div class="container-fluid">
        <table style="border-collapse:collapse;margin-left:8.04pt;width: 755px" cellspacing="0">
            <tr style="height:35pt">
                <td style="width:489pt">
                    <p class="s1" style="padding-top: 40pt; text-indent: 0pt;line-height: 11pt;text-align: center;">
                        <u>Recibo de Compra</u></p>
                </td>
            </tr>
            <tr style="height:97pt">
                <td style="width:489pt">
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p class="s18" style="padding-left: 10pt;text-indent: 0pt;line-height: 14pt;text-align: left;">D.
                        {{ $purchase_management->name }} {{ $purchase_management->firts_surname }}
                        {{ $purchase_management->second_surtname }} con D.N.I. núm. {{ $purchase_management->dni }}
                        <span> y domicilio en: {{ $purchase_management->street }}
                            {{ $purchase_management->nro_street }} {{ $purchase_management->stairs }}
                            {{ $purchase_management->floor }} {{ $purchase_management->letter }},
                            {{ $purchase_management->postal_code }}, vendo a motOstion, con NIF: B80804156</span> y
                        dirección en C/Matilde Hernandez n°10, 28019, Madrid. Un despiece completo del vehiculo de mi
                        propriedad marca {{ $purchase->brand }}, modelo {{ $purchase->model }}, matrícula
                        {{ $purchase_management->registration_number }}</p>

                    <p class="s18" style="padding-left: 10pt;text-indent: 0pt;line-height: 14pt;text-align: left;">Por
                        un total de {{ $precio }} Euros, por los siguientes repuestos:</p>

                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.04pt;width: 755px" cellspacing="0">
            <tr style="height:35pt">
                <td style="width:489pt">
                    <p class="s1" style="padding-top: 40pt; text-indent: 0pt;line-height: 11pt;text-align: center;">
                        Forma de pago</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.04pt;margin-top:30px;width: 755px" cellspacing="0">
            <tr style="height:35pt">
                <td style="border: 1px solid currentColor;border-right:none;">
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p class="s16" style="padding-left: 10pt;text-indent: 2pt;line-height: 12pt;text-align: left;">Al
                        contado:</p>
                    <p class="s16" style="padding-left: 10pt;text-indent: 2pt;line-height: 12pt;text-align: left;">El
                        vendedor recibe en este acto la cantidad acordada por parte de motOstion y para que conste firma
                        en el lugar y la fecha indicada.</p>
                    <p class="s16" style="padding-left: 10pt;text-indent: 0pt;line-height: 12pt;text-align: left;">en
                        Madrid a :</p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                </td>
                <td style="width: 200px; border: 1px solid currentColor; border-left:none;">
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <table style="width: 200px;">
                        <tr>
                            <td style="background:#D9D9D9;border: 1px solid #D9D9D9">
                                <p class="s16"
                                    style="padding-left: 10pt;text-indent: 0pt;line-height: 14pt;text-align: center;">
                                    <b>Firma</b></p>
                                <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                                <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.04pt;margin-top:30px;width: 755px" cellspacing="0">
            <tr style="height:35pt">
                <td style="border: 1px solid solid #000;border-right:none;">
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p class="s16" style="padding-left: 10pt;text-indent: 0pt;line-height: 12pt;text-align: left;">
                        Transferencia Bancaria:</p>
                    <p class="s16" style="padding-left: 10pt;text-indent: 2pt;line-height: 12pt;text-align: left;">El
                        vendedor recibirá el importe acordado a través de transferencia bancaria en el plazo de 5 días
                        hábiles desde el momento en que el vehículo y la documentación llegue a las instalaciones de
                        motOstion.</p>
                    <p class="s16" style="padding-left: 10pt;text-indent: 0pt;line-height: 12pt;text-align: left;">
                        Número de Cuenta :</p>
                    <p class="s24" style="padding-left: 10pt;text-indent: 0pt;line-height: 12pt;text-align: left;"> {{ $purchase_management->iban }} </p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                </td>
                <td style="width: 200px; border: 1px solid #000; border-left:none;">
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <table style="width: 200px;">
                        <tr>
                            <td style="background:#D9D9D9;border: 1px solid #D9D9D9">
                                <p class="s16"
                                    style="padding-left: 10pt;text-indent: 0pt;line-height: 14pt;text-align: center;">
                                    <b>Firma</b></p>
                                <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                                <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
    </div>
</body>
</html>

