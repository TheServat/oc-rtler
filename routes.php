<?php
\App::before(function ($request) {
    \RtlWeb\Rtler\Classes\LanguageDetector::detect();
});