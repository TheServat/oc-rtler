
+function ($) { "use strict";
    if ($.Redactor === undefined) {
        $.Redactor = {
            opts: {
                langs: []
            }
        }
    }
    var Langs = $.Redactor.opts.langs;
    //$.watch('Redactor',function (id, oldval, newval){
    //    Langs = $.Redactor.opts.langs;
    //    newval.watch('opts',function (id, oldval, newval){
    //        newval.langs = $.extend(newval.langs,Langs)
    //        if(newval.langs.hasOwnProperty(Locale)){
    //            newval.lang = Locale
    //        }
    //        newval.direction = DIRECTION;
    //        console.log(newval)
    //        return newval;
    //    })
    //    return newval
    //})

}(window.jQuery);
