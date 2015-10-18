Right-to-Left Support For OctoberCms
=============
This plugin adds Right-To-Left support to OctoberCMS
## How to use this plugin
if you want to change language layout to right to left go to system->Rtler menu in backend and select language. 

use ```flipCss``` filter in theme to flipping css in the frontend, for example:
```html
<link href="{{['assets/css/bootstrap.min.css','assets/css/style.css']|flipCss|theme}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" id="color" href="{{'assets/css/colors/default.css'|flipCss}}"/>
```
```flipCss``` must be used before the ```theme``` filter.
the ```flipCss``` filter works only if the key ```direction``` exists in the frontend language and equals to ```rtl```.
