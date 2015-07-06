Right-to-Left Support
=============
This plugin adds Right-To-Left support to OctoberCMS
## How to use this plugin
Add ```'direction' => 'rtl'``` to lang.php in ```system``` module if the language require rtl layout to change backend layout to rtl automatically in that language.
use ```flipCss``` filter in theme to flipping css in the frontend for example:
```html
<link href="{{['assets/css/bootstrap.min.css','assets/css/style.css']|flipCss|theme}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" id="color" href="{{'assets/css/colors/default.css'|flipCss}}"/>
```
the flipCss filter works only if the language key ```direction``` exists and equals to ```rtl```

sorry for bad english.
